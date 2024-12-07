<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'autorController.php');

$object = new autorController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $id_autor = $_POST['id_autor'];
    $descrip_autor = $_POST['descrip_autor']; // Change 'nombre_autor' to 'descrip_autor'

    // Validate inputs
    if (empty($id_autor) || !is_numeric($id_autor)) {
        echo "ID de autor no válido.";
        exit;
    }

    if (empty($descrip_autor)) { // Ensure the field name matches the form input
        echo "La descripción del autor es requerida.";
        exit;
    }

    // Call the update method
    $result = $object->update($id_autor, $descrip_autor); // Use 'descrip_autor' instead of 'nombre_autor'
    if ($result) {
        echo "Autor actualizado con éxito.";
        // Redirect back to the autor page after update
        header("Location: /lp3final/bibliochida/view/autor/");
        exit;
    } else {
        echo "Error al actualizar el autor.";
    }
}
