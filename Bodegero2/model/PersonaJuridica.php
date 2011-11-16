<?php
require_once 'Persona.php';
class PersonaJuridica extends Persona{
    private $_ruc;
    private $_razonSocial;
    public function __construct($_personaId="",$_telefono="",$_correoElectronico="",$_direccion="",$_ruc="",$_razonSocial="") {
        parent::__construct($_personaId, $_telefono, $_correoElectronico, $_direccion);
        $this->_ruc = $_ruc;
        $this->_razonSocial = $_razonSocial;
    }
    public function getRuc() {
        return $this->_ruc;
    }
    public function getRazonSocial() {
        return $this->_razonSocial;
    }
    
    public function listar(){
        $pjs = $this->traerDatos('personajuridica');
        $lista = array();
        foreach($pjs as $p){
            $_personaId = $p['personaJuridicaId'];
            $_razonSocial = $p['razonSocial'];
            $_ruc = $p['ruc'];
            $sql = new SQL();
            $sql->addTable('persona');
            $sql->addTipo('consultar');
            $sql->addWhere("personaId = $_personaId");
            $persona = Persistence::consultar($sql,1);
            if($persona!=null){
            $_telefono = $persona[0]['telefono'];
            $_correoElectronico = $persona[0]['correoElectronico'];
            $_direccion = $persona[0]['direccion'];
            $lista[]= new PersonaJuridica($_personaId, $_telefono, $_correoElectronico, $_direccion, $_ruc, $_razonSocial);
            
            }
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
        $id=Persistence::consultar($sql, 0);
        $sql = new SQL();
        $sql->addTable("personajuridica (personaJuridicaId ,razonSocial ,ruc)");
        $sql->addTipo('insertar');
        $sql->addValues($id);
        $sql->addValues($this->_razonSocial);
        $sql->addValues($this->_ruc);
        $nid=Persistence::consultar($sql, 0);
        
        return $nid;
    }
    
}
?>