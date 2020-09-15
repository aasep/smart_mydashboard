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

function getEmail(){
		$fix_email = $_SESSION['EMAIL'];
		return $fix_email;
	}
function getEmail2($username){
        global $db;
        $query = "SELECT email FROM smart_user_account WHERE username='$username' ";
        $RS    = $db->Execute($query);
        $found = $RS->RecordCount();
        if ($found >=1)
        {
            $nama_email=$RS->fields['email'];
            return $nama_email;
            }
    }


function getImage(){
        $fix_image = $_SESSION['IMAGE'];
        return $fix_image;
    }
function getImage2($username){
        global $db;
        $query = " SELECT image FROM smart_user_account WHERE username='$username' ";
        $RS    = $db->Execute($query);
        $found = $RS->RecordCount();
        if ($found >=1)
        {
            $image=$RS->fields['image'];
            return $image;
            }
    }
function getGroupUserName(){
		global $db;
		$query = " SELECT groupname FROM smart_group_user  where groupid='$_SESSION[GROUP_USER]' ";
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
        $query = " SELECT menuname FROM smart_menu  where src='$src' ";
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
        $query = " SELECT parentmenu FROM smart_menu  where src='$src' ";
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
        $query = " SELECT menuname FROM smart_menu  where  idmenu='$IdMenu' ";
        $RS    = $db->Execute($query);
        //$result=odbc_exec($connection,$query);
        $found = $RS->RecordCount();
        if ($found >=1)
        {
            $MenuName=$RS->fields['menuname'];
            return $MenuName;
            }
    }
function countTglDashSTS(){
        global $db;
        $query = " select count(distinct entry_date) as jumlah FROM dashboard_activity where sys_name='STS' ";
        $RS    = $db->Execute($query);
        $jumlah = $RS->fields['jumlah'];
        return $jumlah;
    }
function countTglDashSTS2($tgl){
        global $db;
        $query = " select count(*) as jumlah FROM dashboard_activity where sys_name='STS' and entry_date='$tgl' ";
        $RS    = $db->Execute($query);
        $jumlah = $RS->fields['jumlah'];
        return $jumlah;
    }
function countTglDashSRIS(){
        global $db;
        $query = " select count(distinct entry_date) as jumlah FROM dashboard_activity where sys_name='SRIS' ";
        $RS    = $db->Execute($query);
        $jumlah = $RS->fields['jumlah'];
        return $jumlah;
    }
function countTglDashSRIS2($tgl){
        global $db;
        $query = " select count(*) as jumlah FROM dashboard_activity where sys_name='SRIS' and entry_date='$tgl' ";
        $RS    = $db->Execute($query);
        $jumlah = $RS->fields['jumlah'];
        return $jumlah;
    }
function countTglDashNGCC(){
        global $db;
        $query = " select count(distinct entry_date) as jumlah FROM dashboard_activity where sys_name='NGCC' ";
        $RS    = $db->Execute($query);
        $jumlah = $RS->fields['jumlah'];
        return $jumlah;
    }
function countTglDashNGCC2($tgl){
        global $db;
        $query = " select count(*) as jumlah FROM dashboard_activity where sys_name='NGCC' and entry_date='$tgl' ";
        $RS    = $db->Execute($query);
        $jumlah = $RS->fields['jumlah'];
        return $jumlah;
    }
function countTglDashMFINO(){
        global $db;
        $query = " select count(distinct entry_date) as jumlah FROM dashboard_activity where sys_name='MFINO' ";
        $RS    = $db->Execute($query);
        $jumlah = $RS->fields['jumlah'];
        return $jumlah;
    }
function countTglDashMFINO2($tgl){
        global $db;
        $query = " select count(*) as jumlah FROM dashboard_activity where sys_name='MFINO' and entry_date='$tgl' ";
        $RS    = $db->Execute($query);
        $jumlah = $RS->fields['jumlah'];
        return $jumlah;
    } 
function countTglDashAD(){
        global $db;
        $query = " select count(distinct entry_date) as jumlah FROM dashboard_activity where sys_name='AD' ";
        $RS    = $db->Execute($query);
        $jumlah = $RS->fields['jumlah'];
        return $jumlah;
    }
function countTglDashAD2($tgl){
        global $db;
        $query = " select count(*) as jumlah FROM dashboard_activity where sys_name='AD' and entry_date='$tgl' ";
        $RS    = $db->Execute($query);
        $jumlah = $RS->fields['jumlah'];
        return $jumlah;
    }
function countTglDashSAP(){
        global $db;
        $query = " select count(distinct entry_date) as jumlah FROM dashboard_activity where sys_name='SAP' ";
        $RS    = $db->Execute($query);
        $jumlah = $RS->fields['jumlah'];
        return $jumlah;
    }
function countTglDashSAP2($tgl){
        global $db;
        $query = " select count(*) as jumlah FROM dashboard_activity where sys_name='SAP' and entry_date='$tgl' ";
        $RS    = $db->Execute($query);
        $jumlah = $RS->fields['jumlah'];
        return $jumlah;
    }
function countTglDashZSMART(){
        global $db;
        $query = " select count(distinct entry_date) as jumlah FROM dashboard_activity where sys_name='ZSMART' ";
        $RS    = $db->Execute($query);
        $jumlah = $RS->fields['jumlah'];
        return $jumlah;
    }
function countTglDashZSMART2($tgl){
        global $db;
        $query = " select count(*) as jumlah FROM dashboard_activity where sys_name='ZSMART' and entry_date='$tgl' ";
        $RS    = $db->Execute($query);
        $jumlah = $RS->fields['jumlah'];
        return $jumlah;
    }
