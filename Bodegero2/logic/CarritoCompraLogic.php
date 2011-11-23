<?php
require_once '../model/DetalleCompra.php';
require_once 'CompraLogic.php';
require_once 'DetalleCompraLogic.php';
require_once 'ProductoLogic.php';
require_once 'UnidadMedidaLogic.php';
require_once 'CategoriaLogic.php';
require_once 'MarcaCategoriaLogic.php';
abstract class CarritoCompraLogic {
    private static $_carritoCompra = '';
    public static function agregarProducto($productoId, $cantidad) {
        $precioCompra = ProductoLogic::getProductoPorId($productoId)->getPrecioCompra();
        $encontrado = false;
        self::$_carritoCompra = unserialize($_SESSION['carritoCompra']);
        if (self::$_carritoCompra != '') {
            foreach (self::$_carritoCompra as $detalleCompra) {
                if ($productoId == $detalleCompra->getProductoId()) {
                    $detalleCompra->setCantidad($detalleCompra->getCantidad() + $cantidad);
                    $subtotal = $detalleCompra->getCantidad() * $precioCompra;
                    $detalleCompra->setSubtotal($subtotal);
                    $encontrado = true;
                }
            }
        }
        if(!$encontrado){
            $subtotal = $cantidad * $precioCompra;
            $detalleCompra = new DetalleCompra(null, null, $productoId, $precioCompra, $cantidad, $subtotal);
            self::$_carritoCompra[] = $detalleCompra;
        }
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
        if (self::$_carritoCompra != '') {
            $carritoCompra = array();
            foreach (self::$_carritoCompra as $i => $detalleCompra) {
                $carritoCompra[$i]['producto'] = ProductoLogic::getProductoPorId($detalleCompra->getProductoId())->getNombre();
                $carritoCompra[$i]['categoria'] = CategoriaLogic::getCategoriaPorId((MarcaCategoriaLogic::buscarMarcasCategoriaPorId((ProductoLogic::getProductoPorId($detalleCompra->getProductoId())->getMarcaCategoriaId()))->getCategoria()))->getNombre();
                $carritoCompra[$i]['cantidad'] = $detalleCompra->getCantidad();
                $carritoCompra[$i]['unidadDeMedida'] = UnidadMedidaLogic::getUnidadMedidaPorId(ProductoLogic::getProductoPorId($detalleCompra->getProductoId())->getUnidadMedida())->getNombre();
                $carritoCompra[$i]['precioCompraUnitario'] = ProductoLogic::getProductoPorId($detalleCompra->getProductoId())->getPrecioCompra();
                $carritoCompra[$i]['subtotal'] = $detalleCompra->getSubTotal();
            }
            return $carritoCompra;
        }
        return self::$_carritoCompra;
    }
    public static function procesarCompra() {
        self::$_carritoCompra = unserialize($_SESSION['carritoCompra']);
        if(self::$_carritoCompra != null){
            $compraId = CompraLogic::insertarCompra(self::obtenerPrecioTotal(), date('Y-m-d'), $_SESSION['proveedor_id']);
            foreach (self::$_carritoCompra as $detalleCompra) {
                DetalleCompraLogic::insertarDetalleCompra($compraId, $detalleCompra->getProductoId(), $detalleCompra->getPrecioCompra(), $detalleCompra->getCantidad(), $detalleCompra->getSubtotal());
                ProductoLogic::actualizarStock($detalleCompra->getProductoId(), $detalleCompra->getCantidad());
            }
            unset($_SESSION['carritoCompra']);
            unset($_SESSION['proveedor_id']);
        }
    }
}
?>