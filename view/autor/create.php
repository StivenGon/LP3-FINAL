<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header('location: ../usuario/login.php');
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'autorController.php');
$object = new autorController(); // Adjusted for 'autor'
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <title>Agregando Autor</title>
</head>

<body>
    <?php
    require_once(VIEW_PATH . 'navbar/navbar.php');
    ?>
    <div class="container">
        <div class="mb-3">
            <h2>Agregando nuevo autor</h2>
        </div>
        <form id="formAutor" action="store.php" method="post" class="g-3 needs-validation" novalidate>
            <div class="mb-3">
                <label for="descrip_autor" class="form-label">Descripción del Autor</label>
                <input type="text" class="form-control" id="descrip_autor" name="descrip_autor" required>
                <div class="invalid-feedback">Ingrese una descripción válida!</div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg col-4">Guardar</button>
        </form>
    </div>
</body>

<script src="../../assets/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/validate.js"></script>

<script>
    // Front-end validation for custom rules
    document.getElementById('formAutor').addEventListener('submit', function (event) {
        const descripAutor = document.getElementById('descrip_autor').value.trim();

        if (!descripAutor) {
            event.preventDefault();
        }
    });
</script>

</html>
