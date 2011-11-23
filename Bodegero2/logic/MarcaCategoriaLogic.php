<?php
require_once '../model/MarcaCategoria.php';
require_once 'MarcaLogic.php';
abstract class MarcaCategoriaLogic{
    public static function getAll(){
        $marcaCategoria = new MarcaCategoria();
        return $marcaCategoria->listar();
    }
    
    public static function buscarMarcasCategoriaPorId($id){
        $todos=self::getAll();
        
          foreach ($todos as $value) {
            if($value->getMarcaCategoriaId()==$id){
                return $value;
            }
        }
    }
    public static function buscarMarcaCategoriaPorMarcaYCategoria($marca,$categoria){
        $todos=self::getAll();
          foreach ($todos as $value) {
            if($value->getCategoria()==$categoria & $value->getMarcaId()==$marca){
                return $value;
            }
        }
        return null;
    }
    public static function insertar($marca,$categoria){
        if(self::buscarMarcaCategoriaPorMarcaYCategoria($marca, $categoria)==null){
        $m= new MarcaCategoria(NULL, $marca, $categoria);
        return $m->insertar();}
    }
    public static function buscarMarcasPorCategoria($categoriaId){
        $todos=self::getAll();
        $encontrados=array();
          foreach ($todos as $value) {
            if($value->getCategoria()==$categoriaId){
                $encontrados[]=array($value->getMarcaCategoriaId(),MarcaLogic::getMarcaPorId($value->getMarcaId()));
            }
        }
        return $encontrados;
    }
    public static function buscarCategoriasPorMarca($marcaId){
        $todos=self::getAll();
        $encontrados=array();
          foreach ($todos as $value) {
            if($value->getCategoria()==$marcaId){
                $encontrados[]=CategoriaLogic::getCategoriaPorId($value->getCategoria());
            }
        }
        return $encontrados;
    }
    public static function eliminarMarcaCategoria($id){
        if(count(ProductoLogic::getProductoPorMarcaCategoria($id))==0){
        $mc= new MarcaCategoria($id);
        $mc->eliminar();}else{
            return false;
        }
    }
}
?>