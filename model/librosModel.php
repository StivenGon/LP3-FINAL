<?php
class librosModel
{
    private $PDO;

    public function __construct()
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
        require_once(DAO_PATH . 'database.php');
        $data = new dataConex();
        $this->PDO = $data->conexion();
    }

    // List all libros ordered by id_libro
    public function listar()
    {
        $sql = 'SELECT 
                    libro.id_libro, 
                    libro.titulo, 
                    libro.isbn_libro, 
                    libro.cantidad_disponible, 
                    libro.anho_publicacion, 
                    libro.estado, 
                    autor.descrip_autor, 
                    editorial.descrip_editorial
                FROM libro
                LEFT JOIN autor ON libro.id_autor = autor.id_autor
                LEFT JOIN editorial ON libro.id_editorial = editorial.id_editorial
                ORDER BY libro.id_libro';

        $statement = $this->PDO->prepare($sql);

        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC); // Return result as an associative array
        } else {
            return false; // If query fails, return false
        }
    }


    // Search libro by titulo or isbn_libro
    public function buscar($tituloOrIsbn)
    {
        $sql = 'SELECT * FROM libro WHERE titulo LIKE :tituloOrIsbn OR isbn_libro LIKE :tituloOrIsbn';
        $statement = $this->PDO->prepare($sql);

        // Bind parameter for searching by titulo or isbn_libro
        $searchTerm = '%' . $tituloOrIsbn . '%';
        $statement->bindParam(':tituloOrIsbn', $searchTerm);

        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC); // Fetch result as associative array
            return $result ? $result : false; // Return result or false if not found
        } else {
            return false;
        }
    }

    // Insert a new libro
    public function insertar($titulo, $descripcion, $isbn_libro, $cantidad_disponible, $anho_publicacion, $estado, $id_idioma, $id_editorial, $id_autor)
    {
        $sql = 'INSERT INTO libro (titulo, descripcion, isbn_libro, cantidad_disponible, anho_publicacion, estado, id_idioma, id_editorial, id_autor) 
                VALUES (:titulo, :descripcion, :isbn_libro, :cantidad_disponible, :anho_publicacion, :estado, :id_idioma, :id_editorial, :id_autor)';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':titulo', $titulo);
        $statement->bindParam(':descripcion', $descripcion);
        $statement->bindParam(':isbn_libro', $isbn_libro);
        $statement->bindParam(':cantidad_disponible', $cantidad_disponible);
        $statement->bindParam(':anho_publicacion', $anho_publicacion);
        $statement->bindParam(':estado', $estado);
        $statement->bindParam(':id_idioma', $id_idioma);
        $statement->bindParam(':id_editorial', $id_editorial);
        $statement->bindParam(':id_autor', $id_autor);

        if ($statement->execute()) {
            return $this->PDO->lastInsertId(); // Return last inserted ID
        }
        return false;
    }

    // Delete a libro by id_libro
    public function eliminar($id_libro)
    {
        $sql = 'DELETE FROM libro WHERE id_libro = :id_libro';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':id_libro', $id_libro, PDO::PARAM_INT);

        if ($statement->execute()) {
            return true;
        }
        return false;
    }

    // Update a libro by id_libro
    public function update($id_libro, $titulo, $descripcion, $isbn_libro, $cantidad_disponible, $anho_publicacion, $estado, $id_idioma, $id_editorial, $id_autor)
    {
        $sql = 'UPDATE libro SET titulo = :titulo, descripcion = :descripcion, isbn_libro = :isbn_libro, cantidad_disponible = :cantidad_disponible, 
                anho_publicacion = :anho_publicacion, estado = :estado, id_idioma = :id_idioma, id_editorial = :id_editorial, id_autor = :id_autor 
                WHERE id_libro = :id_libro';
        $statement = $this->PDO->prepare($sql);

        // Bind parameters
        $statement->bindParam(':titulo', $titulo);
        $statement->bindParam(':descripcion', $descripcion);
        $statement->bindParam(':isbn_libro', $isbn_libro);
        $statement->bindParam(':cantidad_disponible', $cantidad_disponible);
        $statement->bindParam(':anho_publicacion', $anho_publicacion);
        $statement->bindParam(':estado', $estado);
        $statement->bindParam(':id_idioma', $id_idioma);
        $statement->bindParam(':id_editorial', $id_editorial);
        $statement->bindParam(':id_autor', $id_autor);
        $statement->bindParam(':id_libro', $id_libro, PDO::PARAM_INT);

        return $statement->execute();
    }

    // In librosModel.php
    public function listarAutores()
    {
        $sql = 'SELECT id_autor, descrip_autor FROM autor ORDER BY descrip_autor';
        $statement = $this->PDO->prepare($sql);

        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC); // Return authors as associative array
        } else {
            return false;
        }
    }

    // Listar Idiomas
    public function getIdiomas()
    {
        $sql = 'SELECT id_idioma, descrip_idioma FROM idioma ORDER BY descrip_idioma';
        $statement = $this->PDO->prepare($sql);

        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC); // Return languages as associative array
        } else {
            return false;
        }
    }

    // Listar Editoriales
    public function getEditoriales()
    {
        $sql = 'SELECT id_editorial, descrip_editorial FROM editorial ORDER BY descrip_editorial';
        $statement = $this->PDO->prepare($sql);

        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC); // Return publishers as associative array
        } else {
            return false;
        }
    }

    public function getGeneros()
    {
        $sql = 'SELECT id_genero, descrip_genero FROM genero ORDER BY descrip_genero';
        $statement = $this->PDO->prepare($sql);

        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC); // Return publishers as associative array
        } else {
            return false;
        }
    }

    // Example modification of getLibroById method
    public function getLibroById($id_libro)
    {
        $sql = "SELECT
                l.id_libro,
                l.titulo,
                l.descripcion,
                l.isbn_libro,
                l.cantidad_disponible,
                l.anho_publicacion,
                l.estado,
                l.id_idioma,
                l.id_editorial,
                l.id_autor,
                i.descrip_idioma,
                e.descrip_editorial,
                a.descrip_autor
            FROM libro l
            LEFT JOIN idioma i ON l.id_idioma = i.id_idioma
            LEFT JOIN editorial e ON l.id_editorial = e.id_editorial
            LEFT JOIN autor a ON l.id_autor = a.id_autor
            WHERE l.id_libro = :id_libro";

        // Prepare and execute the query
        $stmt = $this->PDO->prepare($sql);
        $stmt->bindParam(':id_libro', $id_libro);
        $stmt->execute();

        // Fetch the result
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update the libro details
    public function updateLibro($id_libro, $titulo, $descripcion, $isbn_libro, $cantidad_disponible, $anho_publicacion, $estado, $id_idioma, $id_editorial, $id_autor)
    {
        $sql = 'UPDATE libro 
                    SET titulo = ?, descripcion = ?, isbn_libro = ?, cantidad_disponible = ?, anho_publicacion = ?, estado = ?, id_idioma = ?, id_editorial = ?, id_autor = ?
                    WHERE id_libro = ?';

        $statement = $this->PDO->prepare($sql);
        return $statement->execute([$titulo, $descripcion, $isbn_libro, $cantidad_disponible, $anho_publicacion, $estado, $id_idioma, $id_editorial, $id_autor, $id_libro]);
    }
}
