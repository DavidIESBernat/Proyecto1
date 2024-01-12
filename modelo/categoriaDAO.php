<?php
include_once 'config/dataBase.php';
include_once 'Producto.php';
include_once 'Pedido.php';
include_once 'Categoria.php';
include_once 'Usuario.php';

class categoriaDAO {

     /* Funcion para obtener todas las categorias de la base de datos*/
    public static function obtenerCategorias() {
        $con = dataBase::connect(); // Conexión con la base de datos
        $consulta = $con->prepare("SELECT * FROM categoria"); 
        $consulta->execute();
        $resultados = $consulta->get_result();
        $categorias = array();
    
        while ($categoria = $resultados->fetch_object('Categoria')) {
            $categorias[] = $categoria; // Guardamos categoria en el array categorias
        }
    
        $con->close();
        return $categorias; // Devuelve las categorías
    }

    /*Obtener una categoria de la base de datos segun su id*/ 
    public static function obtenerCategoriaPorID($id) {
        $con = dataBase::connect(); // Conexion con la base de datos

        $consulta = $con->prepare("SELECT * FROM CATEGORIA WHERE id = ?");
        $consulta->bind_param("i", $id);
        $consulta->execute(); // Ejecuta la consulta
        $resultado = $consulta->get_result();
        $categoria = $resultado->fetch_object('Categoria');
        $con->close(); // Cierra la conexion

        return $categoria; // Devuelve la categoria obtenida
        
    }
    
    /* Funcion para añadir una nueva categoria a la base de datos */
    public static function nuevaCategoria($nombre,$descripcion,$imagen) { // Añade una nueva categoria
        $con = dataBase::connect();
        $consulta = $con->prepare("INSERT INTO CATEGORIA (id, nombre, descripcion, imagen) VALUES (NULL, ?, ?, ?)"); // Consulta para añadir una nueva categoria
        $consulta->bind_param("sss", $nombre, $descripcion, $imagen);
        $consulta->execute(); // Ejecuta la consulta
        $con->close(); // Cierra la conexion
    }

    /* Eliminar una categoria de la base de datos segun su id*/
    public static function eliminarCategoriaPorID($id) {
        $con = dataBase::connect(); // Conexion con la base de datos

        $consulta = $con->prepare("DELETE FROM CATEGORIA WHERE id= ?"); // Consulta para eliminar un producto segun su id
        $consulta->bind_param("i", $id);
        $consulta->execute(); // Ejecuta la consulta
        $con->close(); // Cierra la conexion
        
    }

    /* Funcion para editar una categoria de la base de datos segun su id*/
    public static function editarCategoriaPorID($id,$nombre,$descripcion,$imagen) {
        $con = dataBase::connect();
        $consulta = $con->prepare("UPDATE CATEGORIA SET nombre = ?, descripcion = ?, imagen = ? WHERE id = ?"); // Consulta para actualizar segun id
        $consulta->bind_param("sssi", $nombre, $descripcion, $imagen, $id);
        $consulta->execute(); // Ejecuta la consulta
        $con->close(); // Cierra la conexion
    }

}
?>