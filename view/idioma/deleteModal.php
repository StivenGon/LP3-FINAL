<!-- Modal for confirming the deletion -->
<div class="modal fade" id="iddel<?= $row['id_idioma'] ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¿Desea eliminar el registro?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Una vez eliminado no se podrá recuperar el registro</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <!-- Form to confirm deletion -->
                <form action="delete.php" method="get" style="display:inline;">
                    <input type="hidden" name="id_idioma" value="<?= $row['id_idioma'] ?>"> <!-- Hidden field for idioma ID -->
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>