<?php
$module=$_GET['module'];
$pm=$_GET['pm'];
$page_tmp = $_SERVER['PHP_SELF']."?module=$module&pm=$pm";
$page=str_replace(".php","",$page_tmp);

###########################################################

$rec=getDataProfile($_SESSION['USERNAME']);

/*print_r("<pre>");
print_r($rec);
print_r("</pre>");*/



?>


<div class="page-content">
                    <!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        
                        <div class="m-heading-1 border-green m-bordered">
                                     <h1> <i class="fa fa-home"></i> My Profile</h1> 

                                     <p> Profile user</p> 
                                        <!-- <a class="btn red btn-outline" href="http://jqueryvalidation.org"
                                            target="_blank">the official documentation</a> -->
                                    
                                </div>
                        <!-- Sidebar Toggle Button -->
                       
                        <!-- Sidebar Toggle Button -->
                    </div>





                    <!-- END BREADCRUMBS -->
                    <!-- BEGIN SIDEBAR CONTENT LAYOUT -->
                    <div class="page-content-container">
                        <div class="page-content-row">
                            <!-- BEGIN PAGE SIDEBAR -->
                          
                            <!-- END PAGE SIDEBAR -->
                            <div class="page-content-col">
                                <!-- BEGIN PAGE BASE CONTENT -->
                                
                            
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- BEGIN VALIDATION STATES-->
                                       
                                            <div class="portlet light grey-steel bordered ">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-settings font-red"></i>
                                                    <span class="caption-subject font-red sbold uppercase">Information User</span>
                                                </div>
                                                
                                            </div>
                                            <div class="portlet-body">
                                                <!-- <div class="col-lg-3 col-md-6">
                            <div class="portlet light">
                                
                            </div>
                        </div> -->
                        <div class="profile-usermenu">
                                        <ul class="nav">
                                            <li class="active">
                                                    <!--<i class="fa fa-user-md"></i> <?=$_SESSION['NAMALENGKAP']?> -->
                                                     
                                                    <i class="icon-user"></i> <?=$rec['nama_lengkap']?> 
                                            </li>
                                            <br>
                                            <li>
                                                
                                                    <i class="icon-settings"></i> <?=getGroupUserName()?> 
                                            </li>
                                            <br>
                                            <li>
                                                
                                                    <i class="icon-envelope-open "></i> <?=$rec['email']?>
                                            </li>
                                            
                                            <br>
                                            <li>
                                                    <i class="icon-size-actual "></i> Join In <?=date("d-m-Y",strtotime($rec['adddt']))?> 
                                            </li>
                                            <br>
                                            <li>
                                                
                                                    <i class="icon-clock"></i> Last Login <?=lastLogin($_SESSION['USERNAME'])?>
                                            </li>
                                        </ul>
                                    </div>
                                                
                                                
                                                
                                                
                                                
                                                
                                            </div>
                                            
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                <!-- END PAGE BASE CONTENT -->
                            </div>
                        </div>
                    </div>
                    <!-- END SIDEBAR CONTENT LAYOUT -->
                
                </div>



               <!--  <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script> -->