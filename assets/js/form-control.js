/**
 * Motor JS que interpreta las órdenes JSON del schema para regular el flujo de preguntas
 */


// debug
let globalRef

// importamos el schema usando la url que nos da PHP
let formSchema
let reglas
let formElement


async function startFormControl() {

    // inicializa referencia para el schema, reglas y para el elemento formulario
    formSchema = await ( await fetch(FORMDATA.schemaUrl) ).json()
    reglas = formSchema.reglas
    formElement = document.getElementById('form_valoracion_vivienda')


    // asigna eventListeners para evaluar reglas cuando cambie un input
    const inputsForm = formElement.querySelectorAll('input[type="radio"]')
    inputsForm.forEach((input) => {
        input.addEventListener('change' , () => evalRules(reglas))
    })



    // evaluación inicial
    evalRules(reglas)
    globalRef = reglas
}

document.addEventListener('DOMContentLoaded' , startFormControl)



// función que mira todas las reglas y las evalúa (de arriba a abajo)
function evalRules(reglas) {

    reglas.forEach((rule) => {
        // si la regla da true, muestra el target, si no, lo oculta
        if( resolveRule(rule.showWhen) ) activaPregunta(rule.target)
        else desactivaPregunta(rule.target)
    })
}



/*
* función que lee la regla y la resuelve
* mira el operador para seleccionar la función
* mira los operandos:
*   - si son strings, resuelve la operación
*   - si alguno es un objeto (otra operación),
*      se llama así misma y resuelve la operación interna
*/
function resolveRule(rule) {

    // sacamos la operación y los valores
    const operation = Object.keys(rule)[0]

    const valores = rule[operation]
    // recorre el array, resuelve las operaciones internas recursivamente y evalua

    switch (operation) {
        case "and" :
            return valores.map(v => (isOp(v) ? resolveRule(v) : v)).every(Boolean);
        case "or" :
            return valores.map(v => (isOp(v) ? resolveRule(v) : v)).some(Boolean);
        case "eq" :
            return valorCoincide(valores)
        default :
            console.error('Clave desconocida: ', rule.key)
    }

    return null
}

// helper para ver si v es una operación o un valor (para recursividad)
const isOp = v => v && typeof v === 'object' && !Array.isArray(v);



/**
 * recibe un array con dos elementos, un id de pregunta y un valor esperado
 * devuelve true si el valor marcado coincide con el esperado
 */
function valorCoincide(valores) {

    const [idPregunta, esperando] = valores
    const cont = formElement.querySelector(`#${idPregunta}`)
    const radios = cont.querySelectorAll('input[type="radio"]')

    for( const r of radios ) {
        if( r.value === esperando && r.checked ) return true
    }

    return false
}



function activaPregunta(target) {

    // ocultar pregunta
    const pregunta = formElement.querySelector(`#${target}`)
    pregunta.hidden = false
}



function desactivaPregunta(target) {

    const pregunta = formElement.querySelector(`#${target}`)
    pregunta.hidden = true

    // deseleccionar opciones
    const inputs = pregunta.querySelectorAll('input[type="radio"')
    if(!inputs) return
    inputs.forEach((i) => i.checked = false)
}