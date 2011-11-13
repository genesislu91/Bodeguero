<?php
require_once '../model/Usuario.php';
require_once '../logic/PersonaJuridicaLogic.php';
abstract class UsuarioLogic{
    public static function getAll(){
        $usuario = new Usuario();
        return $usuario->listar();
    }
    
    public static function buscarUsuarioPorNombre($nombreUsuario){
        $todos=self::getAll();
        foreach($todos as $p){
            if($p->getNombreUsuario()==$nombreUsuario){
                return $p;
            }
        }
        return null;

    }
    public static function insertar( $_nombreUsuario, $_contrasenia, $_fechaRegistro, $_personaId){
        $id=  self::obtenerIdValido();
        $us= new Usuario($id, $_nombreUsuario, $_contrasenia, $_fechaRegistro, $_personaId);
        $us->insertar();
    }
    public static function obtenerUsuarioPorId($id){
        $todos=self::getAll();
        foreach($todos as $p){
            if($p->getUsuarioId()==$id){
                return $p;
            }
        }
        return null;
    }
    public static function validarUsuario($nombreUsuario){
        if(self::buscarUsuarioPorNombre($nombreUsuario)==null ){
            return true;
        }else{
            return false;
        }
    }
    public static function obtenerIdValido(){
        $id = 1;
        $encontrado = true;
        while($encontrado){
            if(self::obtenerUsuarioPorId($id) == null){
                $encontrado = false;
            }else{
                $id++;
            }
        }
        return $id;
    }
}

?>