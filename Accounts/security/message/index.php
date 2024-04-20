<!DOCTYPE html>
<?php
  $title = "Home";
  $securityHome = "active";
  $notification= "";
 
   $schedule="";
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
            <?php
              mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());     
              mysql_select_db("huvmts") or die(mysql_error());
              $raw_results = mysql_query("SELECT * FROM `message` WHERE `reciver` = '".$_SESSION['username']."' ORDER BY Time DESC") or die(mysql_error());
            ?>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Inbox Design</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-sm-3 mail_list_column">
                        <?php  
                          while($results = mysql_fetch_array($raw_results)){
                            $username = $results['sender'];
                            $text = $results['content'];
                            $sqlSender = mysql_query("SELECT `firstname`,`lastname`,`acct_type` FROM account where `username`='$username';")or die(mysql_error());
                            while ($sender = mysql_fetch_array($sqlSender)) {
                        ?>
                        <a href="index.php?<?php $meID = $results['m_id']; echo $meID;?>">
                          <div class="mail_list">
                            <div class="left">
                              <i class="fa fa-circle"></i> <i class="fa fa-edit"></i>
                            </div>
                            <div class="right">
                              <h3><?php echo $sender['firstname'].' '.$sender['lastname'];?>
                                <small>
                                  <?php  
                                    $now = new DateTime;
                                    $ago = new DateTime($results['time']);
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
                                </small>
                              </h3>
                              <p>
                                <?php if($text!=""||$text!=null){
                                  for ($i=0; $i < 20; $i++){
                                    if($text[$i]=="" ||$text[$i]==null) 
                                      break; 
                                    else echo $text[$i];
                                  }
                                }?>
                              </p>
                            </div>
                          </div>
                        </a>
                        <?php
                            }
                          }
                        ?>                        
                      </div>
                      <!-- /MAIL LIST -->

                      <!-- CONTENT MAIL -->
                      <div class="col-sm-9 mail_view">                        
                        <div class="inbox-body">
                          <?php
                            if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING']!="") {
                              $str = $_SERVER['QUERY_STRING'];
                              $raw_results = mysql_query("SELECT * FROM `message` WHERE `m_id` = $str") or die(mysql_error());  
                            }else{
                              $raw_results = mysql_query("SELECT * FROM `message` WHERE `reciver` = '".$_SESSION['username']."' ORDER BY m_id DESC LIMIT 1") or die(mysql_error());                          
                            }
                            while($results = mysql_fetch_array($raw_results)){
                              $username = $results['sender'];
                              $sqlSender = mysql_query("SELECT `firstname`,`lastname`,`acct_type` FROM account where `username`='$username';")or die(mysql_error());
                              while ($sender = mysql_fetch_array($sqlSender)) {
                                $time = $results['time'];
                                $name = $sender['firstname'].' '.$sender['lastname'];
                                $senderUsername = $results['sender'];
                                $subjects = $results['subject'];
                                $content = $results['content'];                              
                              }
                            }
                          if (isset($time)) {                            
                          ?>
                          <div class="mail_heading row">
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-4 text-right">
                              <p class="date"><?php echo $time;?></p>
                            </div>
                            <div class="col-md-12">
                              <h4><?php echo $subjects;?></h4>
                            </div>
                          </div>
                          <div class="sender-info">
                            <div class="row">

                              <div class="col-md-12">
                                <strong><?php echo $name;?></strong>
                                <span>(<?php echo $senderUsername;?>)</span> to
                                <strong>me</strong>
                                <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
                              </div>
                            </div>
                          </div>
                          <div class="view-mail">
                            <?php echo $content;?>
                          </div>
                          <?php
                            } else{
                          ?>
                          <div class="mail_heading row">
                            <div class="col-md-12">
                              <h2>You don't have any Message</h2>
                            </div>
                          </div>
                          <?php
                            }
                          ?>
                        </div>
                      </div>
                      <!-- /CONTENT MAIL -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php
  include_once "../../../pages/layout/security/securityFoot.php";
?>
<?php
$dpt_sql = "SELECT * FROM `department` WHERE `username` = '".$_SESSION['username']."'"; 
    $dept = mysqli_query($conn,$dpt_sql);
    $row = mysqli_fetch_array($dept);

    $dpt_name = $row['dept_name'];
 

    $rprt_sql = "SELECT * FROM `request` WHERE `dept_name` = '".$dpt_name."' AND `username` = '".$username."'"; 
    $fetch = mysqli_query($conn,$rprt_sql);
    while ($row = mysqli_fetch_array($fetch)) {
      $report[$reportIndex] = $row;
      if ($row['report']!="not") {
        $replayed++;
      }
      $reportIndex++;
    } 
?>