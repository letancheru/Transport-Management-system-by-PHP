<?php
  if (isset($_SERVER['QUERY_STRING'])) {
    $ID = $_SERVER['QUERY_STRING'];
    mysql_connect("localhost","root","");
    mysql_select_db("huvmts");
    if(mysql_query("DELETE FROM `post` WHERE `post`.`ID` = $ID")){
      header("Location:Updat post.php");
    }
  }
?>