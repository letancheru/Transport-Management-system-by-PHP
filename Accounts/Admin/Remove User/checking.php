<!DOCTYPE html>
<!DOCTYPE html>
<?php
  $title = "Update user |";
  $AdminHome = "";
  $AdminAdd= "";
  $AdminUpdate = "";
  $AdminRemove = "active";
  $AdminSee = "";
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
        

          <?php
            mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());     
            mysql_select_db("huvmts") or die(mysql_error());
         
            if (isset($_GET['query'])) {        
              $query = $_GET['query']; 
              $min_length = 3;
               
              if(strlen($query) >= $min_length){ 
                $query = htmlspecialchars($query);          
                $query = mysql_real_escape_string($query);
                $raw_results2 = mysql_query("SELECT * FROM Account
                      WHERE (`firstname` LIKE '%".$query."%') OR (`lastname` LIKE '%".$query."%')
                      OR (`username` LIKE '%".$query."%')")or die(mysql_error());

                if(mysql_num_rows($raw_results2) > 0){
           ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="x_panel">
                      <div class="bs-callout bs-callout-warning" id="callout-glyphicons-accessibility">
                        <h4>Result in post</h4> 
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>First Name</th> <th>Last Name</th> <th>Sex</th> <th>Birthday</th>
                                <th>Username</th> <th>password</th> <th>ACC type</th> <th>password qestion</th> 
                                <th>password qestion answer</th><th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
            <?php                       
                      while($results = mysql_fetch_array($raw_results2)){
                        echo "
                                <tr>
                                  <td>".$results['firstname']."</td> <td>".$results['lastname']."</td> <td>".$results['sex']."</td> <td>".$results['birthday']."</td>
                                  <td>".$results['username']."</td>  <td>".$results['password']."</td> <td>".$results['acct_type']."</td> 
                                  <td>".$results['recovery_question']."</td> 
                                  <td>".$results['recovery_answer']."</td> <td>".'<a href="remover.php?'.$results['username'].'" class="label label-danger">Delete</>'."</td>
                                </tr>";                
                      }
          ?>
                  </tbody>
                          </table>
                          </div>
                    </div>
                  </div>
                </div>
                <?php
                       
                  }
                  else{
          ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="x_panel">
                          <div class="bs-callout bs-callout-warning" id="callout-glyphicons-accessibility">
                            <h4>Nothing is founded</h4>                        
                          </div>
                    </div>
                  </div>
                </div>
                <?php
                  }
                   
              }

              else{ // if query length is less than minimum
                  echo "Minimum length is ".$min_length;
              }
          }else{
            echo "string";
          }
          ?>

        </div>
        <!-- /page content -->

<?php
  include_once "../../../pages/layout/admin/AdminFoot.php";
?>