<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'generoController.php');

// Create an instance of the controller
$object = new generoController();

// Check if the form field 'descrip_genero' is set and not empty
if (isset($_POST['descrip_genero']) && !empty($_POST['descrip_genero'])) {

    // Collect the form data
    $descripcion = $_POST['descrip_genero'];

    // Insert the data using the controller method
    $registro = $object->insertar($descripcion);

    if ($registro) {
        // Successful insert, send success message
        echo "<script>alert('Registro exitoso');</script>";
        header('Location: /lp3final/bibliochida/view/genero/');
        exit();
    } else {
        // Error during insert, send failure message
        echo "<script>alert('Error al registrar el género');</script>";
    }

} else {
    // If the field is missing or empty
    echo "<script>alert('Por favor complete todos los campos');</script>";
}
