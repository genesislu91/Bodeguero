<?php
require_once '../conexion/SQL.php';
require_once '../conexion/Persistence.php';
require_once '../interface/InterfaceModels.php';
class DetalleVenta implements InterfaceModels{
    private $_detalleVenta;
    private $_ventaId;
    private $_productoId;
    private $_precioVenta;
    private $_cantidad;
    private $_subtotal;
    public function __construct($_detalleVenta="", $_ventaId="", $_productoId="",$_precioVenta="", $_cantidad="", $_subtotal="") {
        $this->_detalleVenta = $_detalleVenta;
        $this->_ventaId = $_ventaId;
        $this->_productoId = $_productoId;
        $this->_precioVenta=$_precioVenta;
        $this->_cantidad = $_cantidad;
        $this->_subtotal = $_subtotal;
    }
    public function getDetalleVenta(){
        return $this->_detalleVenta;
    }
    public function getVentaId() {
        return $this->_ventaId;
    }
    public function getProductoId() {
        return $this->_productoId;
    }
    public function getCantidad() {
        return $this->_cantidad;
    }
    public function getSubtotal() {
        return $this->_subtotal;
    }
    public function getPrecioVenta() {
        return $this->_precioVenta;
    }
    public function traerDatos(){
        $sql = new SQL();
        $sql->addTable('detalleventa');
        $sql->addTipo('consultar');
        $resultado = Persistence::consultar($sql, 1);
        return $resultado;
    }
    public function listar(){
        $todos = $this->traerDatos();
        $lista = array();
        foreach($todos as $registro){
            $_detalleVenta = $registro['detalleVentaId'];
            $_ventaId = $registro['ventaId'];
            $_productoId = $registro['productoId'];
            $_precioVenta=$registro['precioVenta'];
            $_cantidad=$registro['cantidad'];
            $_subtotal=$registro['subtotal'];
            $detalleventa= new DetalleVenta($_detalleVenta, $_ventaId, $_productoId, $_precioVenta, $_cantidad, $_subtotal);
            $lista[] = $detalleventa;
        }
        return $lista;
   }
     public function insertar(){
        $sql = new SQL();
        $sql->addTable("detalleventa (detalleVentaId,ventaId ,productoId ,precioVenta ,cantidad ,subtotal)");
        $sql->addTipo('insertar');
        $sql->addValues($this->_detalleVenta);
        $sql->addValues($this->_ventaId);
        $sql->addValues($this->_productoId);
        $sql->addValues($this->_precioVenta);
        $sql->addValues($this->_cantidad);
        $sql->addValues($this->_subtotal);
         Persistence::consultar($sql, 0);
    }
}
?>
