<?php
class generoModel
{
    private $PDO;

    public function __construct()
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
        require_once(DAO_PATH . 'database.php');
        $data = new dataConex();
        $this->PDO = $data->conexion();
    }

    // List all generos ordered by id_genero
    public function listar()
    {
        $sql = 'SELECT * FROM genero ORDER BY id_genero';
        $statement = $this->PDO->prepare($sql);
        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC); // Ensure the result is returned as an associative array
        } else {
            return false;
        }
    }

    // Search genero by descrip_genero
    public function buscar($descripGenero)
    {
        $sql = 'SELECT * FROM genero WHERE descrip_genero LIKE :descripGenero';
        $statement = $this->PDO->prepare($sql);
        $searchTerm = '%' . $descripGenero . '%';
        $statement->bindParam(':descripGenero', $searchTerm);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result ? $result : false;
        } else {
            return false;
        }
    }

    // Insert a new genero
    public function insertar($descrip_genero)
    {
        $sql = 'INSERT INTO genero (descrip_genero) VALUES (:descrip_genero)';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':descrip_genero', $descrip_genero);
        if ($statement->execute()) {
            return $this->PDO->lastInsertId();
        }
        return false;
    }

    // Delete a genero by id_genero
    public function eliminar($id_genero)
    {
        $sql = 'DELETE FROM genero WHERE id_genero = :id_genero';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':id_genero', $id_genero, PDO::PARAM_INT);
        if ($statement->execute()) {
            return true;
        } else {
            error_log("SQL Error: " . print_r($statement->errorInfo(), true));
            return false;
        }
    }

    // Update a genero by id_genero
    public function update($id_genero, $descrip_genero)
    {
        $sql = 'UPDATE genero SET descrip_genero = :descrip_genero WHERE id_genero = :id_genero';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':descrip_genero', $descrip_genero);
        $statement->bindParam(':id_genero', $id_genero, PDO::PARAM_INT);

        return $statement->execute();
    }

    // Search genero by id_genero
    public function buscarById($id_genero)
    {
        $sql = 'SELECT * FROM genero WHERE id_genero = :id_genero';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':id_genero', $id_genero, PDO::PARAM_INT);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result ? $result : false;
        } else {
            return false;
        }
    }
}
?>
