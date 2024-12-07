<?php
// Include the necessary controller for autor
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(CONTROLLER_PATH . 'autorController.php');

// Create an instance of the autorController
$object = new autorController();

// Fetch all autores from the database using the select method
$rows = $object->select();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once(ROOT_PATH . 'header.php') ?>
    <title>Autores</title>
</head>

<body>
    <?php require_once(VIEW_PATH . 'navbar/navbar.php'); ?>

    <section class="intro">
        <div class="container">
            <div class="mb-3"></div>
            <div class="mb-3">
                <a href="create.php" class="btn btn-primary">Agregar</a>
            </div>
            <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px;">
                <table id="myTabla" class="table table-striped mb-0">
                    <thead style="background-color: #002d72;">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">DESCRIPCIÓN</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ((array) $rows as $row) { ?>
                            <tr>
                                <td><?= $row['id_autor'] ?></td> <!-- Changed to id_autor -->
                                <td><?= $row['descrip_autor'] ?></td> <!-- Changed to descrip_autor -->
                                <td>
                                    <a href="edit.php?id_autor=<?= $row['id_autor'] ?>" class="btn btn-warning">Editar</a> <!-- Changed to id_autor -->
                                    <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#iddel<?= $row['id_autor'] ?>">Eliminar</a> <!-- Changed to id_autor -->
                                    <!-- Modal for delete confirmation -->
                                    <?php include('deleteModal.php'); ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Print View Area -->
    <div class="container" id="ventana" style="display:none;">
        <div class="mb-3">
            <h2 style="font-size: 3.00rem;">Listado de Autores</h2> <!-- Changed to "Autores" -->
        </div>
        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px;">
            <table class="table table-striped mb-0" style="font-size: 2.00rem;">
                <thead>
                    <tr>
                        <th colspan="1" scope="col">ID</th>
                        <th colspan="3" scope="col">DESCRIPCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) { ?>
                        <tr>
                            <td colspan="1"><?= $row['id_autor'] ?></td> <!-- Changed to id_autor -->
                            <td colspan="3"><?= $row['descrip_autor'] ?></td> <!-- Changed to descrip_autor -->
                        </tr>
                    <?php } ?>
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
