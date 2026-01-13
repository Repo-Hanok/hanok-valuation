

document.addEventListener('DOMContentLoaded', () => {

    const hanokForm = document.getElementById('form_valoracion_vivienda')
    const feedbackEl = document.getElementById('hanok_procesando_datos')

    if (!hanokForm || !feedbackEl) {
        console.error('No se encontró el formulario o el elemento de feedback');
        return;
    }

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
        let msg = 'No se pudo procesar la solicitud.';
        try {
          // por si viene JSON con mensaje
          const errJson = await res.json();
          msg = errJson?.message || errJson?.data?.message || msg;
        } catch {
          // fallback a texto plano
          const txt = await res.text();
          if (txt) msg = txt;
          msg = 'Error: ' + msg + '. Por favor, inténtalo de nuevo más tarde.';
        }

        console.error('Error REST', res.status, msg);

        feedbackEl.classList.remove('is-loading');
        feedbackEl.classList.add('is-error');
        feedbackEl.textContent = msg;
        return;
      }

      const json = await res.json();
      if (json.redirect) window.location.href = json.redirect;
    })
})


// comprueba si hacemos informe viejo o el nuevo y recoge los datos pertinentes
function initIntegration() {
    const form = document.getElementById('form_valoracion_vivienda')
    const formData = obtenerDatosForm()

    // VENDER (informe viejo)
        if (form.classList.contains('vender')) {
            /***
             * 
             *  AQUÍ METER : INTERÉS = VENDER ...
             */
            console.log('vender')
            formData.hanok_interes = 'vender'
            const oldApiData = adaptaDatosParaApiVieja(formData)
            return oldApiData
        }
    // ALQUILAR (informe nuevo)
        else if (form.classList.contains('alquilar')) {
            console.log('alquilar')
            formData.hanok_interes = 'alquilar'
            return formData
        }
    // COMPRAR (informe nuevo)
        else if (form.classList.contains('comprar')) {
            console.log('comprar')
            formData.hanok_interes = 'comprar'
            return formData
        }
    // INFO (informe nuevo)
        else if (form.classList.contains('info')) {
            console.log('info')
            formData.hanok_interes = 'info'
            return formData
        }
    // MAIN (ambos informes)
    console.log('main')
    if (formData.hanok_interes === "vender" ||
    formData.hanok_motivo_info === "vender_medio_plazo" ||
    formData.hanok_motivo_info === "vender_futuro" ) {

        const oldApiData = adaptaDatosParaApiVieja(formData)
        return oldApiData
    }

    //console.log(formData)
    return formData
}



function obtenerDatosForm() {

    // referencia a preguntas y respuestas
    const preguntasForm = formSchema.preguntas
    const respuestasForm = {...window.hanok.direccionSeleccionada}
    const formElement = document.getElementById('form_valoracion_vivienda')

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
                respuestasForm[p.id] = preg.checked
                break
            default:
                console.error('Tipo de campo inesperado')
        }
    });

    return respuestasForm
}

// creo que esta función no hace nada (¿?)
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