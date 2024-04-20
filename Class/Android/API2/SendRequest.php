<?php  
  session_start();
  $vehicletype = $_POST['vehicletype'];
  $start = $_POST['start'];
  $to = $_POST['to'];
  $destination = $_POST['destination'];
  $username = $_POST['username'];

  $conn = mysqli_connect("localhost","root","","huvmts");  

  $dpt_sql = "SELECT * FROM `department` WHERE `username` = '".$username."'"; 
  $dept = mysqli_query($conn,$dpt_sql);
  $row = mysqli_fetch_array($dept);

  $dpt_name = $row['dept_name'];    

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
    
  $sql = "INSERT INTO `request` (`dept_name`,`username`, `vehicle_type`, `start_time`, `end_time`, `destination`, `report`,`dept_see`,`mgr_see`)
  VALUES ('$dpt_name','$username', '$vehicletype', '$start', '$to', '$destination', 'not','new','no');";

  if (mysqli_query($conn, $sql)) {
    echo "you send request successfully";
  } else {
    echo "unable to send request";
  }
      
    
    mysqli_close($conn);
?>