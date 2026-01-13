<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>LIMS One Water Application</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/dist/css/AdminLTE.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/iCheck/square/blue.css">

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
        <style>
        /* ================================
           🌟 2026 MODERN LOGIN UI DESIGN
        =================================*/
        
        :root {
            /* 2026 Color System */
            --ui-primary: #4D6EF5;
            --ui-primary-light: #E7EBFF;
            --ui-primary-dark: #3B5AE0;
            --ui-surface: rgba(255, 255, 255, 0.95);
            --ui-surface-alt: rgba(255, 255, 255, 0.85);
            --ui-glass: rgba(255, 255, 255, 0.25);
            --ui-border: rgba(255, 255, 255, 0.2);
            --ui-text: #1A1D21;
            --ui-text-secondary: #6B7178;
            --ui-text-light: rgba(255, 255, 255, 0.95);
            --ui-success: #3FB984;
            --ui-warning: #F5C04D;
            --ui-danger: #E05B5B;
            --ui-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            --ui-shadow-lg: 0 25px 60px rgba(0, 0, 0, 0.15);
            --ui-radius: 20px;
            --ui-radius-sm: 12px;
            --ui-transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Video Background Enhancement */
        #myVideo {
            position: fixed;
            top: 0;
            left: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
            object-fit: cover;
            filter: brightness(0.7) contrast(1.1);
        }

        .video-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, 
                rgba(77, 110, 245, 0.15) 0%,
                rgba(107, 126, 247, 0.1) 50%,
                rgba(77, 110, 245, 0.2) 100%);
            z-index: 0;
            backdrop-filter: blur(1px);
        }

        /* Modern Body Styling */
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            overflow: hidden;
            position: relative;
        }

        /* Login Container - Enhanced Transparency */
        .login-container {
            position: relative;
            z-index: 100;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(40px);
            -webkit-backdrop-filter: blur(40px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: var(--ui-radius);
            box-shadow: 
                0 25px 60px rgba(0, 0, 0, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            padding: 0;
            width: 100%;
            max-width: 600px;
            margin: 20px;
            overflow: hidden;
            transition: var(--ui-transition);
        }

        /* .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
        } */

        /* Login Header */
        .login-header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            padding: 32px 32px 32px 32px;
            text-align: center;
            position: relative;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at top right, rgba(77, 110, 245, 0.1), transparent 70%);
        }

        /* Brand Logo Container */
        .brand-logo-container {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 16px;
        }

        .brand-logo-container img {
            transition: var(--ui-transition);
        }

        .brand-logo-container img:hover {
            opacity: 1 !important;
            transform: scale(1.05);
        }

        /* Time Display */
        .time-display {
            color: rgba(255, 255, 255, 0.95);
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
            font-family: 'SF Mono', 'Monaco', 'Cascadia Code', monospace;
            letter-spacing: 0.05em;
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        /* Logo */
        .login-logo {
            color: rgba(255, 255, 255, 0.95);
            font-size: 34px;
            font-weight: 800;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .login-logo .brand-accent {
            color: #6B7EF7;
            background: linear-gradient(135deg, #4D6EF5, #6B7EF7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 2px 4px rgba(77, 110, 245, 0.3));
        }

        /* Message */
        .login-message {
            color: rgba(255, 255, 255, 0.8);
            font-size: 15px;
            font-weight: 500;
            margin: 0;
            position: relative;
            z-index: 1;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
        }

        .login-message.blinking {
            color: var(--ui-danger);
            animation: pulse 2s infinite;
        }

        /* Login Body */
        .login-body {
            padding: 32px;
        }

        /* Form Groups */
        .form-group-modern {
            margin-bottom: 24px;
            position: relative;
        }

        .form-group-modern:last-child {
            margin-bottom: 0;
        }

        /* Input Fields */
        .form-input-modern {
            width: 100%;
            padding: 16px 20px 16px 50px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: var(--ui-radius-sm);
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: rgba(255, 255, 255, 0.95);
            font-size: 16px;
            font-weight: 500;
            transition: var(--ui-transition);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-input-modern:focus {
            outline: none;
            border-color: rgba(77, 110, 245, 0.8);
            background: rgba(255, 255, 255, 0.25);
            box-shadow: 
                inset 0 2px 4px rgba(0, 0, 0, 0.1),
                0 0 0 4px rgba(77, 110, 245, 0.2);
            transform: translateY(-1px);
        }

        .form-input-modern::placeholder {
            color: rgba(255, 255, 255, 0.6);
            font-weight: 500;
        }

        /* Input Icons */
        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
            font-size: 16px;
            transition: var(--ui-transition);
            z-index: 10;
        }

        .form-input-modern:focus + .input-icon {
            color: #6B7EF7;
            transform: translateY(-50%) scale(1.1);
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: var(--ui-transition);
        }

        .password-toggle:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #6B7EF7;
        }

        /* Login Button */
        .btn-login-modern {
            width: 100%;
            padding: 16px 24px;
            background: linear-gradient(135deg, var(--ui-primary), var(--ui-primary-dark));
            color: white;
            border: none;
            border-radius: var(--ui-radius-sm);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--ui-transition);
            box-shadow: 
                0 8px 20px rgba(77, 110, 245, 0.3),
                0 4px 12px rgba(77, 110, 245, 0.2);
            position: relative;
            overflow: hidden;
            margin-bottom: 24px;
        }

        .btn-login-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: var(--ui-transition);
        }

        .btn-login-modern:hover {
            transform: translateY(-2px);
            box-shadow: 
                0 12px 30px rgba(77, 110, 245, 0.4),
                0 6px 20px rgba(77, 110, 245, 0.3);
        }

        .btn-login-modern:hover::before {
            left: 100%;
        }

        .btn-login-modern:active {
            transform: translateY(-1px);
        }

        /* Footer Links */
        .login-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .forgot-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: var(--ui-transition);
            padding: 8px 12px;
            border-radius: 8px;
        }

        .forgot-link:hover {
            color: #6B7EF7;
            background: rgba(255, 255, 255, 0.1);
            text-decoration: none;
        }

        /* Partner Logo */
        .partner-logo {
            opacity: 0.8;
            transition: var(--ui-transition);
        }

        .partner-logo:hover {
            opacity: 1;
            transform: scale(1.05);
        }

        /* Video Toggle Button */
        #toggleButton {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: var(--ui-surface);
            backdrop-filter: blur(20px);
            color: var(--ui-text);
            border: 1px solid var(--ui-border);
            padding: 12px 16px;
            border-radius: 50px;
            cursor: pointer;
            transition: var(--ui-transition);
            box-shadow: var(--ui-shadow);
            z-index: 1000;
        }

        #toggleButton:hover {
            transform: translateY(-2px);
            box-shadow: var(--ui-shadow-lg);
            background: white;
        }

        /* Modern Modal Styling */
        .modal-content {
            border: none;
            border-radius: var(--ui-radius);
            background: var(--ui-surface);
            backdrop-filter: blur(30px);
            box-shadow: var(--ui-shadow-lg);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--ui-primary-light), rgba(255, 255, 255, 0.9));
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: var(--ui-radius) var(--ui-radius) 0 0;
            padding: 24px 32px;
        }

        .modal-body {
            padding: 32px;
        }

        .modal-footer {
            background: rgba(247, 248, 250, 0.5);
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 0 0 var(--ui-radius) var(--ui-radius);
            padding: 24px 32px;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .login-container {
                margin: 10px;
                max-width: none;
            }
            
            .login-header {
                padding: 32px 24px 24px 24px;
            }
            
            .login-body {
                padding: 24px;
            }
            
            .time-display {
                font-size: 24px;
            }
            
            .login-logo {
                font-size: 20px;
            }
        }

        /* Animations */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container {
            animation: slideInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            :root {
                --ui-surface: rgba(20, 25, 35, 0.95);
                --ui-surface-alt: rgba(20, 25, 35, 0.85);
                --ui-glass: rgba(20, 25, 35, 0.25);
                --ui-border: rgba(255, 255, 255, 0.15);
                --ui-text: #FFFFFF;
                --ui-text-secondary: #B4B8C5;
            }
        }
        </style>
    </head>

    <!-- <video autoplay muted loop id="myVideo">
        <source src="../img/dna.mp4" type="video/mp4">
    </video> -->

    <body class="hold-transition login-page">

    <!-- Video Background with Modern Overlay -->
    <div class="video-container">
        <video autoplay muted loop id="myVideo">
            <source src="../img/one_water.mp4" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
        <!-- Modern Video Toggle Button -->
        <button id="toggleButton">
            <i class="fa fa-pause"></i>
        </button>
    </div>
        
    <!-- Modern Login Container -->
    <div class="login-container">
        <!-- Login Header -->
        <div class="login-header">
            <!-- OneWater Logo -->
            <div class="brand-logo-container" style="margin-bottom: 20px;">
                <img src="<?php echo base_url('img/onewater-white.png'); ?>" alt="OneWater Logo" 
                     style="height: 80px; width: auto; opacity: 0.9; filter: drop-shadow(0 2px 8px rgba(0,0,0,0.3));">
            </div>
            <div class="login-logo">
                <span class="brand-accent">LIMS</span> | LOGIN
            </div>
            <div class="time-display" id="time"></div>
            <?php
            $status_login = $this->session->userdata('status_login');
            if (empty($status_login)) {
                $message = "Please enter your username and password";
            } else {
                $message = $status_login;
                $messageClass = 'blinking';
            }
            ?>
            <p class="login-message <?php echo isset($messageClass) ? $messageClass : ''; ?>">
                <?php echo $message; ?>
            </p>
        </div>

        <!-- Login Body -->
        <div class="login-body">
            <?php echo form_open('auth/cheklogin'); ?>
            
            <!-- Email Field -->
            <div class="form-group-modern">
                <input type="email" class="form-input-modern" name="email" placeholder="Enter your email address" required>
                <i class="fa fa-envelope input-icon"></i>
            </div>
            
            <!-- Password Field -->
            <div class="form-group-modern">
                <input type="password" class="form-input-modern" name="password" id="password" placeholder="Enter your password" required>
                <i class="fa fa-lock input-icon"></i>
                <button type="button" class="password-toggle bt1">
                    <i class="fa fa-eye-slash"></i>
                </button>
            </div>
            
            <!-- Login Button -->
            <button type="submit" class="btn-login-modern">
                <i class="fa fa-sign-in" style="margin-right: 8px;"></i>
                Sign In
            </button>
            
            </form>

            <!-- Footer -->
            <div class="login-footer">
                <a href="#" id="addtombol" class="forgot-link">
                    <i class="fa fa-key" style="margin-right: 6px;"></i>
                    Forgot Password?
                </a>
                <div class="partner-logo">
                    <a href="https://www.monash.edu/" target="_blank">
                        <img src="../assets/img/Project7.png" alt="Partner Logo" style="height: 32px; opacity: 0.8;">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FORM - Modern Design -->
    <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modal-title">
                        <i class="fa fa-key" style="margin-right: 8px; color: var(--ui-primary);"></i>
                        Forgot Password?
                    </h4>
                </div>
                <form id="formSample" method="post" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group-modern">
                            <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                            <label for="email" style="display: block; margin-bottom: 8px; color: var(--ui-text); font-weight: 600;">Enter your LIMS login email</label>
                            <input id="email" name="email" type="email" class="form-input-modern" placeholder="your.email@example.com" required style="padding-left: 20px;">
                        </div>

                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div id="quickMessage" class="form-group"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" style="background: var(--ui-primary); border: none; border-radius: var(--ui-radius-sm); padding: 12px 24px; font-weight: 600;">
                            <i class="fa fa-send" style="margin-right: 8px;"></i> Send Code
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal" style="border: none; border-radius: var(--ui-radius-sm); padding: 12px 24px; font-weight: 600;">
                            <i class="fa fa-times" style="margin-right: 8px;"></i> Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL FORM 2 - Reset Password -->
    <div class="modal fade" id="reset-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modal-title">
                        <i class="fa fa-shield" style="margin-right: 8px; color: var(--ui-primary);"></i>
                        Reset Password
                    </h4>
                </div>
                <form id="formSample" action="<?php echo site_url('Auth/savepassword') ?>" method="post" class="form-horizontal">
                    <div class="modal-body">
                        <p style="color: var(--ui-text-secondary); margin-bottom: 20px;">
                            <i class="fa fa-info-circle" style="margin-right: 8px; color: var(--ui-primary);"></i>
                            6 digit code has been sent to your email. Please check your inbox.
                        </p>
                        <hr style="border-color: rgba(255,255,255,0.3);">
                        
                        <input id="emailsend" name="emailsend" type="hidden" class="form-control input-sm">
                        
                        <div class="form-group-modern">
                            <label for="code" style="display: block; margin-bottom: 8px; color: var(--ui-text); font-weight: 600;">Verification Code</label>
                            <input id="code" name="code" type="text" class="form-input-modern" placeholder="Enter 6-digit code" required style="padding-left: 20px;">
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="new_pass" style="display: block; margin-bottom: 8px; color: var(--ui-text); font-weight: 600;">New Password</label>
                            <div style="position: relative;">
                                <input id="new_pass" name="new_pass" type="password" class="form-input-modern" placeholder="Enter new password" required style="padding-left: 20px; padding-right: 50px;">
                                <button type="button" class="password-toggle bt1" style="right: 15px;">
                                    <i class="glyphicon glyphicon-eye-close"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="re_pass" style="display: block; margin-bottom: 8px; color: var(--ui-text); font-weight: 600;">Confirm Password</label>
                            <div style="position: relative;">
                                <input id="re_pass" name="re_pass" type="password" class="form-input-modern" placeholder="Confirm new password" required style="padding-left: 20px; padding-right: 50px;">
                                <button type="button" class="password-toggle bt1" style="right: 15px;">
                                    <i class="glyphicon glyphicon-eye-close"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" style="background: var(--ui-primary); border: none; border-radius: var(--ui-radius-sm); padding: 12px 24px; font-weight: 600;">
                            <i class="fa fa-save" style="margin-right: 8px;"></i> Update Password
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal" style="border: none; border-radius: var(--ui-radius-sm); padding: 12px 24px; font-weight: 600;">
                            <i class="fa fa-times" style="margin-right: 8px;"></i> Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->        

    
        <!-- /.login-box -->

        <!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>/assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>/assets/adminlte/plugins/iCheck/icheck.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js"></script>

