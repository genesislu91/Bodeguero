<?php
require_once '../model/Persona.php';
abstract class PersonaLogic{
  public static function existePersona($id){
        $todos=  Persona::getPersonas();
        foreach($todos as $p){
            if($p['personaId']==$id){
                return true;
            }
        }
        return false;
    }
     public function actualizar($id,$telefono,$correo,$direccion){
        $persona=self::buscarPersonaJuridicaPorId($id);
        $persona->setTelefono($telefono);
        $persona->setCorreoElectronico($correo);
        $persona->setDireccion($direccion);
        $persona->actualizar();
    }
    public static function obtenerIdValido(){
        $id = 1;
        $encontrado = FALSE;
        while(!$encontrado){
            if(self::existePersona($id)){
                $id++;
            }else{
                return $id;
            }
        }
    }
    
}
?>