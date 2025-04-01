// Función para limitar la reproducción de canciones a 20 segundos
function limitPlayback(audio) {
    // Reproducir la canción
    audio.play();
  
    // Pausar la canción después de 20 segundos (20000 milisegundos)
    setTimeout(() => {
      audio.pause();
    }, 20000);
  }
  