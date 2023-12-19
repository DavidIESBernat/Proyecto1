<?php
include_once 'config/dataBase.php';
include_once 'Producto.php';
include_once 'Pedido.php';
include_once 'Categoria.php';
include_once 'Usuario.php';

class pedidoDAO {
    // Funcion para añadir al carrito un pedido desde la carta
    public static function pedido($id) {
        $nuevoPedido = new Pedido(productoDAO::obtenerProductoPorID($id), 1); // Crea un nuevo pedido en base a la id
        $posicion = false; // Posicion por defecto sera false

        foreach ($_SESSION['selecciones'] as $pos => $pedidoExistente) { // Bucle foreach que recorre los pedidos y devuelve su posicion en el array junto al pedido
            if ($pedidoExistente->compararPedido($nuevoPedido)) { // Compara los dos pedidos para verificar si ya existe, si es el caso guarda en posicion la posicion del array donde se encuentra
                $posicion = $pos; // Guarda la posicion de $pos en $posicion
                break; // Corta el bucle foreach si entra al if y se ejecuta
            }
        }

        if ($posicion !== false) { // Si la posicion es false se creara un nuevo pedido, en caso contrario se añadira uno a la cantidad del pedido actual
            $_SESSION['selecciones'][$posicion]->setCantidad($_SESSION['selecciones'][$posicion]->getCantidad() + 1); // El pedido ya existe en el carrito y se incrementa la cantidad
        } else {
            array_push($_SESSION['selecciones'], $nuevoPedido); // El pedido no existe en el carrito y se añade
        }
        header("Location:".url.'?controlador=producto&accion=carta#0'.$id); // Vuelve a la posicion de la carta donde nos encontrabamos
    }

    // Funcion para añadir al carrito un pedido con una cantidad definida
    public static function pedidoConCantidad($id, $cantidad) {
        $nuevoPedido = new Pedido(productoDAO::obtenerProductoPorID($id), $cantidad); // Crea un nuevo pedido en base a la id
        $posicion = false; // Posicion por defecto sera false

        foreach ($_SESSION['selecciones'] as $pos => $pedidoExistente) { // Bucle foreach que recorre los pedidos y devuelve su posicion en el array junto al pedido
            if ($pedidoExistente->compararPedido($nuevoPedido)) { // Compara los dos pedidos para verificar si ya existe, si es el caso guarda en posicion la posicion del array donde se encuentra
                $posicion = $pos; // Guarda la posicion de $pos en $posicion
                break; // Corta el bucle foreach si entra al if y se ejecuta
            }
        }

        if ($posicion !== false) { // Si la posicion es false se creara un nuevo pedido, en caso contrario se añadira uno a la cantidad del pedido actual
            $_SESSION['selecciones'][$posicion]->setCantidad($_SESSION['selecciones'][$posicion]->getCantidad() + $cantidad); // El pedido ya existe en el carrito y se incrementa la cantidad
        } else {
            array_push($_SESSION['selecciones'], $nuevoPedido); // El pedido no existe en el carrito y se añade
        }
        header("Location:".url.'?controlador=producto&accion=carta#0'.$id); // Vuelve a la posicion de la carta donde nos encontrabamos
    }

    // Devuelve el precio total de todos los pedidos
    public static function precioTotalPedido() { 
        // Variables declaradas como 0     
        $precioTotal = 0;
        $precioTotalConjunto = 0;

        // Bucle para recorrer el array de la session y guardar en $pedido sus array indexadas
        foreach ($_SESSION['selecciones'] as $pedido) {
            $precio = $pedido->getProducto()->getPrecio(); // Guarda el precio de el producto actual
            $cantidad = $pedido->getCantidad(); // Guarda la cantidad del mismo producto
            $precioTotal = $precio * $cantidad; // Multiplica el precio por la cantidad de productos añadidos
            $precioTotalConjunto = $precioTotalConjunto + $precioTotal; // Autosuma los precios anteriores con el valor total
        }
        return $precioTotalConjunto; // Devuelve precio total de todos los productos de la sesion
    }

