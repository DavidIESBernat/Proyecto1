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
                <input type="text" id="dropdown" />
                <!--Dropdown con Checkboxs - Uso de JavaScript -->
            </p>
            <p class="col-12 col-md-6 filtrar-text ">Ordenar por: 
            <select>
                <option value="original">Por defecto</option>
                <option value="ascendente">Valoracion Ascendente</option>
                <option value="descendente">Valoracion Descendente</option>
            </select>
        </p>
        </div>
        <div class="row no-margin-row seccion-reseñas"> 
            <!--<div class="col-10 col-md-5 reseña"> 
                <div class="flex-between"> 
                    <p class="numComanda" id="comanda">Nº120 - David</p> 
                    <p class="fecha" id="fecha">09/01/2024</p> 
                </div>
                <div class="flex-between">
                    <h3 id="titulo">Titulo de la reseña</h3> 
                    <div class="valoraciones" id="nota">
                        <img alt="reseña con valoracion de 5 estrellas" src="assets/images/rate-5stars.svg">
                    </div> 
                </div>
                <p class="descripcion" id="opinion">Esto es una reseña de prueba sobre un pedido realizado en la web del restaurante pit-stop creada por David Valero Arevalo para el proyecto 1 de Disseny d'Aplicacions Web 2</p>
            </div>-->
        </div>
        <script src="assets/js/opiniones.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    </body>
</html>