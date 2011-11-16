<?php
require_once '../conexion/SQL.php';
require_once '../conexion/Persistence.php';
require_once '../interface/InterfaceModelsUsuario.php';
class Categoria implements InterfaceModelsUsuario{
    private $_categoriaId;
    private $_nombre;
    private $_descripcion;
    private $_usuarioId;
    public function __construct($_categoriaId="",$_nombre="",$_descripcion="",$usuarioId=""){
        $this->_categoriaId = $_categoriaId;
        $this->_nombre = $_nombre;
        $this->_descripcion = $_descripcion;
        $this->_usuarioId=$usuarioId;
    }
    public function getUsuarioId() {
       return $this->_usuarioId;
   }
    public function getCategoriaId() {
        return $this->_categoriaId;
    }
    public function getNombre() {
        return $this->_nombre;
    }
    public function getDescripcion() {
        return $this->_descripcion;
    }
    public function setNombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function setDescripcion($_descripcion) {
        $this->_descripcion = $_descripcion;
    }

        public function traerDatos(){
        $sql = new SQL();
        $sql->addTable('categoria');
        $sql->addTipo('consultar');
        $usuarios = Persistence::consultar($sql, 1);
        return $usuarios;
    }
    public function listar(){
        $todos = $this->traerDatos();
        $lista = array();
        foreach($todos as $registro){
            $_categoriaId = $registro['categoriaId'];
            $_nombre = $registro['nombre'];
            $_descripcion = $registro['descripcion'];
            $_usuarioId=$registro['usuarioId'];
            $categoria = new Categoria($_categoriaId, $_nombre, $_descripcion,$_usuarioId);
            $lista[] = $categoria;
        }
        return $lista;
    }
    public function insertar(){
         $sql = new SQL();
        $sql->addTable("categoria (categoriaId,	nombre,	descripcion,usuarioId)");
        $sql->addTipo('insertar');
        $sql->addValues($this->_categoriaId);
        $sql->addValues($this->_nombre);
        $sql->addValues($this->_descripcion);
        $sql->addValues($this->_usuarioId);
        return Persistence::consultar($sql, 0);
    }
    public function actualizar(){
         $sql = new SQL();
        $sql->addTable("categoria ");
        $sql->addTipo('actualizar');
        $sql->addValues("nombre = '$this->_nombre'");
        $sql->addValues("descripcion='$this->_descripcion'");
        $sql->addWhere("categoriaId='$this->_categoriaId'");
        Persistence::consultar($sql, 0);
    }
    public function listarPorUsuario() {
        $sql = new SQL();
        $sql->addTable('categoria');
        $sql->addTipo('consultar');
        $sql->addWhere("usuarioId= $this->_usuarioId");
        $todos = Persistence::consultar($sql, 1);
        $lista = array();
        foreach($todos as $registro){
            $_categoriaId = $registro['categoriaId'];
            $_nombre = $registro['nombre'];
            $_descripcion = $registro['descripcion'];
            $_usuarioId=$registro['usuarioId'];
            $categoria = new Categoria($_categoriaId, $_nombre, $_descripcion,$_usuarioId);
            $lista[] = $categoria;
        }
        return $lista;
    }
}
?>