
<?php
$module=$_GET['module'];
$pm=$_GET['pm'];
$page_tmp = $_SERVER['PHP_SELF']."?module=$module&pm=$pm";
$page=str_replace(".php","",$page_tmp);

###########################################################

?>

<div class="page-content">
                    <!-- BEGIN BREADCRUMBS -->
                    <!-- <div class="breadcrumbs">
                        <div class="m-heading-1 border-green m-bordered">
                                     <h1> <i class="icon-settings"></i> <?php echo getParentMenuName(getParentMenu($module));?>   <i class="fa fa-angle-right"></i> <?=getNamaMenu($module);?> </h1> 

                                                    <br><br>
                                                </div>

                                    
                        </div>
 -->
                    <!-- </div> -->

 <?php
    if (isset($_GET['message']) && ($_GET['message']=="success")){
        echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button><strong> Successful Inserted User ...! </strong> </div>";
     }
    if (isset($_GET['message']) && ($_GET['message']=="error")){
        echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button><strong> Failed Inserted User...!</strong> </div>";
    }
    if (isset($_GET['message']) && ($_GET['message']=="error1")){
        echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button><strong> Failed Insert Already Exist Username $_GET[var] ...!</strong> </div>";
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
                                                    <span class="caption-subject font-dark sbold uppercase"> CHART </span>
                                        </div>       
                                </div>
                        <div class="portlet-body">
                        <div class="row">
                                                    <!-- Styles -->
<style>

#chartdivz {
  width: 100%;
  height: 500px;
}

</style>
<!-- <style>
#chartdivb {
  width: 100%;
  height: 500px;
}
</style> -->

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
  height: 700px;
}

</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);

// Add data
/*
chart.data = [{
  "date": "2013-01-17",
  "market1": 71,
  "market2": 75,
  "market3": 60,
  "market31": 50,
  "market32": 30,
  "market4": 80,
  "market41": 79,
  "market42": 89,
  "market43": 80,
  "market44": 87,
  "market45": 79,
  "market46": 27,
  "market47": 59,
  "sales1": 5,
  "sales2": 8
},{
  "date": "2013-01-20",
  "market1": 61,
  "market2": 85,
  "market3": 90,
  "market31": 30,
  "market32": 60,
  "market4": 40,
  "market41": 29,
  "market42": 49,
  "market43": 60,
  "market44": 37,
  "market45": 89,
  "market46": 77,
  "market47": 49,
  "sales1": 50,
  "sales2": 80
}, {
  "date": "2013-02-17",
  "market1": 74,
  "market2": 78,
  "market3": 50,
  "market31": 40,
  "market32": 20,
  "market4": 70,
  "market41": 75,
  "market42": 80,
  "market43": 80,
  "market44": 87,
  "market45": 89,
  "market46": 47,
  "market47": 39,
  "sales1": 4,
  "sales2": 6
}, {
  "date": "2013-03-17",
  "market1": 74,
  "market2": 78,
  "market3": 50,
  "market31": 40,
  "market32": 20,
  "market4": 70,
  "market41": 75,
  "market42": 80,
  "market43": 80,
  "market44": 87,
  "market45": 89,
  "market46": 47,
  "market47": 29,
  "sales1": 4,
  "sales2": 6
}];
*/


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

$jml_tgl=countTglDashSTS();
//while($month <= $end)
//{

