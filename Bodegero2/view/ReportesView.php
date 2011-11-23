<?php
require_once '../logic/ReportesLogic.php';
require_once '../logic/VentaLogic.php';
require_once '../logic/DetalleVentaLogic.php';
require_once '../logic/ProductoLogic.php';
session_start();
abstract class ReportesView {
    private static $_opcionesMenuLateral = array(
        0 => '<li><a href="?opcion=reporteCompras">Reporte Compras</a></li>',
        1 => '<li><a href="?opcion=reporteVentas">Reporte Ventas</a></li>',
        2 => '<li><a href="?opcion=utilidadDia">Utilidad del dia</a></li>');
    public static function ejecutar() {
        if(isset($_SESSION['usuario'])){
            $opcion = null;
            if(isset($_REQUEST['opcion'])){
                $opcion = $_REQUEST['opcion'];
            }
            switch ($opcion) {
                case 'reporteCompras':
                    self::_mostrarVerReporteCompras(self::$_opcionesMenuLateral);
                    break;
                case 'reporteVentas':
                    self::_mostrarVerReporteVentas(self::$_opcionesMenuLateral);
                    break;
                case 'utilidadDia':
                    $ventas = VentaLogic::getAll();
                    $lista = array();
                    $hoy = intval(date('d'));
                    foreach($ventas as $venta){
                        $array = explode('-', $venta->getFechaVenta());
                        $dia = intval(date('d',mktime(0, 0, 0, $array[1], $array[2], $array[0])));

                        if($hoy == $dia){
                            $lista[] = $venta;
                        }
                    }
                    $totalVenta = 0;
                    $costoVenta = 0;
                    foreach($lista as $venta){
                        $totalVenta += $venta->getMontoTotal();
                        $detalles = DetalleVentaLogic::getDetallePorVenta($venta->getVentaId());
                        $detalles = DetalleVentaLogic::mostrarTodoCompleto($detalles);
                        foreach($detalles as $detalle){
                            $costoVenta += $detalle[1]->getPrecioCompra()*$detalle[0]->getCantidad();
                        }
                    }
                    $utilidadBruta = $totalVenta - $costoVenta;
                    $totalVenta = number_format($totalVenta, 2);
                    $costoVenta = number_format($costoVenta, 2);
                    $utilidadBruta = number_format($utilidadBruta, 2);
                    self::mostrarReporteUtilidadDia(self::$_opcionesMenuLateral,$totalVenta,$costoVenta,$utilidadBruta);
                    break;
                default:
                    self::_mostrarVerReporteVentas(self::$_opcionesMenuLateral);
                    break;
            }
        } else {
            header("location:UsuarioView.php");
        }
    }
    private static function mostrarReporteUtilidadDia($opcionesMenuLateral,$totalVenta,$costoVenta,$utilidadBruta){
        require_once 'reportes_utilidadDia.php';
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