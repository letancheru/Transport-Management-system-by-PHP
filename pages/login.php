<!DOCTYPE html>
<?php
session_start();
  $title = "Login"; 
  include "../language/langsettings.php";
  $l=file_get_contents("../language/lang.tmp");
  include "../language/langue/$l.php";
  $x = '../language/lang.php?';
  $home = "";
  $about = "";
  $contact = "";
  $login = "active";
  $post="";
?>

<?php
  include_once "layout/NavsBar.php";
?>
 <?php
        include "../Class/PHP/toLogin.php";
      ?>

    <!-- Begin page content -->
    <div class="right_col" role="main">
     
      <div class="">
        
        <div class="row">
          <div class="col-md-12">
            <div  class="x_panel">


              <section style="background-image: url(../asset/A.jpg);"class="col-md-4 col-md-offset-4">
                <form Method = "post" name="Login">            
                    <h1 style="font-size: 50px;color: #ff8000; text-decoration: bold;" align="center"><?php echo $TEXT['Login-Form'];?></h1>
                    <div style="font-size: 20px;" class="separator">
                      <input  onFocus="onFocusun ()" onBlur="onBulrun ()"  name="username"   id="uname" type="text" class="form-control" placeholder="<?php echo $TEXT['username'];?>" required="" /><br>
                      <input onFocus="onFocuspass ()" onBlur="onBulrpass ()" name = "password" id="pass" type="password" class="form-control" placeholder="<?php echo $TEXT['password'];?>" required="" /><br>
                      <br>
                    </div>
                    <div class="clearfix"></div>
                    <div align="center">
                      <input type = "submit" value="<?php echo $TEXT['Login-btn'];?>" class = "btn btn-success" /><br>
                      <a class="reset_pass" href="/huvmts/pages/rocoverPass.php"><strong style="font-size: 19px; color: #ffffff;"><?php echo $TEXT['revery-link'];?></strong></a>
                    </div>

                    <div class="clearfix"></div>
                    <div class="separator">

                      <div class="clearfix"></div>
                      <br />

                      <div align = "center">
                        <h2 style="color: #ffffff;">
                          <img src="/huvmts/asset/logo.jpg" alt="..." class="img-circle" width="45px">
                          <?php echo $TEXT['head-system-name'];?>
                        </h2>
                      </div>
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
    