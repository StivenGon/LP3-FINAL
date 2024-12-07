<?php
class usuarioModel {
    private $PDO;

    public function __construct(){
        include_once ($_SERVER['DOCUMENT_ROOT'].'/lp3final/bibliochida/routes.php');
        require_once(DAO_PATH.'database.php');
        $data = new dataConex();
        $this->PDO = $data->conexion();
    }

    public function listar() {
        $sql = 'SELECT * FROM usuario ORDER BY id_usuario';
        $statement = $this->PDO->prepare($sql);
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }

    public function buscar($usuario) {
        $sql = 'SELECT * FROM usuario WHERE alias=:alias';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':alias',$usuario);
        return ($statement->execute()) ? $statement->fetch() : false;
    }

    public function insertar($alias,$clave,$idrol) {
        $clave = password_hash($clave, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO usuario VALUES (0,:alias,:clave,:idrol)';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':alias',$alias);
        $statement->bindParam(':clave',$clave);
        $statement->bindParam(':id_roles',$idrol);
        $statement->execute();
        return ($this->PDO->lastInsertId());
    }
}
?>
