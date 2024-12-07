<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'editorialController.php');

// Create an instance of the controller
$object = new editorialController();

// Check if the form is submitted and process the data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect the form data
    $id_editorial = $_POST['id_editorial']; // The editorial ID from the form
    $descrip_editorial = $_POST['descrip_editorial']; // Correct field name
    $pais_editorial = $_POST['pais_editorial']; // Correct field name

    // Update the editorial using the controller
    $updateResult = $object->update($id_editorial, $descrip_editorial, $pais_editorial);

    if ($updateResult) {
        // Alert and redirect back to the editorial list page after update
        echo "<script>alert('Editorial actualizado exitosamente');</script>";
        header('Location: /lp3final/bibliochida/view/editorial/');
        exit(); // Always call exit after header redirection
    } else {
        echo "<script>alert('Error al actualizar la editorial');</script>";
    }
}
?>
