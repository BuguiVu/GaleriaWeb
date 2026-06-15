<?php

// Incluir el archivo de conexión a la base de datos
require 'database.php';

try {
    // Consulta SQL para obtener las URLs de las imágenes
    $sql = "SELECT url FROM imagenes";
    $stmt = $conn->query($sql);

    // Comprobar si se encontraron resultados
    if ($stmt->rowCount() > 0) {
        // Generar el HTML para mostrar las imágenes
        echo "<div class='row'>";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='column'>";
            echo "<img src='" . $row["url"] . "' alt='Imagen'>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "0 resultados";
    }
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

// No es necesario cerrar la conexión explícitamente, se cerrará automáticamente cuando se destruya el objeto PDO
// No es necesario llamar a closeCursor() ya que PDOStatement se destruirá automáticamente
?>
