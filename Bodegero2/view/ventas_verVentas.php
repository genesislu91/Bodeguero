<?php require_once 'u_encabezadoForm.php'; ?>
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
        <fieldset><legend>Ver Ventas</legend>
        <form method="POST" action="?opcion=ver" name="ventas" id="ventas">
           <table width="100%">
                <tr>
                    <td ><input type="radio" checked="true" name="tipoConsulta" value="0" selected="selected">Por Cliente</td>
                    <td><select name="tipo_persona" >
                            <option value="0">persona Natural</option>
                            <option value="1">persona Juridica</option>
                        </select>
                    </td>
                    <td><select name="subtipo"><option value="0">Nombre</option><option value="1">DNI/RUC</option></select></td>
                    <td><input type="text" name="cliente"/></td>
                    <td><input type="submit" name="boton" value="buscar Clientes"/></td>
                </tr>
                <?php if ($clientes!=null) { ?>
                    <tr>
                        <td colspan="5">
                            <table width="100%" >
                                <tr>
                                    <td>Nombre/RazonSocial</td>
                                    <td>Ruc/Dni</td>
                                    <td>Opcion</td>
                                </tr>
                                <?php foreach ($clientes[0] as $c) { ?>
                                    <tr>
                                        <td><?php
                            if ($clientes[1] == 1) {
                                echo $c->getRazonSocial();
                            } else {
                                echo $c->getNombre()." ".$c->getApellidoPaterno()." ".$c->getApellidoMaterno();
                            }
                                    ?></td>
                                        <td><?php
                                    if ($clientes[1] == 1) {
                                        echo $c->getRuc();
                                    } else {
                                        echo $c->getDni();
                                    }
                                    ?></td>
                                        <td><a href="?boton=seleccionarC&tipo=<?php echo $clientes[1]; ?>&id=<?php echo $c->getPersonaId() ?>">seleccionarCliente</a></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>
                <?php } ?>
                 <?php if(isset($clienteSeleccionado) & $clienteSeleccionado !=null ){?>
                    <tr>
                        <td colspan="2" >Cliente Seleccionado</td>
                        <td colspan="3"><?php if($clienteSeleccionado[0]->getTipo()==1){ echo $clienteSeleccionado[1]->getRazonSocial();}else{ echo $clienteSeleccionado[1]->getNombre()." ".$clienteSeleccionado[1]->getApellidoPaterno()." ".$clienteSeleccionado[1]->getApellidoMaterno();} ?></td>
                    </tr>
                 <?php } ?>
                <tr>
                    <td ><input type="radio" name="tipoConsulta" value="1" >Por Producto</td>
                    <td><select name="condicion">
                            <option value="0">categoria</option>
                            <option value="1">nombre</option>
                            <option value="2">proveedor</option>
                        </select></td>
                    <td>Nombre/Proveedor</td>
                    <td><input type="text" name="valor"/></td><td><input type="submit" name="boton" value="buscar"/></td>

                </tr>
                <tr>
                    <td>Categorias</td>
                    <td ><select name="categoria">
                            <?php foreach ($categorias as $categoria) { ?>
                                <option value="<?php echo $categoria->getCategoriaId(); ?>"><?php echo $categoria->getNombre(); ?></option>
                            <?php } ?>
                        </select></td>
                    <td><input type="submit" name="boton" value="ver Marcas"/></td>
                    <td><?php if ($marcas != null) { ?>
                            <select name="marca">
                                <?php foreach ($marcas as $marca) {  ?>
                                    <option value="<?php echo $marca[0]; ?>"><?php echo $marca[1]->getNombre(); ?></option>
                                <?php } ?>
                            </select>
                        <?php } ?>
                    </td><td></td>
                </tr>
                <?php if ($productos != null) { ?>
                    <tr>
                        <td colspan="5">
                            <table id="bloque_centrado" >
                                <tr>
                                    <td>Producto</td>
                                    <td>Nombre</td>
                                    <td>Proveedor</td>
                                    <td>Opcion</td>
                                    
                                </tr>
                                <?php foreach ($productos as $p) { ?>
                                    <tr>
                                        <td><?php echo $p[0]->getProductoId(); ?></td>
                                        <td><?php echo $p[0]->getNombre(); ?></td>
                                        <td><?php echo $p[1]; ?></td>
                                        <td><a href="?boton=seleccionarP&id=<?php echo $p[0]->getProductoId(); ?>">seleccionar</a></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>
                <?php } ?>
                <?php if($productoSeleccionado !=null){?>
                    <tr>
                        <td colspan="2" >Producto Seleccionado</td>
                        <td colspan="3"><?php echo $productoSeleccionado->getNombre(); ?></td>
                    </tr>
                 <?php } ?>
                <tr><td colspan="2"><input type="radio" name="tipoConsulta" value="2" />Por Fecha</td>
                    <td colspan="3"><input type="text" value="fecha" name="fecha"/></td>
                </tr>
                <tr>
                    <td colspan="3" align="center"><input type="submit" name="boton" value="Buscar Ventas"/></td>
                    <td colspan="2" align="center"><input type="submit" name="boton" value="limpiar"/></td>
                </tr>
                <?php if ($ventas != null) { ?>
                <tr>
                    <th>VentaId</th>
                    <th>FechaVenta</th>
                    <th>Cliente</th>
                    <th>Monto Total</th>
                    <th></th>
                </tr>
                    <?php foreach ($ventas as $c) { ?>
                        <tr>
                            <td><?php echo $c[0]->getVentaId(); ?></td>
                            <td><?php echo $c[0]->getFechaVenta(); ?></td>
                            <td><?php if($c[2]==0){echo $c[1]->getNombre();}else{ echo $c[1]->getRazonSocial();} ?></td>
                            <td><?php echo $c[0]->getMontoTotal(); ?></td>
                            <td><a href="?boton=detalle&id=<?php echo $c[0]->getVentaId(); ?>">ver Detalle</a></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
               
            </table>
        </form></fieldset>
    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>
