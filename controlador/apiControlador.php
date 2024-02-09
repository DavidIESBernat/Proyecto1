<?php
include_once 'modelo/productoDAO.php';
include_once 'modelo/pedidoDAO.php';
include_once 'modelo/usuarioDAO.php';
include_once 'modelo/categoriaDAO.php';
include_once 'modelo/Producto.php';
include_once 'modelo/Pedido.php';
include_once 'modelo/opinionDAO.php';
include_once 'modelo/Opinion.php';

class apiControlador{    
 
    // Funcion que detecta la accion a realizar
    public function index(){
       
        // If para obtener las opiniones
        if($_GET["accion"] == 'mostrar_opiniones') {
            $opiniones = $this->mostrarOpiniones();
        }   
        //If para añadir una nueva opinion
        if($_GET["accion"] == 'nueva_opinion') {
            $this->nuevaOpinion();
            
        }   
    }

    // Funcion para obtener todas las opiniones de los pedidos
    public function mostrarOpiniones() {

        $opiniones = opinionDAO::obtenerOpiniones();
        echo json_encode($opiniones, JSON_UNESCAPED_UNICODE);
        
    }

    // Funcion para añadir una nueva opinion a la base de datos
    public function nuevaOpinion() {

        // Obtiene los datos enviados
        $data = json_decode(file_get_contents("php://input"));
        
        // Comprueba que los datos obtenidos son validos
        if (isset($data->numeroPedido, $data->tituloOpinion, $data->descripcion, $data->valoracion, $data->nombre)) {
            // Llama a la función nuevaOpinion de opinionDAO para insertar la opinion en la base de datos
            opinionDAO::nuevaOpinion(
                $data->numeroPedido,
                $data->tituloOpinion,
                $data->descripcion,
                $data->valoracion,
                $data->nombre
            );
            // Mensaje que se recibe por consola indicando que se ha añadido correctamente
            echo json_encode(['message' => 'Opinión guardada con éxito'], JSON_UNESCAPED_UNICODE);
        } else {
            // Devuelve una respuesta de error en caso de faltar datos
            http_response_code(400); 
            echo json_encode(['error' => 'Faltan valores'], JSON_UNESCAPED_UNICODE);
        }
    }

    public function guardarPropina() {
        // Obtiene los datos enviados
        $data = json_decode(file_get_contents("php://input"));
    
        // Comprueba que los datos obtenidos son válidos
        if (isset($data->porcentajePropina)) {
            // Lógica para guardar la propina en la base de datos o realizar otras operaciones necesarias
            // Puedes llamar a funciones de un modelo (por ejemplo, propinaDAO::guardarPropina()) según tu estructura
            // Aquí se asume que propinaDAO es un modelo que maneja la lógica de la base de datos para la propina
            propinaDAO::guardarPropina(
                $data->porcentajePropina,
                // Aquí puedes agregar más datos relacionados con la propina si es necesario
            );
            // Mensaje que se recibe por consola indicando que se ha guardado correctamente
            echo json_encode(['message' => 'Propina guardada con éxito'], JSON_UNESCAPED_UNICODE);
        } else {
            // Devuelve una respuesta de error en caso de faltar datos
            http_response_code(400); 
            echo json_encode(['error' => 'Faltan valores'], JSON_UNESCAPED_UNICODE);
        }
    }
}
?>
