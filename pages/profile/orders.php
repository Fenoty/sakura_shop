<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/chief-slider.css">
    <link rel="stylesheet" href="/style/animate.css">
    <link rel="shortcut icon" href="/img/sakurashortneutral.png" type="image/png">
</head>
<body>
    <?php 
        include $_SERVER['DOCUMENT_ROOT']."/database/config.php";
        include $_SERVER['DOCUMENT_ROOT'].'/assets/header.php';
        include $_SERVER['DOCUMENT_ROOT'].'/database/autharization.php';
    ?>  
    <main class="lower">
        <p class="metka">Мои заказы</p>
        <?php
            global $auth;
            $auth->ReturnToAuth();
            if (isset($_POST['submit_story'])) {
                $auth->deleteCookie();
            }
        ?>
        <div class="background">
            <div class="story-order__main">
                <?php include $_SERVER['DOCUMENT_ROOT']."/assets/profile_left.php"; ?>
                <div class="story-order__right">
                <?php
                    global $pdo;
                    if (isset($_COOKIE['password_cookie_token'])) {
                        $token = $_COOKIE['password_cookie_token'];
                        $user = $pdo->query("SELECT * FROM public.user WHERE password_cookie_token = '$token'")->fetch(PDO::FETCH_ASSOC);
                        foreach ($pdo->query("SELECT * FROM public.orders WHERE profile = '".$user['login']."' ORDER BY id DESC") as $row) {
                            echo '  <div class="story-order__elems">  
                                        <div class="story-order__id">
                                            <div class="story-left">Заказ №'.$row["id"].'</div>
                                            <div class="story-right">'.$row['date_order'].'</div>
                                        </div>';
                            $zapret = ['{','}'];
                            $id_goods = explode(',', str_replace($zapret, '' , $row['id_goods']));
                            $quantity = explode(',', str_replace($zapret, '' , $row['quantity']));
                            $h=0;
                            foreach ($id_goods as $id){
                                $goods = $pdo->query("SELECT * FROM public.goods WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
                                echo '
                                        <div class="story-order__name">
                                            <ul>
                                                <li>'.$goods["description"].' | '.$quantity[$h].'шт.</li>
                                            </ul>
                                        </div>
                                ';
                                $h+=1;
                            }
                            

                            echo '      <div class="story-order__price">Итого: <b>'.$row['total_price'].'</b></div>
                                    </div> ';
                        } 
                    }
                ?>
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