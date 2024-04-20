<?php
	echo "daniella.".$_SERVER['QUERY_STRING'];
	if ($_SERVER['QUERY_STRING']!=""||$_SERVER['QUERY_STRING']!=null) {
        mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());     
        mysql_select_db("huvmts") or die(mysql_error());
		$QUERYSTR = $_SERVER['QUERY_STRING'];
		$raw_results = mysql_query("SELECT * FROM `message` WHERE `m_id` = $QUERYSTR") or die(mysql_error());
		while($results = mysql_fetch_array($raw_results)){
			$username = $results['sender'];
	        $sqlSender = mysql_query("SELECT `firstname`,`lastname`,`acct_type` FROM account where `username`='$username';")or die(mysql_error());
	        while ($sender = mysql_fetch_array($sqlSender)) {
	        	$time = $results['time'];
	        	$name = $sender['firstname'].' '.$sender['firstname'];
	        	$senderUsername = $results['sender'];
	        	$subjects = $results['subject'];
	        	$content = $results['content'];
				header("Location:../../Accounts/Manager/Inboxs/index.php");
			}
		}
	} else {	
		$raw_results = mysql_query("SELECT * FROM `message` ORDER BY m_id DESC LIMIT 1") or die(mysql_error());
	    while($results = mysql_fetch_array($raw_results)){
	      $username = $results['sender'];
	          $sqlSender = mysql_query("SELECT `firstname`,`lastname`,`acct_type` FROM account where `username`='$username';")or die(mysql_error());
	          while ($sender = mysql_fetch_array($sqlSender)) {
	            $time = $results['time'];
	            $name = $sender['firstname'].' '.$sender['firstname'];
	            $senderUsername = $results['sender'];
	            $subjects = $results['subject'];
	            $content = $results['content'];
	      
			}
	    }
	}
	
?>