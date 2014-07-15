<?php
require 'includes/check_session.php';
$sessionRole = $_SESSION['sessionRole'];
$sessionRoleStudio = $_SESSION['sessionRoleStudio'];
$sessionKungFuStatus = $_SESSION['statusSession'];
$sessionKungFuRank = $_SESSION['rankSession'];
$sessionKungFuRankDate = $_SESSION['rankDateSession'];
$sessionTaiChiStatus = $_SESSION['taiChiStatusSession'];
$sessionTaiChiRank = $_SESSION['TaiChiRankSession'];
$sessionTaiChiRankDate = $_SESSION['TaiChiRankDateSession'];
$todayDate = date('Ymd');
if ($sessionKungFuStatus == 0) {
    if(($sessionKungFuRank<12) || ($sessionKungFuRank>22)){
      $sessionKungFuRankDate = strtotime($sessionKungFuRankDate . "+ 1 Year");
      $sessionKungFuRankDate = date('Ymd', $sessionKungFuRankDate);
  }
  if((($sessionKungFuRank>11) && ($sessionKungFuRank<23)) || $sessionRole=='instructor' || $sessionRole=='manager'){
      $sessionKungFuRankDate = strtotime($sessionKungFuRankDate . "+ 2 Year");
      $sessionKungFuRankDate = date('Ymd', $sessionKungFuRankDate);
  }
  if($sessionRole=='districtMa'){
      $sessionKungFuRankDate = strtotime($sessionKungFuRankDate . "+ 4 Year");
      $sessionKungFuRankDate = date('Ymd', $sessionKungFuRankDate);
      $sessionTaiChiRankDate = date('Ymd' , strtotime('+4 year'));
  }
  if($sessionRole=='admin'){
      $sessionKungFuRankDate = date('Ymd' , strtotime('+10 year'));
      $sessionTaiChiRankDate = date('Ymd' , strtotime('+10 year'));
  }
}
if ($sessionTaiChiStatus == 0) {
    if($sessionTaiChiRank<8){
      $sessionTaiChiRankDate = strtotime($sessionTaiChiRankDate . "+ 1 Year");
      $sessionTaiChiRankDate = date('Ymd', $sessionTaiChiRankDate);
  }
  if($sessionTaiChiRank>7 || $sessionRole=='instructor' || $sessionRole=='manager'){
      $sessionTaiChiRankDate = strtotime($sessionTaiChiRankDate . "+ 2 Year");
      $sessionTaiChiRankDate = date('Ymd', $sessionTaiChiRankDate);
  }
}
require 'includes/connect.php';
require 'includes/pdfConnect.php';
  // To protect MySQL injection (more detail about MySQL injection)
$un = stripslashes($un);
$pw = stripslashes($pw);
$un = mysql_real_escape_string($un);
$pw = mysql_real_escape_string($pw);
$sql="SELECT * FROM $tbl_name WHERE un='$un' and pw='$pw'";
$result=mysql_query($sql);
$array = mysql_fetch_array($result);
$role=$array['role'];
$studio=$array['studio'];
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/banner.php'; ?>
<?php include 'includes/navigation.php'; ?></div>
<div class="row corpus">
<div class="col-md-3 asideColumn hidden-xs hidden-sm">
  <aside class="contentCol">
    <?php include 'includes/admin_pages_column.php'; ?>
  </aside>
</div>
<div class="col-md-9 sectionContent">
  <section class="contentCol">

<h2>Shaolin Arts Library </h2>
<h4>Welcome to resource library, please click the link below to see your manuals. </h4>
<!--
$sessionRole = $_SESSION['sessionRole'];
$sessionRoleStudio = $_SESSION['sessionRoleStudio'];
$sessionKungFuStatus = $_SESSION['statusSession'];
$sessionKungFuRank = $_SESSION['rankSession'];
$sessionKungFuRankDate = $_SESSION['rankDateSession'];
$sessionTaiChiStatus = $_SESSION['taiChiStatusSession'];
$sessionTaiChiRank = $_SESSION['TaiChiRankSession'];
$sessionTaiChiRankDate = $_SESSION['TaiChiRankDateSession'];
 -->
