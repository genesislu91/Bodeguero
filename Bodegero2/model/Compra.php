<?php
require_once '../conexion/SQL.php';
require_once '../conexion/Persistence.php';
require_once '../interface/InterfaceModelsUsuario.php';
class Compra implements InterfaceModelsUsuario{
    private $_compraId;
    private $_montoTotal;
    private $_fechaCompra;
    private $_proveedorId;
    private $_usuarioId;
    function __construct($_compraId="",$_montoTotal="",$_fechaCompra="",$_proveedirId="",$usuarioId=""){
        $this->_compraId = $_compraId;
        $this->_montoTotal = $_montoTotal;
        $this->_fechaCompra = $_fechaCompra;
        $this->_proveedorId = $_proveedirId;
        $this->_usuarioId=$usuarioId;
    }
    public function getUsuarioId() {
       return $this->_usuarioId;
   }
    public function getCompraId() {
        return $this->_compraId;
    }
    public function getMontoTotal() {
        return $this->_montoTotal;
    }
    public function getFechaCompra() {
        return $this->_fechaCompra;
    }
    public function getProveedorId() {
        return $this->_proveedorId;
    }
    public function traerDatos(){
        $sql = new SQL();
        $sql->addTable('compra');
        $sql->addTipo('consultar');
        $compras = Persistence::consultar($sql, 1);
        return $compras;
    }
    public function listar(){
        $todos = $this->traerDatos();
        $lista = array();
        foreach($todos as $registro){
            $_compraId = $registro['compraId'];
            $_montoTotal = $registro['montoTotal'];
            $_fechaCompra = $registro['fechaCompra'];
            $_proveedirId=$registro['proveedorId'];
            $_usuarioId=$registro['usuarioId'];
            $compra= new Compra($_compraId, $_montoTotal, $_fechaCompra, $_proveedirId,$_usuarioId);
            $lista[] = $compra;
        }
        return $lista;
    
    }
    public function listarPorUsuario() {
         $sql = new SQL();
        $sql->addTable('compra');
        $sql->addTipo('consultar');
        $sql->addWhere("usuarioId= $this->_usuarioId");
        $todos = Persistence::consultar($sql, 1);
        $lista = array();
        foreach($todos as $registro){
            $_compraId = $registro['compraId'];
            $_montoTotal = $registro['montoTotal'];
            $_fechaCompra = $registro['fechaCompra'];
            $_proveedirId=$registro['proveedorId'];
            $_usuarioId=$registro['usuarioId'];
            $compra= new Compra($_compraId, $_montoTotal, $_fechaCompra, $_proveedirId,$_usuarioId);
            $lista[] = $compra;
        }
        return $lista;
    }
     public function insertar(){
         $sql = new SQL();
        $sql->addTable("compra (compraId , montoTotal,fechaCompra ,proveedorId, usuarioId)");
        $sql->addTipo('insertar');
        $sql->addValues($this->_compraId);
        $sql->addValues($this->_montoTotal);
        $sql->addValues($this->_fechaCompra);
        $sql->addValues($this->_proveedorId);
        $sql->addValues($this->_usuarioId);
        return Persistence::consultar($sql, 0);
    }
    public function actualizar(){}
    public function eliminar($id){}
}
?>