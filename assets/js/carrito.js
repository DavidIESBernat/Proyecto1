// Puntos actuales obtenidos
let puntosDisponibles = document.getElementById('puntosActuales').value;

// Porcentaje de propina
let porcentajePropina = 3 // Por defecto 3

if (localStorage.getItem('propina') !== null) {
    // Si existe, asigna el valor almacenado en la localStorage a la variable
    porcentajePropina = document.getElementById("propina").value = localStorage.getItem('propina');
  } else {
    // Si no existe, asigna el valor por defecto de 3
    porcentajePropina = 3;
    document.getElementById("propina").value = 3;
  }
  
// Variable global donde se guardan los puntos gastados
let puntosGastados; 

// Variable que guarda el precio final total
let precioTotalFinal; 


// En caso de pulsar sobre el boton Realizar pedido
document.getElementById('realizarPedidoBtn').addEventListener('click', function (event) {
    event.preventDefault();

    // Obtén la propina y otros datos necesarios
    let porcentajePropina = document.getElementById('propina').value;
    let puntosObtenidos = document.getElementById('puntosObtenidos').value;
    let precioTotal = document.getElementById('precioTotal').value;

    fetch('http://pitstop.com/?controlador=pedido&accion=confirmarPedido', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            porcentajePropina: porcentajePropina,
            precioTotal: precioTotal,
            puntosObtenidos: puntosObtenidos,
            puntosGastados: puntosGastados,
            precioTotalFinal: precioTotalFinal
        })
    })
    .then(response => {
        // Verifica si hay una redirección
        if (response.redirected) {
            console.log('Pedido realizado correctamente.');
            console.log('Respuesta del servidor:', response);
            const seccionesCarrito = document.querySelector('.secciones-carrito');
            if (seccionesCarrito) {
                // Modifica el contenido del elemento secciones-carrito
                seccionesCarrito.innerHTML = `
                    <div class="col-12 carrito-vacio">
                        <h1>Pedido realizado correctamente</h1>
                        <a class="btnVaciar" href="http://pitstop.com?controlador=pedido&accion=cargarPedido">Ver mis pedidos</a>
                    </div>
                `;
            }
        } else {
            console.log('Respuesta completa del servidor:', response);
            return response.json();
        }
    })
    .catch(error => {
        console.error('Error al enviar datos al servidor:', error);
    });
});

// Obtén el valor inicial de precioTotal al cargar la página
let carritoElement = document.querySelector('.carrito');
let precioTotal = carritoElement ? parseFloat(carritoElement.dataset.precioTotal) : 0;

// Funcion que convierte a 0 la propina
function omitirPropina() {
    document.getElementById("propina").value = 0;
    actualizarImporte();
}

// Llama a la funcion para actualizar los campos donde se muestra la propina aplicada
actualizarImporte();

function actualizarImporte() {
    // Actualizar propina
    let porcentajePropina = document.getElementById('propina').value;
    let propinaCalculada;

    if (porcentajePropina > 100) {
        propinaCalculada = (precioTotal * 100) / 100; // Limitado a un máximo de 100% 
    } else if (porcentajePropina < 0) {
        propinaCalculada = (precioTotal * 0) / 100; // Limitado a un mínimo de 0%
    } else {
        propinaCalculada = (precioTotal * porcentajePropina) / 100; // Valor entre 0 y 100
    }

    // Guardar el porcentaje de propina seleccionado actualmente en localStorage
    localStorage.setItem('propina', porcentajePropina);

    // Mostrar el porcentaje en euros junto al input
    const htmlPropina = document.getElementById('propinaTotal');
    htmlPropina.innerHTML = `+ ${propinaCalculada.toFixed(2).replace(".", ",")} €`;

    // Actualizar puntos
    let inputPuntos = document.getElementById('puntos').value;
    inputPuntos = parseInt(inputPuntos);

    if (isNaN(inputPuntos)) {
        console.log(`Error: Ingrese un valor numérico`);
    } else if (inputPuntos > puntosDisponibles) {
        console.log(`Warning: Límite de puntos superado`);
        puntosGastados = puntosDisponibles; // Establece los puntos gastados en la variable global
    } else if (inputPuntos < 0) {
        console.log(`Error: Valor negativo`);
        puntosGastados = 0; // Establece los puntos gastados en la variable global
    } else {
        let puntosEnEuros = inputPuntos / 100;
        let precioTotalMasPuntos = precioTotal - puntosEnEuros;
        console.log("Precio total con descuento de "+ inputPuntos +" puntos aplicado:" + precioTotalMasPuntos);

        // Establece los puntos gastados en la variable global
        puntosGastados = inputPuntos;
         // Calcular el precio total final con propina y descuento por puntos
         precioTotalFinal = precioTotal + propinaCalculada - puntosEnEuros;

         // Modificar el HTML añadiendo el Importe total con Propina y Descuento por Puntos
         const htmlImporte = document.getElementById('importeTotal');
         htmlImporte.innerHTML = `${precioTotalFinal.toFixed(2).replace(".", ",")} € <span class="iva-precio-total">IVA incluido</span>`;
     }
}