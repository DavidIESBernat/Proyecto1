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
}
?>