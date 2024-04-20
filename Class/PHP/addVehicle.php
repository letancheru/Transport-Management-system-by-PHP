<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$platno = $_POST['platno'];
		$no_seat = $_POST['seatno'];
		$type = $_POST['vehicletype'];
		$report = "not";


		$conn = mysqli_connect("localhost","root","","huvmts");		
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		 	echo "<script>window.alert('mysqli_connect_error()')</script>";
		}
		
		$sql = "INSERT INTO `vehicle` (`plate_no`, `no_seat`, `Vehicle_type`, `report`) 
				VALUES ('$platno', '$no_seat', '$type', '$report';";

		if (mysqli_query($conn, $sql)) {
		 	echo "<script>window.alert('register successfully!')</script>";
		 	$x=true;
		 } else {
		 	echo "<script>window.alert('username is alrady Exist!')</script>";
		 	$x=true;
		 }
		  
		
		mysqli_close($conn);
	}
?>