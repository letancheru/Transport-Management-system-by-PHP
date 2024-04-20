<!DOCTYPE html>
<?php
  $title = "Add Post |";
  $AdminHome = "";
  $AdminAdd= "";
  $AdminUpdate = "";
  $AdminRemove = "";
  $AdminSee = "";
  $AdminPost = "active";
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
  include '../../../Class/PHP/AdminPost.php';
?>


        <!-- page content -->

          <div>
            
            <form name="post" id="post" action="" enctype="multipart/form-data">
              <div class="col-md-3 col-sm-3"></div>
              <div class = " col-md-7 col-sm-7 col-xs-12"> 
                <h1 align="center">Add post</h1>           
                <div class="separator">
                  <div class="input-group">
                    <div class="input-group-addon">Subject</div>
                    <input onFocus="onFocussb ()" onBlur="onBulrsb ()"  name="subject"   id="subject" type="text" class="form-control" placeholder="Subject" required="" /><br>
                  </div>
                  <label>Content of post</label>
                  <div class="form-group">
                    <textarea onFocus="onFocuscnt ()" onBlur="onBulrcnt ()" name="content" class="form-control" id="cont" rows="3" placeholder="content" required=""></textarea>
                  </div>
                </div>
                <div class="separator clearfix"></div>
                <div class="form-group">
                    <label for="exampleInputFile">Select photo</label>
                    <input  onFocus="onFocusp ()" onBlur="onBulrp ()"  type="file" class="form-control-file" id="content" name="photo" required="">
                    <small id="fileHelp" class="form-text text-muted">Include cover photo of post(it is optional)</small>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon">Account Type</div>
                    <select onFocus="onFocusacc ()" onBlur="onBulracc ()" id = "acct_type" name = "acct_type" class="form-control" required="">
                      <option value = "">------- post this to -----</option>
                      <option value = "Admin">Admin</option>          <option value = "Manager">Manager</option>     
                      <option value = "Driver">Driver</option>        <option value = "Department">Department</option> 
                      <option value = "Public">Public</option>                          
                    </select><br>
                  </div>
                </div>

                <div class="separator clearfix"></div> 

                <div class = "col-md-3 col-md-offset-4 col-sm-3 col-sm-offset-4 col-xs-3 col-xs-offset-4">
                  <input onclick="chech ()" type = "submit" value="Add post" class = "btn btn-success"  />
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

<script type="text/javascript">
  subjects = 0;
  acctype = 0;
  function onFocussb () {
  subject_field=post.subject.value;
    if (subject_field=="Subject is required"||subject_field=="should be character") {
      document.getElementById("subject").value="";
      document.getElementById("subject").style.color = "black";
      document.getElementById("subject").style.fontWeight="normal";
      subjects = 0;
    }
  }
  function onBulrsb () {
    x=post.subject.value;
    subjects = 0;
    if(x==""||x==null){
      document.getElementById("subject").style.color="brown";
      document.getElementById("subject").style.fontWeight="bold";
      document.getElementById("subject").value="Subject is required";
      subjects = 1;
    }
  }
  function onFocusacc () {
  subject_field=post.acct_type.value;
      document.getElementById("acct_type").value="";
      document.getElementById("acct_type").style.color = "black";
      document.getElementById("acct_type").style.fontWeight="normal";
      acctype = 0;
  }
  function onBulracc () {
    x=post.acct_type.value;
    acctype = 0;
    if(x==""||x==null){
      document.getElementById("acct_type").style.color="brown";
      document.getElementById("acct_type").style.fontWeight="bold";
      acctype = 1;
    }
  }

  function chech () {
    if (acctype == 1 || subjects == 1) {
      window.alert('Please Fill all required information!');
    }else{
      document.getElementById('post').method = "POST";
    }
  }
</script>