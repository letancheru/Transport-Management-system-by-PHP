<!DOCTYPE html>
<?php
  $title = "Help |";
  $AdminHome = "";
  $AdminAdd= "";
  $AdminUpdate = "";
  $AdminRemove = "";
  $AdminSee = "";
  $AdminPost = "";
  $vehicle="";
  $driver="";
  $passenger="";
  
  session_start();
  if (!isset($_SESSION['firstname'])) {
    header("Location:../../index.php");
  }
  if ($_SESSION['acct_type']!="Admin") {
    header("Location:../../index.php");
  }
  include_once "../../pages/layout/admin/AdminNavs.php";
?>
          <!-- page content -->
        
          <div class="">  
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Every pages in Admin</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-4">
                        <img src="help/dropdown.png">
                      </div>
                      <div class="col-md-8">
                        <h3>dropdown</h3>
                        <p>it is located at right haund top cornner.</p>
                        <p><strong>profile</strong> : will take user to his or her profile to see it.</p>
                        
                        <p><strong>setting</strong> : takes user to page user edit their account</p>
                        
                        <p><strong>Help user</strong> : takes user help desk</p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4">
                        <img style="margin-top:10px" src="help/search.jpg">
                      </div>
                      <div class="col-md-8">
                        <h3>Search</h3>
                        <p>help admistrator to search for account and for post to edit/update or remove/delete</p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4">
                        <img src="help/home.png">
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
                        <img  src="help/home.png">
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
                    <h2>Add user</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">
                      <div class="col-md-4">
                        <img  src="help/add_user.png">
                      </div>
                      <div class="col-md-8">
                        <h3>user registration</h3>
                        <p>This page requires all nessaccery information that is needed to create user account. once users is registered they 
                          have all right to use system base role they are assigned (account type)</p>
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
                    <h2>update user</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">
                      <div class="col-md-4">
                        <img  src="help/update.png">
                      </div>
                      <div class="col-md-8">
                        <h3>Update user Information</h3>
                        <p>Once user information is insereted it maight it need updation</p>
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
                    <h2>Remove user</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">
                      <div class="col-md-4">
                        <img src="help/remove.png">
                      </div>
                      <div class="col-md-8">
                        <h3>Deactivate user account</h3>
                        <p>Remove user of anccount to stop using account now on bt pressing red label exist at right haund side</p>
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
                    <h2>See All user</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">
                      <div class="col-md-4">
                        <img width="100%" src="help/see user.png">
                      </div>
                      <div class="col-md-8">
                        <h3>user managment</h3>
                        <p>this page have muliple functionality this will help the page to remove, update and display the page. 
                          we can simply remove account by pressing red button. Edit and update acount by pressing green button</p>
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
                    <h2>Add post</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">
                      <div class="col-md-4">
                        <img width="100%" src="help/post.png">
                      </div>
                      <div class="col-md-8">
                        <h3>creating new post</h3>
                        <p>this page allow admin to create post on the diffirent account including public</p>
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
                    <h2>See post</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">
                      <div class="col-md-4">
                        <img width="100%" src="help/post.png">
                      </div>
                      <div class="col-md-8">
                        <h3>post managment</h3>
                        <p>this page have mulitple functionality this will help the page to remove, update and display the page. 
                          we can simply remove post by pressing red button. Edit and update acount by pressing green button</p>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>
        <!-- /page content -->
<?php
  include_once "../../pages/layout/admin/AdminFoot.php";
?>