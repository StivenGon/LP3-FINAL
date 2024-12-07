<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'generoController.php');
$object = new generoController();
$id_genero = $_GET['id_genero']; // Fetch the genre ID from the URL
$genero = $object->search($id_genero); // Fetch the genre details by id_genero

// Check if the genre exists and is an array
if (!$genero || !is_array($genero) || empty($genero)) {
    echo "Género no encontrado.";
    exit; // Stop execution if no genre is found
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando Género</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>

<body>
    <?php
    require_once(VIEW_PATH . '/navbar/navbar.php');
    ?>
    <div class="container">
        <div class="mb-3">
            <h2>Editando Género</h2>
        </div>
        <form id="formGenero" action="update.php" method="post" class="g-3 needs-validation" novalidate>
            <!-- ID Género (hidden input) -->
            <input value="<?= htmlspecialchars($genero[0]['id_genero']) ?>" type="hidden" id="id_genero" name="id_genero">

            <!-- Descripción -->
            <div class="mb-3">
                <label for="descrip_genero" class="form-label">Descripción del Género</label>
                <input value="<?= htmlspecialchars($genero[0]['descrip_genero']) ?>" 
                       type="text" 
                       class="form-control" 
                       id="descrip_genero" 
                       name="descripcion"  
                       required 
                       pattern="[A-Za-z\s]+" 
                       title="Solo se permiten letras y espacios.">
                <div class="invalid-feedback">Ingrese solo letras y espacios.</div>
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
