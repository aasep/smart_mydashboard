<?php
session_start();
  require_once "../library/adodb5/adodb.inc.php";
	require_once '../config/config.php';
	require_once '../function/function.php';
	require_once '../session_login.php';

error_reporting(-1);


date_default_timezone_set("Asia/Jakarta");
#######################################################################################################################################
#################################################    ADD USER   #######################################################################
#######################################################################################################################################
    if (($_GET['module'])==sha1('2') && ($_GET['act']=='add_user')){

          $username=strtolower($_POST['username']);
          $password=hashEncrypted($_POST['password']);
          $status_account=$_POST['status'];
          $group_user=$_POST['group_user'];
          $namalengkap=$_POST['nama_lengkap'];
          $email=trim($_POST['email']);
          //$nim=trim($_POST['nim']);

          #############  CEK ALREADY USER  #########################

          $SQLcek =" SELECT * FROM smart_user_account where username='$username' ";
          $RScek  = $db->Execute($SQLcek);
          $found  = $RScek->Rowcount();

          if($found==0){

                        //###################  INSERT USER   ################//

                      $SQL =" INSERT INTO smart_user_account (username,password,nama_lengkap,email,groupid,status, ";
                      $SQL.=" adddt,addby) ";
                      $SQL.=" VALUES('$username','$password','$namalengkap','$email','$group_user','$status_account', ";
                      $SQL.=" current_timestamp,'".trim(getUsername())."') ";

                       /*echo $SQL;
                       die();*/
                      $RS  = $db->Execute($SQL);

                      if ($RS !=false){ 

                                logActivity("ADD USER","MENU=2, username=$username,password=$password,groupid=$group_user,email=$email,namalengkap=$namalengkap,status=$status_account,UserIDAction=".getUsername());
                        
                                $from='adm@mydashboard.co.id';
                                $subject=' Notifikasi Account User ';
                                $message =" <b>Notifikasi Email User Aplikasi ".constant("TITLE_APP")." </b> <br>";
                                $message.=" ############################################################################ <br><br>";
                                $message.=" Selamat Anda telah berhasil membuat Akun Baru dengan identitas sbb: <br>";
                                $message.=" Username : <b>$username</b> <br>"; 
                                $message.=" Password : $_POST[password] <br>"; 
                                $message.=" <br><br><br><br>"; 
                                //$message.=" Untuk Login Klik Link Berikut : <a href='http://10.5.19.69:81/projectdulu.co.id/login'> Login </a><br>";
                                $message.=" </i> *catatan: anda bisa mengganti password anda sewaktu-waktu </i><br><br>";
                                $message.=" <br><br><br><br>"; 
                                $message.=" ---------------------------------- <br>";
                                $message.=" PT. Smartfren Telecom, Tbk <br>";
                                $message.=" <b>Admin Projectdulu System</b> <br>";
                                $message.=" <i>Email : adm@mydashboard.co.id </i> <br>";
                                
                                $headers = 'From: '.$from. "\r\n" .
                                      'Reply-To: '.$from . "\r\n" .
                                      'X-Mailer: PHP/' . phpversion(). "\r\n";
                                $headers .= 'MIME-Version: 1.0' . "\r\n";
                                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                                mail($email, $subject, $message, $headers);
                                header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                        } else  {
                                logActivity("FAILED QUERY ADD USER","MENU=2, username=$username,password=$password,groupid=$group_user,email=$email,namalengkap=$namalengkap,status=$status_account,UserIDAction=".getUsername());
                                header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");
                            }

          }else{
                      logActivity("FAILED ALREADY EXIST USER","MENU=2, username=$username,password=$password,groupid=$group_user,email=$email,namalengkap=$namalengkap,status=$status_account,UserIDAction=".getUsername());
                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1&var=$username");
            }
    }
#######################################################################################################################################
#################################################    UPDATE USER   ####################################################################
#######################################################################################################################################
          if (($_GET['module'])==sha1('2') && ($_GET['act']=='edit_user')){


                      $ed_username=$_POST['username'];
                      $ed_status_account=$_POST['status'];
                      $ed_group_user=$_POST['group_user'];
                      $ed_nama_lengkap=$_POST['nama_lengkap'];
                      $ed_email=$_POST['email'];
                      
                      $ed_password=$_POST['password'];

                          if (isset($ed_password) && $ed_password!="" ){
                                $password=hashEncrypted($ed_password);
                                $var_password=" ,password='$password' ";
                                $flag_pass=1;
                          } else {
                                $var_password=" ";
                                $flag_pass=0;
                              }


                      $query =" UPDATE smart_user_account SET groupid='$ed_group_user', email='$ed_email', nama_lengkap='$ed_nama_lengkap', ";
                      $query.=" status='$ed_status_account'  $var_password WHERE  username='$ed_username' ";
                     //echo $query;
                     // die();
                      $RS  = $db->Execute($query);
        
                    	if ($RS != false ){
                            if ($flag_pass=='1'){
                                $from='adm@mydashboard.co.id';
                                $subject=' Notifikasi Update Password ';
                                $message =" <b>Notifikasi Update Password User Aplikasi ".constant("TITLE_APP")."</b> <br>";
                                $message.=" ############################################################################ <br><br>";
                                $message.=" Selamat Anda telah berhasil mengupdate password dg identitas sbb: <br>";
                                $message.=" Username : <b>$ed_username</b> <br>"; 
                                $message.=" Password : $_POST[password] <br>"; 
                                $message.=" <br><br><br><br>"; 
                               /* $message.=" Untuk Login Klik Link Berikut : <a href='http://localhost:81/PSAK71/login'> Login </a><br>";*/
                                $message.=" </i> *catatan: anda bisa mengganti password anda sewaktu-waktu </i><br><br>";
                                $message.=" <br><br><br><br>"; 
                                $message.=" ---------------------------------- <br>";
                                $message.=" PT. Smartfren Telecom, Tbk  <br>";
                                $message.=" <b>Admin Projectdulu System</b> <br>";
                                $message.=" <i>Email : adm@mydashboard.co.id </i> <br>";
                                $headers = 'From: '.$from. "\r\n" .
                                      'Reply-To: '.$from . "\r\n" .
                                      'X-Mailer: PHP/' . phpversion(). "\r\n";
                                $headers .= 'MIME-Version: 1.0' . "\r\n";
                                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                                mail($ed_email, $subject, $message, $headers);
                            }


                      			logActivity("EDIT USER","MENU=2, groupid=$ed_group_user, email=$ed_email, namalengkap=$ed_nama_lengkap, status=$ed_status_account,updateby=".getUsername()." $var_password ");
                      			header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success3");
                      } else  {
                      			header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error3");

                      		}


          }
#######################################################################################################################################
#################################################    DELETE USER   ####################################################################
#######################################################################################################################################
          
          if (($_GET['module'])==sha1('2') && ($_GET['act']=='delete_user')){

                    $username=strtolower($_POST['username']);
                    $SQL=" DELETE from smart_user_account where username='$username' ";
                    $RS  = $db->Execute($SQL);
                    //$result=odbc_exec($connection, $query);

                    if ($RS != false)
                      		{ 
                      			logActivity("DELETE USER","MENU=2,username=$username, MENU=2");
                      			header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success2");
                      	} else  {
                           logActivity("FAILED DELETE USER","MENU=2,username=$username, MENU=2");
                      			header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error2");

                      		}



          }

#######################################################################################################################################
####################################################### ADD MENU ######################################################################
#######################################################################################################################################

    if (($_GET['module'])==sha1('3') && ($_GET['act']=='add_menu')){


            $nama_menu=trim($_POST['name']);
            $address=trim($_POST['address']);
            $parent=$_POST['parent'];

            $query =" INSERT INTO smart_menu (menuname,parentmenu,address,adddt,addby,src,icon) values ('$nama_menu','$parent','$address',current_timestamp, ";
            $query.=" '$_SESSION[USERNAME]','-','icon-settings')  ";

            $RS  = $db->Execute($query);
            //$latest_id = $db->insert_id; 
/*
            if ( $RS->fields['idmenu'] !="" ){

                            $id_menu=$RS->fields['idmenu'];
                            $id_menu_encrypt=sha1($id_menu);
                            if ($parent != 0) {
                                $query3=" UPDATE menu set src='$id_menu_encrypt' where idmenu='$id_menu' ";
                                $RS2  = $db->Execute($query3);
                            }

            } else {

                    logActivity("FAILED ADD MENU","MENU=5, menuname=$nama_menu,parent=$parent");
                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");
                }
*/


           /* echo $RS->fields['idmenu'];
            die();*/
           
            $query2=" SELECT * from smart_menu where menuname='$nama_menu' and parentmenu='$parent' ";
            $RS2  = $db->Execute($query2);
            $num_menu=$RS2->Rowcount();

            if ($num_menu =='1' ){

                            $id_menu=$RS2->fields['idmenu'];
                            $id_menu_encrypt=sha1($RS2->fields['idmenu']);
                            $parent=$RS2->fields['parentmenu'];
                            if ($parent != 0) {
                                $query3=" UPDATE smart_menu set src='$id_menu_encrypt' where idmenu='$id_menu' ";
                                $RS3  = $db->Execute($query3);
                            }
                    logActivity("ADD MENU","MENU=3, menuname=$nama_menu,parent=$parent,idmenu=$id_menu");
                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");

            } else {

                    logActivity("FAILED ADD MENU","MENU=5, menuname=$nama_menu,parent=$parent");
                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");
                }

            





/*

            	if (($RS != false))
              		{
                    logActivity("ADD MENU","MENU=5, menuname=$nama_menu,parent=$parent,idmenu=$id_menu");
              			header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
              } else  {
                    logActivity("FAILED ADD MENU","MENU=5, menuname=$nama_menu,parent=$parent");
              			header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");

              	}
*/

    }

#######################################################################################################################################
####################################################### EDIT MENU #####################################################################
#######################################################################################################################################

        if (($_GET['module'])==sha1('3') && ($_GET['act']=='edit_menu')){


        $id_menu=$_POST['idmenu'];
        $ed_address=trim($_POST['address']);
        $parent=$_POST['parent'];
        $nama_menu=$_POST['name'];


        $query=" UPDATE smart_menu set   menuname='$nama_menu',parentmenu='$parent',address='$ed_address' where  idmenu='$id_menu'";
        $RS=$db->Execute($query);

        	if ($RS !=false)
          		{
          			logActivity("EDIT MENU","MENU=5,menuname=$nama_menu,parentmenu=$parent,idmenu=$id_menu");
          			header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success3");
          	} else  {
                logActivity("FAILED EDIT MENU","MENU=5,menuname=$nama_menu,parentmenu=$parent,idmenu=$id_menu");
          			header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error3");

          		}


        }
#######################################################################################################################################
####################################################### DELETE MENU ###################################################################
#######################################################################################################################################

        if (($_GET['module'])==sha1('3') && ($_GET['act']=='delete_menu')){
        $id_menu=$_POST['idmenu'];
        $query=" DELETE from smart_menu where idmenu='$id_menu'";
        $RS=$db->Execute($query);

        if ($RS !=false)
          		{	logActivity("DELETE MENU","MENU=5, idmenu=$id_menu");
          			header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success2");
          	} else  {
          			header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error2");

          		}


        }

#######################################################################################################################################
################################################# ADD GROUP USER ######################################################################
#######################################################################################################################################

            if (($_GET['module'])==sha1('4') && ($_GET['act']=='add_group_user')){

                    $nama_group=trim($_POST['name']);
                    $inisial=trim($_POST['inisial']);
                

                    ############   Query CEK BEFORE INSERT   ###########################################
                    $SQLcek=" SELECT * FROM  smart_group_user WHERE groupname='$nama_group'  ";
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount();
                    ############   END CHECK   ###################################################
                    if ($found ==0 ){

                              $query =" INSERT into smart_group_user (groupname,inisial,adddt,addby) values ('$nama_group',";
                              $query.=" '$inisial',current_timestamp,'$_SESSION[USERNAME]')";
                              $RS  = $db->Execute($query);

                              if ($RS != false)
                                  {
                                    logActivity("ADD GROUP USER","MENU=4, groupname=$nama_group,inisial=$inisial ");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                                } else  {
                                    logActivity("FAILED ADD GROUP USER","MENU=4, groupname=$nama_group,inisial=$inisial ");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");

                                  }


                    }else{

                                  logActivity("ALREADY EXIST GROUP USER","MENU=4, groupname=$nama_group,inisial=$inisial");
                                  header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1&var=$nama_group ");


                    }
            }
#######################################################################################################################################
################################################# UPDATE GROUP USER ###################################################################
#######################################################################################################################################

            if (($_GET['module'])==sha1('4') && ($_GET['act']=='edit_group_user')){
                    $groupid=trim($_POST['groupid']);
                    $nama_group=trim($_POST['name']);
                    $inisial=trim($_POST['inisial']);

                    ############   Query CEK BEFORE INSERT   ###########################################
                    $SQLcek=" SELECT * FROM  smart_group_user WHERE groupid='$groupid'  ";
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount();
                    ############   END CHECK   ###################################################
                    if ($found ==1 ){
                              $query =" UPDATE  smart_group_user set groupname='$nama_group',inisial='$inisial',updatedt=current_timestamp, ";
                              $query.=" updateby='$_SESSION[USERNAME]' WHERE groupid='$groupid' "; 
                              $RS  = $db->Execute($query);

                                if ($RS !=false)
                                    {
                                      logActivity("EDIT GROUP MENU","MENU=4, groupname=$nama_group,inisial=$inisial");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success3");
                                } else  {
                                      logActivity("FAILED EDIT GROUP MENU","MENU=4, groupname=$nama_group,inisial=$inisial");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error3");
                                    }
                    }else{


                                    logActivity("ALREADY EXIST GROUP USER","MENU=4, groupname=$nama_group,inisial=$inisial");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1&var=$nama_group ");


                    }



            }
#######################################################################################################################################
################################################# DELETE GROUP USER ###################################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('4') && ($_GET['act']=='delete_group_user')){


                    $groupid=$_POST['groupid'];
                    $query=" DELETE FROM smart_group_user where groupid='$groupid'";
                    $RS  = $db->Execute($query);
                    //echo $query;
                    //die();


                    if ($RS !=false)
                          {
                            logActivity("DELETE GROUP USER","MENU=4, groupid=$groupid");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success2");
                    } else  {
                            logActivity("FAILED DELETE GROUP USER","MENU=4, groupid=$groupid");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error2");

                        }


            }




#######################################################################################################################################
################################################# ADD DIVISION MASTER #################################################################
#######################################################################################################################################

            if (($_GET['module'])==sha1('14') && ($_GET['act']=='add_division')){

                    $divname=trim($_POST['name']);
                    $flag=trim($_POST['flag']);
                    ############   Query CEK BEFORE INSERT   ###########################################
                    $SQLcek=" SELECT * FROM  division WHERE divname='$divname'  ";
                    
                   // echo $SQLcek."<br>";
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount();
                    ############   END CHECK   ###################################################
                    if ($found ==0 ){

                              $query =" INSERT into division (divname,flag,adddt,addby) values ('$divname','$flag', ";
                              $query.=" current_timestamp,'$_SESSION[USERNAME]')";
                             // echo $query."<br>";
                             // die();
                              $RS  = $db->Execute($query);

                              if ($RS != false)
                                  {
                                    logActivity("ADD DIVISION","MENU=14, divname=$divname");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                                } else  {
                                    logActivity("FAILED ADD DIVISION","MENU=14, divname=$divname");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");

                                  }


                    }else{

                                  logActivity("ALREADY EXIST DIVISION","MENU=14, divname=$divname");
                                  header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1&var=$divname ");


                    }
            }
#######################################################################################################################################
################################################# UPDATE DIVISION   ###################################################################
#######################################################################################################################################

            if (($_GET['module'])==sha1('14') && ($_GET['act']=='edit_division')){
                    $divid=trim($_POST['divid']);
                    $divname=trim($_POST['name']);
                    $ed_flag=trim($_POST['ed_flag']);
                    ############   Query CEK BEFORE INSERT   ###########################################
                    $SQLcek=" SELECT * FROM  division WHERE divid='$divid'  ";
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount(); 
                    ############   END CHECK   ###################################################
                    if ($found ==1 ){
                              $query =" UPDATE  division set divname='$divname',flag='$ed_flag' ";
                              $query.=" WHERE divid='$divid' "; 
 
                             /* echo $query;
                              die();*/
                              $RS  = $db->Execute($query);

                                if ($RS !=false)
                                    {
                                      logActivity("EDIT DIVISION","MENU=14, divname=$divname,divname=$divname");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success3");
                                } else  {
                                      logActivity("FAILED EDIT DIVISION","MENU=14, divname=$divname,divname=$divname");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error3");
                                    }
                    }else{


                                    logActivity("ALREADY EXIST DIVISION","MENU=14, divname=$divname,divname=$divname");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1&var=$divname ");


                    }



            }
