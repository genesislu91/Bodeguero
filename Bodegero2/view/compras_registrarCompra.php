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
                                <?php  foreach ($proveedores as $proveedor){ ?>
                                    <option value="<?php echo $proveedor[0]->getProveedorId() ?>"><?php echo $proveedor[1]->getRazonSocial(); ?></option>
                                <?php } ?>
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
                            <p>Proveedor Seleccionado: <?php echo $proveedorSeleccionado; ?></p>
                        </div>
                        <div id="bloque_derecho">
                            <p>Fecha de Compra (año-mes-día): <?php echo date('Y-m-d'); ?></p>
                        </div>
                    </div>
                    <div id="bloque_centrado">
                        <div id="bloque_izquierdo">
                            <select name="producto">
                                <?php foreach ($productosPorProveedor as $producto): ?>
                                    <option value="<?php echo $producto->getProductoId() ?>"><?php echo $producto->getNombre() . ', Precio de Compra Unitario: S/.' . $producto->getPrecioCompra(); ?></option>
                                <?php endforeach ?>
                            </select><br/>
                            <input type="submit" name="agregarProducto" value="Agregar Producto"/><br/>
                            <input type="submit" name="vaciarCarrito" value="Vaciar Carrito"/><br/>
                        </div>
                        <div id="bloque_derecho">
                            <label for="cantidad">Cantidad</label><input name="cantidad" type="text"/><br/>
                            <input type="reset" value="Limpiar Formulario" /><br/>
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
                                <th>Precio de Compra Unitario (S/.)</th>
                                <th>Sub Total (S/.)</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($carritoDeCompra != ''):
                                foreach ($carritoDeCompra as $i => $detalleCompra): ?>
                                    <tr>
                                        <td><?php echo $detalleCompra['producto']; ?></td>
                                        <td><?php echo $detalleCompra['categoria']; ?></td>
                                        <td><?php echo $detalleCompra['cantidad']; ?></td>
                                        <td><?php echo $detalleCompra['unidadDeMedida']; ?></td>
                                        <td><?php echo $detalleCompra['precioCompraUnitario']; ?></td>
                                        <td><?php echo $detalleCompra['subtotal']; ?></td>
                                        <td><a href="?opcion=registrar_compra&removerProducto=<?php echo $i; ?>">Eliminar</a></td>
                                    </tr>
                                <?php endforeach;
                            endif ?>
                        </tbody>
                    </table>
                    <div id="bloque_izquierdo">
                        <p>Total: <?php echo $precioTotal; ?> Soles</p>
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
