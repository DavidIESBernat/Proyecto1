<?php
include_once 'config/parameters.php';
include_once 'controlador/productoControlador.php';
include_once 'controlador/categoriaControlador.php';
include_once 'controlador/pedidoControlador.php';
include_once 'controlador/usuarioControlador.php';
include_once 'controlador/apiControlador.php';
include_once 'controlador/opinionControlador.php';

if(!isset($_GET['controlador'])) {
    // Si no se pasa nada, se mostrara pagina principal de pedidos.
    header("Location:".url.'?controlador=producto');
} else {
    $nombre_controlador = $_GET['controlador'].'Controlador';

    if(class_exists($nombre_controlador)) {
        // Mirariamos si nos pasa una accion, en caso contrario mostramos accion por defecto.
        $controlador = new $nombre_controlador();

        if(isset($_GET['accion']) && method_exists($controlador,$_GET['accion'])) {
            $accion = $_GET['accion'];
        } else {
            $accion = action_default;
        }

        $controlador->$accion();

    } else {
        header("Location:".url.'?controlador=producto');
    }
    
}

?>