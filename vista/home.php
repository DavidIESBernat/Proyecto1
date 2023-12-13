<!DOCTYPE html PUBLIC>
<html lang="es">
<head>
    <title>Home - Restaurante Pit-Stop</title>

    <meta charset="UTF-8">
    <meta name="description" content="Descripció web">
    <meta name="keywords" content="Paraules clau">
    <meta name="author" content="David Valero">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/full_estil.css" rel="stylesheet" type="text/css" media="screen">

</head>
<body class="bg-black">
    <!--Seccion de Banner-->
    <div class="section-banner">
      <h1 class="title banner-text">Restaurante Pit-Stop</h1>
    </div>
    <!--Seccion Cabecera-->
    <div class="section-header bg-white text-center d-flex align-items-center justify-content-center ">
      <div class="header-text">
        <h2 class="title-section">¡Disfruta de el deporte en el restaurante <strong class="text-red">Pit-Stop</strong>!</h2>
        <p class="text-section">Disfruta de una buena comida en un increible restaurante deportivo con vistas al Circuit.</p>
      </div>
    </div>
    <!--Seccion Elementos Seleccionables-->
    <div class="row no-margin-row section-elements">
      <!--Elemento Carta-->
      <a href="<?php $url?>?controlador=producto&accion=carta" class="col-12 col-md-6 row no-margin-row element d-flex align-items-center">
        <div class="col-12 col-md-3 element-image carta"></div>
        <div class="col-12 col-md-3 element-text d-flex justify-content-between">
          <div>
            <h2 class="element-title">Carta</h2>
            <p class="element-description">
              Disfruta de hamburguesas, pizza, pasta,  
              ensaladas, refrescos y postres. ¡Descubre 
              nuestra carta por ti mismo!</p>
          </div>
          <div class="button-discover">
            <p class="d-flex align-items-center">Descubrir<svg width="15" id="arrow_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="m31.71 15.29-10-10-1.42 1.42 8.3 8.29H0v2h28.59l-8.29 8.29 1.41 1.41 10-10a1 1 0 0 0 0-1.41z" data-name="3-Arrow Right"/></svg></p>
          </div>
        </div>
      </a>
      <!--Elemento Calendario-->
      <a class="col-12 col-md-6 row no-margin-row element d-flex align-items-center ">
        <div class="col-12 col-md-3 element-image calendario"></div>
        <div class="col-12 col-md-3 element-text d-flex justify-content-between">
          <div>
            <h2 class="element-title">Calendario</h2>
            <p class="element-description">
              Descubre nuestro calendario y horario en 
              base a los proximos eventos deportivos 
              que podras disfrutar desde nuestro 
              restaurante.</p>
          </div>
          <div class="button-discover ">
            <p class="d-flex align-items-center">Descubrir<svg width="15" id="arrow_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="m31.71 15.29-10-10-1.42 1.42 8.3 8.29H0v2h28.59l-8.29 8.29 1.41 1.41 10-10a1 1 0 0 0 0-1.41z" data-name="3-Arrow Right"/></svg></p>
          </div>
        </div>
      </a>
    </div>
    <!--Seccion Cabecera-->
    <div class="section-info bg-white">
      <div class="row">
        <div class="col-12 col-md-4">
          <h2 class="title-info">¿Qué hacer y ver en el restaurante Pit-Stop?</h2>
          <p class="subtitle-info">
            Vive una experiencia inolvidable  en el 
            restaurante deportivo del Circuit de 
            Barcelona-Catalunya en familia, con amigos
            o acompañado de aficionados al deporte.</p>
        </div>
        <div class="description-box col-12 col-md-8">
          <p class="description-info">
            El restaurante <strong>Pit-Stop</strong> abre sus puertas a los aficionados del deporte que quieran disfrutar de una experiencia culinaria
            con increíbles vistas  de la recta principal  y el paddock del <strong>Circuit de Barcelona-Catalunya</strong> en el que podrán disfrutar de todos
            los eventos deportivos del momento.
          </p>
          <p class="description-info">
            Consulta nuestros horarios para descubrir cuando venir a disfrutar de tus <strong>eventos deportivos</strong> favoritos, futbol, tenis,
            básquet, carreras y mucho mas...
          </p>
          <p class="description-info">
            Podrás disfrutar de increíbles contenidos del motor como: Formula 1, Formula E, IndyCar, MotoGP o si eres mas de futbol
            también podrás ver contenidos en directo de LaLiga, Champions League y Europa League o la Premier League.
            Aunque si lo tuyo es el tenis o el básquet podrás ver la Liga ACB, US Open, Copa Davis, el ATP o Roland Garros.
          </p>
          <p class="description-info">
            Estas experiencias y muchas mas aqui en el Pit-Lane, ¡te esperamos en el <strong>Circuit de Barcelona-Catalunya</strong>.
          </p>
        </div>
      </div>
    </div>
    <div class="section-info-bottom"></div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>