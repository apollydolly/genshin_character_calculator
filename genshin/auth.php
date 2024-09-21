<?php include 'db.php';
	$login = trim($_POST['login']);
	$password = trim($_POST['password']);
	if(!empty($login) && !empty($password)){
		$res = mysqli_query($db, "SELECT `login`, `password`, `iduser` from `user` WHERE login ='$login'");
		$row = mysqli_fetch_array($res);
		if($row){
		  	if(password_verify($password, $row['password'])){
				$_SESSION['login'] = $row['login'];
				$_SESSION['iduser'] = $row['iduser']; ?>
				<div class="pers_calc">
					<div class="sign">
						<p class='sign'>Авторизация прошла успешно. Добро пожаловать, <?php echo $_SESSION['login'] ?></p>
						<img src="img\welcome.jpeg" width="400" height="250" alt="Welcome">
						<a href="index.php?page=log_out">Выйти из аккаунта</a>
					</div>
				</div>
		  	<?php } 
		  	else { ?>
		  		<div class="pers_calc">
			  		<div class="sign">
						<p class='sign'>Неверный пароль</p>
						<a href = 'index.php?page=signin' >Попробовать снова</a>
						<img src="img\lumin2.jpg" width="250" height="250" alt="Люмин">
					</div>
				</div>
			<?php }
		} 
		else { ?>
			<div class="pers_calc">
				<div class="sign">
					<p class='sign'>Пользователя с таким логином не существует</p>
					<a href = 'index.php?page=signin' >Попробовать снова</a>
					<img src="img\lumin2.jpg" width="250" height="250" alt="Люмин">
				</div>
			</div>
		<?php }
	} 
	else { ?>
		<div class="pers_calc">
			<div class="sign">
				<p class='sign'>Вы ввели не всю информацию, вернитесь назад и заполните все поля!</p>
				<a href = 'index.php?page=signin' >Попробовать снова</a>
				<img src="img\lumin2.jpg" width="250" height="250" alt="Люмин">
			</div>
		</div>
 	<?php } ?>