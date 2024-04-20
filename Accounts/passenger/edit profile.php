<!DOCTYPE html>
<?php
  $title = "";
  $AdminHome = "";
  $AdminAdd= "";
  $AdminUpdate = "";
  $AdminRemove = "";
  $AdminSee = "";
  $AdminPost = "";

  session_start();
  if (!isset($_SESSION['firstname'])) {
    header("Location:../../index.php");
  }
  if ($_SESSION['acct_type']!="Passenger") {
    header("Location:../../index.php");
  }
  include_once "../../pages/layout/Passenger/passengerNavs.php";
  include '../../Class/PHP/updateUserInfo.php';
?>


        <!-- page content -->

        <div class="right_col" role="main">
          <div>
            <form Method = "post" name="registration"  enctype="multipart/form-data">
              <div class="col-md-3 col-sm-3"></div>
              <div class = " col-md-7 col-sm-7 col-xs-12">            
                <h1 align="center">Update information</h1>
                <label>personal Informations</label>
                <div class="form-inline">
                  <input  name="firstname" onFocus="onFocusF ()" onBlur="onBulrF ()" id="fname" type="text" class="form-control" placeholder="First Name"/>
                  <input  name="lastname" onFocus="onFocusL ()" onBlur="onBulrL ()"  id="lname" type="text" class="form-control" placeholder="Last Name" />
                </div><br>
                <div class="input-group">
                  <div class="input-group-addon">Birthday</div>
                  <input onFocus="onFocusbd ()" onBlur="onBulrbd ()" id="birthday" name = "birthday" type="Date" class="form-control" placeholder="Birthday"/><br>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                  <label>Account Information</label>
                  <input onFocus="onFocuspass ()" onBlur="onBulrpass ()" name = "password" id="pass" type="password" class="form-control" placeholder="Password"/><br>
                  <input onFocus="onFocusrepass ()" onBlur="onBulrrepass ()" name = "repassword" id="repass" type="password" class="form-control" placeholder="Re-Password"/><br>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Select photo</label>
                    <input type="file" class="form-control-file" id="content" name="photo"
                    <small id="fileHelp" class="form-text text-muted">Include cover photo of post(it is optional)</small>
                </div>
                <div class="clearfix"></div>
                <div class = "col-md-3 col-md-offset-4 col-sm-3 col-sm-offset-4 col-xs-3 col-xs-offset-4">
                  <input type = "submit" value="UPDATE" class = "btn btn-success" />
                </div>

                <div class="clearfix"></div>


              </div>
            </form>
          </div>
        </div>
        <script src="../../class/js/update.js"></script>
        <!-- /page content -->
<?php
  include_once "../../pages/layout/Passenger/PassengerFoot.php";
?>