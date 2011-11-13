<?php
require_once '../logic/UsuarioLogic.php';
session_start();
abstract class UsuarioView {
    private static $opcionesMenuLateral = array(0 => '<li><a href="?opcion=informacion">Mi Informacion</a></li>',
        1 => '<li><a href="?opcion=modificarInformacion">Modificar Informacion</a></li>');
    public static function ejecutar() {
        $opcion = null;
        $mensaje = null;
        $usuarioNombre = "";
        $contrasenha = "";
        if (isset($_POST['usuario'])) {
            $usuarioNombre = $_POST['usuario'];
        }
        if (isset($_POST['contrasenna'])) {
            $contrasenha = $_POST['contrasenna'];
        }
        if (isset($_REQUEST['opcion'])) {
            $opcion = $_REQUEST['opcion'];
        }

        if ($opcion != null) {
            switch ($opcion) {
                case 'ingresar':
                    if ($contrasenha != "" & $usuarioNombre != "") {
                        $usuario = UsuarioLogic::buscarUsuarioPorNombre($usuarioNombre);
                        
                        if ($usuario != null) {
                            if ($usuario->getContrasenia() == $contrasenha) {
                                $_GET['opcion'] = null;
                                $_SESSION['usuario'] = $usuario->getUsuarioId();
                                header("location:VentasView.php");
                            } else {
                                $mensaje = "la contraseña es incorrecta";
                                self::_mostrarIniciarSesion($mensaje);
                            }
                        } else {
                            $mensaje = "El usuario no existe";
                            self::_mostrarIniciarSesion($mensaje);
                        }
                    } else {
                        $mensaje = "Debe Ingresar el usuario y contraseña";
                        self::_mostrarIniciarSesion($mensaje);
                    }
                    break;
                case 'registrarse':
                    self::_mostrarRegistrarse(null);
                    break;
                case 'cerrarSesion':
                    session_destroy();
                    self::_mostrarIniciarSesion(null);
                    break;
                case 'informacion':
                    if (isset ($_SESSION['usuario'])) {
                    $u = UsuarioLogic::obtenerUsuarioPorId($_SESSION['usuario']);
                    $pid = $u->getPersonaId();
                    $pj = PersonaJuridicaLogic::buscarPersonaJuridicaPorId($pid);
                    self::_mostrarInformacion($pj, self::$opcionesMenuLateral);
                    }
                    break;
                case 'modificarInformacion':
                    if (isset ($_SESSION['usuario'])) {
                    $u = UsuarioLogic::obtenerUsuarioPorId($_SESSION['usuario']);
                    $pid = $u->getPersonaId();
                    $pj = PersonaJuridicaLogic::buscarPersonaJuridicaPorId($pid);
                    self::_modificarInformacion($pj, self::$opcionesMenuLateral);
                    if ($_GET['opcion'] != null) {
                        $correo = $_POST['correo'];
                        $direccion = $_POST['direccion'];
                        $empresa = $_POST['empresa'];
                        $ruc = $_POST['ruc'];
                        $telefono = $_POST['telefono'];
                    }
                    }
                    break;
                case 'registrar':
                    include("../securimage/securimage.php");
                    $img = new Securimage();
                    $valid = $img->check($_POST['code']);
                    if ($valid == false) {
                        $mensaje = 'Codigo de seguridad incorrecto';
                        self::_mostrarRegistrarse($mensaje);
                        break;
                    } else {
                       $ruc=$_POST['ruc'];
                       $razonSocial=$_POST['razonSocial'];
                       $direccion=$_POST['direccion'];
                       $mail=$_POST['email'];
                       $usuario=$_POST['usuario'];
                       $contra=$_POST['contrasena'];
                       $telefono=$_POST['telefono'];
                       if(PersonaJuridicaLogic::validarUsuario($ruc)& UsuarioLogic::validarUsuario($usuario)){
                       $pj= PersonaJuridicaLogic::insertar($telefono, $mail, $direccion, $ruc, $razonSocial);
                       $u= UsuarioLogic::insertar( $usuario, $contra, date('Y-m-d'), $pj);
                       self::_mostrarIniciarSesion("se registro con exito");
                       }
                       else{
                           if(PersonaJuridicaLogic::validarUsuario($ruc)==false){
                               $mensaje="el ruc ya existe";
                           }else{
                               $mensaje="el usuario ya existe";
                           }
                           self::_mostrarRegistrarse($mensaje);

                       }
                    }
                    break;
            }
        } else {
            self::_mostrarIniciarSesion(null);
        }
    }

    public static function _mostrarIniciarSesion($mensaje) {
        require_once 'usuario_iniciarSesion.php';
    }

    public static function _mostrarRegistrarse($mensaje) {

        require_once 'usuario_registrase.php';
    }
    public static function _mostrarInformacion($pj,$opcionesMenuLateral){
        require_once 'usuario_miInformacion.php';
    }

    public static function _modificarInformacion($pj,$opcionesMenuLateral){
        require_once 'usuario_modificarInformacion.php';
    }

}

UsuarioView::ejecutar();
?>
