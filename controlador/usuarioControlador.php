<?php
include_once 'modelo/productoDAO.php';
include_once 'modelo/Producto.php';
include_once 'modelo/Pedido.php';

// Controlador del usuario, login, modificar contraseña etc...
class usuarioControlador {

    public function login() {
        // Header
        include_once 'vista/header.php';
        // Main
        include_once 'vista/login.php';
        // Footer
        include_once 'vista/footer.php';
    }
}
?>