function countTglDashZIMBRA(){
        global $db;
        $query = " select count(distinct entry_date) as jumlah FROM dashboard_activity where sys_name='ZSMART' ";
        $RS    = $db->Execute($query);
        $jumlah = $RS->fields['jumlah'];
        return $jumlah;
    }
function countTglDashZIMBRA2($tgl){
        global $db;
        $query = " select count(*) as jumlah FROM dashboard_activity where sys_name='ZSMART' and entry_date='$tgl' ";
        $RS    = $db->Execute($query);
        $jumlah = $RS->fields['jumlah'];
        return $jumlah;
    }
function countTglDashSMARTPOIN(){
        global $db;
        $query = " select count(distinct entry_date) as jumlah FROM dashboard_activity where sys_name like '%SMARTPOIN%' ";
        $RS    = $db->Execute($query);
        $jumlah = $RS->fields['jumlah'];
        return $jumlah;
    }
function countTglDashSMARTPOIN2($tgl){
        global $db;
        $query = " select count(*) as jumlah FROM dashboard_activity where sys_name like '%SMARTPOIN%' and entry_date='$tgl' ";
        $RS    = $db->Execute($query);
        $jumlah = $RS->fields['jumlah'];
        return $jumlah;
    }       
 
function getDataProfile($username){
        global $db;
        $data=array();
        $query = " SELECT * FROM smart_user_account WHERE username='$username'  ";
        $RS    = $db->Execute($query);
        $data = $RS->fetchRow();
        return $data;
    } 

function getNamaBulan($variable){

        switch ($variable) {
            case '01':
                $bulan="Januari";
                break;
            case '02':
                $bulan="Februari";
                break;
            case '03':
                $bulan="Maret";
                break;
            case '04':
                $bulan="April";
                break;
            case '05':
                $bulan="Mei";
                break;
            case '06':
                $bulan="Juni";
                break;
            case '07':
                $bulan="July";
                break;
            case '08':
                $bulan="Agustus";
                break;
            case '09':
                $bulan="September";
                break;
            case '10':
                $bulan="Oktober";
                break;
            case '11':
                $bulan="November";
                break;
            case '12':
                $bulan="Desember";
                break;
        }

        return $bulan;
    }


function getTahunBefore(){
        date_default_timezone_set("Asia/Jakarta");
        $start_date=date('Y-m-d H:i');

        $array_tahun=array();

        //array_push($array_tahun, "<option value=''> Select Year </option>");
        // Kebelakang
        $z=5;
        $tahun=date("Y", strtotime(date('Y-m-d H:i',strtotime($start_date))." -$z year"));

        for ($i=$tahun; $i <= ($tahun+5) ; $i++) { 

            echo "<option value='$i'> <b> $i</b></option>";
            
            //$i++;
            # code...
        }



}

function getBulanSelect2(){

        $bulan = array('01' => 'Januari', '02' => 'Februari','03' => 'Maret', '04' => 'April','05' => 'Mei', '06' => 'Juni','07' => 'Juli', '8' => 'Agustus','09' => 'September', '10' => 'Oktober','11' => 'November', '12' => 'Desember' );

        return $bulan;
} 
function getBulanSelect(){
        $array_bulan=array();
        $bulan = array('Januari','Februari','Maret', 'April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember' );
        $i=1;
        echo "<option value=''> === Pilih Bulan === </option>";
        foreach ($bulan as $key => $value) {
            if ($i <= '9'){
                $bln_num="0$i";
            }else{
                $bln_num="$i";
            }
            //array_push($array_bulan, "<option value='$bln_num> <b>$value</b></option>");
            echo "<option value='$bln_num'> <b> $bln_num - $value</b></option>";
            $i++;
        }
        //return $array_bulan;
} 
function getBulanSelect3(){
        $array_bulan=array();
        $bulan = array('Januari','Februari','Maret', 'April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember' );
        $i=1;
        echo "<option value=''> === Pilih Bulan === </option>";
        foreach ($bulan as $key => $value) {
            if ($i <= '9'){
                $bln_num="0$i";
            }else{
                $bln_num="$i";
            }
            //array_push($array_bulan, "<option value='$bln_num> <b>$value</b></option>");
            echo "<option value='$bln_num'> <b>$value</b></option>";
            $i++;
        }
        //return $array_bulan;
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
		$SQL="insert into smart_log_activity (username,time_activity,ip,browser,name_activity,info,os,browser_ver) values ('$_SESSION[USERNAME]',CURRENT_TIMESTAMP,'".getIp()."','".getBrowser()."','$name','$info','".getOS()."','".versionBrowser()."')";
        $RS  = $db->Execute($SQL);
		//$result=odbc_exec($connection,$query);
       /* echo  $SQL."<br>";
        die();*/
      // return $query;
	}


function logLogin($name,$user,$info){
        global $db;
        $SQL="insert into tlog_activity (username,time_activity,ip,browser,name_activity,info,os,browser_ver) values ('$user',getdate(),'".getIp()."','".getBrowser()."','$name','$info','".getOS()."','".versionBrowser()."')";
        $RS  = $db->Execute($SQL);
        //$result=odbc_exec($connection,$query);
      // return $query;
    }




function lastLogin($username){
		global $db;
		$query="select  time_activity from smart_log_activity where name_activity='LOGIN' and username='$username' order by time_activity desc limit 2  ";
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
    			return (date("d-m-Y H:i ",strtotime($last_login)));
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