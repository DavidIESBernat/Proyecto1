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

    // Funcion para modificar la cantidad de un producto
    public function modificarCantidad() {
        session_start(); // Inicializamos sesion
        $id = $_POST['id']; // Obtengo el valor id del formulario por POST
        $valor = $_POST['valor']; // Valor que variara entre -1 o 1 que se sumara a la cantidad segun el boton que se haya pulsado en el formulario

        productoDAO::modificarCantidad($id,$valor); // Llama a la funcion de ProductoDAO para modificar la cantidad
        header("Location:".url.'?controlador=producto&accion=carrito');
    }
    // Funcion para eliminar la sesion actual
    public function destruir_carrito() {
        session_start();
        session_destroy();
        header("Location:".url.'?controlador=producto&accion=carrito');
    }
}
?>