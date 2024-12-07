<?php
// delete.php for género
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'generoController.php');

$object = new generoController();

// Check if the 'id_genero' is present in the request (GET or POST)
if (isset($_GET['id_genero']) && !empty($_GET['id_genero'])) {
    $id_genero = $_GET['id_genero'];

    // Call the delete method in the controller to delete the género
    $deleteResult = $object->delete($id_genero);

    if ($deleteResult) {
        // Redirect to the género list page after successful deletion
        header('Location: index.php'); 
        exit;
    } else {
        // If deletion fails, display an error message
        echo "Error: No se pudo eliminar el género.";
    }
} else {
    // If 'id_genero' is not set, redirect back to the género list page
    header('Location: index.php'); 
    exit;
}
