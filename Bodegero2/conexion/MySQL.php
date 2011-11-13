<?php
require_once '../interface/ManejadorBaseDeDatosInterface.php';
class MySQL implements ManejadorBaseDeDatosInterface{
    const USUARIO = 'root';
    const CLAVE = '';
    const BASE = 'bodeguero';
    const SERVIDOR = 'localhost';
    private $_conexion;
    public function conectar(){
        $this->_conexion = mysql_connect(self::SERVIDOR, self::USUARIO, self::CLAVE);
        mysql_select_db(self::BASE, $this->_conexion);
    }

    public function desconectar(){
        mysql_close($this->_conexion);
    }

    public function traerDatos(SQL $sql,$tipo){
           try{
            $rs = mysql_query($sql,$this->_conexion);
            if(mysql_errno($this->_conexion) != 0){
                throw new Exception(mysql_error($this->_conexion));
            }
            if ($tipo == 1) {
                $lista = array();
                while ($row = mysql_fetch_assoc($rs)){
                    $lista[] = $row;
                }
                return $lista;
            }else {
                return mysql_insert_id();
            }
       }catch(Exception $e){
           throw $e;
       }
    }
}
?>