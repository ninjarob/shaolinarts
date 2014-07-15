<?php
			echo "
				<li class=\"list-group-item\">
				<a title=\"View Student Information\" href=\"view_student.php?id=".$id."\">
					<span>".$fname." ".$lname."&nbsp;&nbsp;&nbsp;</span>
					<span>".floor($age)."&nbsp;&nbsp;&nbsp;</span>
			";
			if($status==0){
					echo "
							<span style= \"padding-right: 3px; font-weight: normal; font-size: 13px;\"><strong>Kung Fu:&nbsp;&nbsp;&nbsp;</strong></span>
					";



				if($rank==23){echo "<span>Youth White&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==24){echo "<span>Youth Yellow&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==25){echo "<span>Youth Orange&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==26){echo "<span>Youth Purple&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==27){echo "<span>Youth Blue&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==28){echo "<span>Youth Blue Advanced&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==29){echo "<span>Youth Green&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==30){echo "<span>Youth Green Advanced&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==31){echo "<span>Youth Red&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==32){echo "<span>Youth Brown&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==33){echo "<span>Youth Brown Advanced&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==1){echo "<span>White&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==2){echo "<span>Yellow&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==3){echo "<span>Orange&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==4){echo "<span>Purple&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==5){echo "<span>Blue&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==6){echo "<span>Blue Advanced&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==7){echo "<span>Green&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==8){echo "<span>Green Advanced&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==9){echo "<span>Red&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==10){echo "<span>Brown&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==11){echo "<span>Brown Advanced&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==12){echo "<span>Sidi&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==13){echo "<span>Sidi Dai Lou&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==14){echo "<span>Si Hing&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==15){echo "<span>Si Hing Dai Lou&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==16){echo "<span>Sisuk&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==17){echo "<span>Sisuk Dai Lou&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==18){echo "<span>Sifu&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==19){echo "<span>Si Bok&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==20){echo "<span>Si Gung&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==21){echo "<span>Si Tai Gung&nbsp;&nbsp;&nbsp;</span>";};
				if($rank==22){echo "<span>Si Jo&nbsp;&nbsp;&nbsp;</span>";};

				if($studio==1){echo "<span><strong> Glendale&nbsp;&nbsp;&nbsp;</strong></span>";}
				if($studio==2){echo "<span><strong> Sandy&nbsp;&nbsp;&nbsp;</strong></span>";}
				if($studio==3){echo "<span><strong> Taylorsvile&nbsp;&nbsp;&nbsp;</strong></span>";}

			}

			if($taiChiStatus==0){
					echo "<span style= \"padding-right: 3px; font-weight: normal; font-size: 13px;\"><strong>Tai Chi:&nbsp;&nbsp;&nbsp;</strong></span>";

					if($TaiChiRank==0){echo "<span>White&nbsp;&nbsp;&nbsp;</span>";};
					if($TaiChiRank==23){echo "<span>Si Jo&nbsp;&nbsp;&nbsp;</span>";};
					if($TaiChiRank==5){echo "<span>Youth Gold&nbsp;&nbsp;&nbsp;</span>";};
					if($TaiChiRank==6){echo "<span>Youth Blue&nbsp;&nbsp;&nbsp;</span>";};
					if($TaiChiRank==7){echo "<span>Youth Red&nbsp;&nbsp;&nbsp;</span>";};
					if($TaiChiRank==1){echo "<span>Gold&nbsp;&nbsp;&nbsp;</span>";};
					if($TaiChiRank==2){echo "<span>Blue&nbsp;&nbsp;&nbsp;</span>";};
					if($TaiChiRank==3){echo "<span>Red&nbsp;&nbsp;&nbsp;</span>";};
					if($TaiChiRank==12){echo "<span>Sidi&nbsp;&nbsp;&nbsp;</span>";};
					if($TaiChiRank==13){echo "<span>Sidi Dai Lou&nbsp;&nbsp;&nbsp;</span>";};
					if($TaiChiRank==14){echo "<span>Si Hing&nbsp;&nbsp;&nbsp;</span>";};
					if($TaiChiRank==15){echo "<span>Si Hing Dai Lou&nbsp;&nbsp;&nbsp;</span>";};
					if($TaiChiRank==16){echo "<span>Sisuk&nbsp;&nbsp;&nbsp;</span>";};
					if($TaiChiRank==17){echo "<span>Sisuk Dai Lou&nbsp;&nbsp;&nbsp;</span>";};
					if($TaiChiRank==18){echo "<span>Sifu&nbsp;&nbsp;&nbsp;</span>";};
					if($TaiChiRank==19){echo "<span>Si Bok&nbsp;&nbsp;&nbsp;</span>";};
					if($TaiChiRank==20){echo "<span>Si Gung&nbsp;&nbsp;&nbsp;</span>";};
					if($TaiChiRank==21){echo "<span>Si Tai Gung&nbsp;&nbsp;&nbsp;</span>";};
					if($TaiChiRank==22){echo "<span>Si Jo&nbsp;&nbsp;&nbsp;</span>";};

					if($taiChiStudio==1){echo "<span><strong>Glendale&nbsp;&nbsp;&nbsp;</strong></span>";}
					if($taiChiStudio==2){echo "<span><strong>Sandy&nbsp;&nbsp;&nbsp;</strong></span>";}
					if($taiChiStudio==3){echo "<span><strong>Taylorsvile&nbsp;&nbsp;&nbsp;</strong></span>";}
			}

			if($status==1 && $taiChiStatus==1){ echo "<span style= \"padding-right: 3px; font-weight: normal; font-size: 13px;\"> <strong>Not Active&nbsp;&nbsp;&nbsp;</strong></span> ";}
			if(($status==2 && $taiChiStatus==1) || ($status==1 && $taiChiStatus==2)){ echo "<span style= \"padding-right: 3px; font-weight: normal; font-size: 13px;\"> <strong>Not Active&nbsp;&nbsp;&nbsp;</strong></span> ";}
			if($status==2 && $taiChiStatus==2){ echo "<span style= \"padding-right: 3px; font-weight: normal; font-size: 13px;\"> <strong>Non Student&nbsp;&nbsp;&nbsp;</strong></span> ";}
			echo"</a>";

			if($sessionRole!='instructor'){ echo"<a style=\"float: right; font-size: 20px;\" class=\"glyphicon glyphicon-edit\" title=\"Edit Student Information\" href=\"edit_user.php?id=".$id."\"></a>";}
			echo"</li>";



?>