<?php
include_once 'modelo/productoDAO.php';
include_once 'modelo/Producto.php';
include_once 'modelo/Pedido.php';
class pedidoControlador {

    /* Funcion para eliminar un producto de la sesion que se muestra en el carrito*/
    public function eliminarProducto() {
        session_start(); // Inicializamos sesion
        $id = $_POST['id']; // Obtengo el valor id del formulario por POST

        productoDAO::delProductoCarrito($id); // Llamo a funcion de productoDAO para eliminar el producto con el id correspondiente
        // Vuelve al carrito
        header("Location:".url.'?controlador=producto&accion=carrito');
    }
}
?>