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

    /* Funcion para obtener todas las categorias de la base de datos*/
    public static function obtenerCategorias() { // Devuelve todas las categorias.
        $con = dataBase::connect(); // Conexion con la base de datos
        $consulta = $con->prepare("SELECT * FROM categoria"); 
        $consulta->execute();
        $resultados = $consulta->get_result()->fetch_all(MYSQLI_ASSOC); // Obtiene todas las categorias

        foreach($resultados as $resultado) { // Bucle foreach que recorre las categorias
            $categoria = new Categoria(); // Declaracion de una nueva categoria en la que guardamos todos sus valores con sets
            $categoria->setId($resultado['id']);
            $categoria->setNombre($resultado['nombre']);
            $categoria->setDescripcion($resultado['descripcion']);
            $categoria->setImagen($resultado['imagen']);
    
            $categorias[] = $categoria; // Guardamos la categoria en el array categorias
        }
    
        $con->close();
        return $categorias; // Devuelve las categorias

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

    // Funcion para añadir al carrito un pedido desde la carta
    public static function pedido($id) {
        $nuevoPedido = new Pedido(productoDAO::obtenerProductoPorID($_POST['id'])); // Crea un nuevo pedido en base a la id
        $posicion = false; // Posicion por defecto sera false

        foreach ($_SESSION['selecciones'] as $pos => $pedidoExistente) { // Bucle foreach que recorre los pedidos y devuelve su posicion en el array junto al pedido
            if ($pedidoExistente->compararPedido($nuevoPedido)) { // Compara los dos pedidos para verificar si ya existe, si es el caso guarda en posicion la posicion del array donde se encuentra
                $posicion = $pos; // Guarda la posicion de $pos en $posicion
                break; // Corta el bucle foreach si entra al if y se ejecuta
            }
        }

        if ($posicion !== false) { // Si la posicion es false se creara un nuevo pedido, en caso contrario se añadira uno a la cantidad del pedido actual
            $_SESSION['selecciones'][$posicion]->setCantidad($_SESSION['selecciones'][$posicion]->getCantidad() + 1); // El pedido ya existe en el carrito y se incrementa la cantidad
        } else {
            array_push($_SESSION['selecciones'], $nuevoPedido); // El pedido no existe en el carrito y se añade
        }
        header("Location:".url.'?controlador=producto&accion=carta#0'.$_POST['id']); // Vuelve a la posicion de la carta donde nos encontrabamos
    }

    // Devuelve el precio total de todos los pedidos
    public static function precioTotalPedido() { 
        // Variables declaradas como 0     
        $precioTotal = 0;
        $precioTotalConjunto = 0;

        // Bucle para recorrer el array de la session y guardar en $pedido sus array indexadas
        foreach ($_SESSION['selecciones'] as $pedido) {
            $precio = $pedido->getProducto()->getPrecio(); // Guarda el precio de el producto actual
            $cantidad = $pedido->getCantidad(); // Guarda la cantidad del mismo producto
            $precioTotal = $precio * $cantidad; // Multiplica el precio por la cantidad de productos añadidos
            $precioTotalConjunto = $precioTotalConjunto + $precioTotal; // Autosuma los precios anteriores con el valor total
        }
        return $precioTotalConjunto; // Devuelve precio total de todos los productos de la sesion
    }
}
    
?>