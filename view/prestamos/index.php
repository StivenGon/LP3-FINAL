<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'prestamosController.php');
$object = new PrestamosController();

// Check if there's a search query
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// If there's a search query, filter the results based on the cliente name
$rows = $object->listar($searchQuery); // Modify listar() method to accept a search query and filter data
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once(ROOT_PATH . 'header.php') ?>
    <title>Préstamos</title>
</head>

<body>
    <?php require_once(VIEW_PATH . 'navbar/navbar.php'); ?>

    <section class="intro">
        <div class="container">
            <div class="mb-3"></div>
            <div class="mb-3">
                <!-- Link to add a new préstamo -->
                <a href="create.php" class="btn btn-primary">Agregar Préstamo</a>
            </div>
            

            <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px;">
                <table id="myTabla" class="table table-striped mb-0">
                    <thead style="background-color: #002d72;">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Libro</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Fecha de Préstamo</th>
                            <th scope="col">Fecha de Devolución</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($rows && count($rows) > 0): ?>
                            <?php foreach ($rows as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id_prestamo']) ?></td>
                                    <td><?= htmlspecialchars($row['cliente']) ?></td>
                                    <td><?= htmlspecialchars($row['libro']) ?></td>
                                    <td><?= htmlspecialchars($row['usuario']) ?></td>
                                    <td><?= htmlspecialchars($row['fecha_prestamo']) ?></td>
                                    <td><?= htmlspecialchars($row['fecha_devolucion']) ?></td>
                                    <td>
                                        <?= $row['estado'] == 1 ? 'Devuelto' : 'Prestado'; ?>
                                    </td>
                                    <td>
                                        <!-- Edit button for each préstamo -->
                                        <a href="edit.php?id_prestamo=<?= $row['id_prestamo'] ?>" class="btn btn-warning">Editar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">No hay préstamos disponibles.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Print View Area -->
    <div class="container" id="ventana" style="display:none;">
        <div class="mb-3">
            <h2 style="font-size: 3.00rem;">Listado de Préstamos</h2>
        </div>
        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px;">
            <table class="table table-striped mb-0" style="font-size: 2.00rem;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Libro</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Fecha de Préstamo</th>
                        <th scope="col">Fecha de Devolución</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id_prestamo']) ?></td>
                            <td><?= htmlspecialchars($row['cliente']) ?></td>
                            <td><?= htmlspecialchars($row['libro']) ?></td>
                            <td><?= htmlspecialchars($row['usuario']) ?></td>
                            <td><?= htmlspecialchars($row['fecha_prestamo']) ?></td>
                            <td><?= htmlspecialchars($row['fecha_devolucion']) ?></td>
                            <td>
                                <?= $row['estado'] == 1 ? 'Activo' : 'Inactivo'; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Print View Area -->

    <?php include_once(ROOT_PATH . 'footer.php') ?>

    <script>
        $(document).ready(function () {
            var table = new DataTable('#myTabla', {
                language: {
                    url: '../../assets/js/es-ES.json',
                },
                'paging': true,
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, 'Todos']
                ]
            });
        });
    </script>
</body>

</html>
