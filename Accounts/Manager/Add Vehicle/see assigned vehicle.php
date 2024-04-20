<!DOCTYPE html>
<?php
  $title = "Assigned vehicle";
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
                    <h2>See Assigned vehicle</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Assigned Vehicles report</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">All Vehicles on duty</a>
                        </li>
                      </ul>
                      <div id="myTabContent2" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">
                          <div class="row">
                            <div  id="print" name="print" class="col-md-8 col-md-offset-2 col-sm-12">
                              <?php
                                mysql_connect("localhost","root","") or die("Error connecting to database: ".mysql_error());
                                mysql_select_db("huvmts") or die(mysql_error());

                                $no_vcl_on_duty = 0;
                                $dept_count = 0;

                                $rqst="";
                                $depts = "";

                                $sql = "SELECT * FROM `vehicle_on_duty`";
                                $fetch = mysql_query($sql);
                                while ($row=mysql_fetch_array($fetch)) {

                                  $fetch_rqst = mysql_query("SELECT * FROM `request` WHERE `r_id` = ".$row['r_id'].";");
                                  while ($rqst_row=mysql_fetch_array($fetch_rqst)){
                                    $onDuty[$no_vcl_on_duty] = $row;
                                    $rqst[$no_vcl_on_duty] = $rqst_row;

                                    if ($dept_count == 0) {
                                      $depts[$dept_count] = $rqst_row;
                                      $dept_count++;
                                    }else if ($depts[$dept_count-1]['dept_name']!=$rqst_row['dept_name']) {
                                      $depts[$dept_count] = $rqst_row;
                                      $dept_count++;
                                    }
                                  }
                                  $no_vcl_on_duty++;
                                }
                              ?>
                                  <h2><strong>Assigned Vehicles report</strong></h2>
                                  <p>
                                    <?php if($no_vcl_on_duty==1){echo "Their is only one vehicle is on duty";}else{
                                    echo "Their are ".$no_vcl_on_duty." vehicle are on duty";}?> requested by <?php 
                                    if($dept_count==1){echo "one department";}else{echo $dept_count." departments ";}?>.Namely
                                    Department of <?php 
                                      for ($i=0; $i < $dept_count; $i++) { 
                                        if($dept_count==1){echo $depts[$i]['dept_name']." and Detail description is given blow:-";}
                                        elseif($i == $dept_count-1){echo " and ".$depts[$i]['dept_name']." and Detail description is given blow 
                                          for each of departments:-";}
                                        else{echo $depts[$i]['dept_name'].", ";}
                                      }
                                    ?>
                                  </p>
                                  <?php

                                    for ($i=0; $i < $dept_count; $i++) { 
                                  ?>
                              <h2><ol>
                                <li>
                                    <?php echo $depts[$i]['dept_name'];?></h2>
                                    <?php
                                      for ($j=0; $j < $no_vcl_on_duty; $j++){
                                        if ($rqst[$j]['dept_name']== $depts[$i]['dept_name']) {
                                          $VCLQRY = mysql_query("SELECT * FROM `vehicle` WHERE `plate_no` = '".$onDuty[$j]['plate_no']."'");
                                          $VCLROW = mysql_fetch_array($VCLQRY);

                                          $DRVRQRY = mysql_query("SELECT * FROM `driver` WHERE `driver_id` = '".$onDuty[$j]['driver_id']."'");
                                          $DRVRROW = mysql_fetch_array($DRVRQRY);

                                    ?>
                                    <p>Vehicle on the duty is <?php echo $VCLROW['Vehicle_type'];?> with plate number of <?php echo $VCLROW['plate_no'];?>
                                      heads to <?php echo $rqst[$j]['destination'];?> from <?php echo $rqst[$j]['start_time'];?> to <?php echo $rqst[$j]['end_time'];?>.
                                      The driver is <?php echo $DRVRROW['firstname']." ".$DRVRROW['lastname'];?> and have ID number of <?php echo $onDuty[$j]['driver_id'];?>
                                    </p>
                                  <?php
                                        }
                                      }?>                              
                                </li>
                              </ol>
                                  <?php

                                    }
                                  ?>
                            </div>
                          </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">
                          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>plate number</th>
                                <th>Driver ID</th>
                                <th>Destney</th>
                                <th>start time</th>
                                <th>End_time</th>
                                <th>r_id</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                $conn = mysqli_connect("localhost","root","","huvmts");   
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                  echo "<script>window.alert('mysqli_connect_error()')</script>";
                                }
                                $sql = "SELECT * FROM `vehicle_on_duty`";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                  while($row = mysqli_fetch_assoc($result)) {
                                    $pno = $row['driver_id'];
                                    echo "
                                    <tr>
                                      <td>".$row['plate_no']."</td> <td>".$row['driver_id']."</td> <td>".$row['destney']."</td> 
                                      <td>".$row['start_time']."</td> <td>".$row['End_time']."</td> <td>".$row['r_id']."</td>
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
                    <input type="submit" value="print this page" class="btn btn-danger col-md-offset-9" onclick="prints ('print')"/>

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