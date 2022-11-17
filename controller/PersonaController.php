<?php
/*
Este archivo corresponde al controlador del modelo Persona, el cual permitirá solicitar a dicho modelo la información necesaria para posteriormente invocar la vista que mostrará la información.
*/

class PersonaController {
    private $conexion; //Esta variable almacenará el objeto PDO de la conexión realizada con la base de datos
    
    public function __construct() {
        require_once(__DIR__ . "/../core/Conexion.php"); //Se incluye el archivo que permitirá crear la conexión
        require_once(__DIR__ . "/../models/Persona.php"); //Se incluye el archivo que corresponde al modelo Persona
        $this->conexion = (new Conexion())->conexion(); //Se crea una conexión a la base de datos
    }
    
    public function crearPersona() { //Este método permitirá crear un objeto Persona, al cual se le establecerán los valores a insertar en la base de datos.
        $persona = new Persona($this->conexion);
        $persona->setNombre($_POST["nombre"]);
        $persona->setApePat($_POST["ape_pat"]);
        $persona->setApeMat($_POST["ape_mat"]);
        $persona->setRfc($_POST["rfc"]);
        $persona->setCurp($_POST["curp"]);
        $persona->setFecNac($_POST["fec_nac"]);
        $persona->setEstatusId(3);
        $persona->setSexoId(1);
        $persona->setPersonaTipoId(1);
        $persona->setFecModificacion('2022-11-17');
        $persona->setAvatar('url');
        $agregar = $persona->agregarPersona(); //Se invoca el método que permitirá almacenar en la base de datos los valores establecidos previamente
        $this->view("indexView",$agregar); //Se ejecuta método que invocará la vista que mostrará el resultado de la inserción.
    }
    
    public function actualizarPersona() { //Este método permitirá crear un objeto Persona, al cual se le establecerán los valores a modificar en la base de datos.
        $persona = new Persona($this->conexion);
        $persona->setId($_POST["id"]);
        $persona->setNombre($_POST["nombre"]);
        $persona->setApePat($_POST["ape_pat"]);
        $persona->setApeMat($_POST["ape_mat"]);
        $persona->setRfc($_POST["rfc"]);
        $persona->setCurp($_POST["curp"]);
        $persona->setFecNac($_POST["fec_nac"]);
        $persona->setEstatusId(3);
        $persona->setSexoId(1);
        $persona->setPersonaTipoId(1);
        $persona->setFecModificacion(date('Y-m-d'));
        $persona->setAvatar('url');
        $modificar = $persona->modificarPersona(); //Se invoca el método que permitirá modificar en la base de datos los valores del registro que se desea modificar.
        $this->view("indexView",$modificar); //Se ejecuta método que invocará la vista que mostrará el resultado de la modificación.
    }
    
    public function removerPersona() { //Este método permitirá crear un objeto Persona, al cual se le establecerá el ID correspondiente al registro que se desea eliminar de la base de datos.
        $persona = new Persona($this->conexion);
        $persona->setId($_POST["id"]);
        $eliminar = $persona->eliminarPersona(); //Se invoca el método que permitirá eliminar el registro de la base de datos identificado por su ID.
        $this->view("indexView",$eliminar); //Se ejecuta método que invocará la vista que mostrará el resultado de la eliminación.
    }        
    
    public function verPersonas() { //Este método permitirá crear un objeto Persona, a fin de invocar el método que permitirá obtener todos los registros de la tabla 'Persona' de la base de datos.
        $persona = new Persona($this->conexion);
        $personas = $persona->getPersonas();
        $this->view("indexView",$personas); //Se ejecuta método que invocará la vista que mostrará el resultado de la consulta.
    }
    
    public function ejecutar($accion) { //Este método permitirá ejecutar el método correspondiente en base a la acción a realizar.
        switch ($accion) {
            case 'read':
                $this->verPersonas();
                break;
                case 'create':
                    $this->crearPersona();
                    break;
                    case 'update':
                        $this->actualizarPersona();
                        break;
                        case 'delete':
                            $this->removerPersona();
                            break;
                        }
                    }
                    
                    public function view($vista, $datos) { //Este método permitirá invocar la vista que mostrará la información proporcionada por cada uno de los métodos.
                        require_once __DIR__ . "/../view/".$vista.".php";
                    }
                }
                
?>