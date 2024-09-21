<?php
	$router = [
		"index" => "index.php",
		"calc" => "calc.php",
		"todo" => "todo.php",
		"head" => "head.php",
		"nav" => "nav.html",
		"signin" => "signin.php",
		"registr" => "registr.php",
		"auth" => "auth.php",
		"save_user" => "save_user.php",
		"counter" => "counter.php",
		"todo_delete" => "todo_delete.php",
		"log_out" => "log_out.php",
		"footer" => "footer.html"];
	$page='';	
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}
	if ($page == '')
		$page = 'index';
	$CURRENT_PAGE = $page;
?>