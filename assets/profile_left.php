<?php
include $_SERVER['DOCUMENT_ROOT']."/database/config.php";
global $pdo;
$fio = $pdo->query("SELECT fio FROM public.user WHERE password_cookie_token='".$_COOKIE['password_cookie_token']."'")->fetch(PDO::FETCH_ASSOC);
?>
<div class="story-order__left">
    <div class="story-order__user-name">
        <?=$fio['fio']?>
    </div>
    <div class="story-order__same">
        <a href="/pages/profile/orders.php">История заказов</a>
    </div>
    <div class="story-order__same">
        <a href="/pages/profile/addresses.php">Мой адрес</a>
    </div>
    <div class="story-order__same">
        <form method="POST">
            <input type="submit" class="story-exit" name="submit_story" value="Выйти из аккаунта"> 
        </form>
    </div>
</div>
