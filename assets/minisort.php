<nav class="minisort">  
<div class="left-side">
<?php
function ifsearch($first, $rename){
    if (!isset($_GET['search'])) {
        echo 'href="'.$first.'"';
    }
    else{
        echo 'href="'.$rename.$_GET['search'].'"';
    }
}
$URL = $_SERVER['REQUEST_URI'];
$url = '';
if (isset($_POST['povod'])) {
    $url = '&price_at='.$_POST['price_at'].'&price_to='.$_POST['price_to'].'&povod='.$_POST['povod'].'&color='.$_POST['color'];
    
    if (isset($_GET['search'])) {
        echo "<script>document.location.href='?search=".$_GET['search']."&sort=description&order=ASC".$url."';</script>";
    }
    else{
        echo "<script>document.location.href='?page=1&sort=description&order=ASC".$url."';</script>";
    }
    
}
else{
    $url='';
}
minisort();

function checkingPovod($value){
    if (isset($_GET['povod']) && $_GET['povod']==$value) {
        return ' selected="selected" ';
    }
}
function checkingColor($value){
    if (isset($_GET['color']) && $_GET['color']==$value) {
        return ' selected="selected" ';
    }
}
function inputPriceAt(){
    if (isset($_GET['price_at'])) {
        echo ' value="'.$_GET['price_at'].'"';
    }
}
function inputPriceTo(){
    if (isset($_GET['price_to'])) {
        echo ' value="'.$_GET['price_to'].'"';
    }
}

$short_url = substr(strstr($URL, '.php', true), strlen('/pages/kategories/'));
switch ($short_url) {
    case "buket":
        $pagetype = 1;
        break;
    case "kompozitsii":
        $pagetype = 2;
        break;
    case "japanflowers":
        $pagetype = 3;
        break;
    case "roomflowers":
        $pagetype = 4;
        break;
    default:
        $pagetype = 1;
        break;
}

function checkTypeText($pagetype){
    switch ($pagetype) {
        case 1:
            echo 'Повод';
            break;
        case 2:
            echo 'Повод';
            break;
        case 3:
            echo 'Тип';
            break;
        case 4:
            echo 'Тип';
            break;
        default:
            echo 'Повод';
            break;
    }
}

function getPrice($sort){
    global $pagetype;
    global $pdo;
    switch ($sort) {
        case 'max':
            foreach($pdo->query("SELECT MAX(price) FROM goods WHERE typeofgood = '$pagetype'") as $max){
                echo $max['max']; 
             }
            break;
        case 'min':
            foreach($pdo->query("SELECT MIN(price) FROM goods WHERE typeofgood = '$pagetype'") as $min){
                echo $min['min']; 
            }
            break;
    }
}

function getPriceSearch($sort){
    $search_text = strtolower($_GET['search']);
    global $pdo;
    switch ($sort) {
        case 'max':
            foreach($pdo->query("SELECT MAX(price) FROM goods WHERE LOWER(description) LIKE '%$search_text%'") as $max){
                echo $max['max']; 
            }
            break;
        case 'min':
            foreach($pdo->query("SELECT MIN(price) FROM goods WHERE LOWER(description) LIKE '%$search_text%'") as $min){
                echo $min['min']; 
            }
            break;
    }
}

function ifSearchPrice($sort){

    if (isset($_GET['search'])) {
        echo getPriceSearch($sort);
    }
    else{
        echo getPrice($sort);
    }
}

