<!DOCTYPE html>
<?php
  $title = "See All Users |";
  $AdminHome = "";
  $AdminAdd= "";
  $AdminUpdate = "";
  $AdminRemove = "";
  $AdminSee = "active";
  $AdminPost = "";
  $vehicle="";
  $driver="";
  $passenger="";

  session_start();
  if (!isset($_SESSION['firstname'])) {
    header("Location:../../../index.php");
  }
  if ($_SESSION['acct_type']!="Admin") {
    header("Location:../../../index.php");
  }
  include_once "../../../pages/layout/admin/AdminNavs.php";
?>
        <!-- page content -->
        
          <div class="">

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>All users</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Sex</th>
                          <th>Birthday</th>
                          <th>Email</th>
                          <th>Username</th>
                          <th>password</th>
                          <th>ACC type</th>
                          <th>password qestion</th>
                          <th>password answer</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $conn = mysqli_connect("localhost","root","","huvmts");   
                          if (!$conn) {
                              die("Connection failed: " . mysqli_connect_error());
                            echo "<script>window.alert('mysqli_connect_error()')</script>";
                          }
                          $sql = "SELECT * FROM Account";
                          $result = mysqli_query($conn, $sql);

                          if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                              echo "
                              <tr>
                                <td>".$row['firstname']."</td> <td>".$row['lastname']."</td> <td>".$row['sex']."</td> <td>".$row['birthday']."</td><td>".$row['email']."</td>
                                <td>".$row['username']."</td>  <td>".$row['password']."</td> <td>".$row['acct_type']."</td> 
                                <td>".$row['recovery_question']."</td> <td>".$row['recovery_answer']."</td>
                                <td>".'<a href="../Remove User/remover.php?'.$row['username'].'" class="label label-danger">Delete</a>'.'&nbsp; &nbsp; '.
                                '<a href="../Update User/update.php?'.$row['username'].'" class="label label-success">edit</a>'."</td>
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
  include_once "../../../pages/layout/admin/AdminFoot.php";
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