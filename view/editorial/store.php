<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'editorialController.php');

// Create an instance of the editorialController
$object = new editorialController();

// Check if the form fields are set and not empty
if (isset($_POST['descrip_editorial'], $_POST['pais_editorial']) &&
    !empty($_POST['descrip_editorial']) && !empty($_POST['pais_editorial'])) {

    // Collect the form data for editorial
    $descrip_editorial = $_POST['descrip_editorial'];
    $pais_editorial = $_POST['pais_editorial'];

    // Insert the editorial data using the controller method
    $registro = $object->insertar($descrip_editorial, $pais_editorial);

    if ($registro) {
        // Successful insert, send success message
        echo "<script>alert('Registro exitoso');</script>";
        header('Location: /lp3final/bibliochida/view/editorial/'); // Redirect to the editorial list page
        exit();
    } else {
        // Error during insert, send failure message
        echo "<script>alert('Error al registrar la editorial');</script>";
    }

} else {
    // If any field is missing or empty
    echo "<script>alert('Por favor complete todos los campos');</script>";
}
