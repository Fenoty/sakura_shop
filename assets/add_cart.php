<?php 
    include $_SERVER['DOCUMENT_ROOT'].'/database/config.php';
    if (isset($_POST['count']) && isset($_POST['good_id'])) {  
        if (isset($_COOKIE['password_cookie_token'])) {
            global $pdo;
            
            $good_id = $_POST['good_id'];
            $amount = $_POST['count'];

            $pdo->query("UPDATE public.user set cart_goods = array_append(cart_goods, '$good_id'), cart_quantity = array_append(cart_quantity, '$amount') WHERE password_cookie_token = '".$_COOKIE['password_cookie_token']."'");
        }   
    }