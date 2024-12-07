<?php
$editoriales = $editorialController->select(); // Assuming you are fetching the editorials here
if (!empty($editoriales)) {
    foreach ($editoriales as $row) {
?>
    <div class="modal fade" id="idver<?=$row['id_editorial']?>" tabindex="-1" aria-labelledby="VistaModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="VistaModal">Vista Completa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card" style="width: 28rem;">
                        <form action="update_editorial.php" method="POST">
                            <input type="hidden" name="id_editorial" value="<?=$row['id_editorial']?>"> <!-- Hidden input for id -->

                            <div class="mb-3">
                                <label for="descrip_editorial" class="form-label">Descripción Editorial</label>
                                <input type="text" class="form-control" id="descrip_editorial" name="descrip_editorial" value="<?=$row['descrip_editorial']?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="pais_editorial" class="form-label">País Editorial</label>
                                <input type="text" class="form-control" id="pais_editorial" name="pais_editorial" value="<?=$row['pais_editorial']?>" required>
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
    echo "<p>No editorials found.</p>";  // Display message if no editorials are found
}
?>
