<?php
require_once '../model/Cliente.php';
require_once 'PersonaJuridicaLogic.php';
require_once 'PersonaNaturalLogic.php';
require_once 'PersonaLogic.php';
abstract class ClienteLogic{
    public static function getAll(){
         $cliente = new Cliente(null, null, null, null, $_SESSION['usuario']);
        return $cliente->listarPorUsuario();
    }
    public static function existeCliente($clienteId){
        $c= new Cliente();
        $clientes = $c->listar();
        foreach($clientes as $cliente){
            if($cliente->getClienteId() == $clienteId){
                return TRUE;
            }
        }
        return FALSE;
    }
    public static  function getClientePorDNI($dni){
        $encontrados=array();
        $persona= PersonaNaturalLogic::getPersonaNPorDni($dni);
        if($persona==null){
            return array();
        }else{
            if(self::getClientePorPersonaId($persona[0]->getPersonaId()) != null){
                return array(self::buscarClientePorPersonaId($persona[0]->getPersonaId(), 0));
            }else{
                return array();
            }}
        
        
    }
    public static  function getClientePorRuc($ruc){
        $encontrados=array();
        $persona= PersonaJuridicaLogic::getPersonaJPorRuc($ruc);
        if($persona==null){
            return array();
        }else{
        if(self::getClientePorPersonaId($persona[0]->getPersonaId()) != null){
            return array(self::buscarClientePorPersonaId($persona[0]->getPersonaId(), 1));
        }else{
            return array();
        }}

    }
    public static  function getClientePorNombre($nombre, $tipo){
        $encontrados=array();
        if($tipo == 1){
            $personas= PersonaJuridicaLogic::getPersonaJPorNombre($nombre);
            foreach ($personas as $p){
                if(self::getClientePorPersonaId($p->getPersonaId())!= null){
                    $encontrados[]=self::buscarClientePorPersonaId($p->getPersonaId(), $tipo);
                }
            }
            return $encontrados;
        }else{  
            $personas= PersonaNaturalLogic::getPersonaNPorNombre($nombre);
            foreach($personas as $p){
                if(self::getClientePorPersonaId($p->getPersonaId()) != null){
                    $encontrados[]=self::buscarClientePorPersonaId($p->getPersonaId(), $tipo);
                }
            }
            return $encontrados;
        }
    }
    public static function obtenerIdValido(){
        $id = 1;
        $encontrado = FALSE;
        while(!$encontrado){
            if(self::existeCliente($id)){
                $id++;
            }else{
                return $id;
            }
        }
    }
    public static function  insertarClienteN($nombre,$apellidoPaterno,$apellidoMaterno,$dni,$direccion,$telefono,$correoElectronico){
        
        $personaId = PersonaNaturalLogic::insertar($nombre,$apellidoPaterno,$apellidoMaterno,$dni,$correoElectronico,$telefono,$direccion);
        $cliente = new Cliente(null,date('Y-m-d'),$personaId,0,$_SESSION['usuario']);
        return $cliente->insertar();
    }
    public static function insertarClienteJ($razonSocial,$ruc,$direccion,$telefono,$correoElectronico){
       
        $personaId = PersonaJuridicaLogic::insertar($telefono, $correoElectronico, $direccion, $ruc, $razonSocial);
        $cliente = new Cliente(null,date('Y-m-d'),$personaId,0,$_SESSION['usuario']);
        return $cliente->insertar();
    }
    public static function mostrarClientesCompleto(){
        $lista = array();
        $clientes = self::getAll();
        foreach($clientes as $cliente){
            $personaId = $cliente->getPersonaId();
            $tipo = $cliente->getTipo();
            $persona = self::buscarClientePorPersonaId($personaId, $tipo);
            $lista[] = array($cliente,$persona);
        }
        return $lista;
    }
    public static function mostrarClientesCompletoPorNombre($nombre,$tipo){
        $lista = array();
        $clientes = self::getClientePorNombre($nombre, $tipo);
        foreach($clientes as $cliente){
            $personaId = $cliente->getPersonaId();
            $tipo = $tipo;
            $c= ClienteLogic::getClientePorPersonaId($personaId, $tipo);
            $persona = $cliente;
            $lista[] = array($c,$persona);
        }
        return $lista;
    }
    public static function getClientePorPersonaId($personaId){
        $todos=self::getAll();
        foreach ($todos as $u){
            if($u->getPersonaId()==$personaId){
                return $u;
            }
        }return null;
    }
    public static function buscarClientePorPersonaId($personaId,$tipo){
        $persona = null;
        if($tipo == 1){
            $persona = PersonaJuridicaLogic::buscarPersonaJuridicaPorId($personaId);
        }else{
            $persona = PersonaNaturalLogic::buscarPersonaNaturalPorId($personaId);
        }
        return $persona;
    }
    public static function buscarClientePorId($id){
        $clientes = self::getAll();
        foreach($clientes as $cliente){
            if($cliente->getClienteId() == $id){
                $personaId = $cliente->getPersonaId();
                $tipo = $cliente->getTipo();
                return array($cliente,self::buscarClientePorPersonaId($personaId,$tipo));
            }
        }
        return NULL;
    }
    public static function buscarClienteIDPorPersonaID($id){
        foreach (self::getAll() as $c){
            if($c->getPersonaId()==$id){
                return $c->getClienteId();
            }
        }
        return null;
    }  
}?>