<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header('location: ../usuario/login.php');
    exit;
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'clienteController.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <title>Agregando Cliente</title>
</head>

<body>
    <?php
    require_once(VIEW_PATH . 'navbar/navbar.php');
    ?>
    <div class="container">
        <div class="mb-3">
            <h2>Agregando Nuevo Cliente</h2>
        </div>
        <form id="formCliente" action="store.php" method="post" class="g-3 needs-validation" novalidate>
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" 
                       class="form-control" 
                       id="nombre" 
                       name="nombre" 
                       pattern="[A-Za-z\s]+" 
                       title="Solo se permiten letras" 
                       required>
                <div class="invalid-feedback">Ingrese un nombre válido</div>
            </div>

            <!-- Teléfono -->
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" 
                       class="form-control" 
                       id="telefono" 
                       name="telefono" 
                       pattern="\d+" 
                       title="Solo se permiten números" 
                       required>
                <div class="invalid-feedback">Ingrese un número de teléfono válido</div>
            </div>

            <!-- Correo -->
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" 
                       class="form-control" 
                       id="correo" 
                       name="correo" 
                       required>
                <div class="invalid-feedback">Ingrese un correo válido</div>
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

        // Additional JS to provide specific field feedback
        document.getElementById('formCliente').addEventListener('submit', function (event) {
            const nombre = document.getElementById('nombre').value.trim();
            const telefono = document.getElementById('telefono').value.trim();
            const correo = document.getElementById('correo').value.trim();

        });
    </script>
</body>

</html>
