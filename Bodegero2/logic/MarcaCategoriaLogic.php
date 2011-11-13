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
    public static function buscarMarcasPorCategoria($categoriaId){
        $todos=self::getAll();
        $encontrados=array();
          foreach ($todos as $value) {
            if($value->getCategoria()==$categoriaId){
                $encontrados[]=MarcaLogic::getMarcaPorId($value->getMarcaId());
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
}
?>