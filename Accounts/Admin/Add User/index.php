<!DOCTYPE html>
<?php
  $title = "Add User |";
  $AdminHome = "";
  $AdminAdd= "active";
  $AdminUpdate = "";
  $AdminRemove = "";
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
  include '../../../Class/PHP/registerUser.php';
?>


        <!-- page content -->

          <div>
            <form style="color: black; font-size: 19px;" Method = "post" name="registration"  enctype="multipart/form-data">
              <div class="col-md-3 col-sm-3"></div>
              <div class = " col-md-7 col-sm-7 col-xs-12">            
                <h1 align="center">Register User</h1>
                <label>personal Informations</label>
                <div style="color: black; font-size: 19px;" class="form-inline">
                  <div class="input-group">
                    <div style="color: black; font-size: 19px;" class="input-group-addon">Frist Name</div>
                    <input  name="firstname" onFocus="onFocusF ()" onBlur="onBulrF ()" id="fname" type="text" class="form-control" placeholder="First Name" required="" />
                  </div>
                  <div class="input-group">
                    <div style="color: black; font-size: 19px;" class="input-group-addon">Last Name</div>
                    <input  name="lastname" onFocus="onFocusL ()" onBlur="onBulrL ()"  id="lname" type="text" class="form-control" placeholder="Last Name"  required="" />
                  </div>
                </div>
                 <div class="input-group">
                  <div style="color: black; font-size: 19px;" class="input-group-addon">Email</div>
                  <input  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" id="email" name = "email" type="email" class="form-control" placeholder="letacheru484@gmail.com" required="" /><br>
                </div>  
                <div class="input-group">
                  <div style="color: black; font-size: 19px;" class="input-group-addon">Birthday</div>
                  <input onFocus="onFocusbd ()" onBlur="onBulrbd ()" id="birthday" name = "birthday" type="Date" class="form-control" placeholder="Birthday" required="" /><br>
                </div>                
                <div class="input-group">
                  <div style="color: black; font-size: 19px;" class="input-group-addon">Sex</div>
                  <select name = "sex" class="form-control">
                    <option value = "null">------- sex -----</option>
                    <option value = "Male">Male</option>
                    <option value = "Female">Female</option>
                    <option value="other">Other</option>                  
                  </select>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                  <label>Account Information</label>                  
                  <div class="input-group">
                    <div style="color: black; font-size: 19px;" class="input-group-addon">Username</div>
                    <input onFocus="onFocusun ()" onBlur="onBulrun ()"  name="username"   id="uname" type="text" class="form-control" placeholder="username" required="" /><br>
                  </div>                  
                  <div class="input-group">
                    <div style="color: black; font-size: 19px;" class="input-group-addon">Password</div>
                    <input onFocus="onFocuspass ()" onBlur="onBulrpass ()" name = "password" id="pass" type="password" class="form-control" placeholder="Password" required="" /><br>
                  </div>
                  <div class="input-group">
                    <div style="color: black; font-size: 19px;" class="input-group-addon">Re-password</div>
                    <input onFocus="onFocusrepass ()" onBlur="onBulrrepass ()" name = "repassword" id="repass" type="password" class="form-control" placeholder="Re-Password" required="" /><br>
                  </div>
                  <div class="input-group">
                    <div style="color: black; font-size: 19px;" class="input-group-addon">Account type</div>
                    <select name = "acct_type" class="form-control">
                      <option value = "null">------- choose Account type -----</option>
                      <option value = "Admin">Admin</option>          
                      <option value = "Manager">Manager</option> 
                      <option value = "Driver">Driver</option>       
                       <option value = "Department">Department</option>
                      <option value="Passenger">Passenger</option>
                      <option value="Security">Security</option>                  
                    </select><br>
                  </div>
                </div>
                <div class="clearfix"></div>

                <div class="separator">
                  <label>For recovery</label><br>                  
                  <div class="input-group">
                    <div style="color: black; font-size: 19px;" class="input-group-addon">Recovery Question</div>
                    <select name = "recover_question" class="form-control">
                      <option value = "">---- please choose your password recover question ----</option>
                      <option value = "mothers name">What is your mothers name?</option>
                      <option value = "Hometown">What is your Hometown?</option>
                      <option value = "Favorite Food">What is your Favorite Food?</option>
                      <option value = "First chaild name">What is your First chaild name?</option>
                    </select><br>
                  </div>
                  <div class="input-group">
                    <div style="color: black; font-size: 19px;" class="input-group-addon">Recovery Answer</div>
                    <input onBlur="onblurpa ()" onFocus="onfocuspa ()" name = "passAnswer" id="passAns" type="text" class="form-control" placeholder="Password question Answer" required="" /><br>
                  </div>
                </div>
                <div class = "col-md-3 col-md-offset-4 col-sm-3 col-sm-offset-4 col-xs-3 col-xs-offset-4">
                  <input type = "submit" value="Register" class = "btn btn-success" />
                </div>

                <div class="clearfix"></div>


              </div>
            </form>
          </div>
        </div>
        <script src="../../../class/js/form validation.js"></script>
        <!-- /page content -->
<?php
  include_once "../../../pages/layout/admin/AdminFoot.php";
?>