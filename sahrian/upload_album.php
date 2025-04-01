<?php
include 'db_connection.php';

// Verificar que la solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("<h1>Error 405: Método no permitido</h1><p>Este script solo acepta solicitudes POST.</p>");
}

// Procesar la solicitud POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitizar los datos del formulario
    $album_name = mysqli_real_escape_string($conn, $_POST['album_name']);
    $singer = mysqli_real_escape_string($conn, $_POST['singer']);
    $composer = mysqli_real_escape_string($conn, $_POST['composer']);
    $record_label = mysqli_real_escape_string($conn, $_POST['record_label']);
    $release_year = intval($_POST['release_year']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);

    // Manejo del archivo de la canción
    $song_file = $_FILES['song_file'];
    $song_path = 'uploads/' . basename($song_file['name']);

    // Subir la canción al servidor
    if (move_uploaded_file($song_file['tmp_name'], $song_path)) {
        // Insertar datos en la tabla de álbumes
        $sql = "INSERT INTO albums (album_name, singer, composer, record_label, release_year, genre) 
                VALUES ('$album_name', '$singer', '$composer', '$record_label', $release_year, '$genre')";
        
        if ($conn->query($sql) === TRUE) {
            $album_id = $conn->insert_id; // Obtener el ID del álbum recién agregado

            // Insertar la canción en la tabla de canciones
            $sql_song = "INSERT INTO songs (album_id, song_path) VALUES ('$album_id', '$song_path')";
            
            if ($conn->query($sql_song) === TRUE) {
                echo "<p>Álbum agregado exitosamente.</p>";
            } else {
                echo "<p>Error al guardar la canción: " . $conn->error . "</p>";
            }
        } else {
            echo "<p>Error al guardar el álbum: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>Error al subir la canción.</p>";
    }
}
?>
