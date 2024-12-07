<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header('location: ../usuario/login.php');
    exit;
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'idiomaController.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <title>Agregando Idioma</title>
</head>

<body>
    <?php
    require_once(VIEW_PATH . 'navbar/navbar.php');
    ?>
    <div class="container">
        <div class="mb-3">
            <h2>Agregando Nuevo Idioma</h2>
        </div>
        <form id="formIdioma" action="store.php" method="post" class="g-3 needs-validation" novalidate>
            <!-- Descripción del Idioma -->
            <div class="mb-3">
                <label for="descrip_idioma" class="form-label">Descripción del Idioma</label>
                <input type="text" 
                       class="form-control" 
                       id="descrip_idioma" 
                       name="descrip_idioma" 
                       pattern="[A-Za-z\s]+" 
                       title="Solo se permiten letras" 
                       required>
                <div class="invalid-feedback">Ingrese una descripción válida</div>
            </div>

            <!-- Código ISO -->
            <div class="mb-3">
                <label for="iso_idioma" class="form-label">Código ISO</label>
                <input type="text" 
                       class="form-control" 
                       id="iso_idioma" 
                       name="iso_idioma" 
                       pattern="[A-Za-z0-9]+" 
                       title="Solo se permiten letras y números" 
                       required>
                <div class="invalid-feedback">Ingrese un código ISO válido</div>
            </div>

            <!-- Botón de Enviar -->
            <button type="submit" class="btn btn-primary btn-lg col-4">Guardar</button>
        </form>
    </div>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script>
        // Custom Bootstrap validation
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
