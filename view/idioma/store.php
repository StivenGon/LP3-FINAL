<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'idiomaController.php');

// Create an instance of the controller
$object = new idiomaController();

// Check if the form fields are set and not empty
if (isset($_POST['descrip_idioma'], $_POST['iso_idioma'])) {
    $descrip_idioma = trim($_POST['descrip_idioma']);
    $iso_idioma = trim($_POST['iso_idioma']);

    // Validate that neither of the fields are empty after trimming
    if (!empty($descrip_idioma) && !empty($iso_idioma)) {
        // Insert the data using the controller method
        $registro = $object->insertar($descrip_idioma, $iso_idioma);

        if ($registro) {
            // Successful insert, redirect first
            header('Location: /lp3final/bibliochida/view/idioma/');
            exit();
        } else {
            // Error during insert, send failure message
            echo "<script>alert('Error al registrar el idioma');</script>";
        }
    } else {
        // If any required field is missing or empty
        echo "<script>alert('Por favor complete todos los campos');</script>";
    }
} else {
    // If the POST data is not set correctly
    echo "<script>alert('Por favor complete todos los campos');</script>";
}
?>