?>
</div>
<div class="right-side">
    
    <form class="form-right" method="post">
        <div class=filter-price__flex>
            <div class="filter-price">
                <span class="filter-price__text">от</span>
                    <input <?php inputPriceAt() ?> type="number" data-min="0" data-max="<?php ifSearchPrice('max') ?>" placeholder="<?php ifSearchPrice('min') ?>" name="price_at" class="filter-price__input">
                <span class="filter-price__text">руб</span>
            </div>
            <div class="filter-price">
                <span class="filter-price__text">до</span>
                    <input <?php inputPriceTo() ?> type="number" data-min="0" data-max="<?php ifSearchPrice('max') ?>" placeholder="<?php ifSearchPrice('max') ?>" name="price_to" class="filter-price__input">
                <span class="filter-price__text">руб</span>
            </div>
        </div>
        <div class="selectors__flex">
            <div class="selectors">
                <label class="label-selector"><?=checkTypeText($pagetype)?></label>
                <select name="povod">
                    <option value="">Не выбрано</option>
                    <?php 
                        foreach ($pdo->query("SELECT DISTINCT povod FROM public.goods WHERE typeofgood = '$pagetype' ORDER BY povod") as $row) {
                            echo '<option '.checkingPovod($row['povod']).' value="'.$row['povod'].'">'.$row['povod'].'</option>';
                        }
                    ?>
                <select>
            </div>
            <div class="selectors">
                <label class="label-selector">Цвет</label>
                <select name="color">
                    <option value=''>Не выбрано</option>
                    <?php 
                        foreach ($pdo->query("SELECT DISTINCT color FROM public.goods WHERE typeofgood = '$pagetype' ORDER BY color") as $row) {
                            echo '<option '.checkingColor($row['color']).' value="'.$row['color'].'">'.$row['color'].'</option>';
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="buttons__flex">
            <a class="reset" <?php ifsearch('?page=1','?search=') ?>>Сбросить</a>
            <input type="submit" class="show" value="Показать">
        </div>
    </form>
</div>
</nav>
<?php 


function minisort(){
    $default_text = '';
    if (isset($_GET['search'])) {
        $default_text = 'search='.$_GET['search'];
    }
    else{
        $default_text = 'page='.$_GET['page'];
    }
    if (isset($_GET['povod'])) {
        if ($_GET['sort'] == 'description' && $_GET['order'] == 'DESC') {
            echo '<a href="?'.$default_text.'&sort=description&order=ASC&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'"><span>По алфавиту &#709;</span></a>'; 
        }
        else if ($_GET['sort'] == 'description' && $_GET['order'] == 'ASC') {
            echo '<a href="?'.$default_text.'&sort=description&order=DESC&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'"><span>По алфавиту &#708;</span></a>'; 
        }
        else {
            echo '<a href="?'.$default_text.'&sort=description&order=ASC&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'"><span>По алфавиту &#709;</span></a>';
        }
            
        // Цена 
        
        if ($_GET['sort'] == 'price' && $_GET['order'] == 'DESC') {
            echo '<a href="?'.$default_text.'&sort=price&order=ASC&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'"><span>По цене &#709;</span></a>'; 
        }
        else if ($_GET['sort'] == 'price' && $_GET['order'] == 'ASC') {
            echo '<a href="?'.$default_text.'&sort=price&order=DESC&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'"><span>По цене &#708;</span></a>'; 
        }
        else {
            echo '<a href="?'.$default_text.'&sort=price&order=ASC&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'"><span>По цене &#709;</span></a>';
        }
            
        
        // По наличию
        if ($_GET['sort'] == 'quantity' && $_GET['order'] == 'DESC') {
            echo '<a href="?'.$default_text.'&sort=quantity&order=ASC&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'"><span>По наличию &#709;</span></a>'; 
        }
        else if ($_GET['sort'] == 'quantity' && $_GET['order'] == 'ASC') {
            echo '<a href="?'.$default_text.'&sort=quantity&order=DESC&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'"><span>По наличию &#708;</span></a>'; 
        }
        else {
            echo '<a href="?'.$default_text.'&sort=quantity&order=ASC&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'"><span>По наличию &#709;</span></a>';
        }
    }
    elseif (isset($_GET['sort'])) {

        
        // Название

        if ($_GET['sort'] == 'description' && $_GET['order'] == 'DESC') {
            echo '<a href="?'.$default_text.'&sort=description&order=ASC"><span>По алфавиту &#709;</span></a>'; 
        }
        else if ($_GET['sort'] == 'description' && $_GET['order'] == 'ASC') {
            echo '<a href="?'.$default_text.'&sort=description&order=DESC"><span>По алфавиту &#708;</span></a>'; 
        }
        else {
            echo '<a href="?'.$default_text.'&sort=description&order=ASC"><span>По алфавиту &#709;</span></a>';
        }
            
        // Цена 

        if ($_GET['sort'] == 'price' && $_GET['order'] == 'DESC') {
            echo '<a href="?'.$default_text.'&sort=price&order=ASC"><span>По цене &#709;</span></a>'; 
        }
        else if ($_GET['sort'] == 'price' && $_GET['order'] == 'ASC') {
            echo '<a href="?'.$default_text.'&sort=price&order=DESC"><span>По цене &#708;</span></a>'; 
        }
        else {
            echo '<a href="?'.$default_text.'&sort=price&order=ASC"><span>По цене &#709;</span></a>';
        }
            

        // По наличию
        if ($_GET['sort'] == 'quantity' && $_GET['order'] == 'DESC') {
            echo '<a href="?'.$default_text.'&sort=quantity&order=ASC"><span>По наличию &#709;</span></a>'; 
        }
        else if ($_GET['sort'] == 'quantity' && $_GET['order'] == 'ASC') {
            echo '<a href="?'.$default_text.'&sort=quantity&order=DESC"><span>По наличию &#708;</span></a>'; 
        }
        else {
            echo '<a href="?'.$default_text.'&sort=quantity&order=ASC"><span>По наличию &#709;</span></a>';
        }
        }

    else {
        echo '<a href="?'.$default_text.'&sort=description&order=ASC"><span>По алфавиту &#709;</span></a>';
        echo '<a href="?'.$default_text.'&sort=price&order=ASC"><span>По цене &#709;</span></a>';
        echo '<a href="?'.$default_text.'&sort=quantity&order=ASC"><span>По наличию &#709;</span></a>';
    }
    
}


    
?>