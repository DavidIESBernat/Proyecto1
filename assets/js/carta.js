
/* Funcion de evento que detecta cuando se pulsa el botón con id btn para filtrar por categorías y mostrar el contenido solicitado
Para ocultar el codigo HTML se esta haciendo uso de una clase aplicada por CSS "display_none" que contiene un display:none*/
btn.addEventListener('click', (event) => {
    let checkboxes = document.querySelectorAll('input[name="categoria"]:checked'); // Guarda las casillas checkbox marcadas
    let categoriasSeleccionadas = Array.from(checkboxes).map(checkbox => checkbox.value); //Guarda en orden en un array los valores de las checkbox seleccionadas
    console.log(categoriasSeleccionadas);

    // Muestra o oculta la sección de enlaces directos a una categoria, si se ha filtrado no se muestra, en caso contrario se mostrara
    let categoriasSection = document.querySelector('.container-categories');
    if (categoriasSeleccionadas.length > 0) { // Si se ha filtrado mas de 0 categorias se aplicara display_none a la seccion, en caso contrario la seccion se mostrara
        categoriasSection.classList.add("display_none"); 
    } else {
        categoriasSection.classList.remove("display_none");
    }

    // Muestra todas las categorías si no hay ninguna casilla marcada
    if (categoriasSeleccionadas.length === 0) {
        let categoriasFiltro = document.querySelectorAll('.categoriasFiltro'); // Obtiene todas las categorias creadas en el codigo HTML
        categoriasFiltro.forEach(categoria => {
            categoria.classList.remove("display_none"); // Elimina la etiqueta display_none para mostrar la categoria
        });
    } else {
        // Oculta las categorías que no están seleccionadas
        let categoriasFiltro = document.querySelectorAll('.categoriasFiltro'); // Obtiene todas las categorias creadas en el codigo HTML
        categoriasFiltro.forEach(categoria => {
            let categoriaId = categoria.getAttribute('id'); // Obtiene el id de categoria
            if (!categoriasSeleccionadas.includes(categoriaId)) { // Detecta si la categoria ha sido seleccionada o no, para mostrarla o no
                categoria.classList.add("display_none"); // Añade la etiqueta display_none para mostrar la categoria
            } else {
                categoria.classList.remove("display_none"); // Elimina la etiqueta display_none para mostrar la categoria
            }
        });
    }
});
