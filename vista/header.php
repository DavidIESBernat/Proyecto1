<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante Pit-Stop</title>
    
    <meta charset="UTF-8">
    <meta name="description" content="Descripció web">
    <meta name="keywords" content="Paraules clau">
    <meta name="author" content="David Valero">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/full_estil.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body class="color">
<nav class="navbar navbar-expand-lg fixed-top">
  <a class="navbar-brand logo" href="<?=url.'?controlador=producto'?>">
    <img class="logo-img" src="assets/images/logo.svg" width="200" height="44" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse items" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item nav-item-hover">
        <a class="nav-link" href="<?=url.'?controlador=producto'?>">Inicio</a>
        <div class="divisor"></div>
      </li>
      <li class="nav-item nav-item-hover">
        <a class="nav-link" href="<?=url.'?controlador=producto&accion=carta'?>">Carta</a>
        <div class="divisor"></div>
      </li>
      <li class="nav-item nav-item-hover">
        <a class="nav-link">Calendario</a>
        <div class="divisor"></div>
      </li>
      <li class="nav-item nav-item-hover">
        <a class="nav-link">Contacto</a>
        <div class="divisor"></div>
      </li>
      <!--<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>-->
    </ul>
    
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <form class="form-inline my-2 my-lg-0 d-flex flex-direction-row">
          <input class="form-control mr-sm-2 input-buscar" type="search" placeholder="Buscar" aria-label="Buscar">
          <button class="btn btn-custom my-2 my-sm-0" type="submit"><img width="20" height="auto" src="assets/images/lupa.svg"></button>
        </form>
      </li>
      <?php /* CAMBIAR BOTON SI HA INICIADO SESION O NO */ $login = 0; if($login == 0) {?>
        <li class="nav-item nav-item-hover login">
        <?php
          if(isset($_SESSION['usuario'])) {
            echo '<a class="nav-link" href="'.url.'?controlador=usuario&accion=perfil">';
            echo $_SESSION['usuario']['nombre'];
            echo "</a>";
          } else {
            echo '<a class="nav-link" href="'.url.'?controlador=usuario&accion=login">Iniciar Sesión</a>';
          }
        ?>
        </li>
      <?php } else { ?>
        <li class="nav-item nav-item-hover login">
        <a class="nav-link" href="<?=url.'?controlador=usuario&accion=perfilUsuario'?>">Nombre Usuario</a>
        </li>
      <?php } ?>
      <li class="nav-item nav-item-hover">
        <a class="nav-link no-border-link button-cartshop" href="<?=url.'?controlador=pedido&accion=carrito'?>">
            <div>Carrito <img width="20" height="20" src="assets/images/carrito_compra.png" alt="imagen_carrito"></div>
        </a>
      </li>
    </ul>
  </div>
</nav>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>