<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header('location: ../usuario/login.php');
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/controller/prestamosController.php');
$controller = new PrestamosController();

// Fetch loan details based on 'id_prestamo'
if (isset($_GET['id_prestamo'])) {
    $prestamo = $controller->getPrestamoDetails($_GET['id_prestamo']);
    if (!$prestamo) {
        // If the prestamo does not exist, redirect
        header('location: listado.php');
        exit;
    }
} else {
    header('location: listado.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Prestamo</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        /* Hide the ID field */
        #id_prestamo {
            display: none;
        }
    </style>
</head>

<body>
<?php
    require_once(VIEW_PATH . 'navbar/navbar.php');
    ?>
    <div class="container">
        <h2>Editar Prestamo</h2>
        <form method="POST" action="update.php">
            <input type="hidden" name="id_prestamo" value="<?= htmlspecialchars($prestamo['id_prestamo']); ?>">

            <!-- id_prestamo (invisible) -->
            <div class="mb-3">
                <label for="id_prestamo" class="form-label">ID Prestamo:</label>
                <input type="text" class="form-control" id="id_prestamo" name="id_prestamo" value="<?= htmlspecialchars($prestamo['id_prestamo']); ?>" readonly>
            </div>

            <!-- Cliente (readonly) -->
            <div class="mb-3">
                <label for="cliente_nombre" class="form-label">Cliente:</label>
                <input type="text" class="form-control" id="cliente_nombre" name="cliente_nombre" value="<?= htmlspecialchars($prestamo['cliente']); ?>" readonly>
            </div>

            <!-- Libro Titulo (readonly) -->
            <div class="mb-3">
                <label for="libro_titulo" class="form-label">Libro Titulo:</label>
                <input type="text" class="form-control" id="libro_titulo" name="libro_titulo" value="<?= htmlspecialchars($prestamo['libro_titulo']); ?>" readonly>
            </div>

            <!-- Estado -->
            <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <select class="form-control" id="estado" name="estado" required>
                    <option value="0" <?= $prestamo['estado'] == 0 ? 'selected' : ''; ?>>Prestado</option>
                    <option value="1" <?= $prestamo['estado'] == 1 ? 'selected' : ''; ?>>Devuelto</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Actualizar Prestamo</button>
        </form>
    </div>

</body>

</html>
