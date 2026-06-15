<?php

    session_start();

    if (isset($_SESSION['user_id'])) {
        header('Location: /ProgWeb');
    }

  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /index.php");
    } else {
      $message = 'Parece que la cuenta no existe :c';
    }
  }

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ingreso</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  

  <body>
    <?php require 'partials/header.php'?>
    <?php if(!empty($message)):   ?>
    <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Inicia sesión</h1>
    <span> o bien, <a href="signup.php"> registrate.</a></span>

    

    <form action="login.php" method="POST">
      <input name="email" type="text" placeholder="Ingrese su email">
      <input name="password" type="password" placeholder="Ingrese su contraseña">
      <input type="submit" value="Aceptar">
    </form>
  </body>
</html>