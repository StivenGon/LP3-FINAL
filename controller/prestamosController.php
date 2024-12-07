<?php
class PrestamosController
{
    private $model;

    public function __construct()
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
        require_once(MODEL_PATH . 'prestamosModel.php');
        $this->model = new PrestamosModel();
    }

    // List all prestamos
    public function listar()
    {
        $prestamos = $this->model->listar();
        if ($prestamos) {
            return $prestamos;
        } else {
            return [];
        }
    }

    // Insert a new prestamo
    public function insertar($id_cliente, $id_libro, $id_usuario, $fecha_prestamo, $fecha_devolucion, $estado)
    {
        return $this->model->insertar($id_cliente, $id_libro, $id_usuario, $fecha_prestamo, $fecha_devolucion, $estado);
    }

    // Update an existing prestamo
    public function actualizar($id_prestamo, $estado)
    {
        // Call the actualizar method of the model to update only the 'estado' field
        return $this->model->actualizar($id_prestamo, $estado);
    }
    


    // Fetch related foreign data
    public function getClientes()
    {
        return $this->model->listarClientes();
    }

    public function getLibros()
    {
        return $this->model->listarLibros();
    }

    public function getUsuarios()
    {
        return $this->model->listarUsuarios();
    }


    // Fetch a libro by ID
    public function getPrestamoById($id_libro)
    {
        return $this->model->getPrestamoById($id_libro);
    }

    // Fetch cliente details by ID
    public function getClienteById($id_cliente)
    {
        return $this->model->getClienteById($id_cliente);
    }

    // Fetch libro details by ID
    public function getLibroById($id_libro)
    {
        return $this->model->getLibroById($id_libro);
    }

    // Fetch usuario details by ID
    public function getUsuarioById($id_usuario)
    {
        return $this->model->getUsuarioById($id_usuario);
    }

    // In PrestamosController.php
    public function getPrestamoDetails($id_prestamo)
    {
        return $this->model->getPrestamoDetails($id_prestamo);
    }
}
