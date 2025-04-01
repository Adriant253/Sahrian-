<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Álbumes</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js"></script> <!-- Incluye el script para limitar la reproducción -->
</head>
<body>
<?php
include 'db_connection.php'; // Conectar con la base de datos

$sql = "SELECT * FROM albums";
$result = $conn->query($sql);

echo "<h1>Lista de Álbumes</h1>";
while ($row = $result->fetch_assoc()) {
    echo "<h2>" . htmlspecialchars($row['album_name']) . " (" . htmlspecialchars($row['release_year']) . ")</h2>";
    echo "<p>Cantante: " . htmlspecialchars($row['singer']) . "</p>";
    echo "<p>Compositor: " . htmlspecialchars($row['composer']) . "</p>";
    echo "<p>Disquera: " . htmlspecialchars($row['record_label']) . "</p>";

    $album_id = intval($row['id']);
    $sql_songs = "SELECT * FROM songs WHERE album_id = $album_id";
    $result_songs = $conn->query($sql_songs);

    echo "<h3>Canciones:</h3>";
    while ($song = $result_songs->fetch_assoc()) {
        echo "<audio controls onclick='limitPlayback(this)'>
                <source src='" . htmlspecialchars($song['song_path']) . "' type='audio/mpeg'>
              </audio><br>";
    }
}
?>
</body>
</html>
