<!DOCTYPE html>
<?php
  session_start();
  if (isset($_SESSION['acct_type'])) {
    header("Location:../Class/PHP/check.php");
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    mysql_connect("localhost","root","");
    mysql_select_db("huvmts");

    $pass_field = $_POST['password'];
    $repass_field = MD5($_POST['password']);

    if ($pass_field=="Password is required"||$pass_field=="it is too short"||
      $repass_field=="Re-Password is required"||$repass_field=="it is too short"||
      $repass_field=="fill password first"||$repass_field=="Make Both Password and Re-Password the same") {
      echo '<script type="text/javascript">window.alert("'.'Please fill required Information first'.'");</script>';
    }else{
      if(mysql_query("UPDATE `account` SET `password` = '$repass_field' WHERE `username` = '".$_SESSION['username']."';")){
        echo '<script type="text/javascript">window.alert("'.'you reset your'.'");</script>';        
        header("Location:distSession.php");
      }else{
        echo "<script>window.alert('Please Enter correct username');</script>";
      }
    }
    mysql_close();
  }

  $title = "Recover password"; 
  include "../language/langsettings.php";
  $l=file_get_contents("../language/lang.tmp");
  include "../language/langue/$l.php";
  $x = '../language/lang.php?';
  $home = "";
  $About = "";
  $contact = "";
  $login = "";
?>

<?php
  include_once "layout/NavsBar.php";
?>

    <!-- Begin page content -->
    <div class="right_col" role="main">
      <div class="">
        
        <div class="row">
          <div class="col-md-12">
            <div class="x_panel">
              <section class="col-md-4 col-md-offset-4">
                <form name="registration" id="setpass"><br><br>
                  <h1 align="center">Set New password</h1>
                  <div class="separator">
                    <label></label><br>
                    <input onFocus="onFocuspass ()" onBlur="onBulrpass ()" name = "password" id="pass" type="password" class="form-control" placeholder="Password" required="" /><br>
                    <input onFocus="onFocusrepass ()" onBlur="onBulrrepass ()" name = "repassword" id="repass" type="password" class="form-control" placeholder="Re-Password" required="" /><br>
                  </div>
                    <div align="center">
                      <input  type = "submit" value="Reset" class = "btn btn-success" onclick="btn ()"/><br><br>
                    </div>
                </form>
              </section>
    
            </div>
          </div>
        </div>

        
      </div>
    </div>

<?php
  include_once "layout/footer.php";
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
  if(pass_field==""||pass_field==null){
    document.getElementById("pass").style.color="brown";
    document.getElementById("pass").style.fontWeight="bold";
    document.getElementById("pass").type="text";
    document.getElementById("pass").value="Password is required";
  } else if (pass_field.length<6) {
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
  if (pass_field==""||pass_field==null|| pass_field=="it is too short"||pass_field=="Password is required") {
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
  if(repass_field==""||repass_field==null){
    document.getElementById("repass").style.color="brown";
    document.getElementById("repass").style.fontWeight="bold";
    document.getElementById("repass").type="text";
    document.getElementById("repass").value="Re-Password is required";
  } else if (repass_field.length<6) {
    repass_temp_value = registration.repassword.value;
    document.getElementById("repass").style.color="brown";
    document.getElementById("repass").style.fontWeight="bold";
    document.getElementById("repass").type="text";
    document.getElementById("repass").value="it is too short";
  } else if (repass_field!=pass_field && repass_field!="fill password first") {
    repass_temp_value = registration.repassword.value;
    document.getElementById("repass").style.color="brown";
    document.getElementById("repass").style.fontWeight="bold";
    document.getElementById("repass").type="text";
    document.getElementById("repass").value="Make Both Password and Re-Password the same";    
  };            
}

function btn () {
  pass_field=registration.password.value;
  repass_field=registration.repassword.value;
  if (pass_field=="Password is required"||pass_field=="it is too short"||
    repass_field=="Re-Password is required"||repass_field=="it is too short"||
    repass_field=="fill password first"||repass_field=="Make Both Password and Re-Password the same") {
    window.alert('Please fill password first');
    $_SESSION['query'] = "";
  }else{
    document.getElementById("setpass").method="POST";
  }
}
</script>