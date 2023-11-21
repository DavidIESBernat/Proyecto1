<?php

include_once 'config/dataBase.php';
include_once 'Producto.php';
include_once 'Pedido.php';
include_once 'Categoria.php';

class productoDAO {

    /*public static function obtenerProductos() { // Devuelve todos los productos.
        $con = dataBase::connect(); // Conexion con la base de datos
        $consulta = $con->prepare("SELECT * FROM producto"); 
        $consulta->execute();
        $productos = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
        $con->close();

        return $productos; // Devuelve todos los productos
        var_dump($productos);
    }*/

    public static function obtenerProductos() { // Devuelve todos los productos.
        $con = dataBase::connect(); // Conexion con la base de datos
        $consulta = $con->prepare("SELECT * FROM producto"); 
        $consulta->execute();
        $resultados = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
        foreach($resultados as $resultado) {
            $producto = new Producto();
            $producto->setId($resultado['id']);
            $producto->setNombre($resultado['nombre']);
            $producto->setDescripcion($resultado['descripcion']);
            $producto->setPrecio($resultado['precio']);
            $producto->setCategoria($resultado['categoria']);
            $producto->setImagen($resultado['imagen']);
    
            $productos[] = $producto;
            }
        
            $con->close();
            return $productos;
    }

    public static function obtenerCategorias() { // Devuelve todas las categorias.
        $con = dataBase::connect(); // Conexion con la base de datos
        $consulta = $con->prepare("SELECT * FROM categoria"); 
        $consulta->execute();
        $resultados = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);

        foreach($resultados as $resultado) {
            $categoria = new Categoria();
            $categoria->setId($resultado['id']);
            $categoria->setNombre($resultado['nombre']);
            $categoria->setDescripcion($resultado['descripcion']);
            $categoria->setImagen($resultado['imagen']);
    
            $categorias[] = $categoria;
        }
    
        $con->close();
        return $categorias;

        //crear un array vacio
        //recorrer el resultado
            //ir creando un objeto de tipo categoria pasandole los datos necesarios a new Categoria
            //añades al array anterior
        //retornas el array

    }

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

    public static function eliminarProductoPorID($id) { // Elimina un producto segun su id.
        // Con = conexion
        $con = dataBase::connect(); // Conexion con la base de datos

        $consulta = $con->prepare("DELETE FROM PRODUCTO WHERE idProducto = ?"); // Consulta para eliminar un producto segun su id
        $consulta->bind_param("i", $id);
        $consulta->execute(); // Ejecuta la consulta
        $con->close(); // Cierra la conexion
        
    }
    public static function editarProductoPorID($id,$nombre,$descripcion,$precio,$categoria,$imagen) { // Editar un producto
        $con = dataBase::connect();
        $consulta = $con->prepare("UPDATE PRODUCTO SET nombre = ?, descripcion = ?, precio = ?, categoria = ?, imagen = ? WHERE idProducto = ?"); // Consulta para actualizar segun id
        $consulta->bind_param("ssdssi", $nombre, $descripcion, $precio, $categoria, $imagen, $id);
        $consulta->execute(); // Ejecuta la consulta
        $con->close(); // Cierra la conexion
    }

    public static function nuevoProducto($nombre,$descripcion,$precio,$categoria,$imagen) { // Añade un nuevo producto
        $con = dataBase::connect();
        $consulta = $con->prepare("INSERT INTO PRODUCTO (idProducto, nombre, descripcion, precio, categoria, imagen) VALUES (NULL, ?, ?, ?, ?, ?)"); // Consulta para añadir un nuevo producto
        $consulta->bind_param("ssdss", $nombre, $descripcion, $precio, $categoria, $imagen);
        $consulta->execute(); // Ejecuta la consulta
        $con->close(); // Cierra la conexion
    }
}
    
?>