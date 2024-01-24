<?php
include_once 'modelo/productoDAO.php';
include_once 'modelo/pedidoDAO.php';
include_once 'modelo/usuarioDAO.php';
include_once 'modelo/categoriaDAO.php';
include_once 'modelo/Producto.php';
include_once 'modelo/Pedido.php';
include_once 'modelo/OpinionDAO.php';
include_once 'modelo/Opinion.php';

class apiControlador{    
 
    // Funcion que detecta la accion a realizar
    public function index(){
       
        // If para obtener las opiniones
        if($_GET["accion"] == 'mostrar_opiniones') {
            $opiniones = $this->mostrarOpiniones();
        }   
        //If para añadir una nueva opinion
        if($_GET["accion"] == 'nueva_opinion') {
            $opiniones = $this->nuevaOpinion();
        }   
    }

    // Funcion para obtener todas las opiniones de los pedidos
    public function mostrarOpiniones() {

        $opiniones = opinionDAO::obtenerOpiniones();
        echo json_encode($opiniones, JSON_UNESCAPED_UNICODE);
        
    }
    // Funcion para añadir una nueva opinion
    public function nuevaOpinion() {
        $opinion = opinionDAO::nuevaOpinion($idPedido, $titulo, $comentario, $nota, $fecha, $autor);
        echo json_encode($opiniones, JSON_UNESCAPED_UNICODE);
    }
}
?>
