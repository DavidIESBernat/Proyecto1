let opiniones; // letiable que contiene las diferentes reseñas que se guarden en ella.
 
cargarProductos();
// Fetch a la API para obtener las opiniones de la base de datos.
function cargarProductos(){
    fetch("http://pitstop.com/?controlador=api&accion=mostrar_opiniones")
    .then(data => data.json())
    .then(data => {
        opiniones = data;
        console.log(opiniones); // Agrega este log para verificar que opiniones se haya inicializado correctamente
        mostrarReseñas(opiniones);
    });
}


// Funcion para filtrar por nota o orden que enviaran las reseñas encontradas a la funcion mostrarReseñas
function filtrar() {
    // Obtiene el valor seleccionado en el select
    const selectNota = document.getElementById("filtroNota");
    const selectOrden = document.getElementById("filtroOrden");

    // Guarda los valores de los select en sus respectivas letiables
    let valorNota = selectNota.value;
    let valorOrden = selectOrden.value;

    // Si los valores se encuentran por defecto se muestran todas las reseñas
    if (valorNota === '0' && valorOrden === 'original') {
        mostrarReseñas(opiniones); // Llama a la funcion mostrarReseñas con todas las reseñas
        console.log("Entra");
    } else {
        // Ifs para determinar los valores seleccionados
        if(valorNota === '0' && valorOrden === 'positivas') { // En caso de querer ordenar por orden ascendente
            const opinionesFiltradas = opiniones.sort((a,b) => a.nota - b.nota);
            mostrarReseñas(opinionesFiltradas); // Llama a la funcion mostrarReseñas con las reseñas ordenadas por nota
        } else if(valorNota === '0' && valorOrden === 'negativas'){ // En caso de querer ordenar por orden descendente
            const opinionesFiltradas = opiniones.sort((a,b) => b.nota - a.nota);
            mostrarReseñas(opinionesFiltradas); // Llama a la funcion mostrarReseñas con las reseñas ordenadas por nota
        } else { // En caso de querer filtrar por nota
            const opinionesFiltradas = opiniones.filter(opinion => opinion.nota == valorNota);
            mostrarReseñas(opinionesFiltradas); // Llama a la funcion mostrarReseñas con las reseñas filtradas por nota
        }
    }
}

// Funcion que muestra en el HTML las reseñas que se le han enviado por parametro
function mostrarReseñas(opiniones) {

    // Obtener el contenedor de reseñas del documento
    const contenedorReseñas = document.querySelector('.seccion-reseñas');
    const contenedorFormulario = document.querySelector('.formularioContainer');

    // Vaciar contenedores para cuando se actualice evitar duplicados
    contenedorReseñas.innerHTML = '';
    contenedorFormulario.innerHTML = '';

    // Creacion del Boton para mostrar el formulario
    const boton = document.createElement('button');
    boton.classList.add('boton_simple');
    boton.onclick = function() { mostrarFormulario(); }; // Asignar la función al evento onclick del botón
    boton.innerText = 'Escribe una opinion';
    contenedorReseñas.appendChild(boton);

    opiniones.forEach(opinion => {
        // Crea elemento html tipo div para reseña, lo guarda en la letiable reseña.
        const reseña = document.createElement('div');
        // Añade las clases siguientes al elemento div de reseña.
        reseña.classList.add('col-10', 'col-md-5', 'reseña');
        // Añade el codigo html con los valores de opinion al contenido de reseña.
        reseña.innerHTML = `<div class="flex-between"><p class="numComanda" id="comanda">Nº${opinion.pedido_id} - ${opinion.autor}</p><p class="fecha" id="fecha">${opinion.fecha}</p></div><div class="flex-between"><h3 id="titulo">${opinion.titulo}</h3><div class="valoraciones" id="nota"><img alt="reseña con valoración de ${opinion.nota} estrellas" src="assets/images/rate-${opinion.nota}stars.svg"></div></div><p class="descripcion" id="opinion">${opinion.comentario}</p>`;
        // Agregar la reseña al contenedor general de reseñas
        contenedorReseñas.appendChild(reseña);
    });
}

