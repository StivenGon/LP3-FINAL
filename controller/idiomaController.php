<?php
class idiomaController
{
    private $model;

    public function __construct()
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
        require_once(MODEL_PATH . 'idiomaModel.php');
        $this->model = new idiomaModel();
    }

    // List all idiomas
    public function select()
    {
        $idiomas = $this->model->listar();
        if ($idiomas) {
            return $idiomas;
        } else {
            return []; // If no idiomas, return an empty array
        }
    }

    // Search idioma by 'descrip_idioma' or 'iso_idioma'
    // Search idioma by ID
    public function search($id_idioma)
    {
        // Use the buscarPorId method to fetch idioma by id_idioma
        return $this->model->buscarPorId($id_idioma);
    }


    // Delete an idioma by id_idioma
    public function delete($id_idioma)
    {
        return $this->model->eliminar($id_idioma);
    }

    // Insert a new idioma
    public function insertar($descrip_idioma, $iso_idioma)
    {
        // Call the model's insertar method to insert the idioma
        return $this->model->insertar($descrip_idioma, $iso_idioma);
    }

    // Update an existing idioma
    public function update($id_idioma, $descrip_idioma, $iso_idioma)
    {
        return $this->model->update($id_idioma, $descrip_idioma, $iso_idioma);
    }
}
