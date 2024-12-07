<?php
class clienteController
{
    private $model;

    public function __construct()
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
        require_once(MODEL_PATH . 'clienteModel.php');
        $this->model = new clienteModel();
    }

    // Search by 'nombre' or 'telefono'
    public function search($id_cliente)
    {
        return $this->model->buscar($id_cliente); // Fetch a single cliente by ID
    }
    

    // List all clientes
    public function select()
    {
        $clientes = $this->model->listar();
        if ($clientes) {
            return $clientes;
        } else {
            return []; // If no clients, return an empty array
        }
    }

    // Delete a client by id_cliente
    public function delete($id_cliente)
    {
        return $this->model->eliminar($id_cliente);
    }

    // Insert a new client
    public function insertar($nombre, $telefono, $correo)
    {
        // Call the model's insertar method to insert the client
        return $this->model->insertar($nombre, $telefono, $correo);
    }


    // Update an existing client
    public function update($id_cliente, $nombre, $telefono, $correo)
    {
        return $this->model->update($id_cliente, $nombre, $telefono, $correo);
    }
}
