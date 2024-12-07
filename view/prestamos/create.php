<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header('location: ../usuario/login.php');
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/controller/prestamosController.php');
$controller = new PrestamosController();
$usuarios = $controller->getUsuarios(); // Fetch users list
$libros = $controller->getLibros(); // Fetch books list
$clientes = $controller->getClientes(); // Fetch clients list
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Préstamo</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>

<body>
    <?php
    require_once(VIEW_PATH . 'navbar/navbar.php');
    ?>
    <div class="container">
        <h2>Crear Nuevo Préstamo</h2>
        <form method="POST" action="store.php">
            <!-- Cliente Section -->
            <div class="mb-3">
                <label for="id_cliente_text" class="form-label">Cliente:</label>
                <input type="text" class="form-control" id="id_cliente_text" name="id_cliente_text" readonly>
                <button type="button" class="btn btn-secondary mt-2" id="selectClienteBtn">Seleccionar Cliente</button>
                <input type="hidden" id="id_cliente" name="id_cliente">
            </div>

            <!-- Usuario Section -->
            <div class="mb-3">
                <label for="id_usuario_text" class="form-label">Usuario:</label>
                <input type="text" class="form-control" id="id_usuario_text" name="id_usuario_text" readonly>
                <button type="button" class="btn btn-secondary mt-2" id="selectUsuarioBtn">Seleccionar Usuario</button>
                <input type="hidden" id="id_usuario" name="id_usuario">
            </div>

            <!-- Libro Section -->
            <div class="mb-3">
                <label for="id_libro_text" class="form-label">Libro:</label>
                <input type="text" class="form-control" id="id_libro_text" name="id_libro_text" readonly>
                <button type="button" class="btn btn-secondary mt-2" id="selectLibroBtn">Seleccionar Libro</button>
                <input type="hidden" id="id_libro" name="id_libro">
            </div>

            <!-- Fecha Inicio -->
            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio:</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
            </div>

            <!-- Fecha Fin -->
            <div class="mb-3">
                <label for="fecha_fin" class="form-label">Fecha de Fin:</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
            </div>

            <!-- Estado -->
            <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <select class="form-select" id="estado" name="estado">
                    <option value="1">Activo</option>
                    <option value="0">Finalizado</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <!-- Modals -->
    <?php
    function generateModal($id, $title, $items, $dataAttr, $textAttr)
    {
        echo <<<HTML
        <div id="{$id}" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Seleccionar {$title}</h5>
                        <button type="button" class="btn-close" onclick="closeModal('{$id}')"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
HTML;
        foreach ($items as $item) {
            echo <<<HTML
                            <li class="list-group-item">
                                <a href="#" class="select-item" data-id="{$item[$dataAttr]}" data-descrip="{$item[$textAttr]}" data-target="{$id}">
                                    {$item[$textAttr]}
                                </a>
                            </li>
HTML;
        }
        echo <<<HTML
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal('{$id}')">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
HTML;
    }

    generateModal('clienteModal', 'Cliente', $clientes, 'id_cliente', 'nombre');
    generateModal('usuarioModal', 'Usuario', $usuarios, 'id_usuario', 'alias');
    generateModal('libroModal', 'Libro', $libros, 'id_libro', 'titulo');
    ?>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/jquery.min.js"></script>
    <script>
        // Show modal for selecting items
        document.getElementById('selectClienteBtn').addEventListener('click', function() {
            document.getElementById('clienteModal').style.display = 'block';
        });

        document.getElementById('selectUsuarioBtn').addEventListener('click', function() {
            document.getElementById('usuarioModal').style.display = 'block';
        });

        document.getElementById('selectLibroBtn').addEventListener('click', function() {
            document.getElementById('libroModal').style.display = 'block';
        });

        // Close modal
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Handle selecting an item (Cliente, Usuario, Libro)
        document.querySelectorAll('.select-item').forEach(function(item) {
            item.addEventListener('click', function(event) {
                event.preventDefault();

                const id = this.getAttribute('data-id');
                const descrip = this.getAttribute('data-descrip');
                const target = this.getAttribute('data-target');

                const inputId = target.replace('Modal', '');
                document.getElementById(`id_${inputId}`).value = id;
                document.getElementById(`id_${inputId}_text`).value = descrip;

                closeModal(target);
            });
        });
    </script>
</body>

</html>