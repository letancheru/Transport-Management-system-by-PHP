<!DOCTYPE html>
<?php
  $title = "Report";
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
 
    $reportIndex = 0;
    $replayed = 0;
    $report = "";
    $replayArray = "";
    $username = $_SESSION['username'];
    $conn = mysqli_connect("localhost","root","","huvmts");  

    $dpt_sql = "SELECT * FROM `department` WHERE `username` = '".$_SESSION['username']."'"; 
    $dept = mysqli_query($conn,$dpt_sql);
    $row = mysqli_fetch_array($dept);

    $dpt_name = $row['dept_name'];
 

    $rprt_sql = "SELECT * FROM `request` WHERE `dept_name` = '".$dpt_name."' AND `username` = '".$username."'"; 
    $fetch = mysqli_query($conn,$rprt_sql);
    while ($row = mysqli_fetch_array($fetch)) {
      $report[$reportIndex] = $row;
      if ($row['report']!="not") {
        $replayed++;
      }
      $reportIndex++;
    }          
    
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">

                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel" id="print" name="print">
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

                          <H1>you never Requested for vehicle</H1>

                          <?php
                              
                            }else{
                          ?>

                          <H1>Dear <?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?>!</H1>
                          <p> you have requested for vehicle <?php echo $reportIndex;?> times, by representing department of <?php echo $dpt_name;?>.
                            this requests are: - </p>
                            <ol>
                            <?php 
                              $rprt_sql = "SELECT * FROM `request` WHERE `dept_name` = '".$dpt_name."'"; 
                              $fetch = mysqli_query($conn,$rprt_sql);
                              while ($row = mysqli_fetch_array($fetch)) {
                                  
                            ?>
                              <li>You requested <?php echo $row['vehicle_type'];?> to travel to <?php echo $row['destination'];?> 
                                from <?php echo $row['start_time'];?> to <?php echo $row['end_time'];?> and vehicle is 
                                <?php if ($row['report']=="not") {echo $row['report']." assigned";} else {echo $row['report'];}?> </li>
                            <?php
                              }
                            ?>                            
                            </ol>
                            <p>This shows us that out of <?php echo $reportIndex;?> request <?php if ($replayed == 1) {echo "only ".$replayed;}
                            elseif ($replayed==$reportIndex) {echo " all ";}else{echo $replayed;}?> 
                              of them are replayed for you.</p>
                            <p>In percentage it is given as blow:- </p>
                          <?php
                              $percent = ($replayed/$reportIndex)*100;
                            }
                            if (isset($percent)) {
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
                    <?php
                      if (isset($percent)) {
                    ?>                    
                    <input type="submit" value="print this page" class="btn btn-danger col-md-offset-9" onclick="prints ('print')"/>

                    <?php }                     
                    ?>
                  </div>
                <!-- /compose -->
            </div>
            
          </div>
        </div>
        <!-- /page content -->
<?php
  include_once "../../../pages/layout/Department/DepartmentFoot.php";
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