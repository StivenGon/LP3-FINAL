<?php
// delete.php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'editorialController.php');

$object = new editorialController();

// Check if the 'id_editorial' is present in the request (GET or POST)
if (isset($_GET['id_editorial']) && !empty($_GET['id_editorial'])) {
    $id_editorial = $_GET['id_editorial'];

    // Call the delete method in the controller to delete the editorial
    $deleteResult = $object->delete($id_editorial);

    if ($deleteResult) {
        // Redirect to the editorial list page after successful deletion
        header('Location: index.php'); 
        exit;
    } else {
        // If deletion fails, display an error message
        echo "Error: No se pudo eliminar la editorial.";
    }
} else {
    // If 'id_editorial' is not set, redirect back to the editorial list page
    header('Location: index.php');
    exit;
}
?>
