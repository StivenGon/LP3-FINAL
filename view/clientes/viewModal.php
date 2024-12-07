<?php
$clientes = $clienteController->select(); // Assuming you are fetching the clients here
if (!empty($clientes)) {
    foreach ($clientes as $row) {
?>
    <div class="modal fade" id="idver<?=$row['id_cliente']?>" tabindex="-1" aria-labelledby="VistaModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="VistaModal">Vista Completa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card" style="width: 28rem;">
                        <form action="update_client.php" method="POST">
                            <input type="hidden" name="id" value="<?=$row['id_cliente']?>"> <!-- Hidden input for id -->

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?=$row['nombre']?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" value="<?=$row['apellido']?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="ciudad" class="form-label">Ciudad</label>
                                <input type="text" class="form-control" id="ciudad" name="idCiudad" value="<?=$row['ciudad']?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="cin" class="form-label">Cédula</label>
                                <input type="text" class="form-control" id="cin" name="cin" value="<?=$row['cin']?>" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php
    }
} else {
    echo "<p>No clients found.</p>";  // Display message if no clients are found
}
?>
