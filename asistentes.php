<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tabla de datos de asistentes</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>

<br>
<div></div>
    <table>
        <tr><td><h4>TABLA DE ASISTENTES</h4></td></tr>
        <tr>
            <td>Nombre</td>
            <td>Rut</td>
            <td>Email</td>
            <td>Telefono</td>
            <td>Fecha de registro</td>
        </tr>

        <?php
        $db_host = "localhost";
        $db_name = "registro_evento_trigo";
        $db_user = "root";
        $db_pass = "";

        $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
       
        $sql = "SELECT * FROM `asistentes`";
        $result = mysqli_query($conexion, $sql);

        
        if ($result) {
            while($mostrar = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo htmlspecialchars($mostrar['nombre']); ?></td>
                <td><?php echo htmlspecialchars($mostrar['rut']); ?></td>
                <td><?php echo htmlspecialchars($mostrar['email']); ?></td>
                <td><?php echo htmlspecialchars($mostrar['telefono']); ?></td>
                <td><?php echo htmlspecialchars($mostrar['fecha_registro']); ?></td>
            </tr>  
        <?php
        
            }
        } 
        ?>
    </table>
</div>
</body>
</html>
