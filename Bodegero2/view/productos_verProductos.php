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
        <form method="POST" action="?opcion=verProducto">
            <table width="100%">
                <tr>
                    <td colspan="4"></td>
                </tr>

                <tr>
                    <td><input type="radio" checked="true" name="bProductos" value="1" />Por Categoria:</td>
                    <td>
                        <?php if ($listaCategoria != null) { ?>
                            <select name="categoria">
                                <?php foreach ($listaCategoria as $categoria) { ?>
                                    <option value="<?php echo $categoria->getCategoriaId(); ?>"><?php echo $categoria->getNombre(); ?></option>
                                <?php } ?>
                            </select>
                        <?php } ?></td>
                    <td><input type="submit" name="boton" value="ver Marcas"/></td>
                    <td> <?php if (isset($marcas) & $marcas != null) { ?>
                            <select name="marca">
                                <?php foreach ($marcas as $m) { ?>
                                    <option value="<?php echo $m->getMarcaId(); ?>"><?php echo $m->getNombre(); ?></option>
                                <?php } ?></select><?php } ?></td>

                </tr>
                <tr>
                    <td colspan="2"><input type="radio" name="bProductos" value="2" /> Por Nombre:</td>
                    <td colspan="2"><input type="text" name="nombre" id="nombre" /></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="radio" name="bProductos" value="3" /> Por Proveedor</td>
                    <td colspan="2"><input type="text" name="proveedor" id="proveedor" /></td>
                </tr>
                <tr>
                    <td colspan="4"><input type="submit" name="boton" value="Ver" /></td>
                </tr>
                <?php if ($listaProducto != null) { ?>
                    <tr>
                        <td colspan="4">Resultado</td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <table width="100%" >
                                <tr>
                                        <th>Nombre</th>
                                        <th>Proveedor</th>
                                        <th>Categoria</th>
                                        <th>Precio(S/.)</th>
                                        <th>Unidad de medidad</th>
                                        <th>Descripcion</th>
                                        <th>Opcion</th>
                                    </tr>
                                
                    
                    <?php foreach ($listaProducto as $producto) { ?>
                        <tr>
                            <td><?php echo $producto->getNombre(); ?></td>
                            <td><?php echo $producto->getProveedorId(); ?></td>
                            <td><?php echo $producto->getCantidad(); ?></td>
                            <td><?php echo $producto->getPrecioVenta(); ?></td>
                            <td><?php echo $producto->getUnidadMedida(); ?></td>
                            <td><?php echo $producto->getDescripcion(); ?></td>
                            <td><a href="?opcion=verProducto&boton=ModificarP&id=<?php echo $producto->getProductoId(); ?>">ModificarProducto</a></td>
                        </tr>
                    <?php }
                } ?>
            </table>
            </td>
            </tr>
            </table>
        </form>


        
    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>
