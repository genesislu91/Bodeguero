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
        <form method="POST" action="?opcion=editarCategoria">
            <table width="100%">
                <tr><td>Nombre de Categoria:</td> <td> <?php if ($listaCategoria != null) { ?>
                            <select name="categoria">
                                <?php foreach ($listaCategoria as $categoria) { ?>
                                    <option value="<?php echo $categoria->getCategoriaId(); ?>"><?php echo $categoria->getNombre(); ?></option>
                                <?php } ?></select></td></tr>

                    <tr><td colspan="2"><input type="submit" name="boton" value="modificar"/></td></tr>
                    <?php if ($categoria != null) { ?>
                        <tr>
                            <td>Nombre:</td>
                            <td><input type="text" value="<?php echo $categoria->getNombre(); ?>" name="nombre" /></td>

                        </tr>
                        <tr>
                            <td>Descripcion:</td>
                            <td><input type="text" value="<?php echo $categoria->getDescripcion(); ?>" name="descripcion" /></td>

                        </tr>
                        <tr>
                            <td>Subcategoria</td>
                            <td><input type="text" value="" name="marca" /><input type="submit" name="boton" value="agregar" /></td>

                        </tr>
                        <?php if ($marcas != null) { ?>
                            <tr><td colspan="2"> Subcategorias</td></tr>
                            <?php foreach ($marcas as $m) { ?>
                                <tr>
                                    <td><?php echo $m->getNombre(); ?></td>
                                    <td><a href="#">eliminar</a></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                <tr><td colspan="2">
                        <input type="submit" value="Modificar categoria" /></td></tr>
            </table>

    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>
