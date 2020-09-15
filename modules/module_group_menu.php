<?php
$module=$_GET['module'];
$pm=$_GET['pm'];
$page_tmp = $_SERVER['PHP_SELF']."?module=$module&pm=$pm";
$page=str_replace(".php","",$page_tmp);

###########################################################

    if(isset($_POST['id_group'])){
            $id_group=$_POST['id_group'];   
    } else if (isset($_GET['id_group'])){
            $id_group=$_GET['id_group'];    

        } else {

                  $id_group="";
            }



?>

<div class="page-content">
                    <!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <!-- <div class="note note-success"> -->
                        <div class="m-heading-1 border-green m-bordered">
                                     <h1> <i class="icon-settings"></i> <?php echo getParentMenuName(getParentMenu($module));?>   <i class="fa fa-angle-right"></i> <?=getNamaMenu($module);?> </h1> 

                                                    <p>Detail Information for " <?=getNamaMenu($module);?> "</p>
                                                </div>

                                    
                        </div>

                    <!-- </div> -->

 <?php
    if (isset($_GET['message']) && ($_GET['message']=="success")){
        echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button><strong> Successful Inserted ".getNamaMenu($module)." ...! </strong> </div>";
     }
    if (isset($_GET['message']) && ($_GET['message']=="error")){
        echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button><strong> Failed Inserted ".getNamaMenu($module)."...!</strong> </div>";
    }
    if (isset($_GET['message']) && ($_GET['message']=="error1")){
        echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button><strong> Failed Insert Already Exist ".getNamaMenu($module)." $_GET[var] ...!</strong> </div>";
    }
    if (isset($_GET['message']) && ($_GET['message']=="success2")){
        echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button><strong> Successful Deleted ....! </strong> </div>";
    }
    if (isset($_GET['message']) && ($_GET['message']=="error2")){
        echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button><strong>Data Gagal Dihapus...!</strong> </div>";
    }
    if (isset($_GET['message']) && ($_GET['message']=="success3")){
        echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button><strong>Successful Updated ....! </strong> </div>";
    }
    if (isset($_GET['message']) && ($_GET['message']=="error3")){
        echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button><strong>Data Gagal Diupdate...!</strong> </div>";
    }




