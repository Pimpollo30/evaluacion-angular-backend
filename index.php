<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
/*
Como su nombre lo indica, es el archivo index.php, este archivo permitirá acceder como tal al sistema inicializando el controlador a utilizar (en nuestro persona, Persona) y la acción a ejecutar solicitda por el usuario.
*/

require_once("config/global.php"); //Se incluye el archivo que contiene valores de las constantes que utilizaremos en caso de que no se proporcione un controlador y una acción en específico.

$controllerName = isset($_GET["c"]) ? $_GET["c"] : default_controller; //Se establece el controlador a utilizar, si no se proporciona se utiliza el predeterminado definido en la constante 'default_controller'.
$controller = requireController($controllerName); //Se invoca el método  que permitirá crear el objeto del controlador
ejecutarAccion($controller); //Se invoca el método que permitirá ejecutar la acción correspondiente a realizar

function requireController($controllerName) { //Este método permitirá crear el objeto del controlador
    $controller = null;
    switch ($controllerName) {
        case "personas":
            require_once('controller/PersonaController.php');
            $controller = new PersonaController();
            break;
        }
        return $controller;
    }
    
    function ejecutarAccion($controller) { //Este método permitirá ejecutar la acción correspondiente a realizar 
        $accion = isset($_GET["accion"]) ? $_GET["accion"] : null; //Se establece la acción a realizar
        if (!is_null($accion) || !empty($accion)) { //Se comprueba si la acción no es nula o vacía
            $controller->ejecutar($accion); //Se invoca el método de la clase del  controlador que ejecutará la acción a realizar
        }else {
            $controller->ejecutar(default_action); //Se invoca el método de la clase del controlador que ejecutará la acción predeterminada a realizar
        }
    }
?>