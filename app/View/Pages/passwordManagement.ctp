<?php
  require 'includes/connect.php';
  require 'includes/varDef.php';
  $key=$_GET['key'];
  // To protect MySQL injection (more detail about MySQL injection)
  $key = stripslashes($key);
  $name = stripslashes($name);
  $lastName = stripslashes($lastName);
  $email = stripslashes($email);
  $birthday = stripslashes($birthday);
  $un = stripslashes($un);
  $key = stripslashes($key);
  $name = mysql_real_escape_string($name);
  $lastName = mysql_real_escape_string($lastName);
  $email = mysql_real_escape_string($email);
  $birthday = mysql_real_escape_string($birthday);
  $un = mysql_real_escape_string($un);
  if($un and $pw){
    $sql="SELECT * FROM $tbl_name WHERE un='$un'";
    $unResult=mysql_query($sql);
    $unCount=mysql_num_rows($unResult);
    if($unCount==1){
      $message= "Sorry but the user name you requested seems to be being used by someone else. Please try a diferent one";
    }else{
      mysql_query("UPDATE `$tbl_name` SET un='$un', pw='$pw', passwordKey='' WHERE passwordKey='$key';")or die(mysql_error("Database Error"));
      $message= "We have changed your user name and password successfully";
    }
  }else{
    if($key){
      $sql="SELECT * FROM $tbl_name WHERE passwordKey='$key'";
      $keyResult=mysql_query($sql);
      $keyCount=mysql_num_rows($keyResult);
      $keyArray = mysql_fetch_array($keyResult);
      $id= $keyArray['id'];
      if($keyCount==1){
        $message= "Choose a new user name and password.";
      }else{
        $message="We are sorry but it seems that this link has expired.";
      }
    }else{
      if($email){
        $sql="SELECT * FROM $tbl_name WHERE name='$name' and lastName='$lastName' and email='$email' and birthday='$birthday'";
        $result=mysql_query($sql);
        $count=mysql_num_rows($result);
        $array = mysql_fetch_array($result);
        $id=$array["id"];
        $firstName=$array["name"];
        $lastName=$array["lastName"];
        if($count==1){
          $passwordKey = rand();
          mysql_query("UPDATE `$tbl_name` SET passwordKey='$passwordKey' WHERE id='$id';") or die(mysql_error("Database Error"));
          $from = "noreplay@shaolinarts.com";
          $to = $email;
          $subject = "Shaolin Arts, Password Reset - Do not reply";
          $message = "Dear $firstName, \n We have received a request to change your account's password. If you did not request this change, you can disregard this message. \n \n If you wish to change your password, please follow the link bellow: \n \n http://shaolinarts.com/pwUpdate.php?key=".$passwordKey." \n \n Please if you have any questions contact the office. \n \n The Shaolin Arts team.";
          $headers = "From:" . $from;
          mail($to,$subject,$message,$headers);
          $message="We have sent an email to your account with instructions on how to update your username and password.";
        }else{
          $message="Sorry but the I cannot find you, please try again";
        }
      }else{
        $message="Please fill the information bellow so we can retreve your account.";
      }
    }
  }
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

<?php
  if($key and $keyCount==1){
  ?>
  <form name="form1" id="form1" method="post" ajax="false" action="passwordManagement.php?key=<?php echo $key ?>">

        <ul class="input-group">
          <?php
            if($message){
              echo "
                <li class=\"input-group list-group-item\">
                  <label style\"color: #f00;\">".$message."</label>
                </li>
              ";
            }
          ?>
          <li  class="input-group list-group-item">
            <label for="name" style="display: block; float: left; width: 100px;">Choose a Username:</label>
            <input name="un" type="text" class="validate[required,custom[onlyLetterNumber]] text-input" id="un" data-mini="true" data-inline="true" />
          </li>
          <li  class="input-group list-group-item">
            <label for="lastName" style="display: block; float: left; width: 100px;">Choose a Password:</label>
            <input name="pw" type="password" class="validate[required] text-input" id="pw"  data-mini="true" data-inline="true" />
          </li>
          <li class="input-group list-group-item">
            <input name="id" type="hidden" value="<?php echo $id; ?>" />
            <input type="submit" name="Submit" value="Submit"  class="btn btn-primary" />
          </li>
        </ul>
  </form>
  <?
  }else{
  ?>
  <form name="form1" id="form1" method="post" ajax="false" action="passwordManagement.php">
      <div data-role="header">
        <h1>Update Your Password</h1>
      </div>
      <ul class="input-group">
        <?php
          if($message){
            echo "
              <li class=\"input-group list-group-item\">
                <label style\"color: #f00;\">".$message."</label>
              </li>
            ";
          }
          if($count!=1){
        ?>
          <li  class="input-group list-group-item">
            <label for="name" style="display: block; float: left; width: 150px;">Name:</label>
            <input name="name" type="text" class="validate[required,custom[onlyLetterNumber]] text-input" id="name" data-mini="true" data-inline="true" />
          </li>
          <li  class="input-group list-group-item">
            <label for="lastName" style="display: block; float: left; width: 150px;">Last name:</label>
            <input name="lastName" type="text" class="validate[condRequired[name],custom[onlyLetterNumber]] text-input" id="lastName"  data-mini="true" data-inline="true" />
          </li>
          <li  class="input-group list-group-item">
            <label for="email" style="display: block; float: left; width: 150px;">Email Address:</label>
            <input name="email" type="email" id="email"  class="validate[required,custom[email]] text-input" data-mini="true" data-inline="true" />
          </li>
          <li class="input-group list-group-item">
            <label for="birthday" style="display: block; float: left; width: 150px;" >Birthday:</label>
            <div class="input-append date input-group" id="birthday" class="form-control" data-date="2000-01-01" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
              <input class="span2" type="text" value="yyyy-mm-dd"  name="birthday" style="width: 150px;" />
              <span class="input-group-addon" style="padding: 0 5px;"><span class="add-on glyphicon glyphicon-calendar" style="font-size: 14px; padding: 0;"></span></span>
            </div>
          </li>
          <li class="input-group list-group-item">
            <input type="submit" name="Submit" value="Submit"  class="btn btn-primary"/>
          </li>
        <?php
          }
        ?>
        <li class="input-group list-group-item">
          <a href="login.php" class="btn btn-primary">Back to the log in page</a>
        </li>
      </ul>
  </form>
  <?php } ?>


  </section>
</div>
</div>
<?php include 'includes/footer.php'; ?>
    <script type="text/javascript">
      $('#birthday').datepicker();
   </script>