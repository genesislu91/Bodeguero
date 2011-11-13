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
                    <td><input type="text" name="marca"/><input type="submit" name="boton" value="agregar"/></td>
                </tr>
            </table>

            <?php if ($listaSubCategoria != null) {
                $i = 0; ?>
                <table>
                    <thead>
                        <tr>
                            <th>Marcas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listaSubCategoria as $c) { ?>
                            <tr>
                                <td><?php echo $c ?></td>
                                <td><a href="?opcion=ingresarCategoria&boton=eliminar&marca=<?php echo $i; ?>">Eliminar</a></td>
                                <?php $i++; ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
            <input type="submit" value="Agregar categoria" />
        </form>
    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>