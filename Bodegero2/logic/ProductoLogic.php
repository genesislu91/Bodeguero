<?php
require_once '../model/Producto.php';
require_once '../model/Categoria.php';
require_once '../model/Proveedor.php';
require_once 'ProveedorLogic.php';
require_once 'MarcaCategoriaLogic.php';
require_once 'UnidadMedidaLogic.php';
class ProductoLogic {
    public static  function getAll(){
        $producto = new Producto(null, null, null, null, NULL, null, null, null, null,  $_SESSION['usuario']);
        return $producto->listarPorUsuario();
    }
    public static function getAllPorUsuario($usuarioId){
        
    }
    public static  function getProductoPorId($id){
        $todos=self::getAll();
        foreach ($todos as $value) {
            if($value->getProductoId()==$id){
                return $value;
            }
        }
        return null;
    }
    public static  function getTodoProductoPorId($id){
        $todos=self::getAll();
        foreach ($todos as $value) {
            if($value->getProductoId()==$id){
                
                return $value;
            }
        }
        return null;
    }
    public static  function getProductoPorNombre($nombre){
        $todos=self::getAll();
        $encontrados=array();
        foreach ($todos as $value) {
            
            if(preg_match("/$nombre/", $value->getNombre())){
                $encontrados[]= $value;
            }
        }
        return $encontrados;
    }
    public static  function getProductoPorProveedor($nombre){
        $todos=self::getAll();
        $encontrados=array();
        $proveedores=ProveedorLogic::getProveedorPorNombre($nombre);
        if($proveedores !=null){
        foreach ($todos as $value) {
            foreach ($proveedores as $proveedor) {
                if($value->getProveedorId()==$proveedor->getProveedorId()){
                    $encontrados[]= $value;
            }
            }
            
        }
        return $encontrados;}else{
            return null;
        }
    }
    public static function getProductoPorMarcaCategoria($marcaId){
        $todos=self::getAll();
        $encontrados=array();
        foreach ($todos as $value) {
                if($value->getMarcaCategoriaId()==$marcaId){
                    $encontrados[]= $value;
            }
        }
        return $encontrados;
    }
    public static function getProductoPorCategoria($id){
    $todos=self::getAll();
        $encontrados=array();
        foreach ($todos as $value) {
            $mc=MarcaCategoriaLogic::buscarMarcasCategoriaPorId($value->getMarcaCategoriaId());
            if($mc != null){
                if($mc->getCategoria()==$id){
                    $encontrados[]= $value;
            }
            }
        }
        return $encontrados;
    }

    public static function getCategoriaProducto($id){
        $todos=self::getAll();
        foreach ($todos as $value) {
            if($value->getProductoId()==$id){
                return MarcaCategoriaLogic::buscarMarcasCategoriaPorId($value->getMarcaCategoriaId())->getCategoria();

            }
        }
    }
    public static function actualizarStock($id,$cantidad){
        $producto = self::getProductoPorId($id);
        $producto->setCantidad($producto->getCantidad()+$cantidad);
        $producto->actualizar();
    }
    public static function MostrarProductosCompleto($productosa){
        
        $lista=array();
        foreach ($productosa as $p) {
            $proveedor=ProveedorLogic::getProveedorPorId($p->getProveedorId());
            $persona=PersonaJuridicaLogic::buscarPersonaJuridicaPorId($proveedor->getPersonaId());
            $mc=MarcaCategoriaLogic::buscarMarcasCategoriaPorId($p->getMarcaCategoriaId());
            $cat= CategoriaLogic::getCategoriaPorId($mc->getCategoria());
            $um=  UnidadMedidaLogic::getUnidadMedidaPorId($p->getUnidadMedida());
            $lista[]=array($p,$persona->getRazonSocial(),$cat->getNombre(),$um->getNombre());
        }
        return $lista;
    }

    public static function insertarProducto($nombre, $descripcion, $precioVenta, $precioCompra, $cantidad, $unidadDeMedida, $marcaCategoriaId, $proveedorId, $usuarioId) {
        $id = "";
        $producto = new Producto($id, $nombre, $descripcion, $precioVenta, $precioCompra, $cantidad, $unidadDeMedida, $marcaCategoriaId, $proveedorId, $usuarioId);
        return $producto->insertar();
    }

    public static function actualizarProducto($id, $nombre, $descripcion, $precioVenta, $precioCompra,  $unidadDeMedida, $marcaCategoriaId, $proveedorId) {
        $producto=  self::getProductoPorId($id);
        $producto->setNombre($nombre);
        $producto->setDescripcion($descripcion);
        $producto->setPrecioVenta($precioVenta);
        $producto->setPrecioCompra($precioCompra);
        $producto->setUnidadMedida($unidadDeMedida);
        $producto->setMarcaCategoriaId($marcaCategoriaId);
        $producto->setProveedorId($proveedorId);
        $producto->actualizar();
    }
}
?>