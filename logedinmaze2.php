<?php
    
    
    $file = fopen("users/tagok.txt","r");
    $oszt=fread($file,filesize("users/tagok.txt"));
    fclose($file);
    
    // kiírás
    $usertomb = explode("\r\n", $oszt);
    
    
    ?>


<!DOCTYPE html>
<meta charset="UTF-8">
    
    <html>
        <head>
            <title> Labirinth </title>
        </head>
        <body style="background-color:gold;">
            
            
           <canvas width="1000" height="500" id="canvas" style="border:1px solid red; position:absolute;">
                You can't play cause your browser doesn't support the HTML5 or JavaScript!'
            </canvas>
            
            <canvas width="500" height="500" id="canvas2" style="position:absolute">
                You can't play cause your browser doesn't support the HTML5 or JavaScript!'
            </canvas>
            
            
            
            <noscript>JavaScript is not enabled. To play the game, you should enable it.</noscript>
            <script src="logedinmaze2.js"> </script>
        
                           <div id="exit" style="position:fixed">
                    <button id="exit" onclick="location.href='bejelentkezve.php';" class="exit">
                        Exit
                    </button>
                    <link rel="stylesheet" type="text/css" href="cube.css" media="screen" />

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>






<form action="share.php" method="post">


<select name="teszt">
<?php foreach ($usertomb as $value) {echo "<option value=".$value.">".$value."</option>";} ?>
</select>
<?php $link = "//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
<input type="hidden" name="url" value="<?php echo $link ?>" />

<p><input type="submit" /></p>

</form>



</body>
</html>