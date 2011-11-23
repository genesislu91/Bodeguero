<?php
require_once '../model/Categoria.php';
abstract class CategoriaLogic{
    public static function getAll(){
        $categoria= new Categoria(null, null, null, $_SESSION['usuario']);
        return $categoria->listarPorUsuario();
    }
    public static function getCategoriaPorId($id){
        $todos = self::getAll();
        foreach ($todos as $value) {
            if($value->getCategoriaId()==$id){
                return $value;
            }
        }
        return null;
    }
    public static function obtenerIdValido(){
        $id = 1;
        $encontrado = true;
        while($encontrado){
            if(self::getCategoriaPorId($id) == null){
                $encontrado = false;
            }else{
                $id++;
            }
        }
        return $id;
    }
    public static function insertarCategoria( $_nombre, $_descripcion) {
        $categoria = new Categoria(self::obtenerIdValido(), $_nombre, $_descripcion, $_SESSION['usuario']);
        return $categoria->insertar();
    }
    public static function editarCategoria($categoriaId,$nombre, $descripcion) {
        $categoria = self::getCategoriaPorId($categoriaId);
        $categoria->setDescripcion($descripcion);
        $categoria->setNombre($nombre);
        $categoria->actualizar();
    }
}
?>