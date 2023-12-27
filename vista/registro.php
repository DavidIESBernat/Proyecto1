<!DOCTYPE html PUBLIC>
<html lang="es">
<head>
    <title>Login - Restaurante Pit-Stop</title>

    <meta charset="UTF-8">
    <meta name="description" content="Descripció web">
    <meta name="keywords" content="Paraules clau">
    <meta name="author" content="David Valero">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="assets/css/login.css" rel="stylesheet" type="text/css" media="screen">
    

</head>
<body>
    <div class="containerLogin">
        <form class="formularioLogin" action="<?=url?>?controlador=usuario&accion=verificarRegistro" method="POST">
            <h1 class="titulo_login">Regístrate</h1>
            <div class="campo_texto">
                <input class="inputFormulario" type="email" name="email" required></input>
                <label class="loginLabel" for="email">Email</label>
            </div>
            <div class="campo_texto">
                <input class="inputFormulario" type="text" name="username" required></input>
                <label class="loginLabel" for="username">Usuario</label>
            </div>
            <div class="campo_texto">
                <input class="inputFormulario" type="password" name="password" required></input>
                <label class="loginLabel" for="password">Contraseña</label>
            </div>
            <?php
                // Comprueba si se ha enviado por el formulario valores erroneos y muestra un mensaje de error
                if (isset($_SESSION["error_message"])) {
                    echo "<div class='login_error'>".$_SESSION["error_message"]."</div>";
                    // Limpia el mensaje de error para que no se muestre nuevamente
                    unset($_SESSION["error_message"]);
                }
            ?>
            <div class="align-center">
                <input type="checkbox" name="terminos" value="aceptado" required><a href="">&nbsp;Aceptar terminos de uso y condiciones</a></input>
            </div>  
            <div class="botonRegistro">
                <input class="boton_simple" type="submit" name="enviar"value="Regístrate"></input>
            </div>
            <p class="align-center">¿Ya eres miembro?<a href="<?=url?>?controlador=usuario&accion=login">&nbsp;Iniciar sesion</a></p>
        </form>
    </div>
</body>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</html>