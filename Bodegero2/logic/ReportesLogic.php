<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReportesLogic
 *
 * @author jose
 */
require_once 'VentaLogic.php';
require_once 'DetalleVentaLogic.php';
require_once 'ProductoLogic.php';
require_once 'ProveedorLogic.php';
require_once 'PersonaJuridicaLogic.php';
require_once 'CompraLogic.php';
require_once 'DetalleCompraLogic.php';

abstract class ReportesLogic {

    public static function getDetallesVentaDeUsuarioActual() {
        $ventaIds = array();
        foreach (VentaLogic::getAll() as $venta) {
            $ventaIds[] = $venta->getVentaId();
        }
        $ventaIds = array_unique($ventaIds);
        $detallesVenta = array();
        foreach (DetalleVentaLogic::getAll() as $detalleVenta) {
            foreach ($ventaIds as $ventaId) {
                if ($detalleVenta->getVentaId() == $ventaId) {
                    $detallesVenta[] = $detalleVenta;
                    break; //Regresa al primer bloque foreach.
                }
            }
        }
        return $detallesVenta;
    }

    public static function getUnidadesVendidasPorProducto() {
        $detallesVenta = self::getDetallesVentaDeUsuarioActual();
        $cantidadesVendidas = array();
        foreach ($detallesVenta as $detalleVenta) {
            if (!isset($cantidadesVendidas[$detalleVenta->getProductoId()])) {
                $cantidadesVendidas[$detalleVenta->getProductoId()] = $detalleVenta->getCantidad();
            } else {
                $cantidadesVendidas[$detalleVenta->getProductoId()] += $detalleVenta->getCantidad();
            }
        }
        $unidadesVendidas = array();
        foreach ($cantidadesVendidas as $productoId => $cantidadVendida) {
            $unidadesVendidas[$productoId]['codigo'] = $productoId;
            $unidadesVendidas[$productoId]['producto'] = ProductoLogic::getProductoPorId($productoId)->getNombre();
            $unidadesVendidas[$productoId]['proveedor'] = PersonaJuridicaLogic::buscarPersonaJuridicaPorId(ProveedorLogic::getProveedorPorId(ProductoLogic::getProductoPorId($productoId)->getProveedorId())->getPersonaId())->getRazonSocial();
            $unidadesVendidas[$productoId]['cantidadTotalVendida'] = $cantidadVendida;
        }
        return $unidadesVendidas;
    }

     public static function getDetallesCompraDeUsuarioActual() {
        $compraIds = array();
        foreach (CompraLogic::getAll() as $compra) {
            $compraIds[] = $compra->getCompraId();
        }
        $compraIds = array_unique($compraIds);
        $detallesCompra = array();
        foreach (DetalleCompraLogic::getAll() as $detalleCompra) {
            foreach ($compraIds as $compraId) {
                if ($detalleCompra->getCompraId() == $compraId) {
                    $detallesCompra[] = $detalleCompra;
                    break; //Regresa al primer bloque foreach.
                }
            }
        }
        return $detallesCompra;
    }

    public static function getUnidadesCompradasPorProducto() {
        $detallesCompra = self::getDetallesCompraDeUsuarioActual();
        $cantidadesCompradas = array();
        foreach ($detallesCompra as $detalleCompra) {
            if (!isset($cantidadesCompradas[$detalleCompra->getProductoId()])) {
                $cantidadesCompradas[$detalleCompra->getProductoId()] = $detalleCompra->getCantidad();
            } else {
                $cantidadesCompradas[$detalleCompra->getProductoId()] += $detalleCompra->getCantidad();
            }
        }
        $unidadesVendidas = array();
        foreach ($cantidadesCompradas as $productoId => $cantidadComprada) {
            $unidadesVendidas[$productoId]['codigo'] = $productoId;
            $unidadesVendidas[$productoId]['producto'] = ProductoLogic::getProductoPorId($productoId)->getNombre();
            $unidadesVendidas[$productoId]['proveedor'] = PersonaJuridicaLogic::buscarPersonaJuridicaPorId(ProveedorLogic::getProveedorPorId(ProductoLogic::getProductoPorId($productoId)->getProveedorId())->getPersonaId())->getRazonSocial();
            $unidadesVendidas[$productoId]['cantidadTotalComprada'] = $cantidadComprada;
        }
        return $unidadesVendidas;
    }

}

?>
