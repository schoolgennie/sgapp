
<?
#handle sections here.
display_message(1);
switch ($section):
	case 'list':
		?>
		<form action="<?=make_admin_url('subcontent', 'update2', 'list', 'cid='.$cid)?>" method="POST">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			
			<tr>
				<td colspan="7" >
				<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=subcontent&cid='.$cid, 2);?>
				</td>
			</tr>
			<tr>
				<td width="10%" class="table_head">Sr.</td>
				<td width="30%" class="table_head" align="left">Title</td>
				<td width="20%" class="table_head" align="center">Position</td>
				<td width="20%" class="table_head" align="center">Status</td>
				<td width="20%" colspan="3" class="table_head" align="center">Control</td>
			</tr>
			<? $sr=1;?>
			<? while ($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td ><?=$sr++;?>.</td>	
				<td align="left"><?=$QueryObj1->title;?></td>
				<td align="center"><input type="text"  size="5" name="position[<?php echo $QueryObj1->id?>]"  value="<?php echo $QueryObj1->position?>" /></td>
				<td align="center"><?php get_category_status_link($QueryObj1->id, $QueryObj1->is_active);?></td>
				<td align="center"><a href="<?=make_admin_url('subcontent', 'update', 'update', 'id='.$QueryObj1->id.'&cid='.$cid)?>"><?php echo get_control_icon('edit')?></a></td>
				<td align="center"><a href="<?=make_admin_url('subcontent', 'view', 'view', 'id='.$QueryObj1->id.'&cid='.$cid)?>"><?php echo get_control_icon('zoom')?></a></td>
				<td align="center" ><a href="<?=make_admin_url('subcontent', 'delete', 'view', 'id='.$QueryObj1->id.'&cid='.$cid)?>" onclick="return confirm('Are you sure? You are deleting this page.');"><?php echo get_control_icon('cancel')?></a></td>
			</tr>
			<? endwhile;?>
			<tr>
				<td colspan="2"></td>
				<td align="center"><input type="submit" name="positionUpdate" value="Update" /></td>
				<td align="center"><input type="submit" name="statusUpdate" value="Update" /></td>
				<td align="center" colspan="3"></td>
			</tr>
		</table>
		</form>
		<?
		#html code here.
		break;
	case 'view':
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td valign="middle" width="10%" ><a href="<?=make_admin_url('subcontent', 'list', 'list', 'cid='.$cid)?>">&laquo;Back to  listing</a></td>
				</tr>
				<tr>
					<td valign="middle" width="10%" class="table_head"><?=$page_cotent->title;?></td>
				</tr>
				<tr>
					<td align="center" valign="middle" width="10%" >
						<?=stripslashes(html_entity_decode($page_cotent->description));?>
					</td>
				</tr>
		</table>
		<?
		#html code here.
		break;
	case 'update':
		?>
		<form id="content" action="<?=make_admin_url('subcontent', 'update', 'list', 'id='.$id.'&cid='.$cid)?>" method="POST" name="content" enctype="multipart/form-data">
			<table width="70%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" align="center">
				<tr>
					<td valign="middle"   align="left" style="border-bottom:solid 1px #dcdcdc;"><a href="<?=make_admin_url('subcontent', 'list', 'list', 'cid='.$cid)?>">&laquo;Back to  listing</a></td>
				</tr>
	
				<tr>
					<td align="left" valign="middle"   >
					<b>Title</b><br/>
					<input type="text" name="title" value="<?=$page_cotent->title;?>" size="65"></td>
				</tr>
				<tr>
					<td align="center" valign="middle"  >
					<b>Content</b></b> <br/>
					<?  $oFCKeditor = new FCKeditor('description') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= html_entity_decode($page_cotent->description);
						$oFCKeditor->Height		=700;
						$oFCKeditor->Width		=600;
						$oFCKeditor->Create() ;
					?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"  >
						<input type="submit" name="submit" value="Update" tabindex="2" />
					</td>
				</tr>
			</table>
		</form>
		<?
		#html code here.
		break;
	case 'insert':
		?>
			<form id="content" action="<?=make_admin_url('subcontent', 'insert', 'list','cid='.$cid)?>" method="POST" name="content">
			<table width="70%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" align="center">
				<tr>
					<td valign="middle"   align="left"><a href="<?=make_admin_url('subcontent', 'list', 'list', 'cid='.$cid)?>">&laquo;Back to listing</a></td>
				</tr>
				<tr>
					<td valign="middle"  class="table_head" align="left">Add New Right Content</td>
				</tr>
				
				<tr>
					<td align="left" valign="middle"   >
					<b>Title</b><br/>
					<input type="text" name="title"  size="65"></td>
				</tr>
			
				<tr>
					<td align="center" valign="middle"  >
					<b>Content</b></b> <br/>
						<?  $oFCKeditor = new FCKeditor('description') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= '';
						$oFCKeditor->Height		=700;
						$oFCKeditor->Width		=600;
						$oFCKeditor->Create() ;
					?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"  >
						<input type="submit" name="submit" value="Insert" tabindex="2" />
					</td>
				</tr>
			</table>
			</form>		
		<?
		#html code here.
		break;
	default:break;
endswitch;
?>
