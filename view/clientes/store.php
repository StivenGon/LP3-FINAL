<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'clienteController.php');

// Create an instance of the controller
$object = new clienteController();

// Check if the form fields are set and not empty
if (isset($_POST['nombre'], $_POST['telefono'], $_POST['correo']) &&
    !empty($_POST['nombre']) && !empty($_POST['telefono']) && !empty($_POST['correo'])) {

    // Collect the form data
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    // Insert the data using the controller method
    $registro = $object->insertar($nombre, $telefono, $correo);

    if ($registro) {
        // Successful insert, send success message
        echo "<script>alert('Registro exitoso');</script>";
        header('Location: /lp3final/bibliochida/view/clientes/');
        exit();
    } else {
        // Error during insert, send failure message
        echo "<script>alert('Error al registrar el cliente');</script>";
    }

} else {
    // If any field is missing or empty
    echo "<script>alert('Por favor complete todos los campos');</script>";
}
