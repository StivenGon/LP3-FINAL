<?php
class autorModel
{
    private $PDO;

    public function __construct()
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
        require_once(DAO_PATH . 'database.php');
        $data = new dataConex();
        $this->PDO = $data->conexion();
    }

    // List all autores ordered by id_autor
    public function listar()
    {
        $sql = 'SELECT * FROM autor ORDER BY id_autor';
        $statement = $this->PDO->prepare($sql);
        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC); // Ensure the result is returned as an associative array
        } else {
            return false;
        }
    }

    // Search autor by descrip_autor
    public function buscar($descrip_autor)
    {
        $sql = 'SELECT * FROM autor WHERE descrip_autor LIKE :descrip_autor';
        $statement = $this->PDO->prepare($sql);

        $searchTerm = '%' . $descrip_autor . '%'; // Use wildcards for partial matching
        $statement->bindParam(':descrip_autor', $searchTerm);

        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result ? $result : false;
        } else {
            return false;
        }
    }

    // Insert a new autor
    public function insertar($descrip_autor)
    {
        $sql = 'INSERT INTO autor (descrip_autor) VALUES (:descrip_autor)';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':descrip_autor', $descrip_autor);

        if ($statement->execute()) {
            return $this->PDO->lastInsertId();
        }
        return false;
    }

    // Delete an autor by id_autor
    public function eliminar($id_autor)
    {
        $sql = 'DELETE FROM autor WHERE id_autor = :id_autor';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':id_autor', $id_autor, PDO::PARAM_INT);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Update an autor by id_autor
    public function update($id_autor, $descrip_autor)
    {
        $sql = 'UPDATE autor SET descrip_autor = :descrip_autor WHERE id_autor = :id_autor';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':descrip_autor', $descrip_autor);
        $statement->bindParam(':id_autor', $id_autor, PDO::PARAM_INT);

        return $statement->execute();
    }

    // Search autor by id_autor
    public function buscarPorId($id_autor)
    {
        $sql = 'SELECT * FROM autor WHERE id_autor = :id_autor';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':id_autor', $id_autor, PDO::PARAM_INT);
    
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result ? $result : false;
        } else {
            return false;
        }
    }
}
?>
