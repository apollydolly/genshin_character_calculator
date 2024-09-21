<?php if(isset($_SESSION['login'])){ 
		$characters	= isset($_SESSION['characters']) ? $_SESSION['characters'] : null;
		$tlev = isset($_SESSION['tlev']) ?  $_SESSION['tlev'] : 1;
		$jlev = isset($_SESSION['jlev']) ?  $_SESSION['jlev'] : 90;
		$sklev1 = isset($_SESSION['sklev1']) ?  $_SESSION['sklev1'] : 1;
		$elev1 = isset($_SESSION['elev1']) ?  $_SESSION['elev1'] : 1;
		$qlev1 = isset($_SESSION['qlev1']) ?  $_SESSION['qlev1'] : 1;
		$sklev2 = isset($_SESSION['sklev2']) ?  $_SESSION['sklev2'] : 10;
		$elev2 = isset($_SESSION['elev2']) ?  $_SESSION['elev2'] : 10;
		$qlev2 = isset($_SESSION['qlev2']) ?  $_SESSION['qlev2'] : 10;?>

	<form action="index.php?page=counter" method="POST" id="form">
		<div class="pers_calc">
			<div class="pers">
				<p>Уровень персонажа</p>
				<?php $res = mysqli_query($db, "SELECT idcharacter, name FROM `character`");
				    $row = mysqli_fetch_row($res); ?>
			    <select name="characters" onchange="checkform()" id="characters">
			    	<?php foreach ($res as $row){ ?>
			    		<option value="<?php echo $row['idcharacter'] ?>" <?php echo ($characters == $row['idcharacter']) ? 'selected' : ''; ?>><?php echo $row['name'] ?></option>
			    	<?php } ?>
			    </select>
				<p>Текущий уровень</p>
				<p>
					<div class="form_radio_btn">
						<input id="tlev1" name="tlev" type="radio" value="1" onchange="checkform()" <?php echo ($tlev == 1) ? 'checked' : ''; ?>>
						<label for="tlev1">1</label>
					</div>
					<div class="form_radio_btn">
						<input id="tlev2" name="tlev" type="radio" value="20" onchange="checkform()" <?php echo ($tlev == 20) ? 'checked' : ''; ?>>
						<label for="tlev2">20</label>
					</div>
					<div class="form_radio_btn">
						<input id="tlev3" name="tlev" type="radio" value="40" onchange="checkform()" <?php echo ($tlev == 40) ? 'checked' : ''; ?>>
						<label for="tlev3">40</label>
					</div>
					<div class="form_radio_btn">
						<input id="tlev4" name="tlev" type="radio" value="50" onchange="checkform()" <?php echo ($tlev == 50) ? 'checked' : ''; ?>>
						<label for="tlev4">50</label>
					</div>
				</p>
				<p>
					<div class="form_radio_btn">
						<input id="tlev5" name="tlev" type="radio" value="60" onchange="checkform()" <?php echo ($tlev == 60) ? 'checked' : ''; ?>>
						<label for="tlev5">60</label>
					</div>
					<div class="form_radio_btn">
						<input id="tlev6" name="tlev" type="radio" value="70" onchange="checkform()" <?php echo ($tlev == 70) ? 'checked' : ''; ?>>
						<label for="tlev6">70</label>
					</div>
					<div class="form_radio_btn">
						<input id="tlev7" name="tlev" type="radio" value="80" onchange="checkform()" <?php echo ($tlev == 80) ? 'checked' : ''; ?>>
						<label for="tlev7">80</label>
					</div>
					<div class="form_radio_btn">
						<input id="tlev8" name="tlev" type="radio" value="90" onchange="checkform()" <?php echo ($tlev == 90) ? 'checked' : ''; ?>>
						<label for="tlev8">90</label>
					</div>
				</p>
				<p>Желаемый уровень</p>
				<p>
					<div class="form_radio_btn">
						<input id="jlev1" name="jlev" type="radio" value="1" onchange="checkform()" <?php echo ($jlev == 1) ? 'checked' : ''; ?>>
						<label for="jlev1">1</label>
					</div>
					<div class="form_radio_btn">
						<input id="jlev2" name="jlev" type="radio" value="20" onchange="checkform()" <?php echo ($jlev == 20) ? 'checked' : ''; ?>>
						<label for="jlev2">20</label>
					</div>
					<div class="form_radio_btn">
						<input id="jlev3" name="jlev" type="radio" value="40" onchange="checkform()" <?php echo ($jlev == 40) ? 'checked' : ''; ?>>
						<label for="jlev3">40</label>
					</div>
					<div class="form_radio_btn">
						<input id="jlev4" name="jlev" type="radio" value="50" onchange="checkform()" <?php echo ($jlev == 50) ? 'checked' : ''; ?>>
						<label for="jlev4">50</label>
					</div>
				</p>
				<p>
					<div class="form_radio_btn">
						<input id="jlev5" name="jlev" type="radio" value="60" onchange="checkform()" <?php echo ($jlev == 60) ? 'checked' : ''; ?>>
						<label for="jlev5">60</label>
					</div>
					<div class="form_radio_btn">
						<input id="jlev6" name="jlev" type="radio" value="70" onchange="checkform()" <?php echo ($jlev == 70) ? 'checked' : ''; ?>>
						<label for="jlev6">70</label>
					</div>
					<div class="form_radio_btn">
						<input id="jlev7" name="jlev" type="radio" value="80" onchange="checkform()" <?php echo ($jlev == 80) ? 'checked' : ''; ?>>
						<label for="jlev7">80</label>
					</div>
					<div class="form_radio_btn">
						<input id="jlev8" name="jlev" type="radio" value="90" onchange="checkform()" <?php echo ($jlev == 90) ? 'checked' : ''; ?>>
						<label for="jlev8">90</label>
					</div>
				</p>
			</div>

			<div class="pers">
				<p>Уровень талантов</p>
				<div class="lev_tal">
				    Обычная атака
				</div>
				<div class="lev_tal">
				    Особый навык
				</div>
				<div class="lev_tal">
				    Взрыв стихии
				</div>
				<p>Текущий уровень</p>
				<div class="lev_tal">
					<input type="number" min="1" max="10" value="<?php echo $sklev1 ?>" name="sklev1" id="sklev1" onchange="checkform()">
				</div>
				<div class="lev_tal">
				    <input type="number" min="1" max="10" value="<?php echo $elev1 ?>" name="elev1" id="elev1" onchange="checkform()">
				</div>
				<div class="lev_tal">
			        <input type="number" min="1" max="10" value="<?php echo $qlev1 ?>" name="qlev1" id="qlev1" onchange="checkform()">
			    </div>
			    <p>Желаемый уровень</p>
				<div class="lev_tal">
			    	<input type="number" min="1" max="10" value="<?php echo $sklev2 ?>" name="sklev2" id="sklev2" onchange="checkform()">
			    </div>
			    <div class="lev_tal">
				    <input type="number" min="1" max="10" value="<?php echo $elev2 ?>" name="elev2" id="elev2" onchange="checkform()">
				</div>
			    <div class="lev_tal">
			        <input type="number" min="1" max="10" value="<?php echo $qlev2 ?>" name="qlev2" id="qlev2" onchange="checkform()">
			    </div>
			</div>

			<div class="pers">
				<p><input type='submit' value='Рассчитать' name='button' id='button'></p>
					<div id="result">
						<?php
							$materials='';
							$check='';
							if(isset($_SESSION['materials'])){
								$materials = $_SESSION['materials'];
							}
							if ($materials !=''){ 
								$check=0;?>
								<table align=center>
								<?php foreach ($materials as $row) {
									if ($row[0]>0){ 
										$check=$check+1;?>
									    <tr id='result'>
									 		<td align=right><?php echo $row[0] ?> x </td>
									 		<td><img src="<?php echo $row[2] ?>" width="30"height="30" alt="<?php echo $row[1] ?>"></td>
											<td align=left><?php echo $row[1] ?></td>
										</tr>
									<?php }
								} ?>
								</table>
							<?php }
							if ($check>0){ 
								if(isset($_SESSION['login']) ){ ?>
								<p><input type='submit' value='Добавить в архив расчетов' name='delbut' id='delbut'></p>
								<?php 
								}
								else{ ?>
									<p class='sign'>Для добавления материалов в список дел необходимо авторизоваться.</p>
	    							<a href = 'index.php?page=signin' >Авторизация</a>
								<?php }
							 } ?>
					</div>	
			</div>
		</div>
	</form>

	<script src="js/form_checker.js"></script>

<?php }
else{ ?>
	<div class="pers_calc">
		<div class="sign">
		    <p class='sign'>Для просмотра данной страницы необходимо авторизоваться.</p>
		    <a href = 'index.php?page=signin' >Авторизация</a>
		    <img src="img\sumeru.jpg" width="600" height="380" alt="Сумеру">
		</div>
	</div>
<?php } ?>