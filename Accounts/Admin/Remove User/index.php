<!DOCTYPE html>
<!DOCTYPE html>
<?php
  $title = "Remove User |";
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
  if (isset($_SERVER['QUERY_STRING'])) {
    $query = $_SERVER['QUERY_STRING'];
    if ($query == "Succesfully") {
      echo "<script>window.alert('You Remove account Succesfully')</script>";
    }
  }
  if (!isset($_SESSION['firstname'])) {
    header("Location:../../../index.php");
  }
  if ($_SESSION['acct_type']!="Admin") {
    header("Location:../../../index.php");
  }
  include_once "../../../pages/layout/admin/AdminNavs.php";
?>
        <!-- page content -->
        

          <div>
            <form action="checking.php" Mothod = "get">
              <div class="col-md-3 col-sm-3"></div>
              <div class = " col-md-5 col-sm-5 col-xs-12"> 

                <div class="row col-md-5 col-sm-5 col-xs-12">&nbsp;</div><br>
                <h1 align="center">Search User</h1>
                <div>
                  <input name = "query" type="text" class="form-control" placeholder="Search User" required="" />
                </div><br>

                <div class = "col-md-3 col-md-offset-4 col-sm-3 col-sm-offset-4 col-xs-3 col-xs-offset-4">
                  <input type = "submit" value="Search user" class = "btn btn-success"  />
                </div>

                <div class="clearfix"></div>


              </div>
            </form>
          </div>
        </div>
        <!-- /page content -->

<?php
  include_once "../../../pages/layout/admin/AdminFoot.php";
?>