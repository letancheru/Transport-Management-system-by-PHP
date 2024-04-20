<!DOCTYPE html>
<?php
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $sex = $_POST['sex'];

    $password = MD5($_POST['password']);
    $acct_type = $_POST['acct_type'];

    $recover_question = $_POST['recover_question'];
    $passAnswer = $_POST['passAnswer'];


    if ($_FILES['photo']['tmp_name'] != "" || $_FILES['photo']['tmp_name'] != null) {
      $imagetmp = addslashes (file_get_contents($_FILES['photo']['tmp_name']));
    }

    mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());     
        mysql_select_db("huvmts") or die(mysql_error());  
    
    $displayText = 0;

    if ($firstname != ""||$firstname != null) {
      $result = mysql_query("UPDATE `account` SET `firstname` = '$firstname' WHERE `username` = '".$_SERVER['QUERY_STRING']."';")or die(mysql_error());
      if($result){
        $displayText = 1;
      }
    }   

    if ($lastname != ""||$lastname != null) {
      $result = mysql_query("UPDATE `account` SET `lastname` = '$lastname' WHERE `username` = '".$_SERVER['QUERY_STRING']."';")or die(mysql_error());
      if($result){
        $displayText = 1;
      }
    }


    if ($birthday != ""||$birthday != null) {
      $result = mysql_query("UPDATE `account` SET `birthday` = '$birthday' WHERE `username` = '".$_SERVER['QUERY_STRING']."';")or die(mysql_error());
      if($result){
        $displayText = 1;
      }
    }

    if ($sex != ""||$sex != null) {
      $result = mysql_query("UPDATE `account` SET `sex` = '$sex' WHERE `username` = '".$_SERVER['QUERY_STRING']."';")or die(mysql_error());
      if($result){
        $displayText = 1;
      }
    }


    if ($password != ""||$password != null) {
      $result = mysql_query("UPDATE `account` SET `password` = '$password' WHERE `username` = '".$_SERVER['QUERY_STRING']."';")or die(mysql_error());
      if($result){
        $displayText = 1;
      }
    }

    if ($acct_type != ""||$acct_type != null) {
      $result = mysql_query("UPDATE `account` SET `acct_type` = '$acct_type' WHERE `username` = '".$_SERVER['QUERY_STRING']."';")or die(mysql_error());
      if($result){
        $displayText = 1;
      }
    }



    if (isset($imagetmp)) {
      $result = mysql_query("UPDATE `account` SET `profilepicture` = '{$imagetmp}' WHERE `username` = '".$_SERVER['QUERY_STRING']."';")or die(mysql_error());
      if($result){
        $displayText = 1;
      }
    }

    if($displayText == 1) {  
      echo "<script>window.alert('you update data successfully')</script>";
      header("Location:index.php?successfully"); 
    }else{
      echo "<script>window.alert('Please insert atlist one new value to edit/update')</script>";     
    }
  }
?>
<?php
  $title = "Update user |";
  $AdminHome = "";
  $AdminAdd= "";
  $AdminUpdate = "active";
  $AdminRemove = "";
  $AdminSee = "";
  $AdminPost = "";

  if (isset($_SERVER['QUERY_STRING'])) {
    # code...
  }

  session_start();
  if (!isset($_SESSION['firstname'])) {
    header("Location:../../index.php");
  }
  if ($_SESSION['acct_type']!="Admin") {
    header("Location:../../index.php");
  }
  include_once "../../../pages/layout/admin/AdminNavs.php";
