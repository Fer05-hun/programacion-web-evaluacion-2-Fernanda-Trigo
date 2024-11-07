<?php
$db_host = "localhost";
$db_name = "registro_evento_trigo";
$db_user = "root";
$db_pass = "";

$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

$sql = "SELECT id, nombre FROM asistentes";
$dato = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seleccionar ID</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <div class = "div1">
    <table>
        <tr>
            <th>ID</th>
            <th>Seleccionar</th>
        </tr>
        <?php
        if ($dato->num_rows > 0) {
            while($fila = $dato->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila["id"] . "</td>";
                echo "<td><form action='detalles.php' method='post'>
                        <button type='submit'>Ver detalles</button>
                      </form></td>";
                echo "</tr>";
            }
        } 
        ?>
    </table>
</div>
</body>
</html>

<?php
?>
