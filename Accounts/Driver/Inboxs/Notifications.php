<!DOCTYPE html>
<?php
  $title = "Notification";
  $DriverHome = "";
  $DriverInbox = "active";
  $DriverSend = "";
  
  session_start();
  if (!isset($_SESSION['firstname'])) {
    header("Location:../../../index.php");
  }
  if ($_SESSION['acct_type']!="Driver") {
    header("Location:../../../index.php");
  }
  include_once "../../../pages/layout/Driver/DriverNavs.php";
  include '../../../Class/PHP/updateUserInfo.php';
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">

                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Notifications</h2>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <div id="alerts"></div>
                        <div class="col-md-offset-2 col-md-8">

                          <div class="row">
                            <div class="col-sm-4 mail_list_column">                          
                              <?php
                                $conn = mysqli_connect("localhost","root","","huvmts"); 
                                $dr = "SELECT * FROM `driver` WHERE `username` = '".$_SESSION['username']."'"; 
                                $fe = mysqli_query($conn,$dr);
                                $rw = mysqli_fetch_array($fe);
                                $driver_id = $rw['driver_id'];


                                $notIndex = 0;
                                $dr_actv = "SELECT * FROM `vehicle_on_duty` WHERE `driver_id` = '$driver_id'"; 
                                $fetch = mysqli_query($conn,$dr_actv);
                                while ($row = mysqli_fetch_array($fetch)) {
                                  $rqst_strt_tim = $row['start_time'];
                                  $rqst_end_tim = $row['End_time'];
                                  $rqst_dest = $row['destney']; 
                                  $plate_no = $row['plate_no']; 
                                                              
                              ?>
                              <a href="Notifications.php?<?php echo $rqst_ID;?>">
                                <div class="mail_list">
                                  <div class="left">
                                    <i class="fa fa-circle"></i>
                                  </div>
                                  <div class="right">
                                    <?php echo "<p>"."your are assigned to ".$row['destney']." from ".$row['start_time']."<p>";?>
                                  </div>
                                </div>
                              </a>
                              <?php
                                }
                              ?>
                            </div>

                            <div class="col-sm-8 mail_view">                        
                              <div class="inbox-body">
                                <?php
                                if (isset($plate_no)) {
                                  $sql = mysqli_query($conn,"SELECT * FROM `vehicle` WHERE `plate_no`='$plate_no'");
                                  $vcl_rw = mysqli_fetch_array($sql);
                                }
                                  if (isset($rqst_dest)) {                            
                                ?>
                                <div class="mail_heading row">
                                  <div class="col-md-8">
                                  </div>
                                  <div class="col-md-12">
                                    <h4>Notification</h4>
                                  </div>
                                </div>
                                <div class="view-mail">
                                  <h1>Dear <?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?></h1>
                                  <p>You are assigned on <?php echo $vcl_rw['Vehicle_type'];?> with plate number of 
                                    <?php echo $vcl_rw['plate_no'];?>. the vehicle could hold <?php echo $vcl_rw['no_seat'];?> passangers.
                                    The journey you travel heads to <?php echo $rqst_dest;?>
                                    from <?php echo $rqst_strt_tim;?> to <?php echo $rqst_end_tim;?>.
                                  </p>
                                </div>
                                <?php
                                  } else{
                                ?>
                                <div class="mail_heading row">
                                  <div class="col-md-12">
                                    <h2>You are not assigned yet</h2>
                                  </div>
                                </div>
                                <?php
                                }
                                ?>
                              </div>
                            </div>

                          </div>

                        </div>                        
                
                      </div>
                    </div>
                  </div>
            </div>
            
          </div>
        </div>
        <!-- /page content -->
<?php
  include_once "../../../pages/layout/driver/DriverFoot.php";
?>