<!DOCTYPE html>
<?php
  $title = "Home |Welcome to Managers Account";
  $ManagerHome = "active";
  $ManagerTracking= "";
  $ManagerInbox = "";
  $ManagerSend = "";
  $ManagerAddV = "";
  $Schedule="";
  session_start();
  if (!isset($_SESSION['firstname'])) {
    header("Location:../../index.php");
  }
  if ($_SESSION['acct_type']!="Manager") {
    header("Location:../../index.php");
  }
  include_once "../../pages/layout/manager/ManagerNavs.php";
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php
              mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());     
              mysql_select_db("huvmts") or die(mysql_error());
              $raw_results = mysql_query("SELECT * FROM `post` WHERE `acct_type` LIKE 'manager' ORDER BY Time DESC") or die(mysql_error());
              while($results = mysql_fetch_array($raw_results)){
            ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="x_panel">
                    <div class="row">
                      <div class="col-md-5">
                        <?php echo '<img class="img-thumbnail img-responsive" src="data:image/jpeg;base64,'.base64_encode( $results['image'] ).'"/>'?>
                      </div>
                      <div class="col-md-6">
                        <h3><?php echo $results['Subject'];?></h3>
                        <p><?php echo $results['Content'];?></p>
                      </div>
                      <div class="col-md-1">
                        <?php  
                              $now = new DateTime;
                              $ago = new DateTime($results['Time']);
                              $diff = $now->diff($ago);

                              $diff->w = floor($diff->d / 7);
                              $diff->d -= $diff->w * 7;

                              $string = array(
                                  'y' => 'year',
                                  'm' => 'month',
                                  'w' => 'week',
                                  'd' => 'day',
                                  'h' => 'hour',
                                  'i' => 'minute',
                                  's' => 'second',
                              );
                              foreach ($string as $k => &$v) {
                                  if ($diff->$k) {
                                      $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                                  } else {
                                      unset($string[$k]);
                                  }
                              }

                              $string = array_slice($string, 0, 1);
                              echo $string ? implode(', ', $string) . ' ago' : 'just now';
                        
                        ?>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            <?php
              }
            ?>
          </div>
        </div>
        <!-- /page content -->
<?php
  include_once "../../pages/layout/manager/ManagerFoot.php";
?>