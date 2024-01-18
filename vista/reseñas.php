<html lang="es">
    <head>
        <title>Reseñas - Restaurante Pit-Stop</title>

        <meta charset="UTF-8">
        <meta name="description" content="Descripció web">
        <meta name="keywords" content="Paraules clau">
        <meta name="author" content="David Valero">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link href="assets/css/reseñas.css" rel="stylesheet" type="text/css" media="screen">

    </head>
    <body class="bg-black">
        <div class="section-header bg-white text-center d-flex align-items-center justify-content-center"> <!--Titulo de la pagina de reseñas-->
            <div class="header-text"> 
                <h2 class="title-section">Reseñas y Valoraciones</h2>
                <p class="text-section">¡Descubre las reseñas y valoraciones de nuestros clientes y deja la tuya!</p>
            </div>
        </div>
        <div class="row no-margin-row seccion-filtrar">
            <p class="col-12 col-md-6 filtrar-text ">Filtrar por:
                <input type="text" id="dropdown1" />
                <!--Dropdown con Checkbox - Uso de JavaScript -->
            </p>
            <p class="col-12 col-md-6 filtrar-text ">Ordenar por: 
            <select>
                <option value="original">Por defecto</option>
                <option value="ascendente">Valoracion Ascendente</option>
                <option value="descendente">Valoracion Descendente</option>
            </select>
        </p>
        </div>
        <div class="row no-margin-row seccion-reseñas"> <!--Seccion que incluye todas las reseñas-->
            <div class="col-10 col-md-5 reseña"> <!--Contenedor de una reseña-->
                <div class="flex-between"> <!--Seccion que incluye el numero de  comanda a la que hace referencia la reseña y la fecha de la misma-->
                    <p class="numComanda">Nº120 - David</p> <!--Numero de la Comanda y nombre de la persona que escribe la reseña-->
                    <p class="fecha">09/01/2024</p> <!--Fecha de de la reseña-->
                </div>
                <div class="flex-between">
                    <h3>Titulo de la reseña</h3> <!--Titulo de la Reseña-->
                    <div class="valoraciones">
                        <img alt="reseña con valoracion de 5 estrellas" src="assets/images/rate-5stars.svg">
                    </div> <!--Valoracion de la reseña-->
                </div>
                <p class="descripcion">Esto es una reseña de prueba sobre un pedido realizado en la web del restaurante pit-stop creada por David Valero Arevalo para el proyecto 1 de Disseny d'Aplicacions Web 2</p> <!--Descripcion de la reseña-->
            </div>
            
            <?php foreach ($opiniones as $opinion) {?>
            <div class="col-10 col-md-5 reseña"> <!--Contenedor de una reseña-->
                <div class="flex-between"> <!--Seccion que incluye el numero de  comanda a la que hace referencia la reseña y la fecha de la misma-->
                    <p class="numComanda">Nº<?= $opinion->getPedido_id()?> - <?=$opinion->getAutor()?> </p> <!--Numero de la Comanda y nombre de la persona que escribe la reseña-->
                    <p class="fecha"><?= $opinion->getFecha()?></p> <!--Fecha de de la reseña-->
                </div>
                <div class="flex-between">
                    <h3><?= $opinion->getTitulo()?></h3> <!--Titulo de la Reseña-->
                    <div class="valoraciones"> <!--En base a la valoracion muestra las estrellas correspondientes-->
                    <?php
                        // Switch que detecta la nota proporcionada por el usuario para mostrar las estrellas correspondientes en base a la nota.
                        switch($opinion->getNota()) {
                            case 1:
                                ?><img alt="reseña con valoracion de 1 estrella" src="assets/images/rate-1stars.svg"><?php
                                break;
                            case 2:
                                ?><img alt="reseña con valoracion de 2 estrellas" src="assets/images/rate-2stars.svg"><?php
                                break;
                            case 3:
                                ?><img alt="reseña con valoracion de 3 estrellas" src="assets/images/rate-3stars.svg"><?php
                                break;
                            case 4:
                                ?><img alt="reseña con valoracion de 4 estrellas" src="assets/images/rate-4stars.svg"><?php
                                break;
                            case 5:
                                ?><img alt="reseña con valoracion de 5 estrellas" src="assets/images/rate-5stars.svg"><?php
                                break;
                            default:
                                // Si la nota no es un valor entre 1 y 5
                        } 
                    ?>
                    </div> 
                </div>
                <p class="descripcion"><?=$opinion->getComentario()?></p> <!--Descripcion de la reseña-->
            </div>
            <?php } ?>
        <div>
        <script src="assets/js/opiniones.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/dropdown-checkbox.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    </body>
</html>