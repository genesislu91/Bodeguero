<?php
require_once '../conexion/SQL.php';
require_once '../conexion/Persistence.php';
require_once '../interface/InterfaceModels.php';
class UnidadMedida implements InterfaceModels{
  private $_unidadMedidaId;
  private $_nombre;
  function __construct($_unidadMedidaId="", $_nombre="") {
      $this->_unidadMedidaId = $_unidadMedidaId;
      $this->_nombre = $_nombre;
  }
  public function getUnidadMedidaId() {
      return $this->_unidadMedidaId;
  }

  public function getNombre() {
      return $this->_nombre;
  }
public function traerDatos(){
        $sql = new SQL();
        $sql->addTable('unidadmedida');
        $sql->addTipo('consultar');
        $resultado = Persistence::consultar($sql, 1);
        return $resultado;
    }
    public function listar(){
        $todos = $this->traerDatos();
        $lista = array();
        foreach($todos as $registro){
            $_unidadMedidaId = $registro['unidadMedidaId'];
            $_nombre = $registro['nombre'];
            $marca = new UnidadMedida($_unidadMedidaId, $_nombre);
            $lista[] = $marca;
        }
        return $lista;
    }
     public function insertar(){
         $sql = new SQL();
        $sql->addTable("categoria (categoriaId,	nombre,	descripcion)");
        $sql->addTipo('insertar');
        $sql->addValues($this->_categoriaId);
        $sql->addValues($this->_nombre);
        $sql->addValues($this->_descripcion);
        Persistence::consultar($sql, 0);
    }


}
?>
