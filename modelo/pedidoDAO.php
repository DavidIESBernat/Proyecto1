<?php
include_once 'config/dataBase.php';
include_once 'Producto.php';
include_once 'Pedido.php';
include_once 'Categoria.php';
include_once 'Usuario.php';

class pedidoDAO {
    // Funcion para añadir al carrito un pedido desde la carta
    public static function pedido($id) {
        $nuevoPedido = new Pedido(productoDAO::obtenerProductoPorID($_POST['id'])); // Crea un nuevo pedido en base a la id
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
        header("Location:".url.'?controlador=producto&accion=carta#0'.$_POST['id']); // Vuelve a la posicion de la carta donde nos encontrabamos
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
        setcookie('UltimoPedido',$precioTotal,time()+3600); // Se crea una cookie temporal de 1 hora UltimoPedido con el precio total del pedido

        // Una vez ya se ha realizado el pedido vaciamos la sesion donde se almacenan los productos del carrito
        unset($_SESSION['selecciones']);
        header("Location:".url.'?controlador=usuario&accion=ultimasCompras'); 

    }
}
?>