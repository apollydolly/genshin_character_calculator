<?php if (isset($_POST['button'])) {
	$tlev = $_POST['tlev'];
	$jlev = $_POST['jlev'];
	$sklev1 = $_POST['sklev1'];
	$elev1 = $_POST['elev1'];
	$qlev1 = $_POST['qlev1'];
	$sklev2 = $_POST['sklev2'];
	$elev2 = $_POST['elev2'];
	$qlev2 = $_POST['qlev2'];
	$tlev_s = $tlev;
	$charactersexp=0; $mora=0; $boss=0; $wonders=0; $weekboss=0; $crowns=0;
	$gems2=0; $gems3=0; $gems4=0; $gems5=0;
	$enemies1=0; $enemies2=0; $enemies3=0;
	$expbook2=0; $expbook3=0; $expbook4=0;
	$talbook2=0; $talbook3=0; $talbook4=0;
	$materials='';
	$characters=0;
	while($tlev!=$jlev){
		if ($tlev==1){
			$charactersexp=$charactersexp+120175;
			$mora=$mora+24000;
			$tlev=20;
			continue;
		}
		if ($tlev==20){
			$mora=$mora+20000;
			$gems2=$gems2+1;
			$wonders=$wonders+3;
			$enemies1=$enemies1+3;
			$charactersexp=$charactersexp+578325;
			$mora=$mora+115600;
			$tlev=40;
			continue;
		}
		if ($tlev==40){
			$mora=$mora+40000;
			$gems3=$gems3+3;
			$boss=$boss+2;
			$wonders=$wonders+10;
			$enemies1=$enemies1+15;
			$charactersexp=$charactersexp+579100;
			$mora=$mora+115800;
			$tlev=50;
			continue;
		}
		if ($tlev==50){
			$mora=$mora+60000;
			$gems3=$gems3+6;
			$boss=$boss+4;
			$wonders=$wonders+20;
			$enemies2=$enemies2+12;
			$charactersexp=$charactersexp+854125;
			$mora=$mora+170800;
			$tlev=60;
			continue;
		}
		if ($tlev==60){
			$mora=$mora+80000;
			$gems4=$gems4+3;
			$boss=$boss+8;
			$wonders=$wonders+30;
			$enemies2=$enemies2+18;
			$charactersexp=$charactersexp+1195925;
			$mora=$mora+239200;
			$tlev=70;
			continue;
		}
		if ($tlev==70){
			$mora=$mora+100000;
			$gems4=$gems4+6;
			$boss=$boss+12;
			$wonders=$wonders+45;
			$enemies3=$enemies3+12;
			$charactersexp=$charactersexp+1611875;
			$mora=$mora+322200;
			$tlev=80;
			continue;
		}
		if ($tlev==80){
			$mora=$mora+120000;
			$gems5=$gems5+6;
			$boss=$boss+20;
			$wonders=$wonders+60;
			$enemies3=$enemies3+24;
			$charactersexp=$charactersexp+3423125;
			$mora=$mora+684600;
			$tlev=90;
			continue;
			}
		}
		$expbook4=intdiv($charactersexp, 20000);
		$expbook3=intdiv(($charactersexp-$expbook4*20000),5000);
		$expbook2=ceil(($charactersexp-$expbook4*20000-$expbook3*5000)/1000);

		function talants($lev1, $lev2, $mora, $talbook2, $talbook3, $talbook4, $enemies1, $enemies2, $enemies3, $weekboss, $crowns){
			while ($lev1!=$lev2){
				if ($lev1==1){
					$mora=$mora+12500;
					$talbook2=$talbook2+3;
					$enemies1=$enemies1+6;
					$lev1=2;
					continue;
				}
				if ($lev1==2){
					$mora=$mora+17500;
					$talbook3=$talbook3+2;
					$enemies2=$enemies2+3;
					$lev1=3;
					continue;
				}
				if ($lev1==3){
					$mora=$mora+25000;
					$talbook3=$talbook3+4;
					$enemies2=$enemies2+4;
					$lev1=4;
					continue;
				}
				if ($lev1==4){
					$mora=$mora+30000;
					$talbook3=$talbook3+6;
					$enemies2=$enemies2+6;
					$lev1=5;
					continue;
				}
				if ($lev1==5){
					$mora=$mora+37500;
					$talbook3=$talbook3+9;
					$enemies2=$enemies2+9;
					$lev1=6;
					continue;
				}
				if ($lev1==6){
					$mora=$mora+120000;
					$talbook4=$talbook4+4;
					$enemies3=$enemies3+4;
					$weekboss=$weekboss+1;
					$lev1=7;
					continue;
				}
				if ($lev1==7){
					$mora=$mora+260000;
					$talbook4=$talbook4+6;
					$enemies3=$enemies3+6;
					$weekboss=$weekboss+1;
					$lev1=8;
					continue;
				}
				if ($lev1==8){
					$mora=$mora+450000;
					$talbook4=$talbook4+12;
					$enemies3=$enemies3+9;
					$weekboss=$weekboss+2;
					$lev1=9;
					continue;
				}
				if ($lev1==9){
					$mora=$mora+700000;
					$talbook4=$talbook4+16;
					$enemies3=$enemies3+12;
					$weekboss=$weekboss+2;
					$crowns=$crowns+1;
					$lev1=10;
					continue;
				}
			}
			return [$mora, $talbook2, $talbook3, $talbook4, $enemies1, $enemies2, $enemies3, $weekboss, $crowns];
		}

		[$mora, $talbook2, $talbook3, $talbook4, $enemies1, $enemies2, $enemies3, $weekboss, $crowns]=talants($sklev1, $sklev2, $mora, $talbook2, $talbook3, $talbook4, $enemies1, $enemies2, $enemies3, $weekboss, $crowns);

		[$mora, $talbook2, $talbook3, $talbook4, $enemies1, $enemies2, $enemies3, $weekboss, $crowns]=talants($elev1, $elev2, $mora, $talbook2, $talbook3, $talbook4, $enemies1, $enemies2, $enemies3, $weekboss, $crowns);

		[$mora, $talbook2, $talbook3, $talbook4, $enemies1, $enemies2, $enemies3, $weekboss, $crowns]=talants($qlev1, $qlev2, $mora, $talbook2, $talbook3, $talbook4, $enemies1, $enemies2, $enemies3, $weekboss, $crowns);

		$characters = $_POST['characters'];
		include ("db.php");
		$res = mysqli_query($db, "SELECT title, material.url_image, material.idmaterial FROM material 
						INNER JOIN character_has_material ON material.idmaterial=character_has_material.idmaterial 
						INNER JOIN `character` ON character_has_material.idcharacter=character.idcharacter
						WHERE character.idcharacter=$characters");
		$row = mysqli_fetch_all($res);
		$values = array($expbook4, $expbook3, $expbook2, $wonders, $boss, $gems5, $gems4, $gems3, $gems2, $enemies3, $enemies2, $enemies1, $crowns, $talbook4, $talbook3, $talbook2, $weekboss, $mora);

		$materials = array();
		for($i = 0; $i < count($values); $i++){
		    $temp_array = array();
		    $temp_array[] = $values[$i];
		    $temp_array = array_merge($temp_array, $row[$i]);
		    $materials[] = $temp_array;
		}
		// print_r($materials);
		// if (!empty($materials)) {
		//     foreach ($materials as $row) {
		//         if ($row[0] > 0) { 
		//             echo "<tr id='result'>";
		//             echo "<td align='right'>$row[0] x </td>";
		//             echo "<td><img src='$row[2]' width='30' height='30' alt='$row[1]'></td>";
		//             echo "<td align='left'>$row[1]</td>";
		//             echo "</tr>";
		//         }
		//     }
		// }
		// session_start();
		$_SESSION['materials'] = $materials;
		$_SESSION['characters'] = $characters;
		$_SESSION['tlev'] = $tlev_s;
		$_SESSION['jlev'] = $jlev;
		$_SESSION['sklev1'] = $sklev1;
		$_SESSION['elev1'] = $elev1;
		$_SESSION['qlev1'] = $qlev1;
		$_SESSION['sklev2'] = $sklev2;
		$_SESSION['elev2'] = $elev2;
		$_SESSION['qlev2'] = $qlev2;


		// $materials='';
		header('Location: index.php?page=calc');

} 	

if (isset($_POST['delbut'])) {
	$materials = $_SESSION['materials'];
	// $characters = $_SESSION['characters'];
	// $expbook4 = $_SESSION['expbook4'];
	// $expbook3 = $_SESSION['expbook3'];
	// $expbook2 = $_SESSION['expbook2'];
	// $gems5 = $_SESSION['gems5'];
	// $gems4 = $_SESSION['gems4'];
	// $gems3 = $_SESSION['gems3'];
	// $gems2 = $_SESSION['gems2'];
	// $boss = $_SESSION['boss'];
	// $wonders = $_SESSION['wonders'];
	// $enemies3 = $_SESSION['enemies3'];
	// $enemies2 = $_SESSION['enemies2'];
	// $enemies1 = $_SESSION['enemies1'];
	// $talbook2 = $_SESSION['talbook2'];
	// $talbook3 = $_SESSION['talbook3'];
	// $talbook4 = $_SESSION['talbook4'];
	// $weekboss = $_SESSION['weekboss'];
	// $crowns = $_SESSION['crowns'];
	// $mora = $_SESSION['mora'];
	$login = $_SESSION['login'];
	$id_user = $_SESSION['iduser'];
	$tlev = $_POST['tlev'];
	$jlev = $_POST['jlev'];
	$sklev1 = $_POST['sklev1'];
	$elev1 = $_POST['elev1'];
	$qlev1 = $_POST['qlev1'];
	$sklev2 = $_POST['sklev2'];
	$elev2 = $_POST['elev2'];
	$qlev2 = $_POST['qlev2'];

	include ("db.php");
	$ids = '';
	foreach ($materials as $row) {
		$ids .= $row[3] . ', ';
	}
	$ids = rtrim($ids, ', ');
	$res1 = mysqli_query($db, "SELECT idcalculations FROM quantity_indicator WHERE idmaterial IN ($ids)
		GROUP BY idcalculations
		HAVING COUNT(DISTINCT idmaterial) = 18;");
	$row1 = mysqli_fetch_row($res1);
	print_r($row1);
	if ($row1){
		foreach ($materials as $row) {
			$res2 = mysqli_query ($db, "UPDATE quantity_indicator
	        	SET quantity='$row[0]'
	 		WHERE idcalculations='$row1[0]' AND idmaterial='$row[3]';");
		}
		// $levels = [$tlev, $jlev, $sklev1, $elev1, $qlev1, $sklev2, $elev2, $qlev2];
		$res5 = mysqli_query($db, "UPDATE calculations SET current_character_level='$tlev', 
			desired_character_level='$jlev',
			current_talent1_level='$sklev1',
			desired_talent1_level='$sklev2',
			current_talent2_level='$elev1', 
			desired_talent2_level='$elev2',
			current_talent3_level='$qlev1',
			desired_talent3_level='$qlev2'
		    WHERE idcalculations='$row1[0]'");
	}
	else{
		// $res2 = mysqli_query($db, "INSERT INTO calculations (iduser) VALUE ('$id_user')");
		$res5 = mysqli_query($db, "INSERT INTO calculations (iduser, current_character_level, desired_character_level, current_talent1_level, desired_talent1_level, current_talent2_level, desired_talent2_level, current_talent3_level, desired_talent3_level) VALUES ('$id_user', '$tlev', '$jlev', '$sklev1', '$sklev2', '$elev1', '$elev2', '$qlev1', '$qlev2')");
		$id_material_list = mysqli_insert_id($db);
		foreach ($materials as $row) {
			$res3 = mysqli_query($db, "SELECT idmaterial FROM material WHERE title='$row[1]'");
			$row3 = mysqli_fetch_row($res3);
			$res4 = mysqli_query($db, "INSERT INTO quantity_indicator (quantity, idcalculations, iduser, idmaterial) VALUES ('$row[0]', '$id_material_list', '$id_user', '$row3[0]')");
		}
		// $levels = [$tlev, $jlev, $sklev1, $elev1, $qlev1, $sklev2, $elev2, $qlev2];
		// $res5 = mysqli_query($db, "INSERT INTO calculations VALUES ('$id_material_list', '$id_user', '$tlev', '$jlev', '$sklev1', '$sklev2', '$elev1', '$elev2', '$qlev1', '$qlev2')");
	}
	header('Location: index.php?page=calc');
}?>