#######################################################################################################################################
################################################# DELETE DIVISION   ###################################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('14') && ($_GET['act']=='delete_division')){

                    $divid=$_POST['divid'];
                    $query=" DELETE FROM division where divid='$divid'";
                    $RS  = $db->Execute($query);
                    //echo $query;
                    //die();


                    if ($RS !=false)
                          {
                            logActivity("DELETE DIVISION","MENU=14, divid=$divid");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success2");
                    } else  {
                            logActivity("FAILED DIVISION","MENU=14, divid=$divid");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error2");

                        }


            }



#######################################################################################################################################
################################################# ADD DOSEN #################################################################
#######################################################################################################################################

            if (($_GET['module'])==sha1('15') && ($_GET['act']=='add_dosen')){

                    $nama_dosen=trim($_POST['name']);
                    $dosenid=trim($_POST['nik']);
                    $division=trim($_POST['division']);

                    ############   Query CEK BEFORE INSERT   ###########################################
                    $SQLcek=" SELECT * FROM  master_dosen WHERE dosenid='$dosenid'  ";
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount();
                    ############   END CHECK   ###################################################
                    if ($found ==0 ){

                              $query =" INSERT into master_dosen (dosenid,dosen_name,divid,adddt,addby) values ('$dosenid',";
                              $query.=" '$nama_dosen','$division',current_timestamp,'$_SESSION[USERNAME]')";
                              $RS  = $db->Execute($query);

                              if ($RS != false)
                                  {
                                    logActivity("ADD DOSEN","MENU=15, dosenid=$dosenid,dosen_name=$nama_dosen");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                                } else  {
                                    logActivity("FAILED ADD DOSEN","MENU=15, dosenid=$dosenid,dosen_name=$nama_dosen");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");

                                  }


                    }else{

                                  logActivity("ALREADY EXIST DOSEN","MENU=15, dosenid=$dosenid,dosen_name=$nama_dosen");
                                  header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1&var=$dosenid ");


                    }
            }
#######################################################################################################################################
################################################# UPDATE DOSEN   ###################################################################
#######################################################################################################################################

            if (($_GET['module'])==sha1('15') && ($_GET['act']=='edit_dosen')){
                    $nama_dosen=trim($_POST['name']);
                    $dosenid=trim($_POST['nik']);
                    $division=trim($_POST['division']);

                    ############   Query CEK BEFORE INSERT   ###########################################
                    $SQLcek=" SELECT * FROM  master_dosen WHERE dosenid='$dosenid'  ";
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount(); 
                    ############   END CHECK   ###################################################
                    if ($found ==1 ){
                              $query =" UPDATE  master_dosen set dosen_name='$nama_dosen', divid='$division' ";
                              $query.=" WHERE dosenid='$dosenid' "; 

                             /* echo $query;
                              die();*/
                              $RS  = $db->Execute($query);

                                if ($RS !=false)
                                    {
                                      logActivity("EDIT DOSEN","MENU=15, dosen_name=$nama_dosen,divid=$division");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success3");
                                } else  {
                                      logActivity("FAILED EDIT DOSEN","MENU=15, dosen_name=$nama_dosen,divid=$division");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error3");
                                    }
                    }else{


                                    logActivity("ALREADY EXIST DOSEN","MENU=15, dosen_name=$nama_dosen,divid=$division");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1&var=$dosenid ");


                    }



            }
#######################################################################################################################################
################################################# DELETE DOSEN   ###################################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('15') && ($_GET['act']=='delete_dosen')){

                    $dosenid=$_POST['dosenid'];
                    $query=" DELETE FROM master_dosen where dosenid='$dosenid'";
                    $RS  = $db->Execute($query);
                    //echo $query;
                    //die();


                    if ($RS !=false)
                          {
                            logActivity("DELETE DOSEN","MENU=15, dosenid=$dosenid");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success2");
                    } else  {
                            logActivity("FAILED DOSEN","MENU=15, dosenid=$dosenid");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error2");

                        }


            }

#######################################################################################################################################
################################################# REKAM MEDIK   ###################################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('13') && ($_GET['act']=='rekam_medik')){



                                                       
$age         = $_POST['age'];                                                        
$nama_pasien = $_POST['nama_pasien'];
$no_rm       = $_POST['no_rm'];                                              
$sex         = $_POST['sex'];
$division    = $_POST['division'];                                                
$diagnosis   = $_POST['diagnosis'];
$management  = $_POST['management'];
$consultant  = $_POST['consultant'];


/*$file_img    = $_POST['file_img'];
$file_img2   = $_POST['file_img2'];*/
$image_temp1=$_FILES['file_img']['tmp_name'];
$image_temp2=$_FILES['file_img2']['tmp_name'];
echo $image_temp1."<br>";
echo $image_temp2."<br>";
        if(isset($_FILES['file_img']['tmp_name']) && $_FILES['file_img']['tmp_name']!="" && $_FILES['file_img']['tmp_name']!=NULL){
              $image_temp1=$_FILES['file_img']['tmp_name'];
              $nama1=$_FILES['file_img']['name'];
              $type1=$_FILES['file_img']['type'];
              $ext1 = pathinfo($nama1, PATHINFO_EXTENSION);

              //echo $ext1."<br>";
          }
        if(isset($_FILES['file_img2']['tmp_name']) && $_FILES['file_img2']['tmp_name']!="" && $_FILES['file_img2']['tmp_name']!=NULL){
              $image_temp2=$_FILES['file_img2']['tmp_name'];
              $nama2=$_FILES['file_img2']['name'];
              $type2=$_FILES['file_img2']['type'];
              $ext2 = pathinfo($nama2, PATHINFO_EXTENSION);
              //echo $ext2."<br>";
          }

         
//die();

  $query =" insert into rekam_medik (username,no_rek_medis,nama_pasien,alamat,sex,age,divid,diagnosis,management,id_dosen,before_img,before_ket, ";
  $query.=" after_img,after_ket,nilai,komentar,field1,field2,field3,tgl_komentar,adddt,addby) ";
  $query.=" values('$_SESSION[USERNAME]','$no_rm','$nama_pasien','alamat','$sex','$age','$division','$diagnosis','$management','$consultant', ";
  $query.=" 'before_img','before_ket','after_img','after_ket','-','','field1','field2','field3',current_timestamp,current_timestamp,'$_SESSION[USERNAME]') ";
  $query.=" returning rek_id ";


/*echo $query;
die();*/
  $RS  = $db->Execute($query);
  $image_name = $RS->fields['rek_id'];
    if ($RS !=false){

        $directory1="../images/img_pict1/".$image_name.".$ext1";
        $directory2="../images/img_pict2/".$image_name.".$ext2";
        copy($image_temp1,$directory1);
        copy($image_temp2,$directory2);

        $query2 = " update rekam_medik set before_img='$image_name.$ext1',after_img='$image_name.$ext2' where rek_id='".$RS->fields['rek_id']."' ";
        $RS2    = $db->Execute($query2);
 }




                    if ($RS !=false)
                          {
                            logActivity("ADD REKAM MEDIK","MENU=13, rek_id=$image_name");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                    } else  {
                            logActivity("FAILED REKAM MEDIK","MENU=13, rek_id=$image_name");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");

                        }


            }
#######################################################################################################################################
####################################################### PENILAIAN DOSEN ###############################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('16') && ($_GET['act']=='penilaian_rm')){


                    $rek_id=trim($_POST['rek_id']);
                    $recomendation=trim($_POST['recomendation']);
                    $nilai=trim($_POST['nilai']);

                    ############   Query CEK BEFORE INSERT   ###########################################
                    $SQLcek=" SELECT * FROM  rekam_medik WHERE rek_id='$rek_id'  ";
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount(); 
                    ############   END CHECK   ###################################################
                    if ($found ==1 ){
                              $query =" UPDATE  rekam_medik set nilai='$nilai', komentar='$recomendation', status='1', tgl_komentar=current_timestamp ";
                              $query.=" WHERE rek_id='$rek_id' "; 

                             /* echo $query;
                              die();*/
                              $RS  = $db->Execute($query);

                                if ($RS !=false)
                                    {
                                      logActivity("ADD NILAI","MENU=16, nilai=$nilai, komentar=$recomendation, status=1 , rek_id=$rek_id ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                                } else  {
                                      logActivity("FAILED ADD NILAI","MENU=16, nilai=$nilai, komentar=$recomendation, status=1 , rek_id=$rek_id ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");
                                    }
                    }else{


                                    logActivity("DATA NOT FOUND","MENU=16, nilai=$nilai, komentar=$recomendation, status=1 , rek_id=$rek_id ");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1");


                    }



            }
            

#######################################################################################################################################
####################################################### PENILAIAN DOSEN ###############################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('18') && ($_GET['act']=='penilaian_ki')){


                    $id_kg=trim($_POST['id_kg']);
                    $feedback=trim($_POST['$feedback']);
                    $nilai=trim($_POST['nilai']);

                    ############   Query CEK BEFORE INSERT   ###########################################
                    $SQLcek=" SELECT * FROM  kegiatan_ilmiah  WHERE id_kg='$id_kg'  ";
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount(); 
                    ############   END CHECK   ###################################################
                    if ($found ==1 ){
                              $query =" UPDATE  kegiatan_ilmiah set nilai='$nilai', feedback='feedback', status='1' ";
                              $query.=" WHERE id_kg='$id_kg' "; 

                              ///echo $query;
                              //die();
                              $RS  = $db->Execute($query);

                                if ($RS !=false)
                                    {
                                      logActivity("ADD NILAI KI","MENU=18, nilai=$nilai, feedback=feedback, status=1 , id_kg=id_kg ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                                } else  {
                                      logActivity("FAILED ADD NILAI KI ","MENU=18, nilai=$nilai, feedback=feedback, status=1 , id_kg=id_kg ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");
                                    }
                    }else{


                                    logActivity("DATA NOT FOUND","MENU=18, nilai=$nilai, id_kg=id_kg, status=1 , id_kg=id_kg ");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1");


                    }



            }
            
#######################################################################################################################################
################################################# REKAM MEDIK   ###################################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('17') && ($_GET['act']=='kegiatan_ilmiah')){



                                                       
    $tanggal         = $_POST['tanggal'];                                                        
    $judul            = $_POST['judul'];
    $division        = $_POST['division'];
    $consultant      = $_POST['consultant'];



//die();

  $query =" insert into kegiatan_ilmiah (username,tgl_ki,judul_ki,divid,id_dosen, ";
  $query.=" adddt,addby)";
  $query.=" values('$_SESSION[USERNAME]','$tanggal','$judul','$division','$consultant', ";
  $query.=" current_timestamp,'$_SESSION[USERNAME]') ";
  //$query.=" returning id_kg ";


//echo $query;
//die();
  $RS  = $db->Execute($query);

                    if ($RS !=false)
                          {
                            logActivity("ADD KEG ILMIAH ","MENU=17, rek_id=$image_name");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                    } else  {
                            logActivity("ADD KEG ILMIAH","MENU=17, rek_id=$image_name");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");

                        }


            }            

#######################################################################################################################################
################################################# REKAM MEDIK   ###################################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('17') && ($_GET['act']=='edit_ki')){







                                                       
$tanggal      = date('Y-m-d',strtotime($_POST['tgl_ki']));                                                        
$judul_ki       = $_POST['judul_ki'];
$divid        = $_POST['division'];
$id_dosen     = $_POST['nmconsultant'];
$id_kg        = $_POST['id_kg'];


//die();

  $query =" update kegiatan_ilmiah  set tgl_ki='$tanggal',judul_ki='$judul_ki',divid='$divid',id_dosen='$id_dosen' ";
  $query.=" where id_kg='$id_kg' ";
  //$query.=" returning id_kg ";


//echo $query;
//die();
  $RS  = $db->Execute($query);

                    if ($RS !=false)
                          {
                            logActivity("EDIT KEG ILMIAH ","MENU=17, id_kg=$id_kg");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success3");
                    } else  {
                            logActivity("EDIT KEG ILMIAH","MENU=17, id_kg=$id_kg");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error3");

                        }


            }            
#######################################################################################################################################
################################################# DELETE KEGIATAN ILMIAH   ############################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('17') && ($_GET['act']=='delete_ki')){

                    $id_kg=$_POST['id_kg'];
                    $query=" DELETE FROM kegiatan_ilmiah where id_kg='$id_kg'";
                    $RS  = $db->Execute($query);
                    //echo $query;
                    //die();


                    if ($RS !=false)
                          {
                            logActivity("DELETE KEGIATAN ILMIAH","MENU=17, id_kg=$id_kg ");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success2");
                    } else  {
                            logActivity("FAILED KEGIATAN ILMIAH","MENU=17, id_kg=$id_kg ");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error2");

                        }


            }            




#######################################################################################################################################
################################################# ADD MASTER MAHASISWA ################################################################
#######################################################################################################################################

            if (($_GET['module'])==sha1('19') && ($_GET['act']=='add_mhs')){

                    $nim=trim($_POST['nim']);
                    $nama_lengkap=trim($_POST['nama_lengkap']);
                    $thn_periode=trim($_POST['thn_periode']);
                    $bln_periode=trim($_POST['bln_periode']);
                    $alamat=trim($_POST['alamat']);
                    $email=trim($_POST['email']);

                    ############   Query CEK BEFORE INSERT   ###########################################
                    $SQLcek=" SELECT * FROM  master_mhs WHERE nim='$nim'  ";
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount();
                    ############   END CHECK   ###################################################
                    if ($found ==0 ){

                              $query =" INSERT into master_mhs (nim,nama_lengkap,email,thn_periode,bln_periode,alamat,adddt,addby) values ('$nim',";
                              $query.=" '$nama_lengkap','$email','$thn_periode','$bln_periode','$alamat',current_timestamp,'$_SESSION[USERNAME]')";
                             // echo  $query;
                              //die();
                              $RS  = $db->Execute($query);

                              if ($RS != false)
                                  {
                                    logActivity("ADD MHS","MENU=19, nim=$nim,nama_lengkap=$nama_lengkap");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                                } else  {
                                    logActivity("FAILED ADD MHS","MENU=19, nim=$nim,nama_lengkap=$nama_lengkap");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");

                                  }


                    }else{

                                  logActivity("ALREADY EXIST MHS","MENU=19, nim=$nim,nama_lengkap=$nama_lengkap");
                                  header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1&var=$nim ");


                    }
            }          

#######################################################################################################################################
################################################# UPDATE MHS   ########################################################################
#######################################################################################################################################

            if (($_GET['module'])==sha1('19') && ($_GET['act']=='edit_mhs')){
                    $nim=trim($_POST['ed_nim']);
                    $nama_lengkap=trim($_POST['ed_nama_lengkap']);
                    $email=trim($_POST['ed_email']);
                    $thn_periode=trim($_POST['ed_thn_periode']);
                    $bln_periode=trim($_POST['ed_bln_periode']);
                    
                    ############   Query CEK BEFORE INSERT   ###########################################
                    $SQLcek=" SELECT * FROM  master_mhs WHERE nim='$nim'  ";
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount(); 
                    ############   END CHECK   ###################################################
                    if ($found ==1 ){
                              $query =" UPDATE  master_mhs set nama_lengkap='$nama_lengkap', email='$email', ";
                              $query.=" thn_periode='$thn_periode',bln_periode='$bln_periode' "; 
                              $query.=" WHERE nim='$nim' "; 
                            

                             /* echo $query;
                              die();*/
                              $RS  = $db->Execute($query);

                                if ($RS !=false)
                                    {
                                      logActivity("EDIT MHS","MENU=19, nama_lengkap=$nama_lengkap,email=$email,thn_periode=$thn_periode,bln_periode=$bln_periode");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success3");
                                } else  {
                                      logActivity("FAILED EDIT MHS","MENU=19, nama_lengkap=$nama_lengkap,email=$email,thn_periode=$thn_periode,bln_periode=$bln_periode");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error3");
                                    }
                    }else{


                                    logActivity("ALREADY EXIST MHS","MENU=19, nama_lengkap=$nama_lengkap,email=$email,thn_periode=$thn_periode,bln_periode=$bln_periode");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1&var=$nim ");


                    }



            }            
            
#######################################################################################################################################
#################################################    DELETE MHS     ###################################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('19') && ($_GET['act']=='delete_mhs')){

                    $nim=$_POST['nim'];
                    $query=" DELETE FROM master_mhs where nim='$nim'";
                    $RS  = $db->Execute($query);
                    //echo $query;
                    //die();


                    if ($RS !=false)
                          {
                            logActivity("DELETE MHS","MENU=19, nim=$nim ");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success2");
                    } else  {
                            logActivity("FAILED MHS","MENU=19, nim=$nim ");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error2");

                        }


            }            

