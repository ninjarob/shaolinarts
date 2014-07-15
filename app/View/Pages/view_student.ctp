<?php
	require 'includes/check_session.php';
	$sessionRole = $_SESSION['sessionRole'];
	$sessionRoleStudio = $_SESSION['sessionRoleStudio'];
	require 'includes/roleCheck.php';
	require 'includes/connect.php';
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/banner.php'; ?>
<?php include 'includes/navigation.php'; ?>
</div>
<div class="row corpus">
	<div class="col-md-3 asideColumn hidden-xs hidden-sm">
	<aside class="contentCol">
		<?php include 'includes/admin_pages_column.php'; ?>
	</aside>
	</div>
	<div class="col-md-9 sectionContent">
		<section class="contentCol">
<div class="content">
	<h1>View Student</h1>
	<p style="margin-bottom: 20px;">
		<a href="admin.php"  data-role="button" data-mini="true" data-inline="true" data-icon="back" >Return to the admin tool</a>
	</p>
<?php
	$id=$array["id"];
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
	$birthday = date("F d Y", strtotime($birthday));
	$spouseGuardian=$array["spouseGuardian"];
	$sgPhone=$array["sgPhone"];
	$sgCellPhone=$array["sgCellPhone"];
	$startDate=$array["startDate"];
	$startDate = date("F d Y", strtotime($startDate));
	$dueDate=$array["dueDate"];
	$dueDate = date("F d Y", strtotime($dueDate));
	$status=$array["status"];
	if($status==0){ $status= "Active";}
	if($status==1){ $status= "Not Active";}
	if($status==2){ $status= "Non Student";}
	$studio=$array["studio"];
	if($studio==0){ $studio= "None";}
	if($studio==1){ $studio= "Glendale, AZ";}
	if($studio==2){ $studio= "Sandy, UT";}
	if($studio==3){ $studio= "Taylorsville, UT";}
	if($studio==4){ $studio= "Sandy and Taylorsville,UT";}
	$rank=$array["rank"];
	if($rank==23) { $rank="Youth White";}
	if($rank==24) { $rank="Youth Yellow";}
	if($rank==25) { $rank="Youth Orange";}
	if($rank==26) { $rank="Youth Purple";}
	if($rank==27) { $rank="Youth Blue";}
	if($rank==28) { $rank="Youth Blue Advanced";}
	if($rank==29) { $rank="Youth Green";}
	if($rank==30) { $rank="Youth Green Advanced";}
	if($rank==31) { $rank="Youth Red";}
	if($rank==32) { $rank="Youth Brown";}
	if($rank==33) { $rank="Youth Brown Advanced";}
	if($rank==1) { $rank="White";}
	if($rank==2) { $rank="Yellow";}
	if($rank==3) { $rank="Orange";}
	if($rank==4) { $rank="Purple";}
	if($rank==5) { $rank="Blue";}
	if($rank==6) { $rank="Blue Advanced";}
	if($rank==7) { $rank="Green";}
	if($rank==8) { $rank="Green Advanced";}
	if($rank==9) { $rank="Red";}
	if($rank==10) { $rank="Brown";}
	if($rank==11) { $rank="Brown Advanced";}
	if($rank==12) { $rank="Sidi";}
	if($rank==13) { $rank="Sidi Dai Lou";}
	if($rank==14) { $rank="Si Hing";}
	if($rank==15) { $rank="Si Hing Dai Lou";}
	if($rank==16) { $rank="Sisuk";}
	if($rank==17) { $rank="Sisuk Dai Lou";}
	if($rank==18) { $rank="Sifu";}
	if($rank==19) { $rank="Si Bok";}
	if($rank==20) { $rank="Si Gung";}
	if($rank==21) { $rank="Si Tai Gung";}
	if($rank==22) { $rank="Si Jo";}
	$rankDate=$array["rankDate"];
	$rankDate = date("F d Y", strtotime($rankDate));
	$notes=$array["notes"];
	$longTermProgram=$array["longTermProgram"];
	if($longTermProgram==1){$longTermProgram="BPS";}
	if($longTermProgram==2){$longTermProgram="contract";}
	if($longTermProgram==3){$longTermProgram="3 Months";}
	if($longTermProgram==4){$longTermProgram="6 Month";}
	if($longTermProgram==5){$longTermProgram="12 Month";}
	if($longTermProgram==6){$longTermProgram="Month to Month";}
	$lessonType=$array["lessonType"];
	if($lessonType==1){$lessonType="Group";}
	if($lessonType==2){$lessonType="Private";}
	if($lessonType==3){$lessonType="Accelerated";}
	if($lessonType==4){$lessonType="BSP";}
	$taiChiStatus=$array["taiChiStatus"];
	if($taiChiStatus==0){ $taiChiStatus= "Active";}
	if($taiChiStatus==1){ $taiChiStatus= "Not Active";}
	if($taiChiStatus==2){ $taiChiStatus= "Non Student";}
	$taiChiStudio=$array["taiChiStudio"];
	if($taiChiStudio==0){ $taiChiStudio= "None";}
	if($taiChiStudio==1){ $taiChiStudio= "Glendale, AZ";}
	if($taiChiStudio==2){ $taiChiStudio= "Sandy, UT";}
	if($taiChiStudio==3){ $taiChiStudio= "Taylorsville, UT";}
	if($taiChiStudio==4){ $taiChiStudio= "Sandy and Taylorsville,UT";}
	$TaiChiRank=$array["TaiChiRank"];
	if($TaiChiRank==0) { $TaiChiRank= " White Sash";}
	if($TaiChiRank==5) { $TaiChiRank= " Youth Gold Sash";}
	if($TaiChiRank==6) { $TaiChiRank= " Youth Blue Sash";}
	if($TaiChiRank==7) { $TaiChiRank= " Youth Red Sash";}
	if($TaiChiRank==1) { $TaiChiRank= " Gold Sash";}
	if($TaiChiRank==2) { $TaiChiRank= " Blue Sash";}
	if($TaiChiRank==3) { $TaiChiRank= " Red Sash";}
	if($TaiChiRank==12) { $TaiChiRank= " Sidi";}
	if($TaiChiRank==13) { $TaiChiRank= " Sidi Dai Lou";}
	if($TaiChiRank==14) { $TaiChiRank= " Si Hing";}
	if($TaiChiRank==15) { $TaiChiRank= " Si Hing Dai Lou";}
	if($TaiChiRank==16) { $TaiChiRank= " Sisuk";}
	if($TaiChiRank==17) { $TaiChiRank= " Sisuk Dai Lou";}
	if($TaiChiRank==18) { $TaiChiRank= " Sifu";}
	if($TaiChiRank==19) { $TaiChiRank= " Si Bok";}
	if($TaiChiRank==20) { $TaiChiRank= " Si Gung";}
	if($TaiChiRank==21) { $TaiChiRank= " Si Tai Gung";}
	if($TaiChiRank==22) { $TaiChiRank= " Si Jo";}
	$TaiChiRankDate=$array["TaiChiRankDate"];
	$TaiChiRankDate = date("F d Y", strtotime($TaiChiRankDate));
	$TaiChiProgram=$array["TaiChiProgram"];
	if($TaiChiProgram==1){$TaiChiProgram="BPS";}
	if($TaiChiProgram==2){$TaiChiProgram="contract";}
	if($TaiChiProgram==3){$TaiChiProgram="3 Months";}
	if($TaiChiProgram==4){$TaiChiProgram="6 Months";}
	if($TaiChiProgram==5){$TaiChiProgram="12 Months";}
	if($TaiChiProgram==6){$TaiChiProgram="Month to Month";}
	$TaiChiLessonType=$array["TaiChiLessonType"];
	if($TaiChiLessonType==1){$TaiChiLessonType="Group";}
	if($TaiChiLessonType==2){$TaiChiLessonType="Private";}
	if($TaiChiLessonType==3){$TaiChiLessonType="Accelerated";}
	if($TaiChiLessonType==4){$TaiChiLessonType="BSP";}
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
?>
	<ul class="list-group">
		<?php if($picture){ ?>
		<li class="list-group-item">
			<span>
				<img src="upload/<?php echo "$picture"; ?>" style="width: 300px;" /></span>
		</li>
		<?php } ?>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Name:</label>
			<span>
				<?php echo "$name $lastName"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Home Phone:</label>
			<span>
				<?php echo "$homePhone"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Cell Phone:</label>
			<span>
				<?php echo "$cellPhone"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Work Phone:</label>
			<span>
				<?php echo "$workPhone"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">email:</label>
			<span>
				<?php echo "$email"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Address:</label>
			<span>
				<?php echo "$addres"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">City:</label>
			<span>
				<?php echo "$city"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">State:</label>
			<span>
				<?php echo "$state"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">ZIP:</label>
			<span>
				<?php echo "$zip"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Birth Day:</label>
			<span>
				<?php echo "$birthday"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Spouse / Guardan:</label>
			<span>
				<?php echo "$spouseGuardian"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">S/G Phone:</label>
			<span>
				<?php echo "$sgPhone"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">S/G Cell Phone:</label>
			<span>
				<?php echo "$sgCellPhone"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Start Date:</label>
			<span>
				<?php echo "$startDate"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Due Date:</label>
			<span>
				<?php echo "$dueDate"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Kung Fu Status:</label>
			<span>
				<?php echo "$status"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Kung Fu Studio:</label>
			<span>
				<?php echo "$studio"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Kung Fu Program Term:</label>
			<span>
				<?php echo "$longTermProgram"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Kung Fu Lesson Type:</label>
			<span>
				<?php echo "$lessonType"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Kung Fu Rank:</label>
			<span>
				<?php echo "$rank"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Kung Fu Rank Date:</label>
			<span>
				<?php echo "$rankDate"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Tai Chi Status:</label>
			<span>
				<?php echo "$taiChiStatus"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Tai Chi Studio:</label>
			<span>
				<?php echo "$taiChiStudio"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Tai Chi Program Term:</label>
			<span>
				<?php echo "$TaiChiProgram"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Tai Chi Lesson Type:</label>
			<span>
				<?php echo "$TaiChiLessonType"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Tai Chi Rank:</label>
			<span>
				<?php echo "$TaiChiRank"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Tai Chi Rank Date:</label>
			<span>
				<?php echo "$TaiChiRankDate"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">ICE Name:</label>
			<span>
				<?php echo "$ice1"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">ICE Phone:</label>
			<span>
				<?php echo "$ice1Phone"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">ICE Cellphone:</label>
			<span>
				<?php echo "$ice1CellPhone"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">ICE 2 Name:</label>
			<span>
				<?php echo "$ice2"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">ICE 2 Phone:</label>
			<span>
				<?php echo "$ice2Phone"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">ICE 2 Cellphone:</label>
			<span>
				<?php echo "$ice2CellPhone"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">ICE 3 Name:</label>
			<span>
				<?php echo "$ice3"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">ICE 3 Phone:</label>
			<span>
				<?php echo "$ice3Phone"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">ICE 3 Cellphone:</label>
			<span>
				<?php echo "$ice3CellPhone"; ?>&nbsp;</span>
		</li>
		<li class="list-group-item">
			<label for="name" style="display: block; float: left; width: 190px; font-weight: bold;">Notes:</label>
			<span>
				<?php echo "$notes"; ?>&nbsp;</span>
		</li>
	</ul>
	<p style="margin-bottom: 20px;">
		<a href="admin.php"  data-role="button" data-mini="true" data-inline="true" data-icon="back" >Return to the admin tool</a>
	</p>
</div>
		</section>
	</div>
</div>
<?php include 'includes/footer.php'; ?>
<?php ob_end_flush();?>
