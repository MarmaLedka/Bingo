<?php
session_start();

// Подключение к базе данных
include 'config.php';

$cart_num_rows = 0;

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user_id'])) {
    $user_id = null; // Если пользователь не авторизован, user_id не существует
} else {
    $user_id = $_SESSION['user_id'];
    // Получаем количество товаров в корзине
    $cart_query = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'");
    $cart_num_rows = mysqli_num_rows($cart_query);
}

// Отображение сообщений
if (isset($message)) {
    foreach ($message as $msg) { // Изменено имя переменной внутри foreach
        echo '
      <div class="message">
         <span>' . htmlspecialchars($msg) . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
}
?>

<header class="header">

    <div class="flex">
        <a href="index.php" class="logo"><img src="uploaded_img/favicon.png" alt="">Новомосковский полиэфир</a>

        <nav class="navbar">
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="#">Страницы</a>
                    <ul>
                        <li><a href="about.php">О нас</a></li>
                        <li><a href="contact.php">Контакты</a></li>
                    </ul>
                </li>
                <li><a href="shop.php">Магазин</a></li>
                <li><a href="orders.php">Заказы</a></li>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li><a href="#">Аккаунт</a>
                        <ul>
                            <li><a href="login.php">Вход</a></li>
                            <li><a href="register.php">Регистрация</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <?php
            if (isset($_SESSION['user_id'])): ?>
                <div id="user-btn" class="fas fa-user"></div>
            <?php endif; ?>
            <a href="cart.php"><i
                    class="fas fa-shopping-cart"></i><span><?php echo "(" . $cart_num_rows . ")"; ?></span></a>
        </div>

        <div class="account-box">
            <p>Имя пользователя : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>Email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">Выйти</a>
        </div>

    </div>

</header>