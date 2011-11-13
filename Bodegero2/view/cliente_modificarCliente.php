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
        <center><h1>Mis Clientes</h1></center>
        <form action="?opcion=modificando" method="post" id="formulario">
            <fieldset>
                <legend>Modificar Cliente</legend>
                <div id="bloque_izquierdo">
                    <input type="hidden" name="id" value="<?php echo $cliente[0]->getClienteId(); ?>"/>
                    <p>Tipo de Cliente: <?php if ($cliente[0]->getTipo() == 1) {
                echo 'Persona Juridica'; ?>
                        </p><label for="nombre">Razon Social: </label><input type="text" name="nombre" value="<?php echo $cliente[1]->getRazonSocial(); ?>" /><p></p>
                        </p><label for="documento">Ruc: </label><input type="text" name="documento" value="<?php echo $cliente[1]->getRUC(); ?>" /><p></p>
                    <?php } else {
                        echo 'Persona Natural' . '</p>'; ?>
                        <label for="nombre">Nombre: </label><input type="text" name="nombre" value="<?php echo $cliente[1]->getNombre(); ?>" /><p></p>
                        <label for="apellidoP">Apellido Paterno: </label><input type="text" name="apellidoP" value="<?php echo $cliente[1]->getApellidoPaterno(); ?>"/><p></p>
                        <label for="apellidoM">Apellido Materno: </label><input type="text" name="apellidoM" value="<?php echo $cliente[1]->getApellidoMaterno(); ?>"/><p></p>
                        <label for="documento">DNI: </label><input type="text" name="documento" value="<?php echo $cliente[1]->getDni(); ?>"/><p></p>
                    <?php } ?>
                    <label for="direccion">Direcci&oacute;n: </label><input type="text" name="direccion" value="<?php echo $cliente[1]->getDireccion(); ?>"/><br></br>
                    <label for="telefono">Telefono: </label><input type="text" name="telefono" value="<?php echo $cliente[1]->getTelefono(); ?>"/><br></br>
                    <label for="correo">Correo Electr&oacute;nico: </label><input type="text" name="correo" value="<?php echo $cliente[1]->getCorreoElectronico(); ?>"/><br></br>
                    <p>Fecha de Registro <?php echo $cliente[0]->getFechaRegistro(); ?></p>
                    <input type="submit" value="Modificar Cliente"/>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>