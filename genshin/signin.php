<?php if(isset($_SESSION['login'])){ ?>
  	<div class="pers_calc">
		<div class="sign">
	  		<a href="index.php?page=log_out">Выйти из аккаунта</a>
	  		<img src="img\welcome.jpeg" width="400" height="250" alt="Welcome">
		</div>  
  	</div>
<?php }
else{ ?>
  	<form action="index.php?page=auth" method="POST">
		<div class="pers_calc">
	 		<h1>Авторизация</h1>
	  		<div class="sign">
				<label for="text"><b>Логин</b></label>
				<input type="text" placeholder="Введите логин" name="login" required>
	  		</div>
	  
		  	<div class="sign">
				<label for="password"><b>Пароль</b></label>
				<input type="password" placeholder="Введите пароль" name="password" required>
		  	</div>

		  	<div class="sign">
				<input type="submit" value='Войти'>
		  	</div>

		  	<div class="sign">
				<p>Еще нет аккаунта? <a href = index.php?page=registr>Зарегистрироваться</a></p>
		  	</div>
		</div>
  	</form>
<?php } ?>