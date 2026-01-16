<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}
;

if (isset($_POST['order'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, 'кв. ' . $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code']);
    $placed_on = date('d-M-Y');

    $cart_total = 0;
    $cart_products[] = '';

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed1');
    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
            $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed2');

    if ($cart_total == 0) {
        $message[] = 'Ваша корзина пуста!';
    } elseif (mysqli_num_rows($order_query) > 0) {
        $message[] = 'Заказ уже создан!';
    } else {
        $query = "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) 
        VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')";

        $result = mysqli_query($conn, $query);

        if (!$result) {
            die('Ошибка запроса: ' . mysqli_error($conn));
        }
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        $message[] = 'Заказ успешно создан!';
    }
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформление заказа</title>

    <!-- Ссылка на шрифт Font Awesome из CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="uploaded_img/favicon.png" />
    <!-- Ссылка на пользовательский файл CSS для стилей администратора -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="heading">
        <h3>Оформление заказа</h3>
        <p> <a href="index.php">Главная</a> / Оформление заказа </p>
    </section>

    <section class="display-order">
        <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                $grand_total += $total_price;
                ?>
                <p> <?php echo $fetch_cart['name'] ?>
                    <span>(<?php echo $fetch_cart['price'] . '₽/- x ' . $fetch_cart['quantity'] ?>)</span>
                </p>
                <?php
            }
        } else {
            echo '<p class="empty">Ваша корзина пуста</p>';
        }
        ?>
        <div class="grand-total">Итого: <span><?php echo $grand_total; ?>₽</span></div>
    </section>

    <section class="checkout">

        <form action="" method="POST">

            <h3>Пожалуйста, заполните форму для заказа</h3>

            <div class="flex">
                <div class="inputBox">
                    <span>Ваше имя :</span>
                    <input type="text" name="name" placeholder="Введите ваше имя" required>
                </div>
                <div class="inputBox">
                    <span>Ваш номер телефона :</span>
                    <input type="number" name="number" min="0" placeholder="Введите ваш номер телефона" required>
                </div>
                <div class="inputBox">
                    <span>Ваш email :</span>
                    <input type="email" name="email" placeholder="Введите ваш email" required>
                </div>
                <div class="inputBox">
                    <span>Способ оплаты :</span>
                    <select name="method" required>
                        <option value="наличными при получении">Наличными при получении</option>
                        <option value="кредитная карта">Кредитная карта</option>
                        <option value="paypal">PayPal</option>
                        <option value="paytm">Paytm</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span>Адрес, столбец 1 :</span>
                    <input type="text" name="flat" placeholder="кв." required>
                </div>
                <div class="inputBox">
                    <span>Адрес, столбец 2 :</span>
                    <input type="text" name="street" placeholder="улица" required>
                </div>
                <div class="inputBox">
                    <span>Город :</span>
                    <input type="text" name="city" placeholder="город" required>
                </div>
                <div class="inputBox">
                    <span>Область :</span>
                    <input type="text" name="state" placeholder="область" required>
                </div>
                <div class="inputBox">
                    <span>Страна :</span>
                    <input type="text" name="country" placeholder="страна" required>
                </div>
                <div class="inputBox">
                    <span>Почтовый индекс :</span>
                    <input type="number" min="0" name="pin_code" placeholder="почтовый индекс" required>
                </div>
            </div>

            <input type="submit" name="order" value="Заказать сейчас" class="btn">

        </form>

    </section>

    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>