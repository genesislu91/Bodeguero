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
                                <?php foreach ($listaCategoria as $cat) { ?>
                                    <option value="<?php echo $cat->getCategoriaId(); ?>"><?php echo $cat->getNombre(); ?></option>
                                <?php } ?></select></td></tr>

                    <tr><td colspan="2"><input type="submit" name="boton" value="modificar"/></td></tr>
                    <?php if ($categoria != null) { ?>
                        <tr>
                            <td><input type="hidden" name="categoriaId" value="<?php echo $categoria->getCategoriaId(); ?>" >Nombre:</td>
                            <td><input type="text" value="<?php echo $categoria->getNombre(); ?>" name="nombre" /></td>

                        </tr>
                        <tr>
                            <td>Descripcion:</td>
                            <td><input type="text" value="<?php echo $categoria->getDescripcion(); ?>" name="descripcion" /></td>

                        </tr>
                        <tr>
                            <td>Subcategoria</td>
                            <td><select name="marca">
                            <?php foreach ($opcmarcas as $m){ ?>
                            <option value="<?php echo $m->getMarcaId();?>"><?php echo $m->getNombre();?></option>
                            <?php } ?>
                        </select><input type="submit" name="boton" value="agregar" /></td>

                        </tr>
                        <?php if ($marcas != null) { ?>
                            <tr><td colspan="2"> Subcategorias</td></tr>
                           <?php foreach ($marcas as $c) { ?>
                             <tr>
                                <td><?php echo $c->getNombre(); ?></td>
                                <td><a href="?opcion=editarCategoria&categoria=<?php echo $categoria->getCategoriaId(); ?>&boton=eliminar&marca=<?php echo $c->getMarcaId(); ?>">Eliminar</a></td>

                            </tr>
                        <?php } ?>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                <tr><td colspan="2">
                        <input type="submit" name="boton" value="Modificar categoria" /></td></tr>
            </table>

    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>
