  
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

 <?php
            mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());     
            mysql_select_db("huvmts") or die(mysql_error());
         
            if (isset($_GET['query'])) {        
              $query = $_GET['query']; 
              $min_length = 2;
               
              if(strlen($query) >= $min_length){ 
                $query = htmlspecialchars($query);          
                $query = mysql_real_escape_string($query);
                $raw_results2 = mysql_query("SELECT * FROM schedule
                      WHERE (`schedule_id` LIKE '%".$query."%')")or die(mysql_error());

                if(mysql_num_rows($raw_results2) > 0){
           ?>
             <div class="right_col">
                <div class="row">
                  <div class="col-md-12">
                    <div class="x_panel">
                      <div class="bs-callout bs-callout-warning" id="callout-glyphicons-accessibility">
                        <h4>Result in post</h4> 
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>Date</th> <th>Time</th> <th>Plate_no</th> <th>Vehicle Type</th>
                                <th>Deiver_id</th> <th>Driver Name</th> <th>Driver Phone</th> <th>destination</th> 
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
            <?php                       
                      while($results = mysql_fetch_array($raw_results2)){
                        echo "
                                <tr>
                                  <td>".$results['date']."</td> <td>".$results['time']."</td> <td>".$results['plate_no']."</td> <td>".$results['vehicle_type']."</td>
                                  <td>".$results['driver_id']."</td>  <td>".$results['driver_name']."</td> <td>".$results['phone']."</td> 
                                 
                                  <td>".$results['destination']."</td> <td>".'<a href="update.php?'.$results['schedule_id'].'" class="label label-success">edit</a>'."</td>
                                </tr>";                          
                      }
          ?>
                  </tbody>
                          </table>
                          </div>
                    </div>
                  </div>
                </div>
                <?php
                       
                  }
                  else{
          ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="x_panel">
                          <div class="bs-callout bs-callout-warning" id="callout-glyphicons-accessibility">
                            <h4>Nothing is founded</h4>                        
                          </div>
                    </div>
                  </div>
                </div>
                <?php
                  }
                   
              }

              else{ // if query length is less than minimum
                  echo "Minimum length is ".$min_length;
              }
          }else{
            echo "string";
          }
          ?>

        </div>

                <?php
  include_once "../../../pages/layout/manager/ManagerFoot.php";
?>