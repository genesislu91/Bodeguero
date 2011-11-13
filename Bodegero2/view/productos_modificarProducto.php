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
                         <p>   <label for="categoria">Categoria </label><select name="categoria">
                                <?php foreach($listaCategoria as $c){ ?>
                                    <?php if( $c==ProductoLogic::getCategoriaProducto($producto->getProductoId())){ ?>
                                <option value="<?php echo $c->getCategoriaId();?>" selected="selected"><?php echo $c->getNombre();?></option>
                                <?php }else{?>
                                 <option value="<?php echo $c->getCategoriaId();?>" ><?php echo $c->getNombre();?></option>
                                <option></option>
                                <?php }?>
                                <?php }?>

                             </select>
                         </p><p> <input type="submit" value="verMarcas" /></p>
                         <p>   <label for="categoria">Categoria </label><select name="categoria">
                                <?php foreach($listaCategoria as $c){ ?>
                                    <?php if( $c==ProductoLogic::getCategoriaProducto($producto->getProductoId())){ ?>
                                <option value="<?php echo $c->getCategoriaId();?>" selected="selected"><?php echo $c->getNombre();?></option>
                                <?php }else{?>
                                 <option value="<?php echo $c->getCategoriaId();?>" ><?php echo $c->getNombre();?></option>
                                <option></option>
                                <?php }?>
                                <?php }?>

                             </select>
                         </p>


                        
                    <input type="submit" value="Modificar Producto"/>
                </div>
            </fieldset>
            </form>
        
    </div>
</div>
<!-- ####################################################################################################### -->
<?php require_once 'u_pie_paginaForm.php'; ?>