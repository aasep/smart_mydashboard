<?php
#########################################
#        BISMILLAH                      #
#########################################
#          DEV                          #
# OS : WINDOWS                          #
# DB : MYSQL                            #
# CREATOR : ASEP ARIFYAN                #
# EMAIL : aseparifyan@gmail.com         #
#########################################

######################################

//error_reporting(-1);
    session_start();
    require_once "library/adodb5/adodb.inc.php" ;
    require_once('config/config.php');
    require_once('function/function.php');

    if ( !isset ($_GET['status'])) {
        $_SESSION['rnd1']=generateRandomString(40);
        $_SESSION['rnd2']=generateRandomString(40);
        $_SESSION['rnd3']=generateRandomString(40);
        $_SESSION['rnd4']=generateRandomString(40);
    }
  
    if (isset($_SESSION['USERNAME']) && isset($_SESSION['STATUS_ACCOUNT']) && isset($_SESSION['PASSWORD'])) {
        header("location: home");
        die();
    }

    if (isset($_POST['username']) && isset($_POST['password']) ){  
   
        //$password=$crypt->encrypt($_POST['password']);
        $password=hashEncrypted($_POST['password']);

        ############## cek username ########################

        //$tmp_username= isUsername($_POST['username']); 


        ############## end check username ##################

        // echo $password;
        // echo "<br>";
        // echo $crypt->decrypt($password);
        // die();

                    $SQL = " SELECT * FROM smart_user_account WHERE  username='".trim(strtolower($_POST['username']))."' and password='$password' ";

                   // echo $SQL;
                    //die();
                    $RS  = $db->Execute($SQL);
                   //echo $RS->fields['username'];
                         //   die();
                        if(!empty($RS->fields['username']) ){
                                $num = $RS->RecordCount();
                        }


                             if (isset($num) && $num >= 1){


                                /*echo "sukses";
                                die();*/
                                    $fix_username        = ($RS->fields['username']) ;
                                    $fix_password        = ($RS->fields['password']) ;
                                    $fix_group_user      = ($RS->fields['groupid']) ;
                                    $fix_email           = ($RS->fields['email']) ;
                                    $fix_namalengkap     = ($RS->fields['nama_lengkap']) ;
                                    $fix_status          = ($RS->fields['status']) ;
                                    //$fix_image           = ($RS->fields['image']) ;
                                    $fix_join_date       = (date("d-m-Y",strtotime($RS->fields['adddt'])));

                                    

                                  ######## Cek again for password injection ##########
                                 
                                  if ($fix_password != $password){
                                        $var=$_SESSION['rnd1'];
                                        logLogin("LOGIN","$_POST[username]","FAILED PASSWORD");
                                        
                                        header("location: login?status=$var&id=1");
                                        die();
                                  }
                                 
                                  ########  CHECK account status Active or inactive =======
                                  if ($fix_status == 0){
                                        logLogin("LOGIN","$_POST[username]","FAILED INACTIVE");
                                        header('location: temp_session_login?status=inactive');
                                        die();
                                  }
                                  
                                    $_SESSION['USERNAME']       =$fix_username;
                                    $_SESSION['STATUS_ACCOUNT'] =$fix_status;
                                    $_SESSION['PASSWORD']       = $fix_password;
                                    $_SESSION['GROUP_USER']     = $fix_group_user;
                                    $_SESSION['EMAIL']          = $fix_email;
                                    $_SESSION['NAMALENGKAP']    = $fix_namalengkap;
                                    //$_SESSION['IMAGE']          = $fix_image;
                                    $_SESSION['JOIN']           = $fix_join_date;
                                    
                                    //update FailedLogin=0 once in user table 
                                    //refreshFailedLogin();
                                    logActivity("LOGIN","SUCCESS");
                                    //die();
                                    header("location: home");


                             } else {
                            
                                $var=$_SESSION['rnd1'];
                                //update FailedLogin+1 in user table 
                                //updateFailedLogin($_POST['username']);
                                logLogin("login","$_POST[username]","FAILED USER OR PASSWORD");
                                header("location: login?status=$var&id=2");

                                 } // else not found


        }else{
            $var=$_SESSION['rnd4'];
            //logLogin("login","empty user or password","username or password empty");
        }  //end isset post username


?>
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.5
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?= constant("TITLE_APP");?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #5 for " name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="assets/pages/css/login-4.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="images/icon.png" />  </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.html">
                <img src="images/logo.png" alt="" width="150" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="login" method="post">
                <h1 class="form-title"><b>My Apps</b></h1>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any username and password. </span>
                </div>
                <?php

        if ( isset ($_GET['message']) && ($_GET['message'])=="success_act")
        {
        echo "<div class='alert alert-success'></button><span> <i>Akun Anda Sudah Aktif ...!</i> </span></div>";
        }

        if ( isset ($_GET['message']) && ($_GET['message'])=="success_reg")
        {
        echo "<div class='alert alert-success'></button><span> <i>Registrasi Berhasil, cek Email Untuk Aktivasi Akun...!</i> </span></div>";
        }

        if ( isset ($_GET['message']) && ($_GET['message'])=="error11")
        {
        echo "<div class='alert alert-danger'></button><span> <i>Registrasi Gagal...!</i> </span></div>";
        }

        if ( isset ($_GET['message']) && ($_GET['message'])=="error12")
        {
        echo "<div class='alert alert-danger'></button><span> <i>Akun Sudah Terdaftar ...!</i> </span></div>";
        }


        if ( isset ($_GET['status']) && ($_GET['status'])=="$_SESSION[rnd1]")
        {
        echo "<div class='alert alert-danger'></button><span> <i>username or password is wrong...!</i> </span></div>";
        }
        if ( isset ($_GET['status']) && ($_GET['status'])=="$_SESSION[rnd2]")
        {
        echo "<div class='alert alert-danger'></button><span> <i> User Is Expired Please Contact Administrator...!</i> </span></div>";
       // die();
        }
         if ( isset ($_GET['status']) && ($_GET['status'])=="$_SESSION[rnd3]")
        {
        echo "<div class='alert alert-danger'></button><span> <i> failed 3 times login, your account has been blocked  ...!</i> </span></div>";
        }
        if ( isset ($_GET['status']) && ($_GET['status'])=="$_SESSION[rnd4]")
        {
        echo "<div class='alert alert-danger'></button><span> <i> Empty Username or Password  ...!</i> </span></div>";
        }


        ?>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" /> </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
                </div>
                <div class="form-actions">
                    <!-- <label class="rememberme mt-checkbox mt-checkbox-outline">
                        <input type="checkbox" name="remember" value="1" /> Remember me
                        <span></span>
                    </label> -->
                    <button type="submit" class="btn green pull-right"> Login </button>
                </div>

                <div class="create-account">
                    
                </div>
            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
<!--             <form class="forget-form" action="index.html" method="post">
                <h3>Forget Password ?</h3>
                <p> Enter your e-mail address below to reset your password. </p>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn red btn-outline">Back </button>
                    <button type="submit" class="btn green pull-right"> Submit </button>
                </div>
            </form> -->
            <!-- END FORGOT PASSWORD FORM -->
            <!-- BEGIN REGISTRATION FORM -->
            
            <!-- END REGISTRATION FORM -->
        </div>
        <!-- END LOGIN -->
        <!-- BEGIN COPYRIGHT -->
        <div class="copyright"> 2020 &copy; My Application. </div>
        <!-- END COPYRIGHT -->
        <!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<script src="assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/pages/scripts/login-4.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>
    </body>

</html>