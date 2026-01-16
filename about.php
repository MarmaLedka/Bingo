<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О нас</title>

    <!-- Ссылка на CDN Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="uploaded_img/favicon.png" />
    <!-- Ссылка на пользовательский CSS файл -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="heading">
        <h3>О нас</h3>
        <p> <a href="index.php">Главная</a> / О нас </p>
    </section>

    <section class="about">

        <div class="flex">

            <div class="image">
                <img src="images/about1.jpg" alt="Химический завод 1">
            </div>

            <div class="content">
                <h3>Почему выбирают нас?</h3>
                <p>Мы разрабатываем и производим передовые электроизоляционные материалы, обеспечивающие надежность и
                    долговечность вашей техники. Каждое решение создается с учётом потребностей наших клиентов.</p>
                <a href="shop.php" class="btn">Купить сейчас</a>
            </div>

        </div>

        <div class="flex">

            <div class="content">
                <h3>Что мы предоставляем?</h3>
                <p>Наш ассортимент включает материалы для электрических машин, кабельной промышленности, а также
                    полимерные композиционные материалы с уникальными свойствами.</p>
                <a href="contact.php" class="btn">Свяжитесь с нами</a>
            </div>

            <div class="image">
                <img src="images/about2.jpg" alt="Химический завод 2">
            </div>

        </div>

        <div class="flex">

            <div class="image">
                <img src="images/about3.jpg" alt="Химический завод 3">
            </div>

            <div class="content">
                <h3>Кто мы такие?</h3>
                <p>ООО «Новомосковские Полиэфиры» – это команда экспертов, которая помогает клиентам внедрять
                    инновационные решения и достигать технологического лидерства.</p>
                <a href="#reviews" class="btn">Отзывы клиентов</a>
            </div>

        </div>

    </section>

    <section class="reviews" id="reviews">

        <h1 class="title">Отзывы клиентов</h1>

        <div class="box-container">

            <div class="box">
                <img src="images/profile.png" alt="">
                <p>Продукция высокого качества, особенно впечатлили электроизоляционные материалы. Отличная работа!</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Пользователь 1</h3>
            </div>

            <div class="box">
                <img src="images/profile.png" alt="">
                <p>Отличное обслуживание и качественные материалы. Помогли подобрать нужные решения для производства.
                </p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h3>Пользователь 2</h3>
            </div>

            <div class="box">
                <img src="images/profile.png" alt="">
                <p>Индивидуальный подход к клиентам. Очень доволен сотрудничеством с компанией.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h3>Пользователь 3</h3>
            </div>

        </div>

    </section>

    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>