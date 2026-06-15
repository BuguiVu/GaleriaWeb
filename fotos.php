<?php
// Incluir el archivo de conexión a la base de datos
require 'database.php';

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la URL del formulario
    $url = $_POST['url'];

    // Preparar la consulta SQL para insertar la URL en la base de datos
    $sql = "INSERT INTO imagenes (url) VALUES (:url)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':url', $url);

    // Ejecutar la consulta
    try {
        $stmt->execute();
        echo "URL guardada exitosamente.";
    } catch(PDOException $e) {
        echo "Error al guardar la URL: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnimalitosBonitos</title>
    <link rel="stylesheet" href="assets/css/estilo.css"> <!-- Enlazar tu archivo CSS -->
</head>
<body>
    <?php require 'partials/header.php'?>
    <h1>AnimalitosBonitos</h1>
    
    <!-- Formulario para ingresar la URL -->
    <form action="fotos.php" method="POST">
        <label for="url" class="a">URL:</label>
        <input type="text" id="url" name="url" required>
        <button type="submit">Guardar</button>
    </form>

    <p class="warning">Desde google, de click derecho en la imagen que desee y seleccione "Copy image adress" y pegue aquí.</p>

    <!-- Incluir la galería de imágenes -->
    <?php include 'galeria.php'; ?>

    <footer>...</footer>
</body>
</html>
