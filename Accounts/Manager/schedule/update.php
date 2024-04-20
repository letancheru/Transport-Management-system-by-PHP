<!DOCTYPE html>

<?php 

   mysql_connect("localhost","root","");
   mysql_select_db("HUVMTS");
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

   
    $date = date('Y-m-d',strtotime($_POST['date']));
    $time = time('h-m-s',strtotime($_POST['time']));
    $destination = $_POST['destination'];
    if ($date != ""||$date != null) {
      $result = mysql_query("UPDATE `schedule` SET `date` = '$date' WHERE `schedule_id` = '".$_SERVER['QUERY_STRING']."';")or die(mysql_error());
      if($result){
        $displayText = 1;
      }
    }


    if ($time != ""||$time!= null) {
      $result = mysql_query("UPDATE `schedule` SET `time` = '$time' WHERE `schedule_id` = '".$_SERVER['QUERY_STRING']."';")or die(mysql_error());
      if($result){
        $displayText = 1;
      }
    }

    if ($destination != ""||$destination != null) {
      $result = mysql_query("UPDATE `schedule` SET `destination` = '$destination' WHERE `schedule_id` = '".$_SERVER['QUERY_STRING']."';")or die(mysql_error());
      if($result){
        $displayText = 1;
      }
    }
    echo "<script>window.alert('schedule updated successfully!')</script>";
    mysql_close();
  }
?>


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
?>   <!-- page content -->
      
          <div class="right_col">
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Schedule setting schedule,for our university employee</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">prepare schedule</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">view schedule</a>
                        </li>
                      </ul>
                      <div id="myTabContent2" class="tab-content">

                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">
                          <div>
          <form style="color: black; font-size: 19px;" Method = "post" name="registration"  enctype="multipart/form-data">
              <div class="col-md-3 col-sm-3"></div>
              <div class = " col-md-7 col-sm-7 col-xs-12">            
                <h1 align="center">Schedule</h1>
              
                             <div class="input-group">
                  <div style="color: black; font-size: 19px;" class="input-group-addon">Date</div>
                  <input onFocus="onFocusbd ()" onBlur="onBulrbd ()" id="date" name = "date" type="Date" class="form-control" placeholder="date" required="" /><br>
                </div> 
                <div class="input-group">
                  <div style="color: black; font-size: 19px;" class="input-group-addon">Time</div>
                  <input onFocus="onFocusbd ()" onBlur="onBulrbd ()" id="time" name = "time" type="Time" class="form-control" placeholder="time" required="" /><br>
                </div>    
                <div class="input-group">
                  <div style="color: black; font-size: 19px;" class="input-group-addon">Destination</div>
                  <input onFocus="onFocusbd ()" onBlur="onBulrbd ()" id="destination" name = "destination" type="text" class="form-control" placeholder="destination" required="" /><br>
                </div>                 

             
                <div class = "col-md-3 col-md-offset-4 col-sm-3 col-sm-offset-4 col-xs-3 col-xs-offset-4">
                  <input type = "submit" value="submit" class = "btn btn-success" />
                </div>

                <div class="clearfix"></div>


              </div>
            </form>
          </div>
        </div>


                        <div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">
                          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Plate_no</th>
                                <th>Vehicle_type</th>
                                <th>Driver ID</th>
                                <th>Driver Name</th>
                                <th>Driver phone_no</th>
                                <th>Destination</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                $conn = mysqli_connect("localhost","root","","huvmts");   
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                  echo "<script>window.alert('mysqli_connect_error()')</script>";
                                }
                                $sql = "SELECT * FROM `schedule`";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                  while($row = mysqli_fetch_assoc($result)) {
                                    echo "
                                    <tr>
                                      <td>".$row['date']."</td> <td>".$row['time']."</td> <td>".$row['plate_no']."</td><td>".$row['vehicle_type']."</td><td>".$row['driver_id']."</td><td>".$row['driver_name']."</td> </td><td>".$row['phone']."</td> <td>".$row['destination']."</td> 
                                      
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
  function IDcodeF () {
    firstname_field=addir.IDcode.value;
    if (firstname_field=="is required"||firstname_field=="should be number") {
      document.getElementById("IDcode").value="";
      document.getElementById("IDcode").style.color = "black";
      document.getElementById("IDcode").style.fontWeight="normal";
    }
  }
  function IDcodeb () {
    x=addir.IDcode.value;
    if(x==""||x==null){
      document.getElementById("IDcode").style.color="brown";
      document.getElementById("IDcode").style.fontWeight="bold";
      document.getElementById("IDcode").value="is required";
    } else if(! /^[0-9]+$/.test(x)){
      document.getElementById("IDcode").style.color="brown";
      document.getElementById("IDcode").style.fontWeight="bold";
      document.getElementById("IDcode").value="should be number";
    }
  }


  function IDyearF () {
    firstname_field=addir.IDyear.value;
    if (firstname_field=="is required"||firstname_field=="should be number") {
      document.getElementById("IDyear").value="";
      document.getElementById("IDyear").style.color = "black";
      document.getElementById("IDyear").style.fontWeight="normal";
    }
  }
  function IDyearb () {
    x=addir.IDyear.value;
    if(x==""||x==null){
      document.getElementById("IDyear").style.color="brown";
      document.getElementById("IDyear").style.fontWeight="bold";
      document.getElementById("IDyear").value="is required";
    } else if(! /^[0-9]+$/.test(x)){
      document.getElementById("IDyear").style.color="brown";
      document.getElementById("IDyear").style.fontWeight="bold";
      document.getElementById("IDyear").value="should be number";
    }
  }


  function nameF () {
    firstname_field=addir.name.value;
    if (firstname_field=="is Required" || firstname_field=="should be character") {
      document.getElementById("name").value="";
      document.getElementById("name").style.color = "black";
      document.getElementById("name").style.fontWeight="normal";
    }
  }
  function nameB () {
    x=addir.name.value;
    if(x==""||x==null){
      document.getElementById("name").style.color="brown";
      document.getElementById("name").style.fontWeight="bold";
      document.getElementById("name").value="is Required";
      //window.alert(x.match("^[a-zA-Z]+$");
    }else if(! /^[a-zA-Z]+$/.test(x)){
      document.getElementById("name").style.color="brown";
      document.getElementById("name").style.fontWeight="bold";
      document.getElementById("name").value="should be character";
    };
  }


  function lnameF () {
    firstname_field=addir.lname.value;
    if (firstname_field=="is required" || firstname_field=="should be character") {
      document.getElementById("lname").value="";
      document.getElementById("lname").style.color = "black";
      document.getElementById("lname").style.fontWeight="normal";
    }
  }
  function lnameB () {
    x=addir.lname.value;
    if(x==""||x==null){
      document.getElementById("lname").style.color="brown";
      document.getElementById("lname").style.fontWeight="bold";
      document.getElementById("lname").value="is required";
      //window.alert(x.match("^[a-zA-Z]+$");
    }else if(! /^[a-zA-Z]+$/.test(x)){
      document.getElementById("lname").style.color="brown";
      document.getElementById("lname").style.fontWeight="bold";
      document.getElementById("lname").value="should be character";
    };
  }

  function Clicked (){
    if (document.getElementById("name").value=="should be character" || document.getElementById("name").value=="is Required"||
      document.getElementById("name").value== null || document.getElementById("name").value== ""||
      document.getElementById("IDcode").value=="be number" || document.getElementById("IDcode").value=="is Required"||
      document.getElementById("IDcode").value== null || document.getElementById("IDcode").value== "") {
      window.alert('Fill required information');

    }else {
      document.getElementById('addir').method="post";    
    }
  }
</script>

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