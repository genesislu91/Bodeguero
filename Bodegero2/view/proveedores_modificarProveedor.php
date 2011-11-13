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
                <legend>Modificar Proveedor</legend>
                <div id="bloque_izquierdo">
                    <label for="empresa">Empresa:</label> <input type="text" name="" /><br/>
                    <label for="ruc">Ruc:</label> <input type="text" name="" /><br/>
                    <label for="direccion">Dirección:</label> <input type="text" name="" /><br/>
                    <label for="telefono">Telefono:</label> <input type="text" name="" /><br/>
                    <label for="correo">Correo Electrónico:</label> <input type="text" name=""><br/>
                    <label for="estado">Estado:</label> <select name="estado">
                        <option selected value="none">Ninguno</option>                                
                        <option value="einactivo">Activo</option>
                        <option value="eactivo">Inactivo</option>                                
                    </select>
                    <br/>						
                    <input type="submit" name="" value="Guardar Cambios" /><br/>						
                </div>	
            </fieldset>	
        </form>	
    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>