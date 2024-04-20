<!DOCTYPE html>
<?php
  session_start();
  if (isset($_SESSION['acct_type'])) {
    header("Location:../Class/PHP/check.php");
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    mysql_connect("localhost","root","");
    mysql_select_db("huvmts");

    $username = $_POST['username'];
    $passQ_field = $_POST['PassQestion'];
    $passA_field = $_POST['pasA'];
    if ($passQ_field == ""||$passA_field =="password answer is required") {
      echo '<script type="text/javascript">window.alert("'.'Please fill required Information first'.'");</script>';
    }else{
      $Query = mysql_query("SELECT * FROM Account WHERE (`username` = '$username') AND (`recovery_question` = '$passQ_field')")or die(mysql_error());
      if(mysql_num_rows($Query) == 1){
        $results = mysql_fetch_array($Query);
        $_SESSION['username'] = $results['username'];
        if ($passA_field == $results['recovery_answer']) {
          header("Location:setpass.php");
        }

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
                <form Method = "post" name="registration"><br><br>
                  <h1 align="center">Recover password</h1>
                    <div class="separator">
                      <label></label><br>
                      <input onFocus="onFocusun ()" onBlur="onBulrun ()"  name="username"   id="uname" type="text" class="form-control" placeholder="<?php echo $TEXT['username'];?>" required="" /><br>
                      <select name = "PassQestion" class="form-control">
                        <option value = "">---- <?php echo $TEXT['password-question'];?> ----</option>
                        <option value = "mothers name"><?php echo $TEXT['mom'];?></option>
                        <option value = "Hometown"><?php echo $TEXT['town'];?></option>
                        <option value = "Favorite Food"><?php echo $TEXT['food'];?></option>
                        <option value = "First child name"><?php echo $TEXT['child'];?></option>
                      </select><br>
                      <input onFocus="onFocuspa ()" onBlur="onBulrpa ()" name="pasA" id="pasA" type="text" class="form-control" placeholder="<?php echo $TEXT['password-answer'];?>" required="" /><br>
                    </div>
                    <div align="center">
                      <input type = "submit" value="<?php echo $TEXT['enter-btn'];?>" class = "btn btn-success"  onclick="btn ()"/><br><br>
                      <a class="" href="/huvmts/pages/login.php"><?php echo $TEXT['Login-link'];?>?</a>
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
/*-------------      for username        ------------------*/
username_temp_value = "";
function onFocusun () {
  username_field=registration.username.value;
  if (username_field=="username is required"||username_field=="it is too short") {
    document.getElementById("uname").value="";
    document.getElementById("uname").style.color = "black";
    document.getElementById("uname").style.fontWeight="normal";
    if (username_temp_value!=""||username_temp_value!=null) {
      document.getElementById("uname").value=username_temp_value;   
    }
  }
}
function onBulrun (){
  x=registration.username.value;
  if(x==""||x==null){
    document.getElementById("uname").style.color="brown";
    document.getElementById("uname").style.fontWeight="bold";
    document.getElementById("uname").value="username is required";
  } 
}
/*--------------          paswor answer    ---------------------------*/
username_temp_value = "";
function onFocuspa () {
  username_field=registration.pasA.value;
  if (username_field=="password answer is required"||username_field=="it is too short") {
    document.getElementById("pasA").value="";
    document.getElementById("pasA").style.color = "black";
    document.getElementById("pasA").style.fontWeight="normal";
    if (username_temp_value!=""||username_temp_value!=null) {
      document.getElementById("pasA").value=username_temp_value;   
    }
  }
}
function onBulrpa (){
  x=registration.pasA.value;
  if(x==""||x==null){
    document.getElementById("pasA").style.color="brown";
    document.getElementById("pasA").style.fontWeight="bold";
    document.getElementById("pasA").value="password answer is required";
  } 
}

</script>

