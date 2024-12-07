<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'prestamosController.php');

// Create an instance of the controller
$controller = new PrestamosController();

try {
    // Validate that required fields are set and not empty
    if (isset($_POST['id_cliente'], $_POST['id_libro'], $_POST['id_usuario'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['estado']) &&
        !empty($_POST['id_cliente']) && !empty($_POST['id_libro']) && !empty($_POST['id_usuario']) && 
        !empty($_POST['fecha_inicio']) && !empty($_POST['fecha_fin']) && isset($_POST['estado'])) {

        // Collect and sanitize data
        $id_cliente = intval($_POST['id_cliente']);
        $id_libro = intval($_POST['id_libro']);
        $id_usuario = intval($_POST['id_usuario']);
        $fecha_prestamo = $_POST['fecha_inicio'];
        $fecha_devolucion = $_POST['fecha_fin'];
        $estado = intval($_POST['estado']);

        // Call the controller method to insert the new prestamo
        $prestamoId = $controller->insertar($id_cliente, $id_libro, $id_usuario, $fecha_prestamo, $fecha_devolucion, $estado);

        if ($prestamoId) {
            // Redirect or show success message
            header('Location: /lp3final/bibliochida/view/prestamos/');
            exit();
        } else {
            // Handle the error (for example, show a message on the form)
            echo "Error al guardar el préstamo.";
        }

    } else {
        // Handle missing or empty form fields
        echo "Todos los campos son obligatorios.";
    }
} catch (Exception $e) {
    // Handle exceptions (e.g., database errors)
    echo "Error: " . $e->getMessage();
}
?>
