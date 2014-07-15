<?php
	require 'includes/check_session.php';
	$sessionRole = $_SESSION['sessionRole'];
	$sessionRoleStudio = $_SESSION['sessionRoleStudio'];
	require 'includes/roleCheck.php';
	require 'includes/connect.php';
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
if($id){
	$id=$array["id"];
	$role=$array["role"];
	$studioRole=$array["studioRole"];
	$picture=$array["picture"];
	$name=$array["name"];
	$lastName=$array["lastName"];
	$homePhone=$array["homePhone"];
	$cellPhone=$array["cellPhone"];
	$workPhone=$array["workPhone"];
	$email=$array["email"];
	$addres=$array["addres"];
	$city=$array["city"];
	$state=$array["state"];

	$zip=$array["zip"];
	$birthday=$array["birthday"];
	$spouseGuardian=$array["spouseGuardian"];
	$sgPhone=$array["sgPhone"];
	$sgCellPhone=$array["sgCellPhone"];
	$startDate=$array["startDate"];
	$dueDate=$array["dueDate"];
	$taiChiDueDate=$array["taiChiDueDate"];
	$studio=$array["studio"];
	$taiChiStudio=$array["taiChiStudio"];
	$studioRole=$array["studioRole"];
	$program=$array["program"];
	$longTermProgram=$array["longTermProgram"];
	$TaiChiProgram=$array["TaiChiProgram"];
	$lessonType=$array["lessonType"];
	$TaiChiLessonType=$array["TaiChiLessonType"];
	$rank=$array["rank"];
	$TaiChiRank=$array["TaiChiRank"];
	$rankDate=$array["rankDate"];
	$status=$array["status"];
	$TaiChiRankDate=$array["TaiChiRankDate"];
	$taiChiStatus=$array["taiChiStatus"];
	$studentID=$array["studentID"];
	$ice1=$array["ice1"];
	$ice1Phone=$array["ice1Phone"];
	$ice1CellPhone=$array["ice1CellPhone"];
	$ice2=$array["ice2"];
	$ice2Phone=$array["ice2Phone"];
	$ice2CellPhone=$array["ice2CellPhone"];
	$ice3=$array["ice3"];
	$ice3Phone=$array["ice3Phone"];
	$ice3CellPhone=$array["ice3CellPhone"];
	$un=$array["un"];
	$pw=$array["pw"];
	$notes=$array["notes"];
}
?>

<style type="text/css">
	.input-group-addon{
		min-width: 180px;
		text-align: left;
	}

	form ul{margin: 0; padding: 0;}
	form ul li{margin-bottom: 5px;}
