<?php
include_once 'modelo/productoDAO.php';
include_once 'modelo/Producto.php';
include_once 'modelo/Pedido.php';

// Controlador del usuario, login, modificar contraseña etc...
class usuarioControlador {

    // Funcion para cargar la vista de iniciar sesion
    public function login() {
        // Header
        include_once 'vista/header.php';
        // Main
        include_once 'vista/login.php';
        // Footer
        include_once 'vista/footer.php';
    }

    // Funcion que verifica si el usuario existe
    public function verificarLogin() {
        $username = $_POST['username'];
        $contraseña = $_POST['password'];

        $usuario = usuarioDAO::verificarUsuario($username);

        if (isset($usuario[$_POST["username"]]) && ($usuario[$_POST["username"]]==$_POST["password"]) ){

            session_start();
            if(!array_key_exists("nomusuari", $_SESSION)) {
                // Usuari no existeix i per tant, es crea
                $_SESSION["nomusuari"] = $_POST["usuari"];
                header("location:compte.php"); 
            } else {
                // Usuari existex, per tant, no es crea cap usuari
                header("location:login.php");
            }
        } else {
            echo "Error d'usuari";
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header(url."?controlador=producto");
    }
}
?>