#######################################################################################################################################
################################################# ADD KELOMPOK BANGSAL ################################################################
#######################################################################################################################################

            if (($_GET['module'])==sha1('24') && ($_GET['act']=='add_kelompok')){

                    $nama_kelompok=trim($_POST['nama_kelompok']);
                    $division=trim($_POST['division']);
                    $thn_periode=trim($_POST['thn_periode']);
                    $bln_periode=trim($_POST['bln_periode']);
                   

                    ############   Query CEK BEFORE INSERT   ###########################################
                    $SQLcek=" SELECT * FROM  kelompok_bangsal WHERE nama_kelompok='$nama_kelompok'  ";
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount();
                    ############   END CHECK   ###################################################
                    if ($found ==0 ){

                              $query =" INSERT into kelompok_bangsal (nama_kelompok,divid,thn_periode,bln_periode,status,adddt,addby) values (";
                              $query.=" '$nama_kelompok','$division','$thn_periode','$bln_periode','0',current_timestamp,'$_SESSION[USERNAME]')";
                              // echo  $query;
                              // die();
                              $RS  = $db->Execute($query);

                              if ($RS != false)
                                  {
                                    logActivity("ADD KELOMPOK","MENU=24, nama_kelompok=$nama_kelompok,divid=$divid,thn_periode=$thn_periode,bln_periode=$bln_periode");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                                } else  {
                                    logActivity("FAILED ADD KELOMPOK","MENU=24, nama_kelompok=$nama_kelompok,divid=$divid,thn_periode=$thn_periode,bln_periode=$bln_periode");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");

                                  }


                    }else{

                                  logActivity("ALREADY EXIST KELOMPOK","MENU=24, nama_kelompok=$nama_kelompok,divid=$divid,thn_periode=$thn_periode,bln_periode=$bln_periode");
                                  header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1&var=$nama_kelompok ");


                    }
            } 

#######################################################################################################################################
################################################# UPDATE KELOMPOK   ###################################################################
#######################################################################################################################################

            if (($_GET['module'])==sha1('24') && ($_GET['act']=='edit_kelompok')){
                    
                    $id_kelompok=trim($_POST['ed_id_kelompok']);
                    if (isset($_POST['ed_nama_kelompok_new']) && $_POST['ed_nama_kelompok_new']!="" ){
                      $nama_kelompok=trim($_POST['ed_nama_kelompok_new']);
                    }else{
                      $nama_kelompok=trim($_POST['ed_nama_kelompok_old']);
                    }
                    
                    $division=trim($_POST['ed_division']);
                    $thn_periode=trim($_POST['ed_thn_periode']);
                    $bln_periode=trim($_POST['ed_bln_periode']);
                    $status=trim($_POST['ed_status']);
                    ############   Query CEK BEFORE UPDATE   ###########################################
                    $SQLcek=" SELECT * FROM  kelompok_bangsal WHERE id_kelompok='$id_kelompok'  ";
                    // echo $SQLcek;
                    //         die();
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount();
     
                    ############   END CHECK   ###################################################
                    if ($found ==1 ){
                              $query =" UPDATE kelompok_bangsal set nama_kelompok='$nama_kelompok', status='$status', divid='$division', ";
                              $query.=" thn_periode='$thn_periode',bln_periode='$bln_periode' "; 
                              $query.=" WHERE id_kelompok='$id_kelompok' "; 
                            

                              // echo $query;
                              // die();
                              $RS  = $db->Execute($query);

                                if ($RS !=false)
                                    {
                                      logActivity("EDIT KELOMPOK","MENU=24, nama_kelompok=$nama_kelompok, status=$status,thn_periode=$thn_periode,bln_periode=$bln_periode");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success3");
                                } else  {
                                      logActivity("FAILED EDIT KELOMPOK","MENU=24, nama_kelompok=$nama_kelompok, status=$status, thn_periode=$thn_periode,bln_periode=$bln_periode");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error3");
                                    }
                    }else{


                                    logActivity("DOSENT ALREADY EXIST KELOMPOK","MENU=24, nama_kelompok=$nama_kelompok, status=$status, thn_periode=$thn_periode,bln_periode=$bln_periode");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error3&var=$nama_kelompok ");


                    }



            }            

#######################################################################################################################################
#################################################    DELETE KELOMPOK     ##############################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('24') && ($_GET['act']=='delete_kelompok')){

                    $id_kelompok=$_POST['id_kelompok'];
                    $query=" DELETE FROM kelompok_bangsal where id_kelompok='$id_kelompok'";
                    $RS  = $db->Execute($query);
                    //echo $query;
                    //die();


                    if ($RS !=false)
                          {
                            logActivity("DELETE KELOMPOK","MENU=24, id_kelompok=$id_kelompok ");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success2");
                    } else  {
                            logActivity("FAILED KELOMPOK","MENU=24, id_kelompok=$id_kelompok ");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error2");

                        }


            } 
#######################################################################################################################################
#################################################    ADD MEMBER     ###################################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('25') && ($_GET['act']=='add_member')){

/*                  print_r("<pre>");
                  print_r($_POST["member"]);
                  print_r("</pre>");*/

                  $jml_member=count($_POST["member"]);
                  $id_kelompok=trim($_POST['id_kelompok']);
                  $mynim="";

                  if($jml_member < 0 ){

                        header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=empty_list");

                  }else {

                      for ($i=0; $i < $jml_member ; $i++) { 


                        $mynim.=$_POST["member"][$i].",";

                        $query =" INSERT into anggota_kelompok (id_kelompok,nim,adddt,addby) values (";
                        $query.=" '$id_kelompok','".$_POST["member"][$i]."',current_timestamp,'$_SESSION[USERNAME]')";
                              // echo  $query;
                              // die();
                              $RS  = $db->Execute($query);


                        
                      }

                       if ($RS != false)
                                  {
                                    logActivity("ADD MEMBER","MENU=25, id_kelompok=$id_kelompok,nim=$mynim");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                                } else  {
                                    logActivity("FAILED ADD MEMBER","MENU=25, id_kelompok=$id_kelompok,nim=$mynim");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");

                                  }


                  }




            }  
#######################################################################################################################################
#################################################    DELETE MEMBER     ##############################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('25') && ($_GET['act']=='delete_member')){

                    $id_kelompok=$_POST['id_kelompok'];
                    $nim=$_POST['nim'];

                    $query=" DELETE FROM anggota_kelompok where id_kelompok='$id_kelompok' AND nim='$nim'";
/*                    echo $query;
                    die();*/
                    $RS  = $db->Execute($query);
                    //echo $query;
                    //die();


                    if ($RS !=false)
                          {
                            logActivity("DELETE MEMBER","MENU=25, id_kelompok=$id_kelompok, nim=$nim ");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success2");
                    } else  {
                            logActivity("FAILED MEMBER","MENU=25, id_kelompok=$id_kelompok, nim=$nim ");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error2");

                        }


            } 

#######################################################################################################################################
################################################# REKAM MEDIK   ###################################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('20') && ($_GET['act']=='ass_bangsal')){
                                                  
                  $no_rm            = trim($_POST['no_rm']);                                                        
                  $nama_pasien      = $_POST['nama_pasien'];
                  $tgl_lahir        = $_POST['tgl_lahir'];                                              
                  $division         = $_POST['division'];
                  $consultant       = $_POST['consultant'];                                                
                  $diagnosis        = $_POST['diagnosis'];
                  $tindakan         = $_POST['tindakan'];
                  $tgl_tindakan     = $_POST['tgl_tindakan'];
                  $id_kelompok      = $_POST['id_kelompok'];
                  $nama_kelompok    = namaKelompok($id_kelompok);
                  $asal_bangsal     = $_POST['asal_bangsal'];

                  if ($asal_bangsal=="Lainnya"){
                    $asal_bangsal=$_POST['asal_bangsal_txt'];
                  }

                  ############   Query CEK NO REKAM MEDIK  ###########################################
                    $SQLcek=" SELECT * FROM  assessment_bangsal WHERE no_rekammedik='$no_rm'  ";
                    // echo $SQLcek;
                    //         die();
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount();

                    if($found>=1){
                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error5&var=$no_rm");
                      die();
                    }



                  $all_nim="";

                  $q_getmember=" select * from anggota_kelompok where id_kelompok='$id_kelompok' ";
                  /*echo $q_getmember;
                            die();*/
                  $RS_MEMBER  = $db->Execute($q_getmember);
                      while(!$RS_MEMBER->EOF){
                            $all_nim.=$RS_MEMBER->fields['nim'].",";
                            $query =" insert into assessment_bangsal ( nama_kelompok,nama_pasien,no_rekammedik,diagnosis,tindakan, ";
                            $query.=" tgl_tindakan,id_dosen,divid,username,status,tgl_lahir,asal_bangsal,adddt,addby) values ('$nama_kelompok', ";
                            $query.=" '$nama_pasien','$no_rm','$diagnosis','$tindakan','$tgl_tindakan','$consultant','$division', ";
                            $query.=" '".$RS_MEMBER->fields['nim']."','0','$tgl_lahir','$asal_bangsal',current_timestamp,'$_SESSION[USERNAME]') ";
                            //$query.=" returning assb ";
/*                            echo $query;
                            die();*/
                            $RS  = $db->Execute($query);


                                                                    
                          $RS_MEMBER->MoveNext();
                      }

                    if ($RS !=false)
                          {
                            logActivity("ASS BANGSAL","MENU=20, nama_kelompok=$nama_kelompok,nim=$all_nim,divid=$division");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                    } else  {
                            logActivity("FAILED ASS BANGSAL","MENU=20, nama_kelompok=$nama_kelompok,nim=$all_nim,divid=$division");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");

                        }


            }

#######################################################################################################################################
################################################# REKAM MEDIK   ###################################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('20') && ($_GET['act']=='edit_ass_bangsal')){
                                                  
                  $no_rm            = trim($_POST['ed_no_rm']);                                                        
                  $nama_pasien      = trim($_POST['ed_nama_pasien']);
                  $tgl_lahir        = trim($_POST['ed_tgl_lahir']);                                              
                  $division         = trim($_POST['ed_division']);
                  $consultant       = trim($_POST['ed_consultant']);                                                
                  $diagnosis        = trim($_POST['ed_diagnosis']);
                  $tindakan         = trim($_POST['ed_tindakan']);
                  $tgl_tindakan     = trim($_POST['ed_tgl_tindakan']);
                  $id_kelompok      = trim($_POST['ed_id_kelompok']);
                  $nama_kelompok    = namaKelompok($id_kelompok);
             
                  $asal_bangsal     = $_POST['ed_asal_bangsal'];

                  if ($asal_bangsal=="Lainnya"){
                    $asal_bangsal=$_POST['ed_asal_bangsal_txt'];
                  }
                  //$all_nim="";

                 ############   Query CEK BEFORE UPDATE   ###########################################
                    $SQLcek =" SELECT * FROM  assessment_bangsal WHERE no_rekammedik='$no_rm' ";
                    $SQLcek.=" and status='0'   ";
                    // echo $SQLcek;
                    //         die();
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount();

                                       ############   END CHECK   ###################################################
                    if ($found >=1 ){
                              $query =" UPDATE assessment_bangsal set nama_pasien='$nama_pasien',tgl_lahir='$tgl_lahir', ";
                              $query.=" divid='$division',id_dosen='$consultant',tindakan='$tindakan',diagnosis='$diagnosis', "; 
                              $query.=" tgl_tindakan='$tgl_tindakan',nama_kelompok='$nama_kelompok', asal_bangsal='$asal_bangsal' "; 
                              $query.=" WHERE no_rekammedik='$no_rm' and status='0' "; 
                            

                              // echo $query;
                              // die();
                              $RS  = $db->Execute($query);

                                if ($RS !=false)
                                    {
                                      logActivity("UPDATE ASS BANGSAL","MENU=20, nama_pasien=$nama_pasien,tgl_lahir=$tgl_lahir,divid=$division,id_dosen=$consultant,tindakan=$tindakan,diagnosis=$diagnosis,tgl_tindakan=$tgl_tindakan,nama_kelompok=$nama_kelompok");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success3");
                                } else  {
                                      logActivity("FAILED UPDATE ASS BANGSAL","MENU=20, nama_pasien=$nama_pasien,tgl_lahir=$tgl_lahir,divid=$division,id_dosen=$consultant,tindakan=$tindakan,diagnosis=$diagnosis,tgl_tindakan=$tgl_tindakan,nama_kelompok=$nama_kelompok");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error3");
                                    }
                    }else{


                                    logActivity("NOT FOUND ASSESSMENT","MENU=20, nama_pasien=$nama_pasien,tgl_lahir=$tgl_lahir,divid=$division,id_dosen=$consultant,tindakan=$tindakan,diagnosis=$diagnosis,tgl_tindakan=$tgl_tindakan,nama_kelompok=$nama_kelompok");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error4&var=$no_rm ");


                    } 





            }

#######################################################################################################################################
################################################# PENILAIAN ASS BANGSAL    ############################################################
#######################################################################################################################################

            if (($_GET['module'])==sha1('34') && ($_GET['act']=='nilai_ass_bangsal')){
                    

                    
                    $no_rekammedik=trim($_POST['no_rekmedik_rs']);
                    $feedback=trim($_POST['feedback']);
                    $nilai=trim($_POST['nilai']);                    
                    $id_kelompok=trim($_POST['ed_id_kelompok']); 
                  
                    
                    ############   Query CEK BEFORE UPDATE   ###########################################
                    $SQLcek =" SELECT * FROM  assessment_bangsal WHERE no_rekammedik='$no_rekammedik' ";
                    $SQLcek.=" and id_dosen='".getUsername()."' and status='0'   ";
                    // echo $SQLcek;
                    //         die();
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount();
     
                    ############   END CHECK   ###################################################
                    if ($found >=1 ){
                              $query =" UPDATE assessment_bangsal set nilai='$nilai', status='1', feedback='$feedback' ";
                              $query.=" WHERE no_rekammedik='$no_rekammedik' and id_dosen='".getUsername()."' and status='0' "; 
                            

                              // echo $query;
                              // die();
                              $RS  = $db->Execute($query);

                                if ($RS !=false)
                                    {
                                      //updateStatusKelompok($id_kelompok);
                                      logActivity("SUCCESS PENILAIAN ASS BANGSAL","MENU=34, no_rekammedik=$$no_rekammedik, nilai=$nilai,feedback=$feedback");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                                } else  {
                                      logActivity("FAILED PENILAIAN ASS BANGSAL","MENU=34, no_rekammedik=$$no_rekammedik, nilai=$nilai,feedback=$feedback");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");
                                    }
                    }else{


                                    logActivity("NOT FOUND ASSESSMENT","MENU=34, no_rekammedik=$$no_rekammedik, nilai=$nilai,feedback=$feedback");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1&var=$no_rekammedik ");


                    }



            }          


#######################################################################################################################################
################################################# REKAM OPERASI   #####################################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('35') && ($_GET['act']=='form_operasi')){

                  $no_rekammedik  = trim($_POST['no_rm']);                                                        
                  $nama_pasien    = trim($_POST['nama_pasien']);                                             
                  $sex            = trim($_POST['sex']);
                  $tgl_lahir      = date('Y-m-d',strtotime($_POST['tgl_lahir']));
                  $divid          = trim($_POST['division']);                                                
                  $id_dosen       = trim($_POST['consultant']);
                  $diagnosis      = trim($_POST['diagnosis']);
                  $data_pasien    = trim($_POST['data_pasien']);
                  $tindakan       = trim($_POST['tindakan']);                                                        
                  $tgl_tindakan   = date('Y-m-d',strtotime($_POST['tgl_tindakan']));
                  $tempat         = trim($_POST['tempat']);  
                  // Array --------------------------------------                                            
                  $p_asisten      = ($_POST['asisten']);
                  $p_operator     = ($_POST['operator']);                                                
                  $p_onloop       = ($_POST['onloop']);
