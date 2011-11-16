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
                <?php if($mensaje != null){
                    echo $mensaje;  } ?>
				<form  action="?opcion=cambioPerfil" method="POST" id="formulario">
                                  
                                    <label for="empresa">Empresa:</label>    <input name="empresa" type="text" disabled="true" value="<?php echo $pj->getRazonSocial(); ?>" /><br/>
						<label for="ruc">RUC:</label><input name="ruc" type="text"   disabled="true" value="<?php echo $pj->getRuc(); ?>" /><br/>
						<label for="correo">Correo Electronico:</label>	<input name="correo" type="text" value="<?php echo $pj->getCorreoElectronico(); ?>" /><br/>
						<label for="direccion">Direccion:</label>	<input name="direccion" type="text" value="<?php echo $pj->getDireccion(); ?>" /><br/>
						<label for="telefono">Telefono:</label>	<input name="telefono" type="text" value="<?php echo $pj->getTelefono(); ?>" /><br/>						
                                                <label for="code">Code</label><input type="text" name="code" id="codigo" size="50" /><br/>
                                                <div style="width: 430px; float: left; height: 90px">
                                                    <img alt="" id="siimage" align="left" style="padding-right: 5px; border: 0" src="../securimage/securimage_show.php?sid=<?php echo md5(time()) ?>" />
                                                    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" align="middle">
                                                        <param name="allowScriptAccess" value="sameDomain" />
                                                        <param name="allowFullScreen" value="false" />
                                                        <param name="movie" value="securimage_play.swf?audio=securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" />
                                                        <param name="quality" value="high" />
                                                        <param name="bgcolor" value="#ffffff" />
                                                        <embed src="../securimage/securimage_play.swf?audio=../securimage/securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" quality="high" bgcolor="#ffffff" width="19" height="19" name="SecurImage_as3" align="middle" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
                                                    </object>
                                                    <a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onClick="document.getElementById('siimage').src = '../securimage/securimage_show.php?sid=' + Math.random(); return false"><br/><img src="../securimage/images/refresh.gif" alt="Reload Image" border="0" onClick="this.blur()" align="bottom" /></a>
                                                </div></br>
                                                <p><input   type="submit" value="Guardar Cambios" /></p>
				</form>
            </div>
            
        </div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>