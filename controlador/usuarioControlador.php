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
    }
}
?>