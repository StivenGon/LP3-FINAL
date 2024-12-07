<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'librosController.php');

// Create an instance of the controller
$controller = new librosController();

// Check if the required form fields are set and not empty
if (isset($_POST['titulo'], $_POST['id_autor'], $_POST['id_idioma'], $_POST['id_editorial'], $_POST['estado']) &&
    !empty($_POST['titulo']) && !empty($_POST['id_autor']) && !empty($_POST['id_idioma']) && 
    !empty($_POST['id_editorial']) && isset($_POST['estado'])) {

    // Collect the form data
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'] ?? null; // Optional field
    $isbn = $_POST['isbn_libro'] ?? null; // Optional field
    $cantidad_disponible = $_POST['cantidad_disponible'] ?? 0; // Default to 0 if not set
    $anho_publicacion = $_POST['anho_publicacion'] ?? null; // Optional field
    $estado = $_POST['estado'];
    $id_editorial = $_POST['id_editorial'];
    $id_idioma = $_POST['id_idioma'];
    $id_autor = $_POST['id_autor'];

    // Insert the book data using the controller method
    $registro = $controller->insertar(
        $titulo,
        $descripcion,
        $isbn,
        $cantidad_disponible,
        $anho_publicacion,
        $estado,
        $id_idioma,
        $id_editorial,
        $id_autor
    );

    if ($registro) {
        // Successful insert, redirect to the books list with success message
        echo "<script>alert('Libro registrado con éxito');</script>";
        header('Location: /lp3final/bibliochida/view/libros/');
        exit();
    } else {
        // Error during insert, display an error message
        echo "<script>alert('Error al registrar el libro');</script>";
    }

} else {
    // If any required field is missing or empty
    echo "<script>alert('Por favor complete todos los campos requeridos');</script>";
}
?>
