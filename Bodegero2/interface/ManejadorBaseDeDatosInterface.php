<?php
interface ManejadorBaseDeDatosInterface {
    public function conectar();
    public function traerDatos(SQL $sql,$tipo);
    public function desconectar();

}
?>