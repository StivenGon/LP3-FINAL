<?php
// Include the libroController
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'librosController.php');

// Instantiate the controller
$object = new librosController();

// Get all books from the database
$rows = $object->listar();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once(ROOT_PATH . 'header.php'); ?>
    <title>Libros</title>
</head>

<body>
    <?php require_once(VIEW_PATH . 'navbar/navbar.php'); ?>

    <section class="intro">
        <div class="container">
            <div class="mb-3"></div>
            <div class="mb-3">
                <!-- Link to add a new book -->
                <a href="create.php" class="btn btn-primary">Agregar</a>
            </div>
            <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px;">
                <table id="myTabla" class="table table-striped mb-0">
                    <thead style="background-color: #002d72;">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">TÍTULO</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">CANTIDAD DISPONIBLE</th>
                            <th scope="col">AÑO DE PUBLICACIÓN</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">AUTOR</th>
                            <th scope="col">EDITORIAL</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($rows && count($rows) > 0): ?>
                            <?php foreach ($rows as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id_libro']) ?></td>
                                    <td><?= htmlspecialchars($row['titulo']) ?></td>
                                    <td><?= htmlspecialchars($row['isbn_libro']) ?></td>
                                    <td><?= htmlspecialchars($row['cantidad_disponible']) ?></td>
                                    <td><?= htmlspecialchars($row['anho_publicacion']) ?></td>
                                    <td>
                                        <?php echo $row['estado'] == 1 ? 'Activo' : 'Inactivo'; ?>
                                    </td>
                                    <td><?= htmlspecialchars($row['descrip_autor']) ?></td>
                                    <td><?= htmlspecialchars($row['descrip_editorial']) ?></td>
                                    <td>
                                        <!-- Edit button for each book -->
                                        <a href="edit.php?id_libro=<?= $row['id_libro'] ?>" class="btn btn-warning">Editar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center">No hay libros disponibles.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Print View Area (hidden by default) -->
    <div class="container" id="ventana" style="display:none;">
        <div class="mb-3">
            <h2 style="font-size: 3.00rem;">Listado de Libros</h2>
        </div>
        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px;">
            <table class="table table-striped mb-0" style="font-size: 2.00rem;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">TÍTULO</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">CANTIDAD DISPONIBLE</th>
                        <th scope="col">AÑO DE PUBLICACIÓN</th>
                        <th scope="col">ESTADO</th>
                        <th scope="col">AUTOR</th>
                        <th scope="col">EDITORIAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) { ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id_libro']) ?></td>
                            <td><?= htmlspecialchars($row['titulo']) ?></td>
                            <td><?= htmlspecialchars($row['isbn_libro']) ?></td>
                            <td><?= htmlspecialchars($row['cantidad_disponible']) ?></td>
                            <td><?= htmlspecialchars($row['anho_publicacion']) ?></td>
                            <td>
                                <?php echo $row['estado'] == 1 ? 'Activo' : 'Inactivo'; ?>
                            </td>
                            <td><?= htmlspecialchars($row['descrip_autor']) ?></td>
                            <td><?= htmlspecialchars($row['descrip_editorial']) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include_once(ROOT_PATH . 'footer.php'); ?>
</body>

</html>
