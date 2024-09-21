<?php if(isset($_SESSION['login'])){ 	?>

	<div id="myModal" class="modal">
	  <div class="modal-content">
	  	<div class="modal-header">
			<span class="close">&times;</span>
				<h2 id="modalTitle"></h2>
		</div>
	    <div class="modal-body">
	    	<div class="container">
	    		<embed id="emded" src="" width="700" height="500" allowcookies="false">
	    	</div>
	    </div>
	  </div>
	</div>

<script src="js/modal_display.js"></script>


	<div class="pers_calc">
		<?php $login = $_SESSION['login'];
		$id_user = $_SESSION['iduser'];
		$res = mysqli_query($db, "SELECT idcalculations FROM calculations WHERE iduser='$id_user'");
		$row = mysqli_fetch_all($res);
		if ($row){ ?>
			<form action="index.php?page=todo_delete" method="POST">
			<?php foreach ($row as $id_list) { 
				$res2 = mysqli_query($db, "SELECT quantity, title, url_image, quantity_indicator.idmaterial, location FROM quantity_indicator 
					INNER JOIN material ON quantity_indicator.idmaterial=material.idmaterial
					WHERE idcalculations='$id_list[0]'");
				$row2 = mysqli_fetch_all($res2);
				if ($row2){ ?>
					<div class="todo_rez">
					<?php $materials_ids = '';
					foreach ($row2 as $material){
						$materials_ids .= $material[3] . ", ";
					}
					$materials_ids = rtrim($materials_ids, ', ');
					$res3 = mysqli_query($db, "SELECT name, url_image FROM `character`
						INNER JOIN character_has_material ON character.idcharacter=character_has_material.idcharacter
						WHERE idmaterial IN ($materials_ids)
						GROUP BY character.idcharacter
						HAVING COUNT(DISTINCT idmaterial) = 18;");
					$row3 = mysqli_fetch_row($res3);?>
					<div class="pers_info">
					    <div class="info">
					    	<p class="persname"><?php echo $row3[0] ?></p>
							<img src="<?php echo $row3[1] ?>" width="90" height="90" alt="<?php echo $row3[0] ?>">
					    </div>
					    <div class="info">
					    	<?php $res4 = mysqli_query($db, "SELECT * FROM calculations WHERE idcalculations='$id_list[0]';");
							$row4 = mysqli_fetch_all($res4);?>
					    	<p class="levels" style="font-size: 14px; font-weight: bold;">Уровень персонажа</p>
					    	<p class="levels"><?php echo $row4[0][2] ?> -> <?php echo $row4[0][3] ?></p>
					    	<p class="levels" style="font-size: 14px; font-weight: bold;">Уровни талантов</p>
					    	<p class="levels"><?php echo $row4[0][4] ?> -> <?php echo $row4[0][5] ?>	Обычн. атака</p>
					    	<p class="levels"><?php echo $row4[0][6] ?> -> <?php echo $row4[0][7] ?>	Элем. навык</p>
					    	<p class="levels"><?php echo $row4[0][8] ?> -> <?php echo $row4[0][9] ?> Взрыв стихии</p>
					    </div>
					</div>
					<div class="materials">	
					<?php foreach ($row2 as $material) { 
						if ($material[0]>0){ ?>
							<figure>
								<img src="<?php echo $material[2] ?>" width="40" height="35" alt="<?php echo $material[1] ?>" title="<?php echo $material[1] ?>" class="imageId"  data-location="<?php echo $material[4] ?>"><figcaption><?php echo $material[0] ?></figcaption>
							</figure>

						<?php } 
					} ?>
					</div>
						 <p class="delbut">
				            <input type='submit' value='Удалить' name='butdel' onclick='setIdToDelete(<?php echo $id_list[0] ?>)'>
				        </p>
					</div>
				<?php } ?>
				
			<?php	} ?>
			<input type='hidden' id='idToDelete' name='id_to_delete'>
   			<input type='submit' value='Подтвердить удаление' name='submit' style='display: none'>
    		<?php 
    		$_SESSION['iduser']=$id_user;
    		    $idweekday=date( "N" );
    			// setlocale(LC_TIME, 'ru_RU.UTF-8');

				// // Создаем объект DateTime для текущей даты и времени
				// $current_date = new DateTime();

				// // Получаем текущий день недели на русском языке
				// $current_day_en = $current_date->format('l');

				// // Массив соответствия английских и русских названий дней недели
				// $day_names_ru = [
				// 	    'Monday' => 'Понедельник',
				// 	    'Tuesday' => 'Вторник',
				// 	    'Wednesday' => 'Среда',
				// 	    'Thursday' => 'Четверг',
				// 	    'Friday' => 'Пятница',
				// 	    'Saturday' => 'Суббота',
				// 	    'Sunday' => 'Воскресенье'
				// ];

				// // Переводим английское название дня недели на русский
				// $current_day_ru = $day_names_ru[$current_day_en]; ?>
					<div class="todo_rez">
						<p class='sign'>Сегодня
						<?php $res5 = mysqli_query($db, "SELECT * FROM weekday ORDER BY idweekday;");
				    	$row5 = mysqli_fetch_all($res5);?>
				    	<select name="characters" id="daysOfWeek">
					    	<?php foreach ($row5 as $row){ 
					    		if ($row[0] == $idweekday){ ?>
					    			<option selected value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
					    		<?php } 
					    		else { ?>
					    			<option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
					    		<?php }?>
					    	<?php } ?>
					    </select></p>   
						<p class='sign'>Можно добыть:</p>
							<div id="imagesContainer">

							</div>
					</div>
			</form>
			<script src="js/delete_list.js"></script>
			<script src="js/change_weekday.js"></script>


		<?php }
		else{ ?>
			<div class="sign">
				<p class='sign'>Записей в списке дел ещё нет</p>
				<a href = 'index.php?page=calc' >Добавить записи</a>
				<img src="img\persiki.jpg" width="500" height="300" alt="Персонажи">
			</div>
		<?php } ?>
		</div>
<?php }
else{ ?>
	<div class="pers_calc">
		<div class="sign">
			<p class='sign'>Для просмотра данной страницы необходимо авторизоваться.</p>
			<a href = 'index.php?page=signin' >Авторизация</a>
			<img src="img\iter_and_lumin.jpg" width="600" height="400" alt="Итер и люмин">
		</div>
	</div>
<?php } ?>