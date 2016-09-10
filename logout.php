<?php
	include('loginell.php');
	unset($_SESSION['azonositott']);
	header('Location: index.php');
?>