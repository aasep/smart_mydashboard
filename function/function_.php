<?php

/*######################################################################*\
#            				FUNCTION LIBRARY			                 #
# -----------------------------------------------------------------------#
# 																		 #
#  																		 #
#  	Developed by:	Asep Arifyan						    			 #
#	License:		Commercial											 #
#  	Copyright: 		2016. All Rights Reserved.		                     #
#                                                                        #
#  	Additional modules (embedded): 										 #
#	-- Metronic (Themes) 												 #
#																		 #
#																		 #
# -----------------------------------------------------------------------#
#	Designed and built with all the love and loyalty.					 #
\*######################################################################*/
//date_default_timezone_set("US/Pacific"); 
date_default_timezone_set("Asia/Jakarta");
$user_agent     =   $_SERVER['HTTP_USER_AGENT'];	  

function getUsername(){
		$username = $_SESSION['USERNAME'];
		return $username;
	}
function getStatusAccount(){
		$status = $_SESSION['STATUS_ACCOUNT'];
		return $status;
	}
function getPassword(){
		$pass = $_SESSION['PASSWORD'];
		return $pass;
	}
function getGroupUser(){
		$group = $_SESSION['GROUP_USER'];
		return $group;
	}


// function getNamaLengkap(){
// 		$fix_nama_lengkap = $_SESSION['PSAK71_NAMA_LENGKAP'];
// 		return $fix_nama_lengkap;
// 	}
function getEmail(){
		$fix_email = $_SESSION['EMAIL'];
		return $fix_email;
	}



function getImage(){
        $fix_image = $_SESSION['IMAGE'];
        return $fix_image;
    }

function getGroupUserName(){
		global $db;
		$query = " SELECT groupname FROM group_user  where groupid='$_SESSION[GROUP_USER]' ";
        $RS    = $db->Execute($query);
		$found = $RS->RecordCount();
		if ($found >=1)
		{
			$nama_group=$RS->fields['groupname'];
			return $nama_group;
			}
	}

function getNamaMenu($src){
        global $db;
        $query = " SELECT menuname FROM menu  where src='$src' ";
        $RS    = $db->Execute($query);
        //$result=odbc_exec($connection,$query);
        $found = $RS->RecordCount();
        if ($found >=1)
        {
            $nama_menu=$RS->fields['menuname'];
            return $nama_menu;
            }
    }
function getParentMenu($src){
        global $db;
        $query = " SELECT parentmenu FROM menu  where src='$src' ";
        $RS    = $db->Execute($query);
        //$result=odbc_exec($connection,$query);
        $found = $RS->RecordCount();
        if ($found >=1)
        {
            $IdMenu=$RS->fields['parentmenu'];
            return $IdMenu;
            }
    }
function getParentMenuName($IdMenu){
        global $db;
        $query = " SELECT menuname FROM menu  where  idmenu='$IdMenu' ";
        $RS    = $db->Execute($query);
        //$result=odbc_exec($connection,$query);
        $found = $RS->RecordCount();
        if ($found >=1)
        {
            $MenuName=$RS->fields['menuname'];
            return $MenuName;
            }
    }
function getParameterLogin(){
        global $db;
        $data=array();
        $query = " SELECT * FROM PS_Login_Parameter ";
        $RS    = $db->Execute($query);
        $data = $RS->fetchRow();
        return $data;
    }
function isUsername($username){
        global $db;
        $data=array();
        $query = " SELECT * FROM PS_USER WHERE UserID='$username' ";
        $RS    = $db->Execute($query);
        $data  = $RS->fetchRow();
       
        return $data;
            // if (!empty($data)){
            //         return $data;
            // }else{
            //         return false;
            // }
    }
function refreshFailedLogin(){
        global $db;
        $query = " UPDATE PS_USER SET FailedLogin=0 WHERE UserID='$_SESSION[PSAK71_USERNAME]' ";
        $RS    = $db->Execute($query);
        return 1;
    }
function updateFailedLogin($username){
        global $db;
        $data=array();

        $query_cek    = " SELECT * FROM PS_USER  WHERE UserID='$username' ";
        // echo "$query_cek";
        // die();
        $RCEK         = $db->Execute($query_cek);
        $data         = $RCEK->fetchRow();

        if ($RCEK != false ){

            $newFailed    = $data['FailedLogin']+1;
            $query        = " UPDATE PS_USER SET FailedLogin='$newFailed' WHERE UserID='$username' ";
            $RS           = $db->Execute($query);

            if ($RS != false) {
                    return true;
            } else {
                    return false;
                }

        } else {

            return false;

        }
        

        

    }
function getIp(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    		$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
   			 $ip = $_SERVER['REMOTE_ADDR'];
		}

return $ip;

	}

