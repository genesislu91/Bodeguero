<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <title>Sistema de Gestión de Bodegas</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="../styles/inicio.css" rel="stylesheet" type="text/css" />
        <script>
        function validar(){
            if(document.getElementById("razonSocial").value ==""){
                alert("Debe ingresar la razon Social de su bodega");
            }else if(document.getElementById("ruc").value=="" || document.getElementById("ruc").value.length!=11 ){
                alert("Debe ingresar un ruc valido" );
            }else if (/[0-9]/.test(document.getElementById("ruc").value) == false ){
                alert("El ruc: " + document.getElementById("ruc").value + " es incorrecto.");
            }
            else if(document.getElementById("email").value==""){
                alert("Debe ingresar su correo electronico");
            }
            else if(/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i.test(document.getElementById("email").value) == false ){
                alert("El email: " + document.getElementById("email").value + " es incorrecto.");
            }
            else if(document.getElementById("contrasena").value==""){
                alert("Debe ingresar su contraseña");
            }else if(document.getElementById("contrasena").value != document.getElementById("contrasena2").value){
                alert("Las contraseñas no coinciden");
            }else if(document.getElementById("direccion").value ==""){
                alert("Debe ingresar su direccion");
            }
            else if(document.getElementById("usuario").value ==""){
                alert("Debe ingresar su usuario");
            }
            else if(document.getElementById("codigo").value.length==0){
                    alert("Debe ingresar el codigo de la imagen");
            }else{
                document.getElementById("formRegistrar").submit();
            }
        }
    </script>
    </head>
    <body>
        <div id="encabezado">
            <p>Sistema de Gestión de Bodegas</p>
        </div>
        <div id="cuerpo">
            <div id="contenido">
                <h1>Registra tu Empresa</h1>
                <form method="POST" action="?opcion=registrar" name="ventas" id="formRegistrar">
                    <table id="bloque_centrado">
                        <tr>
                            <td colspan="4">Informacion de la Cuenta</td>
                        </tr>
                        <tr>
                            <td colspan="4"><?php if($mensaje != null){echo $mensaje;} ?></td>
                        </tr>
                        <tr>
                            <td>Empresa*</td>
                            <td colspan="3"><input name="razonSocial" type="text" id="razonSocial" size="50" /></td>
                        </tr>
                        <tr>
                            <td>Ruc*</td>
                            <td colspan="3"><input name="ruc" type="text" id="ruc" size="50" /></td>
                        </tr>
                         <tr>
                            <td>Correo Electr&oacute;nico*</td>
                            <td colspan="3"><input name="email" type="text" id="email" size="50" /></td>
                        </tr>
                        <tr>
                            <td>Nombre de Usuario*</td>
                            <td colspan="3"><input name="usuario" type="text" size="50" id="usuario" /></td>
                        </tr>
                        <tr>
                            <td>Contrase&ntilde;a*</td>
                            <td colspan="3"><input name="contrasena" id="contrasena" type="password" size="50" /></td>
                        </tr>
                        <tr>
                            <td>Repita la Contrase&ntilde;a*</td>
                            <td colspan="3"><input name="contrasena2" id="contrasena2" type="password" size="50" /></td>
                        </tr>
                        <tr>
                            <td>Direccion*</td>
                            <td colspan="3"><input name="direccion" type="text" id="direccion" size="50" /></td>
                        </tr>
                        <tr>
                            <td>Tel&eacute;fono</td>
                            <td colspan="3"><input name="telefono" type="text"  size="50" /></td>
                        </tr>
                        <tr>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><div style="width: 430px; float: left; height: 90px"> <img alt="" id="siimage" align="left" style="padding-right: 5px; border: 0" src="../securimage/securimage_show.php?sid=<?php echo md5(time()) ?>" />
                                    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" align="middle">
                                        <param name="allowScriptAccess" value="sameDomain" />
                                        <param name="allowFullScreen" value="false" />
                                        <param name="movie" value="securimage_play.swf?audio=securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" />
                                        <param name="quality" value="high" />
                                        <param name="bgcolor" value="#ffffff" />
                                        <embed src="../securimage/securimage_play.swf?audio=../securimage/securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" quality="high" bgcolor="#ffffff" width="19" height="19" name="SecurImage_as3" align="middle" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
                                    </object>
                                    <br />
                                    <!-- pass a session id to the query string of the script to prevent ie caching -->
                                    <a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onClick="document.getElementById('siimage').src = '../securimage/securimage_show.php?sid=' + Math.random(); return false"><img src="../securimage/images/refresh.gif" alt="Reload Image" border="0" onClick="this.blur()" align="bottom" /></a></div></td>
                            <td colspan="3"><div style="clear: both"></div>
                                Code:<br />
                                <!-- NOTE: the "name" attribute is "code" so that $img->check($_POST['code']) will check the submitted form field -->
                                <input type="text" name="code" id="codigo" size="50" />
                                <br />
                                <br /></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><input type="button" name="boton" value="registrar" onclick="validar()"/></td>
                            <td><input type="reset" value="Limpiar"/></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="4">*El llenado de este campo es obligatorio</td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div id="pie_pagina">
            <p>Sistema de Gestión de Bodegas</p>
        </div>
    </body>
</html>