?>


        <!-- page content -->

          <div>
            <form Method = "post" name="registration"  enctype="multipart/form-data">
              <div class="col-md-3 col-sm-3"></div>
              <div class = " col-md-7 col-sm-7 col-xs-12">            
                <h3 align="center">Update <?php echo $_SERVER['QUERY_STRING']."'s";?> Information</h3>
                <label>personal Informations</label>
                <div class="form-inline">
                  <input  name="firstname" onFocus="onFocusF ()" onBlur="onBulrF ()" id="fname" type="text" class="form-control" placeholder="First Name"/>
                  <input  name="lastname" onFocus="onFocusL ()" onBlur="onBulrL ()"  id="lname" type="text" class="form-control" placeholder="Last Name" />
                </div><br>
                <div class="input-group">
                  <div class="input-group-addon">Birthday</div>
                  <input name = "birthday" type="Date" class="form-control" placeholder="Birthday"/><br>
                </div>
                <select name = "sex" class="form-control">
                  <option value = "">------- sex -----</option>
                  <option value = "Male">Male</option>
                  <option value = "Female">Female</option>                  
                </select>

                <div class="clearfix"></div>

                <div class="separator">
                  <label>Account Information</label>
                  <input onFocus="onFocuspass ()" onBlur="onBulrpass ()" name = "password" id="pass" type="password" class="form-control" placeholder="Password"/><br>
                  <input onFocus="onFocusrepass ()" onBlur="onBulrrepass ()" name = "repassword" id="repass" type="password" class="form-control" placeholder="Re-Password"/><br>
                  <select name = "acct_type" class="form-control">
                    <option value = "">------- choose Account type -----</option>
                    <option value = "Admin">Admin</option>          <option value = "Manager">Manager</option> 
                    <option value = "Driver">Driver</option>        <option value = "Department">Department</option>                  
                  </select><br>
                </div>
                <div class="clearfix"></div>

                
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
        <script src="../../class/js/form validation.js"></script>
        <!-- /page content -->
<?php
  include_once "../../../pages/layout/admin/AdminFoot.php";
?>

<script type="text/javascript">
  /*-------------  for Password fields -----------------------*/
    /*------ to validate first field ---------*/
pass_temp_value = "";
function onFocuspass () {
  pass_field=registration.password.value;
  if (pass_field=="Password is required"||pass_field=="it is too short") {
    document.getElementById("pass").value="";
    document.getElementById("pass").style.color = "black";
    document.getElementById("pass").style.fontWeight="normal";
    document.getElementById("pass").type="password";
    if (pass_temp_value!=""||pass_temp_value!=null) {
      document.getElementById("pass").value=pass_temp_value;    
    }   
  }
}
function onBulrpass (){
  pass_field=registration.password.value;
  if (pass_field.length<6) {
    pass_temp_value = registration.password.value;
    document.getElementById("pass").style.color="brown";
    document.getElementById("pass").style.fontWeight="bold";
    document.getElementById("pass").type="text";
    document.getElementById("pass").value="it is too short";
  }
}
    /*------ to validate second field ---------*/
repass_temp_value = "";
function onFocusrepass () {
  pass_field=registration.password.value;
  if (pass_field=="it is too short") {
    document.getElementById("repass").style.color="brown";
    document.getElementById("repass").style.fontWeight="bold";
    document.getElementById("repass").type="text";
    document.getElementById("repass").value="fill password first";
  } else {
    document.getElementById("repass").value="";
    document.getElementById("repass").style.color = "black";
    document.getElementById("repass").style.fontWeight="normal";
    document.getElementById("repass").type="password";
    if (repass_temp_value!=""||repass_temp_value!=null) {
      document.getElementById("repass").value=repass_temp_value;    
    }
  }
  
}
function onBulrrepass (){
  pass_field=registration.password.value;
  repass_field=registration.repassword.value;
  if (repass_field!=pass_field && repass_field!="fill password first") {
    repass_temp_value = registration.repassword.value;
    document.getElementById("repass").style.color="brown";
    document.getElementById("repass").style.fontWeight="bold";
    document.getElementById("repass").type="text";
    document.getElementById("repass").value="Make Both Password and Re-Password the same";    
  }else if (repass_field.length<6) {
    repass_temp_value = registration.repassword.value;
    document.getElementById("repass").style.color="brown";
    document.getElementById("repass").style.fontWeight="bold";
    document.getElementById("repass").type="text";
    document.getElementById("repass").value="it is too short";
  };            
}
</script>