/*
                    print_r("<pre>");
                    print_r($p_asisten);
                    print_r("</pre>");

                  die();  */

                   ############   Query CEK NO REKAM MEDIK  ###########################################
                    $SQLcek=" SELECT * FROM  rek_operasi_mhs WHERE no_rekammedik='$no_rekammedik'  ";
                    // echo $SQLcek;
                    //         die();
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount();

                    if($found>=1){
                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error5&var=$no_rekammedik");
                      die();
                    }



                  

                  if(isset($p_asisten)){
                    $jml_asisten    =count($_POST['asisten']);
                  }else{
                    $jml_asisten    =0;
                  }
                  if(isset($p_operator)){
                    $jml_operator   =count($_POST['operator']);
                  }else{
                    $jml_operator   =0;
                  }
                  if(isset($p_onloop)){
                    $jml_onloop     =count($_POST['onloop']);
                  }else{
                    $jml_onloop     =0;
                  }

                  $list_asisten ="";
                  for ($i=0; $i < $jml_asisten  ; $i++) { 

                    $koma = ($i==($jml_asisten-1)) ? "" : ",";
                    $list_asisten .=$_POST['asisten'][$i]."$koma";  
                  }
                  $list_operator ="";
                  for ($i=0; $i < $jml_operator  ; $i++) { 

                    $koma = ($i==($jml_operator-1)) ? "" : ",";
                    $list_operator .=$_POST['operator'][$i]."$koma";  
                  }
                  $list_onloop ="";
                  for ($i=0; $i < $jml_onloop  ; $i++) { 

                    $koma = ($i==($jml_onloop-1)) ? "" : ",";
                    $list_onloop .=$_POST['onloop'][$i]."$koma";  
                  }
                  // echo $list_asisten;
                  // die();

                  /*$file_img    = $_POST['file_img'];
                  $file_img2   = $_POST['file_img2'];*/
                  $image_temp1=$_FILES['file_img']['tmp_name'];
                  $image_temp2=$_FILES['file_img2']['tmp_name'];

                  $image_temp12=$_FILES['file_img12']['tmp_name'];
                  $image_temp22=$_FILES['file_img22']['tmp_name'];

                  $image_temp13=$_FILES['file_img13']['tmp_name'];
                  $image_temp23=$_FILES['file_img23']['tmp_name'];
                  // echo $image_temp1."<br>";
                  // echo $image_temp2."<br>";
                  if(isset($_FILES['file_img']['tmp_name']) && $_FILES['file_img']['tmp_name']!="" && $_FILES['file_img']['tmp_name']!=NULL){
                        $image_temp1=$_FILES['file_img']['tmp_name'];
                        $nama1=$_FILES['file_img']['name'];
                        $type1=$_FILES['file_img']['type'];
                        $ext1 = pathinfo($nama1, PATHINFO_EXTENSION);

                        //echo $ext1."<br>";
                      }
                  if(isset($_FILES['file_img2']['tmp_name']) && $_FILES['file_img2']['tmp_name']!="" && $_FILES['file_img2']['tmp_name']!=NULL){
                        $image_temp2=$_FILES['file_img2']['tmp_name'];
                        $nama2=$_FILES['file_img2']['name'];
                        $type2=$_FILES['file_img2']['type'];
                        $ext2 = pathinfo($nama2, PATHINFO_EXTENSION);
                        //echo $ext2."<br>";
                    }
//----------------------------------------------------------------------------------------------------

                  if(isset($_FILES['file_img12']['tmp_name']) && $_FILES['file_img12']['tmp_name']!="" && $_FILES['file_img12']['tmp_name']!=NULL){
                        $image_temp12=$_FILES['file_img12']['tmp_name'];
                        $nama12=$_FILES['file_img12']['name'];
                        $type12=$_FILES['file_img12']['type'];
                        $ext12 = pathinfo($nama12, PATHINFO_EXTENSION);

                        //echo $ext1."<br>";
                      }
                  if(isset($_FILES['file_img22']['tmp_name']) && $_FILES['file_img22']['tmp_name']!="" && $_FILES['file_img22']['tmp_name']!=NULL){
                        $image_temp22=$_FILES['file_img22']['tmp_name'];
                        $nama22=$_FILES['file_img22']['name'];
                        $type22=$_FILES['file_img22']['type'];
                        $ext22 = pathinfo($nama22, PATHINFO_EXTENSION);
                        //echo $ext2."<br>";
                    }

//----------------------------------------------------------------------------------------------------
                  if(isset($_FILES['file_img13']['tmp_name']) && $_FILES['file_img13']['tmp_name']!="" && $_FILES['file_img13']['tmp_name']!=NULL){
                        $image_temp13=$_FILES['file_img13']['tmp_name'];
                        $nama13=$_FILES['file_img13']['name'];
                        $type13=$_FILES['file_img13']['type'];
                        $ext13 = pathinfo($nama13, PATHINFO_EXTENSION);

                        //echo $ext1."<br>";
                      }
                  if(isset($_FILES['file_img23']['tmp_name']) && $_FILES['file_img23']['tmp_name']!="" && $_FILES['file_img23']['tmp_name']!=NULL){
                        $image_temp23=$_FILES['file_img23']['tmp_name'];
                        $nama23=$_FILES['file_img23']['name'];
                        $type23=$_FILES['file_img23']['type'];
                        $ext23 = pathinfo($nama23, PATHINFO_EXTENSION);
                        //echo $ext2."<br>";
                    } 
//die();

/*                        $query =" insert into rek_operasi_mhs (username,no_rekammedik,nama_pasien,tgl_lahir,sex,diagnosis,tindakan,";
                        $query.=" tgl_tindakan,data_pasien,divid,id_dosen,p_asisten,p_operator,p_onloop,tempat,status,";
                        $query.=" before_img,before_ket,after_img,after_ket,adddt,addby) ";
                        $query.=" values('".getUsername()."','$no_rekammedik','$nama_pasien','$tgl_lahir','$sex','$diagnosis','$tindakan','$tgl_tindakan','$data_pasien',";     
                        $query.=" '$divid','$id_dosen','$list_asisten','$list_operator','$list_onloop','$tempat','0',";
                        $query.=" 'before_img','-','after_img','-',current_timestamp,'$_SESSION[USERNAME]')";
                        $query.=" returning id_operasi ";

                        $RS  = $db->Execute($query);
                        $image_name = $RS->fields['id_operasi'];
*/

/*
                        $query =" insert into rek_operasi_mhs (username,no_rekammedik,nama_pasien,tgl_lahir,sex,diagnosis,tindakan,";
                        $query.=" tgl_tindakan,data_pasien,divid,id_dosen,p_asisten,p_operator,p_onloop,tempat,status,";
                        $query.=" before_img,before_ket,after_img,after_ket,adddt,addby) ";
                        $query.=" values('".getUsername()."','$no_rekammedik','$nama_pasien','$tgl_lahir','$sex','$diagnosis','$tindakan','$tgl_tindakan','$data_pasien',";     
                        $query.=" '$divid','$id_dosen','$list_asisten','$list_operator','$list_onloop','$tempat','0',";
                        $query.=" 'before_img','-','after_img','-',current_timestamp,'$_SESSION[USERNAME]')";
                        $query.=" returning id_operasi ";

                        $RS  = $db->Execute($query);
                        $image_name = $RS->fields['id_operasi'];*/


                        //----------  for asisten -------------------------------------------------
                        for ($i=0; $i < $jml_asisten  ; $i++) { 
                        $querya =" insert into rek_operasi_mhs (username,no_rekammedik,nama_pasien,tgl_lahir,sex,diagnosis,tindakan,";
                        $querya.=" tgl_tindakan,data_pasien,divid,id_dosen,p_asisten,p_operator,p_onloop,tempat,status,";
                        $querya.=" before_img,before_ket,after_img,after_ket,adddt,addby) ";
                        $querya.=" values('".$_POST['asisten'][$i]."','$no_rekammedik','$nama_pasien','$tgl_lahir','$sex','$diagnosis','$tindakan','$tgl_tindakan','$data_pasien',";     
                        $querya.=" '$divid','$id_dosen','$list_asisten','$list_operator','$list_onloop','$tempat','0',";
                        $querya.=" '','-','','-',current_timestamp,'$_SESSION[USERNAME]')";
                        $querya.=" returning id_operasi ";


                         /*echo "----------asisten----------- <br>";
                         echo $querya."<br>";*/




                        $RSa  = $db->Execute($querya);
                        $image_name = $RSa->fields['id_operasi'];


                       
/*                            $querya =" insert into rek_operasi (username,no_rekammedik,nama_pasien,tgl_lahir,sex,diagnosis,tindakan,";
                            $querya.=" tgl_tindakan,data_pasien,divid,id_dosen,p_asisten,p_operator,p_onloop,tempat,status,";
                            $querya.=" before_img,before_ket,after_img,after_ket,adddt,addby) ";
                            $querya.=" values('".$_POST['asisten'][$i]."','$no_rekammedik','$nama_pasien','$tgl_lahir','$sex','$diagnosis','$tindakan','$tgl_tindakan','$data_pasien',";     
                            $querya.=" '$divid','$id_dosen','1','0','0','$tempat','0',";
                            $querya.=" '$image_name.$ext1','-','$image_name.$ext2','-',current_timestamp,'$_SESSION[USERNAME]')";*/

                           // $RSa  = $db->Execute($querya);
                        }

                        //----------  for operator ------------------------------------------------
                        for ($i=0; $i < $jml_operator  ; $i++) { 

                            $queryb =" insert into rek_operasi_mhs (username,no_rekammedik,nama_pasien,tgl_lahir,sex,diagnosis,tindakan,";
                            $queryb.=" tgl_tindakan,data_pasien,divid,id_dosen,p_asisten,p_operator,p_onloop,tempat,status,";
                            $queryb.=" before_img,before_ket,after_img,after_ket,adddt,addby) ";
                            $queryb.=" values('".$_POST['operator'][$i]."','$no_rekammedik','$nama_pasien','$tgl_lahir','$sex','$diagnosis','$tindakan','$tgl_tindakan','$data_pasien',";     
                            $queryb.=" '$divid','$id_dosen','$list_asisten','$list_operator','$list_onloop','$tempat','0',";
                            $queryb.=" '','-','','-',current_timestamp,'$_SESSION[USERNAME]')"; 

                           /* echo "----------operator----------- <br>";
                            echo $queryb."<br>";*/
                            $RSb  = $db->Execute($queryb);
                        }

                        //----------  for on loop  ------------------------------------------------
                        for ($i=0; $i < $jml_onloop  ; $i++) { 

                            $queryc =" insert into rek_operasi_mhs (username,no_rekammedik,nama_pasien,tgl_lahir,sex,diagnosis,tindakan,";
                            $queryc.=" tgl_tindakan,data_pasien,divid,id_dosen,p_asisten,p_operator,p_onloop,tempat,status,";
                            $queryc.=" before_img,before_ket,after_img,after_ket,adddt,addby) ";
                            $queryc.=" values('".$_POST['onloop'][$i]."','$no_rekammedik','$nama_pasien','$tgl_lahir','$sex','$diagnosis','$tindakan','$tgl_tindakan','$data_pasien',";     
                            $queryc.=" '$divid','$id_dosen','$list_asisten','$list_operator','$list_onloop','$tempat','0',";
                            $queryc.=" '','-','','-',current_timestamp,'$_SESSION[USERNAME]')"; 

                            /*echo "----------onloop----------- <br>";
                            echo $queryc."<br>";*/
                            $RSc  = $db->Execute($queryc);

                        }
/*echo $query;
die();*/                
                       // die();

                        if ($RSa !=false){

                            $directory1="../images/img_pict1/".$image_name.".$ext1";
                            $directory2="../images/img_pict2/".$image_name.".$ext2";
                            copy($image_temp1,$directory1);
                            copy($image_temp2,$directory2);

                            //-----------------------------------------------------
                            $directory12="../images/img_pict12/".$image_name.".$ext12";
                            $directory22="../images/img_pict22/".$image_name.".$ext22";
                            copy($image_temp12,$directory12);
                            copy($image_temp22,$directory22);
                            //-----------------------------------------------------
                            $directory13="../images/img_pict13/".$image_name.".$ext13";
                            $directory23="../images/img_pict23/".$image_name.".$ext23";
                            copy($image_temp13,$directory13);
                            copy($image_temp23,$directory23);

                            $query2 = " update rek_operasi_mhs set before_img='$image_name.$ext1',after_img='$image_name.$ext2',  ";
                            $query2.= " before_img12='$image_name.$ext12',after_img22='$image_name.$ext22', ";
                            $query2.= " before_img13='$image_name.$ext13',after_img23='$image_name.$ext23' ";
                            $query2.= " where no_rekammedik='".$no_rekammedik."' ";
                            $RS2    = $db->Execute($query2);
                        }




                        if ($RSa !=false)
                              {
                                logActivity("ADD OPERASI","MENU=35, id_operasi=$image_name");
                                header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                        } else  {
                                logActivity("FAILED OPERASI","MENU=35, id_operasi=$image_name");
                                header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");

                            }


            }            
#######################################################################################################################################
####################################################### EDIT OPERASI ###################################################################
#######################################################################################################################################

            if (($_GET['module'])==sha1('35') && ($_GET['act']=='form_edit_operasi')){
                  $id_operasi     = $_POST['id_operasi'];
                  $no_rekammedik  = trim($_POST['ed_no_rm']);                                                        
                  $nama_pasien    = trim($_POST['ed_nama_pasien']);                                             
                  $sex            = trim($_POST['sex']);
                  $tgl_lahir      = date('Y-m-d',strtotime($_POST['tgl_lahir']));
                  $divid          = trim($_POST['ed_division']);                                                
                  $id_dosen       = trim($_POST['ed_consultant']);
                  $diagnosis      = trim($_POST['ed_diagnosis']);
                  $data_pasien    = trim($_POST['data_pasien']);
                  $tindakan       = trim($_POST['ed_tindakan']);                                                        
                  $tgl_tindakan   = date('Y-m-d',strtotime($_POST['ed_tgl_tindakan']));
                  $tempat         = trim($_POST['tempat']);  
                  $image_name     = $_POST['id_operasi'];
                  // Array --------------------------------------                                            
                  $p_asisten      = ($_POST['asisten']);
                  $p_operator     = ($_POST['operator']);                                                
                  $p_onloop       = ($_POST['onloop']);

                  $rec=getRekOperasiMhs($id_operasi);

                  if(isset($p_asisten)){
                    $jml_asisten    =count($_POST['asisten']);
                  }else{
                    $jml_asisten    =0;
                  }
                  if(isset($p_operator)){
                    $jml_operator   =count($_POST['operator']);
                  }else{
                    $jml_operator   =0;
                  }
                  if(isset($p_onloop)){
                    $jml_onloop     =count($_POST['onloop']);
                  }else{
                    $jml_onloop     =0;
                  }

                  $list_asisten ="";
                  for ($i=0; $i < $jml_asisten  ; $i++) { 

                    $koma = ($i==($jml_asisten-1)) ? "" : ",";
                    $list_asisten .=$_POST['asisten'][$i]."$koma";  
                  }
                  $list_operator ="";
                  for ($i=0; $i < $jml_operator  ; $i++) { 

                    $koma = ($i==($jml_operator-1)) ? "" : ",";
                    $list_operator .=$_POST['operator'][$i]."$koma";  
                  }
                  $list_onloop ="";
                  for ($i=0; $i < $jml_onloop  ; $i++) { 

                    $koma = ($i==($jml_onloop-1)) ? "" : ",";
                    $list_onloop .=$_POST['onloop'][$i]."$koma";  
                  }
                  // echo $list_asisten;
                  // die();

                  /*$file_img    = $_POST['file_img'];
                  $file_img2   = $_POST['file_img2'];*/
                  $image_temp1=$_FILES['file_img']['tmp_name'];
                  $image_temp12=$_FILES['file_img12']['tmp_name'];
                  $image_temp13=$_FILES['file_img13']['tmp_name'];




                  $image_temp2=$_FILES['file_img2']['tmp_name'];
                  $image_temp22=$_FILES['file_img22']['tmp_name'];
                  $image_temp23=$_FILES['file_img23']['tmp_name'];
                  // echo $image_temp1."<br>";
                  // echo $image_temp2."<br>";
                  if(isset($_FILES['file_img']['tmp_name']) && $_FILES['file_img']['tmp_name']!="" && $_FILES['file_img']['tmp_name']!=NULL){
                        $image_temp1=$_FILES['file_img']['tmp_name'];
                        $nama1=$_FILES['file_img']['name'];
                        $type1=$_FILES['file_img']['type'];
                        $ext1 = pathinfo($nama1, PATHINFO_EXTENSION);

                        //echo $ext1."<br>";
                      }
                  if(isset($_FILES['file_img12']['tmp_name']) && $_FILES['file_img12']['tmp_name']!="" && $_FILES['file_img12']['tmp_name']!=NULL){
                        $image_temp12=$_FILES['file_img']['tmp_name'];
                        $nama12=$_FILES['file_img12']['name'];
                        $type12=$_FILES['file_img12']['type'];
                        $ext12 = pathinfo($nama12, PATHINFO_EXTENSION);

                        //echo $ext1."<br>";
                      }
                  if(isset($_FILES['file_img13']['tmp_name']) && $_FILES['file_img13']['tmp_name']!="" && $_FILES['file_img13']['tmp_name']!=NULL){
                        $image_temp13=$_FILES['file_img']['tmp_name'];
                        $nama13=$_FILES['file_img13']['name'];
                        $type13=$_FILES['file_img13']['type'];
                        $ext13 = pathinfo($nama13, PATHINFO_EXTENSION);

                        //echo $ext1."<br>";
                      }



                  if(isset($_FILES['file_img2']['tmp_name']) && $_FILES['file_img2']['tmp_name']!="" && $_FILES['file_img2']['tmp_name']!=NULL){
                        $image_temp2=$_FILES['file_img2']['tmp_name'];
                        $nama2=$_FILES['file_img2']['name'];
                        $type2=$_FILES['file_img2']['type'];
                        $ext2 = pathinfo($nama2, PATHINFO_EXTENSION);
                        //echo $ext2."<br>";
                    }
                  if(isset($_FILES['file_img22']['tmp_name']) && $_FILES['file_img22']['tmp_name']!="" && $_FILES['file_img22']['tmp_name']!=NULL){
                        $image_temp22=$_FILES['file_img22']['tmp_name'];
                        $nama22=$_FILES['file_img22']['name'];
                        $type22=$_FILES['file_img22']['type'];
                        $ext22 = pathinfo($nama22, PATHINFO_EXTENSION);
                        //echo $ext2."<br>";
                    }
                  if(isset($_FILES['file_img23']['tmp_name']) && $_FILES['file_img23']['tmp_name']!="" && $_FILES['file_img23']['tmp_name']!=NULL){
                        $image_temp23=$_FILES['file_img23']['tmp_name'];
                        $nama23=$_FILES['file_img23']['name'];
                        $type23=$_FILES['file_img23']['type'];
                        $ext23 = pathinfo($nama23, PATHINFO_EXTENSION);
                        //echo $ext2."<br>";
                    }

                    ############   Query CEK BEFORE UPDATE   ###########################################
                    $SQLcek =" SELECT * FROM  rek_operasi_mhs WHERE id_operasi='$id_operasi' and status='0' ";
                    // echo $SQLcek;
                    //         die();
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount();

                    ############   END CHECK   ###################################################
                    if ($found >=1 ){
                              $directory1="../images/img_pict1/".$image_name.".$ext1";
                              $directory12="../images/img_pict12/".$image_name.".$ext12";
                              $directory13="../images/img_pict13/".$image_name.".$ext13";



                              $directory2="../images/img_pict2/".$image_name.".$ext2";
                              $directory22="../images/img_pict22/".$image_name.".$ext22";
                              $directory23="../images/img_pict23/".$image_name.".$ext23";
                             // echo $directory1."<br>";
                             // echo $directory2."<br>";
                             // die();
                              unlink($directory1.$rec['before_img']);
                              unlink($directory12.$rec['before_img12']);
                              unlink($directory13.$rec['before_img13']);
                              copy($image_temp1,$directory1);
                              copy($image_temp12,$directory12);
                              copy($image_temp13,$directory13);

                              unlink($directory2.$rec['after_img']);
                              unlink($directory22.$rec['after_img22']);
                              unlink($directory23.$rec['after_img23']);
                              copy($image_temp2,$directory2);
                              copy($image_temp22,$directory22);
                              copy($image_temp23,$directory23);

                              $query =" UPDATE  rek_operasi_mhs  set nama_pasien='$nama_pasien', ";
                              $query.=" sex='$sex',tgl_lahir='$tgl_lahir',divid='$divid',id_dosen='$id_dosen',diagnosis='$diagnosis', "; 
                              $query.=" data_pasien='$data_pasien',tindakan='$tindakan',tgl_tindakan='$tgl_tindakan',tempat='$tempat', "; 
                              $query.=" before_img='$image_name.$ext1',before_img12='$image_name.$ext12',before_img13='$image_name.$ext13', "; 
                              $query.=" after_img='$image_name.$ext2',after_img22='$image_name.$ext22',after_img23='$image_name.$ext23' ";
                              $query.=" WHERE no_rekammedik='$no_rekammedik' and status='0' "; 
                              //$query.="  "; 

                              $RS  = $db->Execute($query);

                                if ($RS !=false)
                                    {
                                      logActivity("EDIT OPERASI","MENU=35, id_operasi=$id_operasi ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success3");
                                } else  {
                                      logActivity("FAILED EDIT OPERASI","MENU=35, id_operasi=$id_operasi ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error3");
                                    }



                    }else{


                                    logActivity("ALREADY EXIST OPERASI","MENU=35, id_operasi=$id_operasi");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1&var=$no_rekammedik ");

                    }


            }  

