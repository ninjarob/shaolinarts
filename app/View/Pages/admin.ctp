<?php
	require 'includes/check_session.php';
	$sessionRole = $_SESSION['sessionRole'];
	$sessionRoleStudio = $_SESSION['sessionRoleStudio'];
	$StudioSession = $_SESSION['StudioSession'];
	$TaiChiStudioSession = $_SESSION['TaiChiStudioSession'];
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
		<div class="content">
			<p>
				<?php
			if($sessionRole=='admin' || $sessionRole=='districtMa' || $sessionRole=='manager'){
				echo "
				<a href=\"edit_user.php\"  class=\"btn btn-primary\">Add User</a>
				";
			}
		?>
				<a href="pdf_viewer.php" target="_blank"  class="btn btn-primary">Visit the library</a>
			</p>
			<input id="search_input" placeholder="Type to filter">
			<ul id="search_list"  class="list-group" style="margin-top: 15px;">
				<?php
			$i=0;
			while ($i < $count) {
				$id=mysql_result($result,$i,"id");
				//$date=mysql_result($result,$i,"rankDate");
				//$date = strtotime($date);
				//$date = date('d/m/Y', $date);
				//$lvl_1_lenght = '3 days';
				//$lvl_2_lenght = '10 days';
				//$lvl_3_lenght = '30 days';
				//$compareDate=mysql_result($result,$i,"rankDate");
				//$compareDate = strtotime($compareDate);
				//$compareDate = date('Y.m.d', $compareDate);
				$fname=mysql_result($result,$i,"name");
				$lname=mysql_result($result,$i,"lastName");
				//$email=mysql_result($result,$i,"email");
				$birthday=mysql_result($result,$i,"birthday");
				$birthday = strtotime($birthday);
				$birthday = date('Y.m.d', $birthday);
				$todayDate = date('Y.m.d');
				$age = $todayDate - $birthday;
				//$dueDate=mysql_result($result,$i,"dueDate");
				//$dueDate = strtotime($dueDate);
				//$dueDate = date('d/m', $dueDate);
				$studio=mysql_result($result,$i,"studio");
				$taiChiStudio=mysql_result($result,$i,"taiChiStudio");
				//$program=mysql_result($result,$i,"program");
				$rank=mysql_result($result,$i,"rank");
				$status=mysql_result($result,$i,"status");
				$TaiChiRank=mysql_result($result,$i,"TaiChiRank");
				$taiChiStatus=mysql_result($result,$i,"taiChiStatus");
				$role=mysql_result($result,$i,"role");
				if($sessionRole=='admin'){
					require 'includes/admin_content.php';
				}
				if($sessionRole=='districtMa'){
					if($sessionRoleStudio==1){
						if($studio==1 || $taiChiStudio==1 || $taiChiStudio==0 && $studio==0){
							require 'includes/admin_content.php';
						}
					}
					if($sessionRoleStudio==2 || $sessionRoleStudio==3 || $sessionRoleStudio==4){
						if($studio >
				1 || $taiChiStudio > 1 || $studio==0 && $taiChiStudio==0){
							require 'includes/admin_content.php';
						}
					}
				}
				if($sessionRole=='manager'){
					if($sessionRoleStudio==$studio || $sessionRoleStudio==$taiChiStudio || $studio==0 && $taiChiStudio==0){
						require 'includes/admin_content.php';
					}
					if($sessionRoleStudio==4 && $studio > 1 || $sessionRoleStudio==4 && $taiChiStudio > 1){
						require 'includes/admin_content.php';
					}
				}
				if($sessionRole=='instructor'){
					if($sessionRoleStudio==$studio || $sessionRoleStudio==$taiChiStudio || $studio==0 && $taiChiStudio==0){
						require 'includes/admin_content.php';
					}
					if($sessionRoleStudio==4 && $studio > 1 || $sessionRoleStudio==4 && $taiChiStudio > 1 || $studio==0 && $taiChiStudio==0){
						require 'includes/admin_content.php';
					}
				}
				$i++;
			}
			?>
			</ul>
		</div>
	</section>
</div>
</div>
<?php include 'includes/footer.php'; ?>
<?php ob_end_flush();?>