<?php
require_once '../model/UnidadMedida.php';
abstract class UnidadMedidaLogic {
    public static function getAll(){
        $unidadMedida = new UnidadMedida();
        return $unidadMedida->listar();
   }
    public static function getUnidadMedidaPorId($id) {
        $unidadesMedida = self::getAll();
        foreach ($unidadesMedida as $unidadMedida) {
            if ($unidadMedida->getUnidadMedidaId() == $id) {
                return $unidadMedida;
            }
        }
        return null;
    }
}
?>
