<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты</title>

    <!-- Ссылка на шрифт Font Awesome из CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="uploaded_img/favicon.png" />
    <!-- Ссылка на пользовательский файл CSS для стилей администратора -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="heading">
        <h3>Свяжитесь с нами</h3>
        <p> <a href="index.php">Главная</a> / Контакты </p>
    </section>

    <section class="contact">

        <form action="" method="POST">
            <h3>Отправьте нам сообщение!</h3>
            <input type="text" name="name" placeholder="Введите ваше имя" class="box" required>
            <input type="email" name="email" placeholder="Введите ваш email" class="box" required>
            <input type="number" name="number" placeholder="Введите ваш номер" class="box" required>
            <textarea name="message" class="box" placeholder="Введите ваше сообщение" required cols="30"
                rows="10"></textarea>
            <input type="submit" value="Отправить сообщение" name="send" class="btn">
        </form>

    </section>

    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>