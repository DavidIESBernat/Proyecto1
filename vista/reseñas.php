<html lang="es">
    <head>
        <title>Reseñas - Restaurante Pit-Stop</title>

        <meta charset="UTF-8">
        <meta name="description" content="Descripció web">
        <meta name="keywords" content="Paraules clau">
        <meta name="author" content="David Valero">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link href="assets/css/perfil.css" rel="stylesheet" type="text/css" media="screen">
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
            <p class="col-12 col-md-6 filtrar-text">Filtrar por valoracion:
                <select id="filtroNota" onchange="filtrar()">
                    <option value="0" default>Mostrar todas</option>
                    <option value="5">5 estrellas</option>
                    <option value="4">4 estrellas</option>
                    <option value="3">3 estrellas</option>
                    <option value="2">2 estrellas</option>
                    <option value="1">1 estrella</option>
                </select> 
            </p>
            <p class="col-12 col-md-6 filtrar-text">Ordenar por: 
                <select id="filtroOrden" onchange="filtrar()">
                    <option value="original">Por defecto</option>
                    <option value="positivas">Mejor Valoracion</option>
                    <option value="negativas">Peor Valoracion</option>
                </select>
            </p>
        </div>
        <div class="container-boton">
            <!--<button class="boton_simple" onclick="mostrarFormulario()">Escribir una opinion</button>
            <button class="boton_simple" onclick="" hidden>Publicar opinion</button>-->
        </div>
        <div class="row no-margin-row seccion-reseñas">
            <!--Plantilla de la reseña a mostrar-->
            <!--
                <div class="col-10 col-md-5 reseña"> 
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
                </div>
            -->
        </div>
        <div class="formularioContainer col-12 col-md-10">
            <!--<h3 class="TituloFormulario col-12">Escribe tu opinion</h3>
            <div class="formularioAtributos row no-margin-row">
                <div class="col-12 col-md-10 col-lg-6 row">
                    <label class="col-3" for="pedido">NºPedido</label>
                    <input id="pedido" class="col-9" type="text" name="pedido">
                </div>
                <div class="col-12 col-md-10 col-lg-6 row">
                    <label class="col-3" for="nombre">Nombre</label>
                    <input id="nombre" class="col-9" type="text" name="nombre">
                </div>
                <div class="col-12 col-md-10 col-lg-6 row">
                    <label class="col-3" for="titulo">Titulo</label>
                    <input id="titulo" class="col-9" type="text" name="titulo">
                </div>
                <div class="col-12 col-md-10 col-lg-6 row">
                    <label class="col-3" for="valoracion">Valoracion </label>
                    <select id="nota" class="col-9" name="valoracion" id="">
                        <option value="5">5 estrellas</option>
                        <option value="4">4 estrellas</option>
                        <option value="3">3 estrellas</option>
                        <option value="2">2 estrellas</option>
                        <option value="1">1 estrella</option>
                    </select>
                </div>
                <div class="col-12 row descripcionContainer">
                    <label class="col-3" for="descripcion">Descripcion</label>
                    <textarea id="descripcion" class="col-9 no-margin-row descripcionInput" type="text" name="descripcion" placeholder="Describe tu opinion..."></textarea>
                </div>
            </div>-->
        </div>
        <script src="assets/js/opiniones.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    </body>
</html>