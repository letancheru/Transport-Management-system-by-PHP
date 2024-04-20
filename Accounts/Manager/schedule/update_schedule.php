<!DOCTYPE html>
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
?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
                <div class="row">
          <div>
            <form action="chaking.php" Mothod = "get">
              <div class="col-md-3 col-sm-3"></div>
              <div class = " col-md-5 col-sm-5 col-xs-12"> 

                <div class="row col-md-5 col-sm-5 col-xs-12">&nbsp;</div><br>
                <h1 align="center">Search Schedule</h1>
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
      </div>
    </div>

        <?php
  include_once "../../../pages/layout/manager/ManagerFoot.php";
?>