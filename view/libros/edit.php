<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header('location: ../usuario/login.php');
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/controller/librosController.php');
$controller = new librosController();
$autores = $controller->getAutores(); // Fetch authors list
$idiomas = $controller->getIdiomas(); // Fetch languages list
$editoriales = $controller->getEditoriales(); // Fetch publishers list

// Fetching book details based on 'id_libro'
if (isset($_GET['id_libro'])) {
    $libro = $controller->getLibroById($_GET['id_libro']); // Make sure this includes 'descrip' for autor, idioma, editorial
} else {
    header('location: listado.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h2>Editar Libro</h2>
        <form method="POST" action="update.php">
            <input type="hidden" name="id_libro" value="<?= $libro['id_libro']; ?>">

            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $libro['titulo']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?= $libro['descripcion']; ?>">
            </div>

            <div class="mb-3">
                <label for="isbn_libro" class="form-label">ISBN:</label>
                <input type="text" class="form-control" id="isbn_libro" name="isbn_libro" value="<?= $libro['isbn_libro']; ?>">
            </div>

            <div class="mb-3">
                <label for="cantidad_disponible" class="form-label">Cantidad Disponible:</label>
                <input type="number" class="form-control" id="cantidad_disponible" name="cantidad_disponible" value="<?= $libro['cantidad_disponible']; ?>">
            </div>

            <div class="mb-3">
                <label for="anho_publicacion" class="form-label">Año de Publicación:</label>
                <input type="number" class="form-control" id="anho_publicacion" name="anho_publicacion" value="<?= $libro['anho_publicacion']; ?>">
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <select class="form-select" id="estado" name="estado">
                    <option value="1" <?= $libro['estado'] == 1 ? 'selected' : ''; ?>>Disponible</option>
                    <option value="0" <?= $libro['estado'] == 0 ? 'selected' : ''; ?>>No Disponible</option>
                </select>
            </div>

            <!-- Idioma Section (Modal Trigger) -->
            <div class="mb-3">
                <label for="id_idioma_text" class="form-label">Idioma:</label>
                <input type="text" class="form-control" id="id_idioma_text" name="id_idioma_text" value="<?= $libro['descrip_idioma']; ?>" readonly>
                <button type="button" class="btn btn-secondary mt-2" data-bs-toggle="modal" data-bs-target="#idiomaModal">Seleccionar Idioma</button>
                <input type="hidden" id="id_idioma" name="id_idioma" value="<?= $libro['id_idioma']; ?>">
            </div>

            <!-- Editorial Section (Modal Trigger) -->
            <div class="mb-3">
                <label for="id_editorial_text" class="form-label">Editorial:</label>
                <input type="text" class="form-control" id="id_editorial_text" name="id_editorial_text" value="<?= $libro['descrip_editorial']; ?>" readonly>
                <button type="button" class="btn btn-secondary mt-2" data-bs-toggle="modal" data-bs-target="#editorialModal">Seleccionar Editorial</button>
                <input type="hidden" id="id_editorial" name="id_editorial" value="<?= $libro['id_editorial']; ?>">
            </div>

            <!-- Autor Section (Modal Trigger) -->
            <div class="mb-3">
                <label for="id_autor_text" class="form-label">Autor:</label>
                <input type="text" class="form-control" id="id_autor_text" name="id_autor_text" value="<?= $libro['descrip_autor']; ?>" readonly>
                <button type="button" class="btn btn-secondary mt-2" data-bs-toggle="modal" data-bs-target="#autorModal">Seleccionar Autor</button>
                <input type="hidden" id="id_autor" name="id_autor" value="<?= $libro['id_autor']; ?>">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Actualizar Libro</button>
            </div>
        </form>
    </div>

    <!-- Modal for Idioma -->
    <div class="modal fade" id="idiomaModal" tabindex="-1" aria-labelledby="idiomaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="idiomaModalLabel">Seleccionar Idioma</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <?php foreach ($idiomas as $idioma) { ?>
                            <li class="list-group-item" style="cursor:pointer" onclick="setIdioma(<?= $idioma['id_idioma']; ?>, '<?= $idioma['descrip_idioma']; ?>')">
                                <?= $idioma['descrip_idioma']; ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editorial -->
    <div class="modal fade" id="editorialModal" tabindex="-1" aria-labelledby="editorialModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editorialModalLabel">Seleccionar Editorial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <?php foreach ($editoriales as $editorial) { ?>
                            <li class="list-group-item" style="cursor:pointer" onclick="setEditorial(<?= $editorial['id_editorial']; ?>, '<?= $editorial['descrip_editorial']; ?>')">
                                <?= $editorial['descrip_editorial']; ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Autor -->
    <div class="modal fade" id="autorModal" tabindex="-1" aria-labelledby="autorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="autorModalLabel">Seleccionar Autor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <?php foreach ($autores as $autor) { ?>
                            <li class="list-group-item" style="cursor:pointer" onclick="setAutor(<?= $autor['id_autor']; ?>, '<?= $autor['descrip_autor']; ?>')">
                                <?= $autor['descrip_autor']; ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script>
        // Functions to set selected value and close the modal
        function setIdioma(id, descripcion) {
            document.getElementById('id_idioma').value = id;
            document.getElementById('id_idioma_text').value = descripcion;
            // Close the modal
            $('#idiomaModal').modal('hide');
        }

        function setEditorial(id, descripcion) {
            document.getElementById('id_editorial').value = id;
            document.getElementById('id_editorial_text').value = descripcion;
            // Close the modal
            $('#editorialModal').modal('hide');
        }

        function setAutor(id, descripcion) {
            document.getElementById('id_autor').value = id;
            document.getElementById('id_autor_text').value = descripcion;
            // Close the modal
            $('#autorModal').modal('hide');
        }
    </script>

</body>

</html>