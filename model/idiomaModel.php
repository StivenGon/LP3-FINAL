<?php
class idiomaModel
{
    private $PDO;

    public function __construct()
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
        require_once(DAO_PATH . 'database.php');
        $data = new dataConex();
        $this->PDO = $data->conexion();
    }

    // List all idiomas ordered by id_idioma
    public function listar()
    {
        $sql = 'SELECT * FROM idioma ORDER BY id_idioma';
        $statement = $this->PDO->prepare($sql);
        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC); // Ensure the result is returned as an associative array
        } else {
            return false;
        }
    }

    // Search idioma by descrip_idioma or iso_idioma
    public function buscar($descripOrIso)
    {
        // SQL query to search by 'descrip_idioma' or 'iso_idioma'
        $sql = 'SELECT * FROM idioma WHERE descrip_idioma LIKE :descripOrIso OR iso_idioma LIKE :descripOrIso';
        $statement = $this->PDO->prepare($sql);

        // Bind the parameter to search for the given value in both 'descrip_idioma' and 'iso_idioma'
        $searchTerm = '%' . $descripOrIso . '%'; // Use wildcards for partial matching
        $statement->bindParam(':descripOrIso', $searchTerm);

        // Execute the query
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC); // Fetch the result as an associative array
            return $result ? $result : false; // Return result or false if no result found
        } else {
            return false; // Return false if query execution fails
        }
    }

    // Insert a new idioma
    public function insertar($descrip_idioma, $iso_idioma)
    {
        // Ensure the SQL query matches the table columns
        $sql = 'INSERT INTO idioma (descrip_idioma, iso_idioma) VALUES (:descrip_idioma, :iso_idioma)';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':descrip_idioma', $descrip_idioma);
        $statement->bindParam(':iso_idioma', $iso_idioma);

        // Execute the query and return the last insert ID
        if ($statement->execute()) {
            return $this->PDO->lastInsertId(); // Return the ID of the newly inserted row
        }
        return false; // Return false if insertion fails
    }

    // Delete an idioma by id_idioma
    public function eliminar($id_idioma)
    {
        $sql = 'DELETE FROM idioma WHERE id_idioma = :id_idioma';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':id_idioma', $id_idioma, PDO::PARAM_INT);

        // Execute the statement and return the result
        return $statement->execute();
    }

    // Update an idioma by id_idioma
    public function update($id_idioma, $descrip_idioma, $iso_idioma)
    {
        // Update query to include descrip_idioma and iso_idioma
        $sql = 'UPDATE idioma SET descrip_idioma = :descrip_idioma, iso_idioma = :iso_idioma WHERE id_idioma = :id_idioma';
        $statement = $this->PDO->prepare($sql);

        // Bind parameters to query
        $statement->bindParam(':descrip_idioma', $descrip_idioma);
        $statement->bindParam(':iso_idioma', $iso_idioma);
        $statement->bindParam(':id_idioma', $id_idioma, PDO::PARAM_INT);

        // Execute the statement and return the result
        return $statement->execute();
    }
    public function buscarPorId($id_idioma)
    {
        // Query to fetch an idioma by its ID
        $sql = 'SELECT * FROM idioma WHERE id_idioma = :id_idioma';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':id_idioma', $id_idioma, PDO::PARAM_INT);

        // Execute the query
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result ? $result : false; // Return result or false if not found
        } else {
            return false; // Return false if query fails
        }
    }
}
