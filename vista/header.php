<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Descripció web">
    <meta name="keywords" content="Paraules clau">
    <meta name="author" content="David Valero">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" type="image/ico" href="assets/images/favicon.ico"/>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/full_estil.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/css/header.css" rel="stylesheet" type="text/css" media="screen">
</head>

<body class="color">
  <nav class="navbar navbar-expand-lg fixed-top header-navbar">
    <a class="navbar-brand logo" href="<?=url.'?controlador=producto'?>">
      <img class="logo-img" src="assets/images/logo.svg" width="200" height="44" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon icono"></span>
    </button>
    <div class="collapse navbar-collapse items" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item nav-item-hover botonHeader">
          <a class="nav-link botonHeaderText" href="<?=url.'?controlador=producto'?>">Inicio</a>
        </li>
        <li class="nav-item nav-item-hover botonHeader ">
          <a class="nav-link botonHeaderText" href="<?=url.'?controlador=producto&accion=carta'?>">Carta</a>
        </li>
        <li class="nav-item nav-item-hover botonHeader">
          <a class="nav-link botonHeaderText">Calendario</a>
        </li>
        <li class="nav-item nav-item-hover botonHeader">
        <a class="nav-link botonHeaderText" href="<?=url.'?controlador=opinion&accion=opiniones'?>">Reseñas</a>
        </li>
      </ul>
      <ul class="navbar-nav mr-auto margen-buscador">
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 d-flex flex-direction-row">
            <input class="form-control mr-sm-2 input-buscar" type="search" placeholder="Buscar" aria-label="Buscar">
            <button class="btn btn-custom my-2 my-sm-0" type="submit"><img width="20" height="auto" src="assets/images/lupa.svg"></button>
          </form>
        </li>
      </ul>
      <ul class="navbar-nav mr-auto margen-derecho">
        <?php /* CAMBIAR BOTON SI HA INICIADO SESION O NO */ 
          if(isset($_SESSION['usuario'])) {?>
            <li class='nav-item nav-item-hover'>
              <a class="nav-link account button-cartshop" href="<?=url.'?controlador=usuario&accion=perfil'?>"><?=$_SESSION['usuario']['username']?>
                <img width='20' height='20' class="account_image" src='assets/images/account.png' alt="perfil">
              </a>
            </li>
          <?php } else { ?>
            <li class='nav-item nav-item-hover login'>
              <a class="nav-link" href="<?=url.'?controlador=usuario&accion=login'?>">Iniciar Sesión</a>
            </li>
          <?php } ?>
        <li class="nav-item nav-item-hover">
          <a class="nav-link no-border-link button-cartshop" href="<?=url.'?controlador=pedido&accion=carrito'?>">
              Carrito<img width="20" height="20" src="assets/images/carrito_compra.png" alt="imagen_carrito">
              <?php 
                if(isset($_SESSION['selecciones']) && count($_SESSION['selecciones']) >= 1) {
                  ?><span class="cantidadCarrito"><?=" (".$cantidadCarrito.") "?></span><?php
                }
              ?>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>