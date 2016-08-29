<?
display_message(1);
display_form_error();
#handle sections here.
switch ($section):
	case 'list':
		?>
		<table width="100%" cellspacing="0" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
			<tr>
				<td colspan="6" class="table_cell">			
				<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=user', 2);?>
				</td>
			</tr>
			<tr>
				<td class="table_head" width="5%">Sr.</td>
                <td class="table_head" align="left" width="80%">Scool Code</td>
				<td class="table_head" colspan="2" width="20%">Controls</td>
			</tr>
			<? $sr=(($QueryObj->PageNo-1)*$QueryObj->PageSize)+1;?>
			<? while($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td class="table_cell" ><?=$sr++?>.</td>
                <td class="table_cell" align="left"><?=$QueryObj1->school_code;?></td>
				<td class="table_cell"><a href="<?=make_admin_url('user','detail', 'detail', 'id='.$QueryObj1->school_id);?>"><?php echo get_control_icon('zoom')?></a></td>
                <td class="table_cell"><a href="<?=make_admin_url('user','update', 'update', 'id='.$QueryObj1->school_id);?>"><?php echo get_control_icon('edit')?></a></td>
			</tr>
			<? endwhile;?>
		</table>
		<br/>
		
		<?
		#html code here.
		break;

		case 'insert':
		#html code here.
		?>
  <form id="frm" action="<?=make_admin_url('user', 'insert', 'list');?>" method="post" name="frm" enctype="multipart/form-data">
  <table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" >
    <tr>
      <td colspan="2" align="left"><?=make_admin_link(make_admin_url('user', 'list', 'list'), 'Back to School Listing')?></td>
    </tr>
    <tr>
      <td colspan="2" align="center" class="table_head">Add New School</td>
    </tr>
    <tr>
      <td width="30%" align="left">School Code*</td>
      <td width="75%" align="left"><input type="text" name="school_code" size="24" tabindex="1" maxlength="50"/></td>
    </tr>
    
    
	<tr>
      <td width="30%" align="left"></td>
      <td width="75%" align="left"><input type="submit" name="insert" value="Insert" tabindex="9" /></td>
    </tr>
  </table>
</form>
<?
		break;
	case 'update':
		#html code here.
		?>
<form id="new_place" action="<?=make_admin_url('user', 'update', 'list', 'id='.$id.'&page='.$page);?>" method="post" name="new_place" enctype="multipart/form-data" onSubmit="return validateForm();"> 
  <table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" >
    <tr>
      <td colspan="2" align="left"><?=make_admin_link(make_admin_url('user', 'list', 'list','page='.$page), 'Back to school Listing')?></td>
    </tr>
    <tr>
      <td colspan="2" align="center" class="table_head">Update School Details</td>
    </tr>
     <tr>
      <td width="30%" align="left">School Code*</td>
      <td width="75%" align="left"><input type="text" name="school_code" size="24" tabindex="1" maxlength="50" value="<?=$fetchData->school_code?>"/></td>
    </tr>
     
    <tr>
      <td width="30%" align="left"></td>
      <td width="75%" align="left"><input type="hidden" name="school_id" value="<?=$fetchData->school_id?>" />
      <input type="submit" name="update" value="Update" tabindex="9" /></td>
    </tr>
  </table>
</form>
<?
		break;
	case 'delete':
		#html code here.
		break;
	default:break;
endswitch;
?>
