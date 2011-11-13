<?php
require_once '../conexion/SQL.php';
require_once '../conexion/Persistence.php';
require_once '../interface/InterfaceModelsUsuario.php';
class Venta implements InterfaceModelsUsuario{
    private $_ventaId;
    private $_montoTotal;
    private $_fechaVenta;
    private $_cliente;
    private $_usuarioId;
    public function __construct($_ventaId="", $_montoTotal="", $_fechaVenta="",$cliente="",$usuarioId="") {
        $this->_ventaId = $_ventaId;
        $this->_montoTotal = $_montoTotal;
        $this->_fechaVenta = $_fechaVenta;
        $this->_cliente=$cliente;
        $this->_usuarioId=$usuarioId;
    }
    public function getUsuarioId() {
       return $this->_usuarioId;
   }
    public function getVentaId() {
        return $this->_ventaId;
    }
    public function getMontoTotal() {
        return $this->_montoTotal;
    }
    public function getFechaVenta() {
        return $this->_fechaVenta;
    }
    public function getCliente(){
        return $this->_cliente;
    }
    public function traerDatos(){
        $sql = new SQL();
        $sql->addTable('venta');
        $sql->addTipo('consultar');
        $resultado = Persistence::consultar($sql, 1);
        return $resultado;
    }
    public function listar(){
        $todos = $this->traerDatos();
        $lista = array();
        foreach($todos as $registro){
            $_ventaId = $registro['ventaId'];
            $_montoTotal = $registro['montoTotal'];
            $_fechaVenta = $registro['fechaVenta'];
            $cliente=$registro['clienteId'];
            $_usuarioId=$registro['usuarioId'];
            $venta= new Venta($_ventaId, $_montoTotal, $_fechaVenta, $cliente,$_usuarioId);
            $lista[] = $venta;
        }
        return $lista;

    }
    public function listarPorUsuario() {
        $sql = new SQL();
        $sql->addTable('venta');
        $sql->addTipo('consultar');
        $sql->addWhere("usuarioId= $this->_usuarioId");
        $todos = Persistence::consultar($sql, 1);
        $lista = array();
        foreach($todos as $registro){
            $_ventaId = $registro['ventaId'];
            $_montoTotal = $registro['montoTotal'];
            $_fechaVenta = $registro['fechaVenta'];
            $cliente=$registro['clienteId'];
            $_usuarioId=$registro['usuarioId'];
            $venta= new Venta($_ventaId, $_montoTotal, $_fechaVenta, $cliente,$_usuarioId);
            $lista[] = $venta;
        }
        return $lista;
    }
     public function insertar(){
         $sql = new SQL();
        $sql->addTable("venta (ventaId , montoTotal,fechaVenta ,clienteId, usuarioId )");
        $sql->addTipo('insertar');
        $sql->addValues($this->_ventaId);
        $sql->addValues($this->_montoTotal);
        $sql->addValues($this->_fechaVenta);
        $sql->addValues($this->_cliente);
        $sql->addValues($this->_usuarioId);
        //echo $sql;
        Persistence::consultar($sql, 0);
    }
}
?>