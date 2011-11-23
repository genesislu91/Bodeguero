<?php

require_once '../logic/ProductoLogic.php';
require_once '../logic/CategoriaLogic.php';
require_once '../logic/UnidadMedidaLogic.php';
session_start();

abstract class ProductoView {

    private static $_opcionesMenuLateral = array(0 => '<li><a href="?opcion=verProducto">Ver Productos</a></li>',
        1 => '<li><a href="?opcion=registrarProducto">Registrar Productos</a></li>',
        2 => '<li><a href="?opcion=ingresarCategoria">Ingresar Categoria</a></li>',
        3 => '<li><a href="?opcion=editarCategoria">Editar Categoria</a></li>',
        4 => '<li><a href="?opcion=marcas">Ingresar marcas</a></li>'
        );

    public static function ejecutar() {
        if (isset($_SESSION['usuario'])) {
        $listaProductoa = ProductoLogic::getAll();
        $listaProducto = ProductoLogic::MostrarProductosCompleto($listaProductoa);
        $listaProveedor = ProveedorLogic::getAll();
        $listaCategoria = CategoriaLogic::getAll();
        
        $marcas = null;
        if (! isset($_REQUEST['opcion'])) {
         
            self::_mostrarVerProductos($listaProducto, $listaProveedor, $listaCategoria, $marcas, self::$_opcionesMenuLateral);
        
        } else {
            $opcion = $_REQUEST['opcion'];
            if (isset($_POST['bProductos'])) {
                $radio_value = $_POST['bProductos'];
            }
            switch ($opcion) {
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
                                if(isset($_POST['marca'])){
                                     $listaProductoa = ProductoLogic::getProductoPorMarcaCategoria($_POST['marca']);
                                    }else{
                                
                                $listaProductoa = ProductoLogic::getProductoPorCategoria($categoria);
                                
                                }
                                $listaProducto=ProductoLogic::MostrarProductosCompleto($listaProductoa);
                                self::_mostrarVerProductos($listaProducto, $listaProveedor, $listaCategoria, $marcas, self::$_opcionesMenuLateral);
                            } elseif ($radio_value == 2) {
                                $nombre = $_POST['nombre'];
                                $listaProductoa = ProductoLogic::getProductoPorNombre($nombre);
                                $listaProducto= ProductoLogic::MostrarProductosCompleto($listaProductoa);
                                self::_mostrarVerProductos($listaProducto, $listaProveedor, $listaCategoria, $marcas, self::$_opcionesMenuLateral);
                            } elseif ($radio_value == 3) {
                                $proveedor = $_POST['proveedor'];
                                $listaProductoa = ProductoLogic::getProductoPorProveedor($proveedor);
                                $listaProducto= ProductoLogic::MostrarProductosCompleto($listaProductoa);
                                self::_mostrarVerProductos($listaProducto, $listaProveedor, $listaCategoria, $marcas, self::$_opcionesMenuLateral);
                            }
                            break;
                       case 'ModificarP':
                           $producto=ProductoLogic::getTodoProductoPorId($_GET['id']);
                           $cat=ProductoLogic::getCategoriaProducto($producto->getProductoId());
                           $marcas=  MarcaCategoriaLogic::buscarMarcasPorCategoria($cat);
                           $mc=  MarcaCategoriaLogic::buscarMarcasCategoriaPorId($producto->getMarcaCategoriaId());
                           $listaCategoria= CategoriaLogic::getAll();
                           $listaProveedor=ProveedorLogic::mostrarTodoCompleto(ProveedorLogic::getAll());
                           $ums= UnidadMedidaLogic::getAll();
                           $u=$producto->getUnidadMedida();
                           $pro=$producto->getProveedorId();
                           self::_mostrarModificarProducto($producto,$ums,$u, $listaProveedor,$pro, $listaCategoria,$cat,$marcas,$mc->getMarcaCategoriaId(), self::$_opcionesMenuLateral);
                           break;
                    }
                    }else{
                        self::_mostrarVerProductos($listaProducto, $listaProveedor, $listaCategoria, $marcas, self::$_opcionesMenuLateral);
                    }
                    break;
                case 'registrarProducto':
                    $um=  UnidadMedidaLogic::getAll();
                    $pselec=null;
                    if(isset ($_SESSION['proveedor'])){
                        $pselec=ProveedorLogic::mostrarTodoCompleto(array(ProveedorLogic::getProveedorPorId($_SESSION['proveedor'])));
                    }
                    if (isset($_REQUEST['boton'])) {
                        $opcion = $_REQUEST['boton'];
                        switch ($opcion) {
                            case 'filtrar':
                                $listaProveedor = array();
                                $p = ProveedorLogic::getProveedorPorNombre($_POST['proveedor']);
                                foreach ($p as $pro) {
                                    $listaProveedor[] = array($pro, PersonaJuridicaLogic::buscarPersonaJuridicaPorId($pro->getPersonaId())->getRazonSocial());
                                }
                                self::_mostrarRegistrarProducto($listaProveedor, $listaCategoria, $marcas, $listaProveedor,$pselec,$um,null, self::$_opcionesMenuLateral);
                                break;
                            case 'seleccionar':
                                $_SESSION['proveedor'] = ($_GET['id']);
                                $pselec=ProveedorLogic::mostrarTodoCompleto(array(ProveedorLogic::getProveedorPorId($_SESSION['proveedor'])));
                                self::_mostrarRegistrarProducto($listaProveedor, $listaCategoria, $marcas, null,$pselec,$um,null, self::$_opcionesMenuLateral);

                                break;
                            case 'ver Marcas':
                                $marcas = MarcaCategoriaLogic::buscarMarcasPorCategoria($_POST['categoria']);
                                self::_mostrarRegistrarProducto($listaProveedor, $listaCategoria, $marcas, null,$pselec,$um,null, self::$_opcionesMenuLateral);
                                break;
                            case 'registrar':
                                if (isset($_POST['nombre']) & isset($_SESSION['proveedor']) & isset($_POST['precioCompra']) & isset($_POST['precioVenta']) & isset ($_POST['marca'])) {
                                    
                                    ProductoLogic::insertarProducto($_POST['nombre'], $_POST['descripcion'], $_POST['precioVenta'], $_POST['precioCompra'], 0, $_POST['unidad'], $_POST['marca'],  $_SESSION['proveedor'],$_SESSION['usuario']);
                                    $_SESSION['proveedor']=null;
                                    self::_mostrarRegistrarProducto(null, $listaCategoria, null, null,$pselec,$um,'se registro correctamente',self::$_opcionesMenuLateral);
                                } else {
                                     self::_mostrarRegistrarProducto(null, $listaCategoria, null, null,null,$um,'completa todos los datos',self::$_opcionesMenuLateral);
                                }
                                break;
                            default:
                                break;
                        }
                    } else {
                        self::_mostrarRegistrarProducto(null, $listaCategoria, null, null,$pselec,$um,null, self::$_opcionesMenuLateral);
                    }
                    break;

                case 'modificarProducto':
                    if(isset ($_POST['boton'])){
                        switch ($_POST['boton']){
                            case 'Ver Marcas':
                                $marcas = MarcaCategoriaLogic::buscarMarcasPorCategoria($_POST['categoria']);
                                $producto=ProductoLogic::getProductoPorId($_POST['id']);
                                 $listaCategoria= CategoriaLogic::getAll();
                                 $listaProveedor=ProveedorLogic::mostrarTodoCompleto(ProveedorLogic::getAll());
                                 $ums= UnidadMedidaLogic::getAll();
                                 $pro=$producto->getProveedorId();
                                self::_mostrarModificarProducto($producto, $ums, -1, $listaProveedor, $pro, $listaCategoria,$_POST['categoria'], $marcas, $_POST['categoria'], self::$_opcionesMenuLateral);
                                break;
                            case 'Modificar Producto':
                                $id=$_POST['id'];
                                $nombre=$_POST['nombre'];
                                $mc=$_POST['marca'];
                                $proveedor=$_POST['proveedor'];
                                $descripcion=$_POST['descripcion'];
                                $pc=$_POST['precioCompra'];
                                $pv=$_POST['precioVenta'];
                                $um=$_POST['unidadMedida'];
                                ProductoLogic::actualizarProducto($id, $nombre, $descripcion, $pv  , $pc,  $um, $mc, $proveedor);
                                self::_mostrarVerProductos(ProductoLogic::MostrarProductosCompleto(ProductoLogic::getAll()), null, CategoriaLogic::getAll(), null, self::$_opcionesMenuLateral);
                                break;
                        }
                        
                    }
                    
                    break;
                case 'ingresarMarca':
                    $nombre=$_POST['nombre'];
                    MarcaLogic::insertar($nombre);
                    self::_mostrarIngresarMarcas(MarcaLogic::getAll(),self::$_opcionesMenuLateral);
                    break;
                case 'marcas':
                    self::_mostrarIngresarMarcas(MarcaLogic::getAll(),self::$_opcionesMenuLateral);
                case 'editarCategoria':

                    if (isset ($_REQUEST['boton'])) {
                     $boton = $_REQUEST['boton'];
                     $opcmarcas=MarcaLogic::getAll();
                    switch ($boton) {
                        case 'modificar':
                            $categoria = CategoriaLogic::getCategoriaPorId($_POST['categoria']);
                            $marcast = MarcaCategoriaLogic::buscarMarcasPorCategoria($categoria->getCategoriaId());
                            $marcas=array();
                            foreach ($marcast as $m){
                                $marcas[$m[1]->getMarcaId()]=$m[1];
                            }
                            $_SESSION['marcass']=$marcas;
                            self::_mostrarModificarCategoria($listaCategoria,  $opcmarcas, ($_SESSION['marcass']), $categoria,null, self::$_opcionesMenuLateral);
                            break;
                        case 'agregar':
                            $marcas=$_SESSION['marcass'];
                            $marcas[$_POST['marca']]=MarcaLogic::getMarcaPorId($_POST['marca']);
                            $_SESSION['marcass']=$marcas;
                            $categoria=CategoriaLogic::getCategoriaPorId($_POST['categoriaId']);
                             self::_mostrarModificarCategoria($listaCategoria,  $opcmarcas, ($_SESSION['marcass']), $categoria,null, self::$_opcionesMenuLateral);

                            break;
                        case 'eliminar':
                            $id=$_GET['marca'];
                            $mc=MarcaCategoriaLogic::buscarMarcaCategoriaPorMarcaYCategoria($id, $_GET['categoria']);
                            if($mc ==null){
                                unset($_SESSION['marcass'][$_GET['marca']]);
                                 $listaCategoria = CategoriaLogic::getAll();
                                 $categoria=CategoriaLogic::getCategoriaPorId($_GET['categoria']);
                                 self::_mostrarModificarCategoria($listaCategoria,  $opcmarcas, ($_SESSION['marcass']), $categoria,null, self::$_opcionesMenuLateral);
                            }else{
                                if( MarcaCategoriaLogic::eliminarMarcaCategoria($mc->getMarcaCategoriaId())){

                                unset($_SESSION['marcass'][$_GET['marca']]);
                                 $listaCategoria = CategoriaLogic::getAll();
                                 $categoria=CategoriaLogic::getCategoriaPorId($_GET['categoria']);
                                 self::_mostrarModificarCategoria($listaCategoria,  $opcmarcas, ($_SESSION['marcass']), $categoria,null, self::$_opcionesMenuLateral);

                                 }else{
                                     $listaCategoria = CategoriaLogic::getAll();
                                 $categoria=CategoriaLogic::getCategoriaPorId($_GET['categoria']);
                                     self::_mostrarModificarCategoria($listaCategoria,  $opcmarcas, ($_SESSION['marcass']), $categoria, 
                                             'No se puede eliminar la marca porque existen productos con dicha categoria',self::$_opcionesMenuLateral);
                                 }
                            }
                             break;
                        case 'Modificar categoria':
                            if(count($_SESSION['marcass']>0)){
                            $nombre = $_POST['nombre'];
                            $descripcion = $_POST['descripcion'];
                            $catid=CategoriaLogic::editarCategoria($_POST['categoriaId'], $nombre, $descripcion);
                            foreach($_SESSION['marcass'] as $mc){
                                MarcaCategoriaLogic::insertar($mc->getMarcaId(), $_POST['categoriaId']);
                            }
                            $_SESSION['marcass']=null;
                             $listaCategoria = CategoriaLogic::getAll();
                            self::_mostrarModificarCategoria($listaCategoria,null, null, null,null, self::$_opcionesMenuLateral);
                            }else{
                                 $listaCategoria = CategoriaLogic::getAll();
                                 $categoria=CategoriaLogic::getCategoriaPorId($_GET['categoria']);
                                     self::_mostrarModificarCategoria($listaCategoria,  $opcmarcas, ($_SESSION['marcass']), $categoria, "Se debe tener al menos una marca",self::$_opcionesMenuLateral);
                            }
                            
                            break;
                    }

                    }else{
                        $listaCategoria = CategoriaLogic::getAll();
                    self::_mostrarModificarCategoria($listaCategoria,null, null, null, null,self::$_opcionesMenuLateral);
                    }

                    break;

                 case 'ingresarCategoria':
                  //   echo $_REQUEST['boton'];
                   $marcas= MarcaLogic::getAll();
                    if(isset ($_REQUEST['boton'])){
                    $boton = $_REQUEST['boton'];
                    switch ($boton) {
                        case 'agregar':
                            if (!isset($_SESSION['marcas'])) {
                                $_SESSION['marcas'] = array();
                            }
                            $m=$_SESSION['marcas'];
                            $m[$_POST['marca']] = MarcaLogic::getMarcaPorId($_POST['marca']);
                            $_SESSION['marcas']=$m;
                            self::_mostrarRegistrarCategoria($_SESSION['marcas'],$marcas,null, self::$_opcionesMenuLateral);

                            break;
                        case 'eliminar':
                            $arre = $_SESSION['marcas'];
                            unset($arre[$_GET['marca']]);
                            $_SESSION['marcas'] = array_values($arre);
                            self::_mostrarRegistrarCategoria(($_SESSION['marcas']),$marcas,null, self::$_opcionesMenuLateral);
                            break;

                        case 'Agregar categoria':
                            if(!isset ($_SESSION['marcas'])){
                                $_SESSION['marcas']=NULL;
                            }
                            if( count($_SESSION['marcas']>0) & $_SESSION['marcas']!=null & isset ($_POST['nombre'])){
                                
                            $nombre = $_POST['nombre'];
                            $descripcion = $_POST['descripcion'];
                            $catid=CategoriaLogic::insertarCategoria($nombre, $descripcion);
                            foreach($_SESSION['marcas'] as $mc){
                                MarcaCategoriaLogic::insertar($mc->getMarcaId(), $catid);
                            }
                            $_SESSION['marcas']=null;
                            self::_mostrarRegistrarCategoria(null,null,'se registro correctamente', self::$_opcionesMenuLateral);

                            }else{
                               self::_mostrarRegistrarCategoria($_SESSION['marcas'],$marcas,'se debe asignar por lo menos una marca y asignar un nombre', self::$_opcionesMenuLateral);
                            }
                            break;
                    }

                    }else{
                        self::_mostrarRegistrarCategoria(null,$marcas,null, self::$_opcionesMenuLateral);
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



    private static function _mostrarRegistrarProducto($listaProveedor, $listaCategoria, $marcas, $proveedores,$selec,$um,$mensaje, $opcionesMenuLateral) {
        require_once 'productos_registrarProducto.php';
    }

    private static function _mostrarModificarProducto($producto,$ums,$u, $proveedores,$p, $listaCategoria,$cat,$marcas,$mc, $opcionesMenuLateral) {
        require_once 'productos_modificarProducto.php';
    }

    private static function _mostrarRegistrarCategoria($listaSubCategoria,$marcas,$mensaje, $opcionesMenuLateral) {
        require_once 'productos_registrarCategoria.php';
    }

    private static function _mostrarModificarCategoria($listaCategoria,$opcmarcas, $marcas, $categoria,$mensaje, $opcionesMenuLateral) {
       
        require_once 'producto_modificarCategoria.php';
    }
    public static function _mostrarIngresarMarcas($marcas,$opcionesMenuLateral){
        require_once 'productos_insertarMarca.php';
    }

}

ProductoView::ejecutar();
?>
