/**
 * FRONT-END: Autocompletado de direcciones con Google Maps
 * Proporciona sugerencias y detalles de localización.
 * Requiere un input con id="hanok_address_input"
 */


/* ============================================================================
   CARGA DINÁMICA DEL SDK DE GOOGLE MAPS
   - Inserta el script de Maps con soporte para importLibrary('places').
   - Debe ejecutarse una sola vez por página.
   ========================================================================== */

(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
key: "AIzaSyD2jcVaf_8X1ERkLEbMuCSvemnu7jZvE7k",
v: "weekly",
});



// función autoejecutable para no exponer variables globales

(function () {

  // Namespace único
  window.hanok = window.hanok || {};
  const hanok = window.hanok;


  // Evita registrar listeners dos veces si el script se reinyecta (Complianz, etc.)
  if (hanok._geoInit) return;
  hanok._geoInit = true;
  hanok.tlfOK = false // esto para la validación del otp (está mal aquí pero ahora tengo prisa)



  // ÚNICO estado compartido entre scripts:
  // si ya existe, respétalo (evita "is not defined" y preserva valor)
  if (typeof hanok.direccionSeleccionada === 'undefined') {
    hanok.direccionSeleccionada = null; /* Almacena los DATOS para el informe, también sirve para comprobar si el campo está validado */
  }





/* ============================================================================
   VARIABLES GLOBALES
   - Referencias DOM y estado interno del autocompletado.
   ========================================================================== */

let inputDireccion;           // Input de dirección
let dropdownSugerencias;    // Lista <ul> de sugerencias
let mensajeError;           // Contenedor de mensajes de error
let sessionToken;           // Token de sesión de Autocomplete


let map, marker, mapReady = false;





/* ============================================================================
   INICIALIZACIÓN
   - Crea elementos UI, obtiene token y registra listeners.
   ========================================================================== */

async function initAutocomplete() {

    // obtenemos la referencia al input de dirección
    inputDireccion = document.getElementById('hanok_address_input_');


    // creamos y añadimos el dropdown de sugerencias
    dropdownSugerencias = document.createElement('ul');
    inputDireccion.insertAdjacentElement('afterend', dropdownSugerencias);


    // creamos y añadimos el output para errores
    mensajeError = document.createElement('div');
    mensajeError.style.color = 'red';
    dropdownSugerencias.insertAdjacentElement('afterend', mensajeError);



    // mapa interactivo
      const mapaDiv = document.getElementById('mapa_valoracion_vivienda');
    // importamos la librería de maps y de marker
        if (mapaDiv) {

            const { Map } = await google.maps.importLibrary('maps');
            const { AdvancedMarkerElement } = await google.maps.importLibrary('marker');

            map = new Map(mapaDiv, {
            center: { lat: 40.4168, lng: -3.7038 }, // Madrid
            zoom: 6,
            mapId: 'VV_MAP',

            // Opcional: menos UI
            disableDefaultUI: true,
            //mapTypeId: google.maps.MapTypeId.SATELLITE,
            styles: [
                {
                featureType: "all",
                elementType: "labels",
                stylers: [{ visibility: "off" }]
                }
            ]
            });

            marker = new AdvancedMarkerElement({
            map,
            position: { lat: 40.4168, lng: -3.7038 }
            });

            mapReady = true;
        }

    // instanciamos los servicios de Google Maps

    const { AutocompleteSessionToken } = await google.maps.importLibrary('places');
    sessionToken = new AutocompleteSessionToken();

    inputDireccionControl();
}

document.addEventListener('DOMContentLoaded', initAutocomplete)






/* ============================================================================
   CONTROL DE EVENTOS
   - Gestiona focus, blur e input sobre el campo de dirección.
   ========================================================================== */

function inputDireccionControl() {

    inputDireccion.addEventListener('focus', muestraSugerencias);
    inputDireccion.addEventListener('blur', ocultaSugerencias);
    inputDireccion.addEventListener('input', (e) => {
        hanok.direccionSeleccionada = ''
        cargaSugerencias(e)
        muestraSugerencias()
    });
}



function muestraSugerencias() {

    dropdownSugerencias.style.display = 'block';
    mensajeError.textContent = '';
}



function ocultaSugerencias() {

    dropdownSugerencias.style.display = 'none';

    // si no hay sugerencia activa, pedimos que se seleccione una
    if (!hanok.direccionSeleccionada && dropdownSugerencias.innerHTML) {
        mensajeError.textContent = 'Por favor, selecciona una dirección de las sugerencias.';
    }
}



function cargaSugerencias(e) {

    const valorInput = e.target.value; // valor actual del input

    // si el input tiene menos de 3 letras, no hacemos nada
    if (valorInput.length < 3) {
        dropdownSugerencias.innerHTML = '';
        return;
    }

    // esperamos 400 ms antes de lanzar la búsqueda
    sugerenciasDebounced(valorInput)
}

// debounce de 400 ms para cargar la lista de sugerencias
const sugerenciasDebounced = debounce(buscarSugerencias, 400)




/* ============================================================================
   CONSULTA DE SUGERENCIAS (AUTOCOMPLETE)
   ========================================================================== */

async function buscarSugerencias(valorInput) {

    // Add an initial request body.
    let request = {
        input: valorInput,
        language: "es-ES",
        region: "es",
        includedRegionCodes: ["ES"],
        sessionToken: sessionToken
    };

    const { suggestions } =
        await google.maps.places.AutocompleteSuggestion.fetchAutocompleteSuggestions(request);

    if (!suggestions) {
        console.error('🔴 fallo al obtener sugerencias')
        return
    }


    renderizarSugerencias(suggestions)
    previewDebounced(suggestions); // ▼ PREVIEW del primer resultado
}




/* ========= NUEVO: previsualización “en vivo” (usa 1ª sugerencia) ========= */
const previewDebounced = debounce(previewPrimeraSugerencia, 500);

async function previewPrimeraSugerencia(sugerencias) {

  if (!mapReady || !sugerencias?.length) return;
  try {
    const place = sugerencias[0].placePrediction.toPlace();
    await place.fetchFields({ fields: ['location'] });

    if (place.location) {
      setMapPosition({ lat: place.location.lat(), lng: place.location.lng() }, 15);
    }
  } catch (err) {
    // Silencioso para no molestar al usuario mientras teclea
    console.log(err)
  }
}




/* ============================================================================
   RENDERIZADO DE RESULTADOS
   - Construye la lista <ul> con predicciones.
   ========================================================================== */
function renderizarSugerencias(sugerencias) {

    // limpiamos el dropdown
    dropdownSugerencias.innerHTML = '';

    // añadimos las sugerencias
    sugerencias.forEach(sugerencia => {

        const li = document.createElement('li');
        li.textContent = sugerencia.placePrediction.text.toString();

        li.addEventListener('mousedown', (e) => {
            e.preventDefault(); // evita perder el foco antes
            seleccionarSugerencia(sugerencia);
            mensajeError.textContent = ''
        });

        dropdownSugerencias.appendChild(li);
    });

}




/* ============================================================================
   SELECCIÓN DE DIRECCIÓN Y DETALLES
   - Obtiene datos de ubicación (lat, lng, componentes de dirección).
   ========================================================================== */
async function seleccionarSugerencia(sugerencia) {

    // control UI
    ocultaSugerencias()
    inputDireccion.value = sugerencia.placePrediction.text.toString()


    // solicitud de datos a Google
    const place = sugerencia.placePrediction.toPlace()

    try {
        await place.fetchFields({ fields: ['location', 'addressComponents'] });
    } catch (err) {

        console.error('🔴 fallo en fetchFields', err);

        // Si el Place ID caducó o no existe, avisamos y pedimos reintentar
        mensajeError.textContent = 'No hemos podido cargar los detalles de esta dirección. Vuelve a seleccionarla o escribe de nuevo.';
        return;
    }


    if (!place.addressComponents) {
        console.error('🔴 fallo al obtener detalles')
        return
    }


    // formateo de datos
    const detalles = {
        lat: place.location.lat(),
        lng: place.location.lng(),
    }


    place.addressComponents.forEach( (c) => {

        // variable para filtrar el tipo de dato
        const addressType = c.types[0];

        // recorremos la lista y asignamos valores
        switch (addressType) {

            case 'administrative_area_level_1':
                detalles.comunidad = c.longText;
                break;
            case 'administrative_area_level_2':
                detalles.provincia = c.longText;
                break;
            case 'postal_code':
                detalles.cp = c.longText;
                break;
            case 'route':
                detalles.calle = c.longText;
                break;
            case 'street_number':
                detalles.num = c.longText;
                break;
            case 'locality':
                detalles.ciudad = c.longText;
                break;
        }
    })



    // validamos precisión
    if( !detalles.num ) {
        mensajeError.textContent = 'La dirección debe ser precisa e incluir el número del portal'
        return
    }


    mensajeError.textContent = ''
    hanok.direccionSeleccionada = detalles
    setMapPosition({ lat: detalles.lat, lng: detalles.lng }, 18);
    return
}



/* ========= NUEVO: helper para mover el mapa/marker ========= */
function setMapPosition(pos, zoom) {

  if (!mapReady || !pos) return;
  marker.position = pos;
  map.setCenter(pos);
  if (typeof zoom === 'number') map.setZoom(zoom);
}



/* ============================================================================
   UTILIDAD: DEBOUNCE
   - Controla la frecuencia de ejecución de funciones intensivas.
   ========================================================================== */
function debounce(fn, wait) {

    let t;
    return (...args) => {
        clearTimeout(t)
        t = setTimeout(() => {fn(...args)}, wait)
    }
}


})();