<?php

session_start();
require_once '../logic/ReportesLogic.php';

abstract class ReportesView {

    private static $_opcionesMenuLateral = array(0 => '<li><a href="?opcion=reporteCompras">Reporte Compras</a></li>',
        1 => '<li><a href="?opcion=reporteVentas">Reporte Ventas</a></li>',);

    public static function ejecutar() {
        if (isset($_SESSION['usuario'])) {
            $opcion = null;
            if (isset($_GET['opcion'])) {
                $opcion = $_GET['opcion'];
            }
            switch ($opcion) {
                case 'reporteCompras':
                    self::_mostrarVerReporteCompras(self::$_opcionesMenuLateral);
                    break;
                case 'reporteVentas':
                    self::_mostrarVerReporteVentas(self::$_opcionesMenuLateral);
                    break;
                default:
                    self::_mostrarVerReporteVentas(self::$_opcionesMenuLateral);
                    break;
            }
        } else {
            header("location:UsuarioView.php");
        }
    }

    private static function _mostrarVerReporteVentas($opcionesMenuLateral) {
        if (isset($_GET['reporte'])) {
            $reporte = $_GET['reporte'];
        } else {
            $reporte = 'unidadesVendidasPorProducto';
        }
        switch ($reporte) {
            case 'unidadesVendidasPorProducto';
                $unidadesVendidas = ReportesLogic::getUnidadesVendidasPorProducto();
                require_once 'reportes_ventas.php';
                break;
        }
    }

    private static function _mostrarVerReporteCompras($opcionesMenuLateral) {
        if (isset($_GET['reporte'])) {
            $reporte = $_GET['reporte'];
        } else {
            $reporte = 'unidadesCompradasPorProducto';
        }
        switch ($reporte) {
            case 'unidadesCompradasPorProducto';
                $unidadesCompradas = ReportesLogic::getUnidadesCompradasPorProducto();
                require_once 'reporte_compras.php';
                break;
        }
    }

}

ReportesView::ejecutar();
?>
