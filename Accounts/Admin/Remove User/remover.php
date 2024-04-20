<?php
	if (isset($_SERVER['QUERY_STRING'])) {
		$query = $_SERVER['QUERY_STRING'];
		mysql_connect("localhost","root","");
		mysql_select_db("huvmts");
		if(mysql_query("DELETE FROM `account` WHERE `account`.`username` = '$query'")){
	      header("Location:index.php?Succesfully");
	    }
	}
?>