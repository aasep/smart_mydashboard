<div id=worksheet>
<?php if(is_array($data_list) && sizeof($data_list) > 0 ) { ?>

<div id=tabellist>
  <?php echo '<p class="content" align="left" id="paging"><span style="color: black;">'.$pagination['first'].$pagination['prev'].'</span>'.$pagination['page'].'<span style="color: black;">'.$pagination['next'].$pagination['last'].'</span></p>'; ?>
  <span class=red><p><?php echo $final_msg; ?></p></span>

	<form name=form method=post action="?action=<?php echo $action; ?>&amp;page=<?php echo $page; ?>&amp;order=<?php echo $order; ?>&amp;orderfield=<?php echo $orderfield; ?>&amp;search=<?php echo $search; ?>" >
	<table style="border:solid 1px #333;">
		<tr>
			<th class=wdth40>Edit</th>
			<th><a href="?action=<?php echo $action; ?>&amp;page=<?php echo $page; ?>&amp;order=asc&amp;orderfield=categoryname&amp;search=<?php echo $search; ?>"><img src=../../images/arrow_down.png></a>Category Title<a href="?action=<?php echo $action; ?>&amp;page=<?php echo $page; ?>&amp;order=desc&amp;orderfield=categoryname&amp;search=<?php echo $search; ?>"><img src=../../images/arrow_top.png></a></th>
			<th class=wdth120 >Category Parent</th>
			<th class=wdth70><input type="checkbox" onclick="checkAllFields(1);" id="checkAll"></th>
		</tr>

	<?php for($i=0; $i<sizeof($data_list); $i++) { $bgclass = ($i%2) ? 'bgwhite' : 'bgviolet3';  ?>
     
	<tr class="<?php echo $bgclass; ?>"> 
		<td class=center><a href=?action=detail&data_categoryid=<?php echo $data_list[$i]['categoryid']; ?>><img src="../../images/edit.gif"></a></td>
		<td><?php echo $data_list[$i]['categoryname']; ?></td>
		<td align="left"><?php echo getCatProductName_p($data_list[$i]['parent']); ?></td>
		<td class=center><input type=checkbox name=delete[] value='<?php echo $data_list[$i]['categoryid']; ?>'></td>
	</tr>
	<?php } ?>

	<tr><th colspan=3></th>
		<th><input type=submit value=delete name='del' onclick="return confirm('are you sure want to delete this record?')";></th>
	</tr>

	</table>
	</form>
</div>

<?php }else{ ?>
<div id=tabellist><span class=red>Sorry, no record in database.</span></div>
<?php }  ?>

</div>

</body>
</html>