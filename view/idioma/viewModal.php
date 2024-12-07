<?php
$idiomas = $idiomaController->select(); // Assuming you are fetching the idiomas here
if (!empty($idiomas)) {
    foreach ($idiomas as $row) {
?>
    <div class="modal fade" id="idver<?=$row['id_idioma']?>" tabindex="-1" aria-labelledby="VistaModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="VistaModal">Vista Completa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card" style="width: 28rem;">
                        <form action="update_idioma.php" method="POST">
                            <input type="hidden" name="id_idioma" value="<?=$row['id_idioma']?>"> <!-- Hidden input for id -->

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?=$row['nombre']?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="codigo" class="form-label">Código</label>
                                <input type="text" class="form-control" id="codigo" name="codigo" value="<?=$row['codigo']?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?=$row['descripcion']?>" required>
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
    echo "<p>No idiomas found.</p>";  // Display message if no idiomas are found
}
?>
