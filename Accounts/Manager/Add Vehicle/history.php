<!DOCTYPE html>
<?php
  $title = "History";
  $ManagerHome = "";
  $ManagerTracking= "";
  $ManagerInbox = "";
  $ManagerSend = "";
  $ManagerAddV = "active";
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
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Vehicle History</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Vehicle Report</a>
                        </li>
                      </ul>
                      <div id="myTabContent2" class="tab-content">


                        <div  id="print" name="print" role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">
                          <div class="col-md-offset-3 col-md-6">
                            <?php
                              $vclIndex = 0;
                              $vcls = "";

                              $no_bus = 0;
                              $no_bus_asgn = 0;

                              $no_others = 0;
                              $no_others_asgn = 0;

                              $no_pick_up = 0;
                              $no_pick_up_asgn = 0;

                              $vcl_on_duty = 0;
                              $conn = mysqli_connect("localhost","root","","huvmts");
                              $sql_vcl = "SELECT * FROM `vehicle`";
                              $fetch_vcl = mysqli_query($conn,$sql_vcl);
                              while ($vcl_row = mysqli_fetch_array($fetch_vcl)) {
                                $vcls['$vclIndex'] = $vcl_row;
                                $vclIndex++;

                                if ($vcl_row['Vehicle_type'] == "bus") {
                                  $no_bus++;
                                  if ($vcl_row['report'] == "assigned") {
                                    $no_bus_asgn++;
                                  }
                                }elseif ($vcl_row['Vehicle_type'] == "pick up") {
                                  $no_pick_up++;
                                  if ($vcl_row['report'] == "assigned") {
                                    $no_pick_up_asgn++;
                                  }
                                }else{
                                  $no_others++;
                                  if ($vcl_row['report'] == "assigned") {
                                    $no_others_asgn++;
                                  }
                                }

                                if ($vcl_row['report'] == "assigned") {
                                  $vcl_on_duty++;
                                }
                              }
                            ?>
                            <h3>analysis of vehicle</h3>
                            <p>Haramaya University has <?php echo "$vclIndex";?> vehicles. and we gave analysi of vehicles base 
                              on their type and the duty assigned on.
                            </p>

                            <h2>Analysis based on type</h2>
                            <ol>
                              <h4><li>
                                  their 
                                  <?php if ($no_bus==0) {echo " is no bus";}elseif($no_bus==1) {echo " is only one bus";}else{
                                  echo " are ".$no_bus." buses";}?> 
                                  . <?php if($no_bus_asgn==0){echo " non ";}elseif($no_bus_asgn==$no_bus){echo " All ";}
                                  else{echo $no_bus_asgn;} echo " of them are assigned";?>                                
                                </h4>
                                <?php
                                  $asgn_bus_perc = ($no_bus_asgn/$no_bus)*100;
                                  $asgn_bus_perc_duty = ($no_bus_asgn/$vcl_on_duty)*100;
                                  $no_bus_perc = ($no_bus/$vclIndex)*100;
                                  $no_bus_tototvcl_perc = ($no_bus_asgn/$vclIndex)*100;
                                ?>
                                <h5>Ratio of number of assigned bus (bus on duty) to total number bus</h5>
                                <div class="project_progress">
                                  <div class="progress progress_sm">
                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $asgn_bus_perc;?>" aria-valuenow="<?php echo $asgn_bus_perc-1;?>" style="width: <?php echo $asgn_bus_perc;?>%;"></div>
                                  </div>
                                  <small><?php echo $asgn_bus_perc;?>% of bus is on duty</small>
                                </div>

                                <h5>Ratio of number of assigned bus (bus on duty) to total number assigned vehicle</h5>
                                <div class="project_progress">
                                  <div class="progress progress_sm">
                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $asgn_bus_perc_duty;?>" aria-valuenow="<?php echo $asgn_bus_perc_duty-1;?>" style="width: <?php echo $asgn_bus_perc_duty;?>%;"></div>
                                  </div>
                                  <small><?php echo $asgn_bus_perc_duty;?>% of vehicle on duty is bus</small>
                                </div>

                                <h5>Ratio of all bus (total bus) to total number of vehicles</h5>
                                <div class="project_progress">
                                  <div class="progress progress_sm">
                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $no_bus_perc;?>" aria-valuenow="<?php echo $no_bus_perc-1;?>" style="width: <?php echo $no_bus_perc;?>%;"></div>
                                  </div>
                                  <small><?php echo $no_bus_perc;?>% of vehicle is bus</small>
                                </div>


                                <h5>Ratio of all bus on duty (total bus on duty) to total number of vehicles</h5>
                                <div class="project_progress">
                                  <div class="progress progress_sm">
                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $no_bus_tototvcl_perc;?>" aria-valuenow="<?php echo $no_bus_tototvcl_perc-1;?>" style="width: <?php echo $no_bus_tototvcl_perc;?>%;"></div>
                                  </div>
                                  <small><?php echo $no_bus_tototvcl_perc;?>% of vehicle is bus on duty</small>
                                </div>

                              </li>



                              <h4><li>
                                  their 
                                  <?php if ($no_pick_up==0) {echo " is no pick up";}elseif($no_bus==1) {echo " is only one pick up";}else{
                                  echo " are ".$no_pick_up." pick up";}?> 
                                  . <?php if($no_pick_up_asgn==0){echo " non ";}else{echo $no_pick_up_asgn;} echo " of them are assigned";?>                                
                                </h4>
                                <?php
                                  $asgn_bus_perc = ($no_pick_up_asgn/$no_pick_up)*100;
                                  $asgn_bus_perc_duty = ($no_pick_up_asgn/$vcl_on_duty)*100;
                                  $no_bus_perc = ($no_bus/$vclIndex)*100;
                                  $no_bus_tototvcl_perc = ($no_pick_up_asgn/$vclIndex)*100;
                                ?>
                                <h5>Ratio of number of assigned pick up (pick up on duty) to total number pick up</h5>
                                <div class="project_progress">
                                  <div class="progress progress_sm">
                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $asgn_bus_perc;?>" aria-valuenow="<?php echo $asgn_bus_perc-1;?>" style="width: <?php echo $asgn_bus_perc;?>%;"></div>
                                  </div>
                                  <small><?php echo $asgn_bus_perc;?>% of pick up is on duty</small>
                                </div>

                                <h5>Ratio of number of assigned pick up (pick up on duty) to total number assigned vehicle</h5>
                                <div class="project_progress">
                                  <div class="progress progress_sm">
                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $asgn_bus_perc_duty;?>" aria-valuenow="<?php echo $asgn_bus_perc_duty-1;?>" style="width: <?php echo $asgn_bus_perc_duty;?>%;"></div>
                                  </div>
                                  <small><?php echo $asgn_bus_perc_duty;?>% of vehicle on duty is pick up</small>
                                </div>

                                <h5>Ratio of all pick up (total pick up) to total number of vehicles</h5>
                                <div class="project_progress">
                                  <div class="progress progress_sm">
                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $no_bus_perc;?>" aria-valuenow="<?php echo $no_bus_perc-1;?>" style="width: <?php echo $no_bus_perc;?>%;"></div>
                                  </div>
                                  <small><?php echo $no_bus_perc;?>% of vehicle is pick up</small>
                                </div>


                                <h5>Ratio of all pick up on duty (total pick up on duty) to total number of vehicles</h5>
                                <div class="project_progress">
                                  <div class="progress progress_sm">
                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $no_bus_tototvcl_perc;?>" aria-valuenow="<?php echo $no_bus_tototvcl_perc-1;?>" style="width: <?php echo $no_bus_tototvcl_perc;?>%;"></div>
                                  </div>
                                  <small><?php echo $no_bus_tototvcl_perc;?>% of vehicle is pick up on duty</small>
                                </div>

                              </li>



                              <h4><li>
                                
                                  their 
                                  <?php if ($no_others==0) {echo " is no other vehicle";}elseif($no_others==1) {echo " is only one other vehicle";}else{
                                  echo " are ".$no_others." others";}?> 
                                  . <?php if($no_others_asgn==0){echo " non ";}elseif($no_others_asgn==$no_others){echo " All ";}
                                  else{echo $no_others_asgn;} echo " of them are assigned";?>                                
                                </h4>
                                <?php
                                  $asgn_bus_perc = ($no_others_asgn/$no_others)*100;
                                  $asgn_bus_perc_duty = ($no_others_asgn/$vcl_on_duty)*100;
                                  $no_bus_perc = ($no_bus/$vclIndex)*100;
                                  $no_bus_tototvcl_perc = ($no_others_asgn/$vclIndex)*100;
                                ?>
                                <h5>Ratio of number of assigned other type of vehicle (others type of vehicle on duty) to total number bus</h5>
                                <div class="project_progress">
                                  <div class="progress progress_sm">
                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $asgn_bus_perc;?>" aria-valuenow="<?php echo $asgn_bus_perc-1;?>" style="width: <?php echo $asgn_bus_perc;?>%;"></div>
                                  </div>
                                  <small><?php echo $asgn_bus_perc;?>% of other type of vehicle is on duty</small>
                                </div>

                                <h5>Ratio of number of assigned other type of vehicle (other type of vehicle on duty) to total number assigned vehicle</h5>
                                <div class="project_progress">
                                  <div class="progress progress_sm">
                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $asgn_bus_perc_duty;?>" aria-valuenow="<?php echo $asgn_bus_perc_duty-1;?>" style="width: <?php echo $asgn_bus_perc_duty;?>%;"></div>
                                  </div>
                                  <small><?php echo $asgn_bus_perc_duty;?>% of vehicle on duty is other type of vehicle</small>
                                </div>

                                <h5>Ratio of all other type of vehicle (total other type of vehicle) to total number of vehicles</h5>
                                <div class="project_progress">
                                  <div class="progress progress_sm">
                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $no_bus_perc;?>" aria-valuenow="<?php echo $no_bus_perc-1;?>" style="width: <?php echo $no_bus_perc;?>%;"></div>
                                  </div>
                                  <small><?php echo $no_bus_perc;?>% of vehicle is other type of vehicle</small>
                                </div>


                                <h5>Ratio of all other type of vehicle on duty (total other type of vehicle on duty) to total number of vehicles</h5>
                                <div class="project_progress">
                                  <div class="progress progress_sm">
                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $no_bus_tototvcl_perc;?>" aria-valuenow="<?php echo $no_bus_tototvcl_perc-1;?>" style="width: <?php echo $no_bus_tototvcl_perc;?>%;"></div>
                                  </div>
                                  <small><?php echo $no_bus_tototvcl_perc;?>% of vehicle is other type of vehicle on duty</small>
                                </div>

                              </li>

                            </ol>


                            <h2>Analysis based on Assignment</h2>

                              <h4><li>
                                  their 
                                  <?php if ($vcl_on_duty==0) {echo " is no vehicle on duty";}elseif($vcl_on_duty==1) {echo " is only one vehicle on duty";}else{
                                  echo " are ".$vcl_on_duty." vehicles on duty";}?>.                               
                                </h4>
                                <?php
                                  $vcl_on_duty_perc = ($vcl_on_duty/$vclIndex)*100;
                                ?>
                                <h5>Ratio of number of assigned vehicle on duty (vehicle on duty on duty) to total number vehicle on duty</h5>
                                <div class="project_progress">
                                  <div class="progress progress_sm">
                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $vcl_on_duty_perc;?>" aria-valuenow="<?php echo $vcl_on_duty_perc-1;?>" style="width: <?php echo $vcl_on_duty_perc;?>%;"></div>
                                  </div>
                                  <small><?php echo $vcl_on_duty_perc;?>% of vehicle on duty is on duty</small>
                                </div>

                                
                              </li>

                          </div>
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