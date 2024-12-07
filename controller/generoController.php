<?php
class generoController
{
    private $model;

    public function __construct()
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
        require_once(MODEL_PATH . 'generoModel.php');
        $this->model = new generoModel();
    }

    // Search by 'descrip_genero'
    // Search by 'id_genero'
    public function search($id_genero)
    {
        return $this->model->buscarById($id_genero);
    }

    // List all generos
    public function select()
    {
        $generos = $this->model->listar();
        if ($generos) {
            return $generos;
        } else {
            return []; // If no generos, return an empty array
        }
    }

    // Delete a genero by id_genero
    public function delete($id_genero)
    {
        return $this->model->eliminar($id_genero);
    }

    // Insert a new genero
    public function insertar($descrip_genero)
    {
        return $this->model->insertar($descrip_genero);
    }

    // Update an existing genero
    public function update($id_genero, $descrip_genero)
    {
        if (empty($descrip_genero)) {
            error_log("Error: descrip_genero is empty");
            return false; // Ensure that the description is not empty
        }
        return $this->model->update($id_genero, $descrip_genero);
    }
}
?>
