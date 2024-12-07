<?php
// delete.php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'idiomaController.php');

$object = new idiomaController(); // Instantiate the idiomaController

// Check if the 'id_idioma' is present in the request (GET or POST)
if (isset($_GET['id_idioma']) && !empty($_GET['id_idioma'])) {
    $id_idioma = $_GET['id_idioma']; // Get the ID of the idioma to delete

    // Call the delete method in the controller to delete the idioma
    $deleteResult = $object->delete($id_idioma);

    if ($deleteResult) {
        // Redirect to the idioma list page after successful deletion
        header('Location: index.php'); 
        exit;
    } else {
        // If deletion fails, display an error message
        echo "Error: No se pudo eliminar el idioma.";
    }
} else {
    // If 'id_idioma' is not set, redirect back to the idioma list page
    header('Location: index.php');
    exit;
}
?>
