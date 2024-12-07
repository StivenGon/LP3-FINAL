<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'autorController.php');

$object = new autorController();
$id_autor = $_GET['id_autor']; // Get the id_autor from the URL

// Validate that the id_autor is a valid number
if (!isset($id_autor) || !is_numeric($id_autor)) {
    echo "ID de autor no válido.";
    exit;
}

// Fetch the autor details
$autor = $object->search($id_autor);

// Check if autor is found and is an array
if (!$autor || !is_array($autor)) {
    echo "Autor no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando Autor</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <?php require_once(VIEW_PATH . '/navbar/navbar.php'); ?>
    <div class="container">
        <div class="mb-3">
            <h2>Editando Autor</h2>
        </div>
        <form id="formAutor" action="update.php" method="post" class="g-3 needs-validation" novalidate>
            <!-- ID Autor (hidden input) -->
            <input value="<?= htmlspecialchars($autor['id_autor'], ENT_QUOTES, 'UTF-8') ?>" type="hidden" id="id_autor" name="id_autor">

            <!-- Descripción del Autor -->
            <div class="mb-3">
                <label for="descrip_autor" class="form-label">Descripción del Autor</label>
                <input 
                    value="<?= isset($autor['descrip_autor']) ? htmlspecialchars($autor['descrip_autor'], ENT_QUOTES, 'UTF-8') : '' ?>" 
                    type="text" 
                    class="form-control" 
                    id="descrip_autor" 
                    name="descrip_autor" 
                    required 
                    pattern="^[A-Za-záéíóúÁÉÍÓÚÑñ\s]+$" 
                    title="Solo se permiten letras y espacios.">
                <div class="invalid-feedback">Ingrese un autor válido</div>
                <div id="error-message" class="error-message" style="display:none;">Ingrese un autor válido</div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/jquery.min.js"></script>
    <script>
        // Custom Bootstrap validation initialization
        (function () {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();

        // Handle custom validation for only letters and spaces
        const descripAutorInput = document.getElementById('descrip_autor');
        const errorMessage = document.getElementById('error-message');

        descripAutorInput.addEventListener('input', function () {
            const regex = /^[A-Za-záéíóúÁÉÍÓÚÑñ\s]+$/;
            if (!regex.test(descripAutorInput.value)) {
                errorMessage.style.display = 'block';
            } else {
                errorMessage.style.display = 'none';
            }
        });
    </script>
</body>
</html>
