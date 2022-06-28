<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Как купить</title>
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
        <p class="metka metka-another">Как купить</p>
        <div class="background">
            <div class="how-buy__main">
                <p class="how-buy__head">Как оформить заказ</p>
                <p> 
                    Оформить заказ на нашем сайте легко. 
                    Просто добавьте выбранные товары в корзину, а затем перейдите на страницу Корзина, 
                    проверьте правильность заказанных позиций и 
                    нажмите кнопку «Оформить заказ» или «Быстрый заказ».
                </p>
                <p class="how-buy__head">Быстрый заказ</p>
                <p>
                    Функция «Быстрый заказ» позволяет покупателю не проходить всю процедуру оформления заказа самостоятельно. 
                    Вы заполняете форму, и через короткое время вам перезвонит менеджер магазина. 
                    Он уточнит все условия заказа, ответит на вопросы, касающиеся качества товара, его особенностей. 
                    А также подскажет о вариантах оплаты и доставки.
                <br/><br/>
                    По результатам звонка, пользователь либо, получив уточнения, самостоятельно оформляет заказ, 
                    укомплектовав его необходимыми позициями, либо соглашается на оформление в том виде, в котором есть сейчас. 
                    Получает подтверждение на почту или на мобильный телефон и ждёт доставки.
                </p>
                <p class="how-buy__head">Оформление заказа в стандартном режиме</p> 
                <p>Если вы уверены в выборе, то можете самостоятельно оформить заказ, заполнив по этапам всю форму.</p>
                <p class="how-buy__head">Оплата</p> 
                <p>Выберите оптимальный способ оплаты. Подробнее о всех вариантах читайте в разделе «<a href="/pages/another/howpurchase.php">Оплата</a>»</p> 
                <p class="how-buy__head">Покупатель</p> 
                <p>
                    Введите данные о себе: ФИО, адрес доставки, номер телефона. 
                    В поле «Комментарии к заказу» введите сведения, которые могут пригодиться курьеру, 
                    например: код домофона или номер квартиры.
                </p>
                <p class="how-buy__head">Оформление заказа</p>
                <p>
                    Проверьте правильность ввода информации: позиции заказа, выбор местоположения, данные о покупателе. 
                    Нажмите кнопку «Оформить заказ».
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