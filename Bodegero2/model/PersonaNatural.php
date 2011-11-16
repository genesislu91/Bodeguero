<?php
require_once 'Persona.php';
class PersonaNatural extends Persona{
    private $_nombre;
    private $_apellidoPaterno;
    private $_apellidoMaterno;
    private $_dni;
    public function __construct($_personaId="",$_telefono="",$_correoElectronico="",$_direccion="",$_nombre="",$_apellidoPaterno="",$_apellidoMaterno="",$dni=""){
        parent::__construct($_personaId, $_telefono, $_correoElectronico, $_direccion);
        $this->_nombre = $_nombre;
        $this->_apellidoPaterno = $_apellidoPaterno;
        $this->_apellidoMaterno = $_apellidoMaterno;
        $this->_dni=$dni;
    }
    public function getNombre() {
        return $this->_nombre;
    }
    public function getDni(){
        return $this->_dni;
    }
    public function getApellidoPaterno() {
        return $this->_apellidoPaterno;
    }
    public function getApellidoMaterno() {
        return $this->_apellidoMaterno;
    }
    public function traerDatos($table){
        $sql = new SQL();
        $sql->addTable($table);
        $sql->addTipo('consultar');
        $pjs = Persistence::consultar($sql, 1);
        return $pjs;

    }
    public function listar(){
        $pjs = $this->traerDatos('personanatural');
        $lista = array();
        foreach($pjs as $p){
            $_personaId = $p['personaNaturalId'];
            $dni = $p['dni'];
            $_nombre = $p['nombre'];
            $_apellidoPaterno=$p['apellidoPaterno'];
            $_apellidoMaterno=$p['apellidoMaterno'];
            $sql = new SQL();
            $sql->addTable('persona');
            $sql->addTipo('consultar');
            $sql->addWhere("personaId = $_personaId");
            $persona = Persistence::consultar($sql,1);
            $_telefono = $persona[0]['telefono'];
            $_correoElectronico = $persona[0]['correoElectronico'];
            $_direccion = $persona[0]['direccion'];
            $lista[]= new PersonaNatural($_personaId, $_telefono, $_correoElectronico, $_direccion, $_nombre, $_apellidoPaterno, $_apellidoMaterno, $dni);
        }
        return $lista;
    }
    public function insertar(){
        $sql = new SQL();
        $sql->addTable("persona (personaId ,telefono,correoElectronico,	direccion)");
        $sql->addTipo('insertar');
        $sql->addValues($this->getPersonaId());
        $sql->addValues($this->getTelefono());
        $sql->addValues($this->getCorreoElectronico());
        $sql->addValues($this->getDireccion());
        Persistence::consultar($sql, 0);
        $sql = new SQL();
        $sql->addTable("personanatural (personaNaturalId,nombre,apellidoPaterno,apellidoMaterno,dni)");
        $sql->addTipo('insertar');
        $sql->addValues($this->getPersonaId());
        $sql->addValues($this->_nombre);
        $sql->addValues($this->_apellidoPaterno);
        $sql->addValues($this->_apellidoMaterno);
        $sql->addValues($this->_dni);
       return Persistence::consultar($sql, 0);
    }
}
?>