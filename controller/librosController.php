<?php
class librosController
{
    private $model;

    public function __construct()
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
        require_once(MODEL_PATH . 'librosModel.php');
        $this->model = new librosModel();
    }

    // Search by 'titulo' or 'isbn_libro'
    public function search($tituloOrIsbn)
    {
        // Directly return the result from the model's buscar method
        return $this->model->buscar($tituloOrIsbn);
    }

    // List all libros
    public function select()
    {
        $libros = $this->model->listar();
        if ($libros) {
            return $libros;
        } else {
            return []; // If no books, return an empty array
        }
    }

    // Delete a libro by id_libro
    public function delete($id_libro)
    {
        return $this->model->eliminar($id_libro);
    }

    // Insert a new libro
    public function insertar($titulo, $descripcion, $isbn_libro, $cantidad_disponible, $anho_publicacion, $estado, $id_idioma, $id_editorial, $id_autor)
    {
        return $this->model->insertar($titulo, $descripcion, $isbn_libro, $cantidad_disponible, $anho_publicacion, $estado, $id_idioma, $id_editorial, $id_autor);
    }

    // Update an existing libro
    public function update($id_libro, $titulo, $descripcion, $isbn_libro, $cantidad_disponible, $anho_publicacion, $estado, $id_idioma, $id_editorial, $id_autor)
    {
        return $this->model->update($id_libro, $titulo, $descripcion, $isbn_libro, $cantidad_disponible, $anho_publicacion, $estado, $id_idioma, $id_editorial, $id_autor);
    }

    // In librosController.php
    public function getAutores()
    {
        return $this->model->listarAutores();
    }

    // Fetch idiomas
    public function getIdiomas()
    {
        return $this->model->getIdiomas();
    }

    // Fetch editoriales
    public function getEditoriales()
    {
        return $this->model->getEditoriales();
    }

    public function getGeneros()
    {
        return $this->model->getGeneros();
    }

    public function listar()
    {
        // Call the model's listar method and return the result
        return $this->model->listar();
    }

    // Fetch a libro by id_libro
    public function getLibroById($id_libro)
    {
        return $this->model->getLibroById($id_libro);
    }

    public function updateLibro($id_libro, $titulo, $descripcion, $isbn_libro, $cantidad_disponible, $anho_publicacion, $estado, $id_idioma, $id_editorial, $id_autor)
    {
        return $this->model->updateLibro($id_libro, $titulo, $descripcion, $isbn_libro, $cantidad_disponible, $anho_publicacion, $estado, $id_idioma, $id_editorial, $id_autor);
    }
}
