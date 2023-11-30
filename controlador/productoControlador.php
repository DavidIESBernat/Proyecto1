<?php
include_once 'modelo/productoDAO.php';
include_once 'modelo/Producto.php';
include_once 'modelo/Pedido.php';
class productoControlador {
    

    public function index() {
        // Inicializamos sesion
        session_start();

        if (!isset($_SESSION['selecciones'])) {
            $_SESSION['selecciones'] = array(); 
        } else {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                productoDAO::pedido($id);
            }
        }
    

        // Header
        include_once 'vista/header.php';
        // Main
        include_once 'vista/home.php';
        // Footer
        include_once 'vista/footer.php';
    }
    
    public function header() {
        include_once 'vista/header.php';
    }
    public function carta() {
        session_start();
        // Header
        include_once 'vista/header.php';
        // Main
        $categorias = productoDAO::obtenerCategorias();
        $productos = productoDAO::obtenerProductos();
        include_once 'vista/carta.php';
        // Footer
        include_once 'vista/footer.php';
    }

    public function carrito() {
        session_start();
        
        if(!isset($_SESSION['selecciones'])) { // Si la session no existe la crea
            $_SESSION['selecciones'] = array(); 
        }
        
        if(isset($_POST['Add'])) { // Sumar la cantidad del mismo producto
            $pedido = $_SESSION['selecciones'][$_POST['Add']];
            $pedido->setCantidad($pedido->getCantidad()+1);
        } else if(isset($_POST['Del'])) { // Restar la cantidad de producto del carrito o eliminar si la cantidad es igual a 0
            $pedido = $_SESSION['selecciones'][$_POST['Del']];
            if($pedido->getCantidad()==1) {
                unset($_SESSION['selecciones'][$_POST['Del']]);
                $_SESSION['selecciones'] = array_values($_SESSION['selecciones']); // Reindexar el array
            } else {
                $pedido->setCantidad($pedido->getCantidad()-1);
            }
        } else if(isset($_POST['Eliminar'])) { // Eliminar producto del carrito
            unset($_SESSION['selecciones'][$_POST['Eliminar']]);
            $_SESSION['selecciones'] = array_values($_SESSION['selecciones']); // Reindexar el array
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

        $categorias = productoDAO::obtenerCategorias();
        $productos = productoDAO::obtenerProductos(); // Guardamos en $productos los valores de la funcion mostrarProductos de ObtenerProductos

        include_once 'vista/mostrarProductos.php';
    }

    public function eliminarProducto() {

        $id= $_POST['id'];
        productoDAO::eliminarProductoPorID($id);
        header("Location:".url.'?controlador=producto&accion=mostrarProductos');
    }

    public function modificarProducto() {

            $id = $_POST['id'];
            $categorias = productoDAO::obtenerCategorias();
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
        $categorias = productoDAO::obtenerCategorias();
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

    public function nuevaCategoria() {
        include_once 'vista/nuevaCategoria.php';
    }

    public function añadirCategoria() {

        $nombre = $_POST['nombre'];
        $descripcion= $_POST['descripcion'];
        $imagen = $_POST['imagen'];

        productoDAO::nuevaCategoria($nombre,$descripcion,$imagen);
        header("Location:".url.'?controlador=producto&accion=nuevaCategoria');
    }
}
?>