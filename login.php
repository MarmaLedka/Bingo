<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {

   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('Ошибка запроса');


   if (mysqli_num_rows($select_users) > 0) {

      $row = mysqli_fetch_assoc($select_users);

      if ($row['user_type'] == 'admin') {

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      } elseif ($row['user_type'] == 'user') {

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:index.php');

      } else {
         $message[] = 'Пользователь не найден!';
      }

   } else {
      $message[] = 'Неверный email или пароль!';
   }

}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Вход</title>

   <!-- Ссылка на CDN Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="icon" type="image/png" href="uploaded_img/favicon.png" />
   <!-- Ссылка на пользовательский CSS файл -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>



   <section class="form-container">

      <form action="" method="post">
         <?php
         if (isset($_SESSION['message'])) {
            echo '
   <div class="message">
      <span>' . $_SESSION['message'] . '</span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>
   ';
            unset($_SESSION['message']); // Удаляем сообщение, чтобы оно не показывалось повторно
         }
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
         <a href="index.php"><img src="uploaded_img/logo-forauth.svg" alt=""></a>
         <h3>Вход</h3>
         <input type="email" name="email" class="box" placeholder="Введите ваш email" required>
         <input type="password" name="pass" class="box" placeholder="Введите ваш пароль" required>
         <input type="submit" class="btn" name="submit" value="Войти">
         <p>У вас нет аккаунта? <a href="register.php">Зарегистрироваться</a></p>

      </form>

   </section>

</body>

</html>