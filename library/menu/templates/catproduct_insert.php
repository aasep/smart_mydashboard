
<div id=worksheet>
  <div id=tabelform>
  <form name=form method=post enctype="multipart/form-data" action=?action=<?php echo $action; ?>&amp;<?php if ($data_categoryid != '' ) { echo 'data_categoryid='.$data_categoryid.''; } ?> >
  <table>  
  <?php if($err_msg != '') { echo '<tr><td colspan=3><span class=red>'.$err_msg.'</span><br></td></tr>'; } ?>
  <?php if( $is_edit ) {?>
  <tr><td>ID</td>
      <td> : </td>
      <td><input type=hidden name=data_categoryid value="<?php echo $data_categoryid; ?>" ><?php echo $data_categoryid; ?></td>
  </tr>
  <?php } ?>

  <tr><td>Parent</td>
      <td>:</td>
      <td >
		<select name="data_parent" size="8" style="width:300px;">
			<option value="0" <?php echo empty($data_catparent) ? 'selected' : '' ;?>> Parent / Root </option>
			<?php echo select_deep_core_p(0,'&raquo;&nbsp;',$data_catparent)?>
		</select>
	  </td>
  </tr>
  
  <tr><td class=wdth120>Title</td>
      <td class=wdth10>:</td>
      <td><input type=text name=data_categoryname maxlength=255 size=60 style="width:300px;" value="<?php echo htmlspecialchars($data_categoryname); ?>" /></td>
  </tr>
<!--  
  <?php if (!empty($data_productthumbnail)){?>
  <tr><td>Picture</td>
      <td>:</td>
      <td><img src='<?php echo $path_file_image.'t'.$data_productthumbnail;?>'> &nbsp; <input type=submit name='deletemainpic' value="delete picture" onclick='return konfirmasi()';></td>
  </tr>
  <?php } ?>
  <tr><td>Picture</td>
      <td>:</td>
      <td ><input type=file name=data_productpicture size=40 > <font class=red>Scale : width 300 x height 300 </font> </td>
  </tr>
  <tr><td class=wdth120>Description</td>
      <td class=wdth10>:</td>
      <td><textarea id=data_categorydesc name=data_categorydesc rows=6 cols=45><?php echo htmlspecialchars($data_categorydesc); ?></textarea>
		<script type="text/javascript">
		//<![CDATA[

			// This call can be placed at any point after the
			// <textarea>, or inside a <head><script> in a
			// window.onload event handler.

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using default configurations.
			CKEDITOR.replace( 'data_categorydesc',
			{
				toolbar : 'MyToolbar',
				filebrowserBrowseUrl : '../../../galaxycs/library/ckfinder/ckfinder.html',
				filebrowserImageBrowseUrl : '../../../galaxycs/library/ckfinder/ckfinder.html?Type=Images',
				filebrowserFlashBrowseUrl : '../../../galaxycs/library/ckfinder/ckfinder.html?Type=Flash',
				filebrowserUploadUrl : '../../../galaxycs/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
				filebrowserImageUploadUrl : '../../../galaxycs/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				filebrowserFlashUploadUrl : '../../../galaxycs/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
				height : '500px'
			} );

		//]]>
		</script>
	  </td>
  </tr> 
-->
 
  <tr><td colspan=3 height=20></td></tr>
  <tr><td colspan=2></td>
      <td>
      <?php if( $is_edit ) { ?>
      <input type=submit value='save' name=edit>
      <?php } else { ?>
      <input type=submit value=submit name=insert>
      <?php } ?>
      <input type=reset value=reset></td>
   
  </form>
  </table>
  </div>

</div>
 
      
</body>
</html>

