<?php
function SelectAllFromBD(){
    global $pdo;
    foreach($pdo->query("SELECT * FROM public.goods WHERE quantity > 0 ORDER BY id LIMIT 30") as $row) {
        if ($row['quantity'] == 0) {
            echo
            '<div class="goods-list" onclick="location.href=`/assets/item_name.php?id='.$row['id'].'`;">
                    <img onclick="location.href=`/assets/item_name.php?id='.$row['id'].'`;" src="/img/goods/'.$row["image"].'" alt="">
                    <a href="/assets/item_name.php?id='.$row['id'].'">'.$row["description"].'</a>
                    <p class="back-goods-price">'.$row["price"].' руб.</p>
                    <button class="zero-quantity">Нет в наличии</button>
                </div>';
        }
        else {
            echo
            '<div class="goods-list">
                    <img onclick="location.href=`/assets/item_name.php?id='.$row['id'].'`;" src="/img/goods/'.$row["image"].'" alt="">
                    <a href="/assets/item_name.php?id='.$row['id'].'">'.$row["description"].'</a>
                    <p class="back-goods-price">'.$row["price"].' руб.</p>
                    <button onclick="location.href=`/assets/item_name.php?id='.$row['id'].'`;" class="buy-flower">Купить</button>
                </div>';
        }
    }
}



function countRow($type){
    global $pdo;
    foreach($pdo->query("SELECT count(*) FROM public.goods WHERE typeofgood = '$type'") as $count) {
        return $count["count"];
    }
}

function Total_pages($type){
    global $pdo;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 20; 
    $offset = $limit * ($page - 1);
    if (isset($_GET['povod'])) {
        
        return countPagesOnSort($type);
    }
    else{
        $total_pages = ceil(countRow($type) / $limit);
        return $total_pages;  
    }
    
}


function countPagesOnSort($type){
    global $pdo;
    $povod = isset($_GET['povod']) ? $_GET['povod'] : '';
    $color = isset($_GET['color']) ? $_GET['color'] : '';
    $price_at = isset($_GET['price_at']) ? $_GET['price_at'] : 1;
    $price_to = isset($_GET['price_to']) ? $_GET['price_to'] : 999999;
    $zaprosForPages = "SELECT count(*) FROM public.goods WHERE typeofgood = '$type'";
    if ($color!='' && isset($_GET['color'])) {
        $zaprosForPages = $zaprosForPages." AND color = '".$color."'";
    }
    if ($povod!='' && isset($_GET["povod"])) {
        $zaprosForPages = $zaprosForPages." AND povod = '".$povod."'";
    }
    if (!$price_at=='') {
        $zaprosForPages = $zaprosForPages." AND price >= ".$price_at;
    }
    if (!$price_to=='') {
        $zaprosForPages = $zaprosForPages." AND price <= ".$price_to;
    }
    foreach($pdo->query($zaprosForPages) as $count) {
        $countSort =  $count["count"];
    }
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 20; 
    $offset = $limit * ($page - 1);
    $total_pages = ceil($countSort / $limit);
    return $total_pages;
}

function GoodsNull($zapros){
    global $pdo;
    foreach($pdo->query($zapros) as $count) {
        $c = intval($count["count"])+1;
        
    }
    return $c;
}

