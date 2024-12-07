<?php
class PrestamosModel
{
    private $PDO;

    public function __construct()
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
        require_once(DAO_PATH . 'database.php');
        $data = new dataConex();
        $this->PDO = $data->conexion();
    }

    // List all prestamos ordered by id_prestamo
    public function listar()
    {
        $sql = 'SELECT 
                    p.id_prestamo,
                    p.fecha_prestamo,
                    p.fecha_devolucion,
                    p.estado,
                    c.nombre AS cliente,          -- Correct field from cliente
                    l.titulo AS libro,            -- Correct field from libro
                    u.alias AS usuario            -- Correct field from usuario
                FROM prestamo p
                JOIN cliente c ON p.id_cliente = c.id_cliente
                JOIN libro l ON p.id_libro = l.id_libro
                JOIN usuario u ON p.id_usuario = u.id_usuario
                ORDER BY p.id_prestamo';

        $statement = $this->PDO->prepare($sql);

        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    // Insert a new prestamo
    public function insertar($id_cliente, $id_libro, $id_usuario, $fecha_prestamo, $fecha_devolucion, $estado)
    {
        $sql = 'INSERT INTO prestamo (id_cliente, id_libro, id_usuario, fecha_prestamo, fecha_devolucion, estado) 
                VALUES (:id_cliente, :id_libro, :id_usuario, :fecha_prestamo, :fecha_devolucion, :estado)';
        $statement = $this->PDO->prepare($sql);

        $statement->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $statement->bindParam(':id_libro', $id_libro, PDO::PARAM_INT);
        $statement->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $statement->bindParam(':fecha_prestamo', $fecha_prestamo);
        $statement->bindParam(':fecha_devolucion', $fecha_devolucion);
        $statement->bindParam(':estado', $estado, PDO::PARAM_INT);

        if ($statement->execute()) {
            return $this->PDO->lastInsertId();
        }
        return false;
    }

    // Update an existing prestamo
    public function actualizar($id_prestamo, $estado)
    {
        // SQL query only updates 'estado' since it's the only editable field
        $sql = 'UPDATE prestamo 
                SET estado = :estado
                WHERE id_prestamo = :id_prestamo';
    
        // Prepare the SQL statement
        $statement = $this->PDO->prepare($sql);
    
        // Bind the parameters
        $statement->bindParam(':id_prestamo', $id_prestamo, PDO::PARAM_INT);
        $statement->bindParam(':estado', $estado, PDO::PARAM_INT);
    
        // Execute the query and return the result
        return $statement->execute();
    }
    

    // List related foreign tables
    public function listarClientes()
    {
        $sql = 'SELECT id_cliente, nombre FROM cliente ORDER BY nombre';  // Ensure 'nombre' is the correct field
        $statement = $this->PDO->prepare($sql);

        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function listarLibros()
    {
        $sql = 'SELECT id_libro, titulo FROM libro ORDER BY titulo';  // Correct field for libro
        $statement = $this->PDO->prepare($sql);

        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function listarUsuarios()
    {
        $sql = 'SELECT id_usuario, alias FROM usuario ORDER BY alias';  // Correct field for usuario
        $statement = $this->PDO->prepare($sql);

        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }


    // In PrestamosModel.php
    public function getPrestamoById($id_prestamo)
    {
        $sql = "SELECT p.id_prestamo, c.nombre, l.titulo, u.alias, 
                p.fecha_prestamo, p.fecha_devolucion, p.estado
                FROM prestamo p
                JOIN cliente c ON p.id_cliente = c.id_cliente
                JOIN libro l ON p.id_libro = l.id_libro
                JOIN usuario u ON p.id_usuario = u.id_usuario
                WHERE p.id_prestamo = :id_prestamo";

        $stmt = $this->PDO->prepare($sql);
        $stmt->bindParam(':id_prestamo', $id_prestamo, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // Fetch cliente details by ID
    public function getClienteById($id_cliente)
    {
        $sql = 'SELECT id_cliente, nombre FROM cliente WHERE id_cliente = :id_cliente';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);

        if ($statement->execute()) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    // Fetch libro details by ID
    public function getLibroById($id_libro)
    {
        $sql = 'SELECT id_libro, titulo FROM libro WHERE id_libro = :id_libro';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':id_libro', $id_libro, PDO::PARAM_INT);

        if ($statement->execute()) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    // Fetch usuario details by ID
    public function getUsuarioById($id_usuario)
    {
        $sql = 'SELECT id_usuario, alias FROM usuario WHERE id_usuario = :id_usuario';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

        if ($statement->execute()) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    // In PrestamosModel.php
    public function getPrestamoDetails($id_prestamo)
    {
        // Fetch id_prestamo, cliente (nombre), estado, and libro_titulo
        $sql = "SELECT p.id_prestamo, c.nombre AS cliente, p.estado, l.titulo AS libro_titulo
                FROM prestamo p
                JOIN cliente c ON p.id_cliente = c.id_cliente
                JOIN libro l ON p.id_libro = l.id_libro
                WHERE p.id_prestamo = :id_prestamo";
    
        $stmt = $this->PDO->prepare($sql);
        $stmt->bindParam(':id_prestamo', $id_prestamo, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

}
