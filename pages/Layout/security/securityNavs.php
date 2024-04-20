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

    <!-- Custom Theme Style -->
    <link href="/huvmts/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed mCustomScrollbar _mCS_1 mCS-autoHide">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><img src="/huvmts/asset/logo.jpg" alt="..." class="img-circle" width="45px"> <span>HUTMVTS</span></a>
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
                <h3 style="font-size: 28px;color: #ff8000">HU Scurity Police</h3>
                <ul class="nav side-menu">
                  <li class="<?php echo $securityHome;?>"><a  href="/huvmts/Accounts/security"><i class="fa fa-home"></i> Home </a></li>
                  <li class="<?php echo $Notification;?>"><a  href="/huvmts/Accounts/security/Notification"><i class="fa fa-home"></i> View Notification </a></li>
                  <li class="<?php echo $schedule;?>"><a  href="/huvmts/Accounts/security/schedule"><i class="fa fa-calendar"></i>Schedule </a></li>
                   <li>
                    <a><i class="fa icon-envelop"></i>Message<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/huvmts/Accounts/security/message/index.php">inbox</a></li>
                      <li><a href="/huvmts/Accounts/security/message/outbox.php">write message</a></li>
                      <li><a href="/huvmts/Accounts/security/message/sented.php">outbox</a></li>
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
                    <li><a href="/huvmts/accounts/security/profile.php"> Profile</a></li>
                    <li>
                      <a href="/huvmts/Accounts/security/edit profile.php">
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="/huvmts/class/PHP/distroySession.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
