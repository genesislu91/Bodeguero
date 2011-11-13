<?php
session_start();
abstract class ProveedorView {

    private static $_opcionesMenuLateral = array(
        0 => '<li><a href="ProveedoresView.php?opcion=ver_proveedor">Ver Proveedores</a></li>',
        1 => '<li><a href="ProveedoresView.php?opcion=registrar_proveedor">Registrar Proveedor</a></li>',
        2 => '<li><a href="ProveedoresView.php?opcion=modificar_proveedor">Modificar Proveedor</a></li>');

    public static function ejecutar() {
        if (isset($_SESSION['usuario'])) {
        $opcion = null;
        if (isset($_GET['opcion'])) {
            $opcion = $_GET['opcion'];
        }
        switch ($opcion) {
            case 'ver_proveedor':
                self::_mostrarVerProveedores(self::$_opcionesMenuLateral);
                break;
            case 'registrar_proveedor':
                self::_mostrarRegistrarProveedor(self::$_opcionesMenuLateral);
                break;
            case 'modificar_proveedor':
                self::_mostrarModificarProveedor(self::$_opcionesMenuLateral);
                break;
            default:
                self::_mostrarVerProveedores(self::$_opcionesMenuLateral);
                break;
        }
        }else{
             header("location:UsuarioView.php");
        }
    }

    private static function _mostrarVerProveedores($opcionesMenuLateral) {
        require_once 'proveedores_verProveedores.php';
    }

    private static function _mostrarRegistrarProveedor($opcionesMenuLateral) {
        require_once 'proveedores_registrarProveedor.php';
    }

    private static function _mostrarModificarProveedor($opcionesMenuLateral) {
        require_once 'proveedores_modificarProveedor.php';
    }

}

ProveedorView::ejecutar();
?>
