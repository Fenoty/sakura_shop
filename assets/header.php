<header>
    <div class="header-flex__main-container">
        <div>
            <a href="/pages/another/delivery.php" id="delivery-text">Доставка по Москве</a>
        </div>
        <div>
            <img id="logo" src="/img/sakura2.png" alt="Сакура">
        </div>
        <table id="elements">
            <tr>
                <td><img class="Search" src="/img/buttons/Search.svg"></td>
                <td><img class="ShoppingCart" src="/img/buttons/ShoppingCart.svg"></td>
                <td>
                    <?php
                        include $_SERVER['DOCUMENT_ROOT'].'/database/config.php';
                        global $pdo;
                        if (isset($_COOKIE['password_cookie_token'])) { 
                            $user=$pdo->query("SELECT * FROM public.user WHERE password_cookie_token='" . $_COOKIE["password_cookie_token"] . "'")->fetch(PDO::FETCH_ASSOC);
                            $name=mb_strtoupper(mb_substr($user['fio'],0,1)).mb_strtoupper(mb_substr(strstr($user['fio'],' '), 1, 1));
                            if (strlen($name)<2) {
                                echo '<div class="user_link">'.mb_strtoupper(mb_substr($user['fio'],0,1)).'</div>';
                            }
                            else{
                                echo '<div class="user_link">'.$name.'</div>';
                            }
                        }
                        else{
                            echo '<img class="User" src="/img/buttons/User.svg">';
                        }
                    ?>
                    <!-- <img class="User" src="/sakura/img/buttons/User.svg"> -->
                </td>
                
            </tr>
        </table>
    </div>
    
    <form action="/database/search.php" class="search-button__search hidden" method="get">
        <input name="search" class="search-button__input" autocomplete="off" type="text" placeholder="Что ищем?">
        <input type="submit" class="search-button__submit" value="Найти">
    </form>

    <div class="search-list hidden">
        
        <script>
            let search_input = document.querySelector(".search-button__input");
            let search_list = document.querySelector(".search-list"); 
            
   
            let url = '/assets/post_search.php';
            let formData = new FormData();

            search_input.addEventListener("keyup", () => {
                if (search_input.value !="") {
                    formData.append('x', search_input.value);
                    fetch(url, { method: 'POST', body: formData })
                    .then(function (response) {
                        return response.text();
                    })
                    .then(function (body) {
                        search_list.innerHTML = body;
                    });
                }
                else{
                    search_list.innerHTML = "";
                }
            });     
        </script> 
        <?php
            include $_SERVER['DOCUMENT_ROOT']."/assets/post_search.php";
        ?>

    </div>
    <script src="/script/jquery-3.6.0.min.js"></script>
</header>