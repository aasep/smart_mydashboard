<?php
$module=$_GET['module'];
$pm=$_GET['pm'];
$page_tmp = $_SERVER['PHP_SELF']."?module=$module&pm=$pm";
$page=str_replace(".php","",$page_tmp);

###########################################################

?>

<div class="page-content">
                    <!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <!-- <div class="note note-success"> -->
                        <div class="m-heading-1 border-green m-bordered">
                                     <h1> <i class="icon-settings"></i> <?php echo getParentMenuName(getParentMenu($module));?>   <i class="fa fa-angle-right"></i> <?=getNamaMenu($module);?> </h1> 

                                                    <br>
                                                    <br>
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
    
<a class="btn green btn-outline sbold" data-toggle="modal" href="#basic"> ADD <?=getNamaMenu($module);?> <i class="icon-user-follow"></i> </a>
<br>
<br>
  <!-- modal insert -->   
        <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title"></h4>
                            </div>
                    <div class="modal-body">

                        <div class="portlet light portlet-fit portlet-form bordered">
                                <div class="portlet-title">
                                        <div class="caption">
                                                    <i class="icon-settings font-dark"></i>
                                                    <span class="caption-subject font-dark sbold uppercase">ADD <?=getNamaMenu($module);?> </span>
                                        </div>       
                                </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo "modules/actions_master.php?module=$module&pm=$pm&act=add_menu"; ?>" id="form_sample_3" class="form-horizontal"  method="POST" >
                                <div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                    <div class="alert alert-success display-hide">
                                        <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                                       
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label bold">Menu Name
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-desktop"></i>
                                                                    </span>
                                                                    <input type="text" name="name" data-required="1" class="form-control" placeholder="Menu Name"/> 
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-4 bold">Parent Menu
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <select class="form-control" name="parent" >
                                                                    <option value="0">No Parent (as Parent)</option>

                                                    <?php
                                                        $query_group="select * from smart_menu where parentmenu='0' ";
                                                        $RS  = $db->Execute($query_group);
                                                        while(!$RS->EOF){
                                                            echo "<option value='".$RS->fields['idmenu']."'>".$RS->fields['menuname']."</option>";
                                                            $RS->MoveNext();
                                                        }
                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>



                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label bold">Address
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-link"></i>
                                                                    </span>
                                                                    <input type="text" name="address" class="form-control" placeholder="address"> </div>
                                                            </div>
                                                        </div>
                                                        
                                                       
                                </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">Submit</button>
                                                                <!-- <input type="submit" value="submit" class="btn green"> -->
                                                                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                        <!-- END VALIDATION STATES-->
                        </div>   

                    </div>
                                                            <div class="modal-footer">
                                                                
                                                                
                                                            </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
  <!-- modal end insert -->
        <!-- modal edit -->
            <div class="modal fade" id="view-edit" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title"></h4>
                            </div>
                    <div class="modal-body">

                        <div class="portlet light portlet-fit portlet-form bordered">
                                <div class="portlet-title">
                                        <div class="caption">
                                                    <i class="icon-settings font-dark"></i>
                                                    <span class="caption-subject font-dark sbold uppercase">EDIT <?=getNamaMenu($module);?> </span>
                                        </div>       
                                </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo "modules/actions_master.php?module=$module&pm=$pm&act=edit_menu"; ?>" id="form_sample_2" class="form-horizontal" method="POST">
                                <div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                   <!--  <div class="alert alert-success display-hide">
                                        <button class="close" data-close="alert"></button> Your form validation is successful! </div> -->
                                                       
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label bold">Menu Name
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-desktop"></i>
                                                                    </span>
                                                                    <input type="text" name="name" id="name" data-required="1" class="form-control" placeholder="Menu Name"/> 
                                                                    <input type="hidden" name="idmenu" id="idmenu" data-required="1" class="form-control" placeholder="Menu Name"/> 
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-4 bold">Parent Menu
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <select class="form-control" name="parent" id="parent">
                                                                    <option value="0">No Parent (as Parent)</option>

                                                    <?php
                                                        $query_group="select * from smart_menu where parentmenu='0' ";
                                                        $RS  = $db->Execute($query_group);
                                                        while(!$RS->EOF){
                                                            echo "<option value='".$RS->fields['idmenu']."'>".$RS->fields['menuname']."</option>";
                                                            $RS->MoveNext();
                                                        }
                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>



                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label bold">Address
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-link"></i>
                                                                    </span>
                                                                    <input type="text" name="address" id="address" class="form-control" placeholder="address"> </div>
                                                            </div>
                                                        </div>
                                                        
                                </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">Submit</button>
                                                                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                        <!-- END VALIDATION STATES-->
                        </div>   

                    </div>
                                                            <div class="modal-footer">
                                                                
                                                                
                                                            </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        <!-- end modal edit -->




