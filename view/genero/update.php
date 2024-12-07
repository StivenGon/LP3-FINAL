<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'generoController.php');

// Create an instance of the controller
$object = new generoController();

// Check if the form is submitted and process the data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect the form data
    $id_genero = $_POST['id_genero']; // The genre ID from the form
    $descripcion = $_POST['descripcion'];

    // Update the genre using the controller
    $updateResult = $object->update($id_genero, $descripcion);

    if ($updateResult) {
        // Alert and redirect back to the genre list page after update
        echo "<script>alert('Género actualizado exitosamente');</script>";
        header('Location: /lp3final/bibliochida/view/genero/');
        exit(); // Always call exit after header redirection
    } else {
        echo "<script>alert('Error al actualizar el género');</script>";
    }
}
?>
