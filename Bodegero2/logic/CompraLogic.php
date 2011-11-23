<?php
require_once '../model/Compra.php';
require_once 'ProveedorLogic.php';
abstract class CompraLogic{
    public static function getAll(){
       $compra = new Compra(NULL, NULL, NULL, NULL, $_SESSION['usuario']);
        return $compra->listarPorUsuario();
    }
    public static function getAllPorMes(){
	$todos = self::getAll();
        $resultado = array();
	$hoy = date('Y-m-d');
        $arrayHoy = explode('-', $hoy);
	foreach($todos as $compra){
            $fecha = $compra->getFechaCompra();
            $arrayFecha = explode('-', $fecha);
            if($arrayHoy[0] == $arrayFecha[0] & $arrayHoy[1] == $arrayFecha[1]){
                $resultado[] = $compra;
            }
	}
        return $resultado;
    }
    public static function mostrarTodoCompleto($compras){
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