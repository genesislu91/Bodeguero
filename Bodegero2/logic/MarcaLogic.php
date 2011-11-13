<?php
require_once '../model/Marca.php';
abstract class MarcaLogic{
    public static function getAll(){
        $marca= new Marca(null, null, $_SESSION['usuario']);
        return $marca->listarPorUsuario();
    }
     public static function getMarcaPorId($id){
        $todos=self::getAll();
        foreach ($todos as $value) {
            if($value->getMarcaId()==$id){
                return $value;
            }
        }
        return null;
    }
   
}
?>