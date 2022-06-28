<?php 
    include $_SERVER['DOCUMENT_ROOT']."/database/config.php";
    if (isset($_POST['x'])) {
                
        global $pdo;
        $x = mb_strtolower($_POST['x']);
        foreach($pdo->query("SELECT * FROM public.goods WHERE LOWER(description) LIKE '%$x%' LIMIT 4") as $row) {
            echo '
            <div class="search-list__elements" onclick="location.href=`/assets/item_name.php?id='.$row['id'].'`;">
                    <img class="search-list__image" src="/img/goods/'.$row["image"].'" alt="">
                    <p class="search-list__name">'.$row["description"].'</p>
                    <p class="search-list__price">'.$row["price"].' руб.</p>
            </div>';
        }
    }