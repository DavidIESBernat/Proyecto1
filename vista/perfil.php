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
    <link href="assets/css/login.css" rel="stylesheet" type="text/css" media="screen">
    
</head>
<body>
    <div class="perfilContainer">
        <div class="opciones">
            <!-- Si se ha iniciado sesion con el usuario admin se mostrara un boton para acceder a las opciones de administrador-->
            <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']['username'] == "admin") { ?>
                <form action="<?=url?>?controlador=producto&accion=mostrarProductos" method="POST">
                    <button type="submit">Gestionar Productos</button>
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