function SelectAllItemsOnPage($type){
    global $pdo;

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 20; 
    $offset = $limit * ($page - 1);
    $total_pages = ceil(countRow($type) / $limit);

    $attribute = isset($_GET['sort']) ? $_GET['sort'] : 'id';
    $sort = isset($_GET['order']) ? $_GET['order'] : 'ASC';
    $povod = isset($_GET['povod']) ? $_GET['povod'] : '';
    $color = isset($_GET['color']) ? $_GET['color'] : '';
    $price_at = isset($_GET['price_at']) ? $_GET['price_at'] : 1;
    $price_to = isset($_GET['price_to']) ? $_GET['price_to'] : 999999;

    $zaprosForPages = "SELECT count(*) FROM public.goods WHERE typeofgood = '$type'";
    $zapros = "SELECT * FROM public.goods WHERE typeofgood = '$type'";
    if ($color!='' && isset($_GET['color'])) {
        $zapros = $zapros." AND color = '".$color."'";
        $zaprosForPages = $zaprosForPages." AND color = '".$color."'";
    }
    if ($povod!='' && isset($_GET["povod"])) {
        $zapros = $zapros." AND povod = '".$povod."'";
        $zaprosForPages = $zaprosForPages." AND povod = '".$povod."'";
    }
    if (!$price_at=='') {
        $zapros = $zapros." AND price >= ".$price_at;
        $zaprosForPages = $zaprosForPages." AND price >= ".$price_at;
    }
    if (!$price_to=='') {
        $zapros = $zapros." AND price <= ".$price_to;
        $zaprosForPages = $zaprosForPages." AND price <= ".$price_to;
    }
    foreach($pdo->query($zaprosForPages) as $count) {
        $len = $count["count"];
    }
    if ($len == 0) {
        echo '<div class="goods-null">Товары по заданным фильтрам не найдены :(</div>';
    }
    elseif (isset($_GET['povod'])) {
        // echo $zapros." ORDER BY $attribute $sort LIMIT $limit OFFSET $offset";
        foreach($pdo->query($zapros." ORDER BY $attribute $sort LIMIT $limit OFFSET $offset") as $row) {
            if ($row['quantity'] < 1) {
                echo 
                '<div class="goods-list">
                        <img onclick="location.href=`/assets/item_name.php?id='.$row['id'].'`;" src="/img/goods/'.$row["image"].'" alt="">
                        <a href="/assets/item_name.php?id='.$row['id'].'">'.$row["description"].'</a>
                        <p class="back-goods-price">'.$row["price"].' руб.</p>
                        <button class="zero-quantity">Нет в наличии</button>
                    </div>';
            }
            else {
                echo 
                '<div class="goods-list">
                        <img onclick="location.href=`/assets/item_name.php?id='.$row['id'].'`;" src="/img/goods/'.$row["image"].'" alt="">
                        <a href="/assets/item_name.php?id='.$row['id'].'">'.$row["description"].'</a>
                        <p class="back-goods-price">'.$row["price"].' руб.</p>
                        <button onclick="location.href=`/assets/item_name.php?id='.$row['id'].'`;" class="buy-flower">Купить</button>
                    </div>';
            }
            
        }
    }
    else {
      foreach($pdo->query("SELECT * FROM public.goods WHERE typeofgood = '$type' ORDER BY $attribute $sort LIMIT $limit OFFSET $offset") as $row) {
        if ($row['quantity'] == 0) {
            echo
            '<div class="goods-list">
                    <img onclick="location.href=`/assets/item_name.php?id='.$row['id'].'`;" src="/img/goods/'.$row["image"].'" alt="">
                    <a href="/assets/item_name.php?id='.$row['id'].'">'.$row["description"].'</a>
                    <p class="back-goods-price">'.$row["price"].' руб.</p>
                    <button class="zero-quantity">Нет в наличии</button>
                </div>';
        }
        else {
            echo
            '<div class="goods-list">
                    <img onclick="location.href=`/assets/item_name.php?id='.$row['id'].'`;" src="/img/goods/'.$row["image"].'" alt="">
                    <a href="/assets/item_name.php?id='.$row['id'].'">'.$row["description"].'</a>
                    <p class="back-goods-price">'.$row["price"].' руб.</p>
                    <button onclick="location.href=`/assets/item_name.php?id='.$row['id'].'`;" class="buy-flower">Купить</button>
                </div>';
        }
    }  
    }
    
}

function PagesAdd($total){
    if ($total>1) {
    
        global $pdo; 
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
            if (isset($_GET['povod'])) {
                if ($page>1) {
                    echo '<a class="pages" href="?page='.($page - 1).'&sort='.$_GET['sort'].'&order='.$_GET['order'].'&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'"><</a>';
                }
                for ($i=1; $i < $total+1; $i++) { 
                    echo '<a class="pages" value ="'.$i.'"href="?page='.$i.'&sort='.$_GET['sort'].'&order='.$_GET['order'].'&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'">'.$i.'</a>';
                } 
                if ($page<$total) {
                    echo '<a class="pages" href="?page='.($page + 1).'&sort='.$_GET['sort'].'&order='.$_GET['order'].'&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'">></a>';
                }
            }
            elseif (isset($_GET['sort'])) {
                if ($page>1) {
                    echo '<a class="pages" href="?page='.($page - 1).'&sort='.$_GET['sort'].'&order='.$_GET['order'].'"><</a>';
                }
                for ($i=1; $i < $total+1; $i++) { 
                    echo '<a class="pages" value ="'.$i.'"href="?page='.$i.'&sort='.$_GET['sort'].'&order='.$_GET['order'].'">'.$i.'</a>';
                } 
                if ($page<$total) {
                    echo '<a class="pages" href="?page='.($page + 1).'&sort='.$_GET['sort'].'&order='.$_GET['order'].'">></a>';
                }
            }
            
            else {
                if ($page>1) {
                    echo '<a class="pages" href="?page='.($page - 1).'"><</a>';
                }
                for ($i=1; $i < $total+1; $i++) { 
                    echo '<a class="pages" value ="'.$i.'"href="?page='.$i.'">'.$i.'</a>';
                } 
                if ($page<$total) {
                    echo '<a class="pages" href="?page='.($page + 1).'">></a>';
                }
            }
        
    }
}

