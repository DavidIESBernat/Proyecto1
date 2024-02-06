<?php
include_once 'modelo/productoDAO.php';
include_once 'modelo/categoriaDAO.php';
include_once 'modelo/pedidoDAO.php';
include_once 'modelo/Producto.php';
include_once 'modelo/Pedido.php';
class pedidoControlador {

     // Funcion por si index.php trata de acceder a index de pedidoControlador, automaticamente redirige al controlador de producto
     public function index() {
        header("Location:".url."?controlador=producto");
    }

    //Funcion para acceder al carrito, modificar cantidad de productos y eliminarlos.
    public function carrito() {
        session_start(); 
        
        if(!isset($_SESSION['selecciones'])) { // Si la session no existe la crea
            $_SESSION['selecciones'] = array(); 
        }
        
        if(isset($_POST['Add'])) { // Sumar la cantidad del producto en +1
            $pedido = $_SESSION['selecciones'][$_POST['Add']]; // Guardar en pedido el pedido correspondiente a la posicion seleccionada que se envia por POST
            $pedido->setCantidad($pedido->getCantidad()+1);
        } else if(isset($_POST['Del'])) { // Comprueba si se ha enviado por post y entra
            $pedido = $_SESSION['selecciones'][$_POST['Del']];
            if($pedido->getCantidad()==1) { // Si la cantidad es negativa se borra el producto
                unset($_SESSION['selecciones'][$_POST['Del']]); // Eliminar producto
                $_SESSION['selecciones'] = array_values($_SESSION['selecciones']); // Reindexar el array
            } else { 
                $pedido->setCantidad($pedido->getCantidad()-1); // Resta la cantidad del producto -1
            }
        } else if(isset($_POST['Eliminar'])) { // If para eliminar un producto del carrito
            unset($_SESSION['selecciones'][$_POST['Eliminar']]);
            $_SESSION['selecciones'] = array_values($_SESSION['selecciones']); // Reindexar el array
        } 
        
        if(isset($_SESSION['usuario'])) {
            $idUsuario = $_SESSION['usuario']['idUsuario'];
            $usuario = usuarioDAO::ObtenerUsuarioPorId($idUsuario); // Obtiene el usuario por id
        }
        $precioTotal = pedidoDAO::precioTotalPedido(); // Obtener el precio total de todos los productos
        // Header
        $cantidadCarrito = pedidoDAO::cantidadTotalProductos(); // Obtiene la cantidad de productos añadidos al carrito
        include_once 'vista/header.php';
        // Main
        include_once 'vista/carrito.php';
        // Footer
        include_once 'vista/footer.php';
    }

    // Funcion para eliminar la sesion actual de selecciones
    public function destruir_carrito() {
        session_start();
        unset($_SESSION['selecciones']);
        header("Location:".url.'?controlador=pedido&accion=carrito');
    }

    // Funcion para realizar un pedido cuando pulsamos el boton de realizar pedido
    public function confirmarPedido() {
        session_start();
        // Te almacena el pedido en la base de datos PedidoDAO que guarda el pedido en la BBDD
        if(isset($_SESSION['usuario'])) {
            $idUsuario = $_SESSION['usuario']['idUsuario']; // Obtiene el id de usuario actual
            $data = json_decode(file_get_contents("php://input"));
            // Comprueba que los datos son validos
            if (isset($data->porcentajePropina, $data->precioTotal, $data->puntosObtenidos, $data->puntosGastados, $data->precioTotalFinal)) {

                pedidoDAO::confirmarPedido($data->porcentajePropina, $data->puntosGastados, $data->precioTotal, $data->precioTotalFinal); // Confirmar el pedido actual
                usuarioDAO::modificarPuntos($data->puntosObtenidos, $data->puntosGastados, $idUsuario); // Sumar los puntos obtenidos al usuario actual

                echo json_encode(['message' => 'Pedido realizado', 'redirect' => $url.'?controlador=pedido&accion=carrito'], JSON_UNESCAPED_UNICODE); // Envia mensaje satisfactorio
            } else {
                http_response_code(400); // Devuelve un error si faltan datos
                echo json_encode(['error' => 'Faltan valores'], JSON_UNESCAPED_UNICODE);
            }
        } else {
            header("Location:".url.'?controlador=usuario&accion=login');
        }
    }

    // Carga los pedidos realizados por un usuario y los muestra
    public function cargarPedido() {
        session_start();
        
        if(isset($_SESSION['usuario'])) { // Comprueba que se ha iniciado sesion
            $resultados = pedidoDAO::cargarPedido();
            $pedidos = $resultados['pedidos'];
            $productosPedido = $resultados['productos'];

            $productos = productoDAO::obtenerProductos();
            // Header
            $cantidadCarrito = pedidoDAO::cantidadTotalProductos();
            include_once 'vista/header.php';
            // Main
            include_once 'vista/pedidos.php';
            // Footer
            include_once 'vista/footer.php';
        } else {
            header("Location:".url.'?controlador=usuario&accion=login');
        }
    }

    public function mostrarPedido() {
        session_start();
        
        if(isset($_SESSION['usuario'])) { // Comprueba que se ha iniciado sesion
            $idPedido = $_GET['num'];
            $pedido = pedidoDAO::mostrarPedido($idPedido);
            // Comprueba que el pedido existe
            if($pedido != null) {
                $productosPedido = pedidoDAO::productosPedido($idPedido); // Productos del pedido
                $productos = productoDAO::obtenerProductos(); // Todos los productos de la carta
                // Header
                $cantidadCarrito = pedidoDAO::cantidadTotalProductos(); // Cantidad de productos en el carrito
                include_once 'vista/header.php';
                // Main
                include_once 'vista/pedido.php';
                // Footer
                include_once 'vista/footer.php';
            } else {
                header("Location:".url.'?controlador=pedido&accion=cargarPedido');
            }
        } else {
            header("Location:".url.'?controlador=usuario&accion=login');
        }
    }
    // Funcion para recuperar el ultimo pedido de la cookie
    public static function ultimoPedido() { 
        session_start();
        if (isset($_COOKIE['UltimoPedido'])) { // Si la cookie UltimoPedido existe entra al if
            $seleccionesUnserialize = unserialize($_COOKIE['UltimoPedido']); // Deserealiza la cookie UltimoPedido para guardarla en una variable
            $_SESSION['selecciones'] = $seleccionesUnserialize; // Guarda los valores de nuevo en la session selecciones
            header("Location:".url.'?controlador=pedido&accion=carrito');
        } else { // En caso de que no este creada la cookie UltimoPedido
            header("Location:".url.'?controlador=pedido&accion=carrito');
        }
    }
}
?>