?>
    
            <!-- BEGIN PAGE CONTENT-->
        <div class="portlet light grey-steel bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-red-sunglo"></i>
                                            <span class="caption-subject font-red-sunglo bold uppercase"> FORM Group Menu </span>
                                            <span class="caption-helper"> </span>
                                        </div>
                                        <div class="actions">
                                            
                                        </div>
                                    </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo "$page"; ?>" id="form_sample_3" class="form-horizontal" method="POST">
                                <div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button>
                                        You have some form errors. Please check below.
                                    </div>
                                    <div class="alert alert-success display-hide">
                                        <button class="close" data-close="alert"></button>
                                        Your form validation is successful!
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Group User <span class="required">
                                        * </span>
                                        </label>
                                        <div class="col-md-4">
                                            <select class="form-control" name="id_group" id="id_group">
                                                <option value="">Choose Group User</option>


                                                <?php
                                                $query_group="select * from smart_group_user   ";
                                                $RS  = $db->Execute($query_group);
                                                while(!$RS->EOF){

                                                    if ($id_group==$RS->fields['groupid']){
                                                        echo "<option value='".$RS->fields['groupid']."' selected='selected'>".$RS->fields['groupname']."</option>"; 
                                                    } else {
                                                        echo "<option value='".$RS->fields['groupid']."'>".$RS->fields['groupname']."</option>";
                                                        }


                                                    
                                                    $RS->MoveNext();

                                                }
                                                ?>



                                                
                                                ?>
                                            
                                                
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">.
                                        </label>
                                        <div class="col-md-4">
                                            <input type="submit" value="Submit" class="btn blue"/>
                                        </div>
                                    </div>
                                    
                                    </form>
                                </div>
                                
                            
                        </div>
                    </div>
            <!-- END PAGE CONTENT-->



           <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light grey-steel bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-red-sunglo"></i>
                                            <span class="caption-subject font-red-sunglo bold uppercase"> List Of Group Menu </span>
                                            <span class="caption-helper"> </span>
                                        </div>
                                        <div class="actions">
                                            
                                        </div>
                                    </div>
                        <div class="portlet-body">
                        <form name="form1" method="post" action="" > 
                            <table class="table table-striped table-bordered table-hover" id="sample_2">
                            <thead>
                            <tr>
                            <th>
                                    No
                                </th>
                                <th>
                                    # 
                                </th>
                                <th>
                                
                                </th>
                                <th>
                                Nama menu
                                </th>
                                <th>
                                    Status
                                </th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                             if (isset($id_group) && $id_group!="" ){
                            $no=1;
                            $no_parent=1;


                            $SQL="select * from smart_menu where parentmenu = '0' ";
                            $RS2  = $db->Execute($SQL);

                                while(!$RS2->EOF){
                                        

                                    $no_sub=1;  
                                    echo "<tr bgcolor='#F0F0F0'>";
                                    echo "<td>$no</td>";
                                    echo "<td>$no_parent</td>";
                                    echo "<td></td>";
                                    echo "<td><b>".$RS2->fields['menuname']."</b></td>";
                                    echo "<td></td></tr>";

                                        $SQL3="select * from smart_menu where parentmenu = '".$RS2->fields['idmenu']."' ";
                                        $RS3  = $db->Execute($SQL3);
                                        $no_sub=1;
                                        while(!$RS3->EOF){
                                            
                                            
                                            // cek punya anak lagi enggak ???
                                            $SQL_CEK    = " select count(*) as jml_row from smart_menu where parentmenu = '".$RS3->fields['idmenu']."' ";
                                            $RS_CEK     = $db->Execute($SQL_CEK);
                                            $is_child   = $RS_CEK->fields['jml_row'];


                                            


                                            
                                                
                                            $no++;

                                            if ($is_child >0){

                                                    $SQL_child=" select * from smart_menu where parentmenu = '".$RS3->fields['idmenu']."' ";
                                                    $RS_child  = $db->Execute($SQL_child);

                                                    echo "<tr>";
                                                    echo "<td>$no</td>";
                                                    echo "<td>$no_parent.$no_sub</td>";
                                                    echo "<td></td>";
                                                    echo "<td> <i class='fa fa-play'></i><strong> ".$RS3->fields['menuname']." </strong></td>";
                                                    echo "<td></td></tr>";
                                                    $no_sub++;
                                                    $no_sub2=1;
                                                    while (!$RS_child->EOF) {

                                                            // cek group menu 
        

                                                        // cek ada anak lagi g dibawahnya
                                                        $qCek       ="  select count(*) as jml_child from smart_menu where parentmenu = '".$RS_child->fields['idmenu']."' ";
                                                        $rCek       =   $db->Execute($qCek);
                                                        $jml_child  =   $rCek->fields['jml_child'];

                                                        if ($jml_child >0){
                                                        // jika ada loop anak dibawahnya
                                                            $SQL5       ="  select * from smart_menu where parentmenu = '".$RS_child->fields['idmenu']."' ";
                                                            $RS5        =   $db->Execute($SQL5);
                                                            //$jml_child    =   $RS5->fields['jml_child'];


                                                                echo "<tr>";
                                                                echo "<td>$no</td>";
                                                                echo "<td>$no_parent.$no_sub</td>";
                                                                echo "<td></td>";
                                                                echo "<td> <i class='fa fa-play'></i> <i class='fa fa-forward'></i> <strong> ".$RS_child->fields['menuname']." </strong></td>";
                                                                echo "<td></td></tr>";
                                                                $no_sub3=1;
                                                                while(!$RS5->EOF) {

                                                                    $SQL4 =" SELECT groupmenuid FROM smart_group_menu  WHERE groupid='$id_group' AND idmenu='".$RS5->fields['idmenu']."' ";
                                                                    $RS4  = $db->Execute($SQL4);
                                                                    $found= $RS4->RowCount();

                                                                    if($found >=1){
                                                                            $status="<a class='btn green disabled' href='$page&act=edit_menu&nama_menu=".$RS_child->fields['menuname']."&parent=".$RS_child->fields['parentmenu']."&id_menu=".$RS_child->fields['idmenu']." disable='disabled''>Active</a>";
                                                                    } else {
                                                                            $status="<a href='#'  data-toggle='modal' id-menu='".$RS_child->fields['idmenu']."' id-nama='".$RS_child->fields['menuname']."' data-target='#delete-modal' class='detailDelete' > <button class='btn red disabled' >In Active</button></a>";
                                                                }

                                                                    echo "<tr>";
                                                                    echo "<td>$no</td>";
                                                                    echo "<td>$no_parent.$no_sub.$no_sub2.$no_sub3</td>";
                                                                    echo "<td> <input type='checkbox' name='checkbox[]' class='checkboxes' value='".$RS5->fields['idmenu']."'  /></td>";
                                                                    echo "<td> <i class='fa fa-play'></i> <i class='fa fa-forward'></i> <i class='fa fa-forward'></i> ".$RS5->fields['menuname']."</td>";
                                                                    echo "<td> $status</td></tr>";


                                                                $no_sub3++;
                                                                $RS5->MoveNext();
                                                                }








                                                        }else{
                                                                    echo "<tr>";
                                                                    echo "<td>$no</td>";
                                                                    echo "<td>$no_parent.$no_sub.$no_sub2</td>";
                                                                    echo "<td> <input type='checkbox' name='checkbox[]' class='checkboxes' value='".$RS_child->fields['idmenu']."'  /></td>";
                                                                    echo "<td> <i class='fa fa-play'></i> <i class='fa fa-forward'></i> ".$RS_child->fields['menuname']."</td>";
                                                                    echo "<td> $status</td></tr>";
                                                                    //$no_sub++;
                                                                    $no_sub2++;

                                                        }

                                                
                                                        $RS_child->MoveNext();
                                                        
                                                    }
                                                $no_sub++;  

                                            }else{

                                                    // cek group menu 
                                                    $SQL4=" SELECT groupmenuid FROM smart_group_menu  WHERE groupid='$id_group' AND idmenu='".$RS3->fields['idmenu']."' ";
                                                    $RS4  = $db->Execute($SQL4);
                                                    $found= $RS4->RowCount();
                                                    
                                                    if($found >=1){
                                                        $status="<a class='btn green disabled' href='$page&act=edit_menu&nama_menu=".$RS3->fields['menuname']."&parent=".$RS3->fields['parentmenu']."&id_menu=".$RS3->fields['idmenu']." disable='disabled''>Active</a>";
                                                    } else {
                                                        $status="<a href='#'  data-toggle='modal' id-menu='".$RS3->fields['idmenu']."' id-nama='".$RS3->fields['menuname']."' data-target='#delete-modal' class='detailDelete' > <button class='btn red disabled' >In Active</button></a>";
                                                    }

                                                    echo "<tr>";
                                                    echo "<td>$no</td>";
                                                    echo "<td>$no_parent.$no_sub</td>";
                                                    echo "<td> <input type='checkbox' name='checkbox[]' class='checkboxes' value='".$RS3->fields['idmenu']."'  /></td>";
                                                    echo "<td><i class='fa fa-play'></i> ".$RS3->fields['menuname']."</td>";
                                                    echo "<td> $status</td></tr>";
                                                    $no_sub++;

                                            }

                                            /*
                                            jika punya anak lagi
                                                // loop child again
                                                    
                                                then loop again
                                            else
                                                print regular   

                                            */


                                            




                                            $RS3->MoveNext();

                                        }



                                    $no_parent++;
                                    $no++;
                                    $RS2->MoveNext();

                                }


                                
                            }
                            ?>
                            
                            
                            </tbody>
                            </table>

                        </div>

                    </div>


                    <!-- END EXAMPLE TABLE PORTLET-->
                    <div class="portlet default">
                        
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <div class="m-grid m-grid-demo">
                                                    <div class="m-grid-row">
                                                       
                                                        <div class="m-grid-col m-grid-col-middle m-grid-col-center m-grid-col-md-6"><input type="submit" value=" Active " name="hidup" id="hidup" class="btn green "/></div>
                                                       <div class="m-grid-col m-grid-col-middle m-grid-col-center m-grid-col-md-6"><input type="submit" value=" In Active " name="mati" id="mati"  class="btn red"/>
                                             <input type="hidden" name="id_group" value="<?php echo $id_group;?>"></div>
                                                    </div>
                                                    <!-- <div class="m-grid-row">
                                                       
                                                        <div class="m-grid-col m-grid-col-middle m-grid-col-center m-grid-col-md-12"><input type="submit" value=" In Active " name="mati" id="mati"  class="btn red"/>
                                             <input type="hidden" name="id_group" value="<?php echo $id_group;?>"></div>
                                                        
                                                    </div> -->
                                                </div>


                                <!-- <div class="form-body">

                                    <div m-grid-col-center">
                                        <label class="control-label col-md-3">.
                                        </label>
                                        <div class="  col-md-2 m-grid-col-center">
                                            <input type="submit" value=" Active " name="hidup" id="hidup" class="btn green "/>  
                                        </div>
                                        <div class=" col-md-2 m-grid-col-center">
                                            <input type="submit" value=" In Active " name="mati" id="mati"  class="btn red"/>
                                             <input type="hidden" name="id_group" value="<?php echo $id_group;?>">
                                        </div>
                                    </div>
     
                                </div> -->
                                
                            
                        </div>
                    </div>

    <?php
