<?php
require_once '../model/Venta.php';
abstract class VentaLogic{
    public static function getAll(){
       $venta= new Venta(NULL, NULL, NULL, NULL, $_SESSION['usuario']);
        return $venta->listarPorUsuario();
    }
    public static function getAllPorMes(){
	$todos = self::getAll();
        $resultado = array();
	$hoy = date('Y-m-d');
        $arrayHoy = explode('-', $hoy);
	foreach($todos as $venta){
            $fecha = $venta->getFechaVenta();
            $arrayFecha = explode('-', $fecha);
            if($arrayHoy[0] == $arrayFecha[0] & $arrayHoy[1] == $arrayFecha[1]){
                $resultado[]=$venta;
            }
	}
        return $resultado;
    }
    public static function getVentasPorId($id){
        $venta=new Venta();
        $todos=$venta->listar();
        $encontrados=array();
        foreach ($todos as $v){
            if($v->getVentaId()==$id){
                $encontrados[]=$v;
            }
        }
        return $encontrados;
    }
    public static function getVentasPorCliente($id){
        $todos=self::getAll();
        $encontrados=array();
        foreach ($todos as $v){
            if($v->getCliente()==$id){
                $encontrados[]=$v;
            }
        }
        return $encontrados;
    }
    public static function getVentasPorFecha($fecha){
        $todos=self::getAll();
        $encontrados=array();
        foreach ($todos as $v){
            if($v->getFechaVenta()==$fecha){
                $encontrados[]=$v;
            }
        }
        return $encontrados;
    }
    public static function obtenerIdValido(){
        $id = 1;
        $encontrado = FALSE;
        while(!$encontrado){
            if(self::getVentasPorId($id)){
                $id++;
            }else{
                return $id;
            }
        }
    }
    public static function insertar($_montoTotal, $_fechaVenta, $cliente){
        $venta = new Venta(null, $_montoTotal, $_fechaVenta, $cliente, $_SESSION['usuario']);
        return self::getVentasPorId($venta->insertar());
        
    }
     public static function mostrarTodoCompleto($ventas){
        $lista = array();
        if($ventas !=null){
                foreach($ventas as $venta){
                    $clienteId = $venta->getCliente();
                    $cliente = ClienteLogic::buscarClientePorId($clienteId);
                    $personaId = $cliente[0]->getPersonaId();
                    $persona = ClienteLogic::buscarClientePorPersonaId($personaId, $cliente[0]->getTipo());
                    $lista[] = array($venta,$persona,$cliente[0]->getTipo());
                }
                return $lista;
            }else{
                return null;
            }
    }   
}
?>