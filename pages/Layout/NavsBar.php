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
    <!-- social media-->
      <link rel="stylesheet" href="/huvmts/vendors/stylish-social-buttons/css/style.css">
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
    <script type="text/javascript">

    </script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed mCustomScrollbar _mCS_1 mCS-autoHide">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><img src="/huvmts/asset/logo.jpg" alt="..." class="img-circle" width="45px"> <span>HUTMVTS</span></a>
            </div>

            <div class="clearfix"></div>

            

            <br />
            <br />
            <br />
            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li class="<?php echo $home?>"><a  href="/huvmts"><i class="fa fa-home"></i><?php echo $TEXT['home'];?></a></li>
                  <li class="<?php echo $about?>"><a href="/huvmts/pages/about.php"><i class="fa icon-users"></i><?php echo $TEXT['about'];?></a></li>
                  <li class="<?php echo $contact?>"><a href="/huvmts/pages/Contact.php"><i class="fa icon-email"></i><?php echo $TEXT['contact'];?></a></li>
                  <li class="<?php echo $post?>"><a href="/huvmts/pages/post.php"><i class = "fa icon-envelop"></i> &nbsp; <?php echo $TEXT['post'];?></a></li>
                  <li class="<?php echo $login?>"><a href="/huvmts/pages/login.php"><i class = "fa fa-sign-in push-left"></i> &nbsp; <?php echo $TEXT['login'];?></a></li>
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
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Language
                    <span class=" fa fa-angle-down"></span></a>
                  <ul class="dropdown-menu">
                    <?php
                      $i=0;
                      while (list($key, $value) = each($languages))
                      {
                        $s="";
                        if($l==$key)$s='style="font-weight: bold;"';
                          echo '<li><a '.$s.' target="_parent" href="'.$x.$key.'">'.$value.'</a></li>';
                      }
                    ?>
                  </ul>
                </li>

                
                  <li class="<?php echo $login?>">
                    <a href="/huvmts/pages/login.php">
                      <i class = "fa fa-sign-in push-left"></i> &nbsp; 
                      <?php echo $TEXT['login'];?>
                    </a>
                  </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
