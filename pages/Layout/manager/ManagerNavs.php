<?php
  $conn = mysqli_connect("localhost","root","","huvmts"); 
  $notIndex = 0;
  $rprt_sql = "SELECT * FROM `request` WHERE `mgr_see` = 'no'"; 
  $fetch = mysqli_query($conn,$rprt_sql);
  while ($row = mysqli_fetch_array($fetch)) {
    $notIndex++;
  }
?>

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title;?></title>

    <!-- Bootstrap -->
    <link href="/huvmts/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="/huvmts/vendors/bootstrap/dist/css/style.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/huvmts/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/huvmts/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Logo icon -->
    <link rel="icon" href="/huvmts/image/icon.jpg">
    <!-- Datatables -->
    <link href="/huvmts/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/huvmts/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed mCustomScrollbar _mCS_1 mCS-autoHide">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/huvmts/Accounts/Manager" class="site_title"><img src="/huvmts/asset/images.jpg" alt="..." class="img-circle" width="40px" height="50px"> <span>HUTMVTS</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <?php echo '<img class="img-circle profile_img img-responsive" src="data:image/jpeg;base64,'.base64_encode( $_SESSION['profilepicture'] ).'"/>'?>
              </div>
              <div class="profile_info">
                <span style="font-size: 22px;color: #ff8000">Welcome,</span>
                <h2><?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3 style="font-size: 28px;color: #ff8000"> DE Manager</h3>
                <ul class="nav side-menu">
                  <li class="<?php echo $ManagerHome;?>"><a  href="/huvmts/Accounts/Manager"><i class="fa fa-home"></i> Home </a></li>
                  <li class="<?php echo $ManagerTracking;?>"><a href="/huvmts/Accounts/Manager/Tracking"><i class="fa icon-location"></i>Tracking</a></li>
                  <li>
                    <a><i class="fa fa-envelope"></i>Message<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/huvmts/Accounts/Manager/Inboxs/index.php"><i class="fa icon-inbox"></i>Inboxs</a></li>
                      <li><a href="/huvmts/Accounts/Manager/Send Message/index.php"><i class="fa icon-message"></i>Send Message</a></li>
                    </ul>
                  </li>
                  <li class="<?php echo $ManagerAddV;?>">
                    <a><i class="fa icon-truck"></i>Vehicle<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      
                      <li><a href="/huvmts/Accounts/Manager/Add Vehicle/history.php">Vehicle History</a></li>
                      <li><a href="/huvmts/Accounts/Manager/Add Vehicle/see assigned vehicle.php">See Assigned vehicle</a></li>
                      
                    </ul>
                  </li>
                  <li class="<?php echo $Schedule;?>">
                    <a><i class="fa icon-calendar"></i>schedule<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      
                      <li><a href="/huvmts/Accounts/Manager/schedule/schedule.php"><i class="fa-solid fa-calendar-lines-pen"></i>Prepare Schedule</a></li>
                      <li><a href="/huvmts/Accounts/Manager/schedule/update_schedule.php"><i class="fa-solid fa-calendar-pen"></i>Updete schedule</a></li>
                      
                    </ul>
                  </li>
                  <li>
                    <a class="info-number" aria-expanded="false">
                      <i class="fa fa-globe"></i>
                      <?php if ($notIndex > 0) {echo '<span class="badge bg-red">'.$notIndex.'</span>';}?><span class="badge bg-red"></span>Request<span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li>
                        <a href="/huvmts/Accounts/Manager/Request/index.php">Request
                          <?php if ($notIndex > 0) {echo '<span class="badge bg-red">'.$notIndex.'</span>';}?>
                          <span class="badge bg-red"></span>
                        </a>
                      </li>
                      <li><a href="/huvmts/Accounts/Manager/Request/Report.php">Request Report</a></li>
                    </ul>
                  </li>


                  
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $_SESSION['profilepicture'] ).'"/>'?>
                    <?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="/huvmts/accounts/Manager/profile.php"> Profile</a></li>
                    <li>
                      <a href="/huvmts/Accounts/Manager/edit profile.php">
                        <i class="fa fa-cogs pull-right"></i><span>Settings</span>
                      </a>
                    </li>
                    <li><a href="/huvmts/Accounts/Manager/Help.php"><i style="color:brown" class="fa fa-question-circle pull-right"></i>User Help</a></li>
                    <li><a href="/huvmts/class/PHP/distroySession.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
