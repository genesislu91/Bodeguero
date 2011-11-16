<?php
require_once '../conexion/SQL.php';
require_once '../conexion/Persistence.php';
require_once '../interface/InterfaceModels.php';
class DetalleCompra implements InterfaceModels{
    private $_detalleCompraId;
    private $_compraId;
    private $_productoId;
    private $_precioCompra;
    private $_cantidad;
    private $_subtotal;
    public function __construct($_detalleCompraId="", $_compraId="", $_productoId="", $_precioCompra="", $_cantidad="", $_subtotal="") {
        $this->_detalleCompraId = $_detalleCompraId;
        $this->_compraId = $_compraId;
        $this->_productoId = $_productoId;
        $this->_precioCompra = $_precioCompra;
        $this->_cantidad = $_cantidad;
        $this->_subtotal = $_subtotal;
    }
    public function getDetalleCompraId(){
        return $this->_detalleCompraId;
    }
    public function getCompraId(){
        return $this->_compraId;
    }
    public function getProductoId(){
        return $this->_productoId;
    }
    public function getPrecioCompra(){
        return $this->_precioCompra;
    }
    public function getCantidad(){
        return $this->_cantidad;
    }
    public function getSubtotal(){
        return $this->_subtotal;
    }
    public function setCantidad($_cantidad) {
        $this->_cantidad = $_cantidad;
    }
    public function setSubtotal($_subtotal) {
        $this->_subtotal = $_subtotal;
    }


        public function traerDatos(){
        $sql = new SQL();
        $sql->addTable('detallecompra');
        $sql->addTipo('consultar');
        $resultado = Persistence::consultar($sql, 1);
        return $resultado;
    }
     public function listar(){
        $todos = $this->traerDatos();
        $lista = array();
        foreach($todos as $registro){
            $_detalleCompraId = $registro['detalleCompraId'];
            $_compraId = $registro['compraId'];
            $_productoId = $registro['productoId'];
            $_precioCompra=$registro['precioCompra'];
            $_cantidad=$registro['cantidad'];
            $_subtotal=$registro['subtotal'];
            $detallecompra= new DetalleCompra($_detalleCompraId, $_compraId, $_productoId, $_precioCompra, $_cantidad, $_subtotal);
            $lista[] = $detallecompra;
        }
        return $lista;

    }
     public function insertar(){
         $sql = new SQL();
        $sql->addTable("detallecompra (detalleCompraId,compraId ,productoId ,precioCompra ,cantidad ,subtotal)");
        $sql->addTipo('insertar');
        $sql->addValues($this->_detalleCompraId);
        $sql->addValues($this->_compraId);
        $sql->addValues($this->_productoId);
        $sql->addValues($this->_precioCompra);
        $sql->addValues($this->_cantidad);
        $sql->addValues($this->_subtotal);
        return Persistence::consultar($sql, 0);
    }

}

?>