<?php require_once 'u_encabezadoForm.php'; ?>
<div id="cuerpo">
    <div id="menu_lateral">
        <ul><?php foreach ($opcionesMenuLateral as $opcionMenuLateral) {
                echo $opcionMenuLateral;
            } ?></ul>
    </div>
    <div id="contenido">
        <center><h1>Mis Clientes</h1></center>
        <form action="?opcion=agregar" method="post" id="formRegistrarCliente">
            <fieldset>
                <legend>Registrar Cliente</legend>
                <div id="bloque_centrado">
                    <p>Tipo de Cliente: <select id="tipoCliente" name="tipoCliente" onchange="javascript:cambiar()">
                            <option value="0">Persona Natural</option>
                            <option value="1">Persona Juridica</option>
                        </select></p>
                    <label for="nombre" id="lblNombre">Nombre: </label><input type="text" id="nombre" name="nombre"/><p></p>
                    <label for="apellidoP" id="lblApellidoP">Apellido Paterno: </label><input type="text" id="apellidoP" name="apellidoP"/><p></p>
                    <label for="apellidoM" id="lblApellidoM">Apellido Materno: </label><input type="text" id="apellidoM" name="apellidoM"/><p></p>
                    <label for="documento" id="lblDocumento">DNI: </label><input type="text" id="documento" name="documento"/><p></p>
                    <label for="direccion">Direcci&oacute;n: </label><input type="text" id="direccion" name="direccion"/><p></p>
                    <label for="telefono">Telefono: </label><input type="text" id="telefono" name="telefono"/><p></p>
                    <label for="correo">Correo Electr&oacute;nico: </label><input type="text" id="correo" name="correo"/><p></p>
                    <input type="button" value="Agregar Cliente" onclick="validar()"/>
                    <script language="javascript">
                        function cambiar(){
                            if(document.getElementById("tipoCliente").selectedIndex == 0){
                                document.getElementById("nombre").value = '';
                                document.getElementById("lblApellidoP").style.display  = "inline";
                                document.getElementById("lblApellidoM").style.display  = "inline";
                                document.getElementById("apellidoP").style.display  = "inline";
                                document.getElementById("apellidoM").style.display  = "inline";
                                document.getElementById("lblNombre").innerHTML = 'Nombre: ';
                                document.getElementById("lblDocumento").innerHTML = 'DNI: ';
                            }else{
                                document.getElementById("nombre").value = '';
                                document.getElementById("lblApellidoP").style.display  = "none";
                                document.getElementById("lblApellidoM").style.display  = "none";
                                document.getElementById("apellidoP").style.display  = "none";
                                document.getElementById("apellidoM").style.display  = "none";
                                document.getElementById("lblNombre").innerHTML = 'Razon Social: ';
                                document.getElementById("lblDocumento").innerHTML = 'RUC: ';
                            }
                        }
                        function validar(){
                            var contador = 0;
                            if(document.getElementById("nombre").value == ''){
                                contador = contador + 1;
                            }
                            if(document.getElementById("direccion").value == ''){
                                contador++;
                            }
                            if(document.getElementById("direccion").value == ''){
                                contador++;
                            }

                            if(document.getElementById("telefono").value == ''){
                                contador++;
                            }
                            if(document.getElementById("correo").value == ''){
                                contador++;
                            }
                            var cant = 11;
                            if(document.getElementById("tipoCliente").selectedIndex == 0){
                                cant = 8;
                                if(document.getElementById("apellidoP").value == ''){
                                    contador++;
                                }
                                if(document.getElementById("apellidoM").value == ''){
                                    contador++;
                                }
                            }
                            if(document.getElementById("documento").value.length != cant){
                                contador++;
                            }else{
                                if(!/[0-9]/.test(document.getElementById("documento").value)){
                                    contador++;
                                }
                            }
                            if(contador == 0){
                                document.getElementById("formRegistrarCliente").submit();
                            }else{
                                alert("Error. Verifique los datos o complete todos los campos.");
                            }
                        }
                    </script>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<?php require_once 'u_pie_paginaForm.php'; ?>