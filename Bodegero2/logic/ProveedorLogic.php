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
    public static  function getProveedorPorNombre($nombre){
        $todos=self::getAll();
        $encontrados=array();
        foreach ($todos as $value) {
            if(preg_match("/$nombre/", PersonaJuridicaLogic::buscarPersonaJuridicaPorId($value->getPersonaId())->getRazonSocial())){
                        $encontrados[]= $value;
            }
        }
        return $encontrados;
    }
    public static function mostrarTodoCompleto(){
        $lista = array();
        $proveedores = self::getAll();
        foreach($proveedores as $pro){
            $persona = PersonaJuridicaLogic::buscarPersonaJuridicaPorId($pro->getPersonaId());
            $lista[] = array($pro,$persona->getRazonSocial());
        }
        return $lista;
    }
}
?>