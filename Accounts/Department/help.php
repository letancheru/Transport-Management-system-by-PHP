<!DOCTYPE html>
<?php
  $title = "Help";
  $DepartmentHome = "";
  $DepartmentInbox= "";
  $DepartmentSend = "";
  $post="";
  
  session_start();
  if (!isset($_SESSION['firstname'])) {
    header("Location:../../index.php");
  }
  if ($_SESSION['acct_type']!="Department") {
    header("Location:../../index.php");
  }
  include_once "../../pages/layout/Department/DepartmentNavs.php";
?>
          <!-- page content -->
        <div class="right_col" role="main">
          <div name="print" id="print" class="">  
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Every pages department</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-4">
                        <img src="help/drop.png">
                      </div>
                      <div class="col-md-8">
                        <h3>dropdown</h3>
                        <p>it is located at right haund top cornner.</p>
                        <p><strong>profile</strong> : will take user to his or her profile to see it.</p>
                        
                        <p><strong>setting</strong> : takes user to page user edit their account</p>
                        
                        <p><strong>Help user</strong> : takes user help desk</p>
                      </div>
                    </div><br><br>

                    


                    <div class="row">
                      <div class="col-md-4">
                        <img src="help/nav.png">
                      </div>
                      <div class="col-md-8">
                        <h3>nav bar</h3>
                        <p>The picture located at the top is logo we used to reprent our system or the office and <strong>HUVMTS</strong> accoroundium that stands for 
                          <strong>H</strong>aramaya <strong>U</strong>niversity <strong>V</strong>ehicle <strong>M</strong>anagment and <strong>T</strong>racking <strong>S</strong>ytem.</p>
                          <p>Second picture is Image that reprent the user of an account. The text find next to picture is name of the user with greating of welcome
                            and text foud right blow the picture is Role of user.</p>
                          <p>All other texts are link that take user to the pages the text represent.</p>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>  


            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Home</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">
                      <div class="col-md-4">
                        <img width="100%" src="help/home.png">
                      </div>
                      <div class="col-md-8">
                        <h3>Home</h3>
                        <p>Home page is first page that displayed when one user logged into his/her account. The page contains the page that
                          is being posted on by adminstrator.</p>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>  


            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Prepare Message</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">
                      <div class="col-md-4">
                        <img width="100%" src="help/outbox1.png">
                      </div>
                      <div class="col-md-8">
                        <h3>form to send message</h3>
                        <p>this page will help department to send message to other department and manager</p>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>  



            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Out box messages</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">
                      <div class="col-md-4">
                        <img width="100%" src="help/outbox1.png">
                      </div>
                      <div class="col-md-8">
                        <h3>list od message and content displayed to be seen</h3>
                        <p>This ia a place whe we see list of meassage that we are sent to the people around. in other ware this is
                         place where we see message that is being prepared by prepare message page</p>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>



            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>send request</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">
                      <div class="col-md-4">
                        <img width="100%" src="help/outbox1.png">
                      </div>
                      <div class="col-md-8">
                        <h3>Sending request for vehicle </h3>
                        <p>This is a form by which the department send request for vehicle by including type of vehicle they require 
                          start and end date of their vacation or journey as well as Destination</p>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Sented Request</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">
                      <div class="col-md-4">
                        <img width="100%" src="help/outbox1.png">
                      </div>
                      <div class="col-md-8">
                        <h3>all Requests requestes prepared by</h3>
                        <p>The department maight request for vehicle in diffrent time and all that requests are 
                          listed on this page as list on onside of the page and contrnt on other side of page</p>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>



            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Report</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">
                      <div class="col-md-4">
                        <img width="100%" src="help/outbox1.png">
                      </div>
                      <div class="col-md-8">
                        <h3>Discribes all about the usage of and access for the vehicle</h3>
                        <p>this will gave good analysis for the department about the request</p>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>



            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Notification</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">
                      <div class="col-md-4">
                        <img width="100%" src="help/outbox1.png">
                      </div>
                      <div class="col-md-8">
                        <h3>The alert will be shown to the Department</h3>
                        <p>once the departmnet requested the the office for the vehicle they wait untile they notify the
                          department the vehicle is assigne</p>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <input type="submit" value="print this page" class="btn btn-danger col-md-offset-9" onclick="prints ('print')"/>
        </div>
        <!-- /page content -->
<?php
  include_once "../../pages/layout/Department/DepartmentFoot.php";
?>


                    
<script type="text/javascript">
  function prints (e) {
    var res = document.body.innerHTML;
    var prt = document.getElementById(e).innerHTML;

    document.body.innerHTML = prt;
    window.print();
    document.body.innerHTML = res;
  }
</script>