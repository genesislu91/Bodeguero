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
       $personaId = PersonaLogic::obtenerIdValido();
       $personaNatural = new PersonaNatural($personaId,$telefono,$correoElectronico,$direccion,$nombre,$apellidoPaterno,$apellidoMaterno,$dni);
       $personaNatural->insertar();
       return $personaId;
   }
  
}
?>