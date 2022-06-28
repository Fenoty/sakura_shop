<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доставка</title>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/chief-slider.css">
    <link rel="stylesheet" href="/style/animate.css">
    <link rel="shortcut icon" href="/img/sakurashortneutral.png" type="image/png">
</head>
<body>
    <?php 
        include $_SERVER['DOCUMENT_ROOT']."/database/config.php";
        include $_SERVER['DOCUMENT_ROOT'].'/assets/header.php';
    ?>  
    <main>
        <p class="metka metka-another">Доставка</p>
        <div class="background">
            <div class="delivery-center">
                <p>Готовы доставить вам и вашим близким радость прямо сегодня!</p>
                <p>Обратите внимание, что минимальная сумма доставки состовляет <b>2500</b> руб.<br/>
                При заказе от <b>4000</b> руб. доставка <b>бесплатная</b>.<br/>
                Доставка может быть выполнена в заданные 3-х часовые интервалы 9:00-12:00, 12:00-15:00, 15:00-18:00, 18:00-21:00.<br/>
                На текущий день заказы принимаются до  20:00, заказы после 20:00  будут доставлены на следующий день в интервал 9:00-12:00.</p>
                <div class="map-center">
                <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Ae64e55bcadfa20fc61644394742666f0aaf853239968208e82109fd3abf441d6&amp;source=constructor" frameborder="1"></iframe>
                </div>
            </div>
        </div>
    </main>

    <?php 
        include $_SERVER['DOCUMENT_ROOT'].'/assets/footer.php';
    ?>  

    <script src="/script/jquery-3.6.0.min.js"></script>
    <script src="/script/animation/buttonsanimate.js"></script>
    <script src="/pages/js/pagginator.js"></script>
</body>
</html>