

document.addEventListener('DOMContentLoaded', () => {

    const hanokForm = document.getElementById('form_valoracion_vivienda')

    // listener para el envío del formulario
    hanokForm.addEventListener('submit', async (e) => {

      e.preventDefault();

      const res = await fetch('/wp-json/hanok/v1/valuation', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-Hanok-Nonce': document.getElementById('_hanok_nonce').value
        },
        credentials: 'include',            // <— clave
        body: JSON.stringify({ _hanok_nonce: document.getElementById('_hanok_nonce')?.value, ...initIntegration() })
      });

      if (!res.ok) {
        const txt = await res.text();
        console.error('Error REST', res.status, txt);
        alert('No se pudo procesar la solicitud.');
        return;
      }

      const json = await res.json();
      if (json.redirect) window.location.href = json.redirect;
    })
})


// comprueba si hacemos informe viejo o el nuevo y recoge los datos pertinentes
function initIntegration() {

    const formData = obtenerDatosForm()

    if (formData.hanok_interes === "vender" ||
    formData.hanok_motivo_info === "vender_medio_plazo" ||
    formData.hanok_motivo_info === "vender_futuro" ) {

        const oldApiData = adaptaDatosParaApiVieja(formData)
        //console.log(oldApiData)
        return oldApiData
    }

    //console.log(formData)
    return formData
}



function obtenerDatosForm() {

    // referencia a preguntas y respuestas
    const preguntasForm = formSchema.preguntas
    const respuestasForm = {...window.hanok.direccionSeleccionada}

    respuestasForm.timestamp = new Date().toJSON()
    respuestasForm.url = window.location.href


    // por cada una, buscamos el id en el form y anotamos la respuesta
    preguntasForm.forEach(p => {

        const preg = formElement.querySelector(`#${p.id}`)
        if (!preg) return

        switch (p.type) {

            case "select": // si es de selección recorremos las opciones para ver si una está marcada
                const options = preg.querySelectorAll('input')
                options.forEach( o => {
                     if(o.checked) respuestasForm[p.id] = o.value 
                })
                break
            case "text": // si es de rellenar
            case "number":
            case "email":
            case "tel":
                const resp = preg.querySelector('input')
                if (resp.value) respuestasForm[p.id] = resp.value
                break
            case "checkbox": // si es checkbox
                const check = preg.querySelector('input')
                respuestasForm[p.id] = check.checked
                break
            default:
                console.error('Tipo de campo inesperado')
        }
    });

    return respuestasForm
}


function adaptaDatosParaApiVieja(datos) {

    const oldData = { // referencia para datos para la API vieja
        "property_type_id": 4,
    }

    // sacamos las claves de los datos del form
    const claves = Object.keys(datos)

    // por cada clave, buscamos su equivalente
    claves.forEach((k) => {
        if (EQUIVALENCIAS_NUEVA_VIEJA[k]) {
            oldData[EQUIVALENCIAS_NUEVA_VIEJA[k]] = datos[k]
        }
    })

    return oldData
}


/*
 * Tabla de equivalencias entre IDs de campos
 * "id_nuevo": "id_viejo"
*/
const EQUIVALENCIAS_NUEVA_VIEJA = {

    /* datos personales */
    "timestamp": "timestamp",
    "url": "url",
    "hanok_nombre": "client_name",
    "hanok_email": "email",
    "hanok_telefono": "phone_number",
    "hanok_politicas": "consiente",


    /* datos geográficos */
    "lat": "latitude",
    "lng": "longitude",
    "comunidad": "comunidad",
    "provincia": "provincia",
    "cp": "codigo_postal",
    "calle": "calle",
    "num": "num",
    "ciudad": "ciudad",


    /* datos lead */
    "hanok_interes": "interes",
    "hanok_comprar": "residencia",
    "hanok_hipoteca": "hipoteca",
    "hanok_2_viv_vender": "vender_primera",
    "hanok_gesvalt": "gesvalt",
    "hanok_cuando_vender": "tiempo_venta",
    "hanok_motivo_info": "porque_info",
    "hanok_donde_casa_anunciada": "donde_anunciada",
    "hanok_venta_exclusiva": "exclusiva",
    "hanok_exclusiva_cuantos_meses": "meses_exclusiva",
    "hanok_motivo_vender": "motivo_vender",
    "hanok_motivo_3m": "espera_3_meses",
    "hanok_mot_6m": "espera_6_meses",


    /* datos inmueble */
    "hanok_tipo_vivienda": "property_type",
    "hanok_estado_inmueble": "estado_inmueble",
    "hanok_reforma": "reforma",
    "hanok_superficie": "area",
    "hanok_dormitorios": "n_rooms",
    "hanok_wc": "n_baths",
    "hanok_precio_esperado": "precio_venta_deseado",
}