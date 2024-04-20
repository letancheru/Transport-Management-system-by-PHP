<?php
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$birthday = $_POST['birthday'];
		$password = $_POST['password'];
		if ($_FILES['photo']['tmp_name'] != "" || $_FILES['photo']['tmp_name'] != null) {
			$imagetmp = addslashes (file_get_contents($_FILES['photo']['tmp_name']));
		}

		mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());     
        mysql_select_db("huvmts") or die(mysql_error());	
		
		$displayText = "";
		$fn = "";
		$ln = "";
		$bd = "";
		$sx = "";
		$pw = "";
		$pp = "";

		if ($firstname != ""||$firstname != null) {
			$result = mysql_query("UPDATE `account` SET `firstname` = '$firstname' WHERE `username` = '".$_SESSION['username']."';")or die(mysql_error());
			if($result){
				$displayText = "fristname";
				$fn = "fristname";
			}
		}		

		if ($lastname != ""||$lastname != null) {
			$result = mysql_query("UPDATE `account` SET `lastname` = '$lastname' WHERE `username` = '".$_SESSION['username']."';")or die(mysql_error());
			if($result){
				$displayText = $displayText.", lastname";
				$ln = "lastname";
			}
		}


		if ($birthday != ""||$birthday != null) {
			$result = mysql_query("UPDATE `account` SET `birthday` = '$birthday' WHERE `username` = '".$_SESSION['username']."';")or die(mysql_error());
			if($result){
				$displayText = $displayText.", birthday";
				$bd = "birthday";
			}
		}


		if ($password != ""||$password != null) {
			$result = mysql_query("UPDATE `account` SET `firstname` = '$firstname' WHERE `username` = '".$_SESSION['username']."';")or die(mysql_error());
			if($result){
				$displayText = $displayText.", password";
				$pw = "password";
			}
		}


		if (isset($imagetmp)) {
			$result = mysql_query("UPDATE `account` SET `profilepicture` = '{$imagetmp}' WHERE `username` = '".$_SESSION['username']."';")or die(mysql_error());
			if($result){
				$displayText += ", profile Picture";
				$pp = "profile Picture";
			}
		}
		if ($fn != "" || $ln != "" || $bd != "" || $sx != "" || $pw != "" || $pp != "") {
		 	echo "<script>window.alert('you UPDATE $displayText successfully!')</script>";	
			$raw_results2 = mysql_query("SELECT * FROM Account
	            WHERE (`username` = '".$_SESSION['username']."') OR (`password` = '$password')")or die(mysql_error());
	        if(mysql_num_rows($raw_results2) == 1){
	            $results = mysql_fetch_array($raw_results2);
	            $_SESSION['firstname'] = $results['firstname'];
	            $_SESSION['lastname'] = $results['lastname'];
	            $_SESSION['birthday'] = $results['birthday'];
	            $_SESSION['sex'] = $results['sex'];
	            $_SESSION['password'] = $results['password'];
	            $_SESSION['profilepicture'] = $results['profilepicture'];
	        }			
		} else {
		 	echo "<script>window.alert('Please Press UPDATE after you insert something')</script>";			
		}
	}
?>