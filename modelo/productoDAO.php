<?php

include_once 'config/dataBase.php';
include_once 'Producto.php';
include_once 'Bebida.php';
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
            if($resultado['categoria'] == "5") { // Si la categoria es 5 es de tipo Bebida
                $producto = new Bebida(); // Declara la nueva bebida como objeto
                $producto->setId($resultado['id']);
                $producto->setNombre($resultado['nombre']);
                $producto->setDescripcion($resultado['descripcion']);
                $producto->setPrecio($resultado['precio']);
                $producto->setCategoria($resultado['categoria']);
                $producto->setImagen($resultado['imagen']);
                $producto->setMl($resultado['ml']); // Campo adicional de bebida, minilitros
        
                $productos[] = $producto; // Aqui guardamos todos los campos anterior de productos en el array principal donde se almacenan todos los productos
            } else { // Producto normal
                $producto = new Producto(); // Los productos son declarados como clase Producto y se establecen sus valores con Sets
                $producto->setId($resultado['id']);
                $producto->setNombre($resultado['nombre']);
                $producto->setDescripcion($resultado['descripcion']);
                $producto->setPrecio($resultado['precio']);
                $producto->setCategoria($resultado['categoria']);
                $producto->setImagen($resultado['imagen']);
        
                $productos[] = $producto; // Aqui guardamos todos los campos anterior de productos en el array principal donde se almacenan todos los productos
            }
            
        }
        
        $con->close();
        return $productos; // Devuelve los productos
    }
    
    /*Obtener un producto de la base de datos segun su id*/ 
    public static function obtenerProductoPorID($id) {
        // Con = conexion
        $con = dataBase::connect(); // Conexion con la base de datos
    
        $consulta = $con->prepare("SELECT * FROM PRODUCTO WHERE id = ?");
        $consulta->bind_param("i", $id);
        $consulta->execute(); // Ejecuta la consulta
        $resultado = $consulta->get_result();
    
        // Verifica si hay resultados
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc(); // Obtén una fila como un array asociativo
    
            // Verifica la categoría y crea un objeto correspondiente
            if ($fila['categoria'] == 5) {
                $producto = new Bebida();
            } else {
                $producto = new Producto();
            }
    
            // Asigna los valores a las propiedades del objeto $producto
            $producto->setId($fila['id']);
            $producto->setNombre($fila['nombre']);
            $producto->setDescripcion($fila['descripcion']);
            $producto->setPrecio($fila['precio']);
            $producto->setCategoria($fila['categoria']);
            $producto->setImagen($fila['imagen']);
    
            // Si es una Bebida, asigna el valor de 'ml'
            if ($producto instanceof Bebida) {
                $producto->setMl($fila['ml']);
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

        $consulta = $con->prepare("DELETE FROM PRODUCTO WHERE id= ?"); // Consulta para eliminar un producto segun su id
        $consulta->bind_param("i", $id);
        $consulta->execute(); // Ejecuta la consulta
        $con->close(); // Cierra la conexion
        
    }

    /* Funcion para editar un producto de la base de datos segun su id*/
    public static function editarProductoPorID($id,$nombre,$descripcion,$precio,$categoria,$imagen,$ml) { // Editar un producto
        $con = dataBase::connect();
        $consulta = $con->prepare("UPDATE PRODUCTO SET nombre = ?, descripcion = ?, precio = ?, categoria = ?, imagen = ?, ml = ? WHERE id = ?"); // Consulta para actualizar segun id
        $consulta->bind_param("ssdssii", $nombre, $descripcion, $precio, $categoria, $imagen, $ml, $id);
        $consulta->execute(); // Ejecuta la consulta
        $con->close(); // Cierra la conexion
    }

    /*Añadir nuevo producto a la base de datos*/
    public static function nuevoProducto($nombre,$descripcion,$precio,$categoria,$imagen,$ml) { // Añade un nuevo producto
        $con = dataBase::connect();
        $consulta = $con->prepare("INSERT INTO PRODUCTO (id, nombre, descripcion, precio, categoria, imagen, ml) VALUES (NULL, ?, ?, ?, ?, ?, ?)"); // Consulta para añadir un nuevo producto
        $consulta->bind_param("ssdisi", $nombre, $descripcion, $precio, $categoria, $imagen, $ml);
        $consulta->execute(); // Ejecuta la consulta
        $con->close(); // Cierra la conexion
    }
}
?>