function getBrowser(){
		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
   			$browser='Internet explorer';
 			elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) //For Supporting IE 11
    			$browser='Internet explorer';
				 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
   					$browser='Mozilla Firefox';
 					elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
 					  $browser='Google Chrome';
						 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
   							$browser="Opera Mini";
 								elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
   									$browser="Opera";
 									elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
   										$browser="Safari";
 											else
  											 $browser='Browser Lain';
return $browser;

	}

function getBrowser2() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
} 

function versionBrowser() { 
$ua=getBrowser2();
$yourbrowser= $ua['name'] . " " . $ua['version'] ;
return $yourbrowser;
}
function getOS() { 

    global $user_agent;

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
                            '/windows nt 10/i'     =>  'Windows 10',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }   

    return $os_platform;

}

function logActivity($name,$info){
		global $db;
		$SQL="insert into log_activity (username,time_activity,ip,browser,name_activity,info,os,browser_ver) values ('$_SESSION[USERNAME]',CURRENT_TIMESTAMP,'".getIp()."','".getBrowser()."','$name','$info','".getOS()."','".versionBrowser()."')";
        $RS  = $db->Execute($SQL);
		//$result=odbc_exec($connection,$query);
       /* echo  $SQL."<br>";
        die();*/
      // return $query;
	}
    //[//idLtrans
/*function logTransaction($name,$info){
        global $db;
        $SQL="insert into tlog_transaction (user_id,time_activity,ip,browser,name_activity,tinfo) values ('$_SESSION[PSAK71_USERNAME]',GETDATE(),'".getIp()."','".getBrowser()."','$name','$info') ";
        $RS  = $db->Execute($SQL);

        //$result=odbc_exec($connection,$query);
      // return $query;
        //echo  $query."<br>";
    }
function insertTupload($SessId,$FileName,$JmlData,$UserId){
        global $connection;
        $query="insert into tUpload (SessId,FileName,JmlData,UserId,Adddt) VALUES ('$SessId','$FileName','$JmlData','$UserId',GETDATE() ) ";
        

        $result=odbc_exec($connection,$query);
      // return $query;
        //echo  $query."<br>";
    }*/

function logLogin($name,$user,$info){
        global $db;
        $SQL="insert into tlog_activity (username,time_activity,ip,browser,name_activity,info,os,browser_ver) values ('$user',getdate(),'".getIp()."','".getBrowser()."','$name','$info','".getOS()."','".versionBrowser()."')";
        $RS  = $db->Execute($SQL);
        //$result=odbc_exec($connection,$query);
      // return $query;
    }




function lastLogin(){
		global $db;
		$query="select top 2 time_activity from tlog_activity where name_activity='login' order by time_activity desc   ";
		//$result=odbc_exec($connection,$query);
        $RS  = $db->Execute($query);



        if(!empty($RS->fields['time_activity'])){
                    
                                $num = $RS->RecordCount();

                               // while(!$RS->EOF){

    		if ($num >=1)
    		{



    			$i=1;
    			//while ($row = odbc_fetch_array($result)){
                while(!$RS->EOF){
        			if ($i==2){
            			$last_login= $RS->fields['time_activity'];
            		} 
                        $i++;
                        $RS->MoveNext();
        		}
    			return $last_login;
    		}
        }
	}




function hashEncrypted($password){

		$encrypted = hash('sha512',$password);
		return $encrypted;
	}


function Milion_format($n) {
        // first strip any formatting;
        $n = (0+str_replace(",","",$n));
        
        // is this a number?
        if(!is_numeric($n)) return false;
        
       // $n=round(($n/1000000),9);
        // now filter it;
        /*
        if($n>1000000000000) return round(($n/1000000000000),1).' trillion';
        else if($n>1000000000) return round(($n/1000000000),1).' billion';
        else if($n>1000000) return round(($n/1000000),1).' million';
        else if($n>1000) return round(($n/1000),1).' thousand';
        */
        return  number_format($n,2,",",".");
        //return number_format($n);
    }


function shortNews( $str, $wordCount = 20 ) {
  $str=explode(' ', strip_tags($str)); 
  return implode( 
    '', 
    array_slice( 
      preg_split(
        '/([\s,\.;\?\!]+)/', 
        $str, 
        $wordCount*2+1, 
        PREG_SPLIT_DELIM_CAPTURE
      ),
      0,
      $wordCount*2-1
    )
  );
}

function wordlimit($string,$words=20 ) { 
   $length = 20;
   $ellipsis = "...";
   $words = explode(' ', strip_tags($string)); 
   if (count($words) > $length) 
       return implode(' ', array_slice($words, 0, $length)) . $ellipsis; 
   else 
       return $string; 
}



function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


	
	
	
?>