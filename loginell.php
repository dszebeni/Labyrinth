<?php
	session_start();
	if($bejelentkezve = isset($_SESSION['azonositott']))
    {
        $fnev = $_SESSION['user'];
    }
    else
    {
        $fnev = "none";
    };
    
    
   
    

?>