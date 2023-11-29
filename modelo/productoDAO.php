<?php

include_once 'config/dataBase.php';
include_once 'Producto.php';
include_once 'Pedido.php';
include_once 'Categoria.php';

class productoDAO {

    /*Funcion para obtener todos los productos de la base de datos*/
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

    /* Funcion para obtener todas las categorias de la base de datos*/
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
    /* Funcion para añadir una nueva categoria a la base de datos */
    public static function nuevaCategoria($nombre,$descripcion,$imagen) { // Añade una nueva categoria
        $con = dataBase::connect();
        $consulta = $con->prepare("INSERT INTO CATEGORIA (id, nombre, descripcion, imagen) VALUES (NULL, ?, ?, ?)"); // Consulta para añadir una nueva categoria
        $consulta->bind_param("sss", $nombre, $descripcion, $imagen);
        $consulta->execute(); // Ejecuta la consulta
        $con->close(); // Cierra la conexion
    }
    /* Funcion para eliminar un pedido de la sesion donde se almacena*/
    public static function delProductoCarrito($id) {
        session_start();
        if (isset($_SESSION['selecciones'])) { // Compruebo que la sesion existe
            // Obtengo el pedido de productoDAO en base al id del producto seleccionado para eliminar
            $pedido = new Pedido(productoDAO::obtenerProductoPorID($id));
            $posicion = array_search($pedido, $_SESSION['selecciones']); // Busco la posicion del pedido en el array
            
            if ($posicion !== false) { // Comprobacion de que el valor existe en el array
                unset($_SESSION['selecciones'][$posicion]); // Si existe elimina ese valor del array
                $_SESSION['selecciones'] = array_values($_SESSION['selecciones']); // Reindexar el array
            }
        }
    }
}
    
?>