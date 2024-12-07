<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header('location: ../usuario/login.php');
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'generoController.php');
$object = new generoController();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <title>Agregando Género</title>
</head>

<body>
    <?php
    require_once(VIEW_PATH . 'navbar/navbar.php');
    ?>
    <div class="container">
        <div class="mb-3">
            <h2>Agregando nuevo género</h2>
        </div>
        <form id="formGenero" action="store.php" method="post" class="g-3 needs-validation" novalidate>
            <div class="mb-3">
                <label for="descrip_genero" class="form-label">Descripción del Género</label>
                <input type="text" class="form-control" id="descrip_genero" name="descrip_genero" required>
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
    document.getElementById('formGenero').addEventListener('submit', function (event) {
        const descripGenero = document.getElementById('descrip_genero').value.trim();

        if (!descripGenero) {
            event.preventDefault();
        }
    });
</script>

</html>
