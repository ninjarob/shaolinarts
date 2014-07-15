<?php
	require 'includes/connect.php';
	require 'includes/varDef.php';

	$name = stripslashes($name);
	$lastName = stripslashes($lastName);
	$email = stripslashes($email);

	$passwordKey=$_GET['K'];
	$key=$_POST['pwk'];

	if($passwordKey){
		$message = "Please enter a User Name and password for your account.";
	}else{
		if($un && $pw && $key){
			$sql="SELECT * FROM $tbl_name WHERE un='$un'";
			$result=mysql_query($sql);
			$array = mysql_fetch_array($result);
			$count=mysql_num_rows($result);
			if($count==1){
				$message = "The User Name you chose is not available, please choose a different one.";
			}else{
				mysql_query("UPDATE `$tbl_name` SET un='$un', pw='$pw' WHERE passwordKey='$key';")or die(mysql_error("Database Error"));
				$message = "You have successfully updated your User Name and Password.";
			}
		}else{
			header("location:newMember.php");
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

	<form name="form1" method="post" action="newUnPwSetup.php"  data-ajax="false">
		<div data-role="header">
			<h1>New Member Access</h1>
		</div>
		<ul class="list-group">


			<?php
				if($message){
					echo "
						<li class=\"list-group-item\">
							<label style\"color: #f00;\">".$message."</label>
						</li>
					";
				}
			?>

			<?php

				if($passwordKey){
			?>

				<li  class="list-group-item">
					<label for="un" style="display: block; float: left; width: 150px; font-weight: bold;">New User Name:</label>
					<input name="un" type="text" id="un" data-mini="true"  data-inline="true" />
				</li>
				<li  class="list-group-item ">
					<label for="pw" style="display: block; float: left; width: 150px; font-weight: bold;">New Password:</label>
					<input name="pw" type="password" id="pw" data-mini="true"  data-inline="true" />
				</li>
				<li  class="list-group-item">
					<input type="submit" name="Submit" value="Submit"  class="btn btn-primary" />
					<input type="hidden" name="pwk" value="<? echo "$passwordKey"; ?>" />
				</li>

			<?php
				}else{
			?>

				<li class="list-group-item">
					<a  class="btn btn-primary" href="login.php">Log In</a>
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



