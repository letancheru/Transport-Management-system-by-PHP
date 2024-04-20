<!DOCTYPE html>
<?php
  session_start();
  if (isset($_SESSION['acct_type'])) {
    header("Location:../Class/PHP/check.php");
  }
  $title = "About"; 
  include "../language/langsettings.php";
  $l=file_get_contents("../language/lang.tmp");
  include "../language/langue/$l.php";
  $x = '../language/lang.php?';
  $home = "";
  $about = "active";
  $contact = "";
  $login = "";
  $post="";
?>

<?php
  include_once "layout/NavsBar.php";
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
                            <h1>Historys Of Haramaya University</h1>       
                            <p>Haramaya University has gone through a series of transformations since its establishment as a higher learning institution. The agreement signed between the Imperial Ethiopian Government and the Government of the United States of America on May 15, 1952 laid the foundations for the establishment of Jimma Agricultural and Technical School and the Imperial College of Agricultural and Mechanical Arts (IECAMA). The Agreement between the Government of Ethiopia and the Technical Cooperation Administration of the Government of the United States of America, signed on May 16, 1952, gave the mandate to Oklahoma State University to establish and operate the College, conduct a nationwide system of Agricultural Extension and set up an agricultural research and experimental station.Based on the Emperor’s wish, it was decided to establish the College at its current location at Haramaya. Later on, the agreement signed between the United States Department of States and the Imperial Government provided the basis for the operation of Jimma Agricultural and Technical School that received its first class of eighty students in October 1952. Out of this numbers, nineteen of them graduated on August 6, 1953 and became the first freshman students of the Imperial Ethiopian College of Agricultural and Mechanical Arts (IECAMA). The IECAMA opened its doors to its first batch of students in October 1956 and the senior class moved from Addis Ababa to Alemaya for their final semester. At the end of the 1956/57 academic year, eleven students completed their studies and graduated with a B.Sc. degree in General Agriculture. The training programs in Agriculture were further specialized and B.Sc. programs were introduced in Animal Sciences (1960), Plant Sciences (1960), Agricultural Engineering (1961) and Agricultural Economics (1962).<br>
                            Until 1963, the college was virtually dependent on Oklahoma State University, both administratively and academically; however, after 1966, when the first Ethiopian dean was appointed, the role of Americans was limited to advisory and technical support. The College became a chartered member of Addis Ababa University (the then Haile Selassie I University), following the contractual termination of Oklahoma State University in 1968. Consequently, it was named Alemaya College of Agriculture. Due to the great need of trained manpower in other areas of study, additional programs that included a diploma program in Home Economics (1967), Science Teachers’ Training Program (1978), and Continuing Education Program (1980), were launched.</p>
                            <p>A major landmark in the history of the College of Agriculture was the launching of graduate study programs in the 1979/80 academic year. This laid down the foundation for advanced academic and research work at the institution. When graduate studies were launched, about 29 students were enrolled to study various fields of agriculture.</p>
                            
                            <p>Currently, Haramaya University is functioning on three campus premises in different regions; Haramaya Campus, Harar campus and Chiro Campus.</p>
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
              <script src="../class/js/time.js" language="javascript" type="text/javascript"></script>
              <body  onLoad="yourClock()", onUnload="stopClock(); return true"> 
                 <form name="the_clock">
               <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr align="left"><td> <strong style="font-size: 25px;"> System Time:</strong>&nbsp;&nbsp;<input type="textt" name="the_time" size="30" style="padding-bottom:10px;" align = "top"></a></td></tr>
              <tr align="left"><td><br/></td></tr></body>
                      </table>
                   </form>
                </div>
                <div class="x_panel">                        
                        <img style="width: 340px; height: 300px;" src="../asset/leta.jpg">
                </div>
                <div class="x_panel">                        
                        <h4 style="font-size: 30px; color: blue;">Calender:</h4>
    <script src="../class/js/calander.js" language="jav<ascript" type="text/javascript"></script> 
                </div>
                <div class="x_panel">                        
                        <img style="width: 340px; height: 300px;" src="../asset/images.jpg">
                </div>
              </div>

            </div>

            
          </div>
        </div>

<?php
  include_once "layout/footer.php";
?>