#######################################################################################################################################
#################################################    DELETE FORM OPERASI  #############################################################
#######################################################################################################################################
          
          if (($_GET['module'])==sha1('35') && ($_GET['act']=='delete_f_operasi')){

                    $no_rek_medis=trim($_POST['no_rek_medis']);
                    $SQL=" DELETE from rek_operasi_mhs where no_rekammedik='$no_rek_medis' ";
                    $RS  = $db->Execute($SQL);
                    //$result=odbc_exec($connection, $query);

                    if ($RS != false)
                          { 
                            logActivity("DELETE OPERASI","MENU=35,username=$username");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success2");
                        } else  {
                           logActivity("FAILED DELETE OPERASI","MENU=35,username=$username");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error2");

                          }



          }



#######################################################################################################################################
####################################################### PENILAIAN OPERASI #############################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('36') && ($_GET['act']=='penilaian_operasi')){


                    $id_operasi=trim($_POST['id_operasi']);
                    $komentar=trim($_POST['komentar']);
                    $nilai=trim($_POST['nilai']);
                    $no_rekammedik=trim($_POST['no_rekammedik12']);
                    

                    ############   Query CEK BEFORE INSERT   ###########################################
                    $SQLcek=" SELECT * FROM  rek_operasi_mhs WHERE no_rekammedik='$no_rekammedik' and status='0'  ";
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount(); 
                    ############   END CHECK   ###################################################
                    if ($found >=1 ){
                              $query =" UPDATE  rek_operasi_mhs set nilai='$nilai', komentar='$komentar', status='1', tgl_komentar=current_timestamp ";
                              $query.=" WHERE no_rekammedik='$no_rekammedik' "; 

                             /* echo $query;
                              die();*/
                              $RS  = $db->Execute($query);

                                if ($RS !=false)
                                    {
                                      logActivity("ADD NILAI OPERASI","MENU=36, nilai=$nilai, komentar=$komentar, status=1 , id_operasi=$id_operasi ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                                } else  {
                                      logActivity("FAILED ADD NILAI OPERASI","MENU=36, nilai=$nilai, komentar=$komentar, status=1 , id_operasi=$id_operasi ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");
                                    }
                    }else{


                                    logActivity("DATA NOT FOUND","MENU=36, nilai=$nilai, komentar=$komentar, status=1 , id_operasi=$id_operasi ");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1");


                    }



            }
#######################################################################################################################################
#######################################################    Update Profile User      ###################################################
#######################################################################################################################################
 
 if (($_GET['module'])==sha1('37') && ($_GET['act']=='edit_profile')){

                  $nama_lengkap   = trim($_POST['nama_lengkap']);   
                  $password1      = trim($_POST['password1']);                                             
                  $email          = trim($_POST['email']);
                  $iduser         = trim($_POST['iduserxy']);
                  $nim            = trim($_POST['nim']);



                    



                  $password1=trim($_POST['password1']);

                          if (isset($password1) && $password1!="" ){
                                $password=hashEncrypted($password1);
                                $var_password=" ,password='$password' ";
                                $flag_pass=1;
                          } else {
                                $var_password=" ";
                                $flag_pass=0;
                              }

                  $image_temp1=$_FILES['file_imgx']['tmp_name'];

                  if(isset($_FILES['file_imgx']['tmp_name']) && $_FILES['file_imgx']['tmp_name']!="" && $_FILES['file_imgx']['tmp_name']!=NULL){
                        $image_temp1=$_FILES['file_imgx']['tmp_name'];
                        $nama1=$_FILES['file_imgx']['name'];
                        $type1=$_FILES['file_imgx']['type'];
                        $ext1 = pathinfo($nama1, PATHINFO_EXTENSION);
                        $directory1="../images/profile/".$iduser.".$ext1";
                        $var_images= ", image = '$iduser.$ext1' ";

                        $rec=getImage2($_SESSION['USERNAME']);
                        unlink("../images/profile/".$rec['image']);
                        copy($image_temp1,$directory1);

                  }else{
                     $var_images= " ";
                  }

                  
                  $query =" UPDATE user_account set namalengkap='$nama_lengkap',email='$email',nik='$nim' $var_images $var_password ";
                  $query.=" where iduser='$iduser' ";
                  //echo $query;
                  //die();
                              $RS  = $db->Execute($query);

                                if ($RS !=false)
                                    {
                    if ($flag_pass=='1'){
                                $from='adm.@projectdulu.co.id';
                                $subject=' Notifikasi Update Password ';
                                $message =" <b>Notifikasi Update Password User Aplikasi ".constant("TITLE_APP")."</b> <br>";
                                $message.=" ############################################################################ <br><br>";
                                $message.=" Selamat Anda telah berhasil mengupdate password dg identitas sbb: <br>";
                                $message.=" Username : <b>".$_SESSION['USERNAME']."</b> <br>"; 
                                $message.=" Password : $password1 <br>"; 
                                $message.=" <br><br><br><br>"; 
                               /* $message.=" Untuk Login Klik Link Berikut : <a href='http://localhost:81/PSAK71/login'> Login </a><br>";*/
                                $message.=" </i> *catatan: anda bisa mengganti password anda sewaktu-waktu </i><br><br>";
                                $message.=" <br><br><br><br>"; 
                                $message.=" ---------------------------------- <br>";
                                $message.=" PT. Projectdulu, Tbk <br>";
                                $message.=" <b>Admin Projectdulu System</b> <br>";
                                $message.=" <i>Email : adm.@projectdulu.co.id </i> <br>";
                                $headers = 'From: '.$from. "\r\n" .
                                      'Reply-To: '.$from . "\r\n" .
                                      'X-Mailer: PHP/' . phpversion(). "\r\n";
                                $headers .= 'MIME-Version: 1.0' . "\r\n";
                                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                                mail(getEmail2($_SESSION['USERNAME']), $subject, $message, $headers);
                            }

                  
                                      logActivity("EDIT PROFILE","MENU=37, iduser=$iduser ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success3");
                                } else  {
                                      logActivity("FAILED EDIT PROFILE","MENU=37, iduser=$iduser ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error3");
                                    }







}



#######################################################################################################################################
################################################# REKAM ROTASI LUARKOTA    ############################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('45') && ($_GET['act']=='form_operasi')){
              //echo "ok";
              //die();

                  $no_rekammedik  = trim($_POST['no_rm']);                                                        
                  $nama_pasien    = trim($_POST['nama_pasien']);                                             
                  $sex            = trim($_POST['sex']);
                  $tgl_lahir      = date('Y-m-d',strtotime($_POST['tgl_lahir']));
                  $divid          = trim($_POST['division']);                                                
                  $id_dosen       = trim($_POST['consultant']);
                  $diagnosis      = trim($_POST['diagnosis']);
                  $data_pasien    = trim($_POST['data_pasien']);
                  $tindakan       = trim($_POST['tindakan']);                                                        
                  $tgl_tindakan   = date('Y-m-d',strtotime($_POST['tgl_tindakan']));
                  $tempat         = trim($_POST['tempat']);  
                  // Array --------------------------------------                                            
                  $p_asisten      = ($_POST['asisten']);
                  $p_operator     = ($_POST['operator']);                                                
                  $p_onloop       = ($_POST['onloop']);
/*
                    print_r("<pre>");
                    print_r($p_asisten);
                    print_r("</pre>");

                  die();  */

                   ############   Query CEK NO REKAM MEDIK  ###########################################
                    $SQLcek=" SELECT * FROM  rek_rotasi WHERE no_rekammedik='$no_rekammedik'  ";
                    // echo $SQLcek;
                    //         die();
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount();

                    if($found>=1){
                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error5&var=$no_rekammedik");
                      die();
                    }



                  

                  if(isset($p_asisten)){
                    $jml_asisten    =count($_POST['asisten']);
                  }else{
                    $jml_asisten    =0;
                  }
                  if(isset($p_operator)){
                    $jml_operator   =count($_POST['operator']);
                  }else{
                    $jml_operator   =0;
                  }
               /*   if(isset($p_onloop)){
                    $jml_onloop     =count($_POST['onloop']);
                  }else{
                    $jml_onloop     =0;
                  }*/

                  $list_asisten ="";
                  for ($i=0; $i < $jml_asisten  ; $i++) { 

                    $koma = ($i==($jml_asisten-1)) ? "" : ",";
                    $list_asisten .=$_POST['asisten'][$i]."$koma";  
                  }
                  $list_operator ="";
                  for ($i=0; $i < $jml_operator  ; $i++) { 

                    $koma = ($i==($jml_operator-1)) ? "" : ",";
                    $list_operator .=$_POST['operator'][$i]."$koma";  
                  }
                  //$list_onloop ="";
                 /* for ($i=0; $i < $jml_onloop  ; $i++) { 

                    $koma = ($i==($jml_onloop-1)) ? "" : ",";
                    $list_onloop .=$_POST['onloop'][$i]."$koma";  
                  }*/
                  // echo $list_asisten;
                  // die();

                  /*$file_img    = $_POST['file_img'];
                  $file_img2   = $_POST['file_img2'];*/
                  $image_temp1=$_FILES['file_img']['tmp_name'];
                  $image_temp2=$_FILES['file_img2']['tmp_name'];

                  $image_temp12=$_FILES['file_img12']['tmp_name'];
                  $image_temp22=$_FILES['file_img22']['tmp_name'];

                  $image_temp13=$_FILES['file_img13']['tmp_name'];
                  $image_temp23=$_FILES['file_img23']['tmp_name'];
                  // echo $image_temp1."<br>";
                  // echo $image_temp2."<br>";
                  if(isset($_FILES['file_img']['tmp_name']) && $_FILES['file_img']['tmp_name']!="" && $_FILES['file_img']['tmp_name']!=NULL){
                        $image_temp1=$_FILES['file_img']['tmp_name'];
                        $nama1=$_FILES['file_img']['name'];
                        $type1=$_FILES['file_img']['type'];
                        $ext1 = pathinfo($nama1, PATHINFO_EXTENSION);

                        //echo $ext1."<br>";
                      }
                  if(isset($_FILES['file_img2']['tmp_name']) && $_FILES['file_img2']['tmp_name']!="" && $_FILES['file_img2']['tmp_name']!=NULL){
                        $image_temp2=$_FILES['file_img2']['tmp_name'];
                        $nama2=$_FILES['file_img2']['name'];
                        $type2=$_FILES['file_img2']['type'];
                        $ext2 = pathinfo($nama2, PATHINFO_EXTENSION);
                        //echo $ext2."<br>";
                    }
//----------------------------------------------------------------------------------------------------

                  if(isset($_FILES['file_img12']['tmp_name']) && $_FILES['file_img12']['tmp_name']!="" && $_FILES['file_img12']['tmp_name']!=NULL){
                        $image_temp12=$_FILES['file_img12']['tmp_name'];
                        $nama12=$_FILES['file_img12']['name'];
                        $type12=$_FILES['file_img12']['type'];
                        $ext12 = pathinfo($nama12, PATHINFO_EXTENSION);

                        //echo $ext1."<br>";
                      }
                  if(isset($_FILES['file_img22']['tmp_name']) && $_FILES['file_img22']['tmp_name']!="" && $_FILES['file_img22']['tmp_name']!=NULL){
                        $image_temp22=$_FILES['file_img22']['tmp_name'];
                        $nama22=$_FILES['file_img22']['name'];
                        $type22=$_FILES['file_img22']['type'];
                        $ext22 = pathinfo($nama22, PATHINFO_EXTENSION);
                        //echo $ext2."<br>";
                    }

//----------------------------------------------------------------------------------------------------
                  if(isset($_FILES['file_img13']['tmp_name']) && $_FILES['file_img13']['tmp_name']!="" && $_FILES['file_img13']['tmp_name']!=NULL){
                        $image_temp13=$_FILES['file_img13']['tmp_name'];
                        $nama13=$_FILES['file_img13']['name'];
                        $type13=$_FILES['file_img13']['type'];
                        $ext13 = pathinfo($nama13, PATHINFO_EXTENSION);

                        //echo $ext1."<br>";
                      }
                  if(isset($_FILES['file_img23']['tmp_name']) && $_FILES['file_img23']['tmp_name']!="" && $_FILES['file_img23']['tmp_name']!=NULL){
                        $image_temp23=$_FILES['file_img23']['tmp_name'];
                        $nama23=$_FILES['file_img23']['name'];
                        $type23=$_FILES['file_img23']['type'];
                        $ext23 = pathinfo($nama23, PATHINFO_EXTENSION);
                        //echo $ext2."<br>";
                    } 
//die();

/*                        $query =" insert into rek_operasi_mhs (username,no_rekammedik,nama_pasien,tgl_lahir,sex,diagnosis,tindakan,";
                        $query.=" tgl_tindakan,data_pasien,divid,id_dosen,p_asisten,p_operator,p_onloop,tempat,status,";
                        $query.=" before_img,before_ket,after_img,after_ket,adddt,addby) ";
                        $query.=" values('".getUsername()."','$no_rekammedik','$nama_pasien','$tgl_lahir','$sex','$diagnosis','$tindakan','$tgl_tindakan','$data_pasien',";     
                        $query.=" '$divid','$id_dosen','$list_asisten','$list_operator','$list_onloop','$tempat','0',";
                        $query.=" 'before_img','-','after_img','-',current_timestamp,'$_SESSION[USERNAME]')";
                        $query.=" returning id_operasi ";

                        $RS  = $db->Execute($query);
                        $image_name = $RS->fields['id_operasi'];
*/

