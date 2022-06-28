<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Комнатные растения</title>
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
        <p class="metka">Комнатные растения</p>
            <?php 
                include $_SERVER['DOCUMENT_ROOT'].'/assets/minisort.php';
            ?>  
        <div class="background">
            <div id="goods-main">
                <?php 
                    include $_SERVER['DOCUMENT_ROOT']."/database/action.php";
                    SelectAllItemsOnPage(4);
                ?>  
            </div>
            <div class="pages-listing">
                <?php
                    PagesAdd(Total_pages(4));
                ?>
            </div>
        </div>
    </main>

    <?php 
        include $_SERVER['DOCUMENT_ROOT'].'/assets/footer.php';
    ?>  

    <script src="/script/jquery-3.6.0.min.js"></script>
    <script src="/script/animation/buttonsanimate.js"></script>
    <script src="../js/pagginator.js"></script>
</body>
</html>