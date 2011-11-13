<?php

class SQL {
    private $_tipo;
    private $_colWhere = array();
    private $_colSelect = array('*');
    private $_colFrom = array();
    private $_colvalues=array();

    public function addTable($table){
        $this->_colFrom[] = $table;
    }
    public function addTipo($tipo){
        $this->_tipo = $tipo;
    }

    public function addWhere ($where){
        $this->_colWhere[] = $where;
    }
    public function addValues ($values){
        $this->_colvalues[] = $values;
    }

    public function _generar(){
        $select = implode(',', array_unique($this->_colSelect)); 
        $from = implode(',', array_unique($this->_colFrom));
        $where = implode(' AND ', array_unique($this->_colWhere));
        $values = implode("','", $this->_colvalues);
        switch ($this->_tipo) {
            case 'consultar':
                if($where != null){
                    return 'SELECT '.$select.' FROM '.$from.' WHERE '.$where;
                }else{
                    return 'SELECT '.$select.' FROM '.$from;
                }
            case 'insertar':
                 return 'INSERT INTO '.$from." VALUES( '".$values."' )";
            case 'eliminar':
                 return 'DELETE FROM '.$from.' WHERE '.$where;
            case 'actualizar':
                $values = implode(",", $this->_colvalues);
                 return 'UPDATE '.$from.' SET '.$values.' WHERE '.$where;
            default:
                break;
        }
    }
    public function __toString(){
        return $this->_generar($this->_tipo);
    }
}
?>