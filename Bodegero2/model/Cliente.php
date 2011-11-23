<?php
require_once '../conexion/SQL.php';
require_once '../conexion/Persistence.php';
require_once '../interface/InterfaceModelsUsuario.php';
class Cliente implements  InterfaceModelsUsuario{
    private $_clienteId;
    private $_fechaRegistro;
    private $_personaId;
    private $_tipo;
    private $_usuarioId;
    public function __construct($_clienteId="", $_fechaRegistro="", $_personaId="",$_tipo = "",$usuarioId="") {
        $this->_clienteId = $_clienteId;
        $this->_fechaRegistro = $_fechaRegistro;
        $this->_personaId = $_personaId;
        $this->_tipo = $_tipo;
        $this->_usuarioId = $usuarioId;
    }
    public function getUsuarioId() {
       return $this->_usuarioId;
   }
    public function getClienteId() {
        return $this->_clienteId;
    }
    public function getFechaRegistro() {
        return $this->_fechaRegistro;
    }
    public function getPersonaId() {
        return $this->_personaId;
    }
    public function getTipo() {
        return $this->_tipo;
    }
    public function traerDatos(){
        $sql = new SQL();
        $sql->addTable('cliente');
        $sql->addTipo('consultar');
        $resultado = Persistence::consultar($sql, 1);
        return $resultado;
    }
   public function listar(){
        $todos = $this->traerDatos();
        $lista = array();
        foreach($todos as $registro){
            $_clienteId = $registro['clienteId'];
            $_fechaRegistro = $registro['fechaRegistro'];
            $_personaId = $registro['personaId'];
            $sql = new SQL();
            $sql->addTable('personajuridica');
            $sql->addWhere("personaJuridicaId = $_personaId");
            $sql->addTipo('consultar');
            $res = Persistence::consultar($sql, 1);
            if($res != null){
                $_tipo = 1;
            }else{
                $_tipo = 0;
            }
            $_usuarioId = $registro['usuarioId'];
            $cliente = new Cliente($_clienteId, $_fechaRegistro, $_personaId, $_tipo,$_usuarioId);
            $lista[] = $cliente;
        }
        return $lista;
    }

     public function insertar(){
        $sql = new SQL();
        $sql->addTable("cliente (clienteId,fechaRegistro,personaId,usuarioId)");
        $sql->addTipo('insertar');
        $sql->addValues($this->_clienteId);
        $sql->addValues($this->_fechaRegistro);
        $sql->addValues($this->_personaId);
        $sql->addValues($this->_usuarioId);
        echo $sql;
        return Persistence::consultar($sql, 0);
    }
    public function listarPorUsuario() {
        $sql = new SQL();
        $sql->addTable('cliente');
        $sql->addTipo('consultar');
        $sql->addWhere("usuarioId = $this->_usuarioId");
        $todos = Persistence::consultar($sql, 1);
        $lista = array();
        foreach($todos as $registro){
            $_clienteId = $registro['clienteId'];
            $_fechaRegistro = $registro['fechaRegistro'];
            $_personaId = $registro['personaId'];
            $sql = new SQL();
            $sql->addTable('personajuridica');
            $sql->addWhere("personaJuridicaId = $_personaId");
            $sql->addTipo('consultar');
            $res = Persistence::consultar($sql, 1);
            if($res != null){
                $_tipo = 1;
            }else{
                $_tipo = 0;
            }
            $_usuarioId=$registro['usuarioId'];
            $cliente = new Cliente($_clienteId, $_fechaRegistro, $_personaId, $_tipo,$_usuarioId);
            $lista[] = $cliente;
        }
       
        return $lista;
    }
 }
?>