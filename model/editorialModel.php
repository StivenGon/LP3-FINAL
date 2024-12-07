<?php
class editorialModel
{
    private $PDO;

    public function __construct()
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
        require_once(DAO_PATH . 'database.php');
        $data = new dataConex();
        $this->PDO = $data->conexion();
    }

    // List all editorials ordered by id_editorial
    public function listar()
    {
        $sql = 'SELECT * FROM editorial ORDER BY id_editorial';
        $statement = $this->PDO->prepare($sql);
        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC); // Ensure the result is returned as an associative array
        } else {
            return false;
        }
    }

    // Search editorial by 'descrip_editorial' or 'pais_editorial'
    public function buscar($descripcionOrPais)
    {
        // SQL query to search by 'descrip_editorial' or 'pais_editorial'
        $sql = 'SELECT * FROM editorial WHERE descrip_editorial LIKE :descripcionOrPais OR pais_editorial LIKE :descripcionOrPais';
        $statement = $this->PDO->prepare($sql);

        // Bind the parameter to search for the given value in both 'descrip_editorial' and 'pais_editorial'
        $searchTerm = '%' . $descripcionOrPais . '%'; // Use wildcards for partial matching
        $statement->bindParam(':descripcionOrPais', $searchTerm);

        // Execute the query
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC); // Fetch the result as an associative array
            return $result ? $result : false; // Return result or false if no result found
        } else {
            return false; // Return false if query execution fails
        }
    }

    // Insert a new editorial
    public function insertar($descrip_editorial, $pais_editorial)
    {
        // Ensure the SQL query matches the table columns
        $sql = 'INSERT INTO editorial (descrip_editorial, pais_editorial) VALUES (:descrip_editorial, :pais_editorial)';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':descrip_editorial', $descrip_editorial);
        $statement->bindParam(':pais_editorial', $pais_editorial);

        // Execute the query and return the last insert ID
        if ($statement->execute()) {
            return $this->PDO->lastInsertId(); // Return the ID of the newly inserted row
        }
        return false; // Return false if insertion fails
    }

    // Delete an editorial by id_editorial
    public function eliminar($id_editorial)
    {
        $sql = 'DELETE FROM editorial WHERE id_editorial = :id_editorial';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':id_editorial', $id_editorial, PDO::PARAM_INT);

        // Debugging logs for error checking
        error_log("Executing query: $sql with id_editorial: $id_editorial");

        if ($statement->execute()) {
            return true;
        } else {
            error_log("SQL Error: " . print_r($statement->errorInfo(), true));
            return false;
        }
    }

    // Update an editorial by id_editorial
    public function update($id_editorial, $descrip_editorial, $pais_editorial)
    {
        // Update query to include descrip_editorial and pais_editorial
        $sql = 'UPDATE editorial SET descrip_editorial = :descrip_editorial, pais_editorial = :pais_editorial WHERE id_editorial = :id_editorial';
        $statement = $this->PDO->prepare($sql);

        // Bind parameters to query
        $statement->bindParam(':descrip_editorial', $descrip_editorial);
        $statement->bindParam(':pais_editorial', $pais_editorial);
        $statement->bindParam(':id_editorial', $id_editorial, PDO::PARAM_INT);

        // Execute the statement and return the result
        return $statement->execute();
    }

    public function buscarPorId($id_editorial)
    {
        $sql = 'SELECT * FROM editorial WHERE id_editorial = :id_editorial';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':id_editorial', $id_editorial, PDO::PARAM_INT);

        // Execute the query and fetch the result
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC); // Fetch the result as an associative array
            return $result ? $result : false; // Return result or false if no result found
        } else {
            return false; // Return false if query execution fails
        }
    }
}
