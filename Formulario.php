<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form name="registro_evento_trigo" method="post" enctype="multipart/form-data">

        <p>REGISTROS DE ASISTENTES</p>
        
        <div class="div1">
            <input type="text" name="nombre" placeholder="Nombre ">
        </div>
        <div class="div1">
            <input type="text" name="rut" placeholder="RUT ">
        </div>
        <div class="div1">
            <input type="email" name="email" placeholder="Email">
        </div>
        <div class="div1">
            <input type="tel" name="telefono" placeholder="Telefono ">
        </div>
        <div class="div1">
            <input class="boton" type="file" name="foto" placeholder="Imagen"> <br><br>   
        </div>
        <div class="div1">
            <input class="boton2" name="registro" type="submit" value="Registrar">
        </div>
    
    </form>
</body>
</html>

<?php

require 'phpqrcode/qrlib.php';

$db_host = "localhost";
$db_name = "registro_evento_trigo";
$db_user = "root";
$db_pass = "";

$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $rut = $_POST["rut"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $imagen = $_FILES["foto"];
    $imagen_url = subir_archivo($imagen); 
    
    
    $asistente_id = insertar_registro($conexion, $nombre, $rut, $email, $telefono, $imagen_url);

    if ($asistente_id) {
        $enlace = "ver_asistente.php?id=" . $asistente_id;

        
        $rutaQr = "qrcodes/qr_$asistente_id.png";
        QRcode::png($enlace, $rutaQr);

        
        $sqlUpdate = "UPDATE asistentes SET codigo_qr = ? WHERE id = ?";
        $stmtUpdate = $conexion->prepare($sqlUpdate);
        $stmtUpdate->bind_param("si", $rutaQr, $asistente_id);
        $stmtUpdate->execute();
     }

}

function insertar_registro($conexion, $nombre, $rut, $email, $telefono, $imagen_url) {
    $sql = "INSERT INTO asistentes (nombre, rut, email, telefono, imagen) VALUES ('$nombre', '$rut', '$email', '$telefono', '$imagen_url')";
    
    if (mysqli_query($conexion, $sql)) {
        return mysqli_insert_id($conexion); // Return the last inserted ID
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
        return false;
    }
}
function subir_archivo($archivo) {
    $archivo_nombre = $archivo["name"];
    $directorio = "imagenes/";
    $archivo_destino = $directorio . basename($archivo_nombre);

    if (move_uploaded_file($archivo["tmp_name"], $archivo_destino)) {
        return $archivo_destino;
    } else {
        return "";
    }
}
mysqli_close($conexion);
?>

