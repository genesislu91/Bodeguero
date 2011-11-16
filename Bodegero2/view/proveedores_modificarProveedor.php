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

        <form action="?opcion=modificarProveedor&id=<?php echo $pj->getPersonaId(); ?>" method="POST" id="formulario">
            <fieldset>
                <legend>Modificar Proveedor</legend>
                    <?php if($mensaje == null){
                        $mensaje == null;}
                        else {
                            echo $mensaje;}
                    ?>
                <div id="bloque_izquierdo">
                    <label for="empresa">Empresa:</label> <input type="text" name="" value="<?php echo $pj->getRazonSocial(); ?>" readonly/><br/>
                    <label for="ruc">Ruc:</label> <input type="text" name="" value="<?php echo $pj->getRuc(); ?>" readonly/><br/>
                    <label for="direccion">Dirección:</label> <input type="text" name="direccion" value="<?php echo $pj->getDireccion(); ?>" /><br/>
                    <label for="telefono">Telefono:</label> <input type="text" name="telefono" value="<?php echo $pj->getTelefono(); ?>" /><br/>
                    <label for="correo">Correo Electrónico:</label> <input type="text" name="correo" value="<?php echo $pj->getCorreoElectronico(); ?>" /><br/>
                    <br/>
                    <input type="submit" name="" value="Guardar Cambios" /><br/>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>