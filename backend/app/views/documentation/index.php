<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo SITE_TITLE; ?> | Documentation</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.png" type="image/x-icon">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/doc/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/util.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-black-light fixed" data-spy="scroll" data-target="#scrollspy">
    <div class="wrapper">

      <header class="main-header">
          <!-- Logo -->
          <a href="<?php echo base_url(); ?>home" class="logo">
              <!-- mini logo for sidebar mini 50x50 pixels -->
              <span class="logo-mini"><img src="<?php echo base_url(); ?>assets/img/logo-sm.png" alt="<?php echo $this->Util_model->get_option("site_abv"); ?>" width="50" height="50"> </span>
              <!-- logo for regular state and mobile devices -->
              <span class="logo-lg"><img src="<?php echo base_url(); ?>assets/img/logo-s.png" alt="<?php echo SITE_TITLE; ?>" style="width:195px; height:auto"></span>
          </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li><a href="<?php echo base_url(); ?>sign-in">Sign In</a></li>
              <li><a href="<?php echo base_url(); ?>sign-up">Create Account</a></li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <div class="sidebar" id="scrollspy">

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="nav sidebar-menu">
            <li class="header">TABLE OF CONTENTS</li>
            <li class="active"><a href="#introduction"><i class="fa fa-circle-o"></i> Introduction</a></li>
            <li><a href="#certificate"><i class="fa fa-circle-o"></i> Certificate</a></li>
            <li><a href="#security"><i class="fa fa-circle-o"></i> Security</a></li>
            <li><a href="#insurance"><i class="fa fa-circle-o"></i> Insurance</a></li>
            <li><a href="#trades"><i class="fa fa-circle-o"></i> Our Trades</a></li>
            <li class="treeview" id="scrollspy-components">
              <a href="javascript:void(0)" id="reward"><i class="fa fa-circle-o"></i> Rewards</a>
              <ul class="nav treeview-menu">
                <li><a href="#reward-family">Tree System</a></li>
                <!-- <li><a href="#reward-cell">Cell System</a></li> -->
                <li><a href="#reward-loyalty">Loyalty</a></li>
                <li><a href="#reward-coordinator">Coordinator</a></li>
              </ul>
            </li>
            <li><a href="#net-worth"><i class="fa fa-circle-o"></i> Net Worth</a></li>
            <li><a href="#faq"><i class="fa fa-circle-o"></i> FAQ</a></li>
            <li><a href="#terms"><i class="fa fa-circle-o"></i> Terms & Conditions</a></li>
          </ul>
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <h1>
          <?php echo SITE_TITLE; ?> Documentation <small>Everything you need to know</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Documentation</li>
          </ol>
        </div>

        <!-- Main content -->
        <div class="content body">

            <?php

            $this->load->view("documentation/include/introduction");

            ?>

        </div><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#"><?php echo SITE_TITLE; ?></a>.</strong> All rights
        reserved.
      </footer>

      <!--&lt;!&ndash; Control Sidebar &ndash;&gt;
      <aside class="control-sidebar control-sidebar-dark">
        &lt;!&ndash; Create the tabs &ndash;&gt;
        <div class="pad">
          This is an example of the control sidebar.
        </div>
      </aside>&lt;!&ndash; /.control-sidebar &ndash;&gt;
      &lt;!&ndash; Add the sidebar's background. This div must be placed
           immediately after the control sidebar &ndash;&gt;
      <div class="control-sidebar-bg"></div>-->

    </div><!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
    <script src="<?php echo base_url(); ?>assets/doc/docs.js"></script>
  </body>
</html>
