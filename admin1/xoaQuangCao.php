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
	$idQC = $_GET["idQC"];
	settype($idQC, "int");
	$conn 	= myConnect();
	$qr 	="
		DELETE FROM quangcao
		WHERE idQC = '$idQC';
	";
	mysqli_query($conn, $qr);
	header("location:listQuangCao.php");
?>
