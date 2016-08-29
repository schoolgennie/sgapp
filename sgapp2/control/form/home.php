<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<table width="100%" border="0" >
		<tr>
		<td>
		<table width="100%" border="0" cellspacing="2" cellpadding="2">
			<tr>
				<td colspan="3" style="border-bottom: solid 1px #dcdcdc;" align="left">Welcome <b><?=ucfirst($CurrentUser->username);?></b>, [Last access date: <?=$CurrentUser->last_access;?>] </td>
			</tr>
			<tr>
				<td width="33%"></td>
				<td width="33%"></td>
				<td></td>
			</tr>
		</table>
		</td>
		</tr>
		<tr>
		<td>
		<table width="60%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" align="left">
			<tr>
				<td colspan="3" class="table_head"><b>Website Statistics </b></td>
			</tr>
			<tr>
				<td width="33%" class="table_cell">Total website visits:&nbsp;<?=$total_visits;?></td>
				<td width="33%" class="table_cell">Total visits today:&nbsp;<?=$total_visit_today;?></td>
				<td class="table_cell"></td>
			</tr>
		</table>
		</td>
		</tr>
		
		<tr>
		<td>
		<table width="60%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" align="left">
			<tr>
				<td colspan="3" class="table_head"><b>Users </b></td>
			</tr>
			<tr>
				<td width="33%" class="table_cell">Total registered users:&nbsp;<?=$total_user;?></td>
				<td width="33%" class="table_cell">Total registrations today:&nbsp;<?=$total_user_today;?></td>
				<td class="table_cell"></td>
			</tr>
		</table>
		</td>
		</tr>
		
		</table>
		<?
		break;
	case 'insert':
		#html code here.
		break;
	case 'update':
		#html code here.
		break;
	case 'delete':
		#html code here.
		break;
	default:break;
endswitch;
?>
