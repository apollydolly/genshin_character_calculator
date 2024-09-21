<?php include("conf.php");
    session_start(); ?>
<?php include("conf.php"); ?>
<!DOCTYPE html>
<html>
	<?php 
	include("head.php"); ?>
	<body>
		<header>
			<img src="img/logo2.png" alt="Логотип" width="140" height="50">
				Character Calculator
		</header>
		<?php include("nav.html");
		if ($CURRENT_PAGE == "index")include_once $router["signin"]; 
		else include_once $router[$CURRENT_PAGE]; ?>
		<?php include("footer.html"); ?>
	</body>
</html>
