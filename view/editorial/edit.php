<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'editorialController.php');
$object = new editorialController();
$id_editorial = $_GET['id_editorial']; // Fetch the editorial ID from the URL
$editorial = $object->buscarPorId($id_editorial); // Fetch the editorial details by id_editorial

// Check if the editorial exists, if not show an error or redirect
if (!$editorial) {
    echo "Editorial no encontrado.";
    exit; // Stop execution if no editorial is found
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando Editorial</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>

<body>
    <?php
    require_once(VIEW_PATH . '/navbar/navbar.php');
    ?>
    <div class="container">
        <div class="mb-3">
            <h2>Editando Editorial</h2>
        </div>
        <form id="formEditorial" action="update.php" method="post" class="g-3 needs-validation" novalidate>
            <!-- ID Editorial (hidden input) -->
            <input value="<?= htmlspecialchars($editorial['id_editorial']) ?>" type="hidden" id="id_editorial" name="id_editorial">

            <!-- Descripción Editorial -->
            <div class="mb-3">
                <label for="descrip_editorial" class="form-label">Descripción Editorial</label>
                <input value="<?= htmlspecialchars($editorial['descrip_editorial']) ?>" 
                       type="text" 
                       class="form-control" 
                       id="descrip_editorial" 
                       name="descrip_editorial" 
                       required>
                <div class="invalid-feedback">Ingrese una descripción válida</div>
            </div>

            <!-- País Editorial -->
            <div class="mb-3">
                <label for="pais_editorial" class="form-label">País Editorial</label>
                <input value="<?= htmlspecialchars($editorial['pais_editorial']) ?>" 
                       type="text" 
                       class="form-control" 
                       id="pais_editorial" 
                       name="pais_editorial" 
                       required>
                <div class="invalid-feedback">Ingrese un país válido</div>
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
    </script>
</body>

</html>
