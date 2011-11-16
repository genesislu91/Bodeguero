<?php
require_once '../conexion/SQL.php';
require_once '../conexion/Persistence.php';
abstract class Persona {
    private $_personaId;
    private $_telefono;
    private $_correoElectronico;
    private $_direccion;
    public function __construct($_personaId="", $_telefono="", $_correoElectronico="", $_direccion="") {
        $this->_personaId = $_personaId;
        $this->_telefono = $_telefono;
        $this->_correoElectronico = $_correoElectronico;
        $this->_direccion = $_direccion;
    }
    public function getPersonaId() {
        return $this->_personaId;
    }
    public function getTelefono() {
        return $this->_telefono;
    }
    public function getCorreoElectronico() {
        return $this->_correoElectronico;
    }
    public function getDireccion() {
        return $this->_direccion;
    }
    public function setTelefono($_telefono) {
        $this->_telefono = $_telefono;
    }

    public function setCorreoElectronico($_correoElectronico) {
        $this->_correoElectronico = $_correoElectronico;
    }

    public function setDireccion($_direccion) {
        $this->_direccion = $_direccion;
    }

        public  function actualizar(){
        $sql = new SQL();
        $sql->addTable("persona");
        $sql->addTipo('actualizar');
        $sql->addValues("telefono = '$this->_telefono'");
        $sql->addValues("correoElectronico = '$this->_correoElectronico'");
        $sql->addValues("direccion='$this->_direccion'");
        $sql->addWhere("personaId='$this->_personaId'");
        Persistence::consultar($sql, 0);
    }
    public function traerDatos($table){
        $sql = new SQL();
        $sql->addTable($table);
        $sql->addTipo('consultar');
        $pjs = Persistence::consultar($sql, 1);
        return $pjs;

    }
    public static  function getPersonas(){
        $sql = new SQL();
        $sql->addTable('persona');
        $sql->addTipo('consultar');
        $personas = Persistence::consultar($sql, 1);
        return $personas;
    }

}

?>