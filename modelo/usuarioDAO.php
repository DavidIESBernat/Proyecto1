<?php

include_once 'config/dataBase.php';
include_once 'Producto.php';
include_once 'Pedido.php';
include_once 'Categoria.php';
include_once 'Usuario.php';

class usuarioDAO {

    /*Funcion para obtener todos los usuarios de la base de datos*/
    public static function obtenerUsuarios() {
        $con = dataBase::connect(); // Conexion con la base de datos
        $consulta = $con->prepare("SELECT * FROM usuario"); 
        $consulta->execute();
        $resultados = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
        foreach($resultados as $resultado) { // Bucle foreach que recorre todos los usuarios obtenidos
            $usuario = new Usuario(); // Los Usuarios se declaran como tal y se establecen sus valores con Sets
            $usuario->setId($resultado['id']);
            $usuario->setUsername($resultado['username']);
            $usuario->setContraseña($resultado['contraseña']);
            $usuario->setNombre($resultado['nombre']);
            $usuario->setApellido($resultado['apellido']);
            $usuario->setEmail($resultado['email']);
            $usuario->setNumeroTlf($resultado['numeroTlf']);
            $usuario->setDireccion($resultado['direccion']);
            $usuario->setPoblacion($resultado['poblacion']);
    
            $usuarios[] = $usuario; // Guardamos el array usuario actual en el array usuarios
            }
        
            $con->close();
            return $usuarios; // Devuelve los usuarios
    }

    public static function verificarUsuario($username) { 
        // Con = conexion
        $con = dataBase::connect(); // Conexion con la base de datos

        $consulta = $con->prepare("SELECT * FROM USUARIO WHERE username = ?");
        $consulta->bind_param("s", $username);
        $consulta->execute(); // Ejecuta la consulta
        $resultado = $consulta->get_result();
        $usuario = $resultado->fetch_object('Usuario');
        $con->close(); // Cierra la conexion

        return $usuario;
        
    }
}

?>