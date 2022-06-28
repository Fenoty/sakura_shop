<?php
include $_SERVER['DOCUMENT_ROOT'] . "/database/config.php";
class AuthClass
{

    //пользователь авторизирован уже?
    public function isAuth()
    {
        if (isset($_COOKIE["is_auth"])) { //Если сессия существует
            return $_COOKIE["is_auth"]; //Возвращаем значение переменной сессии is_auth (хранит true если авторизован, false если не авторизован)
        } else return false; //Пользователь не авторизован, т.к. переменная is_auth не создана
    }

    //авторизация по паролю
    public function auth($login, $password)
    {
        global $pdo;
        foreach ($pdo->query("SELECT * FROM public.user WHERE login = '$login'") as $row) {
            if ($row['login'] == $login && $row['password'] == md5(md5($password))) {
                $_COOKIE["is_auth"] = true; //Делаем пользователя авторизованным
                $_COOKIE["login"] = $login; //Записываем в сессию логин пользователя
                return true;
            } else { //Логин и пароль не подошел
                $_COOKIE["is_auth"] = false;
                return false;
            }
        }
    }
    //получить логин
    // public function getLogin()
    // {
    //     global $pdo;
    //     if (isset($_COOKIE['password_cookie_token'])) { 
    //         $user=$pdo->query("SELECT * FROM public.user WHERE password_cookie_token='" . $_COOKIE["password_cookie_token"] . "'")->fetch(PDO::FETCH_ASSOC);
    //         echo '<div class="shop_cart">'.mb_substr($user['fio'],0,1).'</div>';
    //     }
    //     else{
    //         echo '<img class="User" src="/img/buttons/User.svg">';
    //     }
    // }

    //Выход из сессии
    public function out()
    {
        $_COOKIE = array(); //Очищаем сессию
    }

    //добавление куки
    public function setCookie($login, $password)
    {
        global $pdo;
        $password_cookie_token = md5($login . $password . time());
        //Добавляем созданный токен в базу данных
        $update_password_cookie_token = $pdo->query("UPDATE public.user SET password_cookie_token ='$password_cookie_token' WHERE login = '$login'");

        if (!$update_password_cookie_token) {
            // Сохраняем в сессию сообщение об ошибке. 
            $_SESSION["error_messages"] = "<p class='mesage_error' >Ошибка функционала 'запомнить меня'</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: /pages/menus/auth.php");

            //Останавливаем скрипт
            exit();
        }

        setcookie("password_cookie_token", $password_cookie_token, time() + 36000, '/');
    }
    //удаление куки
    public function deleteCookie()
    {
        if (isset($_COOKIE["password_cookie_token"])) {
            global $pdo;
            //Очищаем поле password_cookie_token из базы данных
            $update_password_cookie_token = $pdo->query("UPDATE public.user SET password_cookie_token = '' WHERE password_cookie_token = '" . $_COOKIE["password_cookie_token"] . "'");

            //Удаляем куку password_cookie_token
            setcookie("password_cookie_token", null, time() - 36000, '/');
            header("Location: /index.php");
        } else {
            header("Location: /index.php");
        }
    }

    public function IsCookie()
    {
        if (isset($_COOKIE["password_cookie_token"])) {
            global $pdo;
            $array = $pdo->query("SELECT * FROM public.user WHERE password_cookie_token = '" . $_COOKIE["password_cookie_token"] . "'")->fetch(PDO::FETCH_ASSOC);
            if (!empty($array['password_cookie_token'])) {
                header("Location: /pages/profile/orders.php");
            }
        }
    }
    public function ReturnToAuth()
    {
        if (!isset($_COOKIE["password_cookie_token"])) {
            header("Location: /pages/menus/auth.php");
        }
    }
    public function IfNotAuthCart()
    {
        if (!isset($_COOKIE["password_cookie_token"])) {
            return 'onclick="window.location.href=`/pages/menus/auth.php`"';
        }
    }
}

$auth = new AuthClass();

