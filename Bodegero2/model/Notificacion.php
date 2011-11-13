<?php
require_once '../conexion/SQL.php';
require_once '../conexion/Persistence.php';
require_once '../interface/InterfaceModelsUsuario.php';
class Notificacion implements InterfaceModelsUsuario{
   private $_notificacionId;
   private $_descripcion;
   private $_fecha;
   private $_usuarioId;
   function __construct($_notificacionId="", $_descripcion="", $_fecha="", $_usuarioId="") {
       $this->_notificacionId = $_notificacionId;
       $this->_descripcion = $_descripcion;
       $this->_fecha = $_fecha;
       $this->_usuarioId = $_usuarioId;
   }
   public function getNotificacionId() {
       return $this->_notificacionId;
   }

   public function getDescripcion() {
       return $this->_descripcion;
   }

   public function getFecha() {
       return $this->_fecha;
   }

   public function getUsuarioId() {
       return $this->_usuarioId;
   }
public function traerDatos(){
        $sql = new SQL();
        $sql->addTable('notificacion');
        $sql->addTipo('consultar');
        $sql->addWhere("usuarioId= $this->_usuarioId");
        $resultado = Persistence::consultar($sql, 1);
        return $resultado;
    }
    public function listar(){
        $todos = $this->traerDatos();
        $lista = array();
        foreach($todos as $registro){
            $_notificacionId = $registro['notificacionId'];
            $_descripcion = $registro['descripcion'];
            $_fecha=$registro['fecha'];
            $_usuarioId=$registro['usuarioId'];
            $notificacion= new Notificacion($_notificacionId, $_descripcion, $_fecha, $_usuarioId);
            $lista[] = $notificacion;
        }
        return $lista;
    }
    public function listarPorUsuario() {
        $sql = new SQL();
        $sql->addTable('notificacion');
        $sql->addTipo('consultar');
        $sql->addWhere("usuarioId= $this->_usuarioId");
        $todos = Persistence::consultar($sql, 1);
        $lista = array();
        foreach($todos as $registro){
            $_notificacionId = $registro['notificacionId'];
            $_descripcion = $registro['descripcion'];
            $_fecha=$registro['fecha'];
            $_usuarioId=$registro['usuarioId'];
            $notificacion= new Notificacion($_notificacionId, $_descripcion, $_fecha, $_usuarioId);
            $lista[] = $notificacion;
        }
        return $lista;
    }
     public function insertar(){
         $sql = new SQL();
        $sql->addTable("notificacion (notificacionId, descripcion,fecha,usuarioId)");
        $sql->addTipo('insertar');
        $sql->addValues($this->_notificacionId);
        $sql->addValues($this->_descripcion);
        $sql->addValues($this->_fecha);
        $sql->addValues($this->_usuarioId);
        Persistence::consultar($sql, 0);
    }


}
?>
