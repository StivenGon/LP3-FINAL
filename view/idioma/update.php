<?php
// Include necessary files
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'idiomaController.php');

// Create an instance of idiomaController
$controller = new idiomaController();

// Process POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize input data
    $id_idioma = filter_input(INPUT_POST, 'id_idioma', FILTER_VALIDATE_INT);
    $descrip_idioma = filter_input(INPUT_POST, 'descrip_idioma', FILTER_SANITIZE_STRING);
    $iso_idioma = filter_input(INPUT_POST, 'iso_idioma', FILTER_SANITIZE_STRING);

    // Validate that all fields are present
    if (!$id_idioma || !$descrip_idioma || !$iso_idioma) {
        echo "<script>alert('Todos los campos son obligatorios.');</script>";
        header("Location: edit.php?id_idioma=$id_idioma");
        exit;
    }

    // Update idioma via the controller
    $updated = $controller->update($id_idioma, $descrip_idioma, $iso_idioma);

    if ($updated) {
        // Redirect to the idioma list with success message
        echo "<script>alert('Idioma actualizado exitosamente.');</script>";
        header('Location: /lp3final/bibliochida/view/idioma/');
        exit;
    } else {
        // Handle update failure
        echo "<script>alert('Error al actualizar el idioma. Intente nuevamente.');</script>";
        header("Location: edit.php?id_idioma=$id_idioma");
        exit;
    }
} else {
    // Redirect to idiomas list if accessed directly
    header('Location: /lp3final/bibliochida/view/idioma/');
    exit;
}
