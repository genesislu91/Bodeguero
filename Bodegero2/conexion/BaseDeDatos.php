<?php
require_once 'SQL.php';
require_once '../interface/ManejadorBaseDeDatosInterface.php';
class BaseDeDatos {
    private $_manejador;
    public function __construct(ManejadorBaseDeDatosInterface $manejador) {
        $this->_manejador = $manejador;
    }
    public function ejecutar(SQL $sql,$tipo){
        $this->_manejador->conectar();
        $datos = $this->_manejador->traerDatos($sql,$tipo);
        $this->_manejador->desconectar();
        return $datos;

    }
}
?>