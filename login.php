<?php
	include('loginell.php');
	
	if ($bejelentkezve) {
		header('Location: bejelentkezve.php');
		exit();
	}
	// print_r($_POST);
	include("sio.php");
	//-------------------------
	$hibak = array();
	if ($_POST) {
		$felhnev = trim($_POST['felhnev']);
		$jelszo = $_POST['jelszo'];
		
		$tagok = betolt_adat('regadat.txt');
	
        
		if ($felhnev == '') {
			$hibak[] = 'A felhasználói név kötelező!';
		}
		if ($jelszo == '') {
			$hibak[] = 'A jelszó kötelező!';
		}
		if (!array_key_exists($felhnev, $tagok)) {
			$hibak[] = 'Hibás felhasználói név vagy jelszó!';
		}
		else {
			if (md5($_POST['jelszo']) != $tagok[$felhnev]['jelszo']) {
				$hibak[] = 'Hibás felhasználói név vagy jelszó!';
			}
		}
		
		if (!$hibak) {
			$_SESSION['azonositott'] = true;
			header('Location: bejelentkezve.php');
            $_SESSION['user'] = $felhnev;
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
		<ul>
		<?php foreach ($hibak as $hiba) : ?>
			<li><?php echo $hiba; ?></li>
		<?php endforeach;?>
		</ul>
<center>
    <form action="" method="post">
			<table >
				<tr>
					<td>Felhasználói név:</td>
					<td><input type="text" name="felhnev"></td>
				</tr>
				<tr>
					<td>Jelszó:</td>
					<td><input type="password" name="jelszo"></td>
				<tr>
					<td colspan = 2><input class="submit" type="submit" value="Belépés"></td>
				</tr>
			</table>
		</form>
</center>
		<p><a class="submit" href="index.php">Vissza</a></p>
	</body>
</html>