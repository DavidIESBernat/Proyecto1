<?php
include_once 'config/dataBase.php';
include_once 'Producto.php';
include_once 'Pedido.php';
include_once 'Categoria.php';
include_once 'Usuario.php';
include_once 'Opinion.php';

class opinionDAO {
    
    // Funcion para obtener todas las opiniones de la base de datos y guardarlas en un array de tipo objeto Opinion.
    public static function obtenerOpiniones() {
        $con = dataBase::connect(); // Conexión con la base de datos
        $consulta = $con->prepare("SELECT * FROM opinion"); 
        $consulta->execute();
        $resultados = $consulta->get_result();
        $opiniones = array();
    
        while ($opinion = $resultados->fetch_assoc()) {
            $opiniones[] = $opinion; // Guardamos la opinion en el array de opiniones
        }
    
        $con->close();
        return $opiniones; // Devuelve las opiniones
    }
    
    // Funcion que añade una nueva opinion a la base de datos
    public static function nuevaOpinion($idPedido, $titulo, $comentario, $nota, $autor) { 
        $con = dataBase::connect();
        $consulta = $con->prepare("INSERT INTO OPINION (id, pedido_id, titulo, comentario, nota, fecha, autor) VALUES (NULL, ?, ?, ?, ?, CURRENT_DATE, ?)"); // Consulta para añadir una nueva opinion
        $consulta->bind_param("issis", $idPedido, $titulo, $comentario, $nota, $autor);
        $consulta->execute(); // Ejecuta la consulta
        $con->close(); // Cierra la conexion
    }
}
?>