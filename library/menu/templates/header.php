<html>
<head>
	  <title>OrbitCMS</title> 
</head>
<link rel="stylesheet" href="../../orbitcms.css" type="text/css">
<script language="Javascript" src="../../library/ckeditor/ckeditor.js"></script>
<script language="Javascript" src="../../scripts/checkall.js"></script>
<script language="javascript" type="text/javascript" src="jquery-1.4.2.js"></script>
<script language="javascript" type="text/javascript" >

function change_option()
{
	var i = $("#data_midmenu_type").val();
	 
	if(i == 1)
	{ 
		$(".for_content").show(); 
	} 
	else
	{
		$(".for_content").hide(); 
	} 
}

</script>
</head>

<body>

<div id=worksheet>
  <div id=header>
  <h1><span><?php echo $systemname; ?></span></h1>
  
  <form method=post action="?action=search" >
    <span class="search">Search: <input type=text name=search size=20 value="<?php echo htmlspecialchars($search_string); ?>" > 
    <input type=submit value=' search '> 
	
	<?php if($allow_isert){ ?>
	&nbsp;<div class="button"><a href=?action=insert><img src=../../images/icon2.gif alt=insert></a><br><span style="font-size:10px;margin:0;padding:0;">Insert</span></div>
	<?php } ?>
	<?php if($allow_view) { ?>
	&nbsp; <div class="button"><a href=?><img src=../../images/icon3.gif alt=view></a><br><span style="font-size:10px;margin:0;padding:0;">View All</span></div>
    <?php } ?>
    </span>
  </form>
  <hr class=black>
  </div>
</div>