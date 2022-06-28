<?php 
    include $_SERVER['DOCUMENT_ROOT']."/database/config.php";
    if (isset($_POST['array'])) {   
        global $pdo;
        $array = explode(',',$_POST['array']);
        $id = $array[0];
        $quant = $array[1];
        $count = $array[2];
        if (isset($_COOKIE['password_cookie_token'])) {
            $user = $pdo->query("SELECT * FROM public.user WHERE password_cookie_token = '".$_COOKIE['password_cookie_token']."'")->fetch(PDO::FETCH_ASSOC);
            $zapret = ['{','}'];
            $quant_goods = array_map('intval', explode(',', str_replace($zapret, '' , $user['cart_quantity'])));
            $id_goods = array_map('intval', explode(',', str_replace($zapret, '' , $user['cart_goods'])));
            
        }
        unset($quant_goods[$count]);
        unset($id_goods[$count]);
        $pdo->query("UPDATE public.user set cart_quantity = '{}', cart_goods = '{}' WHERE password_cookie_token = '".$_COOKIE['password_cookie_token']."'");
        foreach ($quant_goods as $key) {
            $pdo->query("UPDATE public.user set cart_quantity = array_append(cart_quantity, '$key') WHERE password_cookie_token = '".$_COOKIE['password_cookie_token']."'");
        }
        foreach ($id_goods as $key) {
            $pdo->query("UPDATE public.user set cart_goods = array_append(cart_goods, '$key') WHERE password_cookie_token = '".$_COOKIE['password_cookie_token']."'");
        }
    }