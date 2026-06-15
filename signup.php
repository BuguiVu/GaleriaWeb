<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    if(($_POST['password']) == ($_POST['confirm_password'])){
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);

  
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);
    } else{
        $message = 'Las contraseñas no son iguales';
    }
   

    if ($stmt->execute()) {
      $message = 'El usuario se creó de manera correcta';
    } else {
      $message = '¡Parece que hay un error en tu registro! :O';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partials/header.php'?>
    <?php 
        if(!empty($message)):    
    ?>
    <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Registrate</h1>
    <span> o bien, <a href="login.php"> inicia sesión.</a></span>
    <form action="signup.php" method="POST">
      <input name="email" type="text" placeholder="Ingrese su email">
      <input name="password" type="password" placeholder="Ingrese su contraseña">
      <input name="confirm_password" type="password" placeholder="Confirme su contraseña">
      <input type="submit" value="Aceptar">
    </form>
</body>
</html>