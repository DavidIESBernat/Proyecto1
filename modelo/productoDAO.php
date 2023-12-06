<?php

include_once 'config/dataBase.php';
include_once 'Producto.php';
include_once 'Pedido.php';
include_once 'Categoria.php';
include_once 'Usuario.php';

class productoDAO {

    /*Funcion para obtener todos los productos de la base de datos*/
    public static function obtenerProductos() { // Devuelve todos los productos.
        $con = dataBase::connect(); // Conexion con la base de datos
        $consulta = $con->prepare("SELECT * FROM producto"); 
        $consulta->execute();
        $resultados = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
        foreach($resultados as $resultado) { // Bucle foreach que recorre todos los productos obtenidos
            $producto = new Producto(); // Los productos son declarados como clase Producto y se establecen sus valores con Sets
            $producto->setId($resultado['id']);
            $producto->setNombre($resultado['nombre']);
            $producto->setDescripcion($resultado['descripcion']);
            $producto->setPrecio($resultado['precio']);
            $producto->setCategoria($resultado['categoria']);
            $producto->setImagen($resultado['imagen']);
    
            $productos[] = $producto; // Aqui guardamos todos los campos anterior de productos en el array principal donde se almacenan todos los productos
            }
        
            $con->close();
            return $productos; // Devuelve los productos
    }
    
    /*Obtener un producto de la base de datos segun su id*/ 
    public static function obtenerProductoPorID($id) { // Devuelve un producto segun su id.
        // Con = conexion
        $con = dataBase::connect(); // Conexion con la base de datos

        $consulta = $con->prepare("SELECT * FROM PRODUCTO WHERE id = ?");
        $consulta->bind_param("i", $id);
        $consulta->execute(); // Ejecuta la consulta
        $resultado = $consulta->get_result();
        $producto = $resultado->fetch_object('Producto');
        $con->close(); // Cierra la conexion

        return $producto; // Devuelve el producto obtenido
        
    }

    /* Eliminar un producto de la base de datos segun su id*/
    public static function eliminarProductoPorID($id) { // Elimina un producto segun su id.
        // Con = conexion
        $con = dataBase::connect(); // Conexion con la base de datos

        $consulta = $con->prepare("DELETE FROM PRODUCTO WHERE id= ?"); // Consulta para eliminar un producto segun su id
        $consulta->bind_param("i", $id);
        $consulta->execute(); // Ejecuta la consulta
        $con->close(); // Cierra la conexion
        
    }

    /* Funcion para editar un producto de la base de datos segun su id*/
    public static function editarProductoPorID($id,$nombre,$descripcion,$precio,$categoria,$imagen) { // Editar un producto
        $con = dataBase::connect();
        $consulta = $con->prepare("UPDATE PRODUCTO SET nombre = ?, descripcion = ?, precio = ?, categoria = ?, imagen = ? WHERE id = ?"); // Consulta para actualizar segun id
        $consulta->bind_param("ssdssi", $nombre, $descripcion, $precio, $categoria, $imagen, $id);
        $consulta->execute(); // Ejecuta la consulta
        $con->close(); // Cierra la conexion
    }

    /*Añadir nuevo producto a la base de datos*/
    public static function nuevoProducto($nombre,$descripcion,$precio,$categoria,$imagen) { // Añade un nuevo producto
        $con = dataBase::connect();
        $consulta = $con->prepare("INSERT INTO PRODUCTO (id, nombre, descripcion, precio, categoria, imagen) VALUES (NULL, ?, ?, ?, ?, ?)"); // Consulta para añadir un nuevo producto
        $consulta->bind_param("ssdis", $nombre, $descripcion, $precio, $categoria, $imagen);
        $consulta->execute(); // Ejecuta la consulta
        $con->close(); // Cierra la conexion
    }

}
    
?>