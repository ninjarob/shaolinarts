<?php
  require 'includes/connect.php';
  require 'includes/varDef.php';
  $name = stripslashes($name);
  $lastName = stripslashes($lastName);
  $email = stripslashes($email);
  $message = "Please fill all the fields to create a new user name and password (The information is case sensitive)";
  if($name && $lastName && $email && $birthday){
    $sql="SELECT * FROM $tbl_name WHERE name='$name' and lastName='$lastName' and email='$email' and birthday='$birthday'";
    $result=mysql_query($sql);
    $array = mysql_fetch_array($result);
    $count=mysql_num_rows($result);
    $un=$array["un"];
    $id=$array["id"];
    if($count==1){
      if($un){
        $message = "You already have a User Name and Password, if you have forgotten your user name or password, please click on \"Did you forget your password? \"";
      }else{
        $passwordKey = rand();
        mysql_query("UPDATE `$tbl_name` SET passwordKey='$passwordKey' WHERE id='$id';") or die(mysql_error("Database Error"));
        header("location:newUnPwSetup.php?K=$passwordKey");
      }
    }else{
      $message = "We are unable to find you, please make sure you entered your information accurately or give the studio a call. (Remember that it is case sensitive)";
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

<form name="form1" method="post" action="newMember.php" >
    <div data-role="header">
      <h1>New Member Access</h1>
    </div>
    <ul class="input-group">
      <?php
        if($message){
          echo "
            <li class=\"input-group list-group-item\">
              <label style\"color: #f00;\">".$message."</label>
            </li>
            <!-- <li class=\"input-group list-group-item\">
              <label style\"color: #f00;\">".$name."</label>
            </li>
            <li class=\"input-group list-group-item\">
              <label style\"color: #f00;\">".$lastName."</label>
            </li>
            <li class=\"input-group list-group-item\">
              <label style\"color: #f00;\">".$email."</label>
            </li>
            <li class=\"input-group list-group-item\">
              <label style\"color: #f00;\">".$birthday."</label>
            </li> -->
          ";
        }
      ?>
      <?php
          if($un){
      ?>
      <li class="input-group list-group-item">
        <a href="login.php">Go to the login page</a>
      </li>
      <li class="input-group list-group-item">
        <a href="passwordManagement.php">Did you just forgot your password?</a>
      </li>
      <?php
          }else{
      ?>
      <li class="input-group list-group-item">
        <label for="name" style="display: block; float: left; width: 150px;">Name:</label>
        <input name="name" type="text" id="myusername" data-mini="true" data-inline="true" />
      </li>
      <li class="input-group list-group-item">
        <label for="lastName" style="display: block; float: left; width: 150px;">Last Name:</label>
        <input name="lastName" type="text" id="myusername" data-mini="true" data-inline="true" />
      </li>
      <li class="input-group list-group-item">
        <label for="email" style="display: block; float: left; width: 150px;">Email Address:</label>
        <input name="email" type="text" id="myusername" data-mini="true" data-inline="true" />
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
      <li class="input-group list-group-item">
        <a href="http://shaolinarts.com/passwordManagement.php">Did you just forget your password?</a>
      </li>
      <?php
          }
      ?>
    </ul>
</form>

  </section>
</div>
</div>
<?php include 'includes/footer.php'; ?>
    <script type="text/javascript">
      $('#birthday').datepicker();
   </script>