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
                <legend>Reporte de Ventas</legend>
                <div id="bloque_centrado">
                    <?php if ($reporte == 'unidadesVendidasPorProducto'): ?>
                        <table>
                            <caption>Unidades Vendidas por Producto</caption>
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Producto</th>
                                    <th>Proveedor</th>
                                    <th>Cantidad Total Vendida</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($unidadesVendidas as $unidadVendida): ?>
                                    <tr>
                                        <td><?php echo $unidadVendida['codigo']; ?></td>
                                        <td><?php echo $unidadVendida['producto']; ?></td>
                                        <td><?php echo $unidadVendida['proveedor']; ?></td>
                                        <td><?php echo $unidadVendida['cantidadTotalVendida']; ?></td>
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
