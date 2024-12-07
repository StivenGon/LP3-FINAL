<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : null;
$clave = (isset($_POST['clave'])) ? $_POST['clave'] : null;

include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'usuarioController.php');
$object = new usuarioController();
$resultado = $object->search($usuario);

if ($resultado) {
    $data = $resultado;
    $idUsuario = $resultado['id_usuario'];
    $usuario = $resultado['alias'];
    $hash = $resultado['clave'];

    if (password_verify($clave, $hash)) {
        $_SESSION["id_usuario"] = $idUsuario;
        $_SESSION["usuario"] = $usuario;
    } else {
        $_SESSION["id_usuario"] = null;
        $_SESSION["usuario"] = null;
        $data = null;
    }
} else {
    $_SESSION["id_usuario"] = null;
    $_SESSION["usuario"] = null;
    $data = null;
}
print json_encode($data);
exit();
?>