<?php
/*
Este archivo corresponde al modelo de la Clase persona, mediante este archivo se podrá establecer la información que el usuario desea insertar, actualizar, eliminar o visualizar (dependiendo de la acción solicitada).
*/
class Persona {
    private $conexion;
    
    private $id = NULL;
    private $nombre;
    private $ape_pat;
    private $ape_mat = '';
    private $rfc;
    private $curp;
    private $fec_nac = '';
    private $fec_alta;
    private $estatus_id;
    private $sexo_id = NULL;
    private $persona_tipo_id;
    private $fec_modificacion = NULL;
    private $avatar = NULL;
    
    public function __construct($conexion) {
        $this->conexion = $conexion; //Se asigna la conexión proporcionada por el controlador PersonaController.
    }
    
    //Se declaran los getters a utilizar
    
    public function getId() {
        return $this->id;
    }
    
    public function getNombre() {
        return $this->nombre;
    }
    
    public function getApePat() {
        return $this->ape_pat;
    }
    
    public function getApeMat() {
        return $this->ape_mat;
    }
    
    public function getRfc() {
        return $this->rfc;
    }
    
    public function getCurp() {
        return $this->curp;
    }
    
    public function getFecNac() {
        return $this->fec_nac;
    }
    
    public function getEstatusId() {
        return $this->estatus_id;
    }
    
    public function getSexoId() {
        return $this->sexo_id;
    }
    
    public function getPersonaTipoId() {
        return $this->persona_tipo_id;
    }
    
    public function getFecModificacion() {
        return $this->fec_modificacion;
    }
    
    public function getAvatar() {
        return $this->avatar;
    }
    
    
    //Se declaran los setters a utilizar
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    public function setApePat($ape_pat) {
        $this->ape_pat = $ape_pat;
    }
    
    public function setApeMat($ape_mat) {
        $this->ape_mat = $ape_mat;
    }
    
    public function setRfc($rfc) {
        $this->rfc = $rfc;
    }
    
    public function setCurp($curp) {
        $this->curp = $curp;
    }
    
    public function setFecNac($fec_nac) {
        $this->fec_nac = $fec_nac;
    }
    
    public function setEstatusId($estatus_id) {
        $this->estatus_id = $estatus_id;
    }
    
    public function setSexoId($sexo_id) {
        $this->sexo_id = $sexo_id;
    }
    
    public function setPersonaTipoId($persona_tipo_id) {
        $this->persona_tipo_id = $persona_tipo_id;
    }
    
    public function setFecModificacion($fec_modificacion) {
        $this->fec_modificacion = $fec_modificacion;
    }
    
    public function setAvatar($avatar) {
        $this->avatar = $avatar;
    }
    
    
    public function agregarPersona() { //Este método que permitirá almacenar en la base de datos los valores establecidos previamente.
        $query = $this->conexion->prepare("INSERT INTO persona VALUES (:id, :nombre, :ape_pat,:ape_mat,:rfc,:curp,:fec_nac,now(),:estatus_id,:sexo_id,:persona_tipo_id,:fec_modificacion,:avatar)"); //Se prepara la consulta
        
        //Se hace el binding de parámetros para la consulta
        $query->bindParam(":id",$this->id);
        $query->bindParam(":nombre",$this->nombre);
        $query->bindParam(":ape_pat",$this->ape_pat);
        $query->bindParam(":ape_mat",$this->ape_mat);
        $query->bindParam(":rfc",$this->rfc);
        $query->bindParam(":curp",$this->curp);
        $query->bindParam(":fec_nac",$this->fec_nac);
        $query->bindParam(":estatus_id",$this->estatus_id);
        $query->bindParam(":sexo_id",$this->sexo_id);
        $query->bindParam(":persona_tipo_id",$this->persona_tipo_id);
        $query->bindParam(":fec_modificacion",$this->fec_modificacion);
        $query->bindParam(":avatar",$this->avatar);
        
        if ($query->execute()) { //Si esta condición se cumple, significa que la sentencia SQL se ejecutó correctamente
            $result = $this->conexion->lastInsertId();
            $findRow = $this->getPersona($result);
            return $findRow;
        }else {
            return [];
        }            
    }
    
    public function modificarPersona() { //Este método que permitirá modificar en la base de datos los valores establecidos previamente.
        $query = $this->conexion->prepare("UPDATE persona SET nombre = :nombre, ape_pat = :ape_pat, ape_mat = :ape_mat, rfc = :rfc, curp = :curp, fecha_nacimiento = :fec_nac, estatus_id = :estatus_id, sexo_id = :sexo_id, persona_tipo_id = :persona_tipo_id, fecha_modificacion = now(), avatar = :avatar WHERE id = :id"); //Se prepara la consulta
        
        //Se hace el binding de parámetros para la consulta
        $query->bindParam(":id",$this->id);
        $query->bindParam(":nombre",$this->nombre);
        $query->bindParam(":ape_pat",$this->ape_pat);
        $query->bindParam(":ape_mat",$this->ape_mat);
        $query->bindParam(":rfc",$this->rfc);
        $query->bindParam(":curp",$this->curp);
        $query->bindParam(":fec_nac",$this->fec_nac);
        $query->bindParam(":estatus_id",$this->estatus_id);
        $query->bindParam(":sexo_id",$this->sexo_id);
        $query->bindParam(":persona_tipo_id",$this->persona_tipo_id);
        $query->bindParam(":avatar",$this->avatar);  
        
        if ($query->execute()) { //Si esta condición se cumple, significa que la sentencia SQL se ejecutó correctamente
            $result = $this->getPersona($this->id);
            return $result;
        }else {
            return [];
        }                             
    }
    
    public function eliminarPersona() { //Este método que permitirá eliminar un registro de la base de datos por medio de su ID.
        $result = [];
        $query = $this->conexion->prepare("DELETE FROM persona WHERE id = :id"); //Se prepara la consulta
        $query->bindParam(":id",$this->id);
        if ($query->execute()) { //Si esta condición se cumple, significa que la sentencia SQL se ejecutó correctamente
            $result = ["eliminado" => true];
        }else {
            $result = ["eliminado" => false];
        }
        $this->conexion = null;
        return $result;                  
    }
    
    public function getPersona($id) { //Este método que permitirá obtener los campos un registro de la base de datos por medio de su ID.
        $result = [];
        $query = $this->conexion->prepare("SELECT * FROM persona WHERE id = :id"); //Se prepara la consulta
        $query->bindParam(":id",$id);
        if ($query->execute()) { //Si esta condición se cumple, significa que la sentencia SQL se ejecutó correctamente
            $result = $query->fetch(PDO::FETCH_ASSOC); //Se utiliza PDO::FETCH_ASSOC para retornar únicamente los 'index name' o índices de nombre
        }
        $this->conexion = null;
        return $result;            
    }
    
    
    public function getPersonas() { //Este método que permitirá obtener todos los registros de la tabla 'Persona' de la base de datos.
        $result = [];
        $query = $this->conexion->prepare("SELECT * FROM persona"); 
        if ($query->execute()) { //Si esta condición se cumple, significa que la sentencia SQL se ejecutó correctamente
            $result = $query->fetchAll(PDO::FETCH_ASSOC); //Se utiliza PDO::FETCH_ASSOC para retornar únicamente los 'index name' o índices de nombre
        }
        $this->conexion = null;
        return $result;
    }
    
}

?>