<!-- <script src="<?php //echo base_url(); ?>assets/js/jquery.backstretch.min.js"></script>
<script src="<?php //echo base_url(); ?>assets/js/templatemo-script.js"></script> -->
<script>

    document.addEventListener('DOMContentLoaded', function() {
        var video = document.getElementById('myVideo');
        var button = document.getElementById('toggleButton');

        // Toggle play/pause on button click
        button.addEventListener('click', function() {
            if (video.paused) {
                video.play();
                button.innerHTML = '<i class="fa fa-pause"></i>';
            } else {
                video.pause();
                button.innerHTML = '<i class="fa fa-play"></i>';
            }
        });
    });
                
    // Add event listener for toggle switch
    // document.getElementById('toggleButton').addEventListener('change', function() {
    //     var video = document.getElementById('myVideo');
    //     if (this.checked) {
    //         video.play();
    //     } else {
    //         video.pause();
    //     }
    // });

    $(document).ready(function() {

        // var options = {
        //     strings: ["Human samples (Blood and Feces)", "Enviroment samples (Water, Sedimen, Bootsock, Animal Feces)", "Ecology samples (Mosquito and Pupae)", "DNA Extraction, DNA Analysis and DNA Consentration"], // Array of strings to be typed
        //     typeSpeed: 100, // Typing speed in milliseconds
        //     loop: true // Whether to loop through the strings
        // };

        // var typed = new Typed('#typed-text', options);
        // document.getElementById('toggleButton').addEventListener('change', function() {
        //     var video = document.getElementById('myVideo');
        //     if (this.checked) {
        //         video.play();
        //     } else {
        //         video.pause();
        //     }
        // });
        var myVideo = document.getElementById("myVideo");
        if (myVideo.addEventListener) {
            myVideo.addEventListener('contextmenu', function(e) {
                e.preventDefault();
            }, false);
        } else {
            myVideo.attachEvent('oncontextmenu', function() {
                window.event.returnValue = false;
            });
        }

        $('#code').on("change", function() {
            data1 = $('#code').val();
            data2 = $('#emailsend').val();
            $.ajax({
                type: "GET",
                url: "Auth/valid_code?id1="+data1+"&id2="+data2,
                dataType: "json",
                success: function(data) {
                    if (data.length == 0) {
                        $('#code').focus();
                        $('#code').val('');     
                        $('#code').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#code').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#code').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#code').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
        });

        // $('#email').on("change", function() {
        //     $('#emailsend').val($('#email').val());     
        // });

        $('#re_pass').on("change", function() {
            data1 = $('#new_pass').val();
            data2 = $('#re_pass').val();
            if (data1 != data2) {
                $('#re_pass').focus();
                $('#re_pass').val('');     
                $('#re_pass').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#re_pass').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#re_pass').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#re_pass').css({'background-color' : '#FFFFFF'});
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            });
        });

        $('#addtombol').click(function() {
            // $('.val1tip').tooltipster('hide');   
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Forget Password ?<span id="my-another-cool-loader"></span>');
            $('#email').val('');
            $('#quickMessage').empty();
            $('#compose-modal').modal('show');
        });

        $('#formSample').submit(function(e) {
            $('#quickMessage').empty();
            var loadingMessage = $('<p></p>').addClass('text-info').text('Checking your email and sending your code, please wait...');
            $('#quickMessage').append(loadingMessage);

            $('#formSample button[type="submit"]').prop('disabled', true);
            e.preventDefault();
            // Get form data
            var formData = $(this).serialize();

            // Perform AJAX request to submit the form data
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('Auth/forgetpassword'); ?>',
                data: formData,
                dataType: 'json', // Change this based on your server response
                success: function(response) {
                    // Handle the server response here
                    // Show the second modal after the form is successfully submitted
                    if (response.status === 'success') {
                        // $('#responseMessage').html('<p class="text-' + response.status + '">' + response.message + '</p>');

                        $('#formSample button[type="submit"]').prop('disabled', false);
                        $('#modal-title').html('<i class="fa fa-wpforms"></i> Reset Password<span id="my-another-cool-loader"></span>');
                        $('#emailsend').val($('#email').val());
                        $('#code').val('');
                        $('#new_pass').val('');
                        $('#compose-modal').modal('hide');
                        $('#reset-modal').modal('show');
                    }
                    else {
                        // alert(response.message);
                        $('#quickMessage').empty();
                        var loadingMessage = $('<p></p>').addClass('text-info').text('Email not found, please enter the correct LIMS login email');
                        $('#quickMessage').append(loadingMessage);
                        $('#email').val('');
                        $('#formSample button[type="submit"]').prop('disabled', false);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the error response here
                    console.error(xhr.responseText);
                }
            });
        });

        $(".bt1").bind("click", function() {
            const passwordInput = $('#password');
            const newPassInput = $('#new_pass');
            const rePassInput = $('#re_pass');
            const icon = $(this).find('i');
            
            // Handle main password field
            if (passwordInput.length && passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            } else if (passwordInput.length && passwordInput.attr('type') === 'text') {
                passwordInput.attr('type', 'password');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            }
            
            // Handle modal password fields
            if (newPassInput.length && newPassInput.attr('type') === 'password') {
                newPassInput.attr('type', 'text');
                $(this).removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
            } else if (newPassInput.length && newPassInput.attr('type') === 'text') {
                newPassInput.attr('type', 'password');
                $(this).removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
            }
            
            if (rePassInput.length && rePassInput.attr('type') === 'password') {
                rePassInput.attr('type', 'text');
                $(this).removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
            } else if (rePassInput.length && rePassInput.attr('type') === 'text') {
                rePassInput.attr('type', 'password');
                $(this).removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
            }
        });    

        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });


        $(function() {
            startTime();
            // $(".center").center();
            // $(window).resize(function() {
            //     $(".center").center();
            // });
        });

        /*  */
        function startTime()
        {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();

            // add a zero in front of numbers<10
            h = checkTime(h);
            m = checkTime(m);
            s = checkTime(s);

            //Check for PM and AM
            // var day_or_night = (h > 11) ? "PM" : "AM";

            //Convert to 12 hours system
            // if (h > 12)
            //     h -= 12;

            //Add time to the headline and update every 500 milliseconds
            // $('#time').html(h + ":" + m + ":" + s + " " + day_or_night);
            $('#time').html(h + ":" + m + ":" + s);
            setTimeout(function() {
                startTime()
            }, 500);
        }

        function checkTime(i)
        {
            if (i < 10)
            {
                i = "0" + i;
            }
            return i;
        }                        
    </script>
    </body>
</html>
