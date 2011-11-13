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
        <form action="" method="POST" id="formulario">
            <fieldset>
                <legend>Ver Proveedores</legend>
                <div id="bloque_izquierdo">
                    <input type="radio" name="verp" /><label for="activos">Activos:</label> <br/>
                    <input type="radio" name="verp" /><label for="inactivos">Inactivos:</label> <br/>
                    <input type="radio" name="verp" /><label for="todos">Todos:</label> <br/>
                    <input type="radio" name="verp" /><label for="nombre">Por Nombre:</label> <input type="text name="nombreproveedor" /><br/>
                    <br/>			
                </div>	

                <div class="bloque_derecho_boton">

                    <input type="submit" name="" value="Ver" /><br/>		
                </div>

                <div id="bloque_centrado">
                    <table border="1">					
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Empresa</th>
                                <th>Dirección</th>
                                <th>Ruc</th>
                                <th>Telefono</th>
                                <th>Correo Electrónico</th>
                            </tr>
                        </thead>
                        <tbody>		
                            <tr>
                                <td>001</td>
                                <td>Edgar</td>
                                <td>Manrique</td>
                                <td>Lima</td>
                                <td>4567876455</td>
                                <td>maklo@hotmail.com</td>
                            </tr>							
                            <tr>
                                <td>001</td>
                                <td>Edgar</td>
                                <td>Manrique</td>
                                <td>Lima</td>
                                <td>4567876455</td>
                                <td>maklo@hotmail.com</td>
                            </tr>							
                            <tr>
                                <td>001</td>
                                <td>Edgar</td>
                                <td>Manrique</td>
                                <td>Lima</td>
                                <td>4567876455</td>
                                <td>maklo@hotmail.com</td>
                            </tr>							
                            <tr>
                                <td>001</td>
                                <td>Edgar</td>
                                <td>Manrique</td>
                                <td>Lima</td>
                                <td>4567876455</td>
                                <td>maklo@hotmail.com</td>
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