//echo $sql;
// Check if delete button active, start this
    if(isset($_POST['hidup'])){
        for($i=0;$i<count($_POST['checkbox']);$i++){
                $del_id=$_POST['checkbox'][$i];

                // cek apakah id_menu dg group user X di tabel group menu sudah ada
                $query_cek=" SELECT groupmenuid FROM smart_group_menu  WHERE groupid='$id_group' AND idmenu='$del_id' ";
                //echo $query_cek."</br>";
                $RS  = $db->Execute($query_cek);
                $found_priv = $RS->RowCount();
                             //$result_cek = odbc_exec($connection,$query_cek);
                             //$found_priv = odbc_num_rows($result_cek);

                if ($found_priv >=1)
                {  
                    $result_priv=1;
                } else {
                        //insert
                        $sql_priv=" INSERT INTO smart_group_menu (groupid,idmenu,adddt,addby) values ('$id_group','$del_id',current_timestamp,'$_SESSION[USERNAME]') ";
                        //echo $sql_priv."</br>";
                        //$result_priv = odbc_exec($connection,$sql_priv);
                        $RS2  = $db->Execute($sql_priv);
                        logActivity("ADD GROUP MENU","MENU=4, groupid=$id_group ,idmenu=$del_id");
                        //logTransaction("Add_Group_Menu","MENU=4, id_group=$id_group,id_menu='$del_id' ");

                    }

        }   // end loop for
            // if successful redirect to delete_multiple.php
                if($RS !=false || $RS2 !=false)
                {
                        //logActivity("Add_Group_Menu","MENU=4, id_group=$id_group ");
                        echo "<meta http-equiv=\"refresh\" content=\"0;URL=home?module=$module&pm=$pm&id_group=$id_group\">";
                }
    } // end if isset post
    //echo $sql_priv."</br>";

