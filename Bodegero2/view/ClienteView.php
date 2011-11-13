<?php
require_once '../logic/ClienteLogic.php';
session_start();
abstract class ClienteView{
    private static $_opcionesMenuLateral = array(0 => '<li><a href="?opcion=verClientes">Ver Clientes</a></li>',
        1 => '<li><a href="?opcion=registrarCliente">Registrar Cliente</a></li>');
    public static function ejecutar() {
        if(isset($_SESSION['usuario'])) {
            $clientes = ClienteLogic::mostrarClientesCompleto();
            $opcion = null;
            if (isset($_REQUEST['opcion'])) {
                $opcion = $_REQUEST['opcion'];
            }
            switch ($opcion) {
                case 'agregar':
                    $tipoCliente = $_POST['tipoCliente'];
                    $direccion = $_POST['direccion'];
                    $telefono = $_POST['telefono'];
                    $correoElectronico = $_POST['correo'];
                    $nombre = $_POST['nombre'];
                    $documento = $_POST['documento'];
                    if($tipoCliente == 0){
                        $apellidoP = $_POST['apellidoP'];
                        $apellidoM = $_POST['apellidoM'];
                        ClienteLogic::insertarClienteN($nombre, $apellidoP, $apellidoM, $documento, $direccion, $telefono, $correoElectronico);
                    }else{
                        ClienteLogic::insertarClienteJ($nombre, $documento, $direccion, $telefono, $correoElectronico);
                    }
                    $clientes = ClienteLogic::mostrarClientesCompleto();
                    self::_mostrarVerClientes($clientes, self::$_opcionesMenuLateral);
                    break;
                case 'registrarCliente':
                    self::_mostrarRegistrarCliente(self::$_opcionesMenuLateral);
                    break;
                case 'modificar':
                    $id = $_GET['id'];
                    $cliente = ClienteLogic::buscarClientePorId($id);
                    self::_mostrarModificarCliente($cliente, self::$_opcionesMenuLateral);
                    break;
                case 'modificando':
                    $id = $_POST['id'];
                    $cliente = ClienteLogic::buscarClientePorId($id);
                    $tipoCliente = $cliente[0]->getTipo();
                    $direccion;
                    if (isset($_POST['direccion'])) {
                        $direccion = $_POST['direccion'];
                    }
                    $telefono;
                    if (isset($_POST['telefono'])) {
                        $telefono = $_POST['telefono'];
                    }
                    $correoElectronico;
                    if (isset($_POST['correo'])) {
                        $correoElectronico = $_POST['correo'];
                    }
                    $nombre;
                    if (isset($_POST['nombre'])) {
                        $nombre = $_POST['nombre'];
                    }
                    $documento;
                    if (isset($_POST['documento'])) {
                        $documento = $_POST['documento'];
                    }
                    if ($tipoCliente == 2) {
                        $apellidoP;
                        if (isset($_POST['apellidoP'])) {
                            $apellidoP = $_POST['apellidoP'];
                        }
                        $apellidoM;
                        if (isset($_POST['apellidoM'])) {
                            $apellidoM = $_POST['apellidoM'];
                        }
                        ClienteLogic::modificarClienteN($id, $nombre, $apellidoP, $apellidoM, $documento, $direccion, $telefono, $correoElectronico);
                    }else{
                        ClienteLogic::modificarClienteJ($id, $nombre, $documento, $direccion, $telefono, $correoElectronico);
                    }
                    $clientes = ClienteLogic::mostrarClientesCompleto();
                    self::_mostrarVerClientes($clientes, self::$_opcionesMenuLateral);
                    break;
                case 'buscarTipo':
                    $tipo = $_POST['tipoCliente'];
                    $lista = array();
                    foreach($clientes as $client){
                        if($client[0]->getTipo() == $tipo){
                            $lista[] = $client;
                        }
                    }
                    self::_mostrarVerClientes($lista, self::$_opcionesMenuLateral);
                    break;
                case 'buscarCampo':
                    $tipo = $_POST['tipoCliente'];
                    $campo = $_POST['tipoBusqueda'];
                    $texto = $_POST['campo'];
                    $metodo = null;
                    if($tipo == 0){
                        if($campo == 1){
                            $metodo = 'getNombre';
                        }else{
                            if($campo == 2){
                                $metodo = 'getApellidoPaterno';
                            }else{
                                if($campo == 3){
                                    $metodo = 'getApellidoMaterno';
                                }else{
                                    $metodo = 'getDNI';
                                }
                            }
                        }
                    }else{
                        if($campo == 1){
                            $metodo = 'getRazonSocial';
                        }else{
                            $metodo = 'getRuc';
                        }
                    }
                    $lista = array();
                    foreach($clientes as $client){
                        if($client[0]->getTipo() == $tipo){
                            if($client[1]->$metodo() == $texto){
                                $lista[] = $client;
                            }
                        }
                    }
                    self::_mostrarVerClientes($lista, self::$_opcionesMenuLateral);
                    break;
                case 'verClientes':default:
                    self::_mostrarVerClientes($clientes, self::$_opcionesMenuLateral);
                    break;
            }
        }else{
             header("location:UsuarioView.php");
        }
    }
    private static function _mostrarRegistrarCliente($opcionesMenuLateral) {
        require_once 'cliente_registrarCliente.php';
    }
    private static function _mostrarVerClientes($clientes, $opcionesMenuLateral) {
        require_once 'cliente_verClientes.php';
    }
    private static function _mostrarModificarCliente($cliente, $opcionesMenuLateral) {
        require_once 'cliente_modificarCliente.php';
    }
}
ClienteView::ejecutar();
?>