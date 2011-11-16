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
        <center><h1>Mis Reportes</h1></center>

        <form action="" method="POST" id="formulario">
            <fieldset>
                <legend>Reporte de Compras</legend>
                <div id="bloque_centrado">
                    <?php if ($reporte == 'unidadesCompradasPorProducto'): ?>
                        <table>
                            <caption>Unidades Compradas por Producto</caption>
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Producto</th>
                                    <th>Proveedor</th>
                                    <th>Cantidad Total Comprada</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($unidadesCompradas as $unidadComprada): ?>
                                    <tr>
                                        <td><?php echo $unidadComprada['codigo']; ?></td>
                                        <td><?php echo $unidadComprada['producto']; ?></td>
                                        <td><?php echo $unidadComprada['proveedor']; ?></td>
                                        <td><?php echo $unidadComprada['cantidadTotalComprada']; ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    <?php endif ?>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>