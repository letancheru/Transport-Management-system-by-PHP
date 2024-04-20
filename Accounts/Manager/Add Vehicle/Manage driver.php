<!DOCTYPE html>
<?php
  $title = "Manage Driver";
  $ManagerHome = "";
  $ManagerTracking= "";
  $ManagerInbox = "";
  $ManagerSend = "";
  $Manageraddir = "active";
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
                    <h2><i class="fa fa-bars"></i> Driver Managment <small>adding new vehicle, removing vehicle face problem, update some information about the vehicles</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Add Driver</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">See All Driver</a>
                        </li>
                      </ul>
                      <div id="myTabContent2" class="tab-content">

                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">
                          <div class="row">
                              <form name="addir" id="addir" class="form-horizontal form-label-left">


                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Driver ID<span class="is required"></span>
                                  </label>
                                  <div class="form-inline col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <input placeholder="specific code" onfocus="IDcodeF ()" onblur="IDcodeb ()" type="text" id="IDcode" name="IDcode" required="is required" class="form-control col-xs-12">
                                    </div>
                                    <div class="form-group">
                                      <label for="IDyear"><strong>/</strong></label>
                                      <input placeholder="(eg.2006GC enter 06)" onfocus="IDyearF ()" onblur="IDyearb ()"  type="text" name = "IDyear" id = "IDyear" type="button" class="form-control" required="is required">
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">First Name<span class="is required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input onfocus="nameF ()" onblur="nameB ()"  type="text" id="name" name="name" required="is required" class="form-control col-md-7 col-xs-12">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name<span class="is required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input onfocus="lnameF ()" onblur="lnameB ()"  type="text" id="lname" name="lname" required="is required" class="form-control col-md-7 col-xs-12">
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
                                <th>Driver ID</th>
                                <th>First name</th>
                                <th>Last Name</th>
                                <th>Report</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                $conn = mysqli_connect("localhost","root","","huvmts");   
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                  echo "<script>window.alert('mysqli_connect_error()')</script>";
                                }
                                $sql = "SELECT * FROM `driver`";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                  while($row = mysqli_fetch_assoc($result)) {
                                    $pno = $row['driver_id'];
                                    if ($row['report']=="not") {                                      
                                      $set = '<span class="label label-danger">Not</span>';
                                    }else{
                                      $set = '<span class="label label-success">Assigned</span>';
                                    }
                                    echo "
                                    <tr>
                                      <td>".$row['driver_id']."</td> <td>".$row['firstname']."</td> <td>".$row['lastname']."</td> 
                                      <td>".$set."</td>
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

<?php 

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $IDcode = $_POST['IDcode']."/".$_POST['IDyear'];
    $name = $_POST['name'];
    $lname = $_POST['lname'];


    $conn = mysqli_connect("localhost","root","","huvmts");   
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      echo "<script>window.alert('mysqli_connect_error()')</script>";
    }
    
    $sql = "INSERT INTO `driver` (`driver_id`, `firstname`, `lastname`, `report`) VALUES ('$IDcode', '$name', '$lname', 'not');";

    if (mysqli_query($conn, $sql)) {
      echo "<script>window.alert('register successfully!')</script>";
      $x=true;
     } else {
      echo "<script>window.alert('Driver is alrady Exist!')</script>";
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