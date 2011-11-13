<?php
require_once '../logic/ProveedorLogic.php';
require_once '../logic/PersonaJuridicaLogic.php';
require_once '../logic/ProductoLogic.php';
require_once '../logic/CategoriaLogic.php';
 require_once '../logic/CompraLogic.php';
 require_once '../logic/DetalleCompraLogic.php';
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
        require_once '../logic/ProveedorLogic.php';
        require_once '../logic/PersonaJuridicaLogic.php';
        require_once '../logic/ProductoLogic.php';
        require_once '../logic/CategoriaLogic.php';
        require_once '../logic/CompraLogic.php';

        if (isset($_SESSION['proveedor_id'])) {
            unset($_SESSION['proveedor_id']);
        }
        if (isset($_SESSION['carritoCompra'])) {
            unset($_SESSION['carritoCompra']);
        }

        if (isset($_POST['busqueda'])) {
            switch ($_POST['busqueda']) {
                case 'por_proveedor':
                    $compras = CompraLogic::getCompraPorProveedorId($_POST['proveedor']);
                    require_once 'compras_verCompras.php';
                    break;
                case 'por_fecha':
                    $compras = CompraLogic::getCompraPorFechaCompra($_POST['fecha']);
                    require_once 'compras_verCompras.php';
                    break;
            }
        } else {
            $compras = CompraLogic::getAll();
            require_once 'compras_verCompras.php';
        }
    }

    private static function mostrarVerDetalleCompra($opcionesMenuLateral) {
        require_once '../logic/ProductoLogic.php';
        require_once '../logic/CategoriaLogic.php';
        require_once '../logic/DetalleCompraLogic.php';
        require_once '../logic/ProveedorLogic.php';
        require_once '../logic/CompraLogic.php';
        require_once '../logic/PersonaJuridicaLogic.php';
        require_once '../logic/UnidadMedidaLogic.php';
        require_once '../logic/CategoriaLogic.php';

        $detallesCompra = DetalleCompraLogic::getDetalleCompraPorCompraId($_GET['compra_id']);
        require_once 'compras_detalleCompra.php';
    }

    private static function mostrarRegistrarCompra($opcionesMenuLateral) {
        require_once '../logic/ProveedorLogic.php';
        require_once '../logic/PersonaJuridicaLogic.php';
        require_once '../logic/ProductoLogic.php';
        require_once '../logic/CategoriaLogic.php';
        require_once '../logic/CompraLogic.php';
        require_once '../logic/UnidadMedidaLogic.php';

        require_once '../logic/CarritoCompraLogic.php';

        if (isset($_POST['procesarCompra'])) {
            CarritoCompraLogic::procesarCompra();
        }

        if (isset($_POST['agregarProducto'])) {
            CarritoCompraLogic::agregarProducto($_POST['producto'], $_POST['cantidad'], $_POST['precio_compra']);
        }

        if (isset($_POST['vaciarCarrito'])) {
            CarritoCompraLogic::vaciarCarrito();
        }

        if (isset($_GET['removerProducto'])) {
            CarritoCompraLogic::removerProducto($_GET['removerProducto']);
            header('Location:ComprasViewController.php?opcion=registrar_compra');
        }


        if (isset($_SESSION['proveedor_id'])) {
            $seleccionarProveedor = false;
        } elseif (isset($_POST['proveedor_id'])) {
            $_SESSION['proveedor_id'] = $_POST['proveedor_id'];
            $seleccionarProveedor = false;
        } else {
            $seleccionarProveedor = true;
        }

        if (!isset($_SESSION['carritoCompra'])) {
            $_SESSION['carritoCompra'] = '';
        }

        require_once 'compras_registrarCompra.php';
    }

}

ComprasView::ejecutar();
?>