<!--  delete modal  -->


                <div class="modal fade" id="delete-modal" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title"></h4>
                            </div>
                    <div class="modal-body">

                        <div class="portlet light portlet-fit portlet-form bordered">
                                <div class="portlet-title">
                                        <div class="caption">
                                                    <i class="icon-settings font-dark"></i>
                                                    <span class="caption-subject font-dark sbold uppercase">DELETE <?=getNamaMenu($module);?> </span>
                                        </div>       
                                </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo "modules/actions_master.php?module=$module&pm=$pm&act=delete_menu"; ?>" class="form-horizontal" method="POST" class="form-horizontal">
                                <div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                    <div class="alert alert-success display-hide">
                                        <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                                       
                                                        <div  class="alert alert-danger" id="list-user">
                                                            
                                                        </div>
                                                        
                                </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn red">Submit</button>
                                                                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                        <!-- END VALIDATION STATES-->
                        </div>   

                    </div>
                                                            <div class="modal-footer">
                                                                
                                                                
                                                            </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>



<!--  end delete modal -->






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

                        <!--  portlet box grey-gallery -->
                        <div class="portlet light grey-steel bordered ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-red-sunglo"></i>
                                            <span class="caption-subject font-red-sunglo bold uppercase"> List Of <?=getNamaMenu($module);?> </span>
                                            <span class="caption-helper"> </span>
                                        </div>
                                        <div class="actions">
                                            
                                        </div>
                                    </div>

                        <div class="portlet-body form">
                        
                            
                            <table class="table table-striped table-bordered table-hover" id="sample_2">
                            <thead>
                            <tr>
                                <th> <b>No</b></th>
                                
                                <th><b>Menu Name</b></th>
                                <th><b>Parent</b></th>
                                <th><b>Kode (ID Menu)</b></th>
                                <th><b>Address</b></th>
                                <th><b>Create By</b></th>
                                <th><b>Action</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
                            $no_parent=1;

                            $query =" select * from smart_menu where parentmenu='0' order by idmenu asc ";
                            $RS  = $db->Execute($query);
                           
                            while(!$RS->EOF){
                            $submenu=1;  
                            echo "<tr>";
                            echo "<td width='10%'>$no_parent</td>";
                            echo "<td width='30%'>".$RS->fields['menuname']."</td>";
                            echo "<td width='5%'>".$RS->fields['parentmenu']."</td>";
                            echo "<td width='5%'>".$RS->fields['idmenu']."</td>";
                            echo "<td width='20%'>".$RS->fields['address']."</td>";
                            echo "<td width='10%'>".$RS->fields['addby']."</td>";
                            echo "<td width='20%'><a class='detailEdit' data-toggle='modal' data-target='#view-edit' href='#' id-idmenu='".$RS->fields['idmenu']."' id-menuname='".$RS->fields['menuname']."'   
id-parentmenu='".$RS->fields['parentmenu']."'  id-address='".trim($RS->fields['address'])."'  ><button class='btn default'>Edit</button></a></a> <a href='#'  data-toggle='modal' id-menuname='".$RS->fields['menuname']."'   
id-parentmenu='".$RS->fields['parentmenu']."'  id-address='".trim($RS->fields['address'])."' id-idmenu='".$RS->fields['idmenu']."' data-target='#delete-modal' class='detailDelete' > <button class='btn red'>Delete</button></a></td>";
                            echo "</tr>";
                            
                                    

                            $SQL2 ="select * from smart_menu where parentmenu='".$RS->fields['idmenu']."' AND parentmenu <> '0'  order by idmenu asc ";
                            $RS2  = $db->Execute($SQL2);

                                    while(!$RS2->EOF){ // loop submenu 1  RS2


                                                        echo "<tr>";
                                                        echo "<td width='10%'>$no_parent . $submenu </td>";
                                                        echo "<td width='30%'>".$RS2->fields['menuname']."</td>";
                                                        echo "<td width='5%'>".$RS2->fields['parentmenu']."</td>";
                                                        echo "<td width='5%'>".$RS2->fields['idmenu']."</td>";
                                                        echo "<td width='20%'>".$RS2->fields['address']."</td>";
                                                        echo "<td width='10%'>".$RS2->fields['addby']."</td>";
                                                        echo "<td width='20%'><a class='detailEdit' data-toggle='modal' data-target='#view-edit' href='#' id-idmenu='".$RS2->fields['idmenu']."' id-menuname='".$RS2->fields['menuname']."'   
                            id-parentmenu='".$RS2->fields['parentmenu']."'  id-address='".trim($RS2->fields['address'])."'  ><button class='btn default'>Edit</button></a></a> <a href='#'  data-toggle='modal' id-menuname='".$RS2->fields['menuname']."'   
                            id-parentmenu='".$RS2->fields['parentmenu']."'  id-address='".trim($RS2->fields['address'])."' id-idmenu='".$RS2->fields['idmenu']."' data-target='#delete-modal' class='detailDelete' > <button class='btn red'>Delete</button></a></td>";
                                                        echo "</tr>";



                                            // cek submenu 1 punya anak lagi 
                                            $SQL_cek ="select count(idmenu) as jml_menu from smart_menu where parentmenu='".$RS2->fields['idmenu']."' AND parentmenu <> '0' ";
                                            $RS_cek  = $db->Execute($SQL_cek);

                                            if($RS_cek->fields['jml_menu'] >=1){

                                                //echo $SQL_cek;
                                                //die();

                                                        
                                                        // echo "</tr>";
                                                    

                                                $SQL3 ="select * from smart_menu where parentmenu='".$RS2->fields['idmenu']."' AND parentmenu <> '0' order by idmenu asc ";
                                                $RS3  = $db->Execute($SQL3);
                                                //echo $SQL3;
                                                $submenu2=1;
                                                while(!$RS3->EOF){

                                                        echo "<tr>";
                                                        echo "<td width='10%'>$no_parent . $submenu . $submenu2</td>";
                                                        echo "<td width='30%'>".$RS3->fields['menuname']."</td>";
                                                        echo "<td width='5%'>".$RS3->fields['parentmenu']."</td>";
                                                        echo "<td width='5%'>".$RS3->fields['idmenu']."</td>";
                                                        echo "<td width='20%'>".$RS3->fields['address']."</td>";
                                                        echo "<td width='10%'>".$RS3->fields['addby']."</td>";
                                                        echo "<td width='20%'><a class='detailEdit' data-toggle='modal' data-target='#view-edit' href='#' id-idmenu='".$RS3->fields['idmenu']."' id-menuname='".$RS3->fields['menuname']."'   
                            id-parentmenu='".$RS3->fields['parentmenu']."'  id-address='".trim($RS3->fields['address'])."'  ><button class='btn default'>Edit</button></a></a> <a href='#'  data-toggle='modal' id-menuname='".$RS3->fields['menuname']."'   
                            id-parentmenu='".$RS3->fields['parentmenu']."'  id-address='".trim($RS3->fields['address'])."' id-idmenu='".$RS3->fields['idmenu']."' data-target='#delete-modal' class='detailDelete' > <button class='btn red'>Delete</button></a></td>";
                                                        echo "</tr>";



                                                    $submenu2++;
                                                    $RS3->MoveNext();

                                                }


                                                
                                                    

                                            }

                                        $submenu++;     
                                        $RS2->MoveNext();

                                    }





















                                    $i++;
                                    $RS->MoveNext();


                                    }
                            ?>


                            </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- END EXAMPLE TABLE PORTLET-->

                                        
                                    </div>
                                </div>
                                <!-- END PAGE BASE CONTENT -->
                            </div>
                        </div>
                    </div>
                    <!-- END SIDEBAR CONTENT LAYOUT -->
                </div>

                <!-- <script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
                <script type="text/javascript" src="assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>  -->

                
