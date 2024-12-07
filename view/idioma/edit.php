<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'idiomaController.php');

$object = new idiomaController();
$id_idioma = $_GET['id_idioma']; // Get the id_idioma from the URL

// Validate that the id_idioma is a valid number
if (!isset($id_idioma) || !is_numeric($id_idioma)) {
    echo "ID del idioma no válido.";
    exit;
}

// Fetch the idioma details
$idioma = $object->search($id_idioma);

// Check if idioma is found and is an array
if (!$idioma || !is_array($idioma)) {
    echo "Idioma no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando Idioma</title>
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
            <h2>Editando Idioma</h2>
        </div>
        <form id="formIdioma" action="update.php" method="post" class="g-3 needs-validation" novalidate>
            <!-- ID Idioma (hidden input) -->
            <input value="<?= htmlspecialchars($idioma['id_idioma'], ENT_QUOTES, 'UTF-8') ?>" type="hidden" id="id_idioma" name="id_idioma">

            <!-- Nombre del Idioma -->
            <div class="mb-3">
                <label for="descrip_idioma" class="form-label">Nombre del Idioma</label>
                <input 
                    value="<?= isset($idioma['descrip_idioma']) ? htmlspecialchars($idioma['descrip_idioma'], ENT_QUOTES, 'UTF-8') : '' ?>" 
                    type="text" 
                    class="form-control" 
                    id="descrip_idioma" 
                    name="descrip_idioma" 
                    required 
                    pattern="^[A-Za-záéíóúÁÉÍÓÚÑñ\s]+$" 
                    title="Solo se permiten letras y espacios.">
                <div class="invalid-feedback">Ingrese un idioma válido</div>
                <div id="error-message-descrip" class="error-message" style="display:none;">Ingrese un idioma válido</div>
            </div>

            <!-- Código del Idioma -->
            <div class="mb-3">
                <label for="iso_idioma" class="form-label">Código ISO</label>
                <input 
                    value="<?= isset($idioma['iso_idioma']) ? htmlspecialchars($idioma['iso_idioma'], ENT_QUOTES, 'UTF-8') : '' ?>" 
                    type="text" 
                    class="form-control" 
                    id="iso_idioma" 
                    name="iso_idioma" 
                    required 
                    pattern="^[A-Za-z0-9]+$" 
                    title="Solo se permiten letras y números.">
                <div class="invalid-feedback">Ingrese un código válido</div>
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

        // Handle custom validation for "Nombre del Idioma"
        const descripIdiomaInput = document.getElementById('descrip_idioma');
        const errorMessageDescrip = document.getElementById('error-message-descrip');

        descripIdiomaInput.addEventListener('input', function () {
            const regex = /^[A-Za-záéíóúÁÉÍÓÚÑñ\s]+$/;
            if (!regex.test(descripIdiomaInput.value)) {
                errorMessageDescrip.style.display = 'block';
            } else {
                errorMessageDescrip.style.display = 'none';
            }
        });
    </script>
</body>
</html>
