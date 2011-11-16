<?php
require_once '../model/PersonaJuridica.php';
require_once 'PersonaLogic.php';
abstract class PersonaJuridicaLogic {
    public static function getAll(){
        $personaJuridica = new PersonaJuridica();
        return $personaJuridica->listar();
    }
    public static function buscarPersonaJuridicaPorId($id){
     $todos=self::getAll();
        foreach($todos as $p){
            if($p->getPersonaId()==$id){
                return $p;
            }
        }
        return null;
   }
   public static  function getPersonaJPorNombre($nombre){
        $todos=self::getAll();
        $encontrados=array();
        foreach ($todos as $value) {
            if(preg_match("/$nombre/", $value->getRazonSocial())){
                        $encontrados[]= $value;
            }
        }
        return $encontrados;
    }
    public static  function getPersonaJPorRuc($ruc){
        $todos=self::getAll();
        foreach ($todos as $value) {
            if($value->getRuc()==$ruc){
                return array($value);
            }
        }
        return null;
    }
    public static  function actualizar($id,$telefono,$correo,$direccion){
        $persona=self::buscarPersonaJuridicaPorId($id);
        $persona->setTelefono($telefono);
        $persona->setCorreoElectronico($correo);
        $persona->setDireccion($direccion);
        $persona->actualizar();
    }
    public static function validarUsuario($ruc){
        if(self::getPersonaJPorRuc($ruc)==null ){
            return true;
        }else{
            return false;
        }
    }
    public static function insertar( $_telefono, $_correoElectronico, $_direccion, $_ruc, $_razonSocial){
        if(self::validarUsuario($_ruc)){
            $p=new PersonaJuridica(null, $_telefono, $_correoElectronico, $_direccion, $_ruc, $_razonSocial);
            
            return $p->insertar();;
        }else{
            return false;
        }
    }
}
?>