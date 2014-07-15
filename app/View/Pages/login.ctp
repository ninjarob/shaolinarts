<?php
  require 'includes/connect.php';

  $un=$_POST['un'];
  $pw=$_POST['pw'];


  $un = stripslashes($un);
  $pw = stripslashes($pw);
  $un = mysql_real_escape_string($un);
  $pw = mysql_real_escape_string($pw);
  $sql="SELECT * FROM $tbl_name WHERE un='$un' and pw='$pw'";
  $result=mysql_query($sql);
  $array = mysql_fetch_array($result);
  $role=$array['role'];
  $studioRole=$array['studioRole'];
  $status = $array['status'];
  $rank = $array['rank'];
  $studio = $array['studio'];
  $rankDate = $array['rankDate'];
  $taiChiStatus = $array['taiChiStatus'];
  $TaiChiRank = $array['TaiChiRank'];
  $taiChiStudio = $array['taiChiStudio'];
  $TaiChiRankDate = $array['TaiChiRankDate'];
  $todayDate = date('Ymd');
  $count=mysql_num_rows($result);
  if($un){
      if($count==1){
        if($status==0 || $taiChiStatus==0){
          session_start();
          $_SESSION['sessionRole'] = $role;
          $_SESSION['sessionRoleStudio'] = $studioRole;
          $_SESSION['statusSession'] = $status;
          $_SESSION['rankSession'] = $rank;
          $_SESSION['rankDateSession'] = $rankDate;
          $_SESSION['StudioSession'] = $studio;
          $_SESSION['taiChiStatusSession'] = $taiChiStatus;
          $_SESSION['TaiChiRankSession'] = $TaiChiRank;
          $_SESSION['TaiChiRankDateSession'] = $TaiChiRankDate;
          $_SESSION['TaiChiStudioSession'] = $taiChiStudio;
          if($role=='student' or $role=='insCollege'){
              header("location:pdf_viewer.php");
          }else{
            header("location:admin.php");
          }
        }else{
          $message="I am sorry, but you do not seem to have access to this content, try giving the office a call.";
        }
      }else{
        $message="Either your user name or password are incorrect, why don't you give it another try.";
      }
  }else{
    $message="Please enter your username asd and password";
  }
ob_end_flush();
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
    <form name="form1" method="post" action="login.php"  data-ajax="false">
      <h1>Log In</h1>
      <ul class="list-group">
        <li class="input-group list-group-item">
          <?php echo $message; ?></li>
        <li class="input-group list-group-item">
          <label for="name" style="display: block; float: left; width: 100px;">Username:</label>
          <input name="un" type="text" id="myusername" data-mini="true" data-inline="true" />
        </li>
        <li class="input-group list-group-item">
          <label for="name" style="display: block; float: left; width: 100px;">Password:</label>
          <input name="pw" type="password" id="mypassword"  data-mini="true" data-inline="true" />
        </li>
        <li class="input-group list-group-item">
          <input type="submit" name="Submit" value="Login"  class="btn btn-primary" />
        </li>
        <li class="input-group list-group-item">
          <a href="passwordManagement.php" ajax="false">Did you forget your user name or password?</a>
        </li>
        <li class="input-group list-group-item">
          <a href="newMember.php" ajax="false">Is this the first time at the website?</a>
        </li>
      </ul>
    </form>
    <script type="text/javascript">
  $(document).ready(function() {
    $('#myusername').focus();
  });
</script>
  </section>
</div>
</div>
<?php include 'includes/footer.php'; ?>