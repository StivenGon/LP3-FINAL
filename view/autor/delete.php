<?php
// delete.php for autor
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'autorController.php'); // Adjusted to use autorController

$object = new autorController(); // Adjusted to use autorController

// Check if the 'id_autor' is present in the request (GET or POST)
if (isset($_GET['id_autor']) && !empty($_GET['id_autor'])) {
    $id_autor = $_GET['id_autor'];

    // Call the delete method in the controller to delete the autor
    $deleteResult = $object->delete($id_autor); // Adjusted to call the delete method of autorController

    if ($deleteResult) {
        // Redirect to the autor list page after successful deletion
        header('Location: index.php'); 
        exit;
    } else {
        // If deletion fails, display an error message
        echo "Error: No se pudo eliminar el autor.";
    }
} else {
    // If 'id_autor' is not set, redirect back to the autor list page
    header('Location: index.php'); 
    exit;
}
