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
                <center><h1>Mi Informacion</h1></center>
				<form action="" method="POST" id="formulario">
                                    <label for="empresa">Empresa:</label>    <input name="empresa" type="text" disabled="true" value="<?php echo $pj->getRazonSocial(); ?>" readonly/><br/>
                                    <label for="correo">Correo Electronico:</label>	<input name="correo" disabled="true" type="text" value="<?php echo $pj->getCorreoElectronico(); ?>" readonly/><br/>
						<label for="direccion">Direccion:</label>	<input name="direccion" disabled="true" type="text" value="<?php echo $pj->getDireccion(); ?>" readonly/><br/>
						<label for="ruc">RUC:</label><input name="ruc" type="text" disabled="true" value="<?php echo $pj->getRuc(); ?>" readonly/><br/>
						<label for="telefono">Telefono:</label>	<input name="telefono" type="text"  disabled="true" value="<?php echo $pj->getTelefono(); ?>" readonly/><br/>
				</form>
            </div>            
        </div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>