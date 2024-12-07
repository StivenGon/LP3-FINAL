<?php
// delete.php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'clienteController.php');

$object = new clienteController();

// Check if the 'id_cliente' is present in the request (GET or POST)
if (isset($_GET['id_cliente']) && !empty($_GET['id_cliente'])) {
    $id_cliente = $_GET['id_cliente'];

    // Call the delete method in the controller to delete the client
    $deleteResult = $object->delete($id_cliente);

    if ($deleteResult) {
        // Redirect to the client list page after successful deletion
        header('Location: index.php'); 
        exit;
    } else {
        // If deletion fails, display an error message
        echo "Error: No se pudo eliminar el cliente.";
    }
} else {
    // If 'id_cliente' is not set, redirect back to the client list page
    header('Location: index.php');
    exit;
}
?>
