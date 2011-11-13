<!DOCTYPE html>
<html>
    <head>
        <title>Sistema de Gestión de Bodegas</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="../styles/usuario.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="encabezado">
            <div id="logotipo">
                <p>Sistema de Gestión de Bodegas</p>
            </div>
            <div id="notificaciones">
                <p>Bienvenido,<?php require_once '../logic/UsuarioLogic.php';$usuario=$_SESSION['usuario'];echo UsuarioLogic::obtenerUsuarioPorId($usuario)->getNombreUsuario(); ?><br/>
                    <a href="#">Tienes X notificaciones nuevas.</a><br/>
                    <a href="UsuarioView.php?opcion=cerrarSesion">Cerrar Sesion</a>
                </p>
            </div>
            <div id="menu_navegacion">
                <ul>
                    <li><a href="UsuarioView.php?opcion=informacion">Mi Información</a></li>
                    <li><a href="ProductosView.php">Productos</a></li>
                    <li><a href="ProveedoresView.php">Proveedores</a></li>
                    <li><a href="ClienteView.php">Clientes</a></li>
                    <li><a href="VentasView.php">Ventas</a></li>
                    <li><a href="ComprasView.php">Compras</a></li>
                    <li><a href="ReportesView.php">Reportes</a></li>
                </ul>
            </div>
        </div>