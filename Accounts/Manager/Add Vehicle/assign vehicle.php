<!DOCTYPE html>

<?php 

   mysql_connect("localhost","root","");
   mysql_select_db("HUVMTS");
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $assn_st_tm = $_POST['name'];
    $assn_en_tm = $_POST['lname'];

    if ($_SERVER['QUERY_STRING']) {
      $query = $_SERVER['QUERY_STRING'];
      $rqst_sql = "SELECT * FROM `request` WHERE `r_id`= $query AND `report` = 'not';";
      $fetch_rqst = mysql_query($rqst_sql);
      $rqst_row = mysql_fetch_array($fetch_rqst);



      $asgn_r_id = $query;
      $assn_dest = $rqst_row['destination'];



      $vcle_sql = "SELECT * FROM `vehicle` WHERE `Vehicle_type` = '".$rqst_row['vehicle_type']."' AND `report` = 'not' ORDER BY plate_no DESC LIMIT 1;";
      $fetch_vcle = mysql_query($vcle_sql);
      $row_vcle = mysql_fetch_array($fetch_vcle);
      if (mysql_num_rows($fetch_vcle) > 0) {

        $asgn_plate_no = $row_vcle['plate_no'];


        $drvr_sql = "SELECT * FROM `driver` WHERE `report` = 'not' ORDER BY driver_id DESC LIMIT 1;";
        $fetch_drvr = mysql_query($drvr_sql);
        $row_drvr = mysql_fetch_array($fetch_drvr);
        if (mysql_num_rows($fetch_drvr) > 0) {
          $asgn_driver_id = $row_drvr['driver_id'];
        }else{
          echo "<script>window.alert('Their is no free driver !');</script>";
        }
      }else{
        echo "<script>window.alert('Their is no free vehicle or you alrady replayied this request !');</script>";
      }
    }

    if (isset($asgn_plate_no)&&isset($asgn_driver_id)) {
      $sql_VOD = "INSERT INTO `vehicle_on_duty` (`plate_no`, `driver_id`, `destney`, `start_time`, `End_time`, `r_id`) 
                  VALUES ('$asgn_plate_no', '$asgn_driver_id', '$assn_dest', '$assn_st_tm', '$assn_en_tm', '$asgn_r_id');";
      if (mysql_query($sql_VOD)) {        
        mysql_query("UPDATE `request` SET `dept_see` = 'no', `report`='assigned' WHERE `r_id` = '$asgn_r_id';");
        mysql_query("UPDATE `vehicle` SET `report`='assigned' WHERE `plate_no` = '$asgn_plate_no';");
        mysql_query("UPDATE `driver` SET  `report`='assigned' WHERE `driver_id` = '$asgn_driver_id';");
        echo "<script>window.alert('Replayied Request Successfully!');</script>";
      }else{
        echo "<script>window.alert('Requested vehicle is on duty');</script>";
      }
    }
    
    mysql_close();
  }
?>
<?php
  $title = "Assign vehicle";
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
                    <h2><i class="fa fa-bars"></i> Vehicle assignment <small>adding new vehicle, removing vehicle face problem, update some information about the vehicles</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                      <div id="myTabContent2" class="tab-content">

                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">
                          <div class="row">
                            <?php        
                              if (isset($_SERVER['QUERY_STRING'])) {

                                mysql_connect("localhost","root","");
                                mysql_select_db("HUVMTS");

                                $query = $_SERVER['QUERY_STRING'];
                                $fetch_rqst = mysql_query("SELECT * FROM `request` WHERE `r_id`= $query AND `report` = 'not';");
                                $rqst_row = mysql_fetch_assoc($fetch_rqst);

                                $rqst_strt_tim = $rqst_row['start_time'];
                                $rqst_end_tim = $rqst_row['end_time'];
                              }     
                            ?>
                              <form name="addir" id="addir" class="form-horizontal form-label-left">
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"></label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <p><strong> Requested Start date : </strong> <?php echo $rqst_strt_tim?></p>
                                    <p><strong> Requested End date : </strong> <?php echo $rqst_end_tim?></p>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Start time<span class="is required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input onfocus="nameF ()" onblur="nameB ()" id="name" name="name" type="date" required="required" class="form-control col-md-7 col-xs-12">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">End time<span class="is required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input onfocus="lnameF ()" onblur="lnameB ()"  type="date" id="lname" name="lname" required="is required" class="form-control col-md-7 col-xs-12">
                                  </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <input onclick="Clicked ()" type="submit" class="btn btn-success" value="Submit"/>
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
  include_once "../../../pages/layout/manager/ManagerFoot.php";
?>
<script type="text/javascript">
  function nameF () {
    firstname_field=addir.name.value;
    if (firstname_field=="Please enter start time" || firstname_field=="please Enter correct date") {
      document.getElementById("name").style.color="black";
      document.getElementById("name").style.fontWeight="normal";
      document.getElementById("name").type="Date";
    }
  }
  function nameB () {
    x=addir.name.value;
    inputstart = new Date(x);
    if (inputstart < (new Date())) {
      document.getElementById("name").style.color="brown";
      document.getElementById("name").style.fontWeight="bold";
      document.getElementById("name").type="text";
      document.getElementById("name").value="please Enter correct date"; 
    }if (x == "" || x == null) {
      document.getElementById("name").style.color="brown";
      document.getElementById("name").style.fontWeight="bold";
      document.getElementById("name").type="text";
      document.getElementById("name").value="Please enter start time"; 
    }
  }


  function lnameF () {
    firstname_field=addir.lname.value;
    if (firstname_field=="Please enter End time" || firstname_field=="End date should be after start date") {
      document.getElementById("lname").style.color="black";
      document.getElementById("lname").style.fontWeight="normal";
      document.getElementById("lname").type="Date";
    }
  }
  function lnameB () {
    
    x = addir.name.value;
    y = addir.lname.value;

    inputstart = new Date(x);
    inputend = new Date(y);

    if (inputend < inputstart) {
      document.getElementById("lname").style.color="brown";
      document.getElementById("lname").style.fontWeight="bold";
      document.getElementById("lname").type="text";
      document.getElementById("lname").value="End date should be after start date";
    }if(y==""||y==null){
      document.getElementById("lname").style.color="brown";
      document.getElementById("lname").style.fontWeight="bold";
      document.getElementById("lname").type="text";
      document.getElementById("lname").value="Please enter End time";
    };
  }

  function Clicked (){
    if (document.getElementById("name").value=="Please enter start time" || document.getElementById("name").value=="please Enter correct date"||
      document.getElementById("name").value== null || document.getElementById("name").value== "" || 
      document.getElementById("lname").value=="Please enter End time" || document.getElementById("lname").value=="End date should be after start date"||
      document.getElementById("lname").value== null || document.getElementById("lname").value== "" ) {
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
