<?php

require_once '../logic/ProductoLogic.php';
require_once '../logic/CategoriaLogic.php';
session_start();

abstract class ProductoView {

    private static $_opcionesMenuLateral = array(0 => '<li><a href="?opcion=verProducto">Ver Productos</a></li>',
        1 => '<li><a href="?opcion=registrarProducto">Registrar Productos</a></li>',
        2 => '<li><a href="?opcion=ingresarCategoria">Ingresar Categoria</a></li>',
        3 => '<li><a href="?opcion=editarCategoria">Editar Categoria</a></li>'
        );

    public static function ejecutar() {
        if (isset($_SESSION['usuario'])) {
        $listaProducto = ProductoLogic::getAll();
        $listaProveedor = ProveedorLogic::getAll();
        $listaCategoria = CategoriaLogic::getAll();
        $marcas = null;
        if (!isset($_REQUEST['opcion'])) {
            self::_mostrarVerProductos($listaProducto, $listaProveedor, $listaCategoria, $marcas, self::$_opcionesMenuLateral);
        } else {
            $opcion = $_REQUEST['opcion'];
            if (isset($_POST['bProductos'])) {
                $radio_value = $_POST['bProductos'];
            }
            switch ($opcion) {
            
                case 'registrarProducto':
                    if (isset($_REQUEST['boton'])) {
                        $opcion = $_REQUEST['boton'];
                        switch ($opcion) {
                            case 'filtrar':
                                $listaProveedor = array();
                                $p = ProveedorLogic::getProveedorPorNombre($_POST['proveedor']);
                                foreach ($p as $pro) {
                                    $listaProveedor[] = array($pro, PersonaJuridicaLogic::buscarPersonaJuridicaPorId($pro->getPersonaId())->getRazonSocial());
                                }
                                self::_mostrarRegistrarProducto($listaProveedor, $listaCategoria, $marcas, $listaProveedor, self::$_opcionesMenuLateral);
                                break;
                            case 'seleccionar':
                                $_SESSION['proveedor'] = ($_GET['id']);
                                self::_mostrarRegistrarProducto($listaProveedor, $listaCategoria, $marcas, null, self::$_opcionesMenuLateral);

                                break;
                            case 'ver Marcas':
                                $marcas = MarcaCategoriaLogic::buscarMarcasPorCategoria($_POST['categoria']);
                                self::_mostrarRegistrarProducto($listaProveedor, $listaCategoria, $marcas, null, self::$_opcionesMenuLateral);
                                break;
                            case 'registrar':
                                if (isset($_POST['nombre']) & isset($_SESSION['proveedor']) & isset($_POST['precioCompra']) & isset($_POST['precioVenta'])) {

                                    ProductoLogic::Insertar($_POST['nombre'], $_POST['descripcion'], $_POST['precioVenta'], $_POST['precioCompra'], 0, $_POST['unidad'], MarcaCategoriaLogic::getMarcaCategoriaPorMarcaIdyCategoria($_POST['marca'], $_POST['categoria']), $_SESSION['proveedor']);
                                    echo 'se registro correctamente';
                                    self::_mostrarRegistrarProducto(null, $listaCategoria, null, null, self::$_opcionesMenuLateral);
                                } else {
                                    echo 'completa todos los datos';
                                }
                                break;
                            default:
                                break;
                        }
                    } else {
                        self::_mostrarRegistrarProducto(null, $listaCategoria, null, null, self::$_opcionesMenuLateral);
                    }
                    break;

                case 'modificar':
                    self::_mostrarModificarProducto($listaProducto, $listaProveedor, $listaCategoria, self::$_opcionesMenuLateral);
                    break;
                case 'editarCategoria':
                    if (isset ($_REQUEST['boton'])) {
                     $boton = $_REQUEST['boton'];
                    switch ($boton) {
                        case 'modificar':
                            $categoria = CategoriaLogic::getCategoriaPorId($_POST['categoria']);
                            $marcas = MarcaCategoriaLogic::buscarMarcasPorCategoria($categoria->getCategoriaId());
                            self::_mostrarModificarCategoria($listaCategoria, $marcas, $categoria, self::$_opcionesMenuLateral);
                            break;
                        case 'agregar':break;
                        case 'Modificar categoria':
                            break;
                    }

                    }else{
                        $listaCategoria = CategoriaLogic::getAll();
                    self::_mostrarModificarCategoria($listaCategoria, null, null, self::$_opcionesMenuLateral);
                    }
                    break;
               

                case 'verProducto':
                    $boton=null;
                    if(isset ($_REQUEST['boton'])){
                    $boton = $_REQUEST['boton'];
                    }
                    if($boton!=null){
                    switch ($boton) {
                        case 'ver Marcas':
                            $marcas = MarcaCategoriaLogic::buscarMarcasPorCategoria($_POST['categoria']);
                            self::_mostrarVerProductos(null, $listaProveedor, $listaCategoria, $marcas, self::$_opcionesMenuLateral);
                            break;
                        case 'Ver':
                            $radio_value = $_POST['bProductos'];
                            if ($radio_value == 1) {
                                $categoria = $_POST['categoria'];

                                $listaProducto = ProductoLogic::getProductoPorCategoria($categoria);
                                self::_mostrarVerProductos($listaProducto, $listaProveedor, $listaCategoria, $marcas, self::$_opcionesMenuLateral);
                            } elseif ($radio_value == 2) {
                                $nombre = $_POST['nombre'];
                                $listaProducto = ProductoLogic::getProductoPorNombre($nombre);
                                self::_mostrarVerProductos($listaProducto, $listaProveedor, $listaCategoria, $marcas, self::$_opcionesMenuLateral);
                            } elseif ($radio_value == 3) {
                                $proveedor = $_POST['proveedor'];
                                $listaProducto = ProductoLogic::getProductoPorProveedor($proveedor);
                                self::_mostrarVerProductos($listaProducto, $listaProveedor, $listaCategoria, $marcas, self::$_opcionesMenuLateral);
                            }
                            break;
                       case 'ModificarP':
                           $producto=ProductoLogic::getTodoProductoPorId($_GET['id']);
                           self::_mostrarModificarProducto($producto, $listaProveedor, $listaCategoria, self::$_opcionesMenuLateral);
                           break;
                    }
                    }else{
                        self::_mostrarVerProductos($listaProducto, $listaProveedor, $listaCategoria, $marcas, self::$_opcionesMenuLateral);
                    }
                    break;

                

                case 'modificarProducto':
                    break;

                case 'ingresarCategoria':
                    if(isset ($_REQUEST['boton'])){
                    $boton = $_REQUEST['boton'];
                    switch ($boton) {
                        case 'agregar':
                            if (!isset($_SESSION['marcas'])) {
                                $_SESSION['marcas'] = array();
                            }
                            $_SESSION['marcas'][] = $_POST['marca'];
                            self::_mostrarRegistrarCategoria($_SESSION['marcas'], self::$_opcionesMenuLateral);

                            break;
                        case 'eliminar':
                            $arre = $_SESSION['marcas'];
                            unset($arre[$_GET['marca']]);
                            $_SESSION['marcas'] = array_values($arre);
                            self::_mostrarRegistrarCategoria($_SESSION['marcas'], self::$_opcionesMenuLateral);
                            break;

                        case 'registrar':
                            break;

                        default:
                            $nombre = $_POST['nombre'];
                    $descripcion = $_POST['descripcion'];
                    $subCategoria = $_POST['subcategoria'];
                    CategoriaLogic::insertarCategoria($nombre, $descripcion);
                    $listaSubCategoria = $_SESSION['subcategoria'];
                    $listaSubCategoria[] = $subCategoria;
                    $_SESSION['subcategoria'] = $listaSubCategoria;
                    self::_mostrarRegistrarCategoria($listaSubCategoria, self::$_opcionesMenuLateral);
                            break;
                    }

                    }else{
                        self::_mostrarRegistrarCategoria(null, self::$_opcionesMenuLateral);
                    }
                    
                    break;

                

                
            }
        }
       
    } else{
             header("location:UsuarioView.php");
        }
    }

    private static function _mostrarVerProductos($listaProducto, $listaProveedor, $listaCategoria, $marcas, $opcionesMenuLateral) {
        require_once 'productos_verProductos.php';
    }

    

    private static function _mostrarRegistrarProducto($listaProveedor, $listaCategoria, $marcas, $proveedores, $opcionesMenuLateral) {
        require_once 'productos_registrarProducto.php';
    }

    private static function _mostrarModificarProducto($producto, $listaProveedor, $listaCategoria, $opcionesMenuLateral) {
        require_once 'productos_modificarProducto.php';
    }

    private static function _mostrarRegistrarCategoria($listaSubCategoria, $opcionesMenuLateral) {
        require_once 'productos_registrarCategoria.php';
    }

    private static function _mostrarModificarCategoria($listaCategoria, $marcas, $categoria, $opcionesMenuLateral) {
        require_once 'producto_modificarCategoria.php';
    }

}

ProductoView::ejecutar();
?>
