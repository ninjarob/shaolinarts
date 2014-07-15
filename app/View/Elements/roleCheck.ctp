<?php
	if($sessionRole=='student'){
		unset($_SESSION['sessionRole']);
		header("location:index.php");
	}
?>