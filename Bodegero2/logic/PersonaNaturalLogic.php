<?php
require_once '../model/PersonaNatural.php';
abstract class PersonaNaturalLogic {
    public static function getAll(){
        $personaNatural = new PersonaNatural();
        return $personaNatural->listar();
    }
     public static  function getPersonaNPorNombre($nombre){
        $todos=self::getAll();
        $encontrados=array();
        foreach ($todos as $value) {
            if(preg_match("/$nombre/", $value->getNombre()." ".$value->getApellidoPaterno()." ".$value->getApellidoMaterno())){
                        $encontrados[]= $value;
            }
        }
        return $encontrados;
    }
    public static  function getPersonaNPorDni($dni){
        $todos=self::getAll();
        foreach ($todos as $value) {
            if($value->getDni()==$dni){
                return array($value);
            }
        }
        return null;
    }
     public static function validarUsuario($dni){
        if(self::getPersonaNPorDni($dni)==null ){
            return true;
        }else{
            return false;
        }
    }
    public static function buscarPersonaNaturalPorId($id){
     $todos=self::getAll();
        foreach($todos as $p){
            if($p->getPersonaId()==$id){
                return $p;
            }
        }
        return null;
   }
   public static function insertar($nombre,$apellidoPaterno,$apellidoMaterno,$dni,$correoElectronico,$telefono,$direccion){
       if(self::validarUsuario($dni)){
           $personaNatural = new PersonaNatural(null,$telefono,$correoElectronico,$direccion,$nombre,$apellidoPaterno,$apellidoMaterno,$dni);
           return $personaNatural->insertar();
       }else{
           return false;
       }
   }
   public static  function actualizar($id,$telefono,$correo,$direccion){
         $persona=self::buscarPersonaNaturalPorId($id);
        $persona->setTelefono($telefono);
        $persona->setCorreoElectronico($correo);
        $persona->setDireccion($direccion);
        $persona->actualizar();
    }
  
}
?>