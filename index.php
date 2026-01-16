<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'] ?? null; // Проверка авторизации пользователя

if (isset($_POST['add_to_cart'])) {
   if (!$user_id) {
      $_SESSION['message'] = 'Сначала нужно войти или зарегистрироваться!';
      header('location:login.php');
      exit;
   }

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('Не удалось выполнить запрос');

   if (mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'Уже добавлено в корзину';
   } else {
      mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('Не удалось выполнить запрос');
      $message[] = 'Продукт добавлен в корзину';
   }
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Главная</title>

   <!-- Ссылка на CDN шрифтов Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="icon" type="image/png" href="uploaded_img/favicon.png" />
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php @include 'header.php'; ?>

   <section class="home">

      <div class="content">
         <h3>Лучшая химическая продукция.</h3>
         <p>Индивидуальные решения для вашего производства.</p>
         <p>Высококачественные полиэфиры по выгодной цене.</p>
         <a href="about.php" class="btn">Узнать больше!</a>
      </div>

   </section>

   <section class="products">

      <h1 class="title">Наша продукция</h1>

      <div class="box-container">

         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('Не удалось выполнить запрос');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
               ?>
               <form action="" method="POST" class="box">

                  <div class="price"><?php echo $fetch_products['price']; ?>&#8381;</div>
                  <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
                  <div class="name"> <a
                        href="view_page.php?pid=<?php echo $fetch_products['id']; ?>"><?php echo $fetch_products['name']; ?></a>
                  </div>
                  <input type="number" name="product_quantity" value="1" min="1" class="qty">
                  <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">

                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                  <input type="submit" value="Добавить в корзину" name="add_to_cart" class="btn">
               </form>
               <?php
            }
         } else {
            echo '<p class="empty">Пока нет добавленных продуктов!</p>';
         }
         ?>

      </div>

      <div class="more-btn">
         <a href="shop.php" class="option-btn">Загрузить больше</a>
      </div>

   </section>

   <section class="home-contact">

      <div class="content">
         <h3>Есть вопросы?</h3>
         <p>Мы хотели бы поблагодарить вас за покупку у нас. Вы можете написать нам с любыми новыми мыслями на
            “email-id”, помогая
            нам улучшить сервис.</p>
         <a href="contact.php" class="btn">Свяжитесь с нами</a>
      </div>

   </section>

   <?php @include 'footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>