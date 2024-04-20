<!DOCTYPE html>

<?php
  session_start();
  if (isset($_SESSION['acct_type'])) {
    header("Location:../Class/PHP/check.php");
  }
  $title = "Home page"; 
  include "language/langsettings.php";
  $l=file_get_contents("language/lang.tmp");
  include "language/langue/$l.php";
  $x = 'language/lang.php?';
  $home = "active";
  $about = "";
  $contact = "";
  $login = "";
  $post="";
?>

<?php
  include_once "pages/layout/NavsBar.php";
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
                            <h1 style="color: #16144f">Backgrounds Of Haramaya University Transportation Office</h1>       
                            Haramaya University is one of the oldest universities in Ethiopia. It is now functioning on two campus premises. The main campus, where the first milestone was laid, is Haramaya Campus. This campus is located at about 510 km East of Addis Ababa, in Haramaya town, at Bate Kebele. It is located 5 km from Haramaya, a town in the East Hararghe Zone, about 17 kilometers from the city of Harar and 40 kilometers from Dire Dawa. Haramaya university have its own transportation process that give service for its employees and used for other requirements that comes from department.</p>
                            
                            <p>Currently, Haramaya University is functioning on three campus premises in different regions; Haramaya Campus, Harar campus and Chiro Campus.</p>
                            This system also include <strong> haramaya university vehicle tracking system </strong>that is an electronic device that tracks the vehicle’s location. Most of the tracking systems use the Global Positioning System GPS module to locate vehicles position. Many systems also combine communication components such as satellite transmitters to communicate the vehicle’s locate\on to the remote user. Google maps are used to view vehicles' location.
                            <div >
                           <div style="">
                            <img class="col-md-12 col-sm-12 col-xs-12" style="max-width: 920px;height: 500px;" src="asset/uuu.jpg">
                             
                           </div>
                           </div>
      </p>
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
              <script src="Class/js/time.js" language="javascript" type="text/javascript"></script>
              <body  onLoad="yourClock()", onUnload="stopClock(); return true"> 
                 <form name="the_clock">
               <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr align="left"><td> <strong style="font-size: 25px;"> System Time:</strong>&nbsp;&nbsp;<input type="textt" name="the_time" size="30" style="padding-bottom:10px;" align = "top"></a></td></tr>
              <tr align="left"><td><br/></td></tr></body>
                      </table>
                   </form>
                </div>
                <div class="x_panel">                        
                        <img style="max-width: 340px; height: 300px;" src="asset/leta.jpg">
                </div>
                <div class="x_panel">                        
                        <h4 style="font-size: 30px; color: blue;">Calender:</h4>
    <script src="Class/js/calander.js" language="jav<ascript" type="text/javascript"></script> 
                </div>
                <div class="x_panel">                        
                        <img style="max-width: 340px; height: 300px;" src="asset/images.jpg">
                </div>
              </div>

            </div>

            
          </div>
        </div>

<?php
  include_once "pages/layout/footer.php";
?>
