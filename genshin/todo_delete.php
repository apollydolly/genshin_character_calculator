<?php if (isset($_POST['butdel'])) {
	include ("db.php");
	// $idresult = substr($_POST['butdel'], 14);
	$id_to_delete  = $_POST['id_to_delete'];
	// print($id_to_delete);
	$result = mysqli_query ($db, "DELETE FROM calculations WHERE idcalculations='$id_to_delete'");
	header('Location: index.php?page=todo');
} ?>