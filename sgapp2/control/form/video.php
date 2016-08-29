<?
#handle sections here.
display_message(1);
switch ($section):
	case 'list':
		?>
              <form action="<?=make_admin_url('video', 'list_ops', 'list')?>" method="post">
                <table width="100%" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" class="table">
                 <tr >
                         <td align="center">Videos </td>
                         </tr>
			<tr>
				<td>
				<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=video', 2);?>
				</td>
			</tr>
               </table>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			
			<tr>
				<td width="10%" class="table_head">Sr.</td>
				<td width="30%" class="table_head" align="left">Image</td>
                                <td width="20%" class="table_head" align="center">Position</td>
                                <td width="20%" class="table_head" align="center">Status</td>
				<td width="20%" class="table_head" align="center" colspan="2">control</td>
				
			</tr>
			<? $sr=(($QueryObj->PageNo-1)*$QueryObj->PageSize)+1;?>
			<?while ($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td ><?=$sr++;?>.</td>
                                <? 
                                $img=explode('v=',$QueryObj1->link);
                                if($img[1]==''):
                                $img=explode('youtu.be/',$QueryObj1->link);
                                endif;
                                ?>
				<td  align="left"><img src="http://img.youtube.com/vi/<?=$img[1]?>/1.jpg" /></td>
                                <td  align="center"><input type="text" name="position[<?php echo $QueryObj1->id?>]" value="<?php echo $QueryObj1->position;?>" size="3"></td>
                                <td  align="center">
                                    <label id="<?=$QueryObj1->id?>a">
                                       <input type="radio" name="status[<?=$QueryObj1->id?>]" value="1" <?=($QueryObj1->status==1)?'checked':'';?>>
                                    Y</label>
                                    &nbsp;&nbsp;
                                   <label id="<?=$QueryObj1->id?>d">
                                  <input type="radio" name="status[<?=$QueryObj1->id?>]" value="0" <?=($QueryObj1->status==0)?'checked':'';?>>
                                   N</label>
                                </td>
				<td align="center"><a href="<?=make_admin_url('video', 'update', 'update', 'id='.$QueryObj1->id)?>"><?php echo get_control_icon('edit')?></a></td>
				<td align="center" ><a href="<?=make_admin_url('video', 'delete', 'list', 'id='.$QueryObj1->id)?>" onclick="return confirm('Are you sure? You are deleting this video.');"><?php echo get_control_icon('cancel')?></a></td>
			</tr>
			<?endwhile;?>
                       <tr>
                       <td colspan="2"  style="border-top:solid 1px #dcdcdc;">&nbsp;</td>
                       <td  align="center" style="border-top:solid 1px #dcdcdc;"><input type="submit" name="position_update" value="Update"></td>
                       <td  align="center" style="border-top:solid 1px #dcdcdc;"><input type="submit" name="status_update" value="Update"></td>
                       <td colspan="3"  style="border-top:solid 1px #dcdcdc;">&nbsp;</td>
                       </tr>
		</table>
</form>
		<?
		#html code here.
		break;
	
	case 'update':
		?>
		<form id="videoFrm" action="<?=make_admin_url('video', 'update', 'list', 'id='.$id)?>" method="POST" name="videoFrm" enctype="multipart/form-data">
			<table width="70%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" align="center">
				<tr>
					<td valign="middle"   align="left" style="border-bottom:solid 1px #dcdcdc;"><a href="<?=make_admin_url('video', 'list', 'list')?>">&laquo;Back to listing</a></td>
				</tr>
	                        <tr>
					<td align="left" valign="middle"   >
					<b>Link</b><br/>
					<input type="text" name="link" value="<?=$getObject->link;?>" size="65" maxlength="200"></td>
				</tr>
			
				<tr>
					<td align="left" valign="middle"   >
					<b>Short Description</b><br/>	
                                        <textarea name="description" cols="60" rows="2"><?=$getObject->description;?></textarea>
					
					</td>
				</tr>
                                <tr>
					<td align="left" valign="middle"   >
					<b>Position</b><br/>	
					<input type="text" name="position"  size="10" value="<?=$getObject->position;?>" maxlength="3">
					</td>
				</tr>
				
				<tr>
					<td align="left" valign="middle"   >
						<b>Status</b>
						<input type="checkbox" name="status" value="1" <?=($getObject->status==1)?'checked="checked"':'';?>/>
					</td>
				</tr>
				
				
				
				<tr>
					<td align="center" valign="middle"  >
                                                <input type="hidden" name="id" value="<?=$getObject->id?>" />
						<input type="submit" name="submit" value="Update" tabindex="2" />
					</td>
				</tr>
			</table>
		</form>
<script>
			frmvalidator= new Validator('videoFrm');
			frmvalidator.addValidation("link","req","Please enter link");
			frmvalidator.addValidation("description","maxlen=100","Description can contain 100 chars only."); 
			
		</script>
		<?
		#html code here.
		break;
	case 'insert':
		?>
			<form id="videoFrm" action="<?=make_admin_url('video', 'insert', 'list')?>" method="POST" name="videoFrm">
			<table width="70%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" align="center">
				<tr>
					<td valign="middle"   align="left"><a href="<?=make_admin_url('video', 'list', 'list')?>">&laquo;Back to  listing</a></td>
				</tr>
				<tr>
					<td valign="middle"  class="table_head" align="left">Add New Video</td>
				</tr>
				
				<tr>
					<td align="left" valign="middle"   >
					<b>Link</b><br/>
					<input type="text" name="link"  size="65"></td>
				</tr>
			
				<tr>
					<td align="left" valign="middle"   >
					<b>Short Description</b><br/>	
					<textarea name="description" cols="60" rows="2"></textarea>
					</td>
				</tr>
                                <tr>
					<td align="left" valign="middle"   >
					<b>Position</b><br/>	
					<input type="text" name="position"  size="10">
					</td>
				</tr>
				
				<tr>
					<td align="left" valign="middle"   >
						<b>Status</b>
						<input type="checkbox" name="status" value="1" />
					</td>
				</tr>
				
				
				<tr>
					<td align="center" valign="middle"  >
                                              
						<input type="submit" name="submit" value="Insert" tabindex="2" />
					</td>
				</tr>
			</table>
			</form>	
<script>
			frmvalidator= new Validator('videoFrm');
			frmvalidator.addValidation("link","req","Please enter link");
			frmvalidator.addValidation("description","maxlen=100","Description can contain 100 chars only."); 
			
		</script>	
		<?
		#html code here.
		break;
	default:break;
endswitch;

?>

