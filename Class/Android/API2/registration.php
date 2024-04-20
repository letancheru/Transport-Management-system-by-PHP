<?php
	mysql_connect("localhost","root","");
	mysql_select_db("huvmts");

	$fn = $_POST['fn'];
	$ln = $_POST['ln'];
	$bd = $_POST['bd'];
	$sx = $_POST['sx'];


	$un = $_POST['un'];
        $password = MD5($_POST['password']);
	$at = $_POST['at'];


	$pq = $_POST['pq'];
	$pa = $_POST['pa'];
	if ($fn!=""||$fn!=null||  $ln!=""||$ln!=null||  $bd!=""||$bd!=null||	$un!=""||$un!=null||  $password!=""||$password!=null||  $at!=""||$at!=null||	$pq!=""||$pq!=null||  $pa!=""||$pa!=null) {
		$SQL = "INSERT INTO `account`(`firstname`, `lastname`, `birthday`, `sex`, `username`, `password`, `acct_type`, `recovery_question`, `recovery_answer`)
			VALUES ('$fn','$ln','$bd','$sx','$un','$password','$at','$pq','$pa')";
		if(mysql_query($SQL)){
			echo "Register Successfully";
		}else{
			echo 'username is alrady Exist';
		}
	}else{
		echo "please fill all fild! 
		one field is not filled";
	}
?>