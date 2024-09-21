<form action="index.php?page=save_user" method="POST">
	<div class="pers_calc">
		<h1>Регистрация</h1>
		<div class="sign">
			<label for="text"><b>Логин</b></label>
			<input type="text" placeholder="Введите логин" name="login" required>
		</div>
		  
		<div class="sign">
			<label for="password"><b>Пароль</b></label>
			<input type="password" placeholder="Введите пароль" name="password" required>
		</div>

		<div class="sign">
			<input type="submit" value='Зарегистрироваться'>
		</div>

		<div class="sign">
			<p>Уже есть аккаунт? <a href = index.php?page=signin>Авторизироваться</a></p>
		</div>
	</div>
</form>