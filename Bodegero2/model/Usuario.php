<?php
require_once '../conexion/SQL.php';
require_once '../conexion/Persistence.php';
require_once '../interface/InterfaceModels.php';
class Usuario implements InterfaceModels{
    private $_usuarioId;
    private $_nombreUsuario;
    private $_contrasenia;
    private $_fechaRegistro;
    private $_personaId;
    public function __construct($_usuarioId="",$_nombreUsuario="",$_contrasenia="",$_fechaRegistro="",$_personaId=""){
        $this->_usuarioId = $_usuarioId;
        $this->_nombreUsuario = $_nombreUsuario;
        $this->_contrasenia = $_contrasenia;
        $this->_fechaRegistro = $_fechaRegistro;
        $this->_personaId = $_personaId;
    }
    public function getUsuarioId(){
        return $this->_usuarioId;
    }
    public function getNombreUsuario(){
        return $this->_nombreUsuario;
    }
    public function getContrasenia(){
        return $this->_contrasenia;
    }
    public function getFechaRegistro(){
        return $this->_fechaRegistro;
    }
    public function getPersonaId(){
        return $this->_personaId;
    }
    public function traerDatos(){
        $sql = new SQL();
        $sql->addTable('usuario');
        $sql->addTipo('consultar');
        $usuarios = Persistence::consultar($sql, 1);
        return $usuarios;
    }
    public function listar(){
        $usuarios = $this->traerDatos();
        $lista = array();
        foreach($usuarios as $us){
            $_usuarioId = $us['usuarioId'];
            $_nombreUsuario = $us['nombreUsuario'];
            $_contrasenia = $us['contrasenia'];
            $_fechaRegistro= $us['fechaRegistro'];
            $_personaId=$us['personaJuridicaId'];
            $usuario = new Usuario($_usuarioId, $_nombreUsuario, $_contrasenia, $_fechaRegistro, $_personaId);
            $lista[] = $usuario;
        }
        return $lista;
    }

   public function insertar(){
        $sql = new SQL();
        $sql->addTable("usuario (usuarioId,nombreUsuario,contrasenia , fechaRegistro, 	personaJuridicaId)");
        $sql->addTipo('insertar');
        $sql->addValues($this->_usuarioId);
        $sql->addValues($this->_nombreUsuario);
        $sql->addValues($this->_contrasenia);
        $sql->addValues($this->_fechaRegistro);
        $sql->addValues($this->_personaId);
        Persistence::consultar($sql, 0);
    }
    public function actualizar(){}
}
?>