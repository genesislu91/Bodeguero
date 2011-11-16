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
        <fieldset>
            <legend>Marcas</legend>
            <?php if ($marcas !=null){ ?>
            <table id="bloque_centrado">
                <tr>
                    <th>Nombre</th>
                </tr>
                <?php foreach ($marcas as $m){ ?>
                <tr>
                    <td><?php echo $m->getNombre(); ?></td>
                </tr>
                <?php } ?>
            </table>
            <?php } ?>
        </fieldset>
    <fieldset>
            <legend>Registrar Marca</legend>
        <form method="POST" action="?opcion=ingresarMarca">
            <table width="100%">
                <tr>
                    <td colspan="2"><h1>Ingresar Marca</h1></td>
                </tr>
                <tr>
                    <td >Nombre de Marca:</td>
                    <td><input type="text" id="nombre" name="nombre" /></td>
                </tr>
                <tr>
                    <td ><input type="submit" name="boton" value="Agregar Marca" /></td>
                    <td ><input type="reset" name="boton" value="limpiar" /></td>
                </tr>
            </table>
            
        </form>
    </fieldset>
    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>