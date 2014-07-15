<?php

session_start();

if(!isset($_SESSION['sessionRole'])){

	header("location:index.php");

}

$sessionRole = $_SESSION['sessionRole'];
$sessionRoleStudio = $_SESSION['sessionRoleStudio'];
$sessionKungFuStatus = $_SESSION['statusSession'];
$sessionKungFuRank = $_SESSION['rankSession'];
$sessionKungFuRankDate = $_SESSION['rankDateSession'];
$sessionTaiChiStatus = $_SESSION['taiChiStatusSession'];
$sessionTaiChiRank = $_SESSION['TaiChiRankSession'];
$sessionTaiChiRankDate = $_SESSION['TaiChiRankDateSession'];

?>