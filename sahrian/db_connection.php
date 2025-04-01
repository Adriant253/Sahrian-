<?php
$host = "localhost"; // Cambia esto si tu host es diferente
$username = "root";  // Cambia esto si usas otro usuario
$password = "";      // Cambia esto si tienes una contraseña
$database = "music_albums"; // Nombre de la base de datos

$conn = new mysqli($host, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
