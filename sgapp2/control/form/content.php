<?
#handle sections here.
display_message(1);
switch ($section):
	case 'list':
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			
			<tr>
				<td colspan="5" >
				<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=content', 2);?>
				</td>
			</tr>
			<tr>
				<td width="10%" class="table_head">Sr.</td>
				<td width="65%" class="table_head" align="left">Page Name</td>
				<td width="25%" class="table_head" align="center" colspan="2">control</td>
			</tr>
		
            <? $sr=(($QueryObj->PageNo-1)*$QueryObj->PageSize)+1;?>
			<? while ($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td ><?=$sr++;?>.</td>
				<td  align="left"><?=$QueryObj1->name;?></td>
				<td align="center"><a href="<?=make_admin_url('content', 'update', 'update', 'id='.$QueryObj1->id)?>"><?php echo get_control_icon('edit')?></a></td>
				<td align="center"><a href="<?=make_admin_url('content', 'view', 'view', 'id='.$QueryObj1->id)?>"><?php echo get_control_icon('zoom')?></a></td>
			</tr>
			<? endwhile;?>
		</table>
		<?
		#html code here.
		break;
	case 'view':
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td valign="middle" width="10%" ><a href="<?=make_admin_url('content')?>">&laquo;Back to page listing</a></td>
				</tr>
				<tr>
					<td valign="middle" width="10%" class="table_head"><?=$page_cotent->name;?></td>
				</tr>
				<tr>
					<td align="center" valign="middle" width="10%" >
						<?=stripslashes(html_entity_decode($page_cotent->page));?>
					</td>
				</tr>
		</table>
		<?
		#html code here.
		break;
	case 'update':
		?>
		<form id="content" action="<?=make_admin_url('content', 'update', 'list', 'id='.$id)?>" method="POST" name="content" enctype="multipart/form-data">
			<table width="70%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" align="center">
				<tr>
					<td valign="middle"   align="left" style="border-bottom:solid 1px #dcdcdc;"><a href="<?=make_admin_url('content')?>">&laquo;Back to page listing</a></td>
				</tr>
	
				<tr>
					<td align="left" valign="middle"   >
					<b>Page title</b><br/>
					<input type="text" name="name" value="<?=$page_cotent->name;?>" size="65"></td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>Meta title</b><br/>
					<input type="text" name="meta_title" value="<?=$page_cotent->meta_title;?>" size="65"></td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>Meta keywords</b><br/>	
					<input type="text" name="meta_keyword" value="<?=$page_cotent->meta_keyword;?>" size="65">
					</td>
				</tr>
                               
				<tr>
					<td align="left" valign="middle"   >
						<b>Meta description</b><br/>
						<textarea name="meta_description" cols="80" rows="5"><?=$page_cotent->meta_description;?></textarea>
					</td>
				</tr>
                     
				
				 
				<tr>
					<td align="center" valign="middle"  >
					<b>Page Contents</b></b> <br/>
					<?      $oFCKeditor = new FCKeditor('page') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= html_entity_decode($page_cotent->page);
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
			<form id="content" action="<?=make_admin_url('content', 'insert', 'list')?>" method="POST" name="content">
			<table width="70%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" align="center">
				<tr>
					<td valign="middle"   align="left"><a href="<?=make_admin_url('content')?>">&laquo;Back to page listing</a></td>
				</tr>
				<tr>
					<td valign="middle"  class="table_head" align="left">Add New Page</td>
				</tr>
				
				<tr>
					<td align="left" valign="middle"   >
					<b>Page title</b><br/>
					<input type="text" name="name"  size="65"></td>
				</tr>
			
				<tr>
					<td align="left" valign="middle"   >
					<b>Meta title</b><br/>
					<input type="text" name="meta_title"  size="65"></td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>Meta keywords</b><br/>	
					<input type="text" name="meta_keyword"  size="65">
					</td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
						<b>Meta description</b><br/>
						<textarea name="meta_description" cols="80" rows="5"></textarea>
					</td>
				</tr>
                               
			
				<tr>
					<td align="center" valign="middle"  >
					<b>Page Contents</b></b> <br/>
						<?  $oFCKeditor = new FCKeditor('page') ;
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