<!--                 <script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>  --> 
               <!--  <script src="assets/pages/scripts/form-validation.min.js" type="text/javascript"></script> -->
                <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script>
$(document).ready(function() {

    $('.detailDelete').click(function() {
        var idmenu      = $(this).attr('id-idmenu');
        var menuname    = $(this).attr('id-menuname');
        var parentmenu  = $(this).attr('id-parentmenu');
        var address     = $(this).attr('id-address');
    
          //alert(id_user);
            $("#list-user").empty();
            $("#list-user").append( 
                '<tr>'+
                '<td>'+'<div class="alert alert-danger"><h5> Yakin Anda Akan Mendelete Menu  '+'<strong>' + menuname +'</strong></h5></div>'+
                '<input type="hidden" name="idmenu" value="'+idmenu+'">'+
                '</td></tr>');
    });

    $('.detailEdit').click(function() {

        var idmenu      = $(this).attr('id-idmenu');
        var menuname    = $(this).attr('id-menuname');
        var parentmenu  = $(this).attr('id-parentmenu');
        var address     = $(this).attr('id-address');

        document.getElementById('idmenu').value=idmenu;
        document.getElementById('name').value=menuname;
        document.getElementById('parent').value=parentmenu;
        document.getElementById('address').value=address;



            }); 

}); // document ready   $(document).ready(function() {

    </script>