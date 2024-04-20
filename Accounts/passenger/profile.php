<!DOCTYPE html>
<?php
  $title = "profile |";
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
  include_once "../../pages/layout/passenger/passengerNavs.php";
?>
        <!-- page content -->
        
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>profile</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->

                          <?php echo '<img class="img-responsive avatar-view" src="data:image/jpeg;base64,'.base64_encode( $_SESSION['profilepicture'] ).'"/>'?>
                        </div>
                      </div>
                      <h3><?php echo $_SESSION['username'];?></h3>

                      <ul class="list-unstyled user_data">
                        <li> 
                        </li><?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $_SESSION['acct_type'];?>
                        </li>

                      </ul>

                      <a href="edit profile.php" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
                      <br>

                    </div>


                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <!-- start skills -->
                      <h4>Information</h4>
                      <ul class="list-unstyled user_data">
                        <li>
                          <p><strong>Name : </strong> <?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?></p>
                        </li>
                        <li>
                          <p><strong>birthday : </strong> <?php echo $_SESSION['birthday'];?></p>
                        </li>
                        <li>
                          <p><strong>Sex : </strong> <?php echo $_SESSION['sex']?></p>
                        </li>
                        <li>
                          <p><strong>Acct_type : </strong> <?php echo $_SESSION['acct_type'];?></p>
                        </li>
                        <li>
                          <p><strong>Password recovery question : </strong> what is your <?php echo $_SESSION['recovery_question'];?>?</p>
                        </li>
                        <li>
                          <p><strong>Answer : </strong> MY <?php echo $_SESSION['recovery_question'];?> is <?php echo $_SESSION['recovery_answer'];?></p>
                        </li>
                        
                      </ul>
                      <!-- end of skills -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php
  include_once "../../pages/layout/passenger/PassengerFoot.php";
?>