<!DOCTYPE html>
<?php
  $title = "Notifications";
  $securityHome = "";
  
  
  session_start();
  if (!isset($_SESSION['firstname'])) {
    header("Location:../../../index.php");
  }
  if ($_SESSION['acct_type']!="Security") {
    header("Location:../../../index.php");
  }
  include_once "../../../pages/layout/security/SecurityNavs.php";
   $conn = mysqli_connect("localhost","root","","huvmts"); 
  $dpt_sql = "SELECT * FROM `account` WHERE `acct_type` = 'Department' "; 
    $dept = mysqli_query($conn,$dpt_sql);
    $row = mysqli_fetch_array($dept);

    $username = $row['username'];
   echo $username;  echo $username;  echo $username;  echo $username;  echo $username; 
    $reportIndex = 0;
    $replayed = 0;
    $report = "";
    $replayArray = "";
    $username = $_SESSION['username'];
    $conn = mysqli_connect("localhost","root","","huvmts");  

    $dpt_sql = "SELECT * FROM `department` WHERE `username` = '$username'"; 
    $dept = mysqli_query($conn,$dpt_sql);
    $row = mysqli_fetch_array($dept);

    $dpt_name = $row['dept_name'];
           
    
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
                                $notIndex = 0;
                                $rprt_sql = "SELECT * FROM `request` WHERE `report` <> 'not' AND `username`"; 
                                $fetch = mysqli_query($conn,$rprt_sql);
                                while ($row = mysqli_fetch_array($fetch)) {
                                  $rqst_strt_tim = $row['start_time'];
                                  $rqst_end_tim = $row['end_time'];
                                  $rqst_vcl_type = $row['vehicle_type'];
                                  $rqst_dest = $row['destination'];   
                                  $rqst_ID = $row['r_id'];  

                                  $dept_see_bold = "p";
                                  $dept_see_icon = "fa fa-circle-thin";
                                  if ($row['dept_see'] == "no") {
                                    $dept_see_bold = "h3";
                                    $dept_see_icon = "fa fa-circle";
                                  }                             
                              ?>
                              <a href="notification.php?<?php echo $rqst_ID;?>">
                                <div class="mail_list">
                                  <div class="left">
                                    <i class="<?php echo $dept_see_icon; ?>"></i>
                                  </div>
                                  <div class="right">
                                    <?php echo "<$dept_see_bold>"."your request to ".$row['destination']." from ".$row['start_time']." is replayed"."<$dept_see_bold>";?>
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

                                  if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING']!="") {
                                    $open = $_SERVER['QUERY_STRING'];
                                    $rtv_as_sql = "SELECT * FROM `request` WHERE `dept_see` <> 'new' AND `r_id` = $open;";

                                    $ft = mysqli_query($conn,$rtv_as_sql);
                                    while ($rq_row = mysqli_fetch_array($ft)) {
                                      $seenSQL = "UPDATE `request` SET `dept_see` = 'yes' WHERE `r_id` = '".$rq_row['r_id']."';";
                                      mysqli_query($conn,$seenSQL);

                                      $rq_r_id = $rq_row['r_id'];
                                    
                                      $rtv_as_sql = "SELECT * FROM `vehicle_on_duty` WHERE `r_id` = ".$rq_row['r_id'].";";
                                      $fetch_as = mysqli_query($conn,$rtv_as_sql);
                                      while ($row_as = mysqli_fetch_array($fetch_as)) {
                                        $asg_strt_tim = $row_as['start_time'];
                                        $asg_end_tim = $row_as['End_time'];
                                        $asg_vcl = $row_as['plate_no'];                                    

                                        $vcl_sql = "SELECT * FROM `vehicle` WHERE `plate_no` = '$asg_vcl';";
                                        $fetch_vcl = mysqli_query($conn,$vcl_sql);
                                        while ($row_vcl = mysqli_fetch_array($fetch_vcl)) {
                                          $asg_vcl_typ = $row_vcl['Vehicle_type'];
                                          $asg_no_seat = $row_vcl['no_seat'];
                                        }
                                        $drvr_sql = "SELECT * FROM `driver` WHERE `driver_id` = '".$row_as['driver_id']."';";
                                        $fetch_drvr = mysqli_query($conn,$drvr_sql);
                                        while ($row_drvr = mysqli_fetch_array($fetch_drvr)) {
                                          $asg_driver = $row_drvr['firstname']." ".$row_drvr['lastname'];
                                        }
                                      }
                                    }                                    
                                  }else{
                                    $rtv_as_sql = "SELECT * FROM `request` WHERE `dept_name` = '$dpt_name' AND `dept_see` <> 'new' ORDER BY `request`.`r_id` DESC LIMIT 1";
                                    $fetch = mysqli_query($conn,$rtv_as_sql);
                                    while ($rq_row = mysqli_fetch_array($fetch)) {
                                      $seenSQL = "UPDATE `request` SET `dept_see` = 'yes' WHERE `r_id` = '".$rq_row['r_id']."';";
                                      mysqli_query($conn,$seenSQL);

                                      $rq_r_id = $rq_row['r_id'];

                                      $rtv_as_sql = "SELECT * FROM `vehicle_on_duty` WHERE `r_id` = ".$rq_row['r_id'].";";
                                      $fetch_as = mysqli_query($conn,$rtv_as_sql);
                                      while ($row_as = mysqli_fetch_array($fetch_as)) {
                                        $asg_strt_tim = $row_as['start_time'];
                                        $asg_end_tim = $row_as['End_time'];
                                        $asg_vcl = $row_as['plate_no'];                                    

                                        $vcl_sql = "SELECT * FROM `vehicle` WHERE `plate_no` = '$asg_vcl';";
                                        $fetch_vcl = mysqli_query($conn,$vcl_sql);
                                        while ($row_vcl = mysqli_fetch_array($fetch_vcl)) {
                                          $asg_vcl_typ = $row_vcl['Vehicle_type'];
                                          $asg_no_seat = $row_vcl['no_seat'];
                                        }
                                        $drvr_sql = "SELECT * FROM `driver` WHERE `driver_id` = '".$row_as['driver_id']."';";
                                        $fetch_drvr = mysqli_query($conn,$drvr_sql);
                                        while ($row_drvr = mysqli_fetch_array($fetch_drvr)) {
                                          $asg_driver = $row_drvr['firstname']." ".$row_drvr['lastname'];
                                        }
                                      }
                                    }
                                  }
                                  if (isset($rqst_dest)) {                            
                                ?>
                                
                                  <div class="view-mail">
                                  
                                  <p>You have been requested for <?php echo $rqst_vcl_type;?> to travel to <?php echo $rqst_dest;?>
                                    from <?php echo $rqst_strt_tim;?> to <?php echo $rqst_end_tim;?>.</p>
                                  <p>The play of you request is given blow:-</p>
                                  <ol>
                                    <li>Vehicle assigned for you is <?php echo $asg_vcl_typ;?> with <?php echo $asg_no_seat;?> numbers of seat</li>
                                    <li>time assigned for you is <?php echo $asg_strt_tim;?> to <?php echo $asg_end_tim;?>, and </li>
                                    <li>assigned Driver is <?php echo $asg_driver;?></li>
                                  </ol>
                                </div>
                                <div class="mail_heading row">
                                  <div class="col-md-8">
                                  </div>
                                  <div class="col-md-12">
                                    <h4>Replay</h4>
                                  </div>
                                </div>
                                <div class="view-mail">
                                  
                                  <p>You have been requested for <?php echo $rqst_vcl_type;?> to travel to <?php echo $rqst_dest;?>
                                    from <?php echo $rqst_strt_tim;?> to <?php echo $rqst_end_tim;?>.</p>
                                  <p>The play of you request is given blow:-</p>
                                  <ol>
                                    <li>Vehicle assigned for you is <?php echo $asg_vcl_typ;?> with <?php echo $asg_no_seat;?> numbers of seat</li>
                                    <li>time assigned for you is <?php echo $asg_strt_tim;?> to <?php echo $asg_end_tim;?>, and </li>
                                    <li>assigned Driver is <?php echo $asg_driver;?></li>
                                  </ol>
                                </div>
                                <?php
                                  } else{
                                ?>
                                <div class="mail_heading row">
                                  <div class="col-md-12">
                                    <h2>You don't have any Replay</h2>
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
  include_once "../../../pages/layout/security/securityFoot.php";
?>