<!DOCTYPE html>
<?php
  $title = "Home";
  $securityHome = "";
  $notification= "";
  $schedule="active";
 

  session_start();
  if (!isset($_SESSION['firstname'])) {
    header("Location:../../index.php");
  }
  if ($_SESSION['acct_type']!="Security") {
    header("Location:../../index.php");
  }

 
  include_once "../../../pages/layout/security/securityNavs.php";
?>
        <!-- page content -->
        
          <div class="right_col">

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>SCHEDULE </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Request_Id</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Plate_no</th>
                          <th>Vehicle type</th>
                          <th>driver Id</th>
                          <th>driver name</th>
                          <th>driver phone_no</th>
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
                          $sql = "SELECT * FROM schedule";
                          $result = mysqli_query($conn, $sql);

                          if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                              echo "
                              <tr>
                                <td>".$row['schedule_id']."</td> <td>".$row['date']."</td> <td>".$row['time']."</td> <td>".$row['plate_no']."</td>
                                <td>".$row['vehicle_type']."</td>  <td>".$row['driver_id']."</td> <td>".$row['driver_name']."</td><td>".$row['phone']."</td> 
                                <td>".$row['destination']."</td> 
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
        <!-- /page content -->
    
<?php
   include_once "../../../pages/layout/security/securityFoot.php";
?>
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