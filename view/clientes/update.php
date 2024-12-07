<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'clienteController.php');

// Create an instance of the controller
$object = new clienteController();

// Check if the form is submitted and process the data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect the form data
    $id_cliente = $_POST['id_cliente']; // The client ID from the form
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    // Update the client using the controller
    $updateResult = $object->update($id_cliente, $nombre, $telefono, $correo);

    if ($updateResult) {
        // Alert and redirect back to the client list page after update
        echo "<script>alert('Cliente actualizado exitosamente');</script>";
        header('Location: /lp3final/bibliochida/view/clientes/');
        exit(); // Always call exit after header redirection
    } else {
        echo "<script>alert('Error al actualizar el cliente');</script>";
    }
}
?>
