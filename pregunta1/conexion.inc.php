<?php
	$conn = mysqli_connect("localhost","root","");
	if ($conn == false){
		echo "Ocurrio un error";
		die();
	}
	mysqli_select_db($conn, "FCPN");
?>
