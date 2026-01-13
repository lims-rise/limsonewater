<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>LIMS ONE WATER Application</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-ui/themes/base/minified/jquery-ui.min.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <!-- Theme style -->
        <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/dist/css/AdminLTE.min.css"> -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/dist/css/AdminLTE.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/dist/css/bootstrap-clockpicker.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/dist/css/tooltipster.bundle.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
              <!-- href="<?php //echo base_url() ?>assets/adminlte/dist/css/googleapis.css/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
    </head>
    <style>
        .system-title {
            font-weight: 600;
            color: #FFFFFF;
            font-size: 20px;
            margin: 0;
            padding: 12px 0;
            line-height: 1.2;
            vertical-align: middle;
            display: inline-block;
            letter-spacing: 1px;
            word-spacing: 1px;
        }

        @media print{
            .noprint{
                display:none;
            }
        @page { margin: 0; }
        body { margin: 1.6cm; }
        }
        h6 {
            /* display: block; */
            /* position: relative; */
            padding: 5px 15px 0 15px;
            /* background-color: #08C; */
            font-size: 20px;
            color: white;
        }
        .tab1 { tab-size: 2; }
        .table tbody tr.active td,
        .table tbody tr.active th {
            background-color: #08C;
            color: white;
            /* cursor: pointer; */
        }

        /* Global Search - Ensure no interference with sidebar */
        #global-search-input, #global-search-btn {
            pointer-events: auto;
            z-index: 999;
        }
        
        /* Ensure sidebar has higher priority */
        .main-sidebar {
            z-index: 1001 !important;
        }
        
        .sidebar-toggle {
            z-index: 1002 !important;
        }

        /* ================================
        🌟 2026 USER PROFILE DROPDOWN 
        Using Dashboard Color System
        =================================*/
        :root {
            /* Using existing dashboard colors */
            --profile-accent: #4D6EF5;              /* Soft Indigo Blue */
            --profile-accent-light: #E7EBFF;        /* Soft accent background */
            --profile-surface: #FFFFFF;             /* Pure white surface */
            --profile-surface-glass: rgba(255, 255, 255, 0.95); /* Glass effect */
            --profile-border: #E2E4E8;              /* Light border */
            --profile-shadow: 0 20px 40px rgba(77, 110, 245, 0.15);
            --profile-text: #1A1D21;                /* Primary text */
            --profile-text-secondary: #6B7178;      /* Secondary text */
            --profile-danger: #E05B5B;              /* Muted red for logout */
            --profile-success: #3FB984;             /* Success green */
            --profile-radius: 18px;
            --profile-transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Modern Profile Avatar Button - Keep original header style */
        .modern-profile-trigger {
            /* Remove custom styling to preserve original header look */
        }

        /* Modern Glassmorphism Dropdown Card */
        .modern-profile-card {
            position: absolute !important;
            top: 100% !important;
            right: 0 !important;
            width: 340px !important;
            margin-top: 12px !important;
            background: var(--profile-surface) !important;
            backdrop-filter: blur(30px) !important;
            -webkit-backdrop-filter: blur(30px) !important;
            border: 1px solid var(--profile-border) !important;
            border-radius: var(--profile-radius) !important;
            box-shadow: 
                0 25px 60px rgba(0, 0, 0, 0.12),
                0 12px 30px rgba(77, 110, 245, 0.1) !important;
            padding: 0 !important;
            opacity: 0 !important;
            visibility: hidden !important;
            transform: translateY(-10px) scale(0.95) !important;
            transition: var(--profile-transition) !important;
            z-index: 9999 !important;
            overflow: hidden !important;
        }

        .modern-profile-card.show {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) scale(1) !important;
        }

        /* Profile Header Section */
        .profile-card-header {
            padding: 24px 24px 20px 24px !important;
            background: linear-gradient(135deg, var(--profile-accent-light), rgba(255,255,255,0.1)) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15) !important;
            text-align: center !important;
            position: relative !important;
        }

        .profile-card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at top right, rgba(77, 110, 245, 0.1), transparent 50%);
        }

        .profile-header-avatar {
            width: 72px !important;
            height: 72px !important;
            border-radius: 50% !important;
            border: 3px solid rgba(255, 255, 255, 0.9) !important;
            margin: 0 auto 16px auto !important;
            display: block !important;
            object-fit: cover !important;
            box-shadow: 
                0 12px 25px rgba(0, 0, 0, 0.15),
                0 0 0 4px rgba(77, 110, 245, 0.1) !important;
            transition: var(--profile-transition) !important;
            position: relative !important;
            z-index: 1 !important;
        }

        .profile-header-name {
            color: var(--profile-text) !important;
            font-size: 20px !important;
            font-weight: 700 !important;
            margin-bottom: 4px !important;
            letter-spacing: 0.02em !important;
            position: relative !important;
            z-index: 1 !important;
        }

        .profile-header-email {
            color: var(--profile-text-secondary) !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            opacity: 0.8 !important;
            position: relative !important;
            z-index: 1 !important;
        }

        /* Profile Actions Section */
        .profile-card-actions {
            padding: 20px 0 !important;
        }

        .profile-action-item {
            display: flex !important;
            align-items: center !important;
            padding: 14px 24px !important;
            color: var(--profile-text) !important;
            text-decoration: none !important;
            transition: var(--profile-transition) !important;
            border: none !important;
            background: none !important;
            width: 100% !important;
            text-align: left !important;
            cursor: pointer !important;
            font-size: 15px !important;
            font-weight: 500 !important;
            position: relative !important;
            overflow: hidden !important;
        }

        .profile-action-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: linear-gradient(90deg, var(--profile-accent-light), rgba(77, 110, 245, 0.05));
            transition: var(--profile-transition);
            z-index: 0;
        }

        .profile-action-item:hover {
            color: var(--profile-accent) !important;
            text-decoration: none !important;
            background: rgba(77, 110, 245, 0.04) !important;
        }

        .profile-action-item:hover::before {
            width: 100%;
        }

        .profile-action-item.danger:hover {
            color: var(--profile-danger) !important;
            background: rgba(224, 91, 91, 0.04) !important;
        }

        .profile-action-item.danger::before {
            background: linear-gradient(90deg, rgba(224, 91, 91, 0.1), rgba(224, 91, 91, 0.02));
        }

        .profile-action-icon {
            width: 20px !important;
            height: 20px !important;
            margin-right: 14px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            border-radius: 8px !important;
            background: rgba(77, 110, 245, 0.1) !important;
            transition: var(--profile-transition) !important;
            position: relative !important;
            z-index: 1 !important;
        }

        .profile-action-item:hover .profile-action-icon {
            background: var(--profile-accent) !important;
            color: white !important;
            transform: scale(1.1) !important;
        }

        .profile-action-item.danger .profile-action-icon {
            background: rgba(224, 91, 91, 0.1) !important;
        }

        .profile-action-item.danger:hover .profile-action-icon {
            background: var(--profile-danger) !important;
            color: white !important;
        }

        .profile-action-text {
            position: relative !important;
            z-index: 1 !important;
        }

        /* Divider */
        .profile-divider {
            height: 1px !important;
            background: linear-gradient(90deg, transparent, var(--profile-border), transparent) !important;
            margin: 8px 24px !important;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .modern-profile-card {
                width: 300px !important;
                right: -30px !important;
            }
            
            .modern-profile-trigger .profile-name {
                display: none !important;
            }
            
            .modern-profile-trigger {
                padding: 8px 12px !important;
                border-radius: 50% !important;
            }
        }

        /* Animation for entrance */
        @keyframes profileDropFadeIn {
            from {
                opacity: 0;
                transform: translateY(-15px) scale(0.92);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modern-profile-card.animate-in {
            animation: profileDropFadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

    </style>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header white">
                <!-- Logo -->
                <a href="<?php echo base_url() ?>index.php/welcome" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">R<b>L</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">
                    <img src="<?php echo base_url('img/onewater-white.png'); ?>" class="user-image" alt="User Image" style="width: 200px; height: 42px; float: left; margin-top: 3px;">
                    </span>
                    <!-- <span class="logo-lg">RISE|<b><mark>LIMS</mark>2.0</b></span> -->
                    <!-- <span class="logo-lg">RISE|<b><span style="background-color: #FFFFFF; color: #000000">LIMS</span>2.0</b></span> -->
                    
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">                          
                            <!-- User Account: style can be found in dropdown.less -->
                            <!-- <ul class="nav navbar-nav navbar-right"> -->
                            <!-- <input type="hidden" id="id_lab" value=<?php //$this->session->userdata('lab') ?>> -->
                            <?php 
                                // $id_user_level = $this->session->userdata('id_user_level');
                                // $sql_menu = "SELECT * 
                                // FROM tbl_menu 
                                // WHERE id_menu in(select id_menu from tbl_hak_akses where id_user_level=$id_user_level) and is_main_menu=0 and is_aktif='y'";                            
                                //Notification Dropdown
                                // if($id_user_level!='3'){
                                //     echo "<li class=\"dropdown\">";
                                //     echo "<a href=\"\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><span class=\"label label-pill label-danger count\" style=\"border-radius:10px;\"> </span> <span class=\"glyphicon glyphicon-bell\" style=\"font-size:18px;\"></span></a>";
                                //     echo "<ul class=\"dropdown-menu notif-panel\"> </ul>";
                                // }
                            ?>
                            <!-- <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"> </span> <span class="glyphicon glyphicon-bell" style="font-size:18px;"></span></a>
                            <ul class="dropdown-menu notif-panel"> </ul> -->
                            </li>
                            <!-- </ul> -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle modern-profile-trigger" onclick="toggleProfileDropdown(event)" data-toggle="">
                                    <img src="<?php echo base_url() ?>assets/foto_profil/<?php echo $this->session->userdata('images'); ?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php echo $this->session->userdata('full_name'); ?></span>
                                </a>
                                
                                <div class="modern-profile-card" id="profileDropdownCard">
                                    <!-- Profile Header -->
                                    <div class="profile-card-header">
                                        <img src="<?php echo base_url() ?>assets/foto_profil/<?php echo $this->session->userdata('images'); ?>" class="profile-header-avatar" alt="User Image">
                                        <div class="profile-header-name"><?php echo $this->session->userdata('full_name'); ?></div>
                                        <div class="profile-header-email"><?php echo $this->session->userdata('email'); ?></div>
                                    </div>
                                    
                                    <!-- Profile Actions -->
                                    <div class="profile-card-actions">
                                        <a href="<?php echo base_url('index.php/tbl_user_profile'); ?>" class="profile-action-item">
                                            <div class="profile-action-icon">
                                                <i class="fa fa-user" style="font-size: 12px;"></i>
                                            </div>
                                            <div class="profile-action-text">View Profile</div>
                                        </a>
                                        
                                        <div class="profile-divider"></div>
                                        
                                        <a href="<?php echo base_url('index.php/auth/logout'); ?>" class="profile-action-item danger">
                                            <div class="profile-action-icon">
                                                <i class="fa fa-sign-out" style="font-size: 12px;"></i>
                                            </div>
                                            <div class="profile-action-text">Sign Out</div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <!-- <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li> -->
                        </ul>
                    </div>

                     <!-- Smart Global Search Component -->
                    <div class="navbar-form navbar-right" style="margin-top: 8px; margin-right: 10px; z-index: 999; position: relative;">
                        <div class="form-group">
                            <div class="input-group smart-search-container" style="width: 350px;">
                                <input type="text" id="global-search-input" class="form-control smart-search-input" placeholder="Search Project ID or Sample ID..." style="border-radius: 15px 0 0 15px;" autocomplete="off">
                                <span class="input-group-btn">
                                    <button type="button" id="global-search-btn" class="btn btn-primary" style="border-radius: 0 15px 15px 0; height: 34px;" tabindex="-1">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- Smart Suggestions Dropdown -->
                            <div id="search-suggestions" class="search-suggestions-dropdown">
                                <div class="suggestions-header">
                                    <span class="suggestions-title">Recent Searches</span>
                                    <button class="clear-history-btn" onclick="clearSearchHistory()">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <div class="suggestions-list" id="suggestions-list">
                                    <!-- Dynamic suggestions will be populated here -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Smart Search Styles -->
                    <style>
                        .smart-search-container {
                            position: relative;
                        }

                        .search-suggestions-dropdown {
                            position: absolute;
                            top: 100%;
                            left: 0;
                            right: 0;
                            background: white;
                            border: 1px solid #ddd;
                            border-radius: 12px;
                            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                            z-index: 9999;
                            max-height: 300px;
                            overflow-y: auto;
                            display: none;
                            margin-top: 4px;
                        }

                        .suggestions-header {
                            padding: 12px 16px;
                            border-bottom: 1px solid #eee;
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            background: #f8f9fa;
                            border-radius: 12px 12px 0 0;
                        }

                        .suggestions-title {
                            font-size: 12px;
                            color: #666;
                            font-weight: 600;
                        }

                        .clear-history-btn {
                            background: none;
                            border: none;
                            color: #999;
                            cursor: pointer;
                            padding: 4px 8px;
                            border-radius: 4px;
                            font-size: 11px;
                        }

                        .clear-history-btn:hover {
                            background: #e9ecef;
                            color: #666;
                        }

                        .suggestion-item {
                            padding: 12px 16px;
                            cursor: pointer;
                            border-bottom: 1px solid #f0f0f0;
                            transition: background 0.2s ease;
                            display: flex;
                            align-items: center;
                        }

                        .suggestion-item:hover {
                            background: #f8f9fa;
                        }

                        .suggestion-item:last-child {
                            border-bottom: none;
                            border-radius: 0 0 12px 12px;
                        }

                        .suggestion-icon {
                            margin-right: 10px;
                            color: #4D6EF5;
                            width: 16px;
                        }

                        .suggestion-text {
                            flex-grow: 1;
                            font-size: 14px;
                        }

                        .suggestion-type {
                            font-size: 11px;
                            color: #888;
                            background: #e9ecef;
                            padding: 2px 6px;
                            border-radius: 8px;
                        }

                        .smart-search-input:focus + .input-group-btn + .search-suggestions-dropdown {
                            display: block;
                        }

                        .no-suggestions {
                            padding: 20px;
                            text-align: center;
                            color: #999;
                            font-style: italic;
                        }

                        .placeholder-cycling {
                            color: #999;
                            font-style: italic;
                            transition: opacity 0.5s ease;
                        }
                    </style>
                    <!-- <marquee behavior="scroll" direction="left" scrollamount="30">
                        <h6><i class='fa fa-qrcode'></i><b> Indonesia</b> Lab data </h6>
                    </marquee> -->
                    <?php 
 
                        if ($this->session->userdata('lab') == 1) {
                            // echo "<span class=\"\"><b>Welcome to the LIMS2.0</b>RISE Indonesia</span>
                            // <h6><i class='fa fa-flag'></i> Indonesia Lab data </h6>
                            echo "<h1 class=\"system-title\">Laboratory Information Management System</h1>";
                        }
                        else {
                            echo "<h1 class=\"system-title\">Laboratory Information Management System</h1>";
                            // echo "<span class=\"\"><b>Welcome to the LIMS2.0</b>RISE Fiji</span>";
                        }
                    ?>


                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <?php $this->load->view('template/sidebar'); ?>
            </aside>

            <?php
            echo $contents;
            ?>


            <!-- /.content-wrapper -->
            <div class="noprint">
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.1.0
                </div>
                <strong><img src="../img/lims_logo4.png" height='25px'>  Copyright &copy; 2026 LIMS-OneWater | 
                <a href="https://www.linkedin.com/in/zainal-enal-452b4414a/" target="_blank">One Water Team</a>.</strong> All rights reserved.
            </footer>
            </div>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">
                        <h3 class="control-sidebar-heading">Application Information</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-free-code-camp bg-red"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Objectives</h4>

                                        <p>Contain a module from RISE objectives activities (O3, O2A and O2B)</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-refresh bg-yellow"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Process</h4>

                                        <p>A module to processing sample from the field such as Water, DNA, Freezer and Sample External </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-file-text bg-light-blue"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Reports</h4>

                                        <p>Contain a module to print a report</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-table bg-green"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Master</h4>

                                        <p>A module to entry master data such as Person, Sample type, DNA sample, etc.</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                        <h3 class="control-sidebar-heading">Tasks Progress</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Objectives progress
                                        <span class="label label-danger pull-right">70%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Processing
                                        <span class="label label-warning pull-right">100%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-warning" style="width: 100%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        History Reports
                                        <span class="label label-primary pull-right">100%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-primary" style="width: 100%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Master Integration
                                        <span class="label label-success pull-right">50%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-success" style="width: 50%"></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                    </div>
                    <!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                    <!-- /.tab-pane -->
                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <form method="post">
                            <h3 class="control-sidebar-heading">General Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Report panel usage
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Some information about this general settings option
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Allow mail redirect
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Other sets of options are available
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Expose author name in posts
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Allow the user to show his name in blog posts
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <h3 class="control-sidebar-heading">Chat Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Show me as online
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Turn off notifications
                                    <input type="checkbox" class="pull-right">
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Delete chat history
                                    <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                                </label>
                            </div>
                            <!-- /.form-group -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <!-- <div class="control-sidebar-bg"></div> -->
        </div>
        <!-- ./wrapper -->
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap-clockpicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/jquery-ui/ui/minified/jquery-ui.min.js"></script>
        <!-- jQuery 3
        <script src="<?php echo base_url() ?>assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
         -->
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo base_url() ?>assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- DataTables -->
        <script src="<?php echo base_url() ?>assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url() ?>assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="<?php echo base_url() ?>assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url() ?>assets/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url() ?>assets/adminlte/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url() ?>assets/adminlte/dist/js/demo.js"></script>
        <!-- Select2 -->
        <script src="<?php echo base_url() ?>assets/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>

        <!-- Chosen JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

        <script src="<?php echo base_url() ?>assets/adminlte/dist/js/tooltipster.bundle.js"></script>
        <!-- page script -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
        <script>

            //Notif ================

        $(document).ready(function(){

            // $("#btn1").click(function() {
            //     alert("Lab ID :" + $("#id_country").val());
                // $this->session->userdata('lab');
                // $this->session->set_userdata('lab',  $('#id_country').val());
            // });

        
            // function load_unseen_notification(view = '')
            // {
            // $.ajax({
            //     url: "<?php echo base_url()?>index.php/kelolamenu/notif",
            //     method:"POST",
            //     // data:{view:view},
            //     dataType:"json",
            //     success:function(data)
            //     {
            //         $('.notif-panel').html(data.notification);
            //         if(data.unseen_notification > 0)
            //         {
            //         $('.count').html(data.unseen_notification);
            //         }
            //     }
            // });
            // }
            
            // load_unseen_notification();

            // $(document).on('click', '.dropdown-toggle', function(){
            //     $('.count').html('');
            //     load_unseen_notification('yes');
            // });
            
            // setInterval(function(){ 
            //    load_unseen_notification();
            // }, 60000);

        });
            //================
            
            // ================================
            // 🔍 Smart Global Search with Dynamic Placeholders
            // ================================
            
            // Smart Placeholder Cycling
            const smartPlaceholders = [
                'Search Project ID... (e.g., MU2500001)',
                'Search Sample ID... (e.g., P2500001)',
                'Try: MU2500001, P2500001...',
                'Search by Project or Sample ID',
                'Find your data quickly...'
            ];
            
            let currentPlaceholderIndex = 0;
            let placeholderInterval;
            
            function cyclePlaceholders() {
                const input = $('#global-search-input');
                if (!input.is(':focus') && input.val() === '') {
                    input.attr('placeholder', smartPlaceholders[currentPlaceholderIndex]);
                    currentPlaceholderIndex = (currentPlaceholderIndex + 1) % smartPlaceholders.length;
                }
            }
            
            // Start placeholder cycling
            placeholderInterval = setInterval(cyclePlaceholders, 3000);
            
            // Search History Management
            function getSearchHistory() {
                return JSON.parse(localStorage.getItem('lims_search_history') || '[]');
            }
            
            function saveSearchHistory(searchTerm) {
                let history = getSearchHistory();
                
                // Remove existing entry if present
                history = history.filter(item => item.term !== searchTerm);
                
                // Add new entry at the beginning
                history.unshift({
                    term: searchTerm,
                    timestamp: new Date().toISOString(),
                    type: searchTerm.startsWith('MU') ? 'project' : 'sample'
                });
                
                // Keep only last 10 searches
                history = history.slice(0, 10);
                
                localStorage.setItem('lims_search_history', JSON.stringify(history));
                updateSuggestions();
            }
            
            function clearSearchHistory() {
                localStorage.removeItem('lims_search_history');
                updateSuggestions();
                $('#search-suggestions').hide();
            }
            
            function updateSuggestions() {
                const history = getSearchHistory();
                const suggestionsList = $('#suggestions-list');
                
                if (history.length === 0) {
                    suggestionsList.html('<div class="no-suggestions">No recent searches</div>');
                    return;
                }
                
                let html = '';
                history.forEach(item => {
                    const icon = item.type === 'project' ? 'fa-folder' : 'fa-flask';
                    const typeLabel = item.type === 'project' ? 'Project' : 'Sample';
                    
                    html += `
                        <div class="suggestion-item" onclick="selectSuggestion('${item.term}')">
                            <i class="fa ${icon} suggestion-icon"></i>
                            <span class="suggestion-text">${item.term}</span>
                            <span class="suggestion-type">${typeLabel}</span>
                        </div>
                    `;
                });
                
                suggestionsList.html(html);
            }
            
            function selectSuggestion(term) {
                $('#global-search-input').val(term);
                $('#search-suggestions').hide();
                performGlobalSearch(term);
            }
            
            // Enhanced search input events
            $('#global-search-input').on('focus', function() {
                clearInterval(placeholderInterval);
                $(this).attr('placeholder', 'Type to search...');
                updateSuggestions();
                $('#search-suggestions').show();
            }).on('blur', function() {
                // Delay hiding to allow clicks on suggestions
                setTimeout(() => {
                    $('#search-suggestions').hide();
                    placeholderInterval = setInterval(cyclePlaceholders, 3000);
                }, 200);
            }).on('input', function() {
                const value = $(this).val();
                if (value.length > 0) {
                    $('#search-suggestions').hide();
                } else {
                    updateSuggestions();
                    $('#search-suggestions').show();
                }
            });

            // Global Search Functionality - Enhanced with history
            $('#global-search-btn').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var searchTerm = $('#global-search-input').val().trim();
                if (searchTerm !== '') {
                    performGlobalSearch(searchTerm);
                }
            });
            
            $('#global-search-input').on('keypress', function(e) {
                if (e.which === 13) {
                    e.preventDefault();
                    e.stopPropagation();
                    var searchTerm = $(this).val().trim();
                    if (searchTerm !== '') {
                        performGlobalSearch(searchTerm);
                    }
                }
            });
            
            // Prevent search input from interfering with other elements
            $('#global-search-input').on('focus blur', function(e) {
                e.stopPropagation();
            });
            
            function performGlobalSearch(searchTerm) {
                // Save to search history before searching
                saveSearchHistory(searchTerm);
                
                console.log('Performing search for:', searchTerm);
                $.ajax({
                    url: '<?php echo site_url('Sample_reception/global_search'); ?>',
                    type: 'POST',
                    data: { search_term: searchTerm },
                    dataType: 'json',
                    beforeSend: function() {
                        console.log('Sending request to global_search');
                        $('#global-search-btn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
                    },
                    success: function(response) {
                        console.log('Search response:', response);
                        if (response.success) {
                            if (response.type === 'project') {
                                // Redirect to sample reception with project filter
                                window.location.href = '<?php echo base_url(); ?>index.php/sample_reception?project_id=' + encodeURIComponent(searchTerm);
                            } else if (response.type === 'sample') {
                                // Redirect to the project that contains this sample
                                window.location.href = '<?php echo base_url(); ?>index.php/sample_reception?project_id=' + encodeURIComponent(response.data.id_project) + '&sample_id=' + encodeURIComponent(searchTerm);
                            } else if (response.type === 'partial') {
                                // Show partial results in modal or redirect with general search
                                if (response.data.length === 1) {
                                    // Single partial match - redirect to that project
                                    window.location.href = '<?php echo base_url(); ?>index.php/sample_reception?project_id=' + encodeURIComponent(response.data[0].id_project);
                                } else {
                                    // Multiple partial matches - general search
                                    window.location.href = '<?php echo base_url(); ?>index.php/sample_reception?search=' + encodeURIComponent(searchTerm);
                                }
                            } else {
                                // General redirect for any other matches
                                window.location.href = '<?php echo base_url(); ?>index.php/sample_reception?search=' + encodeURIComponent(searchTerm);
                            }
                        } else {
                            alert('No results found for: ' + searchTerm);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Search error:', xhr, status, error);
                        console.log('Response text:', xhr.responseText);
                        alert('Search failed. Please try again. Error: ' + status);
                    },
                    complete: function() {
                        $('#global-search-btn').prop('disabled', false).html('<i class="fa fa-search"></i>');
                    }
                });
            }

            // Initialize Smart Search on page load
            $(document).ready(function() {
                updateSuggestions();
                cyclePlaceholders(); // Set initial placeholder
                
                // Prevent suggestions dropdown from interfering with other elements
                $('#search-suggestions').on('click', function(e) {
                    e.stopPropagation();
                });
            });

            // ================================
            // 🌟 Modern Profile Dropdown 2026
            // ================================
            function toggleProfileDropdown(event) {
                event.preventDefault();
                event.stopPropagation();
                
                const card = document.getElementById('profileDropdownCard');
                const isShowing = card.classList.contains('show');
                
                // Close all other dropdowns first
                document.querySelectorAll('.modern-profile-card.show').forEach(dropdown => {
                    dropdown.classList.remove('show', 'animate-in');
                });
                
                if (!isShowing) {
                    // Show with animation
                    card.classList.add('show', 'animate-in');
                    
                    // Add click outside listener
                    setTimeout(() => {
                        document.addEventListener('click', closeProfileOnClickOutside);
                    }, 10);
                }
            }

            function closeProfileOnClickOutside(event) {
                const card = document.getElementById('profileDropdownCard');
                const trigger = document.querySelector('.modern-profile-trigger');
                
                if (!card.contains(event.target) && !trigger.contains(event.target)) {
                    card.classList.remove('show', 'animate-in');
                    document.removeEventListener('click', closeProfileOnClickOutside);
                }
            }

            // Close dropdown on escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    const card = document.getElementById('profileDropdownCard');
                    if (card.classList.contains('show')) {
                        card.classList.remove('show', 'animate-in');
                        document.removeEventListener('click', closeProfileOnClickOutside);
                    }
                }
            });

            // Prevent dropdown from closing when clicking inside
            document.getElementById('profileDropdownCard').addEventListener('click', function(event) {
                event.stopPropagation();
            });

            // Add smooth hover effects to action items
            document.querySelectorAll('.profile-action-item').forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(4px)';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });

            // $(function () {
            //     $('.select2').select2()
            //     $('#example1').DataTable()
            //     $('#example2').DataTable({
            //         'paging'      : true,
            //         'lengthChange': false,
            //         'searching'   : false,
            //         'ordering'    : true,
            //         'info'        : true,
            //         'autoWidth'   : false
            //     })
            // })
        </script>
    </body>
</html>
