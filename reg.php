<?php
	include('loginell.php');
	
	if ($bejelentkezve) {
		header('Location: index.php');
		exit();
	}
	
	// print_r($_POST);
	include("sio.php");
	//-------------------------
	$hibak = array();
	if ($_POST) {
		$felhnev = trim($_POST['felhnev']);
		$jelszo = $_POST['jelszo'];
		$jelszo2 = $_POST['jelszo2'];
		$nev = trim($_POST['nev']);
		$cim = trim($_POST['cim']);
		
		$tagok = betolt_adat('regadat.txt');
		
		if ($felhnev == '') {
			$hibak[] = 'A felhasználói név kötelező!';
		}
		if ($jelszo == '') {
			$hibak[] = 'A jelszó kötelező!';
		}
		if ($jelszo != $jelszo2) {
			$hibak[] = 'A jelszavak nem egyeznek!';
		}
		if ($nev == '') {
			$hibak[] = 'A név kötelező!';
		}
		if ($cim == '') {
			$hibak[] = 'A cím kötelező!';
		}
        
        if (array_key_exists($felhnev, $tagok)) {
        $hibak[] = 'Már létezik ilyen felhasználói név!';
            
		}
		if (!$hibak) {
			$tagok[$felhnev] = array(
				'jelszo'		=> md5($jelszo),
				'nev'				=> $nev,
				'cim'				=> $cim,
			);
			fajlba_mentes('regadat.txt', $tagok);
            
            //-saját fájl létrehozás
            $filename = $felhnev;
            $ts=time();
            $t=date("Y-m-d",$ts);
        
                $file = fopen("users/".$filename.".txt", "a");
                //fwrite($file,);
                fclose($file);
            
                $file = fopen("users/tagok.txt", "a");
                fwrite($file,$felhnev."\r\n");
                fclose($file);
        

			header('Location: index.php');
			exit();
		}
	}
    
    
       

    
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body style="background-color:gold;">
<link rel="stylesheet" type="text/css" href="cube.css" media="screen" />
            <h2>Regisztráció</h2>
		
		<ul>
		<?php foreach ($hibak as $hiba) : ?>
			<li><?php echo $hiba; ?></li>
		<?php endforeach;?>
		</ul>
		<form action="" method="post">
			<table >
				<tr>
					<td>Felhasználói nev:</td>
					<td><input type="text" name="felhnev"></td>
				</tr>
				<tr>
					<td>Jelszó:</td>
					<td><input type="password" name="jelszo"></td>
				<tr>
				<tr>
					<td>Jelszó még egyszer:</td>
					<td><input type="password" name="jelszo2"></td>
				<tr>
				<tr>
					<td>Név:</td>
					<td><input type="text" name="nev"></td>
				<tr>
				<tr>
<td>e-mail:</td>
					<td><input type="text" name="cim"></td>
				<tr>
					<td colspan = 2><input class="submit" type="submit" value="Regisztráció"></td>
				</tr>
			</table>
			
		</form>
		<p><a class="submit" href="index.php">Vissza</a></p>
	</body>
</html>