<!DOCTYPE html>
<?php
  $title = "Add Vehicle";
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


  // returned vehicle
  if (isset($_SERVER['QUERY_STRING'])) {
    $assign = $_SERVER['QUERY_STRING'];
    $nwAssgn = "not";

    mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());     
    mysql_select_db("huvmts") or die(mysql_error());
    $result = mysql_query("SELECT * FROM `vehicle` WHERE `plate_no`= '$assign'") or die(mysql_error());
    if (mysql_num_rows($result) > 0) {
      $row = mysql_fetch_array($result);
      if ($row['report']=="not") {
        $nwAssgn = "not";
      }      
    }
    mysql_query("UPDATE `Vehicle` SET `report` = '$nwAssgn' WHERE `plate_no` = '$assign';")or die(mysql_error());

    $res = mysql_query("SELECT * FROM `vehicle_on_duty` WHERE `plate_no`= '$assign'");
    while ($row = mysql_fetch_array($res)) {
      $plate_no = $row['plate_no'];
      $driver_id = $row['driver_id'];
      $destney = $row['destney'];
      $start_time = $row['start_time'];
      $End_time = $row['End_time'];
      $r_id = $row['r_id']; 

      mysql_query("INSERT INTO `vehicle_history` (`plate_no`, `driver_id`, `t_start`, `t_end`, `p_from`, `r_id`) 
        VALUES ('$plate_no','$driver_id','$start_time','$End_time','$destney',$r_id)") or die(mysql_error());   
    }
    mysql_query("DELETE FROM `vehicle_on_duty` WHERE `vehicle_on_duty`.`plate_no` = '$assign'")or die(mysql_error());

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
                    <h2><i class="fa fa-bars"></i> Vehicle Managment <small>adding new vehicle, removing vehicle face problem, update some information about the vehicles</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Add Vehicle</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">See All Vehicles</a>
                        </li>
                      </ul>
                      <div id="myTabContent2" class="tab-content">

                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">
                          <div class="row">
                              <form name="addv" id="addv" class="form-horizontal form-label-left">
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">plate number <span class="required">*</span>
                                  </label>
                                  <div class="input-group col-md-6 col-sm-6 col-xs-12">
                                      <input onfocus="platnoF ()" onblur="platnob ()" type="text" id="platno" name="platno" required="required" class="form-control col-md-7 col-xs-12">
                                      <span class="input-group-btn">
                                        <select name = "state" type="button" class="btn btn-default" required="required">
                                          <option value="">.....</option>
                                          <option value="AA">AA</option>
                                          <option value="AM">AM</option>
                                          <option value="OR">OR</option>
                                          <option value="TR">TR</option>
                                          <option value="ES">ES</option>
                                          <option value="HR">HR</option>
                                          <option value="DR">DR</option>
                                          <option value="BG">BG</option>
                                          <option value="SP">SP</option>
                                          <option value="AF">AF</option>
                                          <option value="GM">GM</option>
                                          <option value="ET">ET</option>
                                        </select>
                                      </span>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">number of seat<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input onfocus="seatnoF ()" onblur="seatnoB ()"  type="text" id="seatno" name="seatno" required="required" class="form-control col-md-7 col-xs-12">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">type</label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select onclick="vehicletypeF ()" onblur="vehicletypeB ()" id="vehicletype" name="vehicletype" class="form-control col-md-7 col-xs-12">
                                      <option value="">. &nbsp; . &nbsp; .  Select Vehicle Type Here . &nbsp; . &nbsp; .</option>
                                      <option value="pick up">Pick up</option>
                                      <option value="bus">Bus</option>
                                      <option value="others">Others</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button onclick="Clicked ()" type="submit" class="btn btn-success">Submit</button>
                                  </div>
                                </div>

                              </form>
                          </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">
                          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>plate Number</th>
                                <th>Number of seat</th>
                                <th>Type</th>
                                <th>Report</th>
                                <th>Action if Returned</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                $conn = mysqli_connect("localhost","root","","huvmts");   
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                  echo "<script>window.alert('mysqli_connect_error()')</script>";
                                }
                                $sql = "SELECT * FROM Vehicle";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                  while($row = mysqli_fetch_assoc($result)) {
                                    $pno = $row['plate_no'];
                                    if ($row['report']=="not") {                                      
                                      $set = '<a class="label label-success">assign</a>';
                                    }else{
                                      $set = '<a href="index.php?'.$pno.'" class="label label-warning">returned</a>';
                                    }
                                    echo "
                                    <tr>
                                      <td>".$row['plate_no']."</td> <td>".$row['no_seat']."</td> <td>".$row['Vehicle_type']."</td> 
                                      <td>".$row['report']."</td>  <td>".$set."</td>
                                    </tr>";
                                  }
                                }
                                mysqli_close($conn);
                              ?>                        
                            </tbody>
                          </table>
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
  function platnoF () {
    firstname_field=addv.platno.value;
    if (firstname_field=="Plat number is required") {
      document.getElementById("platno").value="";
      document.getElementById("platno").style.color = "black";
      document.getElementById("platno").style.fontWeight="normal";
    }
  }
  function platnob () {
    x=addv.platno.value;
    if(x==""||x==null){
      document.getElementById("platno").style.color="brown";
      document.getElementById("platno").style.fontWeight="bold";
      document.getElementById("platno").value="Plat number is required";
    } else if(! /^[0-9]+$/.test(x)){
      document.getElementById("platno").style.color="brown";
      document.getElementById("platno").style.fontWeight="bold";
      document.getElementById("platno").value="it should contains only number";
    }
  }
  function seatnoF () {
    firstname_field=addv.seatno.value;
    if (firstname_field=="number of seat is required" || firstname_field=="it should contains only number") {
      document.getElementById("seatno").value="";
      document.getElementById("seatno").style.color = "black";
      document.getElementById("seatno").style.fontWeight="normal";
    }
  }
  function seatnoB () {
    x=addv.seatno.value;
    if(x==""||x==null){
      document.getElementById("seatno").style.color="brown";
      document.getElementById("seatno").style.fontWeight="bold";
      document.getElementById("seatno").value="number of seat is required";
      //window.alert(x.match("^[a-zA-Z]+$");
    }else if(! /^[0-9]+$/.test(x)){
      document.getElementById("seatno").style.color="brown";
      document.getElementById("seatno").style.fontWeight="bold";
      document.getElementById("seatno").value="it should contains only number";
    };
  }
  function Clicked (){
    if (document.getElementById("seatno").value=="it should contains only number" || document.getElementById("seatno").value=="number of seat is required"||
      document.getElementById("seatno").value== null || document.getElementById("seatno").value== ""||
      document.getElementById("platno").value=="it should contains only number" || document.getElementById("platno").value=="number of seat is required"||
      document.getElementById("platno").value== null || document.getElementById("platno").value== "") {
      window.alert('Fill required information');

    }else {
      document.getElementById('addv').method="post";    
    }
  }
</script>

<?php 

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $platno = $_POST['platno']."".$_POST['state'];
    $no_seat = $_POST['seatno'];
    $type = $_POST['vehicletype'];


    $conn = mysqli_connect("localhost","root","","huvmts");   
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      echo "<script>window.alert('mysqli_connect_error()')</script>";
    }
    
    $sql = "INSERT INTO `vehicle` (`plate_no`, `no_seat`, `Vehicle_type`, `report`) VALUES ('$platno', '$no_seat', '$type', 'not');";

    if (mysqli_query($conn, $sql)) {
      echo "<script>window.alert('register vehicle successfully!')</script>";
      $x=true;
     } else {
      echo "<script>window.alert('vehicle is alrady Exist!')</script>";
      $x=true;
     }
      
    
    mysqli_close($conn);
  }
?>
<!-- for DATAset -->
<script>
      $(document).ready(function() {
        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>