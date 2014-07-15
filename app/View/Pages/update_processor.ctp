<?php
	require 'includes/connect.php';
	require 'includes/varDef.php';

	if($id){
		$sql="SELECT * FROM $tbl_name WHERE id='$id'";
		$result=mysql_query($sql);

		$count=mysql_num_rows($result);

		if($count==1){
			mysql_query("UPDATE `$tbl_name` SET name='$name', lastName='$lastName', homePhone='$homePhone', cellPhone='$cellPhone', workPhone='$workPhone', email='$email', addres='$addres', city='$city', state='$state', zip='$zip', birthday='$birthday', spouseGuardian='$spouseGuardian', sgPhone='$sgPhone', sgCellPhone='$sgCellPhone', startDate='$startDate', dueDate='$dueDate', studio='$studio', studioRole='$studioRole', program='$program', longTermProgram='$longTermProgram', lessonType='$lessonType', rank='$rank', rankDate='$rankDate', status='$status', studentID='$studentID', ice1='$ice1', ice1Phone='$ice1Phone', ice1CellPhone='$ice1CellPhone', ice2='$ice2', ice2Phone='$ice2Phone', ice2CellPhone='$ice2CellPhone', ice3='$ice3', ice3Phone='$ice3Phone', ice3CellPhone='$ice3CellPhone', un='$un', pw='$pw', role='$role', notes='$notes', TaiChiRank='$TaiChiRank', TaiChiRankDate='$TaiChiRankDate', taiChiDueDate='$taiChiDueDate', TaiChiProgram='$TaiChiProgram', TaiChiLessonType='$TaiChiLessonType', taiChiStudio='$taiChiStudio', taiChiStatus='$taiChiStatus'	WHERE id='$id';") or die(mysql_error("Database Error"));
			header("location:admin.php");
		}
	}else{

		if($delete){
			$sql="SELECT * FROM $tbl_name WHERE id='$delete'";
			$result=mysql_query($sql);
			$count=mysql_num_rows($result);
			if($count==1){
				mysql_query("DELETE FROM $tbl_name WHERE id=$delete;") or die(mysql_error());
				$result=mysql_query($sql);
				// Mysql_num_row is counting table row
				$count=mysql_num_rows($result);
				header("location:admin.php");
				mysql_close($con);
			}
		}else{
			$sql="SELECT * FROM $tbl_name WHERE name='$name' AND lastName='$lastName' AND birthday='$birthday'";
			$result=mysql_query($sql);

			// Mysql_num_row is counting table row
			$count=mysql_num_rows($result);

			if($count==0){
				mysql_query("INSERT INTO `$db_name`.`$tbl_name` (`id`, `name`, `lastName`, `homePhone`, `cellPhone`, `workPhone`, `email`, `addres`, `city`, `state`, `zip`, `birthday`, `spouseGuardian`, `sgPhone`, `sgCellPhone`, `startDate`, `dueDate`, `studio`, `program`, `longTermProgram`, `lessonType`, `rank`, `rankDate`, `status`, `studentID`, `ice1`, `ice1Phone`, `ice1CellPhone`, `ice2`, `ice2Phone`, `ice2CellPhone`, `ice3`, `ice3Phone`, `ice3CellPhone`, `un`, `pw`, `role`, `studioRole`, `notes`, `TaiChiRank`, `TaiChiRankDate`, `taiChiDueDate`, `TaiChiProgram`, `TaiChiLessonType`, `taiChiStudio`, `taiChiStatus`) VALUES (NULL, '$name', '$lastName', '$homePhone', '$cellPhone', '$workPhone', '$email', '$addres', '$city', '$state', '$zip', '$birthday', '$spouseGuardian', '$sgPhone', '$sgCellPhone', '$startDate', '$dueDate', '$studio', '$program', '$longTermProgram', '$lessonType', '$rank', '$rankDate', '$status', '$studentID', '$ice1', '$ice1Phone', '$ice1CellPhone', '$ice2', '$ice2Phone', '$ice2CellPhone', '$ice3', '$ice3Phone', '$ice3CellPhone', '$un', '$pw', '$role', '$studioRole', '$notes', '$TaiChiRank', '$TaiChiRankDate', '$taiChiDueDate', '$TaiChiProgram', '$TaiChiLessonType', '$taiChiStudio', '$taiChiStatus');") or die(mysql_error());
				header("location:admin.php");
			}else{
				header("Location:user_name_taken.php");
			}
		}
	}


	mysql_close($con);
?>