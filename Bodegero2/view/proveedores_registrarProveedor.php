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

        <form action="?opcion=ingresarProveedor" method="POST" id="formulario">
            <fieldset>
                <legend>Registrar Proveedor</legend>
                    <?php if($mensaje == null){
                        $mensaje == null;}
                        else {
                            echo $mensaje;}
                    ?>

                <div id="bloque_izquierdo">
                    <label for="empresa">Empresa:</label> <input type="text" name="empresa" /><br/>
                    <label for="ruc">Ruc:</label> <input type="text" name="ruc" /><br/>
                    <label for="direccion">Dirección:</label> <input type="text" name="direccion" /><br/>
                    <label for="telefono">Telefono:</label> <input type="text" name="telefono" /><br/>
                    <label for="correo">Correo Electrónico:</label> <input type="text" name="correo" /><br/>
                    <br/>
                    <input type="submit" value="Agregar Proveedor" />
                    <input type="reset" value="Limpiar Campos" />
                    <br/>
                </div>
            </fieldset>
        </form>

    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>