<!DOCTYPE html>
<?php
  $title = "sent Request";
  $DepartmentHome = "";
  $DepartmentInbox= "";
  $DepartmentSend = "";
  $SendReq = "active";
  $post="";
  
  session_start();
  if (!isset($_SESSION['firstname'])) {
    header("Location:../../../index.php");
  }
  if ($_SESSION['acct_type']!="Department") {
    header("Location:../../../index.php");
  }
  include_once "../../../pages/layout/Department/DepartmentNavs.php";
  include '../../../Class/PHP/SendMessage.php';
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">

                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Sent Request</h2>
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
                                $rprt_sql = "SELECT * FROM `request` WHERE `username` = '".$_SESSION['username']."'"; 
                                $fetch = mysqli_query($conn,$rprt_sql);
                                while ($row = mysqli_fetch_array($fetch)) {
                                  $rqst_strt_tim = $row['start_time'];
                                  $rqst_end_tim = $row['end_time'];
                                  $rqst_vcl_type = $row['vehicle_type'];
                                  $rqst_dest = $row['destination'];   
                                  $rqst_ID = $row['r_id'];
                                  $rqst_rprt = $row['report'];  

                                  $replayed_rqst = '<label class="label label-danger">New</label>';
                                  if ($rqst_rprt != "not") {
                                    $replayed_rqst = '<label class="label label-info">Replayed</label>';
                                  }

                                  $dept_see_bold = "p";
                                  $dept_see_icon = "fa fa-circle-thin";
                                  if ($row['dept_see'] == "no") {
                                    $dept_see_bold = "h3";
                                    $dept_see_icon = "fa fa-circle";
                                  }                             
                              ?>
                              <a href="sentrequest.php?<?php echo $rqst_ID;?>">
                                <div class="mail_list">
                                  <div class="left">
                                    <i class="<?php echo $dept_see_icon; ?>"></i>
                                  </div>
                                  <div class="right">
                                    <?php echo "<$dept_see_bold>"."your request to ".$row['destination']." from ".$row['start_time']." is replayed"."<$dept_see_bold>".$replayed_rqst;?>
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
                                    $rtv_as_sql = "SELECT * FROM `request` WHERE `r_id` = $open;";

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
                                    $rtv_as_sql = "SELECT * FROM `request` ORDER BY `request`.`r_id` DESC LIMIT 1";
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
                                    if (isset($asg_strt_tim)) {
                                ?>
                                <div class="mail_heading row">
                                  <div class="col-md-8">
                                  </div>
                                  <div class="col-md-12">
                                    <h4>Replayed</h4>
                                  </div>
                                </div>
                                <div class="view-mail">
                                  <h1>Dear <?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?></h1>
                                  <p>You have been requested for <?php echo $rqst_vcl_type;?> to travel to <?php echo $rqst_dest;?>
                                    from <?php echo $rqst_strt_tim;?> to <?php echo $rqst_end_tim;?>.The request is replayed for you</p>
                                </div>
                                <?php
                                    } else{
                                  ?>
                                <div class="mail_heading row">
                                  <div class="col-md-8">
                                  </div>
                                  <div class="col-md-12">
                                    <h4>New request</h4>
                                  </div>
                                </div>
                                <div class="view-mail">
                                  <h1>Dear <?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?></h1>
                                  <p>You have been requested for <?php echo $rqst_vcl_type;?> to travel to <?php echo $rqst_dest;?>
                                    from <?php echo $rqst_strt_tim;?> to <?php echo $rqst_end_tim;?>. The is not replayed</p>
                                </div>
                                <a href="edit request.php?<?php echo $rq_r_id;?>" class="btn btn-success">Edit request</a>

                                  <?php
                                    }                       
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
                <!-- /compose -->
            </div>
            
          </div>
        </div>
        <!-- /page content -->
<?php
  include_once "../../../pages/layout/Department/DepartmentFoot.php";
?>