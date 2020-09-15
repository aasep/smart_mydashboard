<?php

 if (isset($_GET['module']) && isset($_GET['module'])!="") {

 	$module=$_GET['module'];

	if (!isset($_SESSION['GROUP_USER']) ){
		session_destroy();
		header("location: login.php");
		die();
		
	} else {
			   //cek di tabel menu
					$SQL = " SELECT idmenu from menu where Src='$module' ";

                    //echo $SQL;
                   // die();
                    $RS  = $db->Execute($SQL);
                
                        if(!empty($RS->fields['idmenu'])){
                    
                                $num = $RS->RecordCount();

						   if ($num >=1){
						   			$id_menu=($RS->fields['idmenu']);
					       			$SQL2 =" SELECT * FROM group_menu where groupid='$_SESSION[GROUP_USER]' AND idmenu='$id_menu' ";
					       			$RS2  = $db->Execute($SQL2);
					       			$num2 = $RS2->RecordCount();
					      			  
						       		if ($num2 == 0)
						            	{
									       //header("location: temp_session_group");
									       header("location: home");
									       die();
								
									}
						
						
					        } 
					    }
					
			} //end isset module
				
		} // end else
				
?>