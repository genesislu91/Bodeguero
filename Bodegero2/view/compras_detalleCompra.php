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
        <fieldset>
            <legend>Detalle de Compra</legend>
            <div id="bloque_centrado">
                <div id="bloque_izquierdo">
                    <p>Proveedor: <?php echo $proveedor; ?></p>
                </div>
                <div id="bloque_derecho">
                    <p>Fecha de Compra (año-mes-día): <?php echo $fechaCompra; ?></p>
                </div>
            </div>
            <table>
                <caption>Detalle de Compra</caption>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Unidad de Medida</th>
                        <th>Precio de Compra Unitario (S/.)</th>
                        <th>Sub Total (S/.)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detallesCompra as $detalleCompra): ?>
                        <tr>
                            <td><?php echo $detalleCompra[1]->getNombre(); ?></td>
                            <td><?php echo $detalleCompra[0]->getCantidad(); ?></td>
                            <td><?php echo $detalleCompra[2]; ?></td>
                            <td><?php echo $detalleCompra[1]->getPrecioCompra(); ?></td>
                            <td><?php echo $detalleCompra[0]->getSubTotal(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div id="bloque_izquierdo">
                <p>Total: <?php echo $montoTotal; ?> Soles</p>
                <a href="?opcion=ver_compras">Volver</a>
            </div>
        </fieldset>
    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>
