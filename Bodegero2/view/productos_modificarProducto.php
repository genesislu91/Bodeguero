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

            <form method="POST" action="?opcion=modificarProducto">
                <fieldset>
                <legend>Modificar Producto</legend>
                <div id="bloque_izquierdo">
                    <input type="hidden" name="id" value="<?php echo $producto->getProductoId(); ?>"/>
                       <p> <label for="nombre">Nombre: </label><input type="text" name="nombre" value="<?php echo $producto->getNombre(); ?>" /></p>
                         <p>   <label for="categoria">Categoria </label><select id="categoria" name="categoria">
                                <?php foreach($listaCategoria as $c){ ?>
                                    <?php if( $c->getCategoriaId()==$cat){ ?>
                                <option value="<?php echo $c->getCategoriaId();?>" selected="selected"><?php echo $c->getNombre();?></option>
                                <?php }else{?>
                                 <option value="<?php echo $c->getCategoriaId();?>" ><?php echo $c->getNombre();?></option>
                                <?php }?>
                                <?php }?>

                             </select> <input id="bloque_derecho" name="boton" type="submit" value="Ver Marcas" /></p>
                         <p>   <label for="marca">Marca </label><select name="marca" id="marcas">
                                 <?php foreach ($marcas as $m) { ?>
                                  <?php if( $m[0]== $mc){ ?>
                                 <option  selected="selected" value="<?php echo $m[0]; ?>"><?php echo $m[1]->getNombre(); ?></option>
                                <?php } else{ ?>
                                    <option value="<?php echo $m[0]; ?>"><?php echo $m[1]->getNombre(); ?></option>
                                    <?php }}?>
                             </select>
                         </p>
                         <p>
                             <label for="proveedor">Proveedores</label>
                             <select name="proveedor" id="proveedor">
                                 <?php  foreach ($proveedores as $pro) { ?>
                                 
                                  <?php if( $pro[0]->getProveedorId()== $p){ ?>
                                 <option  selected="selected" value="<?php echo $pro[0]->getProveedorId(); ?>"><?php echo $pro[1]->getRazonSocial(); ?></option>
                                <?php } else{ ?>
                                  <option  value="<?php echo $pro[0]->getProveedorId(); ?>"><?php echo $pro[1]->getRazonSocial(); ?></option>
                                    <?php }}?>
                             </select>
                         </p>
                         <p><label for="descripcion">Descripcion</label><input type="text" name="descripcion" id="descripcion" value="<?php echo $producto->getDescripcion(); ?>"/>
                         </p>
                         <p><label for="unidadMedida">Unidad de Medida</label><select name="unidadMedida" id="unidadMedida">
                                 <?php  foreach ($ums as $um) { ?>

                                  <?php if( $um->getUnidadMedidaId() == $u){ ?>
                                 <option  selected="selected" value="<?php echo $um->getUnidadMedidaId(); ?>"><?php echo $um->getNombre(); ?></option>
                                <?php } else{ ?>
                                 <option   value="<?php echo $um->getUnidadMedidaId() ?>"><?php echo $um->getNombre(); ?></option>
                                    <?php }}?>
                             </select></p>

                        <p><label for="precioCompra">Precio Compra</label><input type="text" name="precioCompra" id="precioCompra" value="<?php echo $producto->getPrecioCompra(); ?>"/>
                         </p>
                       <p><label for="precioVenta">Precio Venta</label><input type="text" name="precioVenta" id="precioVenta" value="<?php echo $producto->getPrecioVenta(); ?>"/>
                         </p>
                             <input type="submit" name="boton" value="Modificar Producto"/>
                </div>
            </fieldset>
            </form>

    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>