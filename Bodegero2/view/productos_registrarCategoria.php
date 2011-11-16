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
            <legend>Registrar Categoria</legend>
        <form method="POST" action="?opcion=ingresarCategoria">
            <table width="100%">
                <tr>
                    <td colspan="2"><h1>Ingresar Categoria</h1></td>
                </tr>
                <tr>
                    <td >Nombre de Categoria:</td>
                    <td><input type="text" id="nombre" name="nombre" /></td>
                </tr>
                <tr>
                    <td>Descripción</td>
                    <td><input type="text" id="descripcion" name="descripcion" /></td>
                </tr>
                <tr>
                    <td >Subcategorias:</td>
                    <td><select name="marca">
                            <?php foreach ($marcas as $m){ ?>
                            <option value="<?php echo $m->getMarcaId();?>"><?php echo $m->getNombre();?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" name="boton" value="agregar"/></td>
                </tr>
            </table>

            <?php if ($listaSubCategoria != null) {
                 ?>
            <table id="bloque_centrado">
                    <thead>
                        <tr>
                            <th >Marcas</th>
                             <th >Opción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listaSubCategoria as $c) { ?>
                            <tr>
                                <td><?php echo $c->getNombre(); ?></td>
                                <td><a href="?opcion=ingresarCategoria&boton=eliminar&marca=<?php echo $c->getMarcaId(); ?>">Eliminar</a></td>
                                
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
            <input type="submit" name="boton" value="Agregar categoria" />
        </form>
        </fieldset>
    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>