/*
                        $query =" insert into rek_operasi_mhs (username,no_rekammedik,nama_pasien,tgl_lahir,sex,diagnosis,tindakan,";
                        $query.=" tgl_tindakan,data_pasien,divid,id_dosen,p_asisten,p_operator,p_onloop,tempat,status,";
                        $query.=" before_img,before_ket,after_img,after_ket,adddt,addby) ";
                        $query.=" values('".getUsername()."','$no_rekammedik','$nama_pasien','$tgl_lahir','$sex','$diagnosis','$tindakan','$tgl_tindakan','$data_pasien',";     
                        $query.=" '$divid','$id_dosen','$list_asisten','$list_operator','$list_onloop','$tempat','0',";
                        $query.=" 'before_img','-','after_img','-',current_timestamp,'$_SESSION[USERNAME]')";
                        $query.=" returning id_operasi ";

                        $RS  = $db->Execute($query);
                        $image_name = $RS->fields['id_operasi'];*/


                        //----------  for asisten -------------------------------------------------
                        for ($i=0; $i < $jml_asisten  ; $i++) { 
                        $querya =" insert into rek_rotasi (username,no_rekammedik,nama_pasien,tgl_lahir,sex,diagnosis,tindakan,";
                        $querya.=" tgl_tindakan,data_pasien,divid,id_dosen,p_asisten,p_operator,p_onloop,tempat,status,";
                        $querya.=" before_img,before_ket,after_img,after_ket,adddt,addby) ";
                        $querya.=" values('".$_POST['asisten'][$i]."','$no_rekammedik','$nama_pasien','$tgl_lahir','$sex','$diagnosis','$tindakan','$tgl_tindakan','$data_pasien',";     
                        $querya.=" '$divid','$id_dosen','$list_asisten','$list_operator','$list_onloop','$tempat','0',";
                        $querya.=" '','-','','-',current_timestamp,'$_SESSION[USERNAME]')";
                        $querya.=" returning id_operasi ";


                         //echo "----------asisten----------- <br>";
                         //echo $querya."<br>";

                        // die();


                        $RSa  = $db->Execute($querya);
                        $image_name = $RSa->fields['id_operasi'];


                       
                        }

                        //----------  for operator ------------------------------------------------
                        for ($i=0; $i < $jml_operator  ; $i++) { 

                            $queryb =" insert into rek_rotasi (username,no_rekammedik,nama_pasien,tgl_lahir,sex,diagnosis,tindakan,";
                            $queryb.=" tgl_tindakan,data_pasien,divid,id_dosen,p_asisten,p_operator,p_onloop,tempat,status,";
                            $queryb.=" before_img,before_ket,after_img,after_ket,adddt,addby) ";
                            $queryb.=" values('".$_POST['operator'][$i]."','$no_rekammedik','$nama_pasien','$tgl_lahir','$sex','$diagnosis','$tindakan','$tgl_tindakan','$data_pasien',";     
                            $queryb.=" '$divid','$id_dosen','$list_asisten','$list_operator','$list_onloop','$tempat','0',";
                            $queryb.=" '','-','','-',current_timestamp,'$_SESSION[USERNAME]')"; 

                           //echo "----------operator----------- <br>";
                            //echo $queryb."<br>";
                            $RSb  = $db->Execute($queryb);
                        }

//die();

                        if ($RSa !=false){

                            $directory1="../images/rotasi1/".$image_name.".$ext1";
                            $directory2="../images/rotasi2/".$image_name.".$ext2";
                            copy($image_temp1,$directory1);
                            copy($image_temp2,$directory2);

                            //-----------------------------------------------------
                            $directory12="../images/rotasi12/".$image_name.".$ext12";
                            $directory22="../images/rotasi22/".$image_name.".$ext22";
                            copy($image_temp12,$directory12);
                            copy($image_temp22,$directory22);
                            //-----------------------------------------------------
                            $directory13="../images/rotasi13/".$image_name.".$ext13";
                            $directory23="../images/rotasi23/".$image_name.".$ext23";
                            copy($image_temp13,$directory13);
                            copy($image_temp23,$directory23);

                            $query2 = " update rek_rotasi set before_img='$image_name.$ext1',after_img='$image_name.$ext2',  ";
                            $query2.= " before_img12='$image_name.$ext12',after_img22='$image_name.$ext22', ";
                            $query2.= " before_img13='$image_name.$ext13',after_img23='$image_name.$ext23' ";
                            $query2.= " where no_rekammedik='".$no_rekammedik."' ";
                            $RS2    = $db->Execute($query2);
                        }




                        if ($RSa !=false)
                              {
                                logActivity("ADD ROTASI","MENU=45, id_operasi=$image_name");
                                header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                        } else  {
                                logActivity("FAILED ROTASI","MENU=45, id_operasi=$image_name");
                                header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");

                            }


            }  

#######################################################################################################################################
####################################################### EDIT ROTASI LUARKOTA ##########################################################
#######################################################################################################################################

            if (($_GET['module'])==sha1('45') && ($_GET['act']=='form_edit_operasi')){
                  $id_operasi     = $_POST['id_operasi'];
                  $no_rekammedik  = trim($_POST['ed_no_rm']);                                                        
                  $nama_pasien    = trim($_POST['ed_nama_pasien']);                                             
                  $sex            = trim($_POST['sex']);
                  $tgl_lahir      = date('Y-m-d',strtotime($_POST['tgl_lahir']));
                  $divid          = trim($_POST['ed_division']);                                                
                  $id_dosen       = trim($_POST['ed_consultant']);
                  $diagnosis      = trim($_POST['ed_diagnosis']);
                  $data_pasien    = trim($_POST['data_pasien']);
                  $tindakan       = trim($_POST['ed_tindakan']);                                                        
                  $tgl_tindakan   = date('Y-m-d',strtotime($_POST['ed_tgl_tindakan']));
                  $tempat         = trim($_POST['tempat']);  
                  $image_name     = $_POST['id_operasi'];
                  // Array --------------------------------------                                            
                  $p_asisten      = ($_POST['asisten']);
                  $p_operator     = ($_POST['operator']);                                                
                  $p_onloop       = ($_POST['onloop']);

                  $rec=getRekOperasiMhs($id_operasi);

                  if(isset($p_asisten)){
                    $jml_asisten    =count($_POST['asisten']);
                  }else{
                    $jml_asisten    =0;
                  }
                  if(isset($p_operator)){
                    $jml_operator   =count($_POST['operator']);
                  }else{
                    $jml_operator   =0;
                  }
                  /*if(isset($p_onloop)){
                    $jml_onloop     =count($_POST['onloop']);
                  }else{
                    $jml_onloop     =0;
                  }*/

                  $list_asisten ="";
                  for ($i=0; $i < $jml_asisten  ; $i++) { 

                    $koma = ($i==($jml_asisten-1)) ? "" : ",";
                    $list_asisten .=$_POST['asisten'][$i]."$koma";  
                  }
                  $list_operator ="";
                  for ($i=0; $i < $jml_operator  ; $i++) { 

                    $koma = ($i==($jml_operator-1)) ? "" : ",";
                    $list_operator .=$_POST['operator'][$i]."$koma";  
                  }
                  $list_onloop ="";
/*                  for ($i=0; $i < $jml_onloop  ; $i++) { 

                    $koma = ($i==($jml_onloop-1)) ? "" : ",";
                    $list_onloop .=$_POST['onloop'][$i]."$koma";  
                  }*/
                  // echo $list_asisten;
                  // die();

                  /*$file_img    = $_POST['file_img'];
                  $file_img2   = $_POST['file_img2'];*/
                  $image_temp1=$_FILES['file_img']['tmp_name'];
                  $image_temp12=$_FILES['file_img12']['tmp_name'];
                  $image_temp13=$_FILES['file_img13']['tmp_name'];




                  $image_temp2=$_FILES['file_img2']['tmp_name'];
                  $image_temp22=$_FILES['file_img22']['tmp_name'];
                  $image_temp23=$_FILES['file_img23']['tmp_name'];
                  // echo $image_temp1."<br>";
                  // echo $image_temp2."<br>";
                  if(isset($_FILES['file_img']['tmp_name']) && $_FILES['file_img']['tmp_name']!="" && $_FILES['file_img']['tmp_name']!=NULL){
                        $image_temp1=$_FILES['file_img']['tmp_name'];
                        $nama1=$_FILES['file_img']['name'];
                        $type1=$_FILES['file_img']['type'];
                        $ext1 = pathinfo($nama1, PATHINFO_EXTENSION);

                        //echo $ext1."<br>";
                      }
                  if(isset($_FILES['file_img12']['tmp_name']) && $_FILES['file_img12']['tmp_name']!="" && $_FILES['file_img12']['tmp_name']!=NULL){
                        $image_temp12=$_FILES['file_img']['tmp_name'];
                        $nama12=$_FILES['file_img12']['name'];
                        $type12=$_FILES['file_img12']['type'];
                        $ext12 = pathinfo($nama12, PATHINFO_EXTENSION);

                        //echo $ext1."<br>";
                      }
                  if(isset($_FILES['file_img13']['tmp_name']) && $_FILES['file_img13']['tmp_name']!="" && $_FILES['file_img13']['tmp_name']!=NULL){
                        $image_temp13=$_FILES['file_img']['tmp_name'];
                        $nama13=$_FILES['file_img13']['name'];
                        $type13=$_FILES['file_img13']['type'];
                        $ext13 = pathinfo($nama13, PATHINFO_EXTENSION);

                        //echo $ext1."<br>";
                      }



                  if(isset($_FILES['file_img2']['tmp_name']) && $_FILES['file_img2']['tmp_name']!="" && $_FILES['file_img2']['tmp_name']!=NULL){
                        $image_temp2=$_FILES['file_img2']['tmp_name'];
                        $nama2=$_FILES['file_img2']['name'];
                        $type2=$_FILES['file_img2']['type'];
                        $ext2 = pathinfo($nama2, PATHINFO_EXTENSION);
                        //echo $ext2."<br>";
                    }
                  if(isset($_FILES['file_img22']['tmp_name']) && $_FILES['file_img22']['tmp_name']!="" && $_FILES['file_img22']['tmp_name']!=NULL){
                        $image_temp22=$_FILES['file_img22']['tmp_name'];
                        $nama22=$_FILES['file_img22']['name'];
                        $type22=$_FILES['file_img22']['type'];
                        $ext22 = pathinfo($nama22, PATHINFO_EXTENSION);
                        //echo $ext2."<br>";
                    }
                  if(isset($_FILES['file_img23']['tmp_name']) && $_FILES['file_img23']['tmp_name']!="" && $_FILES['file_img23']['tmp_name']!=NULL){
                        $image_temp23=$_FILES['file_img23']['tmp_name'];
                        $nama23=$_FILES['file_img23']['name'];
                        $type23=$_FILES['file_img23']['type'];
                        $ext23 = pathinfo($nama23, PATHINFO_EXTENSION);
                        //echo $ext2."<br>";
                    }

                    ############   Query CEK BEFORE UPDATE   ###########################################
                    $SQLcek =" SELECT * FROM  rek_rotasi WHERE id_operasi='$id_operasi' and status='0' ";
                    // echo $SQLcek;
                    //         die();
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount();

                    ############   END CHECK   ###################################################
                    if ($found >=1 ){
                              $directory1="../images/rotasi1/".$image_name.".$ext1";
                              $directory12="../images/rotasi12/".$image_name.".$ext12";
                              $directory13="../images/rotasi13/".$image_name.".$ext13";



                              $directory2="../images/rotasi2/".$image_name.".$ext2";
                              $directory22="../images/rotasi22/".$image_name.".$ext22";
                              $directory23="../images/rotasi23/".$image_name.".$ext23";
                             // echo $directory1."<br>";
                             // echo $directory2."<br>";
                             // die();
                              unlink($directory1.$rec['before_img']);
                              unlink($directory12.$rec['before_img12']);
                              unlink($directory13.$rec['before_img13']);
                              copy($image_temp1,$directory1);
                              copy($image_temp12,$directory12);
                              copy($image_temp13,$directory13);

                              unlink($directory2.$rec['after_img']);
                              unlink($directory22.$rec['after_img22']);
                              unlink($directory23.$rec['after_img23']);
                              copy($image_temp2,$directory2);
                              copy($image_temp22,$directory22);
                              copy($image_temp23,$directory23);

                              $query =" UPDATE  rek_rotasi  set nama_pasien='$nama_pasien', ";
                              $query.=" sex='$sex',tgl_lahir='$tgl_lahir',divid='$divid',id_dosen='$id_dosen',diagnosis='$diagnosis', "; 
                              $query.=" data_pasien='$data_pasien',tindakan='$tindakan',tgl_tindakan='$tgl_tindakan',tempat='$tempat', "; 
                              $query.=" before_img='$image_name.$ext1',before_img12='$image_name.$ext12',before_img13='$image_name.$ext13', "; 
                              $query.=" after_img='$image_name.$ext2',after_img22='$image_name.$ext22',after_img23='$image_name.$ext23' ";
                              $query.=" WHERE no_rekammedik='$no_rekammedik' and status='0' "; 
                              //$query.="  "; 

                              $RS  = $db->Execute($query);

                                if ($RS !=false)
                                    {
                                      logActivity("EDIT ROTASI","MENU=45, id_operasi=$id_operasi ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success3");
                                } else  {
                                      logActivity("FAILED EDIT ROTASI","MENU=45, id_operasi=$id_operasi ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error3");
                                    }



                    }else{


                                    logActivity("ALREADY EXIST ROTASI","MENU=45, id_operasi=$id_operasi");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1&var=$no_rekammedik ");

                    }


            }  

#######################################################################################################################################
#################################################    DELETE ROTASI LUAR KOTA  #################################################
#######################################################################################################################################
          
          if (($_GET['module'])==sha1('45') && ($_GET['act']=='delete_f_operasi')){

                    $no_rek_medis=trim($_POST['no_rek_medis']);
                    $SQL=" DELETE from rek_rotasi where no_rekammedik='$no_rek_medis' ";
                    $RS  = $db->Execute($SQL);
                    //$result=odbc_exec($connection, $query);

                    if ($RS != false)
                          { 
                            logActivity("DELETE OPERASI","MENU=45,username=$username");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success2");
                        } else  {
                           logActivity("FAILED DELETE OPERASI","MENU=45,username=$username");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error2");

                          }



          }


#######################################################################################################################################
####################################################### PENILAIAN ROTASI #############################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('50') && ($_GET['act']=='penilaian_operasi')){


                    $id_operasi=trim($_POST['id_operasi']);
                    $komentar=trim($_POST['komentar']);
                    $nilai=trim($_POST['nilai']);
                    $no_rekammedik=trim($_POST['no_rekammedik12']);
                    

                    ############   Query CEK BEFORE INSERT   ###########################################
                    $SQLcek=" SELECT * FROM  rek_rotasi WHERE no_rekammedik='$no_rekammedik' and status='0'  ";
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount(); 
                    ############   END CHECK   ###################################################
                    if ($found >=1 ){
                              $query =" UPDATE  rek_rotasi set nilai='$nilai', komentar='$komentar', status='1', tgl_komentar=current_timestamp ";
                              $query.=" WHERE no_rekammedik='$no_rekammedik' "; 

                             /* echo $query;
                              die();*/
                              $RS  = $db->Execute($query);

                                if ($RS !=false)
                                    {
                                      logActivity("ADD NILAI ROTASI","MENU=50, nilai=$nilai, komentar=$komentar, status=1 , id_operasi=$id_operasi ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                                } else  {
                                      logActivity("FAILED ADD NILAI ROTASI","MENU=50, nilai=$nilai, komentar=$komentar, status=1 , id_operasi=$id_operasi ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");
                                    }
                    }else{


                                    logActivity("DATA NOT FOUND","MENU=50, nilai=$nilai, komentar=$komentar, status=1 , id_operasi=$id_operasi ");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1");


                    }



            }

#######################################################################################################################################
################################################# INPUT BIMBINGAN THESIS ##############################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('46') && ($_GET['act']=='kegiatan_ilmiah')){



                                                       
    $tanggal         = $_POST['tanggal'];                                                        
    $judul            = $_POST['judul'];
    $division        = $_POST['division'];
    $consultant      = $_POST['consultant'];



//die();

  $query =" insert into bimbingan_thesis (username,tgl_ki,judul_ki,divid,id_dosen, ";
  $query.=" adddt,addby)";
  $query.=" values('$_SESSION[USERNAME]','$tanggal','$judul','$division','$consultant', ";
  $query.=" current_timestamp,'$_SESSION[USERNAME]') ";
  //$query.=" returning id_kg ";


//echo $query;
//die();
  $RS  = $db->Execute($query);

                    if ($RS !=false)
                          {
                            logActivity("ADD BIMB.THESIS ","MENU=46, rek_id=$image_name");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                    } else  {
                            logActivity("ADD BIMB.THESIS","MENU=46, rek_id=$image_name");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");

                        }


            }            

#######################################################################################################################################
################################################# EDIT BIMBINGAN THESIS   ############################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('46') && ($_GET['act']=='edit_ki')){







                                                       
$tanggal      = date('Y-m-d',strtotime($_POST['tgl_ki']));                                                        
$judul_ki       = $_POST['judul_ki'];
$divid        = $_POST['division'];
$id_dosen     = $_POST['nmconsultant'];
$id_kg        = $_POST['id_kg'];


