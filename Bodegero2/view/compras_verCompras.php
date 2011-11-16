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
        <h1>Mis Compras</h1>
        <form id="formulario" action="" method="POST">
            <fieldset>
                <legend>Búsqueda</legend>
                <div id="bloque_centrado">
                    <div id="bloque_izquierdo">
                        <input type="radio" name="busqueda" value="por_proveedor" id="proveedor"/><label for="proveedor">Por Proveedor</label><br/>
                    </div>
                    <div id="bloque_derecho">
                        <select name="proveedor">
                            <option selected value="ninguno">Proveedor</option>
                            <?php foreach ($proveedores as $proveedor): ?>
                                <option value="<?php echo $proveedor[0]->getProveedorId() ?>"><?php echo $proveedor[1]->getRazonSocial();; ?></option>
                            <?php endforeach ?>
                        </select><br/>
                    </div>
                </div>
                <div id="bloque_centrado">
                    <div id="bloque_izquierdo">
                        <input type="radio" name="busqueda" value="por_fecha" id="fecha"/><label for="fecha">Por Fecha</label><br/>
                    </div>
                    <div id="bloque_derecho">
                        <label for="calendario">Fecha</label><input id="calendario" type="date" name="fecha" value="Año-Mes-Día"/><br/>
                    </div>
                </div>
                <div id="bloque_centrado">
                    <input type="submit" value="Buscar"/><br/>
                </div>
            </fieldset>
        </form>
        <table>
            <caption>Resultado de la Búsqueda</caption>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Monto Total (S/.)</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($compras as $compra): ?>
                    <tr>
                        <td><?php echo $compra[0]->getFechaCompra(); ?></td>
                        <td><?php echo $compra[1]->getRazonSocial(); ?></td>
                        <td><?php echo $compra[0]->getMontoTotal(); ?></td>
                        <td><a href="ComprasView.php?opcion=ver_detalle_compra&compra_id=<?php echo $compra[0]->getCompraId(); ?>">Ver Detalle</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>