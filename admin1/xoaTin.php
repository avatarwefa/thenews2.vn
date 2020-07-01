<?php
	ob_start();
	session_start();
	echo $_SESSION["idGroup"];
	if(!isset($_SESSION["idUser"]) || $_SESSION["idGroup"] != 1){
		header("location:../index.php");
	}
	
	require "../lib/dbCon.php";
	require "../lib/quantri.php";
	
	
?>
<?php
	$idTin 	= $_GET["idTin"];
	settype($idTin, "int");
	$conn 	= myConnect();
	$qr 	= "DELETE FROM tin
				WHERE idTin = '$idTin'
			";
	mysqli_query($conn, $qr);
	header("location:listTin.php");
?>