//die();

  $query =" update bimbingan_thesis  set tgl_ki='$tanggal',judul_ki='$judul_ki',divid='$divid',id_dosen='$id_dosen' ";
  $query.=" where id_kg='$id_kg' ";
  //$query.=" returning id_kg ";


//echo $query;
//die();
  $RS  = $db->Execute($query);

                    if ($RS !=false)
                          {
                            logActivity("EDIT BIMB.THESIS ","MENU=46, id_kg=$id_kg");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success3");
                    } else  {
                            logActivity("EDIT BIMB.THESIS","MENU=46, id_kg=$id_kg");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error3");

                        }


            }            
#######################################################################################################################################
################################################# DELETE BIMBINGAN THESIS   ############################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('46') && ($_GET['act']=='delete_ki')){

                    $id_kg=$_POST['id_kg'];
                    $query=" DELETE FROM bimbingan_thesis where id_kg='$id_kg'";
                    $RS  = $db->Execute($query);
                    //echo $query;
                    //die();


                    if ($RS !=false)
                          {
                            logActivity("DELETE BIMB.THESIS","MENU=46, id_kg=$id_kg ");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success2");
                    } else  {
                            logActivity("FAILED BIMB.THESIS","MENU=46, id_kg=$id_kg ");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error2");

                        }


            }            

#######################################################################################################################################
####################################################### PENILAIAN BIMB.THESIS #########################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('51') && ($_GET['act']=='penilaian_ki')){


                    $id_kg=trim($_POST['id_kg']);
                    $feedback=trim($_POST['$feedback']);
                    $nilai=trim($_POST['nilai']);

                    ############   Query CEK BEFORE INSERT   ###########################################
                    $SQLcek=" SELECT * FROM  bimbingan_thesis  WHERE id_kg='$id_kg'  ";
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount(); 
                    ############   END CHECK   ###################################################
                    if ($found ==1 ){
                              $query =" UPDATE  bimbingan_thesis set nilai='$nilai', feedback='feedback', status='1' ";
                              $query.=" WHERE id_kg='$id_kg' "; 

                              ///echo $query;
                              //die();
                              $RS  = $db->Execute($query);

                                if ($RS !=false)
                                    {
                                      logActivity("ADD BIM.THESIS","MENU=51, nilai=$nilai, feedback=feedback, status=1 , id_kg=id_kg ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                                } else  {
                                      logActivity("FAILED ADD BIM.THESIS ","MENU=51, nilai=$nilai, feedback=feedback, status=1 , id_kg=id_kg ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");
                                    }
                    }else{


                                    logActivity("DATA NOT FOUND","MENU=51, nilai=$nilai, id_kg=id_kg, status=1 , id_kg=id_kg ");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1");


                    }



            }


#######################################################################################################################################
################################################# REKAM UGD   #####################################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('54') && ($_GET['act']=='form_operasi')){

                  $no_rekammedik  = trim($_POST['no_rm']);                                                        
                  $nama_pasien    = trim($_POST['nama_pasien']);                                             
                  $sex            = trim($_POST['sex']);
                  $tgl_lahir      = date('Y-m-d',strtotime($_POST['tgl_lahir']));
                  $divid          = trim($_POST['division']);                                                
                  $id_dosen       = trim($_POST['consultant']);
                  $diagnosis      = trim($_POST['diagnosis']);
                  $data_pasien    = trim($_POST['data_pasien']);
                  $tindakan       = trim($_POST['tindakan']);                                                        
                  $tgl_tindakan   = date('Y-m-d',strtotime($_POST['tgl_tindakan']));
                  $tempat         = trim($_POST['tempat']);  
                  // Array --------------------------------------                                            
                  $p_asisten      = ($_POST['asisten']);
                  $p_operator     = ($_POST['operator']);                                                
                  $p_onloop       = ($_POST['onloop']);
/*
                    print_r("<pre>");
                    print_r($p_asisten);
                    print_r("</pre>");

                  die();  */

                   ############   Query CEK NO REKAM MEDIK  ###########################################
                    $SQLcek=" SELECT * FROM  rek_ugd WHERE no_rekammedik='$no_rekammedik'  ";
                    // echo $SQLcek;
                    //         die();
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount();

                    if($found>=1){
                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error5&var=$no_rekammedik");
                      die();
                    }



                  

                  if(isset($p_asisten)){
                    $jml_asisten    =count($_POST['asisten']);
                  }else{
                    $jml_asisten    =0;
                  }
                  if(isset($p_operator)){
                    $jml_operator   =count($_POST['operator']);
                  }else{
                    $jml_operator   =0;
                  }
                  if(isset($p_onloop)){
                    $jml_onloop     =count($_POST['onloop']);
                  }else{
                    $jml_onloop     =0;
                  }

                  $list_asisten ="";
                  for ($i=0; $i < $jml_asisten  ; $i++) { 

                    $koma = ($i==($jml_asisten-1)) ? "" : ",";
                    $list_asisten .=$_POST['asisten'][$i]."$koma";  
                  }
                  $list_operator ="";
                  for ($i=0; $i < $jml_operator  ; $i++) { 

                    $koma = ($i==($jml_operator-1)) ? "" : ",";
                    $list_operator .=$_POST['operator'][$i]."$koma";  
                  }
                  $list_onloop ="";
                  for ($i=0; $i < $jml_onloop  ; $i++) { 

                    $koma = ($i==($jml_onloop-1)) ? "" : ",";
                    $list_onloop .=$_POST['onloop'][$i]."$koma";  
                  }
                  // echo $list_asisten;
                  // die();

                  /*$file_img    = $_POST['file_img'];
                  $file_img2   = $_POST['file_img2'];*/
                  $image_temp1=$_FILES['file_img']['tmp_name'];
                  $image_temp2=$_FILES['file_img2']['tmp_name'];

                  $image_temp12=$_FILES['file_img12']['tmp_name'];
                  $image_temp22=$_FILES['file_img22']['tmp_name'];

                  $image_temp13=$_FILES['file_img13']['tmp_name'];
                  $image_temp23=$_FILES['file_img23']['tmp_name'];
                  // echo $image_temp1."<br>";
                  // echo $image_temp2."<br>";
                  if(isset($_FILES['file_img']['tmp_name']) && $_FILES['file_img']['tmp_name']!="" && $_FILES['file_img']['tmp_name']!=NULL){
                        $image_temp1=$_FILES['file_img']['tmp_name'];
                        $nama1=$_FILES['file_img']['name'];
                        $type1=$_FILES['file_img']['type'];
                        $ext1 = pathinfo($nama1, PATHINFO_EXTENSION);

                        //echo $ext1."<br>";
                      }
                  if(isset($_FILES['file_img2']['tmp_name']) && $_FILES['file_img2']['tmp_name']!="" && $_FILES['file_img2']['tmp_name']!=NULL){
                        $image_temp2=$_FILES['file_img2']['tmp_name'];
                        $nama2=$_FILES['file_img2']['name'];
                        $type2=$_FILES['file_img2']['type'];
                        $ext2 = pathinfo($nama2, PATHINFO_EXTENSION);
                        //echo $ext2."<br>";
                    }
//----------------------------------------------------------------------------------------------------

                  if(isset($_FILES['file_img12']['tmp_name']) && $_FILES['file_img12']['tmp_name']!="" && $_FILES['file_img12']['tmp_name']!=NULL){
                        $image_temp12=$_FILES['file_img12']['tmp_name'];
                        $nama12=$_FILES['file_img12']['name'];
                        $type12=$_FILES['file_img12']['type'];
                        $ext12 = pathinfo($nama12, PATHINFO_EXTENSION);

                        //echo $ext1."<br>";
                      }
                  if(isset($_FILES['file_img22']['tmp_name']) && $_FILES['file_img22']['tmp_name']!="" && $_FILES['file_img22']['tmp_name']!=NULL){
                        $image_temp22=$_FILES['file_img22']['tmp_name'];
                        $nama22=$_FILES['file_img22']['name'];
                        $type22=$_FILES['file_img22']['type'];
                        $ext22 = pathinfo($nama22, PATHINFO_EXTENSION);
                        //echo $ext2."<br>";
                    }

//----------------------------------------------------------------------------------------------------
                  if(isset($_FILES['file_img13']['tmp_name']) && $_FILES['file_img13']['tmp_name']!="" && $_FILES['file_img13']['tmp_name']!=NULL){
                        $image_temp13=$_FILES['file_img13']['tmp_name'];
                        $nama13=$_FILES['file_img13']['name'];
                        $type13=$_FILES['file_img13']['type'];
                        $ext13 = pathinfo($nama13, PATHINFO_EXTENSION);

                        //echo $ext1."<br>";
                      }
                  if(isset($_FILES['file_img23']['tmp_name']) && $_FILES['file_img23']['tmp_name']!="" && $_FILES['file_img23']['tmp_name']!=NULL){
                        $image_temp23=$_FILES['file_img23']['tmp_name'];
                        $nama23=$_FILES['file_img23']['name'];
                        $type23=$_FILES['file_img23']['type'];
                        $ext23 = pathinfo($nama23, PATHINFO_EXTENSION);
                        //echo $ext2."<br>";
                    } 
//die();






                        //----------  for asisten -------------------------------------------------
                        for ($i=0; $i < $jml_asisten  ; $i++) { 
                        $querya =" insert into rek_ugd (username,no_rekammedik,nama_pasien,tgl_lahir,sex,diagnosis,tindakan,";
                        $querya.=" tgl_tindakan,data_pasien,divid,id_dosen,p_asisten,p_operator,p_onloop,tempat,status,";
                        $querya.=" before_img,before_ket,after_img,after_ket,adddt,addby) ";
                        $querya.=" values('".$_POST['asisten'][$i]."','$no_rekammedik','$nama_pasien','$tgl_lahir','$sex','$diagnosis','$tindakan','$tgl_tindakan','$data_pasien',";     
                        $querya.=" '$divid','$id_dosen','$list_asisten','$list_operator','$list_onloop','$tempat','0',";
                        $querya.=" '','-','','-',current_timestamp,'$_SESSION[USERNAME]')";
                        $querya.=" returning id_operasi ";


                         /*echo "----------asisten----------- <br>";
                         echo $querya."<br>";*/




                        $RSa  = $db->Execute($querya);
                        $image_name = $RSa->fields['id_operasi'];


                       

                           // $RSa  = $db->Execute($querya);
                        }

                        //----------  for operator ------------------------------------------------
                        for ($i=0; $i < $jml_operator  ; $i++) { 

                            $queryb =" insert into rek_ugd (username,no_rekammedik,nama_pasien,tgl_lahir,sex,diagnosis,tindakan,";
                            $queryb.=" tgl_tindakan,data_pasien,divid,id_dosen,p_asisten,p_operator,p_onloop,tempat,status,";
                            $queryb.=" before_img,before_ket,after_img,after_ket,adddt,addby) ";
                            $queryb.=" values('".$_POST['operator'][$i]."','$no_rekammedik','$nama_pasien','$tgl_lahir','$sex','$diagnosis','$tindakan','$tgl_tindakan','$data_pasien',";     
                            $queryb.=" '$divid','$id_dosen','$list_asisten','$list_operator','$list_onloop','$tempat','0',";
                            $queryb.=" '','-','','-',current_timestamp,'$_SESSION[USERNAME]')"; 

                           /* echo "----------operator----------- <br>";
                            echo $queryb."<br>";*/
                            $RSb  = $db->Execute($queryb);
                        }

                        //----------  for on loop  ------------------------------------------------
                        for ($i=0; $i < $jml_onloop  ; $i++) { 

                            $queryc =" insert into rek_ugd (username,no_rekammedik,nama_pasien,tgl_lahir,sex,diagnosis,tindakan,";
                            $queryc.=" tgl_tindakan,data_pasien,divid,id_dosen,p_asisten,p_operator,p_onloop,tempat,status,";
                            $queryc.=" before_img,before_ket,after_img,after_ket,adddt,addby) ";
                            $queryc.=" values('".$_POST['onloop'][$i]."','$no_rekammedik','$nama_pasien','$tgl_lahir','$sex','$diagnosis','$tindakan','$tgl_tindakan','$data_pasien',";     
                            $queryc.=" '$divid','$id_dosen','$list_asisten','$list_operator','$list_onloop','$tempat','0',";
                            $queryc.=" '','-','','-',current_timestamp,'$_SESSION[USERNAME]')"; 

                            /*echo "----------onloop----------- <br>";
                            echo $queryc."<br>";*/
                            $RSc  = $db->Execute($queryc);

                        }
/*echo $query;
die();*/                
                       // die();

                        if ($RSa !=false){

                            $directory1="../images/ugd1/".$image_name.".$ext1";
                            $directory2="../images/ugd2/".$image_name.".$ext2";
                            copy($image_temp1,$directory1);
                            copy($image_temp2,$directory2);

                            //-----------------------------------------------------
                            $directory12="../images/ugd12/".$image_name.".$ext12";
                            $directory22="../images/ugd22/".$image_name.".$ext22";
                            copy($image_temp12,$directory12);
                            copy($image_temp22,$directory22);
                            //-----------------------------------------------------
                            $directory13="../images/ugd13/".$image_name.".$ext13";
                            $directory23="../images/ugd23/".$image_name.".$ext23";
                            copy($image_temp13,$directory13);
                            copy($image_temp23,$directory23);

                            $query2 = " update rek_ugd set before_img='$image_name.$ext1',after_img='$image_name.$ext2',  ";
                            $query2.= " before_img12='$image_name.$ext12',after_img22='$image_name.$ext22', ";
                            $query2.= " before_img13='$image_name.$ext13',after_img23='$image_name.$ext23' ";
                            $query2.= " where no_rekammedik='".$no_rekammedik."' ";
                            $RS2    = $db->Execute($query2);
                        }




                        if ($RSa !=false)
                              {
                                logActivity("ADD UGD","MENU=54, id_operasi=$image_name");
                                header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                        } else  {
                                logActivity("FAILED UGD","MENU=54, id_operasi=$image_name");
                                header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");

                            }


            }            
