<?php
class editorialController
{
    private $model;

    public function __construct()
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
        require_once(MODEL_PATH . 'editorialModel.php');
        $this->model = new editorialModel();
    }

    // List all editorials
    public function select()
    {
        $editoriales = $this->model->listar();
        if ($editoriales) {
            return $editoriales;
        } else {
            return []; // If no editorials, return an empty array
        }
    }

    // Search editorial by 'descrip_editorial' or 'pais_editorial'
    public function search($descripcionOrPais)
    {
        return $this->model->buscar($descripcionOrPais);
    }

    // Delete an editorial by id_editorial
    public function delete($id_editorial)
    {
        return $this->model->eliminar($id_editorial);
    }

    // Insert a new editorial
    public function insertar($descrip_editorial, $pais_editorial)
    {
        return $this->model->insertar($descrip_editorial, $pais_editorial);
    }

    // Update an existing editorial
    public function update($id_editorial, $descrip_editorial, $pais_editorial)
    {
        return $this->model->update($id_editorial, $descrip_editorial, $pais_editorial);
    }

    // Search editorial by id_editorial
    public function buscarPorId($id_editorial)
    {
        return $this->model->buscarPorId($id_editorial);
    }
}
?>
