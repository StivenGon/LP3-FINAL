<?php
class clienteModel
{
    private $PDO;

    public function __construct()
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
        require_once(DAO_PATH . 'database.php');
        $data = new dataConex();
        $this->PDO = $data->conexion();
    }

    // List all clientes ordered by id_cliente
    public function listar()
    {
        $sql = 'SELECT * FROM cliente ORDER BY id_cliente';
        $statement = $this->PDO->prepare($sql);
        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC); // Ensure the result is returned as an associative array
        } else {
            return false;
        }
    }

    // Search cliente by nombre or telefono
    public function buscar($nombreOrTelefono)
    {
        // SQL query to search by 'nombre' or 'telefono'
        $sql = 'SELECT * FROM cliente WHERE nombre LIKE :nombreOrTelefono OR telefono LIKE :nombreOrTelefono';
        $statement = $this->PDO->prepare($sql);
    
        // Bind the parameter to search for the given value in both 'nombre' and 'telefono'
        $searchTerm = '%' . $nombreOrTelefono . '%'; // Use wildcards for partial matching
        $statement->bindParam(':nombreOrTelefono', $searchTerm);
    
        // Execute the query
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC); // Fetch the result as an associative array
            return $result ? $result : false; // Return result or false if no result found
        } else {
            return false; // Return false if query execution fails
        }
    }
    

    // Insert a new cliente
    public function insertar($nombre, $telefono, $correo)
    {
        // Ensure the SQL query matches the table columns
        $sql = 'INSERT INTO cliente (nombre, telefono, correo) VALUES (:nombre, :telefono, :correo)';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':telefono', $telefono);
        $statement->bindParam(':correo', $correo);

        // Execute the query and return the last insert ID
        if ($statement->execute()) {
            return $this->PDO->lastInsertId(); // Return the ID of the newly inserted row
        }
        return false; // Return false if insertion fails
    }


    // Delete a cliente by id_cliente
    public function eliminar($id_cliente)
    {
        $sql = 'DELETE FROM cliente WHERE id_cliente = :id_cliente';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);

        // Debugging logs for error checking
        error_log("Executing query: $sql with id_cliente: $id_cliente");
        
        if ($statement->execute()) {
            return true;
        } else {
            error_log("SQL Error: " . print_r($statement->errorInfo(), true));
            return false;
        }
    }

    // Update a cliente by id_cliente
    public function update($id_cliente, $nombre, $telefono, $correo)
    {
        // Update query to include telefono and correo
        $sql = 'UPDATE cliente SET nombre = :nombre, telefono = :telefono, correo = :correo WHERE id_cliente = :id_cliente';
        $statement = $this->PDO->prepare($sql);

        // Bind parameters to query
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':telefono', $telefono);
        $statement->bindParam(':correo', $correo);
        $statement->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);

        // Execute the statement and return the result
        return $statement->execute();
    }
}
