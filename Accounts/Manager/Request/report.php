<!DOCTYPE html>
<?php
  $title = "Report";
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


    $reportIndex = 0;
    $newRqst = 0;
    $report = "";

    $dept_cout = 0;
    $depts_names = "";

    $rprt_sql = "SELECT * FROM `request`;"; 
    $fetch = mysqli_query($conn,$rprt_sql);
    while ($row = mysqli_fetch_array($fetch)) {
      if ($dept_cout == 0) {
        $depts_names[0] = $row['dept_name'];
        $dept_cout++;
      }elseif ($dept_cout!=0 && $depts_names[$dept_cout-1]!=$row['dept_name']) {
        $depts_names[$dept_cout] = $row['dept_name'];
        $dept_cout++;
      }
       
      $report[$reportIndex] = $row;
      if ($row['dept_see']!="new") {
        $newRqst++;
      }
      $reportIndex++;
    } 
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">

                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Reports</h2>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <div id="alerts"></div>
                        <div class="col-md-offset-2 col-md-6">
                          <?php
                            if ($reportIndex=="") {
                          ?>

                          <H1>There is No request for vehicle</H1>

                          <?php
                              
                            }else{
                          ?>
                          <h2>Request Reports</h2>

                          <p> The request for Vehicle is Requested by <?php echo $dept_cout;?> departments, namely 
                            <?php for ($i=0; $i < $dept_cout; $i++) { if ($dept_cout==1){ echo $depts_names[$i];} 
                            elseif($i==$dept_cout-1){ echo " and ".$depts_names[$i];}else{echo $depts_names[$i]." ";} }?>
                            . It is given blow how many of them replayed per department. 
                          </p>

                          <?php 
                            for ($i=0; $i < $dept_cout; $i++) { 
                              $rprt_sql = "SELECT * FROM `request` WHERE `dept_name` = '".$depts_names[$i]."'"; 
                              $fetch = mysqli_query($conn,$rprt_sql);
                              $no_rqst = 0;
                              $no_rplyd_rqst = 0;
                              while ($row = mysqli_fetch_array($fetch)) {
                                $no_rqst++;
                                $no_rplyd_rqst = 0;
                                $rplyd_rprt_sql = "SELECT * FROM `request` WHERE `dept_name` = '".$depts_names[$i]."' AND `dept_see` <> 'new'"; 
                                $rplyd_fetch = mysqli_query($conn,$rplyd_rprt_sql);
                                while ($rplyd_row = mysqli_fetch_array($rplyd_fetch)) {
                                  $no_rplyd_rqst++;
                                }
                              }
                              $rplyd_percent = ($no_rplyd_rqst/$no_rqst)*100;
                          ?>
                            <h2><?php echo $depts_names[$i];?></h2>
                            <p>The Department of  <?php echo $depts_names[$i];?> requested for vehicle <?php echo $no_rqst;?> times. 
                              This requests are:-
                            </p>
                            <ol>
                              <?php
                                $rplyd_rprt_sql = "SELECT * FROM `request` WHERE `dept_name` = '".$depts_names[$i]."';"; 
                                $rplyd_fetch = mysqli_query($conn,$rplyd_rprt_sql);
                                while ($rplyd_row = mysqli_fetch_array($rplyd_fetch)) {
                              ?>
                                <li>Requested for <?php echo $rplyd_row['vehicle_type'];?> to travel to <?php echo $rplyd_row['destination'];?>
                                  on <?php echo $rplyd_row['start_time'];?> up to <?php echo $rplyd_row['end_time'];?></li>
                              <?php
                                }
                              ?>
                            </ol>
                            <p>In percentage it is given blow:- </p>

                            <div class="project_progress">
                              <div class="progress progress_sm">
                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $rplyd_percent;?>" aria-valuenow="<?php echo $rplyd_percent-1;?>" style="width: <?php echo $rplyd_percent;?>%;"></div>
                              </div>
                              <small><?php echo $rplyd_percent;?>% is replied</small>
                            </div>
                          <?php
                           }
                          ?>
                            
                            <h2>Summary</h2>
                            <p>
                              Over all <?php if ($dept_cout==1) {echo $dept_cout." Departments is ";}else{ echo $dept_cout." Departments are ";}?>
                              requested <?php if ($reportIndex==1) {echo $reportIndex." question";}else {echo $reportIndex." questions";} ?> 
                              for vehicle and <?php if ($newRqst == 1) {echo "only ".$newRqst;} elseif ($newRqst==$reportIndex) {echo " all ";}else{echo $newRqst;}?>
                              of the are replied.
                            </p>
                            <p>In percentage it is given blow:- </p>
                          <?php
                              $percent = ($newRqst/$reportIndex)*100;
                          ?>

                          <div class="project_progress">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $percent;?>" aria-valuenow="<?php echo $percent-1;?>" style="width: <?php echo $percent;?>%;"></div>
                            </div>
                            <small><?php echo $percent;?>% is replied</small>
                          </div>
                          <?php 
                            }
                          ?>

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
  include_once "../../../pages/layout/manager/ManagerFoot.php";
?>