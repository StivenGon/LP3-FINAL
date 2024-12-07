<?php
// Include the libroController
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'librosController.php');

// Instantiate the libroController
$object = new librosController();

// Fetch all books
$libros = $object->select(); // Assuming you are fetching the books here

if (!empty($libros)) {
    foreach ($libros as $row) {
?>
    <div class="modal fade" id="idver<?=$row['id_libro']?>" tabindex="-1" aria-labelledby="VistaModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="VistaModal">Vista Completa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card" style="width: 28rem;">
                        <form action="update_libro.php" method="POST">
                            <input type="hidden" name="id" value="<?=$row['id_libro']?>"> <!-- Hidden input for id -->

                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" value="<?=$row['titulo']?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="autor" class="form-label">Autor</label>
                                <input type="text" class="form-control" id="autor" name="autor" value="<?=$row['autor']?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="año_publicacion" class="form-label">Año de Publicación</label>
                                <input type="number" class="form-control" id="año_publicacion" name="año_publicacion" value="<?=$row['año_publicacion']?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="genero" class="form-label">Género</label>
                                <input type="text" class="form-control" id="genero" name="genero" value="<?=$row['genero']?>" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php
    }
} else {
    echo "<p>No books found.</p>";  // Display message if no books are found
}
?>
