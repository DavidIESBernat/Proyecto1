<!DOCTYPE html PUBLIC>
<html lang="es">
<head>
    <title>Carrito - Restaurante Pit-Stop</title>

    <meta charset="UTF-8">
    <meta name="description" content="Descripció web">
    <meta name="keywords" content="Paraules clau">
    <meta name="author" content="Autor">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/full_estil.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/css/login.css" rel="stylesheet" type="text/css" media="screen">
    

</head>
<body>
    <div class="containerLogin">
        <form class="formularioLogin" action="" method="POST">
            <h1 class="titulo_login">Iniciar sesión</h1>
            <div class="campo_texto">
                <input class="inputFormulario" type="text" name="usuario" id="usuario" required></input>
                <label class="loginLabel" for="usuario">Usuario</label>
            </div>
            <div class="campo_texto">
                <input class="inputFormulario" type="password" name="contrasenya" id="contrasenya" required></input>
                <label class="loginLabel" for="contrasenya">Contraseña</label>
            </div>
            <input class="boton_enviar" type="submit" name="enviar"value="Iniciar sesion"></input>
        </form>
    </div>
</body>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</html>