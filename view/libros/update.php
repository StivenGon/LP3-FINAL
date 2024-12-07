<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'librosController.php');

// Create an instance of the controller
$object = new librosController();

// Check if the form is submitted and process the data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect the form data
    $id_libro = $_POST['id_libro']; // The book ID from the form
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $isbn_libro = $_POST['isbn_libro'];
    $cantidad_disponible = $_POST['cantidad_disponible'];
    $anho_publicacion = $_POST['anho_publicacion'];
    $estado = $_POST['estado'];
    
    // Collect the selected foreign key values
    $id_idioma = $_POST['id_idioma'];
    $id_editorial = $_POST['id_editorial'];
    $id_autor = $_POST['id_autor'];

    // Update the libro using the controller
    $updateResult = $object->updateLibro($id_libro, $titulo, $descripcion, $isbn_libro, $cantidad_disponible, $anho_publicacion, $estado, $id_idioma, $id_editorial, $id_autor);

    if ($updateResult) {
        // Alert and redirect back to the book list page after update
        echo "<script>alert('Libro actualizado exitosamente');</script>";
        header('Location: /lp3final/bibliochida/view/libros/');
        exit(); // Always call exit after header redirection
    } else {
        echo "<script>alert('Error al actualizar el libro');</script>";
    }
}
?>
