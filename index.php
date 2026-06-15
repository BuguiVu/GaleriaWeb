<?php
   session_start();

   require 'database.php';
 
   if (isset($_SESSION['user_id'])) {
     $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
     $records->bindParam(':id', $_SESSION['user_id']);
     $records->execute();
     $results = $records->fetch(PDO::FETCH_ASSOC);
 
     $user = null;
 
     if (count($results) > 0) {
       $user = $results;
     }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnimalitosBonitos</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets\css\style.css">
    
</head>
<body>

    <?php require 'partials/header.php'?>
    <?php if(!empty($user)): ?>
   <h1>Bienvenido <?= $user['email']; ?></h1>
   <br>
   <p>Ya has ingresado.</p>
   <br> 
   <a href="logout.php"> Salir  </a>
   <br> 
   <a href="fotos.php" class="button">Ver animalitos bonitos</a>
    <?php else: ?>
    <h1>Por favor ingrese o registrese.</h1>
 
    <a href="login.php">Ingresar</a> o 
    <a href="signup.php">Registrarse</a>
    <?php endif; ?>
   


</body>
</html>