class Profile
{
    public function addAddress()
    {
        global $pdo;
        $address = $pdo->query("SELECT address FROM public.user WHERE password_cookie_token = '" . $_COOKIE["password_cookie_token"] . "'")->fetch(PDO::FETCH_ASSOC);
        if (empty($address['address'])) {
            echo '
            <div class="story-order__address-add">Добавление адреса</div>
            <form class="add-flex" method="POST">
                <div class="block upper-block">
                    <label>Нас. пункт<input name="punct" type="text"></label>
                </div>
                <div class="block upper-block">
                    <label>Улица<input name="st" type="text"></label>
                </div>
                <div class="block upper-block">
                    <label>Дом<input name="hou" type="text"></label>
                </div>
                <div class="block upper-block">
                    <label>Подъезд<input name="pod" type="text"></label>
                </div>
                <div class="block upper-block">
                    <label>Квартира/офис<input name="kv" type="text"></label>
                </div>
                <div class="block upper-block">
                    <label>Этаж<input name="etaj" type="text"></label>
                </div>
                <div class="block upper-block">
                    <label>Код домофона<input name="kod" type="text"></label>
                </div>
                <input class="address-button" type="submit" name="add_address" value="Добавить">
            </form>
            ';
            if (isset($_POST['add_address'])) {
                $address_name = $_POST['punct'] . ', ул. ' . $_POST['st'] . ', д. ' . $_POST['hou'] . ', подъезд ' . $_POST['pod'] . ', кв. ' . $_POST['kv'] . ', этаж ' . $_POST['etaj'] . ', код домофона ' . $_POST['kod'];
                $pdo->query("UPDATE public.user SET address = '$address_name' WHERE password_cookie_token = '" . $_COOKIE["password_cookie_token"] . "'");
                echo '<script>window.location.href="/pages/profile/addresses.php";</script>';
            }
        } else {
            echo '
            <div class="story-order__address-have">
                <div class="story-order__address-have-title">Ваш адрес:</div>
                <div class="story-order__address-have-name">' . $address['address'] . '</div>
                <form method="POST">
                <input type="submit" class="address-button margin-button" name="delete_address" value="Удалить адрес">
                <form>
            </div>';
            if (isset($_POST['delete_address'])) {
                $pdo->query("UPDATE public.user SET address = '' WHERE password_cookie_token = '" . $_COOKIE["password_cookie_token"] . "'");
                echo '<script>window.location.href="/pages/profile/addresses.php";</script>';
            }
        }
    }
}

$profile = new Profile();

class SetVal
{
    public function checkFio()
    {
        global $pdo;
        $val = $pdo->query("SELECT fio FROM public.user WHERE password_cookie_token = '" . $_COOKIE["password_cookie_token"] . "'")->fetch(PDO::FETCH_ASSOC);
        if (isset($_COOKIE["password_cookie_token"])) {
            echo $val['fio'];
        } else {
            echo '';
        }
    }
    public function checkEmail()
    {
        global $pdo;
        $val = $pdo->query("SELECT login FROM public.user WHERE password_cookie_token = '" . $_COOKIE["password_cookie_token"] . "'")->fetch(PDO::FETCH_ASSOC);
        if (isset($_COOKIE["password_cookie_token"])) {
            echo $val['login'];
        } else {
            echo '';
        }
    }
    public function checkPhone()
    {
        global $pdo;
        $val = $pdo->query("SELECT phone FROM public.user WHERE password_cookie_token = '" . $_COOKIE["password_cookie_token"] . "'")->fetch(PDO::FETCH_ASSOC);
        if (isset($_COOKIE["password_cookie_token"])) {
            echo $val['phone'];
        } else {
            echo '';
        }
    }
    public function checkAddress()
    {
        global $pdo;
        $val = $pdo->query("SELECT address FROM public.user WHERE password_cookie_token = '" . $_COOKIE["password_cookie_token"] . "'")->fetch(PDO::FETCH_ASSOC);
        if (isset($_COOKIE["password_cookie_token"])) {
            echo $val['address'];
        } else {
            echo '';
        }
    }
    public function SendMail($fio, $array_id, $email, $quantity)
    {
        global $pdo;

        $message = "Добрый день, $fio!\n";
        $message .= "<br>";
        $message .= "Ваш заказ обрабатывается и вскоре мы с вами свяжемся.<br><br>";
        $message .= "Ваш заказ: <br>";
        $i=0;
        foreach ($array_id as $key) {
            $good = $pdo->query("SELECT * FROM public.goods WHERE id = $key")->fetch(PDO::FETCH_ASSOC);
            $total+=$good['price']*$quantity[$i];
            $message .= 
            "<br> - Название: " . $good['description'] . 
            " <br>---Цена за 1 товар: " . $good['price']." руб. 
            <br>---Количество: ".$quantity[$i]."шт. 
            <br>---Всего: ".$good['price']*$quantity[$i]." руб.<br>";  
            $i+=1;
        }
        $message .= "<br>";
        $message .= "\n - - - - - - - - - - - - - \n<br>";
        if ($total<4000) {
            $message .= "<b>Доставка: 500 руб.</b><br>";
            $total+=500;
        }
        else{
            $message .= "<b>Доставка: 0 руб.</b><br>";
        }
        $message .= "<b>Итого: ".$total."</b><br>";
        $message .= "\n - - - - - - - - - - - - - \n";
        $message .= "<br><br>";
        $message .= "С Уважением интернет-магазин «Сакура»\n";
        $message .= "<br>";
        $message .= "Контакты для связи с нами\n";
        $message .= "<br>";
        $message .= "E-mail: sakura-flowwwers@gmail.com\n";
        $message .= "<br>";
        $message .= "Телефон: +7 (916) 364-92-92";

        $headers  = "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: sakura-flowwwers@gmail.com\r\n";
        $headers .= "Reply-To: sakura-flowwwers@gmail.com\r\n";

        mail($email, 'Заказ оформлен', $message, $headers);
    }

    public function ifvaluemore($id, $amount)
    {
        global $pdo;
        $goods = $pdo->query("SELECT * FROM public.goods WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
        if ($goods['quantity'] < $amount) {
            return $goods['quantity'];
        } else {
            return $amount;
        }
    }
}

$setval = new SetVal();
