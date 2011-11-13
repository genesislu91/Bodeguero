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
        <fieldset>
            <legend>Detalle de Compra</legend>
            <div id="bloque_centrado">
                <div id="bloque_izquierdo">
                    <p>Proveedor: <?php echo PersonaJuridicaLogic::buscarPersonaJuridicaPorId(ProveedorLogic::getProveedorPorId(CompraLogic::getCompraPorId($_GET['compra_id'])->getProveedorId())->getPersonaId())->getRazonSocial(); ?></p>
                </div>
                <div id="bloque_derecho">
                    <p>Fecha de Compra (año-mes-día): <?php echo CompraLogic::getCompraPorId($_GET['compra_id'])->getFechaCompra(); ?></p>
                </div>
            </div>
            <table>
                <caption>Detalle de Compra</caption>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Cantidad</th>
                        <th>Unidad de Medida</th>
                        <th>Precio de Lista Unitario (S/.)</th>
                        <th>Precio de Compra Unitario (S/.)</th>
                        <th>Sub Total (S/.)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detallesCompra as $detalleCompra): ?>
                        <tr>
                            <td><?php echo ProductoLogic::getProductoPorId($detalleCompra->getProductoId())->getNombre(); ?></td>
                            <td><?php echo CategoriaLogic::getCategoriaPorId((MarcaCategoriaLogic::buscarMarcasCategoriaPorId((ProductoLogic::getProductoPorId($detalleCompra->getProductoId())->getMarcaCategoriaId()))->getCategoria()))->getNombre(); ?></td>
                            <td><?php echo $detalleCompra->getCantidad(); ?></td>
                            <td><?php echo UnidadMedidaLogic::getUnidadMedidaPorId(ProductoLogic::getProductoPorId($detalleCompra->getProductoId())->getUnidadMedida())->getNombre(); ?></td>
                            <td><?php echo ProductoLogic::getProductoPorId($detalleCompra->getProductoId())->getPrecioCompra(); ?></td>
                            <td><?php echo $detalleCompra->getPrecioCompra(); ?></td>
                            <td><?php echo $detalleCompra->getSubTotal(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div id="bloque_izquierdo">
                <p>Total: <?php echo CompraLogic::getCompraPorId($_GET['compra_id'])->getMontoTotal(); ?> Soles</p>
                <a href="?opcion=ver_compras">Volver</a>
            </div>
        </fieldset>
    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>
