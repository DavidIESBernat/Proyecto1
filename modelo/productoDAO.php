<?php

include_once 'config/dataBase.php';
include_once 'Producto.php';
include_once 'Bebida.php';
include_once 'Pedido.php';
include_once 'Categoria.php';
include_once 'Usuario.php';

class productoDAO {

    /*Funcion para obtener todos los productos de la base de datos*/
    public static function obtenerProductos() {
        $con = dataBase::connect(); // Conexion con la base de datos
    
        $consulta = $con->prepare("SELECT * FROM producto"); 
        $consulta->execute();
        $resultados = $consulta->get_result();
        $productos = array();
    
        while ($resultado = $resultados->fetch_object()) {
            if ($resultado->categoria == "5") { // Si la categoria es 5 es de tipo Bebida
                $producto = new Bebida(); // Declara la nueva bebida como objeto
                $producto->setId($resultado->id);
                $producto->setNombre($resultado->nombre);
                $producto->setDescripcion($resultado->descripcion);
                $producto->setPrecio($resultado->precio);
                $producto->setCategoria($resultado->categoria);
                $producto->setImagen($resultado->imagen);
                $producto->setMl($resultado->ml); // Campo adicional de bebida, minilitros
            } else { // Producto normal
                $producto = new Producto(); // Los productos son declarados como clase Producto y se establecen sus valores con Sets
                $producto->setId($resultado->id);
                $producto->setNombre($resultado->nombre);
                $producto->setDescripcion($resultado->descripcion);
                $producto->setPrecio($resultado->precio);
                $producto->setCategoria($resultado->categoria);
                $producto->setImagen($resultado->imagen);
            }
            $productos[] = $producto; // Aquí guardamos todos los campos anteriores de productos en el array principal donde se almacenan todos los productos
        }
        $con->close();
        return $productos; // Devuelve los productos
    }
    
    /*Obtener un producto de la base de datos segun su id*/ 
    public static function obtenerProductoPorID($id) {
        // Con = conexion
        $con = dataBase::connect(); // Conexion con la base de datos
    
        $consulta = $con->prepare("SELECT * FROM producto WHERE id = ?");
        $consulta->bind_param("i", $id);
        $consulta->execute(); // Ejecuta la consulta
        $resultado = $consulta->get_result();
    
        // Verifica si hay resultados
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_object(); // Obtiene una fila como un objeto
    
            if ($fila->categoria == 5) { // Verifica si la categoria es la numero 5 para declarar una bebida o un producto
                $producto = new Bebida();
            } else {
                $producto = new Producto();
            }
    
            // Asigna los valores a las propiedades del objeto $producto
            $producto->setId($fila->id);
            $producto->setNombre($fila->nombre);
            $producto->setDescripcion($fila->descripcion);
            $producto->setPrecio($fila->precio);
            $producto->setCategoria($fila->categoria);
            $producto->setImagen($fila->imagen);
    
            // Si es una Bebida, asigna el valor de 'ml'
            if ($producto instanceof Bebida) {
                $producto->setMl($fila->ml);
            }
    
            $con->close(); // Cierra la conexion
    
            return $producto; // Devuelve el producto obtenido
        } else {
            // Manejo de error cuando no se encuentra el producto
            return null;
        }
    }

    /* Eliminar un producto de la base de datos segun su id*/
    public static function eliminarProductoPorID($id) { // Elimina un producto segun su id.
        // Con = conexion
        $con = dataBase::connect(); // Conexion con la base de datos

        $consulta = $con->prepare("DELETE FROM producto WHERE id= ?"); // Consulta para eliminar un producto segun su id
        $consulta->bind_param("i", $id);
        $consulta->execute(); // Ejecuta la consulta
        $con->close(); // Cierra la conexion
        
    }

    /* Funcion para editar un producto de la base de datos segun su id*/
    public static function editarProductoPorID($id,$nombre,$descripcion,$precio,$categoria,$imagen,$ml) { // Editar un producto
        $con = dataBase::connect();
        $consulta = $con->prepare("UPDATE producto SET nombre = ?, descripcion = ?, precio = ?, categoria = ?, imagen = ?, ml = ? WHERE id = ?"); // Consulta para actualizar segun id
        $consulta->bind_param("ssdssii", $nombre, $descripcion, $precio, $categoria, $imagen, $ml, $id);
        $consulta->execute(); // Ejecuta la consulta
        $con->close(); // Cierra la conexion
    }

    /*Añadir nuevo producto a la base de datos*/
    public static function nuevoProducto($nombre,$descripcion,$precio,$categoria,$imagen,$ml) { // Añade un nuevo producto
        $con = dataBase::connect();
        $consulta = $con->prepare("INSERT INTO producto (id, nombre, descripcion, precio, categoria, imagen, ml) VALUES (NULL, ?, ?, ?, ?, ?, ?)"); // Consulta para añadir un nuevo producto
        $consulta->bind_param("ssdisi", $nombre, $descripcion, $precio, $categoria, $imagen, $ml);
        $consulta->execute(); // Ejecuta la consulta
        $con->close(); // Cierra la conexion
    }
}
?>