<?php

require_once '../logic/ProveedorLogic.php';
require_once '../logic/PersonaJuridicaLogic.php';
require_once '../logic/ProductoLogic.php';
require_once '../logic/CompraLogic.php';
require_once '../logic/DetalleCompraLogic.php';
require_once '../logic/CarritoCompraLogic.php';

session_start();

abstract class ComprasView {

    private static $opcionesMenuLateral = array(0 => '<li><a href="?opcion=ver_compras">Ver Compras</a></li>',
        1 => '<li><a href="?opcion=registrar_compra">Registrar Compra</a></li>');

    public static function ejecutar() {
        if (!isset($_SESSION['usuario'])) {
            session_destroy();
            header('Location:InicioViewController.php');
        } else {
            $opcion = null;
            if (isset($_GET['opcion'])) {
                $opcion = $_GET['opcion'];
            }
            switch ($opcion) {
                case 'ver_compras':
                    self::mostrarVerCompras(self::$opcionesMenuLateral);
                    break;
                case 'ver_detalle_compra':
                    self::mostrarVerDetalleCompra(self::$opcionesMenuLateral);
                    break;
                case 'registrar_compra':
                    self::mostrarRegistrarCompra(self::$opcionesMenuLateral);
                    break;
                default:
                    self::mostrarVerCompras(self::$opcionesMenuLateral);
                    break;
            }
        }
    }

    private static function mostrarVerCompras($opcionesMenuLateral) {

        if (isset($_SESSION['proveedor_id'])) {
            unset($_SESSION['proveedor_id']);
        }
        if (isset($_SESSION['carritoCompra'])) {
            unset($_SESSION['carritoCompra']);
        }

        $proveedores = ProveedorLogic::mostrarTodoCompleto(ProveedorLogic::getAll());


        if (isset($_POST['busqueda'])) {
            switch ($_POST['busqueda']) {
                case 'por_proveedor':
                    $comprasa = CompraLogic::getCompraPorProveedorId($_POST['proveedor']);
                    break;
                case 'por_fecha':
                    $comprasa = CompraLogic::getCompraPorFechaCompra($_POST['fecha']);
                    break;
            }
            $compras=CompraLogic::mostrarTodoCompleto($comprasa);
            require_once 'compras_verCompras.php';
        } else {
            $compras = CompraLogic::mostrarTodoCompleto(CompraLogic::getAll());
            require_once 'compras_verCompras.php';
        }
    }

    private static function mostrarVerDetalleCompra($opcionesMenuLateral) {

        $detalleCompra = DetalleCompraLogic::getDetalleCompraPorCompraId($_GET['compra_id']);
        $detallesCompra= DetalleCompraLogic::mostrarTodoCompleto($detalleCompra);
        $proveedor = PersonaJuridicaLogic::buscarPersonaJuridicaPorId(ProveedorLogic::getProveedorPorId(CompraLogic::getCompraPorId($_GET['compra_id'])->getProveedorId())->getPersonaId())->getRazonSocial();
        $fechaCompra = CompraLogic::getCompraPorId($_GET['compra_id'])->getFechaCompra();
        $montoTotal = CompraLogic::getCompraPorId($_GET['compra_id'])->getMontoTotal();
        require_once 'compras_detalleCompra.php';
    }

    private static function mostrarRegistrarCompra($opcionesMenuLateral) {

        if (isset($_POST['procesarCompra'])) {
            CarritoCompraLogic::procesarCompra();
        }

        if (isset($_POST['agregarProducto'])) {
            CarritoCompraLogic::agregarProducto($_POST['producto'], $_POST['cantidad']);
        }

        if (isset($_POST['vaciarCarrito'])) {
            CarritoCompraLogic::vaciarCarrito();
        }

        if (isset($_GET['removerProducto'])) {
            CarritoCompraLogic::removerProducto($_GET['removerProducto']);
            header('Location:?opcion=registrar_compra');
        }


        if (isset($_SESSION['proveedor_id'])) {
            $seleccionarProveedor = false;
        } elseif (isset($_POST['proveedor_id'])) {
            $_SESSION['proveedor_id'] = $_POST['proveedor_id'];
            $seleccionarProveedor = false;
        } else {
            $seleccionarProveedor = true;
            $proveedores = ProveedorLogic::mostrarTodoCompleto(ProveedorLogic::getAll());
        }

        if (!$seleccionarProveedor) {
            $proveedorSeleccionado = PersonaJuridicaLogic::buscarPersonaJuridicaPorId(ProveedorLogic::getProveedorPorId($_SESSION['proveedor_id'])->getPersonaId())->getRazonSocial();
            $productosPorProveedor = ProductoLogic::getProductoPorProveedor(PersonaJuridicaLogic::buscarPersonaJuridicaPorId(ProveedorLogic::getProveedorPorId($_SESSION['proveedor_id'])->getPersonaId())->getRazonSocial());
            $carritoDeCompra = CarritoCompraLogic::mostrarCarrito();
            $precioTotal = CarritoCompraLogic::obtenerPrecioTotal();
        }

        if (!isset($_SESSION['carritoCompra'])) {
            $_SESSION['carritoCompra'] = '';
        }

        require_once 'compras_registrarCompra.php';
    }

}

ComprasView::ejecutar();
?>
