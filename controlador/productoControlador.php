<?php
include_once 'modelo/obtenerProducto.php';
class productoControlador {
    

    public function index() {
        // Inicializamos sesion
        session_start();

        if(!isset($_SESSION['selecciones'])) {
            $_SESSION['selecciones'] = array(); 
        } else {
            if(isset($_POST['id'])){
                $pedido = new Pedido(obtenerProducto::obtenerProductoPorID($POST['id']));
                array_push($_SESSION['selecciones'], $pedido);
            }
        }

        // Header

        // Main
        include_once 'vista/home.php';
        // Footer

    }
    
    public function carta() {
        session_start();
        // Header
        
        // Main
        $productos = obtenerProducto::mostrarTodos();
        include_once 'vista/carta.php';
        // Footer

    }

    public function carrito() {
        session_start();
        // Header
        
        // Main
        include_once 'vista/carrito.php';
        // Footer

    }

    public function mostrarProductos() {

        $productos = obtenerProducto::mostrarTodos(); // Guardamos en $productos los valores de la funcion mostrarProductos de ObtenerProductos

        include_once 'vista/mostrarProductos.php';
    }

    public function eliminarProducto() {

        $id= $_GET['id'];
        obtenerProducto::eliminarProductoPorID($id);
        header("Location:".url.'?controlador=producto');
    }

    public function modificarProducto() {

            $id = $_GET['id'];
            $producto = obtenerProducto::obtenerProductoPorID($id); // Devuelve el producto con id coincidente
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

        obtenerProducto::editarProductoPorID($id,$nombre,$descripcion,$precio,$categoria,$imagen);
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

        obtenerProducto::nuevoProducto($nombre,$descripcion,$precio,$categoria,$imagen);
        header("Location:".url.'?controlador=producto&accion=nuevoProducto');
    }
}


?>