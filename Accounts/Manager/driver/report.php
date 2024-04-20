<!DOCTYPE html>
<?php
  $title = "Driver | retur";
  $ManagerHome = "";
  $ManagerTracking= "";
  $ManagerInbox = "";
  $ManagerSend = "";
  $ManagerAddV = "";
  $Schedule="";


  session_start();
  if (isset($_SERVER['QUERY_STRING'])) {
    if ($_SERVER['QUERY_STRING']=="success") {
      echo "<script>window.alert('You approved return');</script>";
    }
  }

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
            <?php
              mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());     
              mysql_select_db("huvmts") or die(mysql_error());
              $raw_results = mysql_query("SELECT * FROM `message` WHERE `reciver` = '".$_SESSION['username']."' ORDER BY Time DESC") or die(mysql_error());
            ?>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Report </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    


                    <div class="row">
                      <div class="col-md-10 col-md-offset-1" style="text-align: justify;">
                            <div class="col-sm-4 mail_list_column">                          
                              <?php
                                $conn = mysqli_connect("localhost","root","","huvmts"); 
                                $dr = "SELECT * FROM `driver_report`"; 
                                $fe = mysqli_query($conn,$dr);
                                $rw = mysqli_fetch_array($fe);
                                $driver_id = $rw['driver_id'];

                                $font = "";
                                $icon = "fa fa-circle-thin";



                                $dr_actv = "SELECT * FROM `driver_report`"; 
                                $fetch = mysqli_query($conn,$dr_actv);
                                while ($row = mysqli_fetch_array($fetch)) {
                                  $rprt_id = $row['dr_rpt_id'];
                                  $rprt_dr_id = $row['driver_id'];
                                  $dr_rprt_tim = $row['time'];
                                  $dr_rprt_dest = $row['destny']; 
                                  $plate_no = $row['plate_no']; 

                                  $app_label = '<span class="badge bg-green">approved</span>';
                                  if ($row['approval']=="no") {
                                    $app_label = '<span class="badge bg-red">new</span>';
                                  }

                                  if ($row['mgr_seen'] == 'no') {
                                    $font = "<h3>";
                                    $icon = "fa fa-circle";
                                  }


                                  $drvr = "SELECT * FROM `driver` WHERE `driver_id` = '$rprt_dr_id'";
                                  $ftc = mysqli_query($conn,$drvr);
                                  $drvr_row = mysqli_fetch_array($ftc);
                                                              
                              ?>
                              <a href="report.php?<?php echo $rprt_id;?>">
                                <div class="mail_list">
                                  <div class="left">
                                    <i class="<?php echo $icon;?>"></i>
                                  </div>
                                  <div class="right">
                                    <?php echo $font.$drvr_row['firstname']." ".$drvr_row['lastname'].
                                    " is report returned ".$font.$app_label;?>

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
                                  if (isset($_SERVER['QUERY_STRING'])) { 
                                    if (($_SERVER['QUERY_STRING']!=""||$_SERVER['QUERY_STRING']!=null)&&$_SERVER['QUERY_STRING']!="success") {                                                                       	
                                      $dr_actv = "SELECT * FROM `driver_report` WHERE `dr_rpt_id` = '".$_SERVER['QUERY_STRING']."'"; 
                                      $fetch = mysqli_query($conn,$dr_actv);
                                      $rows = mysqli_fetch_array($fetch);


                                      $rprt_ids = $rows['dr_rpt_id'];
                                      $rprt_dr_ids = $rows['driver_id'];
                                      $dr_rprt_tim = $rows['time'];
                                      $dr_rprt_dests = $rows['destny']; 
                                      $plate_nos = $rows['plate_no']; 

                                      $app_btn = '<a class="btn btn-danger">it is approved</a>';
                                      if ($rows['approval']=="no") {
                                        $app_btn = '<a href="approve.php?'.$rprt_ids.'" class="btn btn-success">Approve</a>';
                                      }


                                      $drvr = "SELECT * FROM `driver` WHERE `driver_id` = '$rprt_dr_ids'";
                                      $ftc = mysqli_query($conn,$drvr);
                                      $d_row = mysqli_fetch_array($ftc);

                                      $vod = "SELECT * FROM `vehicle_on_duty` WHERE `plate_no` = '$plate_nos'";
                                      $vod_ftc = mysqli_query($conn,$vod);
                                      $vod_row = mysqli_fetch_array($vod_ftc);
                                      $vod_strt_tim = $vod_row['start_time'];
                                      $vod_end_tim = $vod_row['End_time'];
                                      $vod_dest = $vod_row['destney'];

                                      $rqst = "SELECT * FROM `request` WHERE `r_id`='".$vod_row['r_id']."'";
                                      $rqst_ftc = mysqli_query($conn,$rqst);
                                      $rqst_row = mysqli_fetch_array($rqst_ftc);
                                      $rqst_dept = $rqst_row['dept_name'];

                                    }else{
                                      $dr_actv = "SELECT * FROM `driver_report` ORDER BY dr_rpt_id DESC LIMIT 1"; 
                                      $fetch = mysqli_query($conn,$dr_actv);
                                      $rows = mysqli_fetch_array($fetch);


                                      $rprt_ids = $rows['dr_rpt_id'];
                                      $rprt_dr_ids = $rows['driver_id'];
                                      $dr_rprt_tim = $rows['time'];
                                      $dr_rprt_dests = $rows['destny']; 
                                      $plate_nos = $rows['plate_no']; 


                                      $app_btn = '<a class="btn btn-danger">it is approved</a>';
                                      if ($rows['approval']=="no") {
                                        $app_btn = '<a href="approve.php?'.$rprt_ids.'" class="btn btn-success">Approve</a>';
                                      }


                                      $drvr = "SELECT * FROM `driver` WHERE `driver_id` = '$rprt_dr_ids'";
                                      $ftc = mysqli_query($conn,$drvr);
                                      $d_row = mysqli_fetch_array($ftc);

                                      $vod = "SELECT * FROM `vehicle_on_duty` WHERE `plate_no` = '$plate_nos'";
                                      $vod_ftc = mysqli_query($conn,$vod);
                                      $vod_row = mysqli_fetch_array($vod_ftc);
                                      $vod_strt_tim = $vod_row['start_time'];
                                      $vod_end_tim = $vod_row['End_time'];
                                      $vod_dest = $vod_row['destney'];

                                      $rqst = "SELECT * FROM `request` WHERE `r_id`='".$vod_row['r_id']."'";
                                      $rqst_ftc = mysqli_query($conn,$rqst);
                                      $rqst_row = mysqli_fetch_array($rqst_ftc);
                                      $rqst_dept = $rqst_row['dept_name'];

                                    }
                                  }
                                  if (isset($dr_rprt_dests)) {
                                    mysqli_query($conn, "UPDATE `driver_report` SET `mgr_seen`='yes' WHERE `dr_rpt_id`=$rprt_ids");

                                ?>
                                <div class="mail_heading row">
                                  <div class="col-md-8">
                                  </div>

                                  <div class="col-md-4 text-right">
                                    <?php echo $app_btn;?>
                                  </div>
                                  <div class="col-md-12">
                                    <h4>Driver Report they are returned</h4>
                                  </div>
                                </div>
                                <div   id="print" name="print" class="view-mail">
                                  <h1><?php echo $d_row['firstname']." ".$d_row['lastname'];?></h1>
                                  <p>
                                    I have been on duty from <?php echo $vod_strt_tim;?> to <?php echo $vod_end_tim;?>. the duty assigned is
                                    to travel to <?php echo $vod_dest;?> for the department of <?php echo $rqst_dept;?>. As we finished 
                                    vacation I bring the vehicle back on <?php echo $dr_rprt_tim;?>.
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
                              <input type="submit" value="print this page" class="btn btn-danger col-md-offset-9" onclick="prints ('print')"/>
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

<script type="text/javascript">
  function prints (e) {
    var res = document.body.innerHTML;
    var prt = document.getElementById(e).innerHTML;

    document.body.innerHTML = prt;
    window.print();
    document.body.innerHTML = res;
  }
</script>