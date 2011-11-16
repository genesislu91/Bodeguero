<?php
require_once '../model/Proveedor.php';
require_once 'PersonaJuridicaLogic.php';
abstract class ProveedorLogic {
    public static function getAll(){
      $proveedor = new Proveedor(null, null, $_SESSION['usuario']);
        return $proveedor->listarPorUsuario();
    }
    public static  function getProveedorPorId($id){
        $todos = self::getAll();
        foreach($todos as $value){
            if ($value->getProveedorId()==$id) {
                return $value;
            }
        }
        return null;
    }
     public static  function getProveedorPorPersonaId($id){
        $todos = self::getAll();
        foreach($todos as $value){
            if ($value->getPersonaId()==$id) {
                return $value;
            }
        }
        return null;
    }
    public static  function getProveedorPorNombre($nombre){
       $todos=self::getAll();
       $pj=PersonaJuridicaLogic::getPersonaJPorNombre($nombre);
       $encontrados=array();
            if ($pj!=null) {
                foreach($pj as $p){
                    if(self::getProveedorPorPersonaId($p->getPersonaId())!=null){
                    $encontrados[]= self::getProveedorPorPersonaId($p->getPersonaId());
                    
                    }

                }
                if($encontrados!=null){
                    return $encontrados;
                }else{
                    return null;
                }
            }else{
                return null;
            }
    }
     public static  function getProveedorPorRuc($ruc){
        $pj=PersonaJuridicaLogic::getPersonaJPorRuc($ruc);
            if ($pj!=null) {
                $encontrado= self::getProveedorPorPersonaId($pj[0]->getPersonaId());
                if($encontrado!=null){
                    return array($encontrado);
                }else{
                    return null;
                }
            }else{
                return null;
            }
    }
    public static function mostrarTodoCompleto($proveedores){
        $lista=array();
        if($proveedores!=null){
        foreach($proveedores as $pro){
            $persona = PersonaJuridicaLogic::buscarPersonaJuridicaPorId($pro->getPersonaId());
            $lista[] = array($pro,$persona);
        }
        return $lista;
    }
    }
    public static function insertar(  $_telefono, $_correoElectronico, $_direccion, $_ruc, $_razonSocial){
        $id=PersonaJuridicaLogic::insertar( $_telefono, $_correoElectronico, $_direccion, $_ruc, $_razonSocial);
        if($id!=false){
        $proveedor= new Proveedor(null, $id, $_SESSION['usuario']);
        return $proveedor->insertar();
        }else{
            return FALSE;
        }
    }
}
?>