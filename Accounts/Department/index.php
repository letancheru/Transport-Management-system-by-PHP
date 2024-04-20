<!DOCTYPE html>
<?php
  $title = "Home";
  $DepartmentHome = "active";
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
  $imageIndex = 0;
?>
         <!-- Begin page content -->
        <div class="right_col" role="main">
          <div class="">            

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                      <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <?php                  
                          mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());     
                          mysql_select_db("huvmts") or die(mysql_error());
                          $raw_results = mysql_query("SELECT * FROM `post` WHERE `acct_type` LIKE 'Public' ORDER BY Time DESC") or die(mysql_error());
                          while($results = mysql_fetch_array($raw_results)){
                            $image[$imageIndex] = $results['image'];
                            $imageSubject[$imageIndex] = $results['Subject'];
                            $imageIndex++;
                          }
                        ?>

                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                          <?php for ($i=0; $i < $imageIndex; $i++) {
                            if ($i==0) {
                              $classAct = "active";
                            }else{
                              $classAct = "";
                            }
                          ?>
                            <li data-target="#myCarousel" data-slide-to="<?php echo $i;?>" class="<?php echo $classAct;?>"></li>;
                          <?php
                            }
                          ?>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                          <?php for ($i=0; $i < $imageIndex; $i++) {
                            if ($i==0) {
                              $classAct = "active";
                            }else{
                              $classAct = "";
                            }?>
                            <div class="item <?php echo $classAct;?>">
                              <img  src="<?php echo 'data:image/jpeg;base64,'.base64_encode( $image[$i] ).'" alt="Los Angeles';?>" style="height:200px; width:100%;">
                              <div class="carousel-caption">
                                <h3><?php echo $imageSubject[$i];?></h3>
                              </div>
                            </div>
                            <?php
                            }
                          ?>
                          
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                          <br><br><br>
                          <span class="fa fa-chevron-left"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                          <br><br><br>
                          <span class="fa fa-chevron-right"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-9">
                <div class="x_panel">
                    <div class="row">
                      <div class="col-md-offset-1 col-md-10">
                        <div class=" bs-callout bs-callout-warning" id="callout-glyphicons-accessibility">
                          <div  style="text-align: justify;font-size: 20px; color: black;" class="column column-double column-content single"> 
                               
                            <h1 style="color:  #100c4a; font-size: 35px;">Well Come To Haramaya University Transportation Department Dashboard!</h1>       
                            <p>Transportation is a process of moving people and objects from one place to other places. It has different type of transportation such as air transport through the air, water transport trough lakes, rivers, seas or oceans and land transport trough the land spaces.The vehicle tracking system is an electronic device that tracks the vehicle’s location. Most of the tracking systems use the Global Positioning System GPS module to locate vehicles position. Many systems also combine communication components such as satellite transmitters to communicate the vehicle’s locate\on to the remote user. Google maps are used to view vehicles' location.<br>
                            Haramaya university have its own transportation process that give service for its employees and used for other requirements that comes from department. This document is describe how to change this manual system to computerized transportation system.
                            <div>
                              <h3>Role of Department</h3>
                              <ul>
                                <li>Send vehicle request for destributer employee manager in ordr to get service.</li>
                                <li>update his/her information</li>
                                <li>send and recieve message as a feedbak or for smooth communication</li>
                                <li>view notification since destributer employee manager replay the request.</li>
                              </ul>
                            </div></p>
                            <img class="col-md-12 col-sm-12 col-xs-12" style="max-width: 920px;height: 500px;" src="../../asset/car.jpg">
                            <p class="postmetadata"></p>                                    
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="x_panel">                        
                       <h4 style="font-size: 30px; color: blue;">Time:</h4>
              <script src="../../class/js/time.js" language="javascript" type="text/javascript"></script>
              <body  onLoad="yourClock()", onUnload="stopClock(); return true"> 
                 <form name="the_clock">
               <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr align="left"><td> <strong style="font-size: 25px;"> System Time:</strong>&nbsp;&nbsp;<input type="textt" name="the_time" size="30" style="padding-bottom:10px;" align = "top"></a></td></tr>
              <tr align="left"><td><br/></td></tr></body>
                      </table>
                   </form>
                </div>
                <div class="x_panel">                        
                        <img style="width: 340px; height: 300px;" src="../../asset/leta.jpg">
                </div>
                <div class="x_panel">                        
                        <h4 style="font-size: 30px; color: blue;">Calender:</h4>
    <script src="../../class/js/calander.js" language="jav<ascript" type="text/javascript"></script> 
                </div>
                <div class="x_panel">                        
                        <img style="width: 340px; height: 300px;" src="../../asset/images.jpg">
                </div>
              </div>

            </div>

            
          </div>
        </div>

        <!-- /page content -->
<?php
  include_once "../../pages/layout/Department/DepartmentFoot.php";
?>