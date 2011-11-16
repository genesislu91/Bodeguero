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
        <center><h1>Mis Proveedores</h1></center>
        <form action="?opcion=buscarProveedor" method="POST" id="formulario">
            <fieldset>
                <legend>Ver Proveedores</legend>
                <div id="bloque_izquierdo">
                    <p>Buscar por: <select id="tipoBusqueda" name="busqueda">
                            <option value="1">RUC</option>
                            <option value="2">Nombre</option>
                            <option value="3">Todos</option>
                        </select> <input type="text" name="campo"/> <br/>
                </div>

                <div class="bloque_derecho_boton">
                    <input type="submit"  value="Ver" /><br/>
                </div>

                <div id="bloque_centrado">
                   <?php if ($filtro != null ) {?>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Razon Social/Nombre</th>
                                <th>Dirección</th>
                                <th>Ruc</th>
                                <th>Telefono</th>
                                <th>Correo Electrónico</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach($filtro as $fil) { ?>
                            <tr>
                                <td><?php echo $fil[0]->getProveedorId(); ?></td>
                                <td><?php echo $fil[1]->getRazonSocial(); ?></td>
                                <td><?php echo $fil[1]->getDireccion(); ?></td>
                                <td><?php echo $fil[1]->getRuc(); ?></td>
                                <td><?php echo $fil[1]->getTelefono(); ?></td>
                                <td><?php echo $fil[1]->getCorreoElectronico(); ?></td>
                                <td><a href="?opcion=modificar_proveedor&id=<?php echo $fil[1]->getPersonaId(); ?>">Modificar Datos</a></td>
                            </tr>
                           <?php } ?>
                        </tbody>
                    </table>
                    <?php } ?>
                </div>


            </fieldset>
        </form>




    </div>

</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>