function search_goods(){
    global $pdo;
    $search_text = mb_strtolower($_GET['search']);
    $attribute = isset($_GET['sort']) ? $_GET['sort'] : 'id';
    $sort = isset($_GET['order']) ? $_GET['order'] : 'ASC';
    if (isset($_GET['povod'])) {
        $povod = isset($_GET['povod']) ? $_GET['povod'] : '';
        $color = isset($_GET['color']) ? $_GET['color'] : '';
        $price_at = isset($_GET['price_at']) ? $_GET['price_at'] : 1;
        $price_to = isset($_GET['price_to']) ? $_GET['price_to'] : 999999;
        $zaprosForSearch = "";
        if ($color!='' && isset($_GET['color'])) {
            $zaprosForSearch = $zaprosForSearch." AND color = '".$color."'";
        }
        if ($povod!='' && isset($_GET["povod"])) {
            $zaprosForSearch = $zaprosForSearch." AND povod = '".$povod."'";
        }
        if (!$price_at=='') {
            $zaprosForSearch = $zaprosForSearch." AND price >= ".$price_at;
        }
        if (!$price_to=='') {
            $zaprosForSearch = $zaprosForSearch." AND price <= ".$price_to;
        }
    }
    //проверка существования товара
    if (isset($_GET['povod']) && isset($_GET['search'])) {
        foreach($pdo->query("SELECT count(*) FROM public.goods WHERE LOWER(description) LIKE '%$search_text%' $zaprosForSearch") as $count) {
            $countStr =  $count["count"];
        }
        if ($countStr < 1) {
            echo '<div class="goods-null null-atr">Товара(ов) по заданным фильтрам не найдены :(</div>';
        }
        else{
            foreach($pdo->query("SELECT * FROM public.goods WHERE LOWER(description) LIKE '%$search_text%' $zaprosForSearch ORDER BY $attribute $sort") as $row) {
                if ($row['quantity'] == 0) {
                    echo
                    '<div class="goods-list">
                            <img onclick="location.href=`/assets/item_name.php?id='.$row['id'].'`;" src="/img/goods/'.$row["image"].'" alt="">
                            <a href="/assets/item_name.php?id='.$row['id'].'">'.$row["description"].'</a>
                            <p class="back-goods-price">'.$row["price"].' руб.</p>
                            <button class="zero-quantity">Нет в наличии</button>
                        </div>';
                }
                else {
                    echo
                    '<div class="goods-list">
                            <img onclick="location.href=`/assets/item_name.php?id='.$row['id'].'`;" src="/img/goods/'.$row["image"].'" alt="">
                            <a href="/assets/item_name.php?id='.$row['id'].'">'.$row["description"].'</a>
                            <p class="back-goods-price">'.$row["price"].' руб.</p>
                            <button onclick="location.href=`/assets/item_name.php?id='.$row['id'].'`;" class="buy-flower">Купить</button>
                        </div>';
                }
            }  
        }
    }
    elseif (isset($_GET['search']) && !isset($_GET['povod'])) {
        foreach($pdo->query("SELECT count(*) FROM public.goods WHERE LOWER(description) LIKE '%$search_text%'") as $count) {
            $countStr =  $count["count"];
        }
        if ($countStr < 1) {
            echo '<div class="goods-null null-atr">Товара(ов) с таким названием не найдено :(</div>';
        }
        else{
            foreach($pdo->query("SELECT * FROM public.goods WHERE LOWER(description) LIKE '%$search_text%' ORDER BY $attribute $sort") as $row) {
                if ($row['quantity'] == 0) {
                    echo
                    '<div class="goods-list">
                            <img onclick="location.href=`/assets/item_name.php?id='.$row['id'].'`;" src="/img/goods/'.$row["image"].'" alt="">
                            <a href="/assets/item_name.php?id='.$row['id'].'">'.$row["description"].'</a>
                            <p class="back-goods-price">'.$row["price"].' руб.</p>
                            <button class="zero-quantity">Нет в наличии</button>
                        </div>';
                }
                else {
                    echo
                    '<div class="goods-list">
                            <img onclick="location.href=`/assets/item_name.php?id='.$row['id'].'`;" src="/img/goods/'.$row["image"].'" alt="">
                            <a href="/assets/item_name.php?id='.$row['id'].'">'.$row["description"].'</a>
                            <p class="back-goods-price">'.$row["price"].' руб.</p>
                            <button onclick="location.href=`/assets/item_name.php?id='.$row['id'].'`;" class="buy-flower">Купить</button>
                        </div>';
                }
            }  
        }
        
    }
}

?>