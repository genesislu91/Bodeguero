<?php
require_once '../model/DetalleCompra.php';
require_once 'ProductoLogic.php';
abstract class DetalleCompraLogic{
    public static function getAll(){
        $detalleCompra = new DetalleCompra();
        return $detalleCompra->listar();
    }
    
    public static function getDetalleCompraPorCompraId($compraId) {
        $detallesCompra = self::getAll();
        $resultado = null;
        foreach ($detallesCompra as $detalleCompra) {
            if ($detalleCompra->getCompraId() == $compraId) {
                $resultado[] = $detalleCompra;
            }
        }
        return $resultado;
    }
    public static function buscarDetalleCompraPorCompraId($compraId){
        $detallesCompra = self::getAll();
        $lista = array();
        foreach($detallesCompra as $detalleCompra){
            if($detalleCompra->get_compraId() == $compraId){
                $producto = ProductoLogic::getProductoPorId($detalleCompra->get_productoId());
                $lista[] = array($detalleCompra,$producto->getNombre());
            }
        }
        return $lista;
    }
    public static function mostrarTodoCompleto($compras){
        //$compras = self::getAll();
        $lista = array();
        foreach($compras as $compra){
            $productoId = $compra->getProductoId();
            $producto = ProductoLogic::getProductoPorId($productoId);
            $um=  UnidadMedidaLogic::getUnidadMedidaPorId($producto->getUnidadMedida())->getNombre();

            $lista[] = array($compra,$producto,$um);
        }
        return $lista;

    }
    public static function insertarDetalleCompra($compraId, $productoId, $precioCompra, $cantidad, $subtotal){
        $detalleCompra = new DetalleCompra(null, $compraId, $productoId, $precioCompra, $cantidad, $subtotal);
        return $detalleCompra->insertar();
    }
}
?>