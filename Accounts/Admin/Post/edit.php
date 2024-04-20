<!DOCTYPE html>
<?php
  $title = "Update Post |";
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
?>


        <!-- page content -->

          <div>
            
            <form method="POST" action="" enctype="multipart/form-data">
              <div class="col-md-3 col-sm-3"></div>
              <div class = " col-md-7 col-sm-7 col-xs-12"> 
                <h1 align="center">Update/edit post</h1>           
                <div class="separator">
                  <p><small>atlist fill one to update</small></p>
                  <label>Account Information</label>
                  <input onFocus="onFocussb ()" onBlur="onBulrsb ()"  name="subject"   id="subject" type="text" class="form-control" placeholder="Subject" /><br>
                  <div class="form-group">
                    <textarea name="content" class="form-control" id="exampleTextarea" rows="3" placeholder="content"></textarea>
                  </div>
                </div>
                <div class="separator clearfix"></div>
                <div class="form-group">
                    <label for="exampleInputFile">Select photo</label>
                    <input type="file" class="form-control-file" id="content" name="photo">
                    <small id="fileHelp" class="form-text text-muted">Include cover photo of post(it is optional)</small>
                </div>
                <div class="form-group">
                  <select name = "acct_type" class="form-control">
                    <option value = "">------- post this to -----</option>
                    <option value = "Admin">Admin</option>          <option value = "Manager">Manager</option> 
                    <option value = "Employee">Employee</option>    <option value = "Mechanic">Mechanic</option> 
                    <option value = "Driver">Driver</option>        <option value = "Department">Department</option> 
                    <option value = "Public">Public</option>                          
                  </select><br>
                </div>

                <div class="separator clearfix"></div> 

                <div class = "col-md-3 col-md-offset-4 col-sm-3 col-sm-offset-4 col-xs-3 col-xs-offset-4">
                  <input type = "submit" value="Edit post" class = "btn btn-success"  />
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

<?php
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$id = $_SERVER['QUERY_STRING'];
		$subject = $_POST['subject'];
		$content = $_POST['content'];
		$imagetmp = addslashes (file_get_contents($_FILES['photo']['tmp_name']));
		$acct_type = $_POST['acct_type'];



		mysql_connect("localhost","root","");
		mysql_select_db("huvmts");

		$checker = 0;
		if ($subject!=""||$subject!=null) {
			if (mysql_query("UPDATE `post` SET `Subject` = '$subject' WHERE `post`.`ID` = $id")){
				$checker = 1;
			}
		}elseif ($content!=""||$content!=null) {
			if (mysql_query("UPDATE `post` SET `Content` = '$content' WHERE `post`.`ID` = $id")){
				$checker = 1;
			}
		}elseif ($imagetmp!=""||$imagetmp!=null) {
			if (mysql_query("UPDATE `post` SET `image` = '{$imagetmp}' WHERE `post`.`ID` = $id")){
				$checker = 1;
			}
		}elseif ($imagetmp!=""||$imagetmp!=null) {
			if (mysql_query("UPDATE `post` SET `acct_type` = '$acct_type' WHERE `post`.`ID` = $id")){
				$checker = 1;
			}
		}

		if ($checker!=0) {
			echo "<script>window.alert('you Update successfully')</script>";
		}

	}
?>
