<?php
include_once 'modelo/productoDAO.php';
include_once 'modelo/pedidoDAO.php';
include_once 'modelo/usuarioDAO.php';
include_once 'modelo/Producto.php';
include_once 'modelo/Pedido.php';

class productoControlador {

    // Funcion index, esta funcion es la funcion principal que se carga siempre que no tenemos una accion, en ella carga la pagina home
    // Tambien si seleccionamos un producto para añadir al carrito lo creara llamando a la funcion pedido
    public function index() {
        // Inicializamos sesion
        session_start();

        if (!isset($_SESSION['selecciones'])) {
            $_SESSION['selecciones'] = array(); 
        } else {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                pedidoDAO::pedido($id);
            }
        }
    

        // Header
        include_once 'vista/header.php';
        // Main
        include_once 'vista/home.php';
        // Footer
        include_once 'vista/footer.php';
    }
    
    // Funcion que muestra el header
    public function header() {
        include_once 'vista/header.php';
    }
    // Funcion que muestra  
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

    // Funcion para mostrar todos los productos en modo Administrador
    public function mostrarProductos() {

        $categorias = productoDAO::obtenerCategorias();
        $productos = productoDAO::obtenerProductos(); // Guardamos en $productos los valores de la funcion mostrarProductos de ObtenerProductos

        include_once 'vista/mostrarProductos.php';
    }

    // Funcion para eliminar un producto en la ventana de Administrador
    public function eliminarProducto() {

        $id= $_POST['id'];
        productoDAO::eliminarProductoPorID($id);
        header("Location:".url.'?controlador=producto&accion=mostrarProductos');
    }

    // Funcion para modificar un producto en la ventana de Administrador
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

    // Funcion para editar un producto en la ventana de administrador
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

    // Funcion que llama a categorias y a la vista para crear un nuevo producto
    public function nuevoProducto() {
        $categorias = productoDAO::obtenerCategorias();
        include_once 'vista/nuevoProducto.php';
    }

    // Funcion para añadir un nuevo producto en la vista de Administrador
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