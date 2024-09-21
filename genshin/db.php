<?php
$servername = "localhost";
$database = "genshin_db";
$username = "root";
$password = "12345";
// Создаем соединение
$db = mysqli_connect($servername, $username, $password, $database);
// Проверяем соединение
if (!$db) {
	die("dbection failed: ");
}
?>
