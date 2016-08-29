<?
#handle sections here.
display_message(1);
switch ($section):
	case 'list':
		?>
        <? if($fetchData):?>
               <form id="new_place" action="<?=make_admin_url('udetail', 'update', 'list', 'id='.$id);?>" method="post" name="new_place" enctype="multipart/form-data" onSubmit="return validateForm();"> 
              <table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" >
                <tr>
                  <td colspan="2" align="left">
				  <?=make_admin_link(make_admin_url('user', 'list', 'list'), 'Back to school Listing')?>
                  <a href="<?=make_admin_url('udetail', 'migration', 'list', 'id='.$id);?>"><input type="button"  value="Migration" tabindex="9" /></a>
                  </td>
                </tr>
                <tr>
                  <td  align="left">
				  <strong> Database Version:</strong>
                  </td>
                  <td>
                  <?=get_object_by_query('database_version')->database_version;?>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" align="center" class="table_head">Update School Details</td>
                </tr>
                 <tr>
                  <td width="30%" align="left">School Code*</td>
                  <td width="75%" align="left"><input type="text" name="school_code" size="24" tabindex="1" maxlength="50" value="<?=$fetchData->school_code?>"/></td>
                </tr>
                 <tr>
                  <td width="30%" align="left">School Name*</td>
                  <td width="75%" align="left"><input type="text" name="school_name" size="24" tabindex="1" maxlength="200" value="<?=$fetchData->school_name?>"/></td>
                </tr>
                 <tr>
                  <td width="30%" align="left">User Id*</td>
                  <td width="75%" align="left"><input type="text" name="school_id" size="24" tabindex="1" maxlength="100" value="<?=$fetchData->school_id?>"/></td>
                </tr>
                  <tr>
                  <td width="30%" align="left">Admin Name*</td>
                  <td width="75%" align="left"><input type="text" name="school_admin_name" size="24" tabindex="1" maxlength="30" value="<?=$fetchData->school_admin_name?>"/></td>
                </tr>
                 <tr>
                  <td width="30%" align="left">Affiliation No.*</td>
                  <td width="75%" align="left"><input type="text" name="school_affiliation_no" size="24" tabindex="1" maxlength="30" value="<?=$fetchData->school_affiliation_no?>"/></td>
                </tr>
                 <tr>
                  <td width="30%" align="left">Contact No. 1</td>
                  <td width="75%" align="left"><input type="text" name="school_phone1" size="24" tabindex="1" maxlength="20" value="<?=$fetchData->school_phone1?>"/></td>
                </tr>
                 <tr>
                  <td width="30%" align="left">Contact No. 2</td>
                  <td width="75%" align="left"><input type="text" name="school_phone2" size="24" tabindex="1" maxlength="20" value="<?=$fetchData->school_phone2?>"/></td>
                </tr>
                <tr>
                  <td width="30%" align="left">Email Id*</td>
                  <td width="75%" align="left"><input type="text" name="school_email_id" size="24" tabindex="1" maxlength="50" value="<?=$fetchData->school_email_id?>"/></td>
                </tr>
                <tr>
                  <td width="30%" align="left">Fax</td>
                  <td width="75%" align="left"><input type="text" name="school_fax" size="24" tabindex="1" maxlength="20" value="<?=$fetchData->school_fax?>"/></td>
                </tr>
                <tr>
                  <td width="30%" align="left">Average Fee</td>
                  <td width="75%" align="left"><input type="text" name="school_average_fee" size="24" tabindex="1" maxlength="20" value="<?=$fetchData->school_average_fee?>"/></td>
                </tr>
                <tr>
                  <td width="30%" align="left">Student/Faculty</td>
                  <td width="75%" align="left"><input type="text" name="school_student_faculty_ratio" size="24" tabindex="1" maxlength="20" value="<?=$fetchData->school_student_faculty_ratio?>"/></td>
                </tr>
                <tr>
                  <td width="30%" align="left">Boy/Girl</td>
                  <td width="75%" align="left"><input type="text" name="school_boy_girl_ratio" size="24" tabindex="1" maxlength="20" value="<?=$fetchData->school_boy_girl_ratio?>"/></td>
                </tr>
                 <tr>
                  <td width="30%" align="left">Student License limit</td>
                  <td width="75%" align="left"><input type="text" name="school_student_create_limit" size="24" tabindex="1" maxlength="20" value="<?=$fetchData->school_student_create_limit?>"/></td>
                </tr>
                <tr>
                  <td width="30%" align="left">Message Limit</td>
                  <td width="75%" align="left"><input type="text" name="school_message_limit" size="24" tabindex="1" maxlength="20" value="<?=$fetchData->school_message_limit?>"/></td>
                </tr>
                <tr>
                  <td width="30%" align="left">Country*</td>
                  <td width="75%" align="left"><input type="text" name="school_country" size="24" tabindex="1" value="<?=$fetchData->school_country?>"/></td>
                </tr>
                <tr>
                  <td width="30%" align="left">State*</td>
                  <td width="75%" align="left"><input type="text" name="school_state" size="24" tabindex="1" value="<?=$fetchData->school_state?>"/></td>
                </tr>
                <tr>
                  <td width="30%" align="left">City*</td>
                  <td width="75%" align="left"><input type="text" name="school_city" size="24" tabindex="1" value="<?=$fetchData->school_city?>"/></td>
                </tr>
                 
                 <tr>
                  <td width="30%" align="left">School Address</td>
                  <td width="75%" align="left"><input type="text" name="school_address" size="24" tabindex="1" maxlength="200" value="<?=$fetchData->school_address?>"/></td>
                </tr>
                  <tr>
                  <td width="30%" align="left">Description</td>
                  <td width="75%" align="left"><textarea name="school_description" rows="5" cols="50"><?=$fetchData->school_description?></textarea></td>
                </tr>
                <tr>
                  <td width="30%" align="left"></td>
                  <td width="75%" align="left"><input type="hidden" name="school_id" value="<?=$fetchData->school_id?>" />
                  <input type="submit" name="update" value="Update" tabindex="9" /></td>
                </tr>
              </table>
              </form>
  <? else:?>
              <form id="frm" action="<?=make_admin_url('udetail', 'insert', 'list','id='.$id);?>" method="post" name="frm" enctype="multipart/form-data">
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
                  <td width="30%" align="left">School Name*</td>
                  <td width="75%" align="left"><input type="text" name="school_name" size="24" tabindex="1" maxlength="200"/></td>
                </tr>
                 <tr>
                  <td width="30%" align="left">User Id*</td>
                  <td width="75%" align="left"><input type="text" name="school_id" size="24" tabindex="1" maxlength="100"/></td>
                </tr>
                 <tr>
                  <td width="30%" align="left">Admin Name*</td>
                  <td width="75%" align="left"><input type="text" name="school_admin_name" size="24" tabindex="1" maxlength="30"/></td>
                </tr>
                 <tr>
                  <td width="30%" align="left">Affiliation No.*</td>
                  <td width="75%" align="left"><input type="text" name="school_affiliation_no" size="24" tabindex="1" maxlength="30"/></td>
                </tr>
                 <tr>
                  <td width="30%" align="left">Contact No. 1</td>
                  <td width="75%" align="left"><input type="text" name="school_phone1" size="24" tabindex="1" maxlength="20"/></td>
                </tr>
                 <tr>
                  <td width="30%" align="left">Contact No. 2</td>
                  <td width="75%" align="left"><input type="text" name="school_phone2" size="24" tabindex="1" maxlength="20"/></td>
                </tr>
                <tr>
                  <td width="30%" align="left">Email Id*</td>
                  <td width="75%" align="left"><input type="text" name="school_email_id" size="24" tabindex="1" maxlength="50"/></td>
                </tr>
                <tr>
                  <td width="30%" align="left">Fax</td>
                  <td width="75%" align="left"><input type="text" name="school_fax" size="24" tabindex="1" maxlength="20"/></td>
                </tr>
                <tr>
                  <td width="30%" align="left">Average Fee</td>
                  <td width="75%" align="left"><input type="text" name="school_average_fee" size="24" tabindex="1" maxlength="20"/></td>
                </tr>
                <tr>
                  <td width="30%" align="left">Student/Faculty</td>
                  <td width="75%" align="left"><input type="text" name="school_student_faculty_ratio" size="24" tabindex="1" maxlength="20"/></td>
                </tr>
                <tr>
                  <td width="30%" align="left">Boy/Girl</td>
                  <td width="75%" align="left"><input type="text" name="school_boy_girl_ratio" size="24" tabindex="1" maxlength="20"/></td>
                </tr>
                <tr>
                  <td width="30%" align="left">Student License limit</td>
                  <td width="75%" align="left"><input type="text" name="school_student_create_limit" size="24" tabindex="1" maxlength="20"/></td>
                </tr>
                <tr>
                  <td width="30%" align="left">Message Limit</td>
                  <td width="75%" align="left"><input type="text" name="school_message_limit" size="24" tabindex="1" maxlength="20"/></td>
                </tr>
                <tr>
                  <td width="30%" align="left">Country*</td>
                  <td width="75%" align="left"><input type="text" name="school_country" size="24" tabindex="1" /></td>
                </tr>
                <tr>
                  <td width="30%" align="left">State*</td>
                  <td width="75%" align="left"><input type="text" name="school_state" size="24" tabindex="1" /></td>
                </tr>
                <tr>
                  <td width="30%" align="left">City*</td>
                  <td width="75%" align="left"><input type="text" name="school_city" size="24" tabindex="1" /></td>
                </tr>
                 
                 <tr>
                  <td width="30%" align="left">School Address</td>
                  <td width="75%" align="left"><input type="text" name="school_address" size="24" tabindex="1" maxlength="200"/></td>
                </tr>
                  <tr>
                  <td width="30%" align="left">Description</td>
                  <td width="75%" align="left"><textarea name="school_description" rows="5" cols="50"></textarea></td>
                </tr>
              
                
                <tr>
                  <td width="30%" align="left"></td>
                  <td width="75%" align="left">
                  <input type="hidden" name="school_id" value="<?=$id?>" />
                  <input type="submit" name="insert" value="Insert" tabindex="9" /></td>
                </tr>
              </table>
            </form>
  <? endif;?>

		
		<?
		#html code here.
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
