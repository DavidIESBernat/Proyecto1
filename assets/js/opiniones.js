let resultado = fetch("http://pitstop.com/?controlador=api&accion=mostrar_opiniones")
    .then(data => data.json())
    .then(resultado => {
        console.log(resultado);

        // Obtener el contenedor de reseñas
        const contenedorReseñas = document.querySelector('.seccion-reseñas');

        resultado.forEach(opinion => {
            // Crea elemento html tipo div para reseña, lo guarda en la variable reseña.
            const reseña = document.createElement('div');
            // Añade las clases siguientes al elemento div de reseña.
            reseña.classList.add('col-10', 'col-md-5', 'reseña');
            // Añade el codigo html con los valores de opinion al contenido de reseña.
            reseña.innerHTML = `<div class="flex-between"><p class="numComanda" id="comanda">${opinion.pedido_id} - ${opinion.autor}</p><p class="fecha" id="fecha">${opinion.fecha}</p></div><div class="flex-between"><h3 id="titulo">${opinion.titulo}</h3><div class="valoraciones" id="nota"><img alt="reseña con valoración de ${opinion.nota} estrellas" src="assets/images/rate-${opinion.nota}stars.svg"></div></div><p class="descripcion" id="opinion">${opinion.comentario}</p>`;
            // Agregar la reseña al contenedor general de reseñas
            contenedorReseñas.appendChild(reseña);
        });

    })