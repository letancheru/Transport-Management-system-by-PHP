<!DOCTYPE html>
<?php
  $title = "Home";
  $securityHome = "active";
  $notification= "";
 

  session_start();
  if (!isset($_SESSION['firstname'])) {
    header("Location:../../index.php");
  }
  if ($_SESSION['acct_type']!="Security") {
    header("Location:../../index.php");
  }

 
  include_once "../../../pages/layout/security/securityNavs.php";
?>
        <!-- page content -->
          <div class="right_col">
            <div class="row">

                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Send Message</h2>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <div id="alerts"></div>
                        <form Method="post" name="mssg" data-parsley-validate="" class="form-horizontal form-label-left">

                          <div class="form-group">
                            <div class="col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6 col-xs-12">
                              <div class="input-group">
                                <div class="input-group-addon">To : </div>
                                <input onBlur = "reciverB ()" onFocus = "reciverF ()" name = "reciever" id = "reciever" type="text" class="form-control" placeholder="Reciver username" required="" /><br>
                              </div>                              
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6 col-xs-12">
                              <div class="input-group">
                                <div class="input-group-addon">Subject : </div>
                                <input  onBlur = "SubjectB ()" onFocus = "SubjectF ()" type="text" name = "Subject" id = "Subject" placeholder = "subject of letter" class="form-control" required="" >
                              </div>                              
                            </div>
                          </div>
                          <div class="x_content">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              <textarea name="message" class="col-md-12 col-sm-12 col-xs-12 editor-wrapper placeholderText"></textarea>
                              <div class="ln_solid"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-5">
                              <button type="submit" class="btn btn-success">Send</button>
                            </div>
                          </div>

                        </form>                        
                
                      </div>
                    </div>
                  </div>
                <!-- /compose -->
            </div>
            
          </div>
        </div>
        <!-- /page content -->
<?php
  include_once "../../../pages/layout/security/securityFoot.php";
  include '../../../Class/PHP/SendMessage.php';
?>
<script src="../../../class/js/sendMessage.js"></script>