</style>
		<h1>
			<?php
		if($id){
			echo "Edit User";
		}else{
			echo "Add User";
		}
	?></h1>
		<p style="margin-bottom: 20px;">
			<a class="btn btn-primary" href="admin.php">Return to the admin tool</a>
		</p>
		<form name="form1" id="form1" method="post" action="update_processor.php">
			<ul>
				<li class="input-group">
					<h1>
						<?php echo"$name $lastName"; ?></h1>
				</li>
				<li class="input-group">
					<input type="submit"   class="btn btn-primary" name="submit" value="<?php if($id){ echo "Update"; }else{ echo "Add"; } ?>
					" data-icon="
					<?php if($id){ echo "Edit"; }else{ echo "Add"; } ?>"></li>
			</ul>
					<h3>Student</h3>
					<ul>
						<?php if($picture){?>
						<li style="text-align: center; padding: 30px;">
							<span>
								<img src="upload<?php echo $picture; ?>" style="width: 300px;" /></span>
						</li>
						<?php } ?>
						<?php if($id){?>
						<!-- <li>
							<a href="image_upload.php?id=<?php echo $id; ?>">Update Image</a>
						</li> -->
						<?php } ?>
						<li class="input-group">
							<label for="name" class="input-group-addon">First Name:</label>
							<input  class="form-control" name="name" type="text" class="form-control" id="name" value="<?php echo $name; ?>"/></li>
						<li class="input-group">
							<label for="lastName" class="input-group-addon">Last Name:</label>
							<input  class="form-control" name="lastName" type="text" id="lastName" value="<?php echo $lastName; ?>"/></li>
						<li class="input-group">
							<label for="birthday" class="input-group-addon">Birth Day:</label>
							<input  class="form-control" name="birthday" type="date"  id="birthday" value="<?php echo $birthday; ?>"/></li>
						<li class="input-group">
							<label for="homePhone" class="input-group-addon">Home Phone:</label>
							<input  class="form-control" name="homePhone" type="text" id="homePhone" value="<?php echo $homePhone; ?>"/></li>
						<li class="input-group">
							<label for="workPhone" class="input-group-addon">Work Phone:</label>
							<input  class="form-control" name="workPhone" type="text" id="workPhone" value="<?php echo $workPhone; ?>"/></li>
						<li class="input-group">
							<label for="email" class="input-group-addon">Email:</label>
							<input  class="form-control" name="email" type="text" id="email" value="<?php echo $email; ?>"/></li>
						<li class="input-group">
							<label for="addres" class="input-group-addon">Address:</label>
							<input  class="form-control" name="addres" type="text" id="addres" value="<?php echo $addres; ?>"/></li>
						<li class="input-group">
							<label for="city" class="input-group-addon">City:</label>
							<input  class="form-control" name="city" type="text" id="city" value="<?php echo $city; ?>"/></li>
						<li class="input-group">
							<label for="name" class="input-group-addon">State: <?php echo $state; ?></label>
							<select  class="form-control" name="state" id="state" name="State">
								<option <?php if($state==="AL"){echo "selected";} ?> value="AL">Alabama</option>
								<option <?php if($state==="AK"){echo "selected";} ?> value="AK">Alaska</option>
								<option <?php if($state==="AZ"){echo "selected";} ?> value="AZ">Arizona</option>
								<option <?php if($state==="AR"){echo "selected";} ?> value="AR">Arkansas</option>
								<option <?php if($state==="CA"){echo "selected";} ?> value="CA">California</option>
								<option <?php if($state==="CO"){echo "selected";} ?> value="CO">Colorado</option>
								<option <?php if($state==="CT"){echo "selected";} ?> value="CT">Connecticut</option>
								<option <?php if($state==="DE"){echo "selected";} ?> value="DE">Delaware</option>
								<option <?php if($state==="DC"){echo "selected";} ?> value="DC">District Of Columbia</option>
								<option <?php if($state==="FL"){echo "selected";} ?> value="FL">Florida</option>
								<option <?php if($state==="GA"){echo "selected";} ?> value="GA">Georgia</option>
								<option <?php if($state==="HI"){echo "selected";} ?> value="HI">Hawaii</option>
								<option <?php if($state==="ID"){echo "selected";} ?> value="ID">Idaho</option>
								<option <?php if($state==="IL"){echo "selected";} ?> value="IL">Illinois</option>
								<option <?php if($state==="IN"){echo "selected";} ?> value="IN">Indiana</option>
								<option <?php if($state==="IA"){echo "selected";} ?> value="IA">Iowa</option>
								<option <?php if($state==="KS"){echo "selected";} ?> value="KS">Kansas</option>
								<option <?php if($state==="KY"){echo "selected";} ?> value="KY">Kentucky</option>
								<option <?php if($state==="LA"){echo "selected";} ?> value="LA">Louisiana</option>
								<option <?php if($state==="ME"){echo "selected";} ?> value="ME">Maine</option>
								<option <?php if($state==="MD"){echo "selected";} ?> value="MD">Maryland</option>
								<option <?php if($state==="MA"){echo "selected";} ?> value="MA">Massachusetts</option>
								<option <?php if($state==="MI"){echo "selected";} ?> value="MI">Michigan</option>
								<option <?php if($state==="MN"){echo "selected";} ?> value="MN">Minnesota</option>
								<option <?php if($state==="MS"){echo "selected";} ?> value="MS">Mississippi</option>
								<option <?php if($state==="MO"){echo "selected";} ?> value="MO">Missouri</option>
								<option <?php if($state==="MT"){echo "selected";} ?> value="MT">Montana</option>
								<option <?php if($state==="NE"){echo "selected";} ?> value="NE">Nebraska</option>
								<option <?php if($state==="NV"){echo "selected";} ?> value="NV">Nevada</option>
								<option <?php if($state==="NH"){echo "selected";} ?> value="NH">New Hampshire</option>
								<option <?php if($state==="NJ"){echo "selected";} ?> value="NJ">New Jersey</option>
								<option <?php if($state==="NM"){echo "selected";} ?> value="NM">New Mexico</option>
								<option <?php if($state==="NY"){echo "selected";} ?> value="NY">New York</option>
								<option <?php if($state==="NC"){echo "selected";} ?> value="NC">North Carolina</option>
								<option <?php if($state==="ND"){echo "selected";} ?> value="ND">North Dakota</option>
								<option <?php if($state==="OH"){echo "selected";} ?> value="OH">Ohio</option>
								<option <?php if($state==="OK"){echo "selected";} ?> value="OK">Oklahoma</option>
								<option <?php if($state==="OR"){echo "selected";} ?> value="OR">Oregon</option>
								<option <?php if($state==="PA"){echo "selected";} ?> value="PA">Pennsylvania</option>
								<option <?php if($state==="RI"){echo "selected";} ?> value="RI">Rhode Island</option>
								<option <?php if($state==="SC"){echo "selected";} ?> value="SC">South Carolina</option>
								<option <?php if($state==="SD"){echo "selected";} ?> value="SD">South Dakota</option>
								<option <?php if($state==="TN"){echo "selected";} ?> value="TN">Tennessee</option>
								<option <?php if($state==="TX"){echo "selected";} ?> value="TX">Texas</option>
								<option <?php if($state==="UT"){echo "selected";} ?> value="UT">Utah</option>
								<option <?php if($state==="VT"){echo "selected";} ?> value="VT">Vermont</option>
								<option <?php if($state==="VA"){echo "selected";} ?> value="VA">Virginia</option>
								<option <?php if($state==="WA"){echo "selected";} ?> value="WA">Washington</option>
								<option <?php if($state==="WV"){echo "selected";} ?> value="WV">West Virginia</option>
								<option <?php if($state==="WI"){echo "selected";} ?> value="WI">Wisconsin</option>
								<option <?php if($state==="WY"){echo "selected";} ?> value="WY">Wyoming</option>
							</select>
						</li>
						<li class="input-group">
							<label for="zip" class="input-group-addon">Zip:</label>
							<input  class="form-control" name="zip" type="text" id="zip" value="<?php echo $zip; ?>"/></li>
						<li class="input-group">
							<label for="studentID" class="input-group-addon">Student ID:</label>
							<input  class="form-control" name="studentID" type="text" id="studentID" value="<?php echo $studentID; ?>"/></li>
					</ul>
				<h3>ICE Info</h3>
				<ul>
					<li class="input-group">
						<label for="spouseGuardian" class="input-group-addon">Spouse / Guardian:</label>
						<input  class="form-control" name="spouseGuardian" type="text" id="spouseGuardian" value="<?php echo $spouseGuardian; ?>"/></li>
					<li class="input-group">
						<label for="sgPhone" class="input-group-addon">Phone:</label>
						<input  class="form-control" name="sgPhone" type="text" id="sgPhone" value="<?php echo $sgPhone; ?>"/></li>
					<li class="input-group">
						<label for="sgCellPhone" class="input-group-addon">Cell Phone:</label>
						<input  class="form-control" name="sgCellPhone" type="text" id="sgCellPhone" value="<?php echo $sgCellPhone; ?>"/></li>
					<li class="input-group">
						<label for="ice1" class="input-group-addon">1. ICE Name:</label>
						<input  class="form-control" name="ice1" type="text" id="ice1" value="<?php echo $ice1; ?>"/></li>
					<li class="input-group">
						<label for="ice1Phone" class="input-group-addon">1. Phone:</label>
						<input  class="form-control" name="ice1Phone" type="text" id="ice1Phone" value="<?php echo $ice1Phone; ?>"/></li>
					<li class="input-group">
						<label for="ice1CellPhone" class="input-group-addon">1. Cell Phone:</label>
						<input  class="form-control" name="ice1CellPhone" type="text" id="ice1CellPhone" value="<?php echo $ice1CellPhone; ?>"/></li>
					<li class="input-group">
						<label for="ice2" class="input-group-addon">2. ICE Name::</label>
						<input  class="form-control" name="ice2" type="text" id="ice2" value="<?php echo $ice2; ?>"/></li>
					<li class="input-group">
						<label for="ice2Phone" class="input-group-addon">2. Phone:</label>
						<input  class="form-control" name="ice2Phone" type="text" id="ice2Phone" value="<?php echo $ice2Phone; ?>"/></li>
					<li class="input-group">
						<label for="ice2CellPhone" class="input-group-addon">2. Cell Phone:</label>
						<input  class="form-control" name="ice2CellPhone" type="text" id="ice2CellPhone" value="<?php echo $ice2CellPhone; ?>"/></li>
					<li class="input-group">
						<label for="ice3" class="input-group-addon">3. ICE Name::</label>
						<input  class="form-control" name="ice3" type="text" id="ice3" value="<?php echo $ice3; ?>"/></li>
					<li class="input-group">
						<label for="ice3Phone" class="input-group-addon">3. Phone:</label>
						<input  class="form-control" name="ice3Phone" type="text" id="ice3Phone" value="<?php echo $ice3Phone; ?>"/></li>
					<li class="input-group">
						<label for="ice3CellPhone" class="input-group-addon">3. Cell Phone:</label>
						<input  class="form-control" name="ice3CellPhone" type="text" id="ice3CellPhone" value="<?php echo $ice3CellPhone; ?>"/></li>
				</ul>

					<h3>Program</h3>
					<ul>
						<li class="input-group">
							<label for="name" class="input-group-addon">Program:</label>
							<select  class="form-control" name="program">
								<option <?php if($program==="1"){echo "selected";} ?> value="1">Tai Chi</option>
								<option <?php if($program==="2"){echo "selected";} ?> value="2">Kung Fu</option>
								<option <?php if($program==="3"){echo "selected";} ?> value="3">Kung Fu and Tai Chi</option>							</select>
						</li>
					</ul>
					<h3>Kung Fu</h3>
					<ul>
						<li class="input-group">
							<label for="name" class="input-group-addon">Kung Fu Studio:</label>
							<select  class="form-control" name="studio" >
							<?php if($sessionRole=='admin'){ ?>
								<option <?php if($studio==="0"){echo "selected";} ?> value="0">None</option>
								<option <?php if($studio==="1"){echo "selected";} ?> value="1">Glendale, AZ</option>
								<option <?php if($studio==="2"){echo "selected";} ?> value="2">Sandy, UT</option>
								<option <?php if($studio==="3"){echo "selected";} ?> value="3">Taylorsville, UT</option>
								<option <?php if($studio==="4"){echo "selected";} ?> value="4">Sandy and Taylorsville,UT</option>
							<?php }else{ ?>
								<?php if($sessionRole=='districtMa'){ ?>
										<option <?php if($studio==="0"){echo "selected";} ?> value="0">None</option>
									<?php if($sessionRoleStudio=='1'){ ?>
										<option <?php if($studio==="1"){echo "selected";} ?> value="1">Glendale, AZ</option>
									<?php } ?>
									<?php if($sessionRoleStudio=='2'){ ?>
										<option <?php if($studio==="2"){echo "selected";} ?> value="2">Sandy, UT</option>
										<option <?php if($studio==="3"){echo "selected";} ?> value="3">Taylorsville, UT</option>
										<option <?php if($studio==="4"){echo "selected";} ?> value="4">Sandy and Taylorsville,UT</option>
									<?php } ?>
									<?php if($sessionRoleStudio=='3'){ ?>
										<option <?php if($studio==="2"){echo "selected";} ?> value="2">Sandy, UT</option>
										<option <?php if($studio==="3"){echo "selected";} ?> value="3">Taylorsville, UT</option>
										<option <?php if($studio==="4"){echo "selected";} ?> value="4">Sandy and Taylorsville,UT</option>
									<?php } ?>
									<?php if($sessionRoleStudio=='4'){ ?>
										<option <?php if($studio==="2"){echo "selected";} ?> value="2">Sandy, UT</option>
										<option <?php if($studio==="3"){echo "selected";} ?> value="3">Taylorsville, UT</option>
										<option <?php if($studio==="4"){echo "selected";} ?> value="4">Sandy and Taylorsville,UT</option>
									<?php } ?>
								<?php } ?>
								<?php if($sessionRole=='manager'){ ?>
										<option <?php if($studio==="0"){echo "selected";} ?> value="0">None</option>
									<?php if($sessionRoleStudio=='1'){ ?>
										<option <?php if($studio==="1"){echo "selected";} ?> value="1">Glendale, AZ</option>
									<?php } ?>
									<?php if($sessionRoleStudio=='2'){ ?>
										<option <?php if($studio==="2"){echo "selected";} ?> value="2">Sandy, UT</option>
									<?php } ?>
									<?php if($sessionRoleStudio=='3'){ ?>
										<option <?php if($studio==="3"){echo "selected";} ?> value="3">Taylorsville, UT</option>
									<?php } ?>
									<?php if($sessionRoleStudio=='4'){ ?>
										<option <?php if($studio==="2"){echo "selected";} ?> value="2">Sandy, UT</option>
										<option <?php if($studio==="3"){echo "selected";} ?> value="3">Taylorsville, UT</option>
										<option <?php if($studio==="4"){echo "selected";} ?> value="4">Sandy and Taylorsville,UT</option>
									<?php } ?>
								<?php } ?>
							<?php } ?>

							</select>
						</li>
						<li class="input-group">
							<label for="status" class="input-group-addon">Kung Fu Status:</label>
							<select  class="form-control" name="status">
								<?php if($id){?>
									<option <?php if($status==="0"){echo "selected";} ?> value="0">Active</option>
									<option <?php if($status==="1"){echo "selected";} ?> value="1">Not Active</option>
									<option <?php if($status==="2"){echo "selected";} ?> value="2">Non Student</option>
								<?php }else{?>
									<option value="0">Active</option>
									<option value="1">Not Active</option>
									<option selected value="2">Non Student</option>
								<?php }?>
							</select>
						</li>
						<li class="input-group">
							<label for="longTermProgram" class="input-group-addon">Kung Fu Terms:</label>
							<select  class="form-control" name="longTermProgram">
								<option <?php if($longTermProgram==="1"){echo "selected";}?> value="1">BPS</option>
								<option <?php if($longTermProgram==="2"){echo "selected";}?> value="2">contract</option>
								<option <?php if($longTermProgram==="3"){echo "selected";}?> value="3">3 Months</option>
								<option <?php if($longTermProgram==="4"){echo "selected";}?> value="4">6 Months</option>
								<option <?php if($longTermProgram==="5"){echo "selected";}?> value="5">12 Months</option>
								<option <?php if($longTermProgram==="6"){echo "selected";}?> value="6">Month to Month</option>
							</select>
						</li>
						<li class="input-group">
							<label for="lessonType" class="input-group-addon">Kung Fu Lesson Type:</label>
							<select  class="form-control" name="lessonType">
								<option <?php if($lessonType==="1"){echo "selected";}?> value="1">Group</option>
								<option <?php if($lessonType==="2"){echo "selected";}?> value="2">Private</option>
								<option <?php if($lessonType==="3"){echo "selected";}?> value="3">Accelerated</option>
								<option <?php if($lessonType==="4"){echo "selected";}?> value="4">BSP</option>							</select>
						</li>
						<li class="input-group">
							<label for="rank" class="input-group-addon">Kung Fu Rank:</label>
							<?php
							if($sessionRole=="admin" or $sessionRole=="districtMa"){
						?>
							<select  class="form-control" name="rank">
								<option <?php if($rank==23){echo "selected";}; ?> value="23">Youth White</option>
								<option <?php if($rank==24){echo "selected";}; ?> value="24">Youth Yellow</option>
								<option <?php if($rank==25){echo "selected";}; ?> value="25">Youth Orange</option>
								<option <?php if($rank==26){echo "selected";}; ?> value="26">Youth Purple</option>
								<option <?php if($rank==27){echo "selected";}; ?> value="27">Youth Blue</option>
								<option <?php if($rank==28){echo "selected";}; ?> value="28">Youth Blue Advanced</option>
								<option <?php if($rank==29){echo "selected";}; ?> value="29">Youth Green</option>
								<option <?php if($rank==30){echo "selected";}; ?> value="30">Youth Green Advanced</option>
								<option <?php if($rank==31){echo "selected";}; ?> value="31">Youth Red</option>
								<option <?php if($rank==32){echo "selected";}; ?> value="32">Youth Brown</option>
								<option <?php if($rank==33){echo "selected";}; ?> value="33">Youth Brown Advanced</option>
								<option <?php if($rank==1){echo "selected";}; ?> value="1">White</option>
								<option <?php if($rank==2){echo "selected";}; ?> value="2">Yellow</option>
								<option <?php if($rank==3){echo "selected";}; ?> value="3">Orange</option>
								<option <?php if($rank==4){echo "selected";}; ?> value="4">Purple</option>
								<option <?php if($rank==5){echo "selected";}; ?> value="5">Blue</option>
								<option <?php if($rank==6){echo "selected";}; ?> value="6">Blue Advanced</option>
								<option <?php if($rank==7){echo "selected";}; ?> value="7">Green</option>
								<option <?php if($rank==8){echo "selected";}; ?> value="8">Green Advanced</option>
								<option <?php if($rank==9){echo "selected";}; ?> value="9">Red</option>
								<option <?php if($rank==10){echo "selected";}; ?> value="10">Brown</option>
								<option <?php if($rank==11){echo "selected";}; ?> value="11">Brown Advanced</option>
								<option <?php if($rank==12){echo "selected";}; ?> value="12">Sidi</option>
								<option <?php if($rank==13){echo "selected";}; ?> value="13">Sidi Dai Lou</option>
								<option <?php if($rank==14){echo "selected";}; ?> value="14">Si Hing</option>
								<option <?php if($rank==15){echo "selected";}; ?> value="15">Si Hing Dai Lou</option>
								<option <?php if($rank==16){echo "selected";}; ?> value="16">Sisuk</option>
								<option <?php if($rank==17){echo "selected";}; ?> value="17">Sisuk Dai Lou</option>
								<option <?php if($rank==18){echo "selected";}; ?> value="18">Sifu</option>
								<option <?php if($rank==19){echo "selected";}; ?> value="19">Si Bok</option>
								<option <?php if($rank==20){echo "selected";}; ?> value="20">Si Gung</option>
								<option <?php if($rank==21){echo "selected";}; ?> value="21">Si Tai Gung</option>
								<option <?php if($rank==22){echo "selected";}; ?> value="22">Si Jo</option>
							</select>
							<?php
							}else{
								if($id){
						?>
							<select  class="form-control" name="rank">
								<option <?php echo $rank; ?>
									value="
									<?php echo $rank; ?>
									">
									<?php
									if($rank==23){echo "Youth White";};
									if($rank==24){echo "Youth Yellow";};
									if($rank==25){echo "Youth Orange";};
									if($rank==26){echo "Youth Purple";};
									if($rank==27){echo "Youth Blue";};
									if($rank==28){echo "Youth Blue Advanced";};
									if($rank==29){echo "Youth Green";};
									if($rank==30){echo "Youth Green Advanced";};
									if($rank==31){echo "Youth Red";};
									if($rank==32){echo "Youth Brown";};
									if($rank==33){echo "Youth Brown Advanced";};
									if($rank==1){echo "White";};
									if($rank==2){echo "Yellow";};
									if($rank==3){echo "Orange";};
									if($rank==4){echo "Purple";};
									if($rank==5){echo "Blue";};
									if($rank==6){echo "Blue Advanced";};
									if($rank==7){echo "Green";};
									if($rank==8){echo "Green Advanced";};
									if($rank==9){echo "Red";};
									if($rank==10){echo "Brown";};
									if($rank==11){echo "Brown Advanced";};
									if($rank==12){echo "Sidi";};
									if($rank==13){echo "Sidi Dai Lou";};
									if($rank==14){echo "Si Hing";};
									if($rank==15){echo "Si Hing Dai Lou";};
									if($rank==16){echo "Sisuk";};
									if($rank==17){echo "Sisuk Dai Lou";};
									if($rank==18){echo "Sifu";};
									if($rank==19){echo "Si Bok";};
									if($rank==20){echo "Si Gung";};
									if($rank==21){echo "Si Tai Gung";};
									if($rank==22){echo "Si Jo";};
								?></option>
							</select>
							<?php
								}else{
						?>
							<select  class="form-control" name="rank">
								<option <?php if($role==="23"){echo "selected";}?> value="23">Youth White</option>
								<option <?php if($role==="1"){echo "selected";}?> value="1">White</option>
							</select>
							<?php
							}
						}
						?></li>
						<li class="input-group">
							<label for="rankDate" class="input-group-addon">Kung Fu Rank Date:</label>
							<input  class="form-control" name="rankDate" type="date" id="rankDate" value="<?php echo $rankDate; ?>"/></li>
						<li class="input-group">
							<label for="dueDate" class="input-group-addon">Kung Fu Due Date:</label>
							<input  class="form-control" name="dueDate" type="date" id="dueDate" value="<?php echo $dueDate; ?>"/></li>
					</ul>

					<h3>Tai Chi</h3>
					<ul>
						<li class="input-group">
							<label for="name" class="input-group-addon">Tai Chi Studio:</label>
							<select  class="form-control" name="taiChiStudio" >
								<?php if($sessionRole=='admin'){ ?>
									<option <?php if($taiChiStudio==="0"){echo "selected";} ?> value="0">None</option>
									<option <?php if($taiChiStudio==="1"){echo "selected";} ?> value="1">Glendale, AZ</option>
									<option <?php if($taiChiStudio==="2"){echo "selected";} ?> value="2">Sandy, UT</option>
									<option <?php if($taiChiStudio==="3"){echo "selected";} ?> value="3">Taylorsville, UT</option>
									<option <?php if($taiChiStudio==="4"){echo "selected";} ?> value="4">Sandy and Taylorsville,UT</option>
								<?php }else{ ?>
									<?php if($sessionRole=='districtMa'){ ?>
										<option <?php if($taiChiStudio==="0"){echo "selected";} ?> value="0">None</option>
										<?php if($sessionRoleStudio=='1'){ ?>
											<option <?php if($taiChiStudio==="1"){echo "selected";} ?> value="1">Glendale, AZ</option>
										<?php } ?>
										<?php if($sessionRoleStudio=='2'){ ?>
											<option <?php if($taiChiStudio==="2"){echo "selected";} ?> value="2">Sandy, UT</option>
											<option <?php if($taiChiStudio==="3"){echo "selected";} ?> value="3">Taylorsville, UT</option>
											<option <?php if($taiChiStudio==="4"){echo "selected";} ?> value="4">Sandy and Taylorsville,UT</option>
										<?php } ?>
										<?php if($sessionRoleStudio=='3'){ ?>
											<option <?php if($taiChiStudio==="2"){echo "selected";} ?> value="2">Sandy, UT</option>
											<option <?php if($taiChiStudio==="3"){echo "selected";} ?> value="3">Taylorsville, UT</option>
											<option <?php if($taiChiStudio==="4"){echo "selected";} ?> value="4">Sandy and Taylorsville,UT</option>
										<?php } ?>
										<?php if($sessionRoleStudio=='4'){ ?>
											<option <?php if($taiChiStudio==="2"){echo "selected";} ?> value="2">Sandy, UT</option>
											<option <?php if($taiChiStudio==="3"){echo "selected";} ?> value="3">Taylorsville, UT</option>
											<option <?php if($taiChiStudio==="4"){echo "selected";} ?> value="4">Sandy and Taylorsville,UT</option>
										<?php } ?>
									<?php } ?>
									<?php if($sessionRole=='manager'){ ?>
										<option <?php if($taiChiStudio==="0"){echo "selected";} ?> value="0">None</option>
										<?php if($sessionRoleStudio=='1'){ ?>
											<option <?php if($taiChiStudio==="1"){echo "selected";} ?> value="1">Glendale, AZ</option>
										<?php } ?>
										<?php if($sessionRoleStudio=='2'){ ?>
											<option <?php if($taiChiStudio==="2"){echo "selected";} ?> value="2">Sandy, UT</option>
										<?php } ?>
										<?php if($sessionRoleStudio=='3'){ ?>
											<option <?php if($taiChiStudio==="3"){echo "selected";} ?> value="3">Taylorsville, UT</option>
										<?php } ?>
										<?php if($sessionRoleStudio=='4'){ ?>
											<option <?php if($taiChiStudio==="2"){echo "selected";} ?> value="2">Sandy, UT</option>
											<option <?php if($taiChiStudio==="3"){echo "selected";} ?> value="3">Taylorsville, UT</option>
											<option <?php if($taiChiStudio==="4"){echo "selected";} ?> value="4">Sandy and Taylorsville,UT</option>
										<?php } ?>
									<?php } ?>
								<?php } ?>
							</select>
					</li>
					<li class="input-group">
						<label for="taiChiStatus" class="input-group-addon">Tai Chi Status:</label>
						<select  class="form-control" name="taiChiStatus" data-mini="taiChiStatus">
							<?php if($id){?>
							<option <?php if($taiChiStatus==="0"){echo "selected";}?> value="0">Active</option>
							<option <?php if($taiChiStatus==="1"){echo "selected";}?> value="1">Not Active</option>
							<option <?php if($taiChiStatus==="2"){echo "selected";}?> value="2">Non Student</option>							<?php }else{?>
							<option value="0">Active</option>
							<option value="1">Not Active</option>
							<option selected value="2">Non Student</option>
							<?php }?></select>
					</li>
					<li class="input-group">
						<label for="TaiChiProgram" class="input-group-addon">Tai Chi Terms:</label>
						<select  class="form-control" name="TaiChiProgram">
							<option <?php if($TaiChiProgram==="1"){echo "selected";} ?> value="1">BPS</option>
							<option <?php if($TaiChiProgram==="2"){echo "selected";} ?> value="2">contract</option>
							<option <?php if($TaiChiProgram==="3"){echo "selected";} ?> value="3">3 Months</option>
							<option <?php if($TaiChiProgram==="4"){echo "selected";} ?> value="4">6 Months</option>
							<option <?php if($TaiChiProgram==="5"){echo "selected";} ?> value="5">12 Months</option>
							<option <?php if($TaiChiProgram==="6"){echo "selected";} ?> value="6">Month to Month</option>
						</select>
					</li>
					<li class="input-group">
						<label for="TaiChiLessonType" class="input-group-addon">Tai Chi Lesson Type:</label>
						<select  class="form-control" name="TaiChiLessonType">
							<option <?php if($TaiChiLessonType==="1"){echo "selected";} ?> value="1">Group</option>
							<option <?php if($TaiChiLessonType==="2"){echo "selected";} ?> value="2">Private</option>
							<option <?php if($TaiChiLessonType==="3"){echo "selected";} ?> value="3">Accelerated</option>
							<option <?php if($TaiChiLessonType==="4"){echo "selected";} ?> value="4">BSP</option>
						</select>
					</li>
					<li class="input-group">
						<label for="TaiChiRank" class="input-group-addon">Tai Chi Rank:</label>
						<select  class="form-control" name="TaiChiRank">
							<?php if($sessionRole=='admin' or $sessionRole=='districtMa'){ ?>
							<option <?php if($TaiChiRank==0){echo "selected";}; ?> value="0">White Sash</option>
							<option <?php if($TaiChiRank==5){echo "selected";}; ?> value="5">Youth Gold Sash</option>
							<option <?php if($TaiChiRank==6){echo "selected";}; ?> value="6">Youth Blue Sash</option>
							<option <?php if($TaiChiRank==7){echo "selected";}; ?> value="7">Youth Red Sash</option>
							<option <?php if($TaiChiRank==1){echo "selected";}; ?> value="1">Gold Sash</option>
							<option <?php if($TaiChiRank==2){echo "selected";}; ?> value="2">Blue Sash</option>
							<option <?php if($TaiChiRank==3){echo "selected";}; ?> value="3">Red Sash</option>
							<option <?php if($TaiChiRank==12){echo "selected";}; ?> value="12">Sidi</option>
							<option <?php if($TaiChiRank==13){echo "selected";}; ?> value="13">Sidi Dai Lou</option>
							<option <?php if($TaiChiRank==14){echo "selected";}; ?> value="14">Si Hing</option>
							<option <?php if($TaiChiRank==15){echo "selected";}; ?> value="15">Si Hing Dai Lou</option>
							<option <?php if($TaiChiRank==16){echo "selected";}; ?> value="16">Sisuk</option>
							<option <?php if($TaiChiRank==17){echo "selected";}; ?> value="17">Sisuk Dai Lou</option>
							<option <?php if($TaiChiRank==18){echo "selected";}; ?> value="18">Sifu</option>
							<option <?php if($TaiChiRank==19){echo "selected";}; ?> value="19">Si Bok</option>
							<option <?php if($TaiChiRank==20){echo "selected";}; ?> value="20">Si Gung</option>
							<option <?php if($TaiChiRank==21){echo "selected";}; ?> value="21">Si Tai Gung</option>
							<option <?php if($TaiChiRank==22){echo "selected";}; ?> value="22">Si Jo</option>
							<?php }else{  if($id){ ?>
							<option selected value="<?php echo $TaiChiRank; ?>
								">
								<?php
									if($TaiChiRank==0){echo "White Sash";};
									if($TaiChiRank==23){echo "Youth White";};
									if($TaiChiRank==5){echo "Youth Gold Sash";};
									if($TaiChiRank==6){echo "Youth Blue Sash";};
									if($TaiChiRank==7){echo "Youth Red Sash";};
									if($TaiChiRank==1){echo "Gold Sash";};
									if($TaiChiRank==2){echo "Blue Sash";};
									if($TaiChiRank==3){echo "Red Sash";};
									if($TaiChiRank==12){echo "Sidi";};
									if($TaiChiRank==13){echo "Sidi Dai Lou";};
									if($TaiChiRank==14){echo "Si Hing";};
									if($TaiChiRank==15){echo "Si Hing Dai Lou";};
									if($TaiChiRank==16){echo "Sisuk";};
									if($TaiChiRank==17){echo "Sisuk Dai Lou";};
									if($TaiChiRank==18){echo "Sifu";};
									if($TaiChiRank==19){echo "Si Bok";};
									if($TaiChiRank==20){echo "Si Gung";};
									if($TaiChiRank==21){echo "Si Tai Gung";};
									if($TaiChiRank==22){echo "Si Jo";};
									?></option>
							<?php 	}else{ ?>
							<option <?php echo $TaiChiRank5; ?> value="23">Youth White</option>
							<option <?php echo $TaiChiRank1; ?> value="0">White Sash</option>
							<?php } }?></select>
					</li>
					<li class="input-group">
						<label for="TaiChiRankDate" class="input-group-addon">Tai Chi Rank Date:</label>
						<input  class="form-control" name="TaiChiRankDate" id="TaiChiRankDate" type="date" value="<?php echo $TaiChiRankDate; ?>"/></li>
					<li class="input-group">
						<label for="taiChiDueDate" class="input-group-addon">Tai Chi Due Date:</label>
						<input  class="form-control" name="taiChiDueDate" id="taiChiDueDate" type="date" value="<?php echo $taiChiDueDate; ?>"/></li>
				</ul>
				<h3>Admin</h3>
				<ul>
					<li class="input-group">
						<label for="role" class="input-group-addon">Role <?php echo "$role"; ?>:</label>
						<select  class="form-control" name="role">
							<option <?php if($role==="student"){echo "selected";} ?> value="student">Student</option>
							<?php if($sessionRole=='admin' or $sessionRole=='districtMa'){ ?>
							<option <?php if($role==="instructor"){echo "selected";} ?> value="instructor">Instructor</option>
							<option <?php if($role==="insCollege"){echo "selected";} ?> value="insCollege">Instructors College</option>
							<option <?php if($role==="manager"){echo "selected";} ?> value="manager">Office Manager</option>
							<?php } ?>
							<?php if($sessionRole=='admin'){ ?>
							<option <?php if($role==="districtMa"){echo "selected";} ?> value="districtMa">Distric Manager</option>
							<option <?php if($role==="admin"){echo "selected";} ?> value="admin">Admin</option>
							<?php } ?>
						</select>
					</li>
					<?php
				if($sessionRole=="admin" or $sessionRole=="districtMa"){?>
					<li class="input-group">
						<label for="name" class="input-group-addon">Studio Role:</label>
						<select  class="form-control" name="studioRole" >
							<?php if($sessionRole=='manager'){ ?>
							<option value="<?php echo $studioRole; ?>
								">
								<?php
									if($studioRole==0){echo "None";}
									if($studioRole==1){echo "Glendale, AZ";}
									if($studioRole==2){echo "Sandy, UT";}
									if($studioRole==3){echo "Taylorsville, UT";}
									if($studioRole==4){echo "Sandy and Taylorsville,UT";}
								?></option>
							<?php }else{ ?>
								<option <?php if($studioRole==="0"){echo "selected";} ?> value="0">None</option>
								<option <?php if($studioRole==="1"){echo "selected";} ?> value="1">Glendale, AZ</option>
								<option <?php if($studioRole==="2"){echo "selected";} ?> value="2">Sandy, UT</option>
								<option <?php if($studioRole==="3"){echo "selected";} ?> value="3">Taylorsville, UT</option>
								<option <?php if($studioRole==="4"){echo "selected";} ?> value="4">Sandy and Taylorsville,UT</option>
							<?php } ?></select>
					</li>
							<?php if($sessionRole=="admin"){ ?>
							<li class="input-group">
								<label for="un" class="input-group-addon">User Name:</label>
								<input  class="form-control" name="un" type="text" id="un" value="<?php echo "$un"; ?>"/></li>
							<li class="input-group">
								<label for="pw" class="input-group-addon">Password:</label>
								<input  class="form-control" name="pw" type="text" id="pw" value="<?php echo "$pw"; ?>"/></li>
							<?php } ?>
						<?php } ?>
					</ul>
					<ul>
						<li class="input-group">
							<label for="name" class="input-group-addon">Notes:</label>
							<input  class="form-control" name="notes" type="text" id="name" value="<?php echo $notes; ?>"/>
						</li>
					</ul>
					<ul>
						<li class="input-group">
							<input type="submit"  class="btn btn-primary" style="margin-right: 20px;" name="submit" value="<?php if($id){ echo "Update"; }else{ echo "Add"; } ?>" />

							<?php
								if($id){
									if($sessionRole=="admin" or $sessionRole=="districtMa"){
									echo "
										<a href=\"update_processor.php?delete=".$id."\" class=\"btn btn-primary\" >Delete Record (Cannot be undone)</a>";
									}
								}
							?>

						</li>
					</ul>
		<a href="admin.php"   class="btn btn-primary">Return to the admin tool</a>
		</div>
		<input type="hidden" value="<?php echo $id; ?>" name="id" /></form>
</section>
</div>
</div>
<?php include 'includes/footer.php'; ?>
<?php ob_end_flush();?>
