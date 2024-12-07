<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header('location: ../usuario/login.php');
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'editorialController.php');
$object = new editorialController();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <title>Agregando Editorial</title>
</head>

<body>
    <?php
    require_once(VIEW_PATH . 'navbar/navbar.php');
    ?>
    <div class="container">
        <div class="mb-3">
            <h2>Agregando nueva editorial</h2>
        </div>
        <form id="formEditorial" action="store.php" method="post" class="g-3 needs-validation" novalidate>
            <div class="mb-3">
                <label for="descrip_editorial" class="form-label">Descripción Editorial</label>
                <input type="text" class="form-control" id="descrip_editorial" name="descrip_editorial" autofocus required>
                <div class="invalid-feedback">Ingrese una descripción válida!</div>
            </div>
            <div class="mb-3">
                <label for="pais_editorial" class="form-label">País Editorial</label>
                <input type="text" class="form-control" id="pais_editorial" name="pais_editorial" required>
                <div class="invalid-feedback">Ingrese un país válido!</div>
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
    document.getElementById('formEditorial').addEventListener('submit', function (event) {
        const pais = document.getElementById('pais_editorial').value.trim();
        const descrip = document.getElementById('descrip_editorial').value.trim();

        if (!descrip) {
            event.preventDefault();
            //alert('El campo de descripción no puede estar vacío.');
        }

        if (!pais) {
            event.preventDefault();
            //alert('El campo de país no puede estar vacío.');
        }
    });
</script>

</html>
