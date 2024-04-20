<!DOCTYPE html>
<?php
  $title = "Updat post |";
  $AdminHome = "";
  $AdminAdd= "";
  $AdminUpdate = "";
  $AdminRemove = "";
  $AdminSee = "";
  $AdminPost = "active";
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
                          <th>ID</th>
                          <th>Subject</th>
                          <th>Content</th>
                          <th>image</th>
                          <th>Time</th>
                          <th>Account</th>
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
                          $sql = "SELECT * FROM `post`";
                          $result = mysqli_query($conn, $sql);

                          if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                              $id = $row['ID'];
                              echo "
                              <tr>
                                <td>".$row['ID']."</td> <td>".$row['Subject'].'</td> <td>'."</td> 
                                <td>".'<img height="20px" src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>'."</td>  
                                <td>".$row['Time']."</td> <td>".$row['acct_type']."</td> 
                                <td>".'<a href="Delete post.php?'.$id.'" class="label label-danger"><i class="fa fa-trash"></i> Delete</a>'.
                                '&nbsp; &nbsp; <a href="edit.php?'.$id.'" class="label label-success"> <i class="fa fa-edit"></i> edit</a>'."</td> 
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
        <script src="../../../class/js/form validation.js"></script>
        <!-- /page content -->
<?php
  include_once "../../../pages/layout/admin/AdminFoot.php";
?>