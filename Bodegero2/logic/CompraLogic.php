<?php
require_once '../model/Compra.php';
require_once 'ProveedorLogic.php';
abstract class CompraLogic{
    public static function getAll(){
       $compra = new Compra(NULL, NULL, NULL, NULL, $_SESSION['usuario']);
        return $compra->listarPorUsuario();
    }
    
    public static function mostrarTodoCompleto($compras){
        //$compras = self::getAll();
        $lista = array();
        foreach($compras as $compra){
            $proveedorId = $compra->getProveedorId();
            $proveedor = ProveedorLogic::getProveedorPorId($proveedorId);
            $personaId = $proveedor->getPersonaId();
            $persona = PersonaJuridicaLogic::buscarPersonaJuridicaPorId($personaId);
            $lista[] = array($compra,$persona);
        }
        return $lista;
    }
    public static function getCompraPorId($id) {
        $compras = self::getAll();
        foreach ($compras as $compra) {
            if ($compra->getCompraId() == $id) {
                return $compra;
            }
        }
        return null;
    }

    public static function getCompraPorFechaCompra($fechaCompra) {
        $compras = self::getAll();
        $resultado = null;
        foreach ($compras as $compra) {
            if ($compra->getFechaCompra() == $fechaCompra) {
                $resultado[] = $compra;
            }
        }
        return $resultado;
    }

    public static function getCompraPorProveedorId($proveedorId) {
        $compras = self::getAll();
        $resultado = array();
        foreach ($compras as $compra) {
            if ($compra->getProveedorId() == $proveedorId) {
                $resultado[] = $compra;
            }
        }
        return $resultado;
    }
    public static function insertarCompra($montoTotal, $fechaCompra, $proveedorId) {
        $compra = new Compra(null, $montoTotal, $fechaCompra, $proveedorId, $_SESSION['usuario']);
        return $compra->insertar();
    }
}
?>