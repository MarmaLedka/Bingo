<?php

@include 'config.php';

if (isset($_POST['submit'])) {

   $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $name = mysqli_real_escape_string($conn, $filter_name);
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));
   $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
   $cpass = mysqli_real_escape_string($conn, md5($filter_cpass));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('Не удалось выполнить запрос');

   if (mysqli_num_rows($select_users) > 0) {
      $message[] = 'Пользователь уже существует!';
   } else {
      if ($pass != $cpass) {
         $message[] = 'Пароли не совпадают!';
      } else {
         mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$pass')") or die('Не удалось выполнить запрос');
         $message[] = 'Регистрация прошла успешно!';
         header('location:login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Регистрация</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="icon" type="image/png" href="uploaded_img/favicon.png" />
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
      }
   }
   ?>

   <section class="form-container">

      <form action="" method="post">
         <a href="index.php"><img src="uploaded_img/logo-forauth.svg" alt=""></a>

         <h3>Регистрация</h3>
         <input type="text" name="name" class="box" placeholder="Введите ваше имя пользователя" required>
         <input type="email" name="email" class="box" placeholder="Введите ваш email" required>
         <input type="password" name="pass" class="box" placeholder="Введите ваш пароль" required>
         <input type="password" name="cpass" class="box" placeholder="Подтвердите ваш пароль" required>
         <input type="submit" class="btn" name="submit" value="Зарегистрироваться">
         <p>Уже есть аккаунт?<a href="login.php">Войти</a></p>
      </form>

   </section>

</body>

</html>