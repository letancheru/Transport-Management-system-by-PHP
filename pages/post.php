<!DOCTYPE html>
<?php
  session_start();
  if (isset($_SESSION['acct_type'])) {
    header("Location:../Class/PHP/check.php");
  }
  $title = "Contact"; 
  include "../language/langsettings.php";
  $l=file_get_contents("../language/lang.tmp");
  include "../language/langue/$l.php";
  $x = '../language/lang.php?';
  $home = "";
  $about = "";
  $contact = "";
  $login = "";
  $post="active";
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
                


                <?php                  
                  mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());     
                  mysql_select_db("huvmts") or die(mysql_error());
                  $raw_results = mysql_query("SELECT * FROM `post` WHERE `acct_type` LIKE 'Public' ORDER BY Time DESC") or die(mysql_error());
                  while($results = mysql_fetch_array($raw_results)){
                ?>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="x_panel">
                        <div class="row">
                          <div class="col-md-5">
                            <?php 
                              echo '<img class="img-thumbnail img-responsive" src="data:image/jpeg;base64,'.base64_encode( $results['image'] ).'"/>';
                            ?>
                          </div>
                          <div class="col-md-6">
                            <h3><?php echo $results['Subject'];?></h3>
                            <p><?php echo $results['Content'];?></p>
                          </div>
                          <div class="col-md-1">
                            <?php  
                                  $now = new DateTime;
                                  $ago = new DateTime($results['Time']);
                                  $diff = $now->diff($ago);

                                  $diff->w = floor($diff->d / 7);
                                  $diff->d -= $diff->w * 7;

                                  $string = array(
                                      'y' => 'year',
                                      'm' => 'month',
                                      'w' => 'week',
                                      'd' => 'day',
                                      'h' => 'hour',
                                      'i' => 'minute',
                                      's' => 'second',
                                  );
                                  foreach ($string as $k => &$v) {
                                      if ($diff->$k) {
                                          $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                                      } else {
                                          unset($string[$k]);
                                      }
                                  }

                                  $string = array_slice($string, 0, 1);
                                  echo $string ? implode(', ', $string) . ' ago' : 'just now';
                            
                            ?>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                <?php
                  }
                ?>

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
