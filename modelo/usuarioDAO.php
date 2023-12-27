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

    public static function ObtenerUsuarioPorId($id) {
        // Con = conexion
        $con = dataBase::connect(); // Conexion con la base de datos

        $consulta = $con->prepare("SELECT * FROM USUARIO WHERE idUsuario = ?");
        $consulta->bind_param("i", $id);
        $consulta->execute(); // Ejecuta la consulta
        $resultado = $consulta->get_result();
        $usuario = $resultado->fetch_object('Usuario');
        $con->close(); // Cierra la conexion

        return $usuario; // Devuelve el usuario obtenido
    }

    // Funcion que devuelve true o false para determinar si la cuenta actual es el administrador
    public static function verificarAdministrador() {
        session_start();
        
        // Verifica que el usuario que quiere acceder es el administrador, en caso contrario vuelve a la pagina home
        if(isset($_SESSION['usuario']) && $_SESSION['usuario']['username'] == "admin") {
            $admin = true;
        } else {
            $admin = false;
        }
        return $admin;

    }
    // Funcion para verificar que el usuario introducido por el formulario existe en la base de datos, si es asi crea su sesion, si no devuelve un mensaje de error
    public static function verificarUsuario($username, $password) { 

        // La String username se convierte en minuscula
        $username = strtolower($username);

        // Consulta base de datos
        $con = dataBase::connect(); // Conexion con la base de datos
        $consulta = $con->prepare("SELECT * FROM USUARIO WHERE username = ?");
        $consulta->bind_param("s", $username);
        $consulta->execute(); // Ejecuta la consulta
        $resultado = $consulta->get_result();
        $usuario = $resultado->fetch_assoc();

        // Verifica si la contraseña es correcta utilizando password_verify (pd: solocontraseñas cifradas)
            //if($usuario && $usuario && $usuario['username'] == $username && password_verify($password, $usuario['contraseña'])) {

        // Comprueba que el username y la contraseña ingresadas son coincidentes con las encontradas en la base de datos
        if($usuario && $usuario['username'] == $username && $usuario['contraseña'] == $password) {
            // Inicio de sesion correcto.
            $_SESSION['usuario'] = $usuario;

            // Redirige a la pagina home
            header("Location:".url.'?controlador=usuario&accion=perfil');
            exit();
        } else {
            // Si se introducen credenciales incorrectas devolvemos el mensaje de error por sesion y redirigimos al login donde ahora se mostrara el mensaje de error
            $_SESSION["error_message"] = "Usuario o contraseña incorrectos";
            header("Location:" . url . '?controlador=usuario&accion=login');
            exit();
        }
        $con->close(); // Cierra la conexion
        
    }
    
    // Funcion para modificar un usuario desde la vista del perfil
    public static function modificarUsuario($username,$nombre,$apellido,$email,$telefono,$direccion,$poblacion) {
        $con = dataBase::connect();
        $consulta = $con->prepare("UPDATE USUARIO SET nombre = ?, apellido = ?, email = ?, numeroTlf = ?, direccion = ?, poblacion = ? WHERE username = ?"); // Consulta para actualizar segun id
        $consulta->bind_param("sssisss", $nombre, $apellido, $email, $telefono, $direccion, $poblacion, $username);
        $consulta->execute(); // Ejecuta la consulta
        $con->close(); // Cierra la conexion
    }

        // Funcion para registrar un usuario en la base de datos, si el usuario introducido ya existe devuelve un mensaje de error
    public static function verificarRegistro($email, $username, $password) { 

        // La String username y email se convierte en minuscula
        $username = strtolower($username);
        $email = strtolower($email);

        // Consulta base de datos
        $con = dataBase::connect(); // Conexion con la base de datos
        $consulta = $con->prepare("SELECT * FROM USUARIO WHERE username = ?");
        $consulta->bind_param("s", $username);
        $consulta->execute(); // Ejecuta la consulta
        $resultado = $consulta->get_result();
        $usuario = $resultado->fetch_assoc();

        // Comprueba que el username y la contraseña ingresadas son coincidentes con las encontradas en la base de datos
        if($usuario && $usuario['username'] == $username) {
            // Usuario ya existente
            $_SESSION["error_message"] = "Usuario ya existente";
            header("Location:" . url . '?controlador=usuario&accion=registro');
            exit();
        } else {
            // Registramos usuario en la base de datos
            $con = dataBase::connect();
            $consulta = $con->prepare("INSERT INTO USUARIO(idUsuario,username,contraseña,nombre,apellido,email,numeroTlf,direccion,poblacion) VALUES (NULL, ?, ?, NULL, NULL, ?, NULL, NULL, NULL)"); // Consulta para actualizar segun id
            $consulta->bind_param("sss", $username, $password, $email);
            $consulta->execute(); // Ejecuta la consulta
            $con->close(); // Cierra la conexion

            // Redirige a la pagina login
            header("Location:".url.'?controlador=usuario&accion=login');
            exit();
        }
        $con->close(); // Cierra la conexion
        
    }
}
?>