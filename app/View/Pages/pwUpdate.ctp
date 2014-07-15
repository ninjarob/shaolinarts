<?php
	require 'includes/connect.php';
	require 'includes/varDef.php';
	$key=$_GET['key'];
	$un = stripslashes($un);
	$pw = stripslashes($pw);
	$un = mysql_real_escape_string($un);
	$pw = mysql_real_escape_string($pw);
	if($key){
		$sql="SELECT * FROM $tbl_name WHERE passwordKey='$key'";
		$result=mysql_query($sql);
		$count=mysql_num_rows($result);
		if($count==1){
			$message= "Please choose a NEW password for your account.";
			$array = mysql_fetch_array($result);
			$un=$array['un'];
			$id=$array["id"];
		}else{
			$message= "This page is no longer available!";
		}
	}else{
		$message= "This page is no longer available!";
	}
	if($id){
		mysql_query("UPDATE `$tbl_name` SET pw='$pw', passwordKey='none' WHERE id='$id';")or die(mysql_error("Database Error"));
		$message = "You have successfully updated your password, please click on the login button to log in to your account. \"";
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
<form name="form1" method="post" action="pwUpdate.php"  data-ajax="false">
<div data-role="header">
	<h1>Password Update</h1>
</div>
	    <ul  class="input-group">
	<li class="input-group list-group-item">
	<?php echo $message; ?>
</li>
<?php
	if($count==1){
?>
	        <li class="input-group list-group-item">
	            <label for="name" style="display: block; float: left; width: 100px;">Username:</label>
	            <?php echo "$un"; ?>
	        </li>
	        <li class="input-group list-group-item">
	            <label for="name" style="display: block; float: left; width: 100px;">Password:</label>
	            <input name="pw" type="password" id="mypassword"  data-mini="true" data-inline="true" />
	<input name="id" type="hidden" value="<?php echo $id; ?>" />
	        </li>
	        <li class="input-group list-group-item">
		<input type="submit" name="Submit" value="Submit"  class="btn btn-primary" />
	</li>
<?php
	}
?>
	<li class="input-group list-group-item"><a href="login.php"  class="btn btn-primary">Back to the login page</a></li>
</ul>
		</form>
	</section>
</div>
</div>
<?php include 'includes/footer.php'; ?>