    public static function confirmarPedido() {
        $idUsuario = $_SESSION['usuario']['idUsuario']; // Guarda el id de usuario de la sesion actual
        $fecha = date('Y-m-d'); // Obtiene y guarda la fecha en formato año-mes-dia
        $precioTotal = pedidoDAO::precioTotalPedido(); // Obtiene el precio total del pedido

        // Conexion con la base de datos
        $con = dataBase::connect();
        // Crea la query para insertar una nueva entrada en la tabla pedido
        $query = "INSERT INTO PEDIDO (idUsuario, precioTotal, fecha) VALUES (?, ?, ?)";
        $consulta = $con->prepare($query); // Prepara la conexion de esa query
        $consulta->bind_param("ids", $idUsuario, $precioTotal, $fecha);
        $consulta->execute(); // Ejecuta la Query

        $idPedido = $consulta->insert_id;  // Obtener el ID del nuevo pedido creado
        $consulta->close(); // Cierra la conexion


        // Crea la query para insertar una nueva entrada en la tabla pedido
        $query = "INSERT INTO PEDIDOPRODUCTO (idPedido, idProducto, cantidad, precio) VALUES (?, ?, ?, ?)";
        $consultaProducto = $con->prepare($query); // Prepara la conexion de esa query
        // Obtiene los productos actuales añadidos al carrito recorriendo la session
        foreach ($_SESSION['selecciones'] as $pedido) {
            $idProducto = $pedido->getProducto()->getId(); // Obtiene el id de producto
            $cantidad = $pedido->getCantidad(); // Obtiene la cantidad
            $precio = $pedido->getCantidad() * $pedido->getProducto()->getPrecio(); // Precio conjunto del producto * cantidad

            $consultaProducto->bind_param("iiid", $idPedido, $idProducto, $cantidad, $precio); 
            $consultaProducto->execute(); // Ejecuta la Query
        }
        $consultaProducto->close(); // Cierra la conexion
        $con->close();

        $precioTotal = pedidoDAO::precioTotalPedido(); // Obtengo el precio total para crear la cookie del precio total del ultimo pedido
        setcookie('PrecioUltimoPedido',$precioTotal,time()+3600); // Se crea una cookie temporal de 1 hora UltimoPedido con el precio total del pedido
        
        // Guarda en una cookie la sesion donde se almacenan todos los productos del pedido actual
        $seleccionesSerialize = serialize($_SESSION['selecciones']); // Primero desfragmenta en una cadena de texto el array selecciones
        setcookie('UltimoPedido', $seleccionesSerialize, time() + 3600); // Se guardan los valores en la cookie

        // Una vez ya se ha realizado el pedido vaciamos la sesion donde se almacenan los productos del carrito
        unset($_SESSION['selecciones']);
        header("Location:".url.'?controlador=usuario&accion=ultimasCompras'); 

    }
    // Funcion para obtener todos los pedidos de un usuario con sus respectivos productos
    public static function cargarPedido() {
        $pedidosArray = [];
        $productosArray = [];
        $idUsuario = $_SESSION['usuario']['idUsuario']; // Guarda el id de usuario de la sesion actual
    
        // Conexion con la base de datos
        $con = dataBase::connect();
        
        // Crea la query para insertar una nueva entrada en la tabla pedido
        $query = "SELECT * FROM PEDIDO WHERE idUsuario = ?";
        $consulta = $con->prepare($query); // Prepara la conexion de esa query
        $consulta->bind_param("i", $idUsuario);
        $consulta->execute();
        
        // Obtiene los resultados
        $resultadoPedidos = $consulta->get_result();
        $pedidos = $resultadoPedidos->fetch_all(MYSQLI_ASSOC);
    
        // Cerramos
        $resultadoPedidos->close();
    
        // Bucle para recorrer los pedidos creados y guardar su informacion
        foreach ($pedidos as $pedido) {
            $idPedido = $pedido['idPedido'];
            $idUsuario = $pedido['idUsuario'];
            $precioTotal = $pedido['precioTotal'];
            $fecha = $pedido['fecha'];

            // Almacena los valores de pedido en un array
            $pedidosArray[] = array(
                'idPedido' => $idPedido,
                'idUsuario' => $idUsuario,
                'precioTotal' => $precioTotal,
                'fecha' => $fecha
            );
            
            // Cerrar el conjunto de resultados antes de ejecutar una nueva consulta
            $consulta->close();
    
            $query = "SELECT * FROM PEDIDOPRODUCTO WHERE idPedido = ?";
            $consulta = $con->prepare($query);
            $consulta->bind_param("i", $idPedido);
            $consulta->execute();
    
            // Obtener los resultados
            $resultadoProductos = $consulta->get_result();
            $productos = $resultadoProductos->fetch_all(MYSQLI_ASSOC);
    
            // Cerrar el conjunto de resultados
            $resultadoProductos->close();
    
            foreach($productos as $producto) {
                $idProducto = $producto['idProducto'];
                $cantidad = $producto['cantidad'];
                $precio = $producto['precio'];

                 // Almacena los valores de productos en un array con su idPedido
                $productosArray[] = array(
                    'idPedido' => $idPedido,
                    'idProducto' => $idProducto,
                    'cantidad' => $cantidad,
                    'precio' => $precio
                );
            }
        }
        // Devolver un array que contiene la información de pedidos y productos
        return array('pedidos' => $pedidosArray, 'productos' => $productosArray);
        // Cerrar la conexión con la base de datos
        $con->close();
    }

    // Calcula la cantidad total de productos en el array y devuelve su posicion
    public static function cantidadTotalProductos() {
        if(isset($_SESSION['selecciones']) && count($_SESSION['selecciones']) >= 1) {
            $cantidadTotal = 0;
            foreach ($_SESSION['selecciones'] as $pedido) {
                $cantidad = $pedido->getCantidad();
                $cantidadTotal = $cantidad + $cantidadTotal;
            }
            return $cantidadTotal;
        }
    }
}
?>