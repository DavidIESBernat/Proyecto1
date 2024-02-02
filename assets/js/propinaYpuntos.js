
// Obtén el valor inicial de precioTotal al cargar la página
let carritoElement = document.querySelector('.carrito');
let precioTotal = carritoElement ? parseFloat(carritoElement.dataset.precioTotal) : 0;

// Declaracion por defecto de la propina
let porcentajePropina = 3;

// Llama a la funcion para actualizar los campos donde se muestra la propina aplicada
actualizarPropina(precioTotal);

// Funcion que convierte a 0 la propina
function omitirPropina(precioTotal) {
    document.getElementById("propina").value = 0;
    actualizarPropina(precioTotal);
}

// Funcion que muestra la propina añadida y el importe total del pedido con la propina aplicada
function actualizarPropina(precioTotal) {
    let porcentajePropina = document.getElementById('propina').value;
    let propinaCalculada; // Declaracion de variable donde almacenar precioTotal + propina
    if(porcentajePropina > 100) {
        propinaCalculada = (precioTotal * 100) / 100; // Limitado a un maximo de 100%
    } else if(porcentajePropina < 0) {
        propinaCalculada = (precioTotal * 0) / 100; // Limitado a un minimo de 0%
    } else {
        propinaCalculada = (precioTotal * porcentajePropina) / 100; // Valor entre 0 y 100
    }

    // Muestra el porcentaje en euros junto al input
    const htmlPropina = document.getElementById('propinaTotal');
    htmlPropina.innerHTML = `+ ${propinaCalculada.toFixed(2).replace(".", ",")} €`;
    
    // Modifica el HTML añadiendo el Importe total con Propina
    const htmlImporte = document.getElementById('importeTotal');
    htmlImporte.innerHTML = `${(precioTotal + propinaCalculada).toFixed(2).replace(".", ",")} € <span class="iva-precio-total">IVA incluido</span>`;
}

function guardarPropinaBBDD() {
    // Fetch que devuelve la propina proporcionada para poder guardarla en la session
}
