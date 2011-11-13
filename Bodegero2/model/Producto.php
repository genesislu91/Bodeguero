<?php
require_once '../conexion/SQL.php';
require_once '../conexion/Persistence.php';
require_once '../interface/InterfaceModelsUsuario.php';
class Producto implements InterfaceModelsUsuario{
    private $_productoId;
    private $_nombre;
    private $_descripcion;
    private $_precioVenta;
    private $_precioCompra;
    private $_cantidad;
    private $_unidadMedida;
    private $_marcaCategoriaId;
    private $_proveedorId;
    private $_usuarioId;
    public function __construct($_productoId="",$_nombre="",$_descripcion="",$_precioVenta="",$_precioCompra="",$_cantidad="",$_unidadMedida="",$_marcaCategoriaId="",$proveedorId="",$usuarioId=""){
        $this->_productoId = $_productoId;
        $this->_nombre = $_nombre;
        $this->_descripcion = $_descripcion;
        $this->_precioVenta = $_precioVenta;
        $this->_precioCompra = $_precioCompra;
        $this->_cantidad = $_cantidad;
        $this->_unidadMedida = $_unidadMedida;
        $this->_marcaCategoriaId = $_marcaCategoriaId;
        $this->_proveedorId=$proveedorId;
        $this->_usuarioId=$usuarioId;
    }
    public function getUsuarioId() {
       return $this->_usuarioId;
   }
    public function getProductoId() {
        return $this->_productoId;
    }
     public function getProveedorId() {
        return $this->_proveedorId;
    }
    public function getNombre() {
        return $this->_nombre;
    }
    public function getDescripcion() {
        return $this->_descripcion;
    }
    public function getPrecioVenta() {
        return $this->_precioVenta;
    }
    public function getPrecioCompra() {
        return $this->_precioCompra;
    }
    public function getCantidad() {
        return $this->_cantidad;
    }
    public function getUnidadMedida() {
        return $this->_unidadMedida;
    }
    public function getMarcaCategoriaId() {
        return $this->_marcaCategoriaId;
    }
    public function setNombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function setDescripcion($_descripcion) {
        $this->_descripcion = $_descripcion;
    }

    public function setPrecioVenta($_precioVenta) {
        $this->_precioVenta = $_precioVenta;
    }

    public function setPrecioCompra($_precioCompra) {
        $this->_precioCompra = $_precioCompra;
    }

    public function setCantidad($_cantidad) {
        $this->_cantidad = $_cantidad;
    }

    public function setUnidadMedida($_unidadMedida) {
        $this->_unidadMedida = $_unidadMedida;
    }

    public function setMarcaCategoriaId($_marcaCategoriaId) {
        $this->_marcaCategoriaId = $_marcaCategoriaId;
    }

    public function setProveedorId($_proveedorId) {
        $this->_proveedorId = $_proveedorId;
    }

        public function traerDatos(){
        $sql = new SQL();
        $sql->addTable('producto');
        $sql->addTipo('consultar');
        $resultado = Persistence::consultar($sql, 1);
        return $resultado;
    }
    public function listar(){
        $todos = $this->traerDatos();
        $lista = array();
        foreach($todos as $registro){
            $_productoId=$registro['productoId'];
            $_nombre = $registro['nombre'];
            $_descripcion = $registro['descripcion'];
            $_precioVenta=$registro['precioVenta'];
            $_precioCompra = $registro['precioCompra'];
            $_cantidad = $registro['cantidad'];
            $_unidadMedida=$registro['unidadMedidaId'];
            $_marcaCategoriaId=$registro['marcaCategoriaId'];
            $proveedorId=$registro['proveedorId'];
            $_usuarioId=$registro['usuarioId'];
            $producto = new Producto($_productoId, $_nombre, $_descripcion, $_precioVenta, $_precioCompra, $_cantidad, $_unidadMedida, $_marcaCategoriaId, $proveedorId,$_usuarioId);
            $lista[] = $producto;
        }
        return $lista;
    }
    public function listarPorUsuario() {
        $sql = new SQL();
        $sql->addTable('producto');
        $sql->addTipo('consultar');
        $sql->addWhere("usuarioId= $this->_usuarioId");
        $todos = Persistence::consultar($sql, 1);
        $lista = array();
        foreach($todos as $registro){
            $_productoId=$registro['productoId'];
            $_nombre = $registro['nombre'];
            $_descripcion = $registro['descripcion'];
            $_precioVenta=$registro['precioVenta'];
            $_precioCompra = $registro['precioCompra'];
            $_cantidad = $registro['cantidad'];
            $_unidadMedida=$registro['unidadMedidaId'];
            $_marcaCategoriaId=$registro['marcaCategoriaId'];
            $proveedorId=$registro['proveedorId'];
            $_usuarioId=$registro['usuarioId'];
            $producto = new Producto($_productoId, $_nombre, $_descripcion, $_precioVenta, $_precioCompra, $_cantidad, $_unidadMedida, $_marcaCategoriaId, $proveedorId,$_usuarioId);
            $lista[] = $producto;
        }
        return $lista;
    }
     public function insertar(){
        $sql = new SQL();
        $sql->addTable("producto (productoId,nombre ,descripcion ,precioVenta,	precioCompra ,cantidad ,unidadMedidaId ,marcaCategoriaId ,proveedorId, usuarioId)");
        $sql->addTipo('insertar');
        $sql->addValues($this->_productoId);
        $sql->addValues($this->_nombre);
        $sql->addValues($this->_descripcion);
        $sql->addValues($this->_precioVenta);
        $sql->addValues($this->_precioCompra);
        $sql->addValues($this->_cantidad);
        $sql->addValues($this->_unidadMedida);
        $sql->addValues($this->_marcaCategoriaId);
        $sql->addValues($this->_proveedorId);
        $sql->addValues($this->_usuarioId);
        Persistence::consultar($sql, 0);
    }
        public function actualizar(){
        $sql = new SQL();
        $sql->addTable("producto");
        $sql->addTipo('actualizar'); 
        $sql->addValues("nombre = '$this->_nombre'");
        $sql->addValues("descripcion = '$this->_descripcion'");
        $sql->addValues("cantidad='$this->_cantidad'");
        $sql->addValues("precioVenta='$this->_precioVenta'");
        $sql->addValues("precioCompra = '$this->_precioCompra'");
        $sql->addValues("unidadMedidaId='$this->_unidadMedida'");
        $sql->addValues("marcaCategoriaId = '$this->_marcaCategoriaId'");
        $sql->addValues("proveedorId='$this->_proveedorId'");
        $sql->addWhere("productoId='$this->_productoId'");
        Persistence::consultar($sql, 0);
    }

}
?>