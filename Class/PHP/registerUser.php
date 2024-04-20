<?php

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$lastname = $_POST['lastname'];
		$firstname = $_POST['firstname'];
		$email = $_POST['email'];
		$sex = $_POST['sex'];
		$birthday = date('Y-m-d',strtotime($_POST['birthday']));
		$username = $_POST['username'];
		$password = MD5($_POST['password']);


		$acct_type = $_POST['acct_type'];

		$recovery_question = $_POST['recover_question'];
		$recovery_answer = $_POST['passAnswer'];
		

		$conn = mysqli_connect("localhost","root","","huvmts");		
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		 	echo "<script>window.alert('mysqli_connect_error()')</script>";
		}
		
		$sql = "INSERT INTO `account` (`firstname`, `lastname`, `email`, `birthday`, `sex`, `username`, `password`, `acct_type`, `recovery_question`, `recovery_answer`) 
				VALUES ('$firstname', '$lastname', '$email', '$birthday', '$sex', '$username', '$password', '$acct_type', '$recovery_question', '$recovery_answer');";

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






















