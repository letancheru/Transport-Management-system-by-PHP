<?php
  
  $con = mysqli_connect("localhost","root","","huvmts");
     
  $username = $_POST['user_name'];
  $password = MD5($_POST['password']);
   
  $sql = "SELECT * from `account` where `username` = '$username' and `password`='$password'";   
  $result = mysqli_query($con,$sql);   

  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_array($result);

    session_start();

    $_SESSION['firstname'] = $row['firstname'];
    $_SESSION['lastname'] = $row['lastname'];
    $_SESSION['birthday'] = $row['birthday'];
    $_SESSION['sex'] = $row['sex'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['acct_type'] = $row['acct_type'];

    echo $row['acct_type'];
  }else{
    echo 'You Enter wrong username and/or password';
  }
   
  mysqli_close($con);
?>