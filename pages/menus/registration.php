<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
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
    <main class="lower">
        <p class="metka">Регистрация</p>
        <div class="background">
            <p class="alert__reg">Вход в аккаунт будет осуществляться через E-mail</p>
            <div class="reg__main">
                <form method="POST">
                    <div class="block">
                        <label>Фамилия Имя Отчество<p class="null">*</p><input name="reg_fio" onkeyup='checkReg()' class="reg__fio" type="text" onchange=""></label>
                        <div id="reg1" class="red"></div>
                    </div>
                    <div class="2 block">
                        <label>E-mail<p class="null">*</p><input name="reg_email" onkeyup='checkReg()' class="reg__email" type="email"></label>
                        <div id="reg2" class="red"></div>
                    </div>
                    <div class="3 block">
                        <label>Телефон<p class="null">*</p><input name="reg_phone" onkeyup='checkPhone()' class="reg__phone" placeholder="+7 (___) ___-__-__" type="text"></label>
                        <div id="reg3" class="red"></div>
                    </div>
                    <div class="4 block">
                        <label>Пароль<p class="null">*</p><input name="reg_pass" onkeyup='checkPass()' class="reg__pass" type="password"></label>
                        <div id="reg4" class="red"></div>
                    </div>
                    <div class="5 block">
                        <label>Подтверждение пароля<p class="null">*</p><input name="reg_repass" onkeyup='checkPass()' class="reg__repass" type="password"></label>
                        <div id="reg5" class="red red-height hidden">Пароль должен совпадать</div>
                    </div>
                    <input class="disable reg__button" disabled onmouseover="checkAll()"  type="submit" name="reg" value="Зарегестрироваться">
                </form>
                <?php
                    if (isset($_POST['reg'])){
                        $user = [];
                        if ($_POST['reg_pass'] == $_POST['reg_repass']){
                            global $pdo;
                            $pass = md5(md5($_POST['reg_pass']));
                            array_push($user, $_POST['reg_fio'], $_POST['reg_email'], $_POST['reg_phone'], $pass);
                            $pdo->query("INSERT INTO public.user (fio, login, phone, password) VALUES ('$user[0]', '$user[1]', '$user[2]', '$user[3]')");
                            echo '<script>window.location.href = "/pages/menus/auth.php"</script>';
                        }
                    }
                ?>
            </div>
        </div>
    </main>

    <?php 
        include $_SERVER['DOCUMENT_ROOT'].'/assets/footer.php';
    ?>  

    <script src="/script/jquery-3.6.0.min.js"></script>
    <script src="/script/jquery.maskedinput.min.js"></script>
    <script src="/script/animation/buttonsanimate.js"></script>
    <script src="/pages/js/pagginator.js"></script>
</body>
</html>