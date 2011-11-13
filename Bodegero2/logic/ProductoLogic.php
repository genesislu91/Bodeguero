<?php
require_once '../model/Producto.php';
require_once '../model/Categoria.php';
require_once '../model/Proveedor.php';
require_once 'ProveedorLogic.php';
require_once 'MarcaCategoriaLogic.php';
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
        foreach ($todos as $value) {
            foreach (ProveedorLogic::getProveedorPorNombre($nombre) as $proveedor) {
                if($value->getProveedorId()==$proveedor->getProveedorId()){
                    $encontrados[]= $value;
            }
            }
            
        }
        return $encontrados;
    }
    public static function getProductoPorMarca($marcaId){
        $todos=self::getAll();
        $encontrados=array();
        foreach ($todos as $value) {
                if(MarcaCategoriaLogic::buscarMarcasCategoriaPorId($value->getMarcaCategoriaId())->getMarcaId()==$marcaId){
                    $encontrados[]= $value;
            }
        }
        return $encontrados;
    }
    public static function getProductoPorCategoria($id){
    $todos=self::getAll();
        $encontrados=array();
        foreach ($todos as $value) {
                if(MarcaCategoriaLogic::buscarMarcasCategoriaPorId($value->getMarcaCategoriaId())->getCategoria()==$id){
                    $encontrados[]= $value;
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
            $lista[]=array($p,$persona);
        }
        return $lista;
    }
}
?>