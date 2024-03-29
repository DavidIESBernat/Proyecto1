<!DOCTYPE html PUBLIC>
<html lang="es">
<head>
    <title><?= $usuario->getNombre(); ?> - Restaurante Pit-Stop</title>

    <meta charset="UTF-8">
    <meta name="description" content="Descripció web">
    <meta name="keywords" content="Paraules clau">
    <meta name="author" content="David Valero">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="assets/css/perfil.css" rel="stylesheet" type="text/css" media="screen">
    
</head>
<body class="row no-margin-row">
    <div class="mainContainer">
        <div class="perfilContainer col-12 col-md-10">
            <div class="tituloContainer">
                <h1>Hola <?= $usuario->getNombre(); ?> <?=$usuario->getApellido();?></h1>
            </div>
            <div class="formularioContainer">
                <form action="<?=url?>?controlador=usuario&accion=modificarUsuario" method="POST" class="formularioAtributos row no-margin-row">
                <input type="text" name="username" value="<?=$usuario->getUsername();?>" hidden>
                    <div class="col-12 col-md-10 col-lg-6 row">
                        <label class="col-3" for="username">Username</label>
                        <input class="col-9" type="text" value="<?=$usuario->getUsername();?>" disabled>
                    </div>
                    <div class="col-12 col-md-10 col-lg-6 row">
                        <label class="col-3" for="email">Poblacion</label>
                        <input class="col-9" type="text" name="poblacion" value="<?=$usuario->getPoblacion();?>">
                    </div>
                    <div class="col-12 col-md-10 col-lg-6 row">
                        <label class="col-3" for="nombre">Nombre</label>
                        <input class="col-9" type="text" name="nombre" value="<?=$usuario->getNombre();?>" required>
                    </div>
                    <div class="col-12 col-md-10 col-lg-6 row">
                        <label class="col-3" for="email">Direccion</label>
                        <input class="col-9" type="text" name="direccion" value="<?=$usuario->getDireccion();?>">
                    </div>
                    <div class="col-12 col-md-10  col-lg-6 row">
                        <label class="col-3" for="apellido">Apellido</label>
                        <input class="col-9" type="text" name="apellido" value="<?=$usuario->getApellido();?>">
                    </div>
                    <div class="col-12 col-md-10  col-lg-6 row">
                        <label class="col-3" for="email">Telefono</label>
                        <input class="col-9" type="text" name="numero" value="<?=$usuario->getNumeroTlf();?>">
                    </div>
                    <div class="col-12 col-md-10 col-lg-6 row">
                        <label class="col-3" for="email">Email</label>
                        <input class="col-9" type="text" name="email" value="<?=$usuario->getEmail();?>">
                    </div>
                    <div class="col-12 col-md-10 col-lg-6 row">
                        <div class="col-3"></div>
                        <input class="col-9 boton_simple aplicar_cambios" type="submit" value="Aplicar Cambios"> 
                    </div>
                </form>
            </div>
            <div class="containerInfo">
                <?php if(isset($_COOKIE['PrecioUltimoPedido'])) { ?>
                    <div class="ultimaCompra">El costo total del ultimo pedido es: <?=number_format($_COOKIE['PrecioUltimoPedido'], 2,',','.')?> €</div>
                <?php }?>
                <div class="opciones">
                    <form action="<?=url?>?controlador=pedido&accion=cargarPedido" method="POST">
                        <button class="boton_simple" type="submit" value="modificar">Mis Pedidos</button>
                    </form>
                    <!-- Si se ha iniciado sesion con el usuario admin se mostrara un boton para acceder a las opciones de administrador-->
                    <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']['username'] == "admin") { ?>
                        <form action="<?=url?>?controlador=producto&accion=mostrarProductos" method="POST">
                            <button class="boton_simple" type="submit">Administración</button>
                        </form>
                    <?php } ?>
                    <form action="<?=url?>?controlador=usuario&accion=logout" method="POST">
                        <button class="boton_simple" type="submit" value="logout">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>