<?php
require_once '../logic/CategoriaLogic.php';
require_once '../logic/MarcaLogic.php';
require_once '../logic/MarcaCategoriaLogic.php';
require_once '../logic/ProductoLogic.php';
require_once '../logic/ClienteLogic.php';
require_once '../logic/PersonaNaturalLogic.php';
require_once '../logic/VentaLogic.php';
require_once '../logic/DetalleVentaLogic.php';
session_start();
abstract class VentasView {
    private static $_opcionesMenuLateral = array(0 => '<li><a href="?opcion=ver">Ver Ventas</a></li>',
        1 => '<li><a href="?opcion=registrar">Registrar Ventas</a></li>');

    public static function ejecutar() {
        if (isset($_SESSION['usuario'])) {
            $categorias = CategoriaLogic::getAll();
            $marcas = null;
            $encontrados = null;
            $opcion = null;
            $clientes = array();
            $clienteSel = null;
            $opcion = 'ver';
            $carriCompra = null;
            if (isset($_GET['opcion'])) {
                $opcion = $_GET['opcion'];
            }
            if ($opcion != null) {
                switch ($opcion) {
                    case 'registrar':
                    if (isset($_SESSION['clienteSel'])) {
                            $clienteSel = $_SESSION['clienteSel'];
                    }
                    if (isset($_SESSION['carritoVenta'])) {
                            $carriCompra = $_SESSION['carritoVenta'];
                    }
                        if (isset($_REQUEST['boton'])) {
                            $boton = $_REQUEST['boton'];
                            switch ($boton) {
                                case 'ver Marcas':
                                    $marcas = MarcaCategoriaLogic::buscarMarcasPorCategoria($_POST['categoria']);
                                     self::_mostrarRegistrarVentas($categorias, $marcas, $encontrados, $clientes, $clienteSel, $carriCompra, self::$_opcionesMenuLateral);
                                    break;
                                case 'Buscar Clientes':
                                    $clientes = ClienteLogic::mostrarClientesCompletoPorNombre($_POST['cliente'], $_POST['tipo_persona']);
                                     self::_mostrarRegistrarVentas($categorias, $marcas, $encontrados, $clientes, $clienteSel, $carriCompra, self::$_opcionesMenuLateral);
                                    break;
                                case 'seleccionarCliente':
                                    $id = $_GET['id'];
                                    $clienteSel = ClienteLogic::buscarClientePorId($id);
                                    $_SESSION['clienteSel'] = $clienteSel;
                                     self::_mostrarRegistrarVentas($categorias, $marcas, $encontrados, $clientes, $clienteSel, $carriCompra, self::$_opcionesMenuLateral);
                                    break;
                                case 'Buscar':
                                    $condicion = $_POST['condicion'];
                                    $encontrados=null;
                                    switch ($condicion) {
                                        case 0:
                                            if (isset($_POST['marca'])) {
                                                $encontrados = ProductoLogic::getProductoPorMarcaCategoria($_POST['marca']);
                                                
                                                
                                            } else {
                                                $encontrados = ProductoLogic::getProductoPorCategoria($_POST['categoria']);
                                                
                                            }
                                            break;
                                        case 1:
                                            $encontrados = ProductoLogic::getProductoPorNombre($_POST['valor']);
                                            break;
                                        case 2:
                                            $encontrados = ProductoLogic::getProductoPorProveedor($_POST['valor']);
                                            break;
                                    }
                                   // $productos=ProductoLogic::MostrarProductosCompleto($encontrados);
                                    
                                     self::_mostrarRegistrarVentas($categorias, $marcas, $encontrados, $clientes, $clienteSel, $carriCompra, self::$_opcionesMenuLateral);
                                    break;
                                case 'Agregar':
                                    if(isset ($_REQUEST['id'])){
                                        if (!isset($_SESSION['carritoVenta'])) {
                                        $_SESSION['carritoVenta'] = array();
                                    }
                                    $arreglo = $_SESSION['carritoVenta'];
                                    $producto=ProductoLogic::getProductoPorId($_REQUEST['id']);
                                    if(isset($arreglo[$producto->getProductoId()][1])){
                                    $cantidad=$arreglo[$producto->getProductoId()][1]+$_POST['cantidad'];}
                                    else{
                                      $cantidad=$_POST['cantidad'];
                                    }
                                    if($cantidad<=$producto->getCantidad()){
                                    $arreglo[$producto->getProductoId()] = array(ProductoLogic::getProductoPorId($_REQUEST['id']), $cantidad);
                                    $_SESSION['carritoVenta'] = $arreglo;
                                    
                                    }
                                    }
                                    $carriCompra=$_SESSION['carritoVenta'];
                                     self::_mostrarRegistrarVentas($categorias, $marcas, $encontrados, $clientes, $clienteSel, $carriCompra, self::$_opcionesMenuLateral);
                                    break;
                                case 'eliminar':
                                    $arreglo = $_SESSION['carritoVenta'];
                                    $indice = $_GET['id'];
                                    unset($arreglo[$indice]);
                                    $_SESSION['carritoVenta'] = array_values($arreglo);
                                    $carriCompra= $_SESSION['carritoVenta'];
                                     self::_mostrarRegistrarVentas($categorias, $marcas, $encontrados, $clientes, $clienteSel, $carriCompra, self::$_opcionesMenuLateral);
                                    break;
                                case 'limpiar':
                                    
                                    $_SESSION['clienteSel']= '';
                                    $_SESSION['carritoVenta'] = null;
                                    self::_mostrarRegistrarVentas($categorias, null, null, null, null, null, self::$_opcionesMenuLateral);
                                    break;
                                case 'Registrar':
                                    if(($_SESSION['clienteSel'])!=null & $_SESSION['clienteSel']!=''){
                                    $venta = VentaLogic::insertar($_POST['total'], date('Y-m-d'), $_SESSION['clienteSel'][0]->getClienteId());
                                    //echo var_dum$venta);p(
                                    $detalleVentas=$_SESSION['carritoVenta'];
                                    foreach ($detalleVentas as $value) {
                                        DetalleVentaLogic::insertar($venta[0]->getVentaId(), $value[0]->getProductoId(), $value[0]->getPrecioVenta(), $value[1]);

                                    }
                                    $_SESSION['clienteSel']= '';
                                    $_SESSION['carritoVenta'] = null;
                                    $detallea = DetalleVentaLogic::getDetallePorVenta($venta[0]->getVentaId());
                                    $detalle=DetalleVentaLogic::mostrarTodoCompleto($detallea);
                                    
                                    $cliente=ClienteLogic::buscarClientePorId($venta[0]->getCliente());
                                    self::_mostrarDetalleVenta($detalle, $cliente, $venta[0], self::$_opcionesMenuLateral);
                                    return;

                                    }
                                    break;
                            }
                        }
                        
                        self::_mostrarRegistrarVentas($categorias, $marcas, $encontrados, $clientes, $clienteSel, $carriCompra, self::$_opcionesMenuLateral);
                        break;
                    case 'ver':
                        $clienteSeleccionado=null;
                        if(isset ($_SESSION['cliente'])){
                            $clienteSeleccionado=ClienteLogic::buscarClientePorId($_SESSION['cliente']);
                        }
                        $productoSeleccionado=null;
                        if(isset ($_SESSION['productos'])){
                            $productoSeleccionado=ProductoLogic::getProductoPorId($_SESSION['productos']);
                        }
                        if (isset($_REQUEST['boton'])) {
                            switch ($_REQUEST['boton']) {
                                
                                case 'buscar Clientes':
                                    if ($_POST['tipo_persona'] == 0) {
                                        if ($_POST['subtipo'] == 0) {
                                            $clientes[0] = ClienteLogic::getClientePorNombre($_POST['cliente'], 0);
                                        } else {
                                            $clientes[0] = ClienteLogic::getClientePorDNI($_POST['cliente']);
                                           
                                        }
                                        $clientes[1] = 0;
                                    } else {
                                        if ($_POST['subtipo'] == 0) {
                                            $clientes[0] = ClienteLogic::getClientePorNombre($_POST['cliente'],1);
                                        } else {
                                            $clientes[0] = ClienteLogic::getClientePorRuc($_POST['cliente']);
                                        }
                                        $clientes[1] = 1;
                                    }
                                    self::_mostrarVerVentas($clientes, null, null, null, $categorias, self::$_opcionesMenuLateral,$clienteSeleccionado,$productoSeleccionado);


                                    break;
                                case 'ver Marcas':
                                    $marcas = MarcaCategoriaLogic::buscarMarcasPorCategoria($_POST['categoria']);
                                    self::_mostrarVerVentas(null, null, null, $marcas, $categorias, self::$_opcionesMenuLateral,$clienteSeleccionado,$productoSeleccionado);
                                    break;
                                case 'buscar':
                                    $condicion = $_POST['condicion'];
                                    switch ($condicion) {
                                        case 0:
                                            if (isset($_POST['marca'])) {
                                                $encontrados = ProductoLogic::getProductoPorMarcaCategoria($_POST['marca']);
                                            } else {
                                                $encontrados = ProductoLogic::getProductoPorCategoria($_POST['categoria']);
                                            }
                                            break;
                                        case 1:
                                            $encontrados = ProductoLogic::getProductoPorNombre($_POST['valor']);
                                            break;
                                        case 2:
                                            $encontrados = ProductoLogic::getProductoPorProveedor($_POST['valor']);
                                            break;
                                    }
                                    $productos=ProductoLogic::MostrarProductosCompleto($encontrados);
                                    self::_mostrarVerVentas(null, $productos, null, null, $categorias, self::$_opcionesMenuLateral,$clienteSeleccionado,$productoSeleccionado);
                                    break;
                                case 'seleccionarC':
                                    $_SESSION['cliente']=  ClienteLogic::buscarClienteIDPorPersonaID($_GET['id']);
                                    $clienteSeleccionado=ClienteLogic::buscarClientePorId($_SESSION['cliente']);
                                    self::_mostrarVerVentas(null, null, null, null, $categorias, self::$_opcionesMenuLateral,$clienteSeleccionado,$productoSeleccionado);
                                    break;
                                case 'seleccionarP':
                                    $_SESSION['productos'] = $_GET['id'];
                                     $productoSeleccionado=ProductoLogic::getProductoPorId($_SESSION['productos']);
                                    self::_mostrarVerVentas(null, null, null, null, $categorias, self::$_opcionesMenuLateral,$clienteSeleccionado,$productoSeleccionado);
                                    break;
                                case 'limpiar':
                                    $_SESSION['cliente']=null;
                                     $_SESSION['productos']=null;
                                    self::_mostrarVerVentas(null, null, null, null, $categorias, self::$_opcionesMenuLateral,null,null);
                                    break;
                                case 'Buscar Ventas':
                                    $ventasa=null;
                                    if ($_POST['tipoConsulta'] == 0) {
                                        if (isset($_SESSION['cliente'])) {
                                            $ventasa = VentaLogic::getVentasPorCliente($_SESSION['cliente']);
                                           
                                        }
                                    } else {
                                        if ($_POST['tipoConsulta'] == 1) {
                                            if (isset($_SESSION['productos'])) {
                                                $ventasa = DetalleVentaLogic::getVentaPorProducto($_SESSION['productos']);
                                            } 
                                        }else {
                                                $ventasa = VentaLogic::getVentasPorFecha($_POST['fecha']);
                                            }
                                    }
                                    $_SESSION['cliente']=null;
                                    $_SESSION['productos']=null;
                                    $ventas=VentaLogic::mostrarTodoCompleto($ventasa);
                                    self::_mostrarVerVentas(null, null, $ventas, null, $categorias, self::$_opcionesMenuLateral,null,null);
                                    break;
                                case 'detalle':
                                    $detallea = DetalleVentaLogic::getDetallePorVenta($_GET['id']);
                                    $detalle=DetalleVentaLogic::mostrarTodoCompleto($detallea);
                                    $venta=VentaLogic::getVentasPorId($_GET['id']);
                                    $cliente=ClienteLogic::buscarClientePorId($venta[0]->getCliente());
                                    self::_mostrarDetalleVenta($detalle, $cliente, $venta[0], self::$_opcionesMenuLateral);
                                    break;

                                default:
                                    break;
                            }
                        }else{
                       self::_mostrarVerVentas(null, null, null, null, $categorias, self::$_opcionesMenuLateral,$clienteSeleccionado ,$productoSeleccionado);

                       }
                       // break;
                }
            } else {
                self::_mostrarRegistrarVentas($categorias, $marcas, $encontrados, $clientes, self::$_opcionesMenuLateral);
            }
        } else {
            header("location:UsuarioView.php");
        }
    }

    public static function _mostrarRegistrarVentas($categorias, $marcas, $encontrados, $clientes, $clienteSel, $carriCompra, $opcionesMenuLateral) {
        require_once 'ventas_registrarVenta.php';
    }

    public static function _mostrarVerVentas($clientes, $productos, $ventas, $marcas, $categorias, $opcionesMenuLateral,$clienteSeleccionado,$productoSeleccionado) {
        require_once 'ventas_verVentas.php';
    }
    public static function _mostrarDetalleVenta($detalle,$cliente,$venta,$opcionesMenuLateral){
        require_once 'ventas_detalleVenta.php';
    }

}

VentasView::ejecutar();
?>
