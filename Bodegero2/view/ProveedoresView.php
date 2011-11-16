<?php
require_once '../logic/PersonaJuridicaLogic.php';
require_once '../logic/ProveedorLogic.php';
session_start();
abstract class ProveedorView {

    private static $_opcionesMenuLateral = array(
        0 => '<li><a href="?opcion=ver_proveedor">Ver Proveedores</a></li>',
        1 => '<li><a href="?opcion=registrar_proveedor">Registrar Proveedor</a></li>');

    public static function ejecutar() {
        if (isset($_SESSION['usuario'])) {
        $opcion = null;
         if (isset($_REQUEST['opcion'])) {
            $opcion = $_REQUEST['opcion'];
        }
        if($opcion==null){
            $opcion='ver_proveedor';
        }
        switch ($opcion) {
            case 'ver_proveedor':
                $proveedores=ProveedorLogic::getAll();
                $filtro=ProveedorLogic::mostrarTodoCompleto($proveedores);
                self::_mostrarVerProveedores($filtro,self::$_opcionesMenuLateral);
                break;
            case 'buscarProveedor':
                    $por = $_POST['busqueda'];
                    $campo = $_POST['campo'];
                    if($por == 1){
                        $proveedores = ProveedorLogic::getProveedorPorRuc($campo);
                        $filtro=ProveedorLogic::mostrarTodoCompleto($proveedores);
                        self::_mostrarVerProveedores($filtro,self::$_opcionesMenuLateral);
                    }else if($por == 2){
                       $proveedores = ProveedorLogic::getProveedorPorNombre($campo);
                        $filtro=ProveedorLogic::mostrarTodoCompleto($proveedores);
                        self::_mostrarVerProveedores($filtro,self::$_opcionesMenuLateral);
                    }else if($por == 3){
                        $proveedores = ProveedorLogic::getAll();
                        $filtro=ProveedorLogic::mostrarTodoCompleto($proveedores);
                        self::_mostrarVerProveedores($filtro,self::$_opcionesMenuLateral);
                    }
                break;
            case 'registrar_proveedor':
                $mensaje= null;
                self::_mostrarRegistrarProveedor($mensaje,self::$_opcionesMenuLateral);
                break;
            case 'ingresarProveedor':
                if (isset ($_SESSION['usuario'])) {
                        $empresa=$_POST['empresa'];
                        $ruc=$_POST['ruc'];
                        $direccion=$_POST['direccion'];
                        $telefono=$_POST['telefono'];
                        $correo= $_POST['correo'];
                        $id=ProveedorLogic::insertar($telefono,$correo,$direccion,$ruc,$empresa);
                        if($id==false){
                            $mensaje ='El ruc ya existe';
                            self::_mostrarRegistrarProveedor($mensaje,self::$_opcionesMenuLateral);
                        }
                        $mensaje ='Proveedor Registrado con exito';
                        self::_mostrarRegistrarProveedor($mensaje,self::$_opcionesMenuLateral);
                        }
                break;
            case 'modificar_proveedor':
                $id = $_GET['id'];
                $pj = PersonaJuridicaLogic::buscarPersonaJuridicaPorId($id);
                $mensaje= null;
                self::_mostrarModificarProveedor($pj,$mensaje,self::$_opcionesMenuLateral);
                break;
            case 'modificarProveedor':
                $id = $_GET['id'];
                $direccion= $_POST['direccion'];
                $telefono= $_POST['telefono'];
                $correo = $_POST['correo'];
                PersonaJuridicaLogic::actualizar($id, $telefono, $correo, $direccion);
                $pj = PersonaJuridicaLogic::buscarPersonaJuridicaPorId($id);
                $mensaje ='Proveedor Modificado con exito';
                self::_mostrarModificarProveedor($pj,$mensaje,self::$_opcionesMenuLateral);
                break;
            default:
                self::_mostrarVerProveedores($filtro,self::$_opcionesMenuLateral);
                break;
        }
        }else{
             header("location:UsuarioView.php");
        }
    }

    private static function _mostrarVerProveedores($filtro,$opcionesMenuLateral) {
        require_once 'proveedores_verProveedores.php';
    }

    private static function _mostrarRegistrarProveedor($mensaje,$opcionesMenuLateral) {
        require_once 'proveedores_registrarProveedor.php';
    }

    private static function _mostrarModificarProveedor($pj,$mensaje,$opcionesMenuLateral) {
        require_once 'proveedores_modificarProveedor.php';
    }

}

ProveedorView::ejecutar();
?>
