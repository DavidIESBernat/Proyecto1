<?php
include_once 'modelo/productoDAO.php';
include_once 'modelo/pedidoDAO.php';
include_once 'modelo/usuarioDAO.php';
include_once 'modelo/categoriaDAO.php';
include_once 'modelo/Producto.php';
include_once 'modelo/Pedido.php';
include_once 'modelo/OpinionDAO.php';
include_once 'modelo/Opinion.php';

class apiControlador{    
 
    public function index(){
       
        // Funcion para mostrar las opiniones
        if($_GET["accion"] == 'mostrar_opiniones') {
            $opiniones = $this->mostrarOpiniones();
            echo json_encode($opiniones, JSON_UNESCAPED_UNICODE);
            return;
        }   
    }

    // Funcion para obtener todas las opiniones de los pedidos
    public function mostrarOpiniones() {
        session_start();
        // Header
        $cantidadCarrito = pedidoDAO::cantidadTotalProductos();
        include_once 'vista/header.php';
        // Main
        $opiniones = opinionDAO::obtenerOpiniones();
        include_once 'vista/reseñas.php';
        // Footer
        include_once 'vista/footer.php';
    }
}
?>