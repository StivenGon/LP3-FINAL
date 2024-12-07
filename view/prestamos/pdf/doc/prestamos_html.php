<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Prestamos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            width: 90%; /* Adjust width */
            margin: auto;
        }
        h2 {
            color: white;
            background-color: #003366; /* Darker blue */
            padding: 50px; /* Larger padding for 'wall' effect */
            margin: 0;
            font-size: 48px; /* Bigger text */
            text-align: center;
        }
        table {
            width: 100%; /* Keep the table taking full width */
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 10px; /* Increase padding for better spacing */
        }
        th {
            background-color: #f2f2f2;
        }
        .table-container {
            overflow-x: auto;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Prestamos</h2>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID Prestamo</th>
                    <th>Cliente</th>
                    <th>Libro</th>
                    <th>Fecha de Prestamo</th>
                    <th>Fecha de Devolucion</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prestamos as $prestamo): ?>
                    <tr>
                        <td><?php echo $prestamo['id_prestamo']; ?></td>
                        <td><?php echo $prestamo['cliente']; ?></td>
                        <td><?php echo $prestamo['libro']; ?></td>
                        <td><?php echo $prestamo['fecha_prestamo']; ?></td>
                        <td><?php echo $prestamo['fecha_devolucion']; ?></td>
                        <td>
                            <!-- Show Estado as text -->
                            <?php echo $prestamo['estado'] == 0 ? 'Prestado' : 'Devuelto'; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
