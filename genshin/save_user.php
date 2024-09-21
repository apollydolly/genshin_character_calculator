<?php
	include ("db.php");
  	$login = trim($_POST['login']);
  	$password = trim($_POST['password']);
  	if(!empty($login) && !empty($password)){
  	// проверка на существование пользователя с таким же логином
		$result = mysqli_query($db, "SELECT iduser FROM user WHERE login='$login'");
		$myrow = mysqli_fetch_array($result);
		if (!empty($myrow['iduser'])) { ?>
			<div class="pers_calc">
				<div class="sign">
					<p class='sign'>Извините, введённый вами логин уже зарегистрирован. Введите другой логин</p>
					<a href = 'index.php?page=signin' >Попробовать снова</a>
					<img src="img\lumin2.jpg" width="250" height="250" alt="Люмин">
				</div>
			</div>
		<?php }
		else {
		$password = password_hash($password, PASSWORD_DEFAULT);
		$result2 = mysqli_query ($db, "INSERT INTO user (login,password) VALUES('$login','$password')") or die("Ошибка " . mysqli_error($db));
			$result3 = mysqli_query($db, "SELECT `login`, `password`, `iduser` from `user` WHERE login='$login'");
			$user = mysqli_fetch_array($result3);
		$_SESSION['login'] = $login;
		$_SESSION['iduser'] = $user['iduser'];?>
		<div class="pers_calc">
			<div class="sign">
					<p class='sign'>Вы успешно зарегистрированы!</p>
					<a href='index.php?page=calc'>Калькулятор</a>
					<img src="img\welcome.jpeg" width="400" height="250" alt="Welcome">
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