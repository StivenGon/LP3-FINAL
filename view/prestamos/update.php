<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header('location: ../usuario/login.php');
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/controller/prestamosController.php');
$controller = new PrestamosController();

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect data from the form
    $id_prestamo = $_POST['id_prestamo']; // Loan ID
    $estado = $_POST['estado']; // Estado (Devuelto/Activo)
    
    // Update the loan (prestamo) record
    $prestamoUpdated = $controller->actualizar($id_prestamo, $estado);

    if ($prestamoUpdated) {
        echo "<script>alert('Prestamo actualizado exitosamente');</script>";
        header('Location: /lp3final/bibliochida/view/prestamos/');
        exit();
    } else {
        echo "<script>alert('Error al actualizar el prestamo');</script>";
    }
} else {
    // If the form was not submitted via POST, redirect to the listado page
    header('Location: listado.php');
    exit();
}
?>
