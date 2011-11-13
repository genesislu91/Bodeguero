<?php require_once 'u_encabezadoForm.php'; ?>
<!-- ####################################################################################################### -->

        <div id="cuerpo">
            <div id="menu_lateral">
                <ul>
                    <?php
                    foreach ($opcionesMenuLateral as $opcionMenuLateral) {
                        echo $opcionMenuLateral; }
                    ?>                    
                </ul>
            </div>
            <div id="contenido">
                <center><h1>Modificar Mi Perfil</h1></center>
				<form action="?opcion=cambioPerfil" method="POST" id="formulario">                                  
						<label for="correo">Correo Electronico:</label>	<input name="correo" type="text" value="<?php echo $pj->getCorreoElectronico(); ?>" /><br/>
						<label for="direccion">Direccion:</label>	<input name="direccion" type="text" value="<?php echo $pj->getDireccion(); ?>" /><br/>
						<label for="empresa">Empresa:</label>    <input name="empresa" type="text" value="<?php echo $pj->getRazonSocial(); ?>" /><br/>
						<label for="ruc">RUC:</label><input name="ruc" type="text" value="<?php echo $pj->getRuc(); ?>" /><br/>
						<label for="telefono">Telefono:</label>	<input name="telefono" type="text" value="<?php echo $pj->getTelefono(); ?>" /><br/>						
						<label for="codigo">Codigo Imagen:</label>	<input name="codigoimagen" type="text" value="<?php ?>" /><br/>	
                                               
						<input type="submit" value="Guardar Cambios" />		
				</form>
            </div>
            
        </div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>