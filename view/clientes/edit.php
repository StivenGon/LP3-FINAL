<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header('location: ../usuario/login.php');
    exit;
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(MODEL_PATH . 'clienteModel.php');

// Initialize the clienteModel
$model = new clienteModel();

// Ensure id_cliente is provided and valid
$id_cliente = isset($_GET['id_cliente']) ? intval($_GET['id_cliente']) : 0;
if ($id_cliente <= 0) {
    echo "ID de cliente no válido.";
    exit;
}

// Fetch the cliente details
$cliente = $model->buscar($id_cliente);
if (!$cliente) {
    echo "Cliente no encontrado.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <title>Editando Cliente</title>
</head>

<body>
    <?php require_once(VIEW_PATH . 'navbar/navbar.php'); ?>

    <div class="container">
        <div class="mb-3">
            <h2>Editando Cliente</h2>
        </div>
        <form id="formCliente" action="update.php" method="post" class="g-3 needs-validation" novalidate>
            <!-- Hidden input for id_cliente -->
            <input type="hidden" id="id_cliente" name="id_cliente" value="<?= htmlspecialchars($cliente['id_cliente']) ?>">

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" 
                       class="form-control" 
                       id="nombre" 
                       name="nombre" 
                       value="<?= htmlspecialchars($cliente['nombre']) ?>" 
                       pattern="[A-Za-z\s]+" 
                       title="Solo se permiten letras y espacios" 
                       required>
                <div class="invalid-feedback">Ingrese un nombre válido (solo letras y espacios).</div>
            </div>

            <!-- Teléfono -->
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" 
                       class="form-control" 
                       id="telefono" 
                       name="telefono" 
                       value="<?= htmlspecialchars($cliente['telefono']) ?>" 
                       pattern="\d+" 
                       title="Solo se permiten números" 
                       required>
                <div class="invalid-feedback">Ingrese un número de teléfono válido.</div>
            </div>

            <!-- Correo -->
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" 
                       class="form-control" 
                       id="correo" 
                       name="correo" 
                       value="<?= htmlspecialchars($cliente['correo']) ?>" 
                       required>
                <div class="invalid-feedback">Ingrese un correo válido.</div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script>
        // Front-end validation with Bootstrap
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
