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
        <h1>Mis ventas</h1>
        <fieldset>
            <legend>Detalle de venta</legend>
            <div id="bloque_centrado">
                <div id="bloque_izquierdo">
                    <p>Cliente: <?php if($cliente[0]->getTipo()==1){echo $cliente[1]->getRazonSocial();}else{echo $cliente[1]->getNombre()." ".$cliente[1]->getApellidoPaterno()." ".$cliente[1]->getApellidoMaterno();} ?></p>
                </div>
                <div id="bloque_izquierdo">
                    <p>Fecha de Venta: <?php echo $venta->getFechaVenta() ?></p>
                </div>
            </div>
            <table>
                <caption>Detalle de Compra</caption>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario (S/.)</th>
                        <th>Sub Total (S/.)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($detalle != null) { ?>
                    
                    <?php foreach ($detalle as $c) { ?>
                        <tr>
                            <td><?php echo $c[0]->getDetalleVenta(); ?></td>
                            <td><?php echo $c[1]->getNombre(); ?></td>
                            <td><?php echo $c[0]->getCantidad(); ?></td>
                            <td><?php echo $c[1]->getPrecioVenta(); ?></td>
                            <td><?php echo $c[0]->getSubTotal(); ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
            <div id="bloque_izquierdo">
                <p>Total: <?php echo $venta->getMontoTotal(); ?> Soles</p>
                 <a href="VentasView.php">Volver</a>
            </div>
        </fieldset>
    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>