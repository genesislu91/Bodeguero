<?php require_once 'u_encabezadoForm.php'; ?>
<!-- ####################################################################################################### -->
<div id="cuerpo">
    <div id="menu_lateral">
        <ul>
            <?php
            foreach ($opcionesMenuLateral as $opcionMenuLateral) {
                echo $opcionMenuLateral;
            }
            ?>
        </ul>
    </div>
    <div id="contenido">
        <h1>Mis Compras</h1>
        <form id="formulario" action="" method="POST">
            <?php if ($seleccionarProveedor): ?>
                <fieldset>
                    <legend>Seleccionar Proveedor</legend>
                    <div id="bloque_centrado">
                        <div id="bloque_izquierdo">
                            <select name="proveedor_id">
                                <?php foreach (ProveedorLogic::getAll() as $proveedor): ?>
                                    <option value="<?php echo $proveedor->getProveedorId() ?>"><?php echo PersonaJuridicaLogic::buscarPersonaJuridicaPorId($proveedor->getPersonaId())->getRazonSocial(); ?></option>
                                <?php endforeach ?>
                            </select><br/>
                        </div>
                        <div id="bloque_derecho">
                            <input type="submit" value="Continuar"/><br/>
                        </div>
                    </div>
                    <div id="bloque_izquierdo">
                        <a href="?opcion=ver_compras">Volver</a>
                    </div>
                </fieldset>
            <?php else: ?>
                <fieldset>
                    <legend>Agregar Producto</legend>
                    <div id="bloque_centrado">
                        <div id="bloque_izquierdo">
                            <p>Proveedor Seleccionado: <?php echo PersonaJuridicaLogic::buscarPersonaJuridicaPorId(ProveedorLogic::getProveedorPorId($_SESSION['proveedor_id'])->getPersonaId())->getRazonSocial(); ?></p>
                        </div>
                        <div id="bloque_derecho">
                            <p>Fecha de Compra (año-mes-día): <?php echo date('Y-m-d'); ?></p>
                        </div>
                    </div>
                    <div id="bloque_centrado">
                        <div id="bloque_izquierdo">
                            <select name="producto">
                                <option selected value="ninguno">Producto</option>
                                <?php foreach (ProductoLogic::getProductoPorProveedor(PersonaJuridicaLogic::buscarPersonaJuridicaPorId(ProveedorLogic::getProveedorPorId($_SESSION['proveedor_id'])->getPersonaId())->getRazonSocial()) as $producto): ?>
                                    <option value="<?php echo $producto->getProductoId() ?>"><?php echo $producto->getNombre() . ', Precio de Lista Unitario: S/.' . $producto->getPrecioCompra(); ?></option>
                                <?php endforeach ?>
                            </select><br/>
                            <input type="submit" name="agregarProducto" value="Agregar Producto"/><br/>
                            <input type="submit" name="vaciarCarrito" value="Vaciar Carrito"/><br/>
                        </div>
                        <div id="bloque_derecho">
                            <label for="cantidad">Cantidad</label><input name="cantidad" type="text"/><br/>
                            <label for="precio_unitario">Precio de Compra Unitario (S/.)</label><input name="precio_compra" type="text"/><br/>
                        </div>
                    </div>
                    <table>
                        <caption>Carrito de Compra</caption>
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Categoría</th>
                                <th>Cantidad</th>
                                <th>Unidad de Medida</th>
                                <th>Precio de Lista Unitario (S/.)</th>
                                <th>Precio de Compra Unitario (S/.)</th>
                                <th>Sub Total (S/.)</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (CarritoCompraLogic::mostrarCarrito() != ''):
                                foreach (CarritoCompraLogic::mostrarCarrito() as $i => $detalleCompra): ?>
                                    <tr>
                                        <td><?php echo ProductoLogic::getProductoPorId($detalleCompra->getProductoId())->getNombre(); ?></td>
                                        <td><?php echo CategoriaLogic::getCategoriaPorId((MarcaCategoriaLogic::buscarMarcasCategoriaPorId((ProductoLogic::getProductoPorId($detalleCompra->getProductoId())->getMarcaCategoriaId()))->getCategoria()))->getNombre(); ?></td>
                                        <td><?php echo $detalleCompra->getCantidad(); ?></td>
                                        <td><?php echo UnidadMedidaLogic::getUnidadMedidaPorId(ProductoLogic::getProductoPorId($detalleCompra->getProductoId())->getUnidadMedida())->getNombre(); ?></td>
                                        <td><?php echo ProductoLogic::getProductoPorId($detalleCompra->getProductoId())->getPrecioCompra(); ?></td>
                                        <td><?php echo $detalleCompra->getPrecioCompra(); ?></td>
                                        <td><?php echo $detalleCompra->getSubTotal(); ?></td>
                                        <td><a href="?opcion=registrar_compra&removerProducto=<?php echo $i;?>">Eliminar</a></td>
                                    </tr>
                                <?php endforeach;
                            endif ?>
                        </tbody>
                    </table>
                    <div id="bloque_izquierdo">
                        <p>Total: <?php echo CarritoCompraLogic::obtenerPrecioTotal(); ?> Soles</p>
                        <input type="submit" name="procesarCompra" value="Procesar Compra"/><br/>
                        <a href="?opcion=ver_compras">Volver</a>
                    </div>
                </fieldset>
            <?php endif; ?>
        </form>
    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>