<!-- <a href="pdf-delivery.php" target="_blank">test</a> -->
<?php
// echo "
// Role: $sessionRole<br />
// Role Studio: $sessionRoleStudio<br />
// Kung Fu Status: $sessionKungFuStatus<br />
// Kung Fu Rank: $sessionKungFuRank<br />
// Kung Fu Rank Date: $sessionKungFuRankDate<br />
// Tai Chi Status: $sessionTaiChiStatus<br />
// Tai Chi Rank: $sessionTaiChiRank<br />
// Tai Chi Rank Date: $sessionTaiChiRankDate<br />
// Today's Date: $todayDate<br />
// Session Kung Fu Date: $sessionKungFuRankDate<br />
// Session Tai chi Date: $sessionTaiChiRankDate<br />
// ";
if($todayDate<$sessionKungFuRankDate || $todayDate<$sessionTaiChiRankDate){
if ($sessionKungFuStatus == 0) {
  if($todayDate<$sessionKungFuRankDate){
echo"<h4>Kung Fu</h4>";
echo"<ol>";
  // Kung Fu Beginners
echo "<li><a href=\"pdf/ShaolinWuLingXingBeg-REV011114-acGE5ScPNQ.pdf\"\" target=\"_blank\">".$pdfInfo[3][0]."</a></li>";
if (($sessionKungFuRank>3 && $sessionKungFuRank<23) || ($sessionKungFuRank>25)) {
  // Kung Fu Intermediate
  echo "<li><a href=\"pdf/ShaolinWuLingXingInt-REV011114-gB5zP2A2WJ.pdf\" target=\"_blank\">".$pdfInfo[3][1]."</a></li>";
}
if (($sessionKungFuRank>7 && $sessionKungFuRank<23) || ($sessionKungFuRank>29)) {
  // Kung Fu Advanced
  echo "<li><a href=\"pdf/ShaolinWuLingXingAd-REV011114-5rmh9Wwfxd.pdf\" target=\"_blank\">".$pdfInfo[3][2]."</a></li>";
}
// if ($sessionKungFuRank>11 && $sessionKungFuRank<23){
//   // Kung Fu Black Beguinner
//   echo "<li><a href=\"pdf/".$pdfInfo[0][7]."\" target=\"_blank\">".$pdfInfo[3][7]."</a></li>";
// }
// if ($sessionKungFuRank>13 && $sessionKungFuRank<23) {
//   // Kung Fu Black Advanced
//   echo "<li><a href=\"pdf/".$pdfInfo[0][8]."\" target=\"_blank\">".$pdfInfo[3][8]."</a></li>";
// }
if ($sessionKungFuRank>11 && $sessionKungFuRank<23) {
  // Kung Fu Post Black
  echo "<li><a href=\"pdf/ShaolinWuLingXingPostBlack-REV011114-28cXPcpbNf.pdf\" target=\"_blank\">Beginning Black Chuan Fa</a></li>";
}
if ($sessionKungFuRank>17 && $sessionKungFuRank<23) {
  // Kung Fu Post Black
  echo "<li><a href=\"pdf/AdvancedBlackChuanFa-v49pUsQ7EP.pdf\" target=\"_blank\">Advanced Black Chuan Fa</a></li>";
}
echo"</ol>";
  }else{
    echo "<h4>Your access to the Kung Fu materials has expired, please give the office a call.</h4>";
  }
}


// echo "<p>SessionRole = $sessionRole</p>";
// echo "<p>SessionRoleStudio = $sessionRoleStudio</p>";
// echo "<p>SessionKungFuStatus = $sessionKungFuStatus</p>";
// echo "<p>SessionKungFuRank = $sessionKungFuRank</p>";
// echo "<p>SessionKungFuRankDate = $sessionKungFuRankDate</p>";
// echo "<p>SessionTaiChiStatus = $sessionTaiChiStatus</p>";
// echo "<p>SessionTaiChiRank = $sessionTaiChiRank</p>";
// echo "<p>SessionTaiChiRankDate = $sessionTaiChiRankDate</p>";
// echo "<p>TodayDate = $todayDate</p>";



if ($sessionTaiChiStatus == 0) {
  if($todayDate<$sessionTaiChiRankDate){
    echo"<h4>Tai Chi</h4>";
    echo"<ol>";
    // Tai Chi Beginners
    echo "<li><a href=\"pdf/TaiChiChuanInternet-REV011114-2B6aukdVzP-.pdf\" target=\"_blank\">Tai Chi</a></li>";
    if($sessionTaiChiRank > 12){
    echo "<li><a href=\"pdf/TaiChiChuanPostBlack-REV011114-bbDuEzYXd9-.pdf\" target=\"_blank\">Tai Chi Post Black</a></li>";
    }
    echo"</ol>";
  }else{
      echo "<h4>Your access to the Tai Chi materials has expired, please give the office a call.</h4>";
  }
}


  // Instructor's College
  if ($sessionRole!=student) {
    echo"<h4>Instructor's College</h4>";
    echo"<ol>";
    echo "<li><a href=\"pdf/InstructorCollegeManual-REV011114-rHtnZ6T3q4.pdf\" target=\"_blank\">".$pdfInfo[3][6]."</a></li>";
    echo"</ol>";
  }
}else{
  echo "<h4>Your access to these materials has expired, please give the office a call.</h4>";
}
?>


  </section>
</div>
</div>
<?php include 'includes/footer.php'; ?>
<?php ob_end_flush();?>
