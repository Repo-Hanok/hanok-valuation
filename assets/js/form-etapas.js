



/**
 * Control para avanzar en el formulario:
 * visibilidad de etapas y campos
 * control de flujo desde la ui
 */


let etapaActual = 1 // ref para control de las etapas del form
let etapasFormVV


document.addEventListener('DOMContentLoaded', () => {

    // objeto con las 4-5 etapas del form
    etapasFormVV = document.querySelectorAll('.form-paso')

    // referencias a la ui
    const atras = document.getElementById('hanok_ui_back')
    const enviar = document.getElementById('hanok_ui_submit')
    const siguiente = document.getElementById('hanok_ui_next')

    // listeners de la ui
    atras?.addEventListener('click', botonAtras)
    enviar?.addEventListener('click', ultimaFase)
    siguiente?.addEventListener('click', botonSiguiente)

    // evento para el form, para ir actualizando estado de los botones
    const formularioHanok = document.getElementById('form_valoracion_vivienda')

    formularioHanok.addEventListener('input', lockButtons, true)
    formularioHanok.addEventListener('change', lockButtons, true)
    formularioHanok.addEventListener('click', lockButtons, true)

    // control para el botón 'Enter'
    formularioHanok.addEventListener("keydown", (e) => { // TODO --> Golpea el botón de siguiente si está disponible, o el de enviar formulario
    if (e.key === "Enter") e.preventDefault();
    });

    // inicialización del estado
    toggleButtons(); lockButtons();

    // en móvil, hace scroll hasta el título del formulario cuando cambias de etapa
    function resetScrollMovil() {
    if (window.innerWidth <= 768) {
        const titulo = document.querySelector('#hanok_titulo');
        if (titulo) titulo.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    }




    // muestra/oculta los botones de la UI en función de qué etapa estemos
    function toggleButtons() {

        atras.hidden = etapaActual === 1
        enviar.hidden = etapaActual !== etapasFormVV.length
        siguiente.hidden = etapaActual === etapasFormVV.length
    }


    // muestra sólo la etapa actual
    function actualizarEtapa(n) {
        //seguridad
        if(typeof(n) !== 'number') {
            console.log('fail en actualizarEtapa'); return
        }
        etapaActual = etapaActual + n
        // ver si la etapa actual está vacía
        // es decir: los hijos están todos como hidden=true
        let etapaVacia = true;
        const hijos = etapasFormVV[etapaActual - 1].children;

        for (let i = 0; i < hijos.length; i++) {
            if (!hijos[i].hidden) {
                etapaVacia = false;
                break;
            }
        }
        // si está vacío salta a la siguiente etapa
        if(etapaVacia) etapaActual = etapaActual + n
        // cambiamos visibilidad
        etapasFormVV.forEach((elt, ind) => {
            elt.hidden = ind !== etapaActual - 1
        });
        lockButtons()
        resetScrollMovil()
    }


    // comprueba si todas las preguntas visibles están respondidas
    function validarEtapa() {

        if(etapaActual == 1) {
            return !!window.hanok.direccionSeleccionada
        }

        const etapa = etapasFormVV[ etapaActual - 1 ]
        if(!etapa) return false

        const radios = etapa.querySelectorAll('fieldset:not([hidden])')
        const resto = etapa.querySelectorAll(':scope > label:not([hidden])')

        const radioCheck = Array.from(radios).every((r) => {
            if(r.classList.contains('hanok_check_group')) return true
            if(r.id !== 'hanok_telefono') {
                return Array.from(r.querySelectorAll('input')).some(i => i.checked)
            } else {
                return window.hanok.tlfOK
            }
        })

        const restoCheck = Array.from(resto).every((r) => {
            const rInput = r?.querySelector('input')
            return ( rInput?.value && rInput.value.trim() !== "" )
        })

        return (radioCheck && restoCheck)
    }


    function botonAtras() {

        actualizarEtapa(-1)
        toggleButtons()
        lockButtons()
    }


    function botonSiguiente() {

        if(validarEtapa()){

            actualizarEtapa(1)
            toggleButtons()
            lockButtons()
            return
        }
    }


    // activa/desactiva los botones en función de si todas las preguntas visibles están respondidas
    function lockButtons() {

        setTimeout(()=>{
            const disabled = !validarEtapa()
            enviar.disabled = disabled
            siguiente.disabled = disabled
        },100)
    }


    function ultimaFase(e) {

        console.log(e.target)
        if(e.target.disabled) return
        formularioHanok.hidden = true
        document.getElementById('hanok_procesando_datos').hidden = false
    }


})