<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Условия оплаты</title>
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
        <p class="metka metka-another">Условия оплаты</p>
        <div class="background">
            <div class="how-buy__main">
                <p> 
                    К сожалению в данный момент, оплата происходит напрямую курьеру, при получении заказа. 
                    Оплатить заказ можно двумя способами: «Безналичныйми средствами» и «Наличными средствами».
                </p>
                <p class="how-buy__head">Безналичный расчёт</p>
                <p> 
                    У курьера будет с собой терминал оплаты, который принимает карты:
                    <ul>
                        <li>Visa;</li>
                        <li>MasterCard;</li>
                        <li>Maestro;</li>
                        <li>Visa Electron;</li>
                        <li>Мир;</li>
                        <li>Apple Pay;</li>
                        <li>Google Pay.</li>
                    </ul>
                </p>
                <p class="how-buy__head">Наличный расчёт</p>
                <p>
                    К оплате принимаются только рубли! Сдача прилагается.
                </p>
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