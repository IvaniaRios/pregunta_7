<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monto Total por Departamento</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php
// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "bdivania");

// Verificar la conexión
if ($conexion === false) {
    die("ERROR: No se pudo conectar. " . mysqli_connect_error());
}

// Consulta SQL para obtener el monto total por departamento
$SQL = "SELECT
            SUM(CASE WHEN p.departamento = 'Chuquisaca' THEN cb.monto  END) AS Chuquisaca,
            SUM(CASE WHEN p.departamento = 'La Paz' THEN cb.monto  END) AS LaPaz,
            SUM(CASE WHEN p.departamento = 'Cochabamba' THEN cb.monto  END) AS Cochabamba,
            SUM(CASE WHEN p.departamento = 'Oruro' THEN cb.monto  END) AS Oruro,
            SUM(CASE WHEN p.departamento = 'Potosi' THEN cb.monto END) AS Potosi,
            SUM(CASE WHEN p.departamento = 'Tarija' THEN cb.monto  END) AS Tarija,
            SUM(CASE WHEN p.departamento = 'Santa Cruz' THEN cb.monto END) AS SantaCruz,
            SUM(CASE WHEN p.departamento = 'Beni' THEN cb.monto END) AS Beni,
            SUM(CASE WHEN p.departamento = 'Pando' THEN cb.monto END) AS Pando
        FROM persona p
        LEFT JOIN cuenta_bancaria cb ON p.id_persona = cb.id_persona";

// Ejecutar la consulta
$resultado = mysqli_query($conexion, $SQL);

// Verificar si hay resultados
if (mysqli_num_rows($resultado) > 0) {
    // Mostrar encabezados de tabla
    echo "<table>";
    echo "<tr><th>Chuquisaca</th><th>La Paz</th><th>Cochabamba</th><th>Oruro</th><th>Potosi</th><th>Tarija</th><th>Santa Cruz</th><th>Beni</th><th>Pando</th></tr>";
    
    // Mostrar los resultados
    $fila = mysqli_fetch_assoc($resultado);
    echo "<tr>";
    echo "<td>" . $fila['Chuquisaca'] . "</td>";
    echo "<td>" . $fila['LaPaz'] . "</td>";
    echo "<td>" . $fila['Cochabamba'] . "</td>";
    echo "<td>" . $fila['Oruro'] . "</td>";
    echo "<td>" . $fila['Potosi'] . "</td>";
    echo "<td>" . $fila['Tarija'] . "</td>";
    echo "<td>" . $fila['SantaCruz'] . "</td>";
    echo "<td>" . $fila['Beni'] . "</td>";
    echo "<td>" . $fila['Pando'] . "</td>";
    echo "</tr>";

    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

// Cerrar la conexión
mysqli_close($conexion);
?>

</body>
</html>
