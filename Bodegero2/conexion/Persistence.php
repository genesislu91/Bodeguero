<?php
require_once 'BaseDeDatos.php';
require_once 'MySQL.php';
abstract class Persistence {
    private static function _conectarBD(){
        $cn = new BaseDeDatos(new MySQL());
        return $cn;
    }
    public static function consultar(SQL $sql,$tipo){
        $db = Persistence::_conectarBD();
        $respuesta = $db->ejecutar($sql,$tipo);
        return $respuesta;
    }
}
?>