//     $tgl_start = date('Y-m-d', $month);
//    $tgl_end = date('Y-m-t', strtotime(date('Y-m-d', $month)));
//    $month = strtotime("+1 month", $month);

  $q_loop= " select distinct entry_date FROM dashboard_activity where sys_name='STS' ";
  $RQ   = $db->Execute($q_loop);
  while(!$RQ->EOF){
        $z=1;
        $date_dash= date('Y-m-d',strtotime($RQ->fields['entry_date']));
        $jml_par= countTglDashSTS2($date_dash);
                echo '{';
                echo '"date":"'.$date_dash.'",';

        ####### Query expand  ########
        $query1 = " select entry_date,control,value as jml from dashboard_activity where entry_date = '".$date_dash."' and sys_name='STS' ";
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
 $q_array= " select distinct control FROM dashboard_activity where sys_name='STS' ";
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

/*
var series31 = chart.series.push(new am4charts.LineSeries());
series31.dataFields.valueY = <?='"'.$control_label[1].'"'?>;
series31.dataFields.dateX = "date";
series31.name = <?='"'.$control_label[1].'"'?>;
series31.stroke = am4core.color("#C25D0F");
series31.strokeWidth = 2;
series31.tensionX = 0.7;
series31.yAxis = valueAxis1;
series31.tooltipText = "[font-size: 12] {name} = {valueY}[/]";
series31.stroke = chart.colors.getIndex(0).lighten(0.5);
series31.strokeDasharray = "4";
series31.tooltip.getFillFromObject = false;
series31.tooltip.background.fill = am4core.color("#C25D0F");

var bullet31 = series31.bullets.push(new am4charts.CircleBullet());
bullet31.circle.radius = 3;
bullet31.circle.strokeWidth = 2;
bullet31.circle.fill = am4core.color("#fff");

var series32 = chart.series.push(new am4charts.LineSeries());
series32.dataFields.valueY = <?='"'.$control_label[2].'"'?>;
series32.dataFields.dateX = "date";
series32.name = <?='"'.$control_label[2].'"'?>;
series32.stroke = am4core.color("#7B3B0A");
series32.strokeWidth = 2;
series32.tensionX = 0.7;
series32.yAxis = valueAxis1;
series32.tooltipText = "[font-size: 12] {name} = {valueY}[/]";
series32.stroke = chart.colors.getIndex(0).lighten(0.5);
series32.strokeDasharray = "4";
series32.tooltip.getFillFromObject = false;
series32.tooltip.background.fill = am4core.color("#7B3B0A");

var bullet32 = series32.bullets.push(new am4charts.CircleBullet());
bullet32.circle.radius = 3;
bullet32.circle.strokeWidth = 2;
bullet32.circle.fill = am4core.color("#fff");

//------

var series4 = chart.series.push(new am4charts.LineSeries());
series4.dataFields.valueY = <?='"'.$control_label[3].'"'?>;
series4.dataFields.dateX = "date";
series4.name = <?='"'.$control_label[3].'"'?>;
series4.stroke = am4core.color("blue");
series4.strokeWidth = 2;
series4.tensionX = 0.7;
series4.yAxis = valueAxis1;
series4.tooltipText = "[font-size: 12] {name} = {valueY}[/]";
series4.tooltip.getFillFromObject = false;
series4.tooltip.background.fill = am4core.color("blue");

var bullet4 = series4.bullets.push(new am4charts.CircleBullet());
bullet4.circle.radius = 3;
bullet4.circle.strokeWidth = 2;
bullet4.circle.fill = am4core.color("#fff");
//-------
var series5 = chart.series.push(new am4charts.LineSeries());
series5.dataFields.valueY =  <?='"'.$control_label[4].'"'?>;
series5.dataFields.dateX = "date";
series5.name = <?='"'.$control_label[4].'"'?>;
series5.strokeWidth = 2;
series5.stroke = am4core.color("green");
series5.tensionX = 0.7;
series5.yAxis = valueAxis1;
series5.tooltipText = "[font-size: 12] {name} = {valueY}[/]";
series5.tooltip.getFillFromObject = false;
series5.tooltip.background.fill = am4core.color("green");


var bullet5 = series5.bullets.push(new am4charts.CircleBullet());
bullet5.circle.radius = 3;
bullet5.circle.strokeWidth = 2;
bullet5.circle.fill = am4core.color("#fff");

var series6 = chart.series.push(new am4charts.LineSeries());
series6.dataFields.valueY = <?='"'.$control_label[5].'"'?>;
series6.dataFields.dateX = "date";
series6.name = <?='"'.$control_label[5].'"'?>;
series6.strokeWidth = 2;
series6.stroke = am4core.color("#F82229");
series6.tensionX = 0.7;
series6.yAxis = valueAxis1;
series6.tooltipText = "[font-size: 12] {name} = {valueY}[/]";
series6.tooltip.getFillFromObject = false;
series6.tooltip.background.fill = am4core.color("#F82229");
var bullet6 = series6.bullets.push(new am4charts.CircleBullet());
bullet6.circle.radius = 3;
bullet6.circle.strokeWidth = 2;
bullet6.circle.fill = am4core.color("#fff");

var series61 = chart.series.push(new am4charts.LineSeries());
series61.dataFields.valueY = <?='"'.$control_label[6].'"'?>;
series61.dataFields.dateX = "date";
series61.name = <?='"'.$control_label[6].'"'?>;
series61.strokeWidth = 2;
series61.stroke = am4core.color("#F94E54");
series61.tensionX = 0.7;
series61.yAxis = valueAxis1;
series61.tooltipText = "[font-size: 12] {name} = {valueY}[/]";
series61.tooltip.getFillFromObject = false;
series61.tooltip.background.fill = am4core.color("#F94E54");
var bullet61 = series61.bullets.push(new am4charts.CircleBullet());
bullet61.circle.radius = 3;
bullet61.circle.strokeWidth = 2;
bullet61.circle.fill = am4core.color("#fff");

var series62 = chart.series.push(new am4charts.LineSeries());
series62.dataFields.valueY = <?='"'.$control_label[7].'"'?>;
series62.dataFields.dateX = "date";
series62.name = <?='"'.$control_label[7].'"'?>;
series62.strokeWidth = 2;
series62.stroke = am4core.color("#FA7176");
series62.tensionX = 0.7;
series62.yAxis = valueAxis1;
series62.tooltipText = "[font-size: 12] {name} = {valueY}[/]";
series62.tooltip.getFillFromObject = false;
series62.tooltip.background.fill = am4core.color("#FA7176");

var bullet62 = series62.bullets.push(new am4charts.CircleBullet());
bullet62.circle.radius = 3;
bullet62.circle.strokeWidth = 2;
bullet62.circle.fill = am4core.color("#fff");

var series63 = chart.series.push(new am4charts.LineSeries());
series63.dataFields.valueY = <?='"'.$control_label[8].'"'?>;
series63.dataFields.dateX = "date";
series63.name = <?='"'.$control_label[8].'"'?>;
series63.strokeWidth = 2;
series63.stroke = am4core.color("#FB8D91");
series63.tensionX = 0.7;
series63.yAxis = valueAxis1;
series63.tooltipText = "[font-size: 12] {name} = {valueY}[/]";
series63.tooltip.getFillFromObject = false;
series63.tooltip.background.fill = am4core.color("#FB8D91");

var bullet63 = series63.bullets.push(new am4charts.CircleBullet());
bullet63.circle.radius = 3;
bullet63.circle.strokeWidth = 2;
bullet63.circle.fill = am4core.color("#fff");


var series64 = chart.series.push(new am4charts.LineSeries());
series64.dataFields.valueY = <?='"'.$control_label[9].'"'?>;
series64.dataFields.dateX = "date";
series64.name = <?='"'.$control_label[9].'"'?>;
series64.strokeWidth = 2;
series64.stroke = am4core.color("#FCA4A7");
series64.tensionX = 0.7;
series64.yAxis = valueAxis1;
series64.tooltipText = "[font-size: 12] {name} = {valueY}[/]";
series64.tooltip.getFillFromObject = false;
series64.tooltip.background.fill = am4core.color("#FCA4A7");

var bullet64 = series64.bullets.push(new am4charts.CircleBullet());
bullet64.circle.radius = 3;
bullet64.circle.strokeWidth = 2;
bullet64.circle.fill = am4core.color("#fff");
*/


/*

var series65 = chart.series.push(new am4charts.LineSeries());
series65.dataFields.valueY = <?='"'.$control_label[10].'"'?>;
series65.dataFields.dateX = "date";
series65.name = <?='"'.$control_label[10].'"'?>;
series65.strokeWidth = 2;
series65.stroke = am4core.color("#FDB6B9");
series65.tensionX = 0.7;
series65.yAxis = valueAxis1;
series65.tooltipText = "[font-size: 12] {name} = {valueY}[/]";
series65.tooltip.getFillFromObject = false;
series65.tooltip.background.fill = am4core.color("#FDB6B9");

var bullet65 = series65.bullets.push(new am4charts.CircleBullet());
bullet65.circle.radius = 3;
bullet65.circle.strokeWidth = 2;
bullet65.circle.fill = am4core.color("#fff");

var series66 = chart.series.push(new am4charts.LineSeries());
series66.dataFields.valueY = <?='"'.$control_label[11].'"'?>;
series66.dataFields.dateX = "date";
series66.name = <?='"'.$control_label[11].'"'?>;
series66.strokeWidth = 2;
series66.stroke = am4core.color("#7E1215");
series66.tensionX = 0.7;
series66.yAxis = valueAxis1;
series66.tooltipText = "[font-size: 12] {name} = {valueY}[/]";
series66.tooltip.getFillFromObject = false;
series66.tooltip.background.fill = am4core.color("#7E1215");

var bullet66 = series66.bullets.push(new am4charts.CircleBullet());
bullet66.circle.radius = 3;
bullet66.circle.strokeWidth = 2;
bullet66.circle.fill = am4core.color("#fff");


var series67 = chart.series.push(new am4charts.LineSeries());
series67.dataFields.valueY = <?='"'.$control_label[12].'"'?>;
series67.dataFields.dateX = "date";
series67.name = <?='"'.$control_label[12].'"'?>;
series67.strokeWidth = 2;
series67.stroke = am4core.color("#C61B21");
series67.tensionX = 0.7;
series67.yAxis = valueAxis1;
series67.tooltipText = "[font-size: 12] {name} = {valueY}[/]";
series67.tooltip.getFillFromObject = false;
series67.tooltip.background.fill = am4core.color("#C61B21");

var bullet67 = series67.bullets.push(new am4charts.CircleBullet());
bullet67.circle.radius = 3;
bullet67.circle.strokeWidth = 2;
bullet67.circle.fill = am4core.color("#fff");
*/

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
<div id="chartdiv"></div>

