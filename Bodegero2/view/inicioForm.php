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
    </head>
    <body>
        <div id="encabezado">
            <p>Sistema de Gestión de Bodegas</p>
        </div>
        <div id="cuerpo">
            <div id="formularios">
                <form action="?opcion=ingresar" method="POST">
                    <fieldset>
                        <legend>Formulario de Inicio de Sesión</legend>
                        <label for="usuario">Usuario</label><input type="text" name="usuario"/><br/>
                        <label for="contrasenna">Contraseña</label><input type="password" name="contrasenna"/><br/>
                        <input type="submit" value="Iniciar Sesión"/>
                        <?php if($mensaje!=null){echo '<br/>'.$mensaje;}?>
                    </fieldset>
                </form>
                <form action="" method="POST">
                    <fieldset>
                        <legend>Formulario de Registro</legend>
                        <p>¿No tiene una cuenta todavía?</p>
                        <a href="?opcion=registrarse" >Registrarse</a>
                    </fieldset>
                </form>
            </div>
        </div>
       
    </body>
</html>
<?php require_once 'u_pie_paginaForm.php'; ?>
