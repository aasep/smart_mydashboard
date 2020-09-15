<?php
session_start();

    require_once "../../library/adodb5/adodb.inc.php";
    require_once '../../config/config.php';
    require_once '../../function/function.php';
    require_once '../../session_login.php';

date_default_timezone_set("Asia/Jakarta"); 
$current_date = date('Y-m-d');

error_reporting(-1);

/*

if (!$connection) {
echo "connection Failed";
exit;
}
*/

$page_tmp = "?module=$_GET[module]&pm=$_GET[pm]";
$page=str_replace(".php","",$page_tmp);




//&srcby=$srcby&srckey=$srckey

################   SRCKEY   ########################
if (isset($_GET['srckey']) ) {
    $srckey=$_GET['srckey'];
} else  {
    $srckey=""; // no filter
}






    $aColumns = array('no','entry_date','sys_name','control','value', 'prosentase' );
	$aColumns_sorting = array('entry_date','entry_date','sys_name', 'control','value', 'prosentase');



    /* Indexed column (used for fast and accurate table cardinality) */
    $sIndexColumn = "entry_date";

  
    $sLimit = "";
    if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
    {
        $sLimit = "LIMIT ".intval( $_GET['iDisplayLength'] )." OFFSET ".
            intval( $_GET['iDisplayStart'] );
    }

    /*
     * Ordering
     */
    if ( isset( $_GET['iSortCol_0'] ) )
    {
        $sOrder = "ORDER BY  ";
        for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
        {
            if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
            {
                $sOrder .= $aColumns_sorting[ intval( $_GET['iSortCol_'.$i] ) ]."
                    ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc').", ";
            }
        }

        $sOrder = substr_replace( $sOrder, "", -2 );
        if ( $sOrder == "ORDER BY" )
        {
            $sOrder = "";
        }
    }

    /*
     * Filtering
     * NOTE This assumes that the field that is being searched on is a string typed field (ie. one
     * on which ILIKE can be used). Boolean fields etc will need a modification here.
     */

 
    //$sWhere = " WHERE username='".getUsername()."' and status='0' ";
    $sWhere = " ";

    $aColumnsSearch= array('entry_date','sys_name','control','value','prosentase' );
    if ( $_GET['sSearch'] != "" )
    {
        $sWhere = "WHERE (";
        for ( $i=0 ; $i<count($aColumnsSearch) ; $i++ )
        {
            if ( $_GET['bSearchable_'.$i] == "true" )
            {
                $sWhere .=$aColumnsSearch[$i]." LIKE '%".pg_escape_string( $_GET['sSearch'] )."%' OR ";
            }
        }
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= " ) ";


        
    }

    /* Individual column filtering */



	


	$no=$_GET['iDisplayStart'];
    $sQuery  = " select entry_date,sys_name,control,value,prosentase from dashboard_activity ";
    $sQuery .=" $sWhere ".

    //$sQuery .=" where a.username='".getUsername()."' and status='0' ".
    
    $sOrder." ".
	$sLimit;
    //echo $sQuery."<br>";

    //$rResult = pg_query( $connection, $sQuery ) or die(pg_last_error());
    $rResult  = $db->Execute($sQuery);
	
    $sQuery  =" select count(*) as jumlah  from dashboard_activity ";
    $sQuery .=" $sWhere ";
    //$sQuery .=" where a.username='".getUsername()."' ";

    //echo $sQuery."<br>";
    //die();
	$rResultTotal  = $db->Execute($sQuery);
    $iTotal=$rResultTotal->fields['jumlah'];		 	 
	

    
    $iFilteredTotal = $iTotal;

    /*
     * Output
     */
    $output = array(
        "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "query" => $sWhere,
        "aaData" => array()
    );

    $z=1;
    while(!$rResult->EOF)
    {
        $row = array();
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
            if ( $aColumns[$i] == "version" )
            {
                /* Special output formatting for 'version' column */
                $row[] = ($rResult[ $aColumns[$i] ]=="0") ? '-' : $rResult[ $aColumns[$i] ];
            }
            else if ( $aColumns[$i] == "no" )
            {
               $id_temp="<b>".$z."</b>";
               $row[] = $id_temp; 
            }
            else if ($aColumns[$i] == "entry_date")
            {
                 //date('d-m-Y',strtotime($rResult->fields['tgl_ki']));
           
               $text1   ="<b>".date('Y-m-d',strtotime($rResult->fields['entry_date']))."</b>";
               $row[] = $text1;
            }
            else if ($aColumns[$i] == "sys_name")
            {

               $row[] = "<b>".$rResult->fields['sys_name']."</b>";
            }

            else if ($aColumns[$i] == "control") 
            {               
               
               $row[] = "<b>".$rResult->fields['control']."</b>"; 
            }       
                
            else if ($aColumns[$i] == "value") 
            {               
               
               $text1   ="<b>".$rResult->fields['value']."</b>";
               
               $row[] = $text1; 
            }
            
            else if ($aColumns[$i] == "prosentase") 
            {               

                $nama_action="<b>".$rResult->fields['prosentase']."</b>";



               $row[] = $nama_action; 
            }
             
            else if ( $aColumns[$i] != ' ' )
            {
                /* General output */
                $row[] = $rResult[ $aColumns[$i] ];
            }
        }
        $output['aaData'][] = $row;

        $z++;
        $rResult->MoveNext();

    }

    echo json_encode( $output );
?>
