<?php
require_once '../conexion/SQL.php';
require_once '../conexion/Persistence.php';
require_once '../interface/InterfaceModelsUsuario.php';
class Proveedor implements InterfaceModelsUsuario{
    private $_proveedorId;
    private $_personaId;
    public function __construct($_proveedorId="",$_personaId="",$usuarioId=""){
        $this->_proveedorId = $_proveedorId;
        $this->_personaId = $_personaId;
        $this->_usuarioId=$usuarioId;
    }
    public function getUsuarioId() {
       return $this->_usuarioId;
   }
    public function getProveedorId(){
        return $this->_proveedorId;
    }
    public function getPersonaId() {
        return $this->_personaId;
    }
    public function traerDatos(){
        $sql = new SQL();
        $sql->addTable('proveedor');
        $sql->addTipo('consultar');
        $usuarioId=$_SESSION['usuario'];
        $sql->addWhere("usuarioId= $usuarioId");
        $resultado = Persistence::consultar($sql, 1);
        return $resultado;
    }
   public function listar(){
        $todos = $this->traerDatos();
        $lista = array();
        foreach($todos as $registro){
            $_proveedorId=$registro['proveedorId'];
            $_personaId = $registro['personaJuridicaId'];
            $_usuarioId=$registro['usuarioId'];
            $proveedor = new Proveedor($_proveedorId, $_personaId,$_usuarioId);
            $lista[] = $proveedor;
        }
        return $lista;
    }
    public function listarPorUsuario() {
        $sql = new SQL();
        $sql->addTable('proveedor');
        $sql->addTipo('consultar');
        $sql->addWhere("usuarioId= $this->_usuarioId");
        $todos = Persistence::consultar($sql, 1);
        $lista = array();
        foreach($todos as $registro){
            $_proveedorId=$registro['proveedorId'];
            $_personaId = $registro['personaJuridicaId'];
            $_usuarioId=$registro['usuarioId'];
            $proveedor = new Proveedor($_proveedorId, $_personaId,$_usuarioId);
            $lista[] = $proveedor;
        }
        return $lista;
    }
     public function insertar(){
         $sql = new SQL();
        $sql->addTable("proveedor (proveedorId 	personaJuridicaId , usuarioId)");
        $sql->addTipo('insertar');
        $sql->addValues($this->_proveedorId);
        $sql->addValues($this->_personaId);
        $sql->addValues($this->_usuarioId);
        Persistence::consultar($sql, 0);
    }
    
}
?>