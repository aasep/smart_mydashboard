<?php
require_once('../../config.php'); 




$orderfield	= $_GET['orderfield'] != '' ? $_GET['orderfield'] : "air_menuparent,air_menuid";
$order		= $_GET['order'] ? $_GET['order'] : 'ASC';
$path_file_image = "../../../images/product/";
$systemname	= 'Galaxy Menu Management';
if(is_array($_POST) && sizeof($_POST) > 0 )
{
	$err_msg = '';
	if($_POST['edit'])
	{
		$data_air_menuid 	= intval($_POST['data_air_menuid']); 
	}
	 
	$data_air_menuname 		= add_trim($_POST['data_air_menuname']); 
	$data_category	 		= add_trim($_POST['data_category']); 
	$data_catair_menuparent	 		= add_trim($_POST['data_air_menuparent']); 
	$data_air_menuurl 		= add_trim($_POST['data_air_menuurl']); 
	$data_productpicture	= $_FILES['data_productpicture'];
	
	$s = explode('/',getDeepCount($data_catair_menuparent));
	$c = count(@array_filter($s));
	
	//validasi
	if($data_air_menuname == '')
	{
		$err_msg .= 'Please input Title<br />';
	} 
	if($c>1){
		$err_msg .= 'Can\'t place on that category, Please select another category<br />';
	}
	
	
	if($err_msg == '')
	{
		if($_POST['edit'])
		{ 
		
			$sql = "UPDATE air_menu SET 
					air_menuname = '".($data_air_menuname)."',
					air_menuurl = '".($data_air_menuurl)."',
					air_menuparent = ".intval($data_catair_menuparent)."
					WHERE air_menuid='".$data_air_menuid."'";
			
			
			$db->Execute($sql); 
			
			
			$final_msg = _logit(  'Change Galaxy Menu :'.$data_air_menuname.'');
			 
		}
		else if($_POST[insert])
		{ 
			$sqlc="SELECT * FROM air_menu";
			$resc=$db->Execute($sqlc);
			$d=$resc->RecordCount();
			$priority=$d+1;
			
			
			$sql = "INSERT INTO air_menu SET 
					air_menuname = '".($data_air_menuname)."',
					air_menuurl = '".($data_air_menuurl)."',
					air_menuparent = ".intval($data_catair_menuparent).",
					priority = '".$priority."'";
			$db->Execute($sql);
			
			$data_air_menuid = mysql_insert_id(); 
			
			
			$final_msg = _logit(  'Insert Galaxy Menu: '.$data_air_menuname.'');
			 
		}
		$action = 'view';
	} 
}


if (isset($_POST["del"])) 
{
	$delete = $_POST["delete"];
	for($i=0; $i<count($delete); $i++)
    {
	    $SQL = 'SELECT  *  FROM air_menu  WHERE air_menuid = '.$delete[$i];
        $RS  = $db->Execute($SQL);
        if ($RS != false)
        {
	        $SQL = 'SELECT * FROM  air_menu WHERE air_menuid = '.$RS->fields["air_menuid"].'';
          	$RS1  = $db->Execute($SQL);
          	if ($RS1 != false)
          	{
	          	$SQL1 = 'DELETE FROM  air_menu  WHERE   air_menuid = '.$RS->fields["air_menuid"].'';
	            $db->Execute($SQL1);
	            
	            $final_msg = _logit(  'Delete Galaxy Menu: '.$data_air_menuname.'');
	  
          	} 
        }
    } 
}

