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
                <legend>Productos m&aacute;s Vendidos</legend>
                <div id="bloque_izquierdo">
                    <input type="radio" name="" /><label for="empresa">Semana:</label> <br/>
                    <input type="radio" name="" /><label for="ruc">Mes:</label> <br/>
                    <input type="radio" name="" /><label for="direccion">D�a:</label> <br/>
                </div>
                <div id="bloque_derecho_boton">					
                    <input type="submit" name="" value="Ver" />
                </div>
                <div id="bloque_centrado">		
                    <table border="1">					
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Proveedor</th>
                                <th>Categoria</th>
                                <th>Precio</th>	
                                <th>Unidad de Medida</th>										
                                <th>Descripci�n</th>	
                                <th>Cantidad Vendida</th>
                            </tr>
                        </thead>
                        <tbody>		
                            <tr>
                                <td>001</td>
                                <td>Edgar</td>
                                <td>Manrique</td>
                                <td>Lima</td>									
                                <td>Lima</td>	
                                <td>Lima</td>
                                <td>Lima</td>
                                <td>Lima</td>
                            </tr>							
                            <tr>
                                <td>001</td>
                                <td>Edgar</td>
                                <td>Manrique</td>
                                <td>Lima</td>
                                <td>Lima</td>
                                <td>Lima</td>
                                <td>Lima</td>
                                <td>Lima</td>
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