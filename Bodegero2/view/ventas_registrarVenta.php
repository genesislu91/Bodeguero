<?php require_once 'u_encabezadoForm.php'; ?>
<!-- ####################################################################################################### -->
<script>

</script>
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
        <fieldset><legend>Registrar Venta</legend>
        <form method="POST" action="?opcion=registrar" name="ventas" id="ventas">
            <table id="bloque_centrado">
                <tr>
                    <td >Tipo de Cliente</td>
                    <td><select name="tipo_persona" >
                            <option value="1">Persona Juridica</option>
                            <option value="2">Persona Natural</option>
                        </select>
                    </td>
                    <td>Nombre/RazonSocial</td>
                    <td><input type="text" name="cliente"/></td>
                    <td><input type="submit" name="boton" value="Buscar Clientes"/></td>
                </tr>
                        <?php if($clientes != null){ ?>
                <tr>
                    <td colspan="5">
                        <table width="100%">
                            <tr>
                                <td>Nombre/RazonSocial</td>
                                <td>Ruc/Dni</td>
                                <td>Opcion</td>
                            </tr>
                                <?php foreach($clientes as $cliente){ ?>
                            <tr>
                                <td><?php if($cliente[0]->getTipo() == 1){echo $cliente[1]->getRazonSocial();}else{ echo $cliente[1]->getNombre()." ".$cliente[1]->getApellidoPaterno()." ".$cliente[1]->getApellidoMaterno();} ?></td>
                                <td><?php if($cliente[0]->getTipo() == 1){echo $cliente[1]->getRuc();}else{ echo $cliente[1]->getDni();} ?></td>
                                <td><a href="?opcion=registrar&boton=seleccionarCliente&id=<?php echo $cliente[0]->getClienteId(); ?>">Seleccionar Cliente</a></td>
                            </tr>
                                <?php }?>
                        </table>
                    </td>
                </tr>
                        <?php }?>
                        <?php if($clienteSel != null){ ?>
                <tr>
                    <td colspan="5">
                        <table width="100%">
                            <tr>
                                <td>Nombre/RazonSocial</td>
                                <td>Ruc/Dni</td>
                            </tr>
                            <tr>
                                <td><?php if($clienteSel[0]->getTipo() == 1){echo $clienteSel[1]->getRazonSocial();}else{ echo $clienteSel[1]->getNombre()." ".$clienteSel[1]->getApellidoPaterno()." ".$clienteSel[1]->getApellidoMaterno();;} ?></td>
                                <td><?php if($clienteSel[0]->getTipo() == 1){echo $clienteSel[1]->getRuc();}else{ echo $clienteSel[1]->getDni();} ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                        <?php }else{?>
                    <tr>
                        <td colspan="5">Debe seleccionar Cliente</td>
                    </tr>
                        <?php } ?>
                <tr>
                    <td >Buscar producto por: </td>
                    <td><select name="condicion">
                            <option value="0">Categoria</option>
                            <option value="1">Nombre</option>
                            <option value="2">Proveedor</option>
                        </select></td>
                    <td>Categoria/Nombre/Proveedor</td>
                    <td><input type="text" name="valor"/></td><td><input type="submit" name="boton" value="Buscar"/></td>

                </tr>
                <tr>
                    <td>Categorias</td>
                    <td ><select name="categoria">
                                    <?php foreach($categorias as $categoria){ ?>
                            <option value="<?php echo $categoria->getCategoriaId();?>"><?php echo $categoria->getNombre();?></option>
                                    <?php } ?>
                        </select></td>
                    <td><input type="submit" name="boton" value="ver Marcas"/></td>
                    <td><?php if($marcas!=null){?>
                        <select name="marca">
                                    <?php foreach($marcas as $marca){ ?>
                            <option value="<?php echo $marca->getMarcaId();?>"><?php echo $marca->getNombre();?></option>
                                    <?php } ?>
                        </select>
                                <?php }?>
                    </td><td></td>
                </tr>
                        <?php if ($encontrados != null){ ?>
                <tr>
                    <td colspan="5">
                        <table width="100%">
                            <tr>
                                <td>Producto</td>
                                <td>Nombre</td>
                                <td>Stock</td>
                                <td>Precio</td>
                                <td>Opcion</td>
                            </tr>
                                <?php foreach($encontrados as $p){ if($p->getCantidad()>0){ ?>
                            <tr>
                                <td><?php echo $p->getProductoId(); ?></td>
                                <td><?php echo $p->getNombre(); ?></td>
                                <td><?php echo $p->getCantidad(); ?></td>
                                <td><?php echo $p->getPrecioVenta(); ?></td>
                                <td><input type="radio" name="id" value="<?php echo $p->getProductoId(); ?>" id=""/></td>
                            </tr>
                                <?php }}?>
                        </table>
                        <p>Cantidad: <input type="text" name="cantidad" id="cantidad" value="1"/>  <input type="submit" name="boton" value="Agregar" /></p>
                    </td>
                </tr>
                        <?php } ?>
                        <?php if($carriCompra != null){ $indice = 1;?>
                <tr>
                    <td colspan="5">
                        <table width="100%">
                            <tr>
                                <th>Item</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Stock</th>
                                <th>SubTotal</th>
                                <th>Opcion</th>
                            </tr>
                                <?php $total = 0;  foreach($carriCompra as $p){ ?>
                            <tr>
                                <td><?php echo $indice; ?></td>
                                <td><?php echo $p[0]->getNombre(); ?></td>
                                <td><?php echo $p[0]->getPrecioVenta(); ?></td>
                                <td><?php echo $p[1]; ?></td>
                                <td><?php echo $p[0]->getCantidad(); ?></td>
                                <td><?php $subTotal = $p[1]*$p[0]->getPrecioVenta(); $total += $subTotal; echo $subTotal; ?></td>
                                <td><a href="?opcion=registrar&boton=eliminar&id=<?php echo $p[0]->getProductoId(); ?>" />Eliminar</a></td>
                            </tr>
                                <?php $indice++;}?>
                        </table>
                        <p><?php  echo 'Total: '.$total; ?><input type="hidden" name="total" value="<?php  echo $total; ?>"/></p>
                        <p><input type="submit" name="boton" value="Registrar" /></p>
                    </td>
                </tr>
                        <?php } ?>
                <tr>
                    <td colspan="5"><input type="submit" name="boton" value="limpiar" /></td>
                </tr>
            </table>
        </form>
        </fieldset>
    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>