//jika tekan tombol non aktif
    if(isset($_POST['mati'])){
        for($i=0;$i<count($_POST['checkbox']);$i++){
                $del_id=$_POST['checkbox'][$i];

                        // cek apakah id_menu dg group user X di tabel group menu sudah ada
                        $query_cek=" SELECT groupmenuid FROM smart_group_menu  WHERE groupid='$id_group' AND idmenu='$del_id'";
                        //echo $query_cek."</br>";
                        $RS  = $db->Execute($query_cek);
                        $found_priv = $RS->RowCount();
                        //$result_cek = odbc_exec($connection,$query_cek);
                        //$found_priv = odbc_num_rows($result_cek);

                if ($found_priv >=1){  //delete
                        $sql_priv=" DELETE FROM smart_group_menu where groupid='$id_group' AND idmenu='$del_id' ";
                        //echo $query_cek."</br>";
                         //$result_priv = odbc_exec($connection,$sql_priv);
                         $RS2  = $db->Execute($sql_priv);
                         
                         logActivity("DELETE GROUP MENU","MENU=4, groupid=$id_group,idmenu=$del_id ");
                    
                 } 

        } 
                if($RS != false){
                        //logActivity("Delete_Group_Menu","MENU=4, id_group=$id_group ");
                        echo "<meta http-equiv=\"refresh\" content=\"0;URL=home?module=$module&pm=$pm&id_group=$id_group\">";
                }
    } 

?>    

 </form>   


</div>