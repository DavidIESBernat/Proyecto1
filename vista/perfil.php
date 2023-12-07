<!DOCTYPE html PUBLIC>
<html lang="es">
<head>
    <title>Perfil de Usuario - Restaurante Pit-Stop</title>

    <meta charset="UTF-8">
    <meta name="description" content="Descripció web">
    <meta name="keywords" content="Paraules clau">
    <meta name="author" content="David Valero">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/full_estil.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/css/perfil.css" rel="stylesheet" type="text/css" media="screen">
    
</head>
<body>
    <div class="perfilContainer">
        <div class="titulo">
            <h1 class="">Hola <?= $usuario->getNombre(); ?> <?=$usuario->getApellido();?></h1>
        </div>
        <div class="formularioContainer">
            <form action="<?=url?>?controlador=usuario&accion=modificarUsuario" method="POST" class="formularioAtributos row no-margin-row">
            <input type="text" name="username" value="<?=$usuario->getUsername();?>" hidden>
                <div class="col-12 col-md-10  col-lg-6 row">
                    <label class="col-3" for="username">Username</label>
                    <input class="col-9"type="text" value="<?=$usuario->getUsername();?>" disabled>
                </div>
                <div class="col-12 col-md-10 col-lg-6 row">
                    <label class="col-3" for="nombre">Nombre</label>
                    <input class="col-9" type="text" name="nombre" value="<?=$usuario->getNombre();?>" required>
                </div>
                <div class="col-12 col-md-10  col-lg-6 row">
                    <label class="col-3" for="apellido">Apellido</label>
                    <input class="col-9" type="text" name="apellido" value="<?=$usuario->getApellido();?>">
                </div>
                <div class="col-12 col-md-10 col-lg-6 row">
                    <label class="col-3" for="email">Email</label>
                    <input class="col-9" type="text" name="email" value="<?=$usuario->getEmail();?>">
                </div>
                <div class="col-12 col-md-10  col-lg-6 row">
                    <label class="col-3" for="email">Telefono</label>
                    <input class="col-9" type="text" name="numero" value="<?=$usuario->getNumeroTlf();?>">
                </div>
                <div class="col-12 col-md-10 col-lg-6 row">
                    <label class="col-3" for="email">Direccion</label>
                    <input class="col-9" type="text" name="direccion" value="<?=$usuario->getDireccion();?>">
                </div>
                <div class="col-12 col-md-10 col-lg-6 row">
                    <label class="col-3" for="email">Poblacion</label>
                    <input class="col-9" type="text" name="poblacion" value="<?=$usuario->getPoblacion();?>">
                </div>
                <div class="col-12 col-md-10 col-lg-6 row">
                    <div class="col-3"></div>
                    <input class="col-9" type="submit" value="Aplicar Cambios"> 
                </div>
            </form>
        </div>
        <div class="opciones">
            <form action="<?=url?>?controlador=usuario&accion=ultimosPedidos" method="POST">
                <button type="submit" value="modificar">Ultimos Pedidos</button>
            </form>
            <!-- Si se ha iniciado sesion con el usuario admin se mostrara un boton para acceder a las opciones de administrador-->
            <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']['username'] == "admin") { ?>
                <?php if(isset($_COOKIE['UltimoPedido'])) { ?>
                    <p>El costo total del ultimo pedido es: <?=$_COOKIE['UltimoPedido']?> €</p>
                <?php }?>
                <form action="<?=url?>?controlador=producto&accion=mostrarProductos" method="POST">
                    <button type="submit">Administración</button>
                </form>
            <?php } ?>
            <form action="<?=url?>?controlador=usuario&accion=logout" method="POST">
                <button type="submit" value="logout">Cerrar Sesión</button>
            </form>
        </div>
    </div>
</body>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</html>