<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

// Проверка, вошел ли пользователь. Если нет, перенаправление на страницу входа.
if (!isset($user_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказы</title>

    <!-- Ссылка на CDN шрифтов Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="uploaded_img/favicon.png" />
    <!-- Ссылка на пользовательский файл CSS -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="heading">
        <h3>Ваши заказы</h3>
        <p> <a href="index.php">Главная</a> / Заказ </p>
    </section>

    <section class="placed-orders">

        <h1 class="title">Оформленные заказы</h1>

        <div class="box-container">

            <?php
            // Запрос на получение всех заказов пользователя из базы данных
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('Ошибка запроса');
            // Если есть хотя бы один заказ
            if (mysqli_num_rows($select_orders) > 0) {
                // Цикл для вывода информации о каждом заказе
                while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                    ?>
                    <div class="box">
                        <p> Оформлено : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
                        <p> Имя : <span><?php echo $fetch_orders['name']; ?></span> </p>
                        <p> Номер телефона : <span><?php echo $fetch_orders['number']; ?></span> </p>
                        <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                        <p> Адрес : <span><?php echo $fetch_orders['address']; ?></span> </p>
                        <p> Способ оплаты : <span><?php echo $fetch_orders['method']; ?></span> </p>
                        <p> Ваши заказы : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
                        <p> Общая стоимость : <span>₽<?php echo $fetch_orders['total_price']; ?></span> </p>
                        <p> Статус оплаты : <span style="color:<?php if ($fetch_orders['payment_status'] == 'Оплачен') {
                            echo 'lime';
                        } else {
                            echo 'tomato';
                        } ?>"><?php echo $fetch_orders['payment_status']; ?></span>
                        </p>
                        <p>Статус заказа: <span style="color:<?php if ($fetch_orders['deliver_status'] == 'Доставлен') {
                            echo 'lime';
                        } else {
                            echo 'tomato';
                        } ?>"><?php echo $fetch_orders['deliver_status']; ?></span></p>
                    </div>
                    <?php
                }
            } else {
                echo '<p class="empty">Вы еще не сделали заказов!</p>';
            }
            ?>
        </div>

    </section>

    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>