if (isset($_POST["deletemainpic"])) {  
	$data_air_menuid = $_POST["data_air_menuid"];

	$SQL = "SELECT 		*
			FROM		air_menu
			WHERE		air_menuid = '".$data_air_menuid."'";
	$RS  = $db->Execute($SQL);
	   
	if ($RS->fields["air_menuid"] != ''){ 
	
		@unlink($path_file_image.$RS->fields["image"]);
		@unlink($path_file_image.'t'.$RS->fields["image"]);
		$SQL1 = "UPDATE     air_menu
				  SET           image=''
				  WHERE      air_menuid = '".$data_air_menuid."'";                
		$RS1  = $db->Execute($SQL1);
		$final_msg = _logit(  'Delete Main Galaxy Menu Picture: '.$RS->fields["air_menuname"].'');
	} 
	
}
//**************************** Priority *********************//
if(isset($_GET['up'])&& isset($_GET['i'])) {
	$sql =  'UPDATE air_menu SET	  priority='.intval($_GET['up']).'  WHERE priority=('.intval($_GET['up']).'-1)   ';
	$db->Execute($sql);
	$sql =  "UPDATE air_menu SET	  priority=(priority)-1  WHERE air_menuid = '".intval($_GET['i'])."'   ";
	$db->Execute($sql);
}
if(isset($_GET['down'])&& isset($_GET['i'])){
	$sql =  "UPDATE air_menu SET	  priority=".intval($_GET['down'])."  WHERE priority=(".intval($_GET['down'])."+1) ";
	$db->Execute($sql);
	$sql =  "UPDATE air_menu SET	  priority=(priority)+1  WHERE air_menuid = '".intval($_GET['i'])."'  ";
	$db->Execute($sql);
}
$allow_isert= true;
$allow_view	= true; 
include('templates/header.php'); 

switch ($action)
{
	case "view" :
	case "search" : 
	//$db->debug=true;	
	
		if($action == 'search' && $search_string != '')
		{
			$add_conditon = ' WHERE air_menuname like "%'.addslashes($search_string).'%" ';
		}
		$SQL = 'SELECT *
				FROM air_menu 
				'.$add_conditon.' ORDER BY '.$orderfield.' '.$order.' ';
		$RS =$db->Execute($SQL);
		if ($RS != false)
		{
			$num 			= $RS->RecordCount();
			$page 			= isset($_GET['page']) && intval($_GET['page']) >= 1 ? intval($_GET['page']):1;
			$uparam 		= "&action=".$action."&order=".$order."&search=".$search_string."&orderfield=".$orderfield;
			$pagination 	= paging($myglobe['perpage_item'], $num, $page, $uparam);
			
			$SQL = 'SELECT *
					FROM air_menu
					 '.$add_conditon.' ORDER BY '.$orderfield.' '.$order.' LIMIT '.$pagination['from'].',  '.$myglobe['perpage_item'].' ';
	        $RS = $db->Execute($SQL);
	        if ($RS != false)
	        {
		        $i=0;
		        $data_list = array();
	            while (!$RS->EOF)
	            {
		            $data_list[$i] = $RS->fields;
					
					//+------  priority
					$link_down 	=  ($RS->fields['priority'] < $num) ? ' <a href="?down='.$RS->fields['priority'].'&i='.$RS->fields['air_menuid'].'">DOWN</a> ' : '';
					$link_up 	=  ($RS->fields['priority'] > 1) ? '  <a href="?up='.$RS->fields['priority'].'&i='.$RS->fields['air_menuid'].'">UP</a> ' : '';
					$priority_temp[$i] 		= $link_down.$link_up == '' ? '--' : $link_down.' '.$link_up;
					
		            $RS->MoveNext();
	                $i++;
	            } 
	        } 
		} 
		include('templates/catproduct_list.php');
	break;
	
	case "insert" :
	case "detail" :
		$is_edit = false;
		$air_menu 			= $db->getAssoc('SELECT * FROM air_menu ORDER BY air_menuid');
		if($action == 'detail')
		{
			$data_air_menuid = intval($_GET['data_air_menuid']);
			$SQL = 'SELECT * FROM air_menu WHERE air_menuid="'.$data_air_menuid.'" LIMIT 1';
			$RS =$db->Execute($SQL);
			if ($RS != false)
			{
				$is_edit = true; 
				
				$data_air_menuname 	= stripslashes($RS->fields['air_menuname']);
				$data_air_menuurl 	= stripslashes($RS->fields['air_menuurl']);
				$data_catair_menuparent		= $RS->fields['air_menuparent'];
				$data_productthumbnail 	= $RS->fields['image'];
			}
			
		}
		
		include('templates/catproduct_insert.php');
	break;


}
?>