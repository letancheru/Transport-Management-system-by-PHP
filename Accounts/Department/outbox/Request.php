<!DOCTYPE html>
<?php
  $title = "Send Request";
  $DepartmentHome = "";
  $DepartmentInbox= "";
  $DepartmentSend = "";
  $SendReq = "active";
  $post="";
  
  session_start();

  $conn = mysqli_connect("localhost","root","","huvmts");  

  $dpt_sql = "SELECT * FROM `department` WHERE `username` = '".$_SESSION['username']."'"; 
  $dept = mysqli_query($conn,$dpt_sql);
  $row = mysqli_fetch_array($dept);

  $dpt_name = $row['dept_name'];
  if ($dpt_name==""||$dpt_name==null) {
    echo "<script>window.alert('you have Information to fill first before sending request')</script>"; 
    header("Location:../additional info.php");     
  }

  if (!isset($_SESSION['firstname'])) {
    header("Location:../../../index.php");
  }
  if ($_SESSION['acct_type']!="Department") {
    header("Location:../../../index.php");
  }
  include_once "../../../pages/layout/Department/DepartmentNavs.php";
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">

                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Send Request</h2>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <div id="alerts"></div>
                          <form name="addir" id="addir" class="form-horizontal form-label-left">

                                <div class="form-group">
                                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">type</label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select onclick="vehicletypeF ()" onblur="vehicletypeB ()" id="vehicletype" name="vehicletype" class="form-control col-md-7 col-xs-12" required="is required">
                                      <option value="">. &nbsp; . &nbsp; .  Select Vehicle Type Here . &nbsp; . &nbsp; .</option>
                                      <option value="pick up">Pick up</option>
                                      <option value="bus">Bus</option>
                                      <option value="others">Others</option>
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Time<span class="is required"></span>
                                  </label>
                                  <div class="form-inline col-md-6 col-sm-6 col-xs-12">
                                      <div class="form-group">
                                        <label for="start"><strong>From &nbsp; </strong></label>
                                        <input id="start" placeholder="From" onfocus="startF ()" onblur="startb ()" type="date"  name="start" required="is required" class="form-control">
                                      </div>
                                      <div class="form-group">
                                        <label for="to"><strong> To &nbsp; </strong></label>
                                        <input placeholder="To" onfocus="toF ()" onblur="tob ()"  type="date" name = "to" id = "to" type="button" class="form-control" required="is required">
                                      </div>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Destination<span class="is required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input onfocus="destinationF ()" onblur="destinationB ()"  type="text" id="destination" name="destination" required="is required" class="form-control col-md-7 col-xs-12">
                                  </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button onclick="Clicked ()" type="submit" class="btn btn-success">Request</button>
                                  </div>
                                </div>

                          </form>                        
                
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

<script type="text/javascript">
  function startF () {
    firstname_field=addir.start.value;
    if (firstname_field=="Please enter start time" || firstname_field=="please Enter correct date") {
      document.getElementById("start").style.color="black";
      document.getElementById("start").style.fontWeight="normal";
      document.getElementById("start").type="Date";
    }
  }
  function startb () {
    x=addir.start.value;
    inputstart = new Date(x);
    if (inputstart < (new Date())) {
      document.getElementById("start").style.color="brown";
      document.getElementById("start").style.fontWeight="bold";
      document.getElementById("start").type="text";
      document.getElementById("start").value="please Enter correct date"; 
    }if (x == "" || x == null) {
      document.getElementById("start").style.color="brown";
      document.getElementById("start").style.fontWeight="bold";
      document.getElementById("start").type="text";
      document.getElementById("start").value="Please enter start time"; 
    }
  }


  function toF () {
    firstname_field=addir.to.value;
    if (firstname_field=="Please enter End time" || firstname_field=="End date should be after start date") {
      document.getElementById("to").style.color="black";
      document.getElementById("to").style.fontWeight="normal";
      document.getElementById("to").type="Date";
    }
  }
  function tob () {
    x = addir.start.value;
    y = addir.to.value;

    inputstart = new Date(x);
    inputend = new Date(y);

    if (inputend < inputstart || inputend< (new Date())) {
      document.getElementById("to").style.color="brown";
      document.getElementById("to").style.fontWeight="bold";
      document.getElementById("to").type="text";
      document.getElementById("to").value="End date should be after start date";
    }if(y==""||y==null){
      document.getElementById("to").style.color="brown";
      document.getElementById("to").style.fontWeight="bold";
      document.getElementById("to").type="text";
      document.getElementById("to").value="Please enter End time";
    };
  }


  function destinationF () {
    firstname_field=addir.destination.value;
    if (firstname_field=="is Required" || firstname_field=="should be character") {
      document.getElementById("destination").value="";
      document.getElementById("destination").style.color = "black";
      document.getElementById("destination").style.fontWeight="normal";
    }
  }
  function destinationB () {
    x=addir.destination.value;
    if(x==""||x==null){
      document.getElementById("destination").style.color="brown";
      document.getElementById("destination").style.fontWeight="bold";
      document.getElementById("destination").value="is Required";
      //window.alert(x.match("^[a-zA-Z]+$");
    }else if(/^[0-9]+$/.test(x)){
      document.getElementById("destination").style.color="brown";
      document.getElementById("destination").style.fontWeight="bold";
      document.getElementById("destination").value="should be character";
    };
  }


  function Clicked (){
    if (document.getElementById("destination").value=="should be character" || document.getElementById("destination").value=="is Required"||
      document.getElementById("destination").value== null || document.getElementById("destination").value== ""||
      document.getElementById("vehicletype").value== null || document.getElementById("vehicletype").value== ""||
      document.getElementById("start").value=="be number" || document.getElementById("start").value=="is Required"||
      document.getElementById("start").value== null || document.getElementById("start").value== "") {
      window.alert('Fill required information');

    }else {
      document.getElementById('addir').method="post";    
    }
  }
</script>

<?php 

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $vehicletype = $_POST['vehicletype'];
    $start = $_POST['start'];
    $to = $_POST['to'];
    $destination = $_POST['destination'];
    $username = $_SESSION['username'];

    $conn = mysqli_connect("localhost","root","","huvmts");  

    $dpt_sql = "SELECT * FROM `department` WHERE `username` = '".$_SESSION['username']."'"; 
    $dept = mysqli_query($conn,$dpt_sql);
    $row = mysqli_fetch_array($dept);

    $dpt_name = $row['dept_name'];
    

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      echo "<script>window.alert('mysqli_connect_error()')</script>";
    }

    $sql = "INSERT INTO `request`(`dept_name`, `username`, `vehicle_type`, `start_time`, `end_time`, `destination`, `report`, `dept_see`, `mgr_see`) 
      VALUES ('$dpt_name','$username','$vehicletype','$start','$to','$destination','not','new','no')";

    if (mysqli_query($conn, $sql)) {
      echo "<script>window.alert('you sent request successfully!')</script>";
      $x=true;
     } else {
      echo "<script>window.alert('your request is not sent!')</script>";
      $x=true;
     }
      
    
    mysqli_close($conn);
  }
?>