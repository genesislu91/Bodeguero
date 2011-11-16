<?php
require_once '../conexion/SQL.php';
require_once '../conexion/Persistence.php';
require_once '../interface/InterfaceModelsUsuario.php';
class Marca implements InterfaceModelsUsuario{
    private $_marcaId;
    private $_nombre;
    private $_usuarioId;
    public function __construct($_marcaId="", $_nombre="",$usuarioId="") {
        $this->_marcaId = $_marcaId;
        $this->_nombre = $_nombre;
        $this->_usuarioId=$usuarioId;
    }
    public function getUsuarioId() {
       return $this->_usuarioId;
   }
    public function getMarcaId() {
        return $this->_marcaId;
    }
    public function getNombre() {
        return $this->_nombre;
    }
    public function traerDatos(){
        $sql = new SQL();
        $sql->addTable('marca');
        $sql->addTipo('consultar');
        $resultado = Persistence::consultar($sql, 1);
        return $resultado;
    }
    public function listar(){
        $todos = $this->traerDatos();
        $lista = array();
        foreach($todos as $registro){
            $_marcaId = $registro['marcaId'];
            $_nombre = $registro['nombre'];
            $_usuarioId=$registro['usuarioId'];
            $marca = new Marca($_marcaId, $_nombre,$_usuarioId);
            $lista[] = $marca;
        }
        return $lista;
    }
    public function listarPorUsuario() {
         $sql = new SQL();
        $sql->addTable('marca');
        $sql->addTipo('consultar');
        $sql->addWhere("usuarioId= $this->_usuarioId");
        $todos = Persistence::consultar($sql, 1);
         $lista = array();
        foreach($todos as $registro){
            $_marcaId = $registro['marcaId'];
            $_nombre = $registro['nombre'];
            $_usuarioId=$registro['usuarioId'];
            $marca = new Marca($_marcaId, $_nombre,$_usuarioId);
            $lista[] = $marca;
        }
        return $lista;
    }
     public function insertar(){
         $sql = new SQL();
        $sql->addTable("marca (marcaId,	nombre , usuarioId)");
        $sql->addTipo('insertar');
        $sql->addValues($this->_marcaId);
        $sql->addValues($this->_nombre);
        $sql->addValues($this->_usuarioId);
       return Persistence::consultar($sql, 0);
    }
    public function actualizar(){}
    public function eliminar($id){}
}

?>