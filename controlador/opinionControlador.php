<?php
include_once 'modelo/productoDAO.php';
include_once 'modelo/pedidoDAO.php';
include_once 'modelo/usuarioDAO.php';
include_once 'modelo/categoriaDAO.php';
include_once 'modelo/Producto.php';
include_once 'modelo/Pedido.php';
include_once 'modelo/Opinion.php';

class opinionControlador {

    // Funcion que redirige a la pagina principal en caso de no introducir una accion correcta para este controlador.
    public function index() {
        header("Location:".url."?controlador=producto");
    }

    // Funcion para mostrar la vista de opiniones
    public function opiniones() {
        session_start();
        // Header
        $cantidadCarrito = pedidoDAO::cantidadTotalProductos();
        include_once 'vista/header.php';
        // Main
        include_once 'vista/reseñas.php';
        // Footer
        include_once 'vista/footer.php';
    }
}
?>