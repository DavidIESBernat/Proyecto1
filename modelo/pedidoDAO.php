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

    // Devuelve el precio total de todos los productos del pedido
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

    // Devuelve el importe total de todos los productos + la propina añadida a este pedido
    public static function importeTotal($porcentajePropina) { 
        // Variables declaradas como 0     
        $precioTotal = 0; 
        $precioTotalConjunto = 0;

        // Bucle para recorrer el array de la session y guardar en $pedido sus array indexadas
        foreach ($_SESSION['selecciones'] as $pedido) {
            $precio = $pedido->getProducto()->getPrecio(); // Guarda el precio de el producto actual
            $cantidad = $pedido->getCantidad(); // Guarda la cantidad del mismo producto
            $precioTotal = $precio * $cantidad; // Multiplica el precio por la cantidad de productos añadidos
            $precioTotalConjunto = $precioTotalConjunto + $precioTotal; // Autosuma los precios anteriores con el valor total
            $propinaCalculada = ($precioTotal * $porcentajePropina) / 100; // calcula el porcentaje de propina sobre el precio total de todos los productos


            $importeTotal = $precioTotalConjunto + $propinaCalculada; // Importe final sumando el precio total de los productos + la propina
        }
        return $importeTotal; // Devuelve el importe total
    }

    public static function confirmarPedido($porcentajePropina, $puntosGastados,$precioTotal,$importeTotal) {
        $idUsuario = $_SESSION['usuario']['idUsuario']; // Guarda el id de usuario de la sesion actual
        $fecha = date('Y-m-d'); // Obtiene y guarda la fecha en formato año-mes-dia
        //$importeTotal = pedidoDAO::importeTotal($porcentajePropina);

        // Conexion con la base de datos
        $con = dataBase::connect();
        $query = "INSERT INTO PEDIDO (idUsuario, precioTotal, fecha, porcentajePropina, puntos, importeTotal) VALUES (?, ?, ?, ?, ?, ?)"; // Crea la query para insertar una nueva entrada en la tabla pedido
        $consulta = $con->prepare($query); // Prepara la conexion de esa query
        $consulta->bind_param("idsiid", $idUsuario, $precioTotal, $fecha, $porcentajePropina, $puntosGastados, $importeTotal);
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
        $idUsuario = $_SESSION['usuario']['idUsuario']; // Guarda el id de usuario de la sesión actual
    
        // Conexion con la base de datos
        $con = dataBase::connect();
    
        // Crea la query para insertar una nueva entrada en la tabla pedido
        $query = "SELECT * FROM PEDIDO WHERE idUsuario = ?";
        $consulta = $con->prepare($query); // Prepara la conexión de esa query
        $consulta->bind_param("i", $idUsuario);
        $consulta->execute();
    
        // Obtiene los resultados
        $resultadoPedidos = $consulta->get_result();
    
        // Bucle para recorrer los pedidos creados y guardar su información
        while ($pedido = $resultadoPedidos->fetch_object()) {
            // Almacena los valores de pedido en un objeto
            $pedidosArray[] = $pedido;
    
            // Crea una nueva consulta para obtener los productos asociados a este pedido
            $query = "SELECT * FROM PEDIDOPRODUCTO WHERE idPedido = ?";
            $consultaProductos = $con->prepare($query);
            $consultaProductos->bind_param("i", $pedido->idPedido);
            $consultaProductos->execute();
    
            // Obtener los resultados de productos como objetos
            $resultadoProductos = $consultaProductos->get_result();
    
            // Bucle para recorrer los productos asociados al pedido
            while ($producto = $resultadoProductos->fetch_object()) {
                // Almacena los valores de productos en un objeto con su idPedido
                $productosArray[] = $producto;
            }
    
            // Cerrar el conjunto de resultados de productos antes de ejecutar una nueva consulta
            $resultadoProductos->close();
        }
    
        // Cerrar el conjunto de resultados de pedidos
        $resultadoPedidos->close();
    
        // Devolver un array que contiene la información de pedidos y productos
        return array('pedidos' => $pedidosArray, 'productos' => $productosArray);
    
        // Cerrar la conexión con la base de datos (colocado después del return para que siempre se cierre)
        $con->close();
    }

     // Funcion que obtiene un pedido
     public static function mostrarPedido($idPedido) {
        $idUsuario = $_SESSION['usuario']['idUsuario']; // Guarda el id de usuario de la sesión actual
    
        // Conexion con la base de datos
        $con = dataBase::connect();
    
        // Crea la query para insertar una nueva entrada en la tabla pedido
        $query = "SELECT * FROM PEDIDO WHERE idUsuario = ? AND idPedido = ?";
        $consulta = $con->prepare($query); // Prepara la conexión de esa query
        $consulta->bind_param("ii", $idUsuario, $idPedido);
        $consulta->execute();
    
        // Obtiene los resultados
        $resultadoPedido = $consulta->get_result();
        $pedido = $resultadoPedido->fetch_object();
        return $pedido;
        // Cerrar la conexión con la base de datos (colocado después del return para que siempre se cierre)
        $con->close();
     }

     // Funcion que obtiene todos los productos de un pedido
    public static function productosPedido($idPedido) {
        $productos = [];

        // Conexion con la base de datos
        $con = dataBase::connect();

        // Crea una nueva consulta para obtener los productos asociados a este pedido
        $query = "SELECT * FROM PEDIDOPRODUCTO WHERE idPedido = ?";
        $consultaProductos = $con->prepare($query);
        $consultaProductos->bind_param("i", $idPedido);
        $consultaProductos->execute();

        // Obtener los resultados de productos como objetos
        $resultadoProductos = $consultaProductos->get_result();

        // Bucle para recorrer los productos asociados al pedido
        while ($producto = $resultadoProductos->fetch_object()) {
            // Almacena los valores de productos en un objeto con su idPedido
            $productos[] = $producto;
        }

        // Devuele el array de productos
        return $productos;
    
        // Cerrar la conexión con la base de datos (colocado después del return para que siempre se cierre)
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