// Funcion que muestra en el HTML el formulario para enviar una opinion
function mostrarFormulario() {
    // Obtener el contenedor de reseñas del documento
    const contenedorReseñas = document.querySelector('.seccion-reseñas');
    
    // Creacion del formulario
    const formulario = document.createElement('form');
    formulario.classList.add('formularioAtributos','col-12','col-md-10', 'row', 'no-margin-row');
    formulario.innerHTML = `<h3 class="TituloFormulario col-12">Escribe tu opinion</h3><div class="col-12 col-md-10 col-lg-6 row"><label class="col-3" for="pedido">NºPedido</label><input id="pedido" class="col-9" type="text" name="pedido" required></div><div class="col-12 col-md-10 col-lg-6 row"><label class="col-3" for="nombre">Nombre</label><input id="nombre" class="col-9" type="text" name="nombre" minlength="2" maxlength="20" placeholder="Escribe tu nombre..." required></div><div class="col-12 col-md-10 col-lg-6 row"><label class="col-3" for="titulo">Titulo</label><input id="titulo" class="col-9" type="text" name="titulo" minlength="3" maxlength="30" placeholder="Titulo de tu opinion..." required></div><div class="col-12 col-md-10 col-lg-6 row"><label class="col-3" for="valoracion">Valoracion </label><select id="nota" class="col-9" name="valoracion" id=""><option value="5">5 estrellas</option><option value="4">4 estrellas</option><option value="3">3 estrellas</option><option value="2">2 estrellas</option><option value="1">1 estrella</option></select></div><div class="col-12 row descripcionContainer"><label class="col-3" for="descripcion">Descripcion</label><textarea id="descripcion" class="col-9 no-margin-row descripcionInput" type="text" name="descripcion" minlength="50" maxlength="400" placeholder="Describe tu opinion..." required></textarea></div><button class="boton_simple" id="btnEnviar" onclick="enviarOpinion()">Enviar Opinion</button>`;
    
    // Creacion del Boton para mostrar las reseñas
    const boton = document.createElement('button');
    boton.classList.add('boton_simple');
    boton.onclick = function() { filtrar(); }; // Asignar la función al evento onclick del botón
    boton.innerText = 'Mostrar Reseñas';
    
    // Añadir el botón y el formulario al contenedor de reseñas
    contenedorReseñas.innerHTML = ''; // Limpiar el contenedor de reseñas antes de añadir el formulario para evitar duplicados
    contenedorReseñas.appendChild(boton);
    contenedorReseñas.appendChild(formulario);
}

// Funcion que se ejecuta al hacer clic sobre el boton de enviar el formulario de una nueva opinion
function enviarOpinion() {

    // Obtiene los valores de los input en base al id y los guarda en variables
    let numeroPedido = document.getElementById('pedido').value;
    let nombre = document.getElementById('nombre').value;
    let tituloOpinion = document.getElementById('titulo').value; 
    let valoracion = document.getElementById('nota').value; 
    let descripcion = document.getElementById('descripcion').value;

    // Comprueba que el formulario cumple los requisitos de longitud y que no se envia vacio ningun campo
    if(numeroPedido != "" && nombre != "" && tituloOpinion != "" && descripcion != "" && descripcion.length >= 50 && tituloOpinion.length >= 3 && nombre.length >= 2) {
        // Crea un array con todas las variables anteriores
        let data = {
            numeroPedido: numeroPedido,
            nombre: nombre,
            tituloOpinion: tituloOpinion,
            valoracion: valoracion,
            descripcion: descripcion
        };
        console.log(data); // Muestra por consola los datos enviados
        let jsonData = JSON.stringify(data); // Convierte el array data en una cadena de texto de tipo JSON

        // Llama a la API con una accion para agregar una nueva opinion
        fetch('http://pitstop.com/?controlador=api&accion=nueva_opinion', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: jsonData
        })
        .then(opinion => opinion.json())
        .then(resultado => {
            console.log(resultado); // Muestra resultado
            opiniones.append({
                numeroPedido: data.numeroPedido,
                autor: data.nombre,
                titulo: data.tituloOpinion,
                valoracion: data.valoracion,
                comentario: data.descripcion
            });
            mostrarReseñas(opiniones);
        }).catch(e => console.log(e));
        
    } else {
        console.log("El formulario no cumple los requisitos");
    }
    
}