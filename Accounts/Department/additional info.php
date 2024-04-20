<!DOCTYPE html>
<?php 

  session_start();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $deptname = $_POST['deptname'];
    $username = $_SESSION['username'];

    $conn = mysqli_connect("localhost","root","","huvmts");   
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      echo "<script>window.alert('mysqli_connect_error()')</script>";
    }
    
    $sql = "INSERT INTO `department` (`username`, `dept_name`) VALUES ('$username','$deptname');";

    if (mysqli_query($conn, $sql)) {
      echo "<script>window.alert('thank you! You set department you represent successfully')</script>";      
      header("Location:outbox/Request.php");  
      $x=true;
     } else {
      echo "<script>window.alert('You Alrady set your Department')</script>";
      $x=true;
     }
      
    
    mysqli_close($conn);
  }
  
  $title = "Additional information";
  $DepartmentHome = "";
  $DepartmentInbox= "";
  $DepartmentSend = "";
  $SendReq = "";
  $post="";
  if (!isset($_SESSION['firstname'])) {
    header("Location:../../index.php");
  }
  if ($_SESSION['acct_type']!="Department") {
    header("Location:../../index.php");
  }
  include_once "../../pages/layout/Department/DepartmentNavs.php";
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Additional Info <small>Please enter Department you represent. This will help you to send vehicle request</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">                      

                        <div>
                          <div class="row">
                              <form name="addir" id="addir" class="form-horizontal form-label-left">

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Department<span class="is required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input onfocus="deptnameF ()" onblur="deptnameB ()"  type="text" id="deptname" name="deptname" required="is required" class="form-control col-md-7 col-xs-12">
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

                    </div>
                  </div>
                </div>
              </div>
            </div>            
          </div>
        </div>
        <!-- /page content -->
<?php
  include_once "../../pages/layout/Department/DepartmentFoot.php";
?>
<script type="text/javascript">
  function deptnameF () {
    firstname_field=addir.deptname.value;
    if (firstname_field=="is required" || firstname_field=="should be character") {
      document.getElementById("deptname").value="";
      document.getElementById("deptname").style.color = "black";
      document.getElementById("deptname").style.fontWeight="normal";
    }
  }
  function deptnameB () {
    x=addir.deptname.value;
    if(x==""||x==null){
      document.getElementById("deptname").style.color="brown";
      document.getElementById("deptname").style.fontWeight="bold";
      document.getElementById("deptname").value="is required";
      //window.alert(x.match("^[a-zA-Z]+$");
    }else if(/^[0-9]+$/.test(x)){
      document.getElementById("deptname").style.color="brown";
      document.getElementById("deptname").style.fontWeight="bold";
      document.getElementById("deptname").value="should be character";
    };
  }

  function Clicked (){
    if (document.getElementById("deptname").value=="be number" || document.getElementById("deptname").value=="is Required"||
      document.getElementById("deptname").value== null || document.getElementById("deptname").value== "") {
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