<?php 
    include $_SERVER['DOCUMENT_ROOT']."/database/config.php";
    if (isset($_POST['email'])) {   
        $count_emails='';   
        global $pdo;
        foreach($pdo->query("SELECT * FROM public.user WHERE login LIKE '".$_POST['email']."' LIMIT 4") as $row) {
            $count_emails=$row['login'];
        }
        if (strlen($count_emails) > 1) {
            echo 'E-mail занят';
        }
        else{
            $count_emails = $_POST['email'];
            echo $count_emails;
        }
        
    }