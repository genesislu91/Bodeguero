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
        <form method="POST" action="?opcion=registrarProducto">
            <table width="100%">
                <tr>
                    <td colspan="1">Nombre:</td>
                    <td colspan="3"><input type="text" name="nombre" id="nombre" /></td>
                </tr>
                <tr>
                    <td >Categoria:</td>
                    <td ><?php if ($listaCategoria != null) { ?>
                            <select name="categoria" >
                                <?php foreach ($listaCategoria as $categoria) { ?>
                                    <option value="<?php echo $categoria->getCategoriaId(); ?>"><?php echo $categoria->getNombre(); ?></option>
                                <?php }
                            } ?></select></td>
                    <td><input type="submit" name="boton" value="ver Marcas"/></td>
                    <td><?php if (isset($marcas) & $marcas != null) { ?>
                            <select name="marca">
                                <?php foreach ($marcas as $m) { ?>
                                    <option value="<?php echo $m->getMarcaId(); ?>"><?php echo $m->getNombre(); ?></option>
                                <?php } ?></select><?php } ?></td>
                </tr>
                <tr>
                    <td>Proveedor</td>
                    <td><input type="text" name="proveedor" value=""/></td><td><input type="submit" name="boton" value="filtrar"></td>
                </tr>
                <tr><?php if ($proveedores != null) { ?>
                        <td colspan="2">
                            <table width="100%">
                                <tr>
                                    <td>Codigo</td>
                                    <td>Proveedor</td>
                                    <td>Seleccionar</td>
                                </tr>
                                <?php foreach ($proveedores as $p) { ?>
                                    <tr>
                                        <td><?php echo $p[0]->getProveedorId(); ?></td>
                                        <td><?php echo $p[1]; ?></td>
                                        <td colspan="2"><a href="?opcion=registrar&boton=seleccionar&id=<?php echo $p[0]->getProveedorId() ?>">Seleccionar</a></td>

                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td colspan="2">Precio Compra:</td>
                    <td colspan="2"><input type="text" name="precioCompra"  /></td>
                </tr>
                <tr>
                    <td colspan="2">Precio Venta:</td>
                    <td colspan="2"><input type="text" name="precioVenta"  /></td>
                </tr>
                <tr>
                    <td colspan="2">Unidad de Medida</td>
                    <td colspan="2"><select name="unidad">
                            <option value="kg">Kg</option>
                            <option value="docena">Docena</option>
                            <option value="unidad">unidad</option>
                        </select></td>
                </tr>
                <tr>
                    <td colspan="2">Descripcion</td>
                    <td colspan="2"><input type="text" name="descripcion" id="descripcion" /></td>
                </tr>
                <tr>
                    <td colspan="4" align="center"><input type="submit" name="boton" value="registrar" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>