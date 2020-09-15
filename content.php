<?php

      if( isset($_GET['module']) ){

                $query=" select * from smart_menu WHERE src='".$_GET['module']."' and parentmenu <> 0 ";
                $RM  = $db->Execute($query);

                    if (!empty($RM->fields['idmenu'])){


                            if(!file_exists("modules/".$RM->fields['address'].".php")){
                                        include "modules/not_exist_file.php";
                                        //logActivity("Read Only","Dosent Exist File");
                            } else {
                                        include "modules/".$RM->fields['address'].".php";
                                        //logActivity("Read Only","MENU=".$RM->fields['IdMenu'].", ".$RM->fields['Address']);
                                }

                    }else {   // not found mode
                             include "modules/notfound.php";
                             //logActivity("Read Only","Not Found Menu");
                        }
        } else {
                    include "modules/module_home.php";
            }
//14
//.module_list_leads_data
//module_upload_adjustment_fr.php
?>