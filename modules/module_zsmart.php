
<?php
$module=$_GET['module'];
$pm=$_GET['pm'];
$page_tmp = $_SERVER['PHP_SELF']."?module=$module&pm=$pm";
$page=str_replace(".php","",$page_tmp);

###########################################################

?>

<div class="page-content">
                    

    


                    <!-- END BREADCRUMBS -->
                    <!-- BEGIN SIDEBAR CONTENT LAYOUT -->
                    <div class="page-content-container">
                        <div class="page-content-row">
                            <!-- BEGIN PAGE SIDEBAR -->
                          
                            <!-- END PAGE SIDEBAR -->
                            <div class="page-content-col">
                                <!-- BEGIN PAGE BASE CONTENT -->
                                
 


                                <!-- END PAGE BASE CONTENT -->
                            </div>
                        </div>
                    </div>
                    <!-- END SIDEBAR CONTENT LAYOUT -->


                        <div class="portlet light portlet-fit portlet-form bordered">
                                <div class="portlet-title">
                                        <div class="caption">
                                                    <i class="icon-settings font-dark"></i>
                                                    <span class="caption-subject font-dark sbold uppercase"> CHART <?=getNamaMenu($module);?></span>
                                        </div>       
                                </div>
                        <div class="portlet-body">
                        <div class="row">
                                                    <!-- Styles -->
<div id="chartdiv"></div>
</div>
</div>
</div>
</div>
<!-- Resources -->
<script src="assets/global/plugins/amchart2/amcharts.js"></script>
<script src="assets/global/plugins/amchart2/serial.js"></script>
<script src="assets/global/plugins/amchart2/export.min.js"></script>
<link rel="stylesheet" href="assets/global/plugins/amchart2/export.css" type="text/css" media="all" />
<script src="assets/global/plugins/amchart2/light.js"></script>
<script src="assets/global/plugins/amchart2/chalk.js"></script>

<script src="assets/global/plugins/amcharts/amcharts/exporting/amexport.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/amcharts/exporting/canvg.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/amcharts/exporting/rgbcolor.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/amcharts/exporting/filesaver.js" type="text/javascript"></script>

<script src="assets/global/plugins/amcharts/amcharts/exporting/jspdf.plugin.addimage.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/amcharts/exporting/jspdf.js" type="text/javascript"></script>


<script src="library/4/core.js"></script>
<script src="library/4/charts.js"></script>
<script src="library/4/animated.js"></script>

<!--                 <script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script> -->



<!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 800px;
}

</style>

<!-- Resources -->
<!-- <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
 -->
<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);



// Add data
chart.data = [<?php 

$date = date_create_from_format("Y/m/d",date("Y/m")."/01");


$start = $month = strtotime('2020-08-01');
$end = strtotime(date_format($date,"Y-m-d"));
$tgl_start = array(12);
$tgl_end = array(12);
$i=1;
$numMonths = 1 + (date("Y",$end)-date("Y",$start))*12;
$numMonths += date("m",$end)-date("m",$start);

$jml_tgl=countTglDashZSMART();

  $q_loop= " select distinct entry_date FROM dashboard_activity where sys_name='ZSMART' ";
  $RQ   = $db->Execute($q_loop);
  while(!$RQ->EOF){
        $z=1;
        $date_dash= date('Y-m-d',strtotime($RQ->fields['entry_date']));
        $jml_par= countTglDashZSMART2($date_dash);
                echo '{';
                echo '"date":"'.$date_dash.'",';

        ####### Query expand  ########
        $query1 = " select entry_date,control,value as jml from dashboard_activity where entry_date = '".$date_dash."' and sys_name='ZSMART' ";
        //echo $query1."<br>";
         $RS1    = $db->Execute($query1);
         
            while(!$RS1->EOF){

                if($z==$jml_par){
                     echo '"'.$RS1->fields['control'].'":'.$RS1->fields['jml'] .'';
                }else{
                     echo '"'.$RS1->fields['control'].'":'.$RS1->fields['jml'] .',';
                }
                



                $z++;                                             
                $RS1->MoveNext();
            }


            if ($i==$jml_tgl){
                    echo "}";
                }else{
                    echo "},";
                    }
                       
      
        




     $i++;

     $RQ->MoveNext();
  }  

?>
];

<?php
 $control_label=array();
 $jml_array=0;
 $q_array= " select distinct control FROM dashboard_activity where sys_name='ZSMART' ";
  $RA   = $db->Execute($q_array);
  while(!$RA->EOF){
     array_push($control_label,$RA->fields['control']);
     $jml_array++;
     $RA->MoveNext();
     
  }  
?>


// Create axes
var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
//dateAxis.renderer.grid.template.location = 0;
//dateAxis.renderer.minGridDistance = 30;

var valueAxis1 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis1.title.text = "Jumlah User";

<?php
$color=array("orange","#C25D0F","#7B3B0A","blue","green","#F82229","#F94E54","#FA7176","#FB8D91","#FCA4A7","#FDB6B9","#7E1215","#4E54F9","#7176FA","#A4A7FC","#33FF33","#5CFF5C","#97FF97");
?>

// Create series
/*
var series1 = chart.series.push(new am4charts.ColumnSeries());
series1.dataFields.valueY = "sales1";
series1.dataFields.dateX = "date";
series1.yAxis = valueAxis1;
series1.name = "Target Sales";
series1.tooltipText = "[font-size: 12] {name} ${valueY}M[/]";
series1.fill = chart.colors.getIndex(0);
series1.strokeWidth = 0;
series1.clustered = false;
series1.columns.template.width = am4core.percent(40);

var series2 = chart.series.push(new am4charts.ColumnSeries());
series2.dataFields.valueY = "sales2";
series2.dataFields.dateX = "date";
series2.yAxis = valueAxis1;
series2.name = "Actual Sales";
series2.tooltipText = "[font-size: 12] {name} ${valueY}M[/]";
series2.fill = chart.colors.getIndex(0).lighten(0.5);
series2.strokeWidth = 0;
series2.clustered = false;
series2.toBack();
*/
//-----------
<?php
for ($q=0; $q < $jml_array ; $q++) { 
    

?>
var series3 = chart.series.push(new am4charts.LineSeries());
series3.dataFields.valueY = <?='"'.$control_label[$q].'"'?>;
series3.dataFields.dateX = "date";
series3.name = <?='"'.$control_label[$q].'"'?>;
series3.stroke = am4core.color(<?='"'.$color[$q].'"'?>);
series3.strokeWidth = 2;
series3.tensionX = 0.7;
series3.yAxis = valueAxis1;
series3.tooltipText = "[font-size: 12] {name} = {valueY}[/]";
series3.tooltip.getFillFromObject = false;
series3.tooltip.background.fill = am4core.color(<?='"'.$color[$q].'"'?>);

var bullet3 = series3.bullets.push(new am4charts.CircleBullet());
bullet3.circle.radius = 3;
bullet3.circle.strokeWidth = 2;
bullet3.circle.fill = am4core.color("#fff");

<?php
}
?>



// Add cursor
chart.cursor = new am4charts.XYCursor();

// Add legend
chart.legend = new am4charts.Legend();
chart.legend.position = "top";

// Add scrollbar
chart.scrollbarX = new am4charts.XYChartScrollbar();
chart.scrollbarX.series.push(series1);
chart.scrollbarX.series.push(series6);
chart.scrollbarX.parent = chart.bottomAxesContainer;

}); // end am4core.ready()
</script>

<!-- HTML -->


