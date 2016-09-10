<?php
    
    $shareduser = $_POST['teszt'];
    $link = $_POST['url'];
    
    $file = fopen("users/".$shareduser.".txt", "a");
    fwrite($file,$link."\r\n");
    fclose($file);
    header('Location: bejelentkezve.php');
?>