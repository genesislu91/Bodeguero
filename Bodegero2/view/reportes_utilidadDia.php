<?php require_once 'u_encabezadoForm.php'; ?>
<!-- ####################################################################################################### -->
<div id="cuerpo">
    <div id="menu_lateral">
        <ul>
            <?php foreach ($opcionesMenuLateral as $opcionMenuLateral) {
                echo $opcionMenuLateral;
            } ?>
        </ul>
    </div>
    <div id="contenido">
        <center><h1>Mis Reportes</h1></center>
        <form action="" method="POST" id="formulario">
            <fieldset>
                <legend>Utilidad del dia</legend>
                <div id="bloque_centrado">
                    <table>
                        <tbody>
                            <tr>
                                <td>Ventas</td>
                                <td><?php echo $totalVenta; ?></td>
                            </tr>
                            <tr>
                                <td>Costo de Ventas</td>
                                <td><?php echo $costoVenta; ?></td>
                            </tr>
                            <tr>
                                <td>Utilidad Bruta</td>
                                <td><?php echo $utilidadBruta; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>