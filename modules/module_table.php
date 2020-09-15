<?php
$module=$_GET['module'];
$pm=$_GET['pm'];
$page_tmp = $_SERVER['PHP_SELF']."?module=$module&pm=$pm";
$page=str_replace(".php","",$page_tmp);

###########################################################
if (isset($_GET['iDisplayStart']) && ($_GET['iDisplayStart'] !='0')  ) {
    $displayStart=$_GET['iDisplayStart'];
} else {
    $displayStart=0;
}

?>
<!-- <link rel="stylesheet" type="text/css">
<style>
.modal-body {
position: relative;
padding: 20px;
height: 700px;

}
</style> -->


<div class="page-content">


 



  

<script src="assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>

<!--<script type="text/javascript" src="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>-->

<script src="assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/table-advanced.js"></script>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/chosen.css">
    
    <style type="text/css" class="init">
    </style>
    <script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="extensions/TableTools/js/dataTables.tableTools.js"></script>
    <script type="text/javascript" language="javascript" src="examples/resources/syntax/shCore.js"></script>
    <script type="text/javascript" language="javascript" src="examples/resources/demo.js"></script>

<script type="text/javascript" charset="utf-8">


    


$(document).ready( function() {

  
    
    $('#list_ass_bangsal').dataTable({
        "bFilter": true,
        "bInfo": true,      
        "processing": true,
        "serverSide": true,
        "sAjaxSource": "../mydashboard/modules/server_side/server_processing_dashboard.php?act1=<?php echo "$act1&srcby=$srcby&srckey=$srckey&module=$module&pm=$pm";?>",
        "iDisplayLength": 50,
        "iDisplayStart": <?php echo $displayStart;?>,

        "dom": 'Bfrtip',
        "buttons": [
            {
            extend: 'print',
            text: 'Print',
            autoPrint: true
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
            },
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
            },
            'colvis'
        ]
          
    });

    


    
    
    
}); // document ready   $(document).ready(function() {
</script> 




                    <!-- END BREADCRUMBS -->
                    <!-- BEGIN SIDEBAR CONTENT LAYOUT -->
                     <div class="page-content-container">
                        <div class="page-content-row">
                           
                          
                           
                            <div class="page-content-col">
                             
                                
                            
                                
                        <div class="row">
                        <div class="col-md-12">

                        
                        <div class="portlet light grey-steel bordered ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-red-sunglo"></i>
                                            <span class="caption-subject font-red-sunglo bold "> List Of <?=getNamaMenu($module);?> Assessment</span>
                                            <span class="caption-helper"> </span>
                                        </div>
                                        <div class="actions">
                                            
                                        </div>
                                    </div>

                        <div class="portlet-body form">
                        
                            
                            <table class="table table-striped table-bordered table-hover" id="list_ass_bangsal" width="100%">
                            <thead>
                            <tr>
                               <!--  <th> <b>No</b></th> -->
                                <th width="5%"><b>No</b></th>
                                <th width="15%"><b>Entry Date</th>
                                <th width="15%"><b>APP</b></th>
                                <th width="45%"><b>Control</b></th>
                                <th width="10%"><b>Value</b></th>
                                <th width="10%"><b>Prosentase</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    
                    

                                        
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
 




                    <!-- END SIDEBAR CONTENT LAYOUT -->
                </div>

              
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>

