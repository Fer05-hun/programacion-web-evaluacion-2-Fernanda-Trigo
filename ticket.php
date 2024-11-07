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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ticket</title>
    <link rel="stylesheet" href="style4.css">
</head>
<body>
    <div class = "div1">
        

    </div>
    
</body>
</html>