<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформление заказа</title>
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
        global $setval;
        global $auth;
        $auth->ReturnToAuth();
    ?>  
    <main class="lower">
        <p class="metka">Оформление заказа</p>
        <div class="background">
            <div class="cart__main">
                <div class="cart__left">
                    <div class="cart__title">Ваши данные</div>
                    <form class="cart__flex" method="POST">
                        <div class="block">
                            <label>Имя<input name="cart_name" type="text" value="<?=$setval->checkFio()?>"></label>
                        </div>
                        <div class="block">
                            <label>E-mail<input name="cart_email" type="text" value="<?=$setval->checkEmail()?>"></label>
                        </div>
                        <div class="block">
                            <label>Мобильный телефон<input name="cart_phone" type="text" value="<?=$setval->checkPhone()?>"></label>
                        </div>
                        <div class="block">
                            <label>Адрес<input name="cart_address" type="text" value="<?=$setval->checkAddress()?>"></label>
                        </div>
                        <input class="cart__button" type="submit" name="get_order" value="Оформить заказ">
                    </form>
                </div>
                <div class="cart__right">
                    <?php
                    global $pdo;
                    global $setval;
                    $cart_goods = $pdo->query("SELECT * FROM public.user WHERE password_cookie_token = '".$_COOKIE['password_cookie_token']."'")->fetch(PDO::FETCH_ASSOC);
                    if ($cart_goods['cart_goods'] == '{}' || $cart_goods['cart_goods'] == '') {
                        echo '
                        <div class="cart__empty">
                            <p>Ваша корзина пуста<br/>
                            <a href="/index.php">Нажмите здесь</a>, чтобы продолжить покупки</p>
                        </div>';
                    }
                    else{
                        foreach($pdo->query("SELECT * FROM public.user WHERE password_cookie_token = '".$_COOKIE['password_cookie_token']."'") as $row) {
                        $zapret = ['{','}'];
                        $array_id = explode(',', str_replace($zapret, '' , $row['cart_goods']));
                        $array_quantity = explode(',', str_replace($zapret, '' , $row['cart_quantity']));
                        $field_quantity ='{'.implode(",",$array_quantity).'}';
                        $field_id = '{'.implode(",",$array_id).'}';
                        $i=0;
                        $total_price = 0;
                        foreach ($array_id as $elem){
                            $goods=$pdo->query("SELECT * FROM public.goods WHERE id = $elem")->fetch(PDO::FETCH_ASSOC);
                            echo '
                                <div class="cart__goods-list">
                                    <img class="cart__good-image" onclick="location.href=`/assets/item_name.php?id='.$goods['id'].'`;" src="/img/goods/'.$goods["image"].'" alt="">
                                    <div class="cart__good-name" onclick="location.href=`/assets/item_name.php?id='.$goods['id'].'`;">'.$goods["description"].'</div>
                                    <div class="cart__good-count">'.$setval->ifvaluemore($goods['id'],$array_quantity[$i]).' шт.</div>
                                    <div class="cart__good-price">'.$goods["price"].' руб.</div>
                                    <div class="cart__delete-back" name="'.$goods['id'].','.$array_quantity[$i].','.$i.'">&times;</div>
                                </div>
                                ';
                            $total_price+=$goods['price']*$array_quantity[$i];
                            $i+=1;
                        }
                        
                    }
                        if ($total_price>4000){$del=0;}else{$del=500;}
                        $tot = $total_price+$del;
                        echo '
                        <div class="cart__itogo">
                            <div class="cart__goods-price"><div class="text">Товары:</div><div class="text-text">'.$total_price.' руб.</div></div>
                            <div class="cart__goods-price"><div class="text">Доставка:</div><div class="text-text">'.$del.' руб.</div></div>
                            <div class="cart__total-price"><div class="text">Итого:</div><div class="text-text">'.$tot,' руб.</div></div>
                        </div>
                        ';
                    }
                    if (isset($_POST['get_order']) && isset($_COOKIE['password_cookie_token']) && !empty($array_id)) {
                        $date = date("Y-m-d");
                        $user = $pdo->query("SELECT * FROM public.user WHERE password_cookie_token = '".$_COOKIE['password_cookie_token']."'")->fetch(PDO::FETCH_ASSOC);
                        $date = date("Y-m-d");
                        $login = $user['login'];
                        $name = $_POST['cart_name']='' ? $_POST['cart_name'] : $user['fio'];
                        $email = $_POST['cart_email']='' ? $_POST['cart_email'] : $user['login'];
                        $phone = $_POST['cart_phone']='' ? $_POST['cart_phone'] : $user['phone'];
                        $address = ($_POST['cart_address']='' ? $_POST['cart_address'] : $user['address']) ? $user['address'] : '';
                        $pdo->query("INSERT INTO public.orders (profile, fio, email, phone, date_order, address, id_goods, quantity, total_price) VALUES ('$login','$name','$email','$phone','$date','$address','$field_id','$field_quantity',$tot)");
                        $g=0;
                        foreach ($array_id as $element){
                            $goods=$pdo->query("UPDATE public.goods SET quantity=quantity-$array_quantity[$g] WHERE id = $element");
                            $g+=1;
                        }
                        $pdo->query("UPDATE public.user SET cart_goods='{}', cart_quantity='{}' WHERE password_cookie_token = '".$_COOKIE['password_cookie_token']."'");
                        global $setval;
                        $setval->SendMail($name, $array_id, $email, $array_quantity);
                        echo '<script>window.location.href = "/assets/was_order.php";</script>';
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