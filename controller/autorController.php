<?php
class autorController
{
    private $model;

    public function __construct()
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
        require_once(MODEL_PATH . 'autorModel.php');
        $this->model = new autorModel();
    }

    // Search by 'id_autor'
    public function search($id_autor)
    {
        $autor = $this->model->buscarPorId($id_autor);

        if (!$autor) {
            error_log("No autor found with id_autor: $id_autor");
        } else {
            error_log("Found autor: " . print_r($autor, true));
        }
        return $autor;
    }

    // List all autores
    public function select()
    {
        $autores = $this->model->listar();
        return $autores ? $autores : [];
    }

    // Delete an autor by id_autor
    public function delete($id_autor)
    {
        return $this->model->eliminar($id_autor);
    }

    // Insert a new autor
    public function insertar($descrip_autor)
    {
        return $this->model->insertar($descrip_autor);
    }

    // Update an existing autor
    public function update($id_autor, $descrip_autor)
    {
        return $this->model->update($id_autor, $descrip_autor);
    }
}
?>
