<?php
require_once '../conexion/SQL.php';
require_once '../conexion/Persistence.php';
require_once '../interface/InterfaceModels.php';
class MarcaCategoria implements InterfaceModels{
    private $_marcaCategoriaId;
    private $_marcaId;
    private $_categoria;
    public function __construct($_marcaCategoriaId="", $_marcaId="", $_categoria="") {
        $this->_marcaCategoriaId = $_marcaCategoriaId;
        $this->_marcaId = $_marcaId;
        $this->_categoria = $_categoria;
    }
    public function getMarcaCategoriaId() {
        return $this->_marcaCategoriaId;
    }
    public function getMarcaId() {
        return $this->_marcaId;
    }
    public function getCategoria() {
        return $this->_categoria;
    }
    public function traerDatos(){
        $sql = new SQL();
        $sql->addTable('marcacategoria');
        $sql->addTipo('consultar');
        $resultado = Persistence::consultar($sql, 1);
        return $resultado;
    }
    public function listar(){
        $todos = $this->traerDatos();
        $lista = array();
        foreach($todos as $registro){
            $_marcaCategoriaId=$registro['marcaCategoriaId'];
            $_marcaId = $registro['marcaId'];
            $_categoria = $registro['categoriaId'];
            $marca = new MarcaCategoria($_marcaCategoriaId, $_marcaId, $_categoria);
            $lista[] = $marca;
        }
        return $lista;
    }
     public function insertar(){
         $sql = new SQL();
        $sql->addTable("marcacategoria (marcaCategoriaId ,marcaId ,categoriaId)");
        $sql->addTipo('insertar');
        $sql->addValues($this->_marcaCategoriaId);
        $sql->addValues($this->_marcaId);
        $sql->addValues($this->_categoria);
        Persistence::consultar($sql, 0);
    }
    public function eliminar(){
        $sql=new SQL();
        $sql->addTipo('eliminar');
        $sql->addTable('marcacategoria');
        $sql->addWhere("marcaCategoriaId = $this->_marcaCategoriaId");;
    }
}
?>