<?php
	echo '<script type="text/javascript">window.alert("'.'you reset your'.'");</script>';
		session_destroy();       
	    header("Location:login.php");
?>