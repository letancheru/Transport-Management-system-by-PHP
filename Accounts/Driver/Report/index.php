<!DOCTYPE html>
<?php
  session_start();

  $conn = mysqli_connect("localhost","root","","huvmts"); 
  $dr = "SELECT * FROM `driver` WHERE `username` = '".$_SESSION['username']."'"; 
  $fe = mysqli_query($conn,$dr);
  $rw = mysqli_fetch_array($fe);
  $driver_id = $rw['driver_id'];
  $dr_actv = "SELECT * FROM `vehicle_on_duty` WHERE `driver_id` = '$driver_id'"; 
  $fetch = mysqli_query($conn,$dr_actv);
  if (mysqli_num_rows($fetch)<1) {
    echo "<script>window.alert('you are not assigned')</script>";
    header("Location:../index.php");
  }



  $title = "Send Report";
  $DriverHome = "";
  $DriverInbox = "";
  $DriverSend = "active";
  $Schedule="";
  
  if (!isset($_SESSION['firstname'])) {
    header("Location:../../../index.php");
  }
  if ($_SESSION['acct_type']!="Driver") {
    header("Location:../../../index.php");
  }
  include_once "../../../pages/layout/Driver/DriverNavs.php";
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
    

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">


                        <form Method = "post"  enctype="multipart/form-data">
                          <div class="col-md-3 col-sm-3"></div>
                          <div class = " col-md-7 col-sm-7 col-xs-12">            
                            <h2 align="center">press button exist blow if you are from trip returned</h2>
                            <div class = "col-md-3 col-md-offset-4 col-sm-3 col-sm-offset-4 col-xs-3 col-xs-offset-4">
                              <input type = "submit" value="returned" class = "btn btn-success" />
                            </div>
                          </div>
                        </form>

                </div>
              </div>
            </div>
            


          </div>
        </div>
        <!-- /page content -->
<?php
  include_once "../../../pages/layout/driver/DriverFoot.php";
?>

<?php
  if ($_SERVER['REQUEST_METHOD']=="POST") {
    mysql_connect("localhost","root","");
    mysql_select_db("huvmts");

    //========================== select from driver table =======
    $dr_ftch = mysql_query("SELECT * FROM `driver` WHERE `username` = '".$_SESSION['username']."'");
    $dr_row = mysql_fetch_array($dr_ftch);
    $dr_id = $dr_row['driver_id'];
    //========================== select from vehicle_on_duty table =======
    $dr_ftch = mysql_query("SELECT * FROM `vehicle_on_duty` WHERE `driver_id` = '$dr_id'");
    $dr_row = mysql_fetch_array($dr_ftch);
    $plate_no = $dr_row['plate_no'];
    $destney = $dr_row['destney'];

    //========== inserting into database   ====================
    $approval = 0;
    $result = mysql_query("SELECT * FROM `driver_report`WHERE `driver_id` = '$dr_id'");
    if($result){
      while ($rowss = mysql_fetch_assoc($result)) {
        if ($rowss['approval']=='yes') {
          $approval = 1;
        }else{
          $approval = 0;          
        }
      }
    }
    if($approval == 1) {
      if(mysql_query("INSERT INTO `driver_report`(`driver_id`, `plate_no`, `destny`,`approval`,`mgr_seen`) 
      VALUES ('$dr_id','$plate_no','$destney','no','no')")){
        echo "<script>window.alert('you report is sent successfully')</script>";
      }
    }else{
      echo "<script>window.alert('you alrady sent you are returned from trip')</script>";      
    }
  }
?>