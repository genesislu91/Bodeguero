<?php
session_start();
abstract class ReportesView {

    private static $_opcionesMenuLateral = array(0 => '<li><a href="?opcion=rproductos">Reporte de Productos</a></li>',
        1 => '<li><a href="?opcion=rproveedores">Reporte Proveedores</a></li>',
        2 => '<li><a href="?opcion=rclientes">Reporte Clientes</a></li>',
        3 => '<li><a href="?opcion=rventas">Reporte de Ventas</a></li>',
        4 => '<li><a href="?opcion=rcompras">Reporte de Compras</a></li>',);

    public static function ejecutar() {
        if (isset($_SESSION['usuario'])) {
        $opcion = null;
        if (isset($_GET['opcion'])) {
            $opcion = $_GET['opcion'];
        }
        switch ($opcion) {
            case 'rventas':
                self::_mostrarVerReporteVentas(self::$_opcionesMenuLateral);
                break;
            case 'rcompras':
                self::_mostrarVerReporteCompras(self::$_opcionesMenuLateral);
                break;
            case 'rproductos':
                self::_mostrarVerReporteProductos(self::$_opcionesMenuLateral);
                break;
            case 'rclientes':
                self::_mostrarVerReporteClientes(self::$_opcionesMenuLateral);
                break;
            case 'rproveedores':
                self::_mostrarVerReporteProveedores(self::$_opcionesMenuLateral);
                break;
            default:
                self::_mostrarVerReporteVentas(self::$_opcionesMenuLateral);
                break;
        }
        }else{
             header("location:UsuarioView.php");
        }
    }

    private static function _mostrarVerReporteVentas($opcionesMenuLateral) {
        require_once 'reportes_ventas.php';
    }

    private static function _mostrarVerReporteCompras($opcionesMenuLateral) {
        require_once 'reporte_compras.php';
    }

    private static function _mostrarVerReporteClientes($opcionesMenuLateral) {
        require_once 'reportes_clientes.php';
    }

    private static function _mostrarVerReporteProductos($opcionesMenuLateral) {
        require_once 'reporte_productos.php';
    }

    private static function _mostrarVerReporteProveedores($opcionesMenuLateral) {
        require_once 'reportes_ventas.php';
    }

}

ReportesView::ejecutar();
?>
