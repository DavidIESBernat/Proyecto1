<?php
include_once 'modelo/productoDAO.php';
include_once 'modelo/categoriaDAO.php';
include_once 'modelo/pedidoDAO.php';
include_once 'modelo/Producto.php';
include_once 'modelo/Pedido.php';


// Controlador del usuario, login, modificar contraseña etc...
class usuarioControlador {

    // Funcion por si index.php trata de acceder a index de usuarioControlador, automaticamente redirige al controlador de producto
    public function index() {
        header("Location:".url."?controlador=producto");
    }

    // Funcion para cargar la vista de iniciar sesion
    public function login() {
        session_start();

        // Comprobacion para evitar iniciar sesion si ya tenemos una sesion iniciada
        if(isset($_SESSION['usuario'])) {
            header("Location:".url."?controlador=usuario&accion=perfil");
        } else {
            // Header
            include_once 'vista/header.php';
            // Main
            include_once 'vista/login.php';
            // Footer
            include_once 'vista/footer.php';
        }
    }

    // Funcion utiliza para iniciar sesion verificando si los campos son correctos creando la sesion correspondiente
    public function verificarLogin() {
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Llama a la funcion verificarUsuario de usuarioDAO y envia el usuario y la contraseña enviados en la vista login
            usuarioDAO::verificarUsuario($username, $password);
        }
    }

    // Funcion para acceder a la vista del perfil de usuario
    public function perfil() {
        session_start();
        $id = $_SESSION['usuario']['idUsuario'];
        $usuario = usuarioDAO::obtenerUsuarioPorId($id);

        // Header
        include_once 'vista/header.php';
        // Main
        include_once 'vista/perfil.php';
        // Footer
        include_once 'vista/footer.php';
    }
    // Destruir la sesion actual de usuario
    public function logout() {
        session_start();
        unset($_SESSION['usuario']);
        header("Location:".url."?controlador=producto");
    }

    // Funcion para modificar un usuario llamado desde la vista perfil
    public function modificarUsuario() {
        $username = $_POST['username'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $telefono = $_POST['numero'];
        $direccion = $_POST['direccion'];
        $poblacion = $_POST['poblacion'];
        
        usuarioDAO::modificarUsuario($username,$nombre,$apellido,$email,$telefono,$direccion,$poblacion);
        header("Location:".url.'?controlador=usuario&accion=perfil');

    }
}
?>