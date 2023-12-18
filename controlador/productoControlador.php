<?php
include_once 'modelo/productoDAO.php';
include_once 'modelo/pedidoDAO.php';
include_once 'modelo/usuarioDAO.php';
include_once 'modelo/categoriaDAO.php';
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
                if(isset($_POST['cantidad'])) {
                    $id = $_POST['id'];
                    $cantidad = $_POST['cantidad'];
                    pedidoDAO::pedidoConCantidad($id,$cantidad);
                } else {
                    $id = $_POST['id'];
                    pedidoDAO::pedido($id);
                }
            }
        }
    

        // Header
        $cantidadCarrito = pedidoDAO::cantidadTotalProductos();
        include_once 'vista/header.php';
        // Main
        include_once 'vista/home.php';
        // Footer
        include_once 'vista/footer.php';
    }
    
    // Funcion que muestra la carta
    public function carta() {
        session_start();
        // Header
        $cantidadCarrito = pedidoDAO::cantidadTotalProductos();
        include_once 'vista/header.php';
        // Main
        $categorias = categoriaDAO::obtenerCategorias();
        $productos = productoDAO::obtenerProductos();
        include_once 'vista/carta.php';
        // Footer
        include_once 'vista/footer.php';
    }

    public function mostrarProducto() {
        session_start();
        if(isset($_POST['id'])) { // Comprueba que existe un id para mostrarlo
            $id = $_POST['id']; // Obtenemos el valor de producto
            if(isset($_POST['cantidad'])) {
                $cantidad = $_POST['cantidad']; // Obtenemos la cantidad del producto
                if(isset($_POST['Add'])) { // Sumar la cantidad del producto en +1
                    $cantidad++;
                } else if(isset($_POST['Del'])) { // Comprueba si se ha enviado por post y entra
                    if($cantidad==1) { 
                        // La cantidad es negativa y no hace nada porque no puede ser un valor negativo
                    } else { 
                        // Si la cantidad es 1 o mas se suma uno a la cantidad actual
                        $cantidad--;
                    }
                }
            } else {
                $cantidad = 1;
            }
    
            // Header
            $cantidadCarrito = pedidoDAO::cantidadTotalProductos();
            include_once 'vista/header.php';
            // Main
            $producto = productoDAO::obtenerProductoPorID($id);
            include_once 'vista/producto.php';
            // Footer
            include_once 'vista/footer.php';
        } else { // Si no existe un redirecciona a la pagina home
            header("Location:".url.'?controlador=producto');
        }
    }

    //-----------------------------------------------------------\\
    // \/ TODAS LAS FUNCIONES SIGUIENTES SON DE ADMINISTRACION \/ \\
    //-----------------------------------------------------------\\


    // Funcion para mostrar todos los productos *SOLO ADMINISTRADOR*
    public function mostrarProductos() {

        //Llama a la funcion de usuarioDAO que verifica si el usuario actual es administrador
        $admin = usuarioDAO::verificarAdministrador();

        // Si admin es true accede, en caso contrario vuelve al home
        if($admin) {
            $categorias = categoriaDAO::obtenerCategorias();
            $productos = productoDAO::obtenerProductos(); // Guardamos en $productos los valores de la funcion mostrarProductos de ObtenerProductos
            include_once 'vista/mostrarProductos.php';
        } else {
            header("Location:".url.'?controlador=producto');
        }
    }

    // Funcion para eliminar un producto *SOLO ADMINISTRADOR*
    public function eliminarProducto() {

        //Llama a la funcion de usuarioDAO que verifica si el usuario actual es administrador
        $admin = usuarioDAO::verificarAdministrador();

        // Si admin es true accede, en caso contrario vuelve al home
        if($admin) {
            $id= $_POST['id'];
            productoDAO::eliminarProductoPorID($id);
            header("Location:".url.'?controlador=producto&accion=mostrarProductos');
        } else {
            header("Location:".url.'?controlador=producto');
        }
    }

    // Funcion que muestra una vista para modificar el producto seleccionado *SOLO ADMINISTRADOR*
    public function modificarProducto() {

            //Llama a la funcion de usuarioDAO que verifica si el usuario actual es administrador
            $admin = usuarioDAO::verificarAdministrador();

            // Si admin es true accede, en caso contrario vuelve al home
            if($admin) {
                $id = $_POST['id'];
                $categorias = categoriaDAO::obtenerCategorias();
                $producto = productoDAO::obtenerProductoPorID($id); // Devuelve el producto con id coincidente
                if($producto != NULL) {
                    include_once 'vista/vistaEditarProducto.php';
                } else {
                    echo 'ID no asignado a ningun producto';
                }
            } else {
                header("Location:".url.'?controlador=producto');
            }
            
    }

    // Funcion para editar un producto *SOLO ADMINISTRADOR*
    public function editarProducto() {

        //Llama a la funcion de usuarioDAO que verifica si el usuario actual es administrador
        $admin = usuarioDAO::verificarAdministrador();

        // Si admin es true accede, en caso contrario vuelve al home
        if($admin) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $descripcion= $_POST['descripcion'];
            $precio = $_POST['precio'];
            $categoria = $_POST['categoria'];
            $imagen = $_POST['imagen'];

            productoDAO::editarProductoPorID($id,$nombre,$descripcion,$precio,$categoria,$imagen);
            header("Location:".url.'?controlador=producto&accion=mostrarProductos');
        } else {
            header("Location:".url.'?controlador=producto');
        }
    }

    // Funcion que muestra la vista para crear un nuevo producto *SOLO ADMINISTRADOR*
    public function nuevoProducto() {

        //Llama a la funcion de usuarioDAO que verifica si el usuario actual es administrador
        $admin = usuarioDAO::verificarAdministrador();

        // Si admin es true accede, en caso contrario vuelve al home
        if($admin) {
            $categorias = categoriaDAO::obtenerCategorias();
            include_once 'vista/nuevoProducto.php';
        } else {
            header("Location:".url.'?controlador=producto');
        }
    }

    // Funcion para añadir un nuevo producto *SOLO ADMINISTRADOR*
    public function añadirProducto() {

        //Llama a la funcion de usuarioDAO que verifica si el usuario actual es administrador
        $admin = usuarioDAO::verificarAdministrador();

        // Si admin es true accede, en caso contrario vuelve al home
        if($admin) {
            $nombre = $_POST['nombre'];
            $descripcion= $_POST['descripcion'];
            $precio = $_POST['precio'];
            $categoria = $_POST['categoria'];
            $imagen = $_POST['imagen'];

            productoDAO::nuevoProducto($nombre,$descripcion,$precio,$categoria,$imagen);
            header("Location:".url.'?controlador=producto&accion=nuevoProducto');
        } else {
            header("Location:".url.'?controlador=producto');
        }
    }
    public function footer() {
        include_once 'vista/footer.php';
    }
}
?>