#######################################################################################################################################
####################################################### EDIT UGD ###################################################################
#######################################################################################################################################

            if (($_GET['module'])==sha1('54') && ($_GET['act']=='form_edit_operasi')){
                  $id_operasi     = $_POST['id_operasi'];
                  $no_rekammedik  = trim($_POST['ed_no_rm']);                                                        
                  $nama_pasien    = trim($_POST['ed_nama_pasien']);                                             
                  $sex            = trim($_POST['sex']);
                  $tgl_lahir      = date('Y-m-d',strtotime($_POST['tgl_lahir']));
                  $divid          = trim($_POST['ed_division']);                                                
                  $id_dosen       = trim($_POST['ed_consultant']);
                  $diagnosis      = trim($_POST['ed_diagnosis']);
                  $data_pasien    = trim($_POST['data_pasien']);
                  $tindakan       = trim($_POST['ed_tindakan']);                                                        
                  $tgl_tindakan   = date('Y-m-d',strtotime($_POST['ed_tgl_tindakan']));
                  $tempat         = trim($_POST['tempat']);  
                  $image_name     = $_POST['id_operasi'];
                  // Array --------------------------------------                                            
                  $p_asisten      = ($_POST['asisten']);
                  $p_operator     = ($_POST['operator']);                                                
                  $p_onloop       = ($_POST['onloop']);

                  $rec=getRekOperasiMhs($id_operasi);

                  if(isset($p_asisten)){
                    $jml_asisten    =count($_POST['asisten']);
                  }else{
                    $jml_asisten    =0;
                  }
                  if(isset($p_operator)){
                    $jml_operator   =count($_POST['operator']);
                  }else{
                    $jml_operator   =0;
                  }
                  if(isset($p_onloop)){
                    $jml_onloop     =count($_POST['onloop']);
                  }else{
                    $jml_onloop     =0;
                  }

                  $list_asisten ="";
                  for ($i=0; $i < $jml_asisten  ; $i++) { 

                    $koma = ($i==($jml_asisten-1)) ? "" : ",";
                    $list_asisten .=$_POST['asisten'][$i]."$koma";  
                  }
                  $list_operator ="";
                  for ($i=0; $i < $jml_operator  ; $i++) { 

                    $koma = ($i==($jml_operator-1)) ? "" : ",";
                    $list_operator .=$_POST['operator'][$i]."$koma";  
                  }
                  $list_onloop ="";
                  for ($i=0; $i < $jml_onloop  ; $i++) { 

                    $koma = ($i==($jml_onloop-1)) ? "" : ",";
                    $list_onloop .=$_POST['onloop'][$i]."$koma";  
                  }
                  // echo $list_asisten;
                  // die();

                  /*$file_img    = $_POST['file_img'];
                  $file_img2   = $_POST['file_img2'];*/
                  $image_temp1=$_FILES['file_img']['tmp_name'];
                  $image_temp12=$_FILES['file_img12']['tmp_name'];
                  $image_temp13=$_FILES['file_img13']['tmp_name'];




                  $image_temp2=$_FILES['file_img2']['tmp_name'];
                  $image_temp22=$_FILES['file_img22']['tmp_name'];
                  $image_temp23=$_FILES['file_img23']['tmp_name'];
                  // echo $image_temp1."<br>";
                  // echo $image_temp2."<br>";
                  if(isset($_FILES['file_img']['tmp_name']) && $_FILES['file_img']['tmp_name']!="" && $_FILES['file_img']['tmp_name']!=NULL){
                        $image_temp1=$_FILES['file_img']['tmp_name'];
                        $nama1=$_FILES['file_img']['name'];
                        $type1=$_FILES['file_img']['type'];
                        $ext1 = pathinfo($nama1, PATHINFO_EXTENSION);

                        //echo $ext1."<br>";
                      }
                  if(isset($_FILES['file_img12']['tmp_name']) && $_FILES['file_img12']['tmp_name']!="" && $_FILES['file_img12']['tmp_name']!=NULL){
                        $image_temp12=$_FILES['file_img']['tmp_name'];
                        $nama12=$_FILES['file_img12']['name'];
                        $type12=$_FILES['file_img12']['type'];
                        $ext12 = pathinfo($nama12, PATHINFO_EXTENSION);

                        //echo $ext1."<br>";
                      }
                  if(isset($_FILES['file_img13']['tmp_name']) && $_FILES['file_img13']['tmp_name']!="" && $_FILES['file_img13']['tmp_name']!=NULL){
                        $image_temp13=$_FILES['file_img']['tmp_name'];
                        $nama13=$_FILES['file_img13']['name'];
                        $type13=$_FILES['file_img13']['type'];
                        $ext13 = pathinfo($nama13, PATHINFO_EXTENSION);

                        //echo $ext1."<br>";
                      }



                  if(isset($_FILES['file_img2']['tmp_name']) && $_FILES['file_img2']['tmp_name']!="" && $_FILES['file_img2']['tmp_name']!=NULL){
                        $image_temp2=$_FILES['file_img2']['tmp_name'];
                        $nama2=$_FILES['file_img2']['name'];
                        $type2=$_FILES['file_img2']['type'];
                        $ext2 = pathinfo($nama2, PATHINFO_EXTENSION);
                        //echo $ext2."<br>";
                    }
                  if(isset($_FILES['file_img22']['tmp_name']) && $_FILES['file_img22']['tmp_name']!="" && $_FILES['file_img22']['tmp_name']!=NULL){
                        $image_temp22=$_FILES['file_img22']['tmp_name'];
                        $nama22=$_FILES['file_img22']['name'];
                        $type22=$_FILES['file_img22']['type'];
                        $ext22 = pathinfo($nama22, PATHINFO_EXTENSION);
                        //echo $ext2."<br>";
                    }
                  if(isset($_FILES['file_img23']['tmp_name']) && $_FILES['file_img23']['tmp_name']!="" && $_FILES['file_img23']['tmp_name']!=NULL){
                        $image_temp23=$_FILES['file_img23']['tmp_name'];
                        $nama23=$_FILES['file_img23']['name'];
                        $type23=$_FILES['file_img23']['type'];
                        $ext23 = pathinfo($nama23, PATHINFO_EXTENSION);
                        //echo $ext2."<br>";
                    }

                    ############   Query CEK BEFORE UPDATE   ###########################################
                    $SQLcek =" SELECT * FROM  rek_ugd WHERE id_operasi='$id_operasi' and status='0' ";
                    // echo $SQLcek;
                    //         die();
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount();

                    ############   END CHECK   ###################################################
                    if ($found >=1 ){
                              $directory1="../images/ugd1/".$image_name.".$ext1";
                              $directory12="../images/ugd12/".$image_name.".$ext12";
                              $directory13="../images/ugd13/".$image_name.".$ext13";



                              $directory2="../images/ugd2/".$image_name.".$ext2";
                              $directory22="../images/ugd22/".$image_name.".$ext22";
                              $directory23="../images/ugd23/".$image_name.".$ext23";
                             // echo $directory1."<br>";
                             // echo $directory2."<br>";
                             // die();
                              unlink($directory1.$rec['before_img']);
                              unlink($directory12.$rec['before_img12']);
                              unlink($directory13.$rec['before_img13']);
                              copy($image_temp1,$directory1);
                              copy($image_temp12,$directory12);
                              copy($image_temp13,$directory13);

                              unlink($directory2.$rec['after_img']);
                              unlink($directory22.$rec['after_img22']);
                              unlink($directory23.$rec['after_img23']);
                              copy($image_temp2,$directory2);
                              copy($image_temp22,$directory22);
                              copy($image_temp23,$directory23);

                              $query =" UPDATE  rek_ugd  set nama_pasien='$nama_pasien', ";
                              $query.=" sex='$sex',tgl_lahir='$tgl_lahir',divid='$divid',id_dosen='$id_dosen',diagnosis='$diagnosis', "; 
                              $query.=" data_pasien='$data_pasien',tindakan='$tindakan',tgl_tindakan='$tgl_tindakan',tempat='$tempat', "; 
                              $query.=" before_img='$image_name.$ext1',before_img12='$image_name.$ext12',before_img13='$image_name.$ext13', "; 
                              $query.=" after_img='$image_name.$ext2',after_img22='$image_name.$ext22',after_img23='$image_name.$ext23' ";
                              $query.=" WHERE no_rekammedik='$no_rekammedik' and status='0' "; 
                              //$query.="  "; 

                              $RS  = $db->Execute($query);

                                if ($RS !=false)
                                    {
                                      logActivity("EDIT UGD","MENU=54, id_operasi=$id_operasi ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success3");
                                } else  {
                                      logActivity("FAILED EDIT UGD","MENU=54, id_operasi=$id_operasi ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error3");
                                    }



                    }else{


                                    logActivity("ALREADY EXIST UGD","MENU=54, id_operasi=$id_operasi");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1&var=$no_rekammedik ");

                    }


            }  

#######################################################################################################################################
#################################################    DELETE FORM UGD  #############################################################
#######################################################################################################################################
          
          if (($_GET['module'])==sha1('54') && ($_GET['act']=='delete_f_operasi')){

                    $no_rek_medis=trim($_POST['no_rek_medis']);
                    $SQL=" DELETE from rek_ugd where no_rekammedik='$no_rek_medis' ";
                    $RS  = $db->Execute($SQL);
                    //$result=odbc_exec($connection, $query);

                    if ($RS != false)
                          { 
                            logActivity("DELETE UGD","MENU=54,username=$username");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success2");
                        } else  {
                           logActivity("FAILED DELETE UGD","MENU=54,username=$username");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error2");

                          }



          }
#######################################################################################################################################
####################################################### PENILAIAN UGD     #############################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('55') && ($_GET['act']=='penilaian_operasi')){


                    $id_operasi=trim($_POST['id_operasi']);
                    $komentar=trim($_POST['komentar']);
                    $nilai=trim($_POST['nilai']);
                    $no_rekammedik=trim($_POST['no_rekammedik12']);
                    

                    ############   Query CEK BEFORE INSERT   ###########################################
                    $SQLcek=" SELECT * FROM  rek_ugd WHERE no_rekammedik='$no_rekammedik' and status='0'  ";
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount(); 
                    ############   END CHECK   ###################################################
                    if ($found >=1 ){
                              $query =" UPDATE  rek_ugd set nilai='$nilai', komentar='$komentar', status='1', tgl_komentar=current_timestamp ";
                              $query.=" WHERE no_rekammedik='$no_rekammedik' "; 

                             /* echo $query;
                              die();*/
                              $RS  = $db->Execute($query);

                                if ($RS !=false)
                                    {
                                      logActivity("ADD NILAI UGD","MENU=55, nilai=$nilai, komentar=$komentar, status=1 , id_operasi=$id_operasi ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                                } else  {
                                      logActivity("FAILED ADD NILAI UGD","MENU=55, nilai=$nilai, komentar=$komentar, status=1 , id_operasi=$id_operasi ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");
                                    }
                    }else{


                                    logActivity("DATA NOT FOUND","MENU=55, nilai=$nilai, komentar=$komentar, status=1 , id_operasi=$id_operasi ");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1");


                    }



            }

#######################################################################################################################################
################################################# INPUT BIMBINGAN AKADEMIK ############################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('47') && ($_GET['act']=='kegiatan_ilmiah')){



                                                       
    $tanggal         = $_POST['tanggal'];                                                        
    $judul            = $_POST['judul'];
    $division        = $_POST['division'];
    $consultant      = $_POST['consultant'];



//die();

  $query =" insert into bimbingan_akademik (username,tgl_ki,judul_ki,divid,id_dosen, ";
  $query.=" adddt,addby)";
  $query.=" values('$_SESSION[USERNAME]','$tanggal','$judul','$division','$consultant', ";
  $query.=" current_timestamp,'$_SESSION[USERNAME]') ";
  //$query.=" returning id_kg ";


//echo $query;
//die();
  $RS  = $db->Execute($query);

                    if ($RS !=false)
                          {
                            logActivity("ADD BIMB.AKADEMIK ","MENU=47, rek_id=$image_name");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                    } else  {
                            logActivity("ADD BIMB.AKADEMIK","MENU=47, rek_id=$image_name");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");

                        }


            }            

#######################################################################################################################################
################################################# EDIT BIMBINGAN AKADEMIK   ############################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('47') && ($_GET['act']=='edit_ki')){







                                                       
$tanggal      = date('Y-m-d',strtotime($_POST['tgl_ki']));                                                        
$judul_ki       = $_POST['judul_ki'];
$divid        = $_POST['division'];
$id_dosen     = $_POST['nmconsultant'];
$id_kg        = $_POST['id_kg'];


//die();

  $query =" update bimbingan_akademik  set tgl_ki='$tanggal',judul_ki='$judul_ki',divid='$divid',id_dosen='$id_dosen' ";
  $query.=" where id_kg='$id_kg' ";
  //$query.=" returning id_kg ";


//echo $query;
//die();
  $RS  = $db->Execute($query);

                    if ($RS !=false)
                          {
                            logActivity("EDIT BIMB.AKADEMIK ","MENU=47, id_kg=$id_kg");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success3");
                    } else  {
                            logActivity("EDIT BIMB.AKADEMIK","MENU=47, id_kg=$id_kg");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error3");

                        }


            }            
#######################################################################################################################################
################################################# DELETE BIMBINGAN AKADEMIK   #########################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('47') && ($_GET['act']=='delete_ki')){

                    $id_kg=$_POST['id_kg'];
                    $query=" DELETE FROM bimbingan_akademik where id_kg='$id_kg'";
                    $RS  = $db->Execute($query);
                    //echo $query;
                    //die();


                    if ($RS !=false)
                          {
                            logActivity("DELETE BIMB.AKADEMIK","MENU=47, id_kg=$id_kg ");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success2");
                    } else  {
                            logActivity("FAILED BIMB.AKADEMIK","MENU=47, id_kg=$id_kg ");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error2");

                        }


            }            

#######################################################################################################################################
####################################################### PENILAIAN BIMB.AKADEMIK #######################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('58') && ($_GET['act']=='penilaian_ki')){


                    $id_kg=trim($_POST['id_kg']);
                    $feedback=trim($_POST['$feedback']);
                    $nilai=trim($_POST['nilai']);

                    ############   Query CEK BEFORE INSERT   ###########################################
                    $SQLcek=" SELECT * FROM  bimbingan_akademik  WHERE id_kg='$id_kg'  ";
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount(); 
                    ############   END CHECK   ###################################################
                    if ($found ==1 ){
                              $query =" UPDATE  bimbingan_akademik set nilai='$nilai', feedback='feedback', status='1' ";
                              $query.=" WHERE id_kg='$id_kg' "; 

                              ///echo $query;
                              //die();
                              $RS  = $db->Execute($query);

                                if ($RS !=false)
                                    {
                                      logActivity("ADD BIM.AKADEMIK","MENU=58, nilai=$nilai, feedback=feedback, status=1 , id_kg=id_kg ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                                } else  {
                                      logActivity("FAILED ADD BIM.AKADEMIK ","MENU=58, nilai=$nilai, feedback=feedback, status=1 , id_kg=id_kg ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");
                                    }
                    }else{


                                    logActivity("DATA NOT FOUND","MENU=58, nilai=$nilai, id_kg=id_kg, status=1 , id_kg=id_kg ");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1");


                    }



            }

#######################################################################################################################################
################################################# INPUT EVAL. KPS SPS #################################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('63') && ($_GET['act']=='kegiatan_ilmiah')){
                                                       
    $tanggal         = $_POST['tanggal'];                                                        
    $materi          = $_POST['materi'];
    $evaluasi        = $_POST['evaluasi'];
    $division        = $_POST['division'];
    $consultant      = $_POST['consultant'];

//die();

  $query =" insert into evaluasi_kps_sps (username,tgl_ki,evaluasi,id_dosen,materi, ";
  $query.=" adddt,addby)";
  $query.=" values('$_SESSION[USERNAME]','$tanggal','$evaluasi','$consultant','$materi', ";
  $query.=" current_timestamp,'$_SESSION[USERNAME]') ";
  //$query.=" returning id_kg ";



  $RS  = $db->Execute($query);

                    if ($RS !=false)
                          {
                            logActivity("ADD EVAL.KPS SPS","MENU=63, materi=$materi");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                    } else  {
                            logActivity("ADD EVAL.KPS SPS","MENU=63, materi=$materi");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");

                        }


            }            

#######################################################################################################################################
################################################# EDIT EVAL. KPS SPS   ################################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('63') && ($_GET['act']=='edit_ki')) {

                                                       
$tanggal      = date('Y-m-d',strtotime($_POST['tgl_ki']));                                                        
$evaluasi      = $_POST['ed_evaluasi'];
$materi        = $_POST['ed_materi'];
$id_dosen     = $_POST['nmconsultant'];
$id_kg        = $_POST['id_kg'];


//die();

  $query =" update evaluasi_kps_sps  set tgl_ki='$tanggal', evaluasi='$evaluasi', materi='$materi', id_dosen='$id_dosen' ";
  $query.=" where id_kg='$id_kg' ";
  //$query.=" returning id_kg ";


//echo $query;
//die();
  $RS  = $db->Execute($query);

                    if ($RS !=false)
                          {
                            logActivity("EDIT EVAL.KPS SPS ","MENU=63, id_kg=$id_kg");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success3");
                    } else  {
                            logActivity("EDIT EVAL.KPS SPS","MENU=63, id_kg=$id_kg");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error3");

                        }


            }            
#######################################################################################################################################
################################################# DELETE EVAL. KPS SPS  ##### #########################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('63') && ($_GET['act']=='delete_ki')){

                    $id_kg=$_POST['id_kg'];
                    $query=" DELETE FROM evaluasi_kps_sps where id_kg='$id_kg'";
                    $RS  = $db->Execute($query);
                    //echo $query;
                    //die();


                    if ($RS !=false)
                          {
                            logActivity("DELETE EVAL.KPS SPS","MENU=63, id_kg=$id_kg ");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success2");
                    } else  {
                            logActivity("FAILED EVAL.KPS SPS","MENU=63, id_kg=$id_kg ");
                            header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error2");

                        }


            } 
#######################################################################################################################################
####################################################### PENILAIAN EVAL. KPS SPS #######################################################
#######################################################################################################################################
            if (($_GET['module'])==sha1('64') && ($_GET['act']=='penilaian_ki')){


                    $id_kg=trim($_POST['id_kg']);
                    $feedback=trim($_POST['$feedback']);
                    $nilai=trim($_POST['nilai']);

                    ############   Query CEK BEFORE INSERT   ###########################################
                    $SQLcek=" SELECT * FROM  evaluasi_kps_sps  WHERE id_kg='$id_kg'  ";
                    $RScek  = $db->Execute($SQLcek);
                    $found=$RScek->Rowcount(); 
                    ############   END CHECK   ###################################################
                    if ($found ==1 ){
                              $query =" UPDATE  evaluasi_kps_sps set nilai='$nilai', feedback='feedback', status='1' ";
                              $query.=" WHERE id_kg='$id_kg' "; 

                              ///echo $query;
                              //die();
                              $RS  = $db->Execute($query);

                                if ($RS !=false)
                                    {
                                      logActivity("ADD EVAL. KPS SPS","MENU=64, nilai=$nilai, feedback=feedback, status=1 , id_kg=id_kg ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=success");
                                } else  {
                                      logActivity("FAILED ADD EVAL. KPS SPS ","MENU=64, nilai=$nilai, feedback=feedback, status=1 , id_kg=id_kg ");
                                      header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error");
                                    }
                    }else{


                                    logActivity("DATA NOT FOUND","MENU=64, nilai=$nilai, id_kg=id_kg, status=1 , id_kg=id_kg ");
                                    header("location: ../home?module=$_GET[module]&pm=$_GET[pm]&message=error1");


                    }



            }

#######################################################################################################################################
####################################################### CHANGE PARAMETER LOGIN USER ###################################################
#######################################################################################################################################


#######################################################################################################################################
#######################################################  BLOCK USER IN AUDIT TRAIL  ###################################################
#######################################################################################################################################


?>