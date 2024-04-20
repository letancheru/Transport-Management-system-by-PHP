<!DOCTYPE html>
<?php
  $title = "Requests";
  $ManagerHome = "";
  $ManagerTracking= "";
  $ManagerInbox = "";
  $ManagerSend = "";
  $ManagerAddV = "";
  $Schedule="";


  session_start();
  if (!isset($_SESSION['firstname'])) {
    header("Location:../../../index.php");
  }
  if ($_SESSION['acct_type']!="Manager") {
    header("Location:../../../index.php");
  }
  include_once "../../../pages/layout/manager/ManagerNavs.php";
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
                <div class="row">

                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>RequestS</h2>
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
                                $rprt_sql = "SELECT * FROM `request`"; 
                                $fetch = mysqli_query($conn,$rprt_sql);
                                while ($row = mysqli_fetch_array($fetch)) { 
                                  $lst_rqst_dept = $row['dept_name'];
                                  $lst_rqst_ID = $row['r_id'];

                                  $dept_see_bold = "p";
                                  $dept_see_icon = "fa fa-circle-thin";
                                  $notf = "";
                                  if ($row['mgr_see'] == "no") {
                                    $dept_see_bold = "h3";
                                    $dept_see_icon = "fa fa-circle";
                                    $notf = '<span class="badge bg-red">New</span>';
                                  }else{
                                    if ($row['report'] == "not") {
                                      $notf = '<span class="badge bg-blue">seen</span>';
                                    } else{
                                      $notf = '<span class="badge bg-green">relayed</span>';
                                    }
                                  }

                              ?>
                              <a href="index.php?<?php echo $lst_rqst_ID;?>">
                                <div class="mail_list">
                                  <div class="left">
                                    <i class="<?php echo $dept_see_icon; ?>"></i>
                                  </div>
                                  <div class="right">
                                    <?php 
                                      echo "<$dept_see_bold>"."$lst_rqst_dept requested from ".$row['start_time']." to ".$row['start_time']."</$dept_see_bold>".$notf;
                                    ?>
                                    <p>
                                      
                                    </p>
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
                                  if ($_SERVER['QUERY_STRING']==""||$_SERVER['QUERY_STRING']=="") {
                                    $rtv_as_sql = "SELECT * FROM `request` ORDER BY r_id DESC LIMIT 1;";
                                    $fetch = mysqli_query($conn,$rtv_as_sql);
                                    while ($row = mysqli_fetch_array($fetch)) {
                                        $rqst_strt_tim = $row['start_time'];
                                        $rqst_end_tim = $row['end_time'];
                                        $rqst_vcl_type = $row['vehicle_type'];
                                        $rqst_dest = $row['destination'];   
                                        $rqst_ID = $row['r_id'];  
                                        $rqst_dept = $row['dept_name'];

                                        $update = "UPDATE `request` SET `mgr_see` = 'yes' WHERE `r_id` = '$rqst_ID';";
                                        mysqli_query($conn,$update);

                                        $dept_sql = "SELECT * FROM `department` WHERE `dept_name` = '$rqst_dept';";
                                        $fetch_drvr = mysqli_query($conn,$dept_sql);
                                        while ($row_dept = mysqli_fetch_array($fetch_drvr)) {
                                          $dept_user_name = $row_dept['username'];

                                          $Account_sql = "SELECT * FROM `account` WHERE `username` = '$dept_user_name';";
                                          $fetch_drvr = mysqli_query($conn,$Account_sql);
                                          while ($row_Account = mysqli_fetch_array($fetch_drvr)) {
                                            $Account_name = $row_Account['firstname']." ".$row_Account['lastname'];
                                          }
                                        }
                                        $anchor = "";

                                        if ($row['report'] != "not") {
                                          $anchor = '<a class="btn btn-sm btn-success pull-right"><i class="fa fa-replyed"></i> Replayed</a>';
                                        } else{
                                          $anchor = '<a href="../Add vehicle/assign vehicle.php?'.$rqst_ID.'" class="btn btn-sm btn-primary pull-right"><i class="fa fa-reply"></i> Reply</a>';
                                        }
                                    }
                                  }else{
                                    $query = $_SERVER['QUERY_STRING'];
                                    $rtv_as_sql = "SELECT * FROM `request` WHERE r_id = $query;";
                                    $fetch = mysqli_query($conn,$rtv_as_sql);
                                    while ($row = mysqli_fetch_array($fetch)) {
                                        $rqst_strt_tim = $row['start_time'];
                                        $rqst_end_tim = $row['end_time'];
                                        $rqst_vcl_type = $row['vehicle_type'];
                                        $rqst_dest = $row['destination'];   
                                        $rqst_ID = $row['r_id'];  
                                        $rqst_dept = $row['dept_name'];

                                        $update = "UPDATE `request` SET `mgr_see` = 'yes' WHERE `r_id` = '$rqst_ID';";
                                        mysqli_query($conn,$update);
                                        
                                        $dept_sql = "SELECT * FROM `department` WHERE `dept_name` = '$rqst_dept';";
                                        $fetch_drvr = mysqli_query($conn,$dept_sql);
                                        while ($row_dept = mysqli_fetch_array($fetch_drvr)) {
                                          $dept_user_name = $row_dept['username'];

                                          $Account_sql = "SELECT * FROM `account` WHERE `username` = '$dept_user_name';";
                                          $fetch_drvr = mysqli_query($conn,$Account_sql);
                                          while ($row_Account = mysqli_fetch_array($fetch_drvr)) {
                                            $Account_name = $row_Account['firstname']." ".$row_Account['lastname'];
                                          }
                                        }

                                        $anchor = "";

                                        if ($row['report'] != "not") {
                                          $anchor = '<a class="btn btn-sm btn-success pull-right"><i class="fa fa-replyed"></i> Replayed</a>';
                                        } else{
                                          $anchor = '<a href="../Add vehicle/assign vehicle.php?'.$rqst_ID.'" class="btn btn-sm btn-primary pull-right"><i class="fa fa-reply"></i> Reply</a>';
                                        }
                                    }
                                  }
                                  if (isset($rqst_dest)) {                            
                                ?>
                                <div class="mail_heading row">
                                  <div class="col-md-8">
                                  </div>
                                  <div class="col-md-12">
                                    <?php echo $anchor;?>
                                    <h4>Request</h4>
                                  </div>
                                </div>
                                <div class="view-mail">
                                  <h1><?php echo $Account_name;?></h1>
                                  <p><?php echo $Account_name;?> Requsted for vehicle by representing Department of <?php echo $rqst_dept;?>
                                    for <?php if($rqst_vcl_type=="others"){echo $rqst_vcl_type." type of vehicle ";}else{echo $rqst_vcl_type;}?> 
                                    from <?php echo $rqst_strt_tim;?> to <?php echo $rqst_end_tim;?></p>                                  
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
  include_once "../../../pages/layout/manager/ManagerFoot.php";
?>