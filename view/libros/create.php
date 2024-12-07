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
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Libro</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>

<body>
    <?php
    require_once(VIEW_PATH . 'navbar/navbar.php');
    ?>
    <div class="container">
        <h2>Crear Nuevo Libro</h2>
        <form method="POST" action="store.php">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion">
            </div>

            <div class="mb-3">
                <label for="isbn_libro" class="form-label">ISBN:</label>
                <input type="text" class="form-control" id="isbn_libro" name="isbn_libro">
            </div>

            <div class="mb-3">
                <label for="cantidad_disponible" class="form-label">Cantidad Disponible:</label>
                <input type="number" class="form-control" id="cantidad_disponible" name="cantidad_disponible">
            </div>

            <div class="mb-3">
                <label for="anho_publicacion" class="form-label">Año de Publicación:</label>
                <input type="number" class="form-control" id="anho_publicacion" name="anho_publicacion">
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <select class="form-select" id="estado" name="estado">
                    <option value="1">Disponible</option>
                    <option value="0">No Disponible</option>
                </select>
            </div>

            <!-- Idioma Section -->
            <div class="mb-3">
                <label for="id_idioma_text" class="form-label">Idioma:</label>
                <input type="text" class="form-control" id="id_idioma_text" name="id_idioma_text" readonly>
                <button type="button" class="btn btn-secondary mt-2" id="selectIdiomaBtn">Seleccionar Idioma</button>
                <input type="hidden" id="id_idioma" name="id_idioma">
            </div>

            <!-- Editorial Section -->
            <div class="mb-3">
                <label for="id_editorial_text" class="form-label">Editorial:</label>
                <input type="text" class="form-control" id="id_editorial_text" name="id_editorial_text" readonly>
                <button type="button" class="btn btn-secondary mt-2" id="selectEditorialBtn">Seleccionar Editorial</button>
                <input type="hidden" id="id_editorial" name="id_editorial">
            </div>

            <!-- Autor Section -->
            <div class="mb-3">
                <label for="id_autor_text" class="form-label">Autor:</label>
                <input type="text" class="form-control" id="id_autor_text" name="id_autor_text" readonly>
                <button type="button" class="btn btn-secondary mt-2" id="selectAutorBtn">Seleccionar Autor</button>
                <input type="hidden" id="id_autor" name="id_autor">
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <!-- Modals -->
    <?php
    function generateModal($id, $title, $items, $dataAttr, $textAttr)
    {
        echo <<<HTML
        <div id="{$id}" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Seleccionar {$title}</h5>
                        <button type="button" class="btn-close" onclick="closeModal('{$id}')"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
HTML;
        foreach ($items as $item) {
            echo <<<HTML
                            <li class="list-group-item">
                                <a href="#" class="select-item" data-id="{$item[$dataAttr]}" data-descrip="{$item[$textAttr]}" data-target="{$id}">
                                    {$item[$textAttr]}
                                </a>
                            </li>
HTML;
        }
        echo <<<HTML
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal('{$id}')">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
HTML;
    }

    generateModal('autorModal', 'Autor', $autores, 'id_autor', 'descrip_autor');
    generateModal('idiomaModal', 'Idioma', $idiomas, 'id_idioma', 'descrip_idioma');
    generateModal('editorialModal', 'Editorial', $editoriales, 'id_editorial', 'descrip_editorial');
    ?>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/jquery.min.js"></script>
    <script>
        // Show modal for selecting items
        document.getElementById('selectAutorBtn').addEventListener('click', function() {
            document.getElementById('autorModal').style.display = 'block';
        });

        document.getElementById('selectIdiomaBtn').addEventListener('click', function() {
            document.getElementById('idiomaModal').style.display = 'block';
        });

        document.getElementById('selectEditorialBtn').addEventListener('click', function() {
            document.getElementById('editorialModal').style.display = 'block';
        });

        // Close modal
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Handle selecting an item (Autor, Idioma, Editorial)
        document.querySelectorAll('.select-item').forEach(function(item) {
            item.addEventListener('click', function(event) {
                event.preventDefault();

                const id = this.getAttribute('data-id');
                const descrip = this.getAttribute('data-descrip');
                const target = this.getAttribute('data-target');

                const inputId = target.replace('Modal', '');
                document.getElementById(`id_${inputId}`).value = id;
                document.getElementById(`id_${inputId}_text`).value = descrip;

                closeModal(target);
            });
        });
    </script>
</body>

</html>