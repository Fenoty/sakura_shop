<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сакура</title>
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
        <div class="container">
            <div class="slider">
              <div class="slider__container">
                <div class="slider__wrapper">
                  <div class="slider__items">
                    <div class="slider__item">
                        <div class="centered">
                            Букет для свидания<br>
                            <a href="/assets/item_name.php?id=10" class="button-slider">Выбрать</a>
                        </div>
                    </div>
                    <div class="slider__item">
                        <div class="centered">
                            Цвет страсти<br>
                            <a href="/pages/kategories/buket.php?page=1&sort=description&order=ASC&price_at=&price_to=&povod=0&color=Красный" class="button-slider">Выбрать</a>
                        </div>
                    </div>
                    <div class="slider__item">
                        <div class="centered">
                            Бонсай<br>
                            <a href="/pages/kategories/japanflowers.php?page=1" class="button-slider">Выбрать</a>
                        </div>
                    </div>
                    <div class="slider__item">
                        <div class="centered">
                            Композиции из цветов<br>
                            <a href="/pages/kategories/kompozitsii.php?page=1" class="button-slider">Выбрать</a>
                        </div>
                    </div>
                    <div class="slider__item">
                        <div class="top-left">
                            Мы в соцсетях<br>
                            <div class="about">
                                <table id="icons">
                                    <tr>
                                        <td><img src="img/slider/icons/telegram.svg" alt="Telegram"></td>
                                        <td><a href="tg://resolve?domain=fenoty">/tg-sakura-flowers</a></td>
                                    </tr>
                                    <tr>
                                        <td><img src="img/slider/icons/vk.svg" alt="vk"></td>
                                        <td><a href="https://vk.me/fenoty">/sakura-flowers</a></td>
                                    </tr>
                                    <tr>
                                        <td><img src="img/slider/icons/whatsapp.svg" alt="whatsapp"></td>
                                        <td>
                                            <a class="phone" href="https://api.whatsapp.com/send?phone=79163649292">8 916 364 92 92</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <a href="#" class="slider__control" data-slide="prev"></a>
              <a href="#" class="slider__control" data-slide="next"></a>
            </div>
        
        </div>
        <div id="category-main">
            <div class="background-category-block buket">
                <h2>Букеты</h2>
            </div>
            <div class="background-category-block kompozitsii">
                <h2>Композиции</h2>
            </div>
            <div class="background-category-block japanflowers">
                <h2>Бонсай</h2>
            </div>
            <div class="background-category-block roomflowers">
                <h2>Комнатные растения</h2>
            </div>
        </div>
        <p class="metka">НАШИ ПРЕДЛОЖЕНИЯ</p>
        <div class="background">
            <div id="goods-main">
                <div class="centering">
                    <?php 
                        include $_SERVER['DOCUMENT_ROOT'].'/database/action.php';
                        
                        SelectAllFromBD();
                    ?>  
                </div>
            </div>
        </div>
    </main>
    <?php 
        include $_SERVER['DOCUMENT_ROOT'].'/assets/footer.php';
        
    ?>  
    <script src="/script/chief-slider.js"></script>
    <script src="/script/animation/animate.js"></script>
    <script src="/script/index.js"></script>
    <script src="/script/animation/buttonsanimate.js"></script>
</body>
</html>