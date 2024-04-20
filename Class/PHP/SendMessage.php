<?php
	if ($_SERVER['REQUEST_METHOD']=="POST") {
		$To = htmlspecialchars($_POST['reciever']);
		$subject = htmlspecialchars($_POST['Subject']);
		$content = nl2br(htmlentities(mysql_real_escape_string($_POST['message'])));
		$sender = $_SESSION['username'];
	

		$conn = mysqli_connect("localhost","root","","huvmts");		
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		 	echo "<script>window.alert('mysqli_connect_error()')</script>";
		}
		if ($To!=$sender) {			
			$query = mysqli_query($conn, "SELECT * FROM `account` WHERE `username`='$To';");
			if(mysqli_num_rows($query) == 1){
				$sql="INSERT INTO `message` (`reciver`, `subject`, `content`, `sender`) 
				VALUES ('$To', '$subject', '$content', '$sender');";

				if (mysqli_query($conn, $sql)) {
				 	echo "<script>window.alert('you Send Message successfully!')</script>";
				} else {
				 	echo "<script>window.alert('Message is not sent!')</script>";
				}
			}else{
				echo "<script>window.alert('The user you Enter not exists!')</script>";			
			}
		}else{
			echo "<script>window.alert('Unable to send message! because you try to send message for yourself!')</script>";			
		}
	}
?>
