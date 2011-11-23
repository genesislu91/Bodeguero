<?php
require_once '../model/DetalleVenta.php';
require_once 'VentaLogic.php';
require_once 'ProductoLogic.php';
abstract class DetalleVentaLogic{
    public static function getAll(){
        $detalleVenta = new DetalleVenta();
        return $detalleVenta->listar();
    }
    public static function getDetallePorVenta($id){
        $todos=self::getAll();
        $encontrados=array();
        foreach ($todos as $v){
            if($v->getVentaId()==$id){
                $encontrados[]=$v;
            }
        }
        return $encontrados;
     }
     public static function mostrarTodoCompleto($detalles){
        $lista = array();
        foreach($detalles as $detalle){
            $producto = ProductoLogic::getProductoPorId($detalle->getProductoId());
           $lista[] = array($detalle,$producto);
        }
        return $lista;
    }
     public static function getVentaPorProducto($id){
           $todos=self::getAll();
        $encontrados=array();
        foreach ($todos as $v){
            if($v->getProductoId()==$id){
                $venta=VentaLogic::getVentasPorId($v->getVentaId());
                $encontrados[]=$venta[0];
            }
        }
        return $encontrados;
     }
      public static function obtenerIdValido(){
        $id = 1;
        $encontrado = FALSE;
        while(!$encontrado){
            if(self::getDetallePorVenta($id)){
                $id++;
            }else{
                return $id;
            }
        }
    }
    public static function insertar($_ventaId , $_productoId, $_precioVenta, $_cantidad){
        $_subtotal=$_precioVenta*$_cantidad;
        $dv= new DetalleVenta(null,$_ventaId , $_productoId, $_precioVenta, $_cantidad, $_subtotal);
        $dv->insertar();
        ProductoLogic::actualizarStock($_productoId, -$_cantidad);
    }
}
?>