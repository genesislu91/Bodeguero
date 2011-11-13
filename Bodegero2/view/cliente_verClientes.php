<?php require_once 'u_encabezadoForm.php'; ?>
<script language="javascript">
    function cambiar(){
        var option = document.getElementById("tipoBusqueda");
        if(document.getElementById("tipoCliente").selectedIndex == 0){
            option.innerHTML = '<option value="1">Nombre</option><option value="2">Apellido Paterno</option><option value="3">Apellido Materno</option><option value="4">DNI</option>';
        }else{
            option.innerHTML = '<option value="1">Razon Social</option><option value="2">RUC</option>';
        }
    }
    function submitBuscarCliente(){
        document.getElementById("formVerClientes").action = "?opcion=buscarTipo";
        document.getElementById("formVerClientes").submit();
    }
    function submitBuscarCampo(){
        document.getElementById("formVerClientes").action = "?opcion=buscarCampo";
        document.getElementById("formVerClientes").submit();
    }
</script>
<div id="cuerpo">
    <div id="menu_lateral">
        <ul><?php foreach($opcionesMenuLateral as $opcionMenuLateral){
                echo $opcionMenuLateral;
            }?></ul>
    </div>
    <div id="contenido">
        <center><h1>Mis Clientes</h1></center>
        <fieldset>
            <legend>Ver Clientes</legend>
            <div id="bloque_centrado">
                <form method="post" action="?opcion=buscarTipo" id="formVerClientes">
                    <p>Tipo de Cliente: <select id="tipoCliente" name="tipoCliente" onchange="cambiar()">
                        <option value="0">Persona Natural</option>
                        <option value="1">Persona Juridica</option>
                        </select>  <input type="button" value="Buscar" onclick="submitBuscarCliente()"/></p>
                    <p>Buscar por: <select id="tipoBusqueda" name="tipoBusqueda">
                        <option value="1">Nombre</option>
                        <option value="2">Apellido Paterno</option>
                        <option value="3">Apellido Materno</option>
                        <option value="4">DNI</option>
                        </select>  <input type="text" name="campo"/>  <input type="button" value="Buscar" onclick="submitBuscarCampo()"/></p>
                </form>
                <table width="100%">
                    <tr>
                        <th>Nombre y Apellidos/Razon Social</th>
                        <th>DNI/RUC</th>
                        <th>Direcci&oacute;n</th>
                        <th>Telefono</th>
                        <th>Correo Electr&oacute;nico</th>
                        <th>Fecha de Registro</th>
                        <th>Acciones</th>
                    </tr>
                    <?php foreach($clientes as $cliente){ ?>
                        <tr>
                            <td><?php
                                if($cliente[0]->getTipo() == 1){
                                    echo $cliente[1]->getRazonSocial();
                                }else{
                                    echo $cliente[1]->getNombre().' '.$cliente[1]->getApellidoPaterno().' '. $cliente[1]->getApellidoMaterno();
                                }?></td>
                            <td><?php
                                if ($cliente[0]->getTipo() == 1) {
                                    echo $cliente[1]->getRuc();
                                } else {
                                    echo $cliente[1]->getDni();
                                }?></td>
                            <td><?php echo $cliente[1]->getDireccion(); ?></td>
                            <td><?php echo $cliente[1]->getTelefono(); ?></td>
                            <td><?php echo $cliente[1]->getCorreoElectronico(); ?></td>
                            <td><?php echo $cliente[0]->getFechaRegistro(); ?></td>
                            <td><a href="?opcion=modificar&id=<?php echo $cliente[0]->getClienteId(); ?>">Modificar</a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </fieldset>
    </div>
</div>
<?php require_once 'u_pie_paginaForm.php'; ?>