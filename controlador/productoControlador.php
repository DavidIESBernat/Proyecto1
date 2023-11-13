<?php
include_once 'modelo/productoDAO.php';
include_once 'modelo/Producto.php';
include_once 'modelo/Pedido.php';
class productoControlador {
    

    public function index() {
        // Inicializamos sesion
        session_start();

        if(!isset($_SESSION['selecciones'])) {
            $_SESSION['selecciones'] = array(); 
        } else {
            if(isset($_POST['id'])){
                $pedido = new Pedido(productoDAO::obtenerProductoPorID($_POST['id']));
                array_push($_SESSION['selecciones'], $pedido);
            }
        }

        // Header
        include_once 'vista/header.php';
        // Main
        include_once 'vista/home.php';
        // Footer
        include_once 'vista/footer.php';
    }
    
    public function carta() {
        session_start();
        // Header
        include_once 'vista/header.php';
        // Main
        $productos = productoDAO::mostrarTodos();
        include_once 'vista/carta.php';
        // Footer
        include_once 'vista/footer.php';
    }

    public function carrito() {
        session_start();
        
        if(!isset($_SESSION['selecciones'])) {
            $_SESSION['selecciones'] = array(); 
        }
        // Header
        include_once 'vista/header.php';
        // Main
        include_once 'vista/carrito.php';
        // Footer
        include_once 'vista/footer.php';
    }

    public function destruir_carrito() {
        session_start();
        session_destroy();
        header("Location:".url.'?controlador=producto&accion=carrito');
    }
    public function mostrarProductos() {

        $productos = productoDAO::mostrarTodos(); // Guardamos en $productos los valores de la funcion mostrarProductos de ObtenerProductos

        include_once 'vista/mostrarProductos.php';
    }

    public function eliminarProducto() {

        $id= $_GET['id'];
        productoDAO::eliminarProductoPorID($id);
        header("Location:".url.'?controlador=producto');
    }

    public function modificarProducto() {

            $id = $_GET['id'];
            $producto = productoDAO::obtenerProductoPorID($id); // Devuelve el producto con id coincidente
            if($producto != NULL) {
                include_once 'vista/vistaEditarProducto.php';
            } else {
                echo 'ID no asignado a ningun producto';
            }
            
    }

    public function editarProducto() {

        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion= $_POST['descripcion'];
        $precio = $_POST['precio'];
        $categoria = $_POST['categoria'];
        $imagen = $_POST['imagen'];

        productoDAO::editarProductoPorID($id,$nombre,$descripcion,$precio,$categoria,$imagen);
        header("Location:".url.'?controlador=producto&accion=mostrarProductos');
    }

    public function nuevoProducto() {

        include_once 'vista/nuevoProducto.php';
    }

    public function añadirProducto() {

        $nombre = $_POST['nombre'];
        $descripcion= $_POST['descripcion'];
        $precio = $_POST['precio'];
        $categoria = $_POST['categoria'];
        $imagen = $_POST['imagen'];

        productoDAO::nuevoProducto($nombre,$descripcion,$precio,$categoria,$imagen);
        header("Location:".url.'?controlador=producto&accion=nuevoProducto');
    }
}


?>