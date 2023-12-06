<?php
include_once 'modelo/productoDAO.php';
include_once 'modelo/pedidoDAO.php';
include_once 'modelo/usuarioDAO.php';
include_once 'modelo/categoriaDAO.php';
include_once 'modelo/Producto.php';
include_once 'modelo/Pedido.php';

class categoriaControlador {

    // Funcion que muestra una lista con las categorias existentes *SOLO ADMINISTRADOR*
    public function mostrarCategorias() {
        //Llama a la funcion de usuarioDAO que verifica si el usuario actual es administrador
        $admin = usuarioDAO::verificarAdministrador();

        // Si admin es true accede, en caso contrario vuelve al home
        if($admin) {
            $categorias = categoriaDAO::obtenerCategorias();
            include_once 'vista/mostrarCategorias.php';
        } else {
            header("Location:".url.'?controlador=producto');
        }
    }
        
    // Funcion que muestra la vista para añadir una nueva categoria *SOLO ADMINISTRADOR*
    public function nuevaCategoria() {
        //Llama a la funcion de usuarioDAO que verifica si el usuario actual es administrador
        $admin = usuarioDAO::verificarAdministrador();

        // Si admin es true accede, en caso contrario vuelve al home
        if($admin) {
            include_once 'vista/nuevaCategoria.php';
        } else {
            header("Location:".url.'?controlador=producto');
        }
    }

    // Funcion para añadir una nueva categoria *SOLO ADMINISTRADOR*
    public function añadirCategoria() {
        //Llama a la funcion de usuarioDAO que verifica si el usuario actual es administrador
        $admin = usuarioDAO::verificarAdministrador();

        // Si admin es true accede, en caso contrario vuelve al home
        if($admin) {
            $nombre = $_POST['nombre'];
            $descripcion= $_POST['descripcion'];
            $imagen = $_POST['imagen'];

            categoriaDAO::nuevaCategoria($nombre,$descripcion,$imagen);
            header("Location:".url.'?controlador=categoria&accion=nuevaCategoria');
        } else {
            header("Location:".url.'?controlador=producto');
        }
    }

    // Funcion para eliminar una categoria *SOLO ADMINISTRADOR*
    public function eliminarCategoria() {

        //Llama a la funcion de usuarioDAO que verifica si el usuario actual es administrador
        $admin = usuarioDAO::verificarAdministrador();

        // Si admin es true accede, en caso contrario vuelve al home
        if($admin) {
            $id= $_POST['id'];
            categoriaDAO::eliminarCategoriaPorID($id);
            header("Location:".url.'?controlador=categoria&accion=mostrarCategorias');
        } else {
            header("Location:".url.'?controlador=producto');
        }
    }

    // Funcion que muestra una vista para modificar el producto seleccionado *SOLO ADMINISTRADOR*
    public function modificarCategoria() {

            //Llama a la funcion de usuarioDAO que verifica si el usuario actual es administrador
            $admin = usuarioDAO::verificarAdministrador();

            // Si admin es true accede, en caso contrario vuelve al home
            if($admin) {
                $id = $_POST['id'];
                $categoria = categoriaDAO::obtenerCategoriaPorID($id); // Devuelve la categoria con id coincidente
                if($categoria != NULL) {
                    include_once 'vista/vistaEditarCategoria.php';
                } else {
                    echo 'ID no asignado a ninguna categoria';
                }
            } else {
                header("Location:".url.'?controlador=producto');
            }
            
    }

    // Funcion para editar una categoria *SOLO ADMINISTRADOR*
    public function editarCategoria() {

        //Llama a la funcion de usuarioDAO que verifica si el usuario actual es administrador
        $admin = usuarioDAO::verificarAdministrador();

        // Si admin es true accede, en caso contrario vuelve al home
        if($admin) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $descripcion= $_POST['descripcion'];
            $imagen = $_POST['imagen'];

            categoriaDAO::editarCategoriaPorID($id,$nombre,$descripcion,$imagen);
            header("Location:".url.'?controlador=categoria&accion=mostrarCategorias');
        } else {
            header("Location:".url.'?controlador=producto');
        }
    }
}
?>