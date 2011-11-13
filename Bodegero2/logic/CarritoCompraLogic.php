<?php
require_once '../model/DetalleCompra.php';
require_once 'CompraLogic.php';
require_once 'DetalleCompraLogic.php';

abstract class CarritoCompraLogic {

    private static $_carritoCompra = '';

    public static function agregarProducto($productoId, $cantidad, $precioCompra) {
        self::$_carritoCompra = unserialize($_SESSION['carritoCompra']);
        $subtotal = $cantidad * $precioCompra;
        $detalleCompra = new DetalleCompra(null, null, $productoId, $precioCompra, $cantidad, $subtotal);
        self::$_carritoCompra[] = $detalleCompra;
        $_SESSION['carritoCompra'] = serialize(self::$_carritoCompra);
    }

    public static function removerProducto($posicion) {
        self::$_carritoCompra = unserialize($_SESSION['carritoCompra']);
        unset(self::$_carritoCompra[$posicion]);
        $_SESSION['carritoCompra'] = serialize(self::$_carritoCompra);
    }

    public static function obtenerPrecioTotal() {
        self::$_carritoCompra = unserialize($_SESSION['carritoCompra']);
        $precioTotal = 0;
        if (self::$_carritoCompra != '') {
            foreach (self::$_carritoCompra as $detalleCompra) {
                $precioTotal += $detalleCompra->getSubtotal();
            }
        }
        return $precioTotal;
    }

    public static function vaciarCarrito() {
        self::$_carritoCompra = array();
        $_SESSION['carritoCompra'] = serialize(self::$_carritoCompra);
    }

    public static function mostrarCarrito() {
        self::$_carritoCompra = unserialize($_SESSION['carritoCompra']);
        return self::$_carritoCompra;
    }

    public static function procesarCompra() {
        self::$_carritoCompra = unserialize($_SESSION['carritoCompra']);
        $compraId = CompraLogic::insertarCompra(self::obtenerPrecioTotal(), date('Y-m-d'), $_SESSION['proveedor_id']);
        foreach (self::$_carritoCompra as $detalleCompra) {
            DetalleCompraLogic::insertarDetalleCompra($compraId, $detalleCompra->getProductoId(), $detalleCompra->getPrecioCompra(), $detalleCompra->getCantidad(), $detalleCompra->getSubtotal());
        }
        unset($_SESSION['carritoCompra']);
        unset($_SESSION['proveedor_id']);
    }

}

?>
