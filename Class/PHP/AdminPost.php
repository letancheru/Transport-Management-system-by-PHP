<?php

		/*$subject = $_POST['subject'];
		$content = $_POST['content'];
		$acct_type = $_POST['acct_type'];
		$imagetmp = addslashes (file_get_contents($_FILES['photo']['tmp_name']));*/

	if ($_SERVER['REQUEST_METHOD']=="POST") {
		$subject = htmlspecialchars($_POST['subject']);
		$content = htmlspecialchars($_POST['content']);
		$acct_type = $_POST['acct_type'];
		$imagetmp = addslashes (file_get_contents($_FILES['photo']['tmp_name']));


	

		$conn = mysqli_connect("localhost","root","","huvmts");		
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		 	echo "<script>window.alert('mysqli_connect_error()')</script>";
		}

		$sql="INSERT INTO `post` (`Subject`, `Content`, `image`, `acct_type`) 
			VALUES ('$subject', '$content', '{$imagetmp}', '$acct_type');";

		if (mysqli_query($conn, $sql)) {
		 	echo "<script>window.alert('you post successfully!')</script>";
		 } else {
		 	echo "<script>window.alert('unable to post!')</script>";
		 }
	}	
?>