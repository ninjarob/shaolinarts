<?php
// session_start();
// if(isset($_SESSION['sessionRole'])){unset($_SESSION['sessionRole']);}
// if(isset($_SESSION['sessionRoleStudio'])){unset($_SESSION['sessionRoleStudio']);}
// if(isset($_SESSION['statusSession'])){unset($_SESSION['statusSession']);}
// if(isset($_SESSION['rankSession'])){unset($_SESSION['rankSession']);}
// if(isset($_SESSION['rankDateSession'])){unset($_SESSION['rankDateSession']);}
// if(isset($_SESSION['taiChiStatusSession'])){unset($_SESSION['taiChiStatusSession']);}
// if(isset($_SESSION['TaiChiRankSession'])){unset($_SESSION['TaiChiRankSession']);}
// if(isset($_SESSION['TaiChiRankDateSession'])){unset($_SESSION['TaiChiRankDateSession']);}


    session_start();
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);

header("location:index.php");
?>
