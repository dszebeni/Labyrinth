<?php
 include('loginell.php');
  
    
?>
<!DOCTYPE html>
<meta charset="UTF-8">

<html>
<head>
<title> Labirynth </title>
</head>
<body style="background-color:gold;">
<b><center>Légy üdvözölve Minothaurus labitrintusában. </center></b>
<br><center>Válassz egy útvesztőt és éld túl a kalandot Thészeusszal!</center></br>
<center>
Üdvözöllek: <?php echo $fnev  ?>
</center>


<link rel="stylesheet" type="text/css" href="cube.css" media="screen" />


<br></br>
<br></br>
<br></br>
<br></br>
<br></br>




<center>
<table style="width:300px">
<tr>
<td><b>Saját pályák </b></td>
<td><b>Megosztott pályák</b></td>
</tr>
<tr>
<td>
<a href="logedinmaze1.php"><img src="http://localhost/bead/land1.gif"></a>
<a href="logedinmaze2.php"><img src="http://localhost/bead/land2.gif"></a>
<a href="logedinmaze3.php"><img src="http://localhost/bead/land3.gif"></a>
</td>
<td>
<?php
    

    $file = fopen("users/".$fnev.".txt", "a+");
    $ucim="users/".$fnev.".txt";
   
    $stars = fread($file, filesize($ucim));
    fclose($file);
    
    $starstomb = explode("\r\n", $stars);
    foreach ($starstomb as $nev){
        echo "<a href=".$nev.">".$nev."</a><br>";
        
    }

?>
</td>
</tr>
</table>
<center>

<a class="reg" href="logout.php">Kijelentkezés</a>



</body>
</html>
