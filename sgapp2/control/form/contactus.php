<?
#handle sections here.
display_message(1);
switch ($section):
	case 'list':
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			
			<tr>
				<td colspan="5" >
				<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=contactus', 2);?>
				</td>
			</tr>
			<tr>
				<td width="5%" class="table_head">Sr.</td>
				<td width="30%" class="table_head" align="left">Email</td>
                                <td width="30%" class="table_head" align="left">User Type</td>
                                <td width="10%" class="table_head" align="left">Status</td>
				<td width="15%" class="table_head" align="center" colspan="2">control</td>
			</tr>
			<?$sr=1;?>
			<?while ($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td ><?=$sr++;?>.</td>
				<td  align="left" valign="top"><?=$QueryObj1->email;?></td>
                                <td  align="left" valign="top"><?=get_object('registrationType',$QueryObj1->userType)->title;?></td>
                                <td  align="centre" valign="top"><?=($QueryObj1->userType!=0)?(($QueryObj1->status==1)?'Complete':'Pending'):'';?></td>
				<td align="center" valign="top">
                                <a href="<?=make_admin_url('contactus', 'view', 'view', 'id='.$QueryObj1->id)?>"><?php echo get_control_icon('zoom')?></a>
                                &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?=make_admin_url('contactus', 'delete', 'list', 'id='.$QueryObj1->id)?>" onclick="return confirm('Are you sure? You are deleting this contact.');"><?php echo get_control_icon('cancel')?></a></td>
			</tr>
			<?endwhile;?>
		</table>
		<?
		#html code here.
		break;
	case 'view':
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
                                        
					<td colspan="2" valign="top" align="left"><a href="<?=make_admin_url('contactus')?>">&laquo;Back to  listing</a></td>
				</tr>
				<tr>
                                        <td valign="top" width="20%" align="left"><strong>First Name</strong></td>
					<td valign="top" width="80%" align="left"><?=$getDetails->firstName;?></td>
				</tr>
                                <tr>
                                        <td valign="top" width="20%" align="left"><strong>Last Name</strong></td>
					<td valign="top" width="80%" align="left"><?=$getDetails->lastName;?></td>
				</tr>
                                	<tr>
                                        <td valign="top" width="20%" align="left"><strong>Email</strong></td>
					<td valign="top" width="80%" align="left"><?=$getDetails->email;?></td>
				</tr>
                                <tr>
                                        <td valign="top" width="20%" align="left"><strong>Phone</strong></td>
					<td valign="top" width="80%" align="left"><?=$getDetails->phone;?></td>
				</tr>
                                <?   if($getDetails->userType!=0):?>
                                 <tr>
                                        <td valign="top" width="20%" align="left"><strong>User Type</strong></td>
					<td valign="top" width="80%" align="left"><?=get_object('registrationType',$getDetails->userType)->title;?></td>
				</tr>
                                <tr>
                                        <td valign="top" width="20%" align="left"><strong>Url</strong></td>
					<td valign="top" width="80%" align="left"><?=make_url('contactRegistrationStep1','id='.$getDetails->urlid)?></td>
				</tr>
                                <? endif;?>
                                <tr>
                                        <td valign="top" width="20%" align="left"><strong>School/Company</strong></td>
					<td valign="top" width="80%" align="left"><?=$getDetails->schoolCompany;?></td>
				</tr>
                                <tr>
                                        <td valign="top" width="20%" align="left"><strong>City</strong></td>
					<td valign="top" width="80%" align="left"><?=$getDetails->city;?></td>
				</tr>
                                <tr>
                                        <td valign="top" width="20%" align="left"><strong>State</strong></td>
					<td valign="top" width="80%" align="left"><?=$getDetails->state;?></td>
				</tr>
                                <tr>
                                        <td valign="top" width="20%" align="left"><strong>Interest</strong></td>
					<td valign="top" width="80%" align="left"><?=$getDetails->interest;?></td>
				</tr>
				<tr>
                                       <td valign="top" width="20%" align="left"><strong>Comments</strong></td>
				       <td valign="top" width="80%" align="left"><?=stripslashes(html_entity_decode($getDetails->comment));?></td>
				</tr>
		</table>
		<?
		#html code here.
		break;
	
	default:break;
endswitch;
?>
