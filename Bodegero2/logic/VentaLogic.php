<?php
require_once '../model/Venta.php';
abstract class VentaLogic{
    public static function getAll(){
       $venta= new Venta(NULL, NULL, NULL, NULL, $_SESSION['usuario']);
        return $venta->listarPorUsuario();
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
        $id=self::obtenerIdValido();
        $venta = new Venta($id, $_montoTotal, $_fechaVenta, $cliente, $_SESSION['usuario']);
        $venta->insertar();
        return self::getVentasPorId($id);
    }
     public static function mostrarTodoCompleto($ventas){
        $lista = array();
        foreach($ventas as $venta){
            $clienteId = $venta->getCliente();
            $cliente = ClienteLogic::buscarClientePorId($clienteId);
            $personaId = $cliente[0]->getPersonaId();
            $persona = ClienteLogic::buscarClientePorPersonaId($personaId, $cliente[0]->getTipo());
            $lista[] = array($venta,$persona,$cliente[0]->getTipo());
        }
        return $lista;
    }
    
}
?>