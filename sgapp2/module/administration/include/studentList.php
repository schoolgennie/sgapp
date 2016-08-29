<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title">Student List</h4>
</div>
<div class="modal-body">
   <div class="row">
    <table class="table table-striped table-condensed table-hover" >
    <thead>
        <tr>
            <th class="center"></th>
            <th class="center">Photo</th>
            <th>Full Name</th>
            <th class="hidden-xs">Roll Number</th>
            <th class="hidden-xs">Prefered Email</th>
            
            
        </tr>
    </thead>
    <tbody>
      <? if($studentList):?>
      
      <?  foreach($studentList as $studentListKey=>$studentListValue):?>
        <tr>
            <td class="center">
            <div class="checkbox-table">
             <input type="checkbox" checked="checked" class="flat-green" id="student_id" name="student_id[]" value="<?=$studentListValue->student_id?>">
            </div>
            </td>
            <td class="center">
            <img src="<?=($studentListValue->student_image)?createImazeSize(get_small('student'),$studentListValue->student_image,30,30):'design/images/avatar-1-small.jpg'?>" alt="image"/>
            </td>
            <td><?=$studentListValue->student_first_name.' '.$studentListValue->student_last_name?></td>
            <td class="hidden-xs"><?=$studentListValue->student_roll_number?> </td>
            <td class="hidden-xs"><?=$studentListValue->student_email_id?></td>
        </tr>
        <? endforeach;?>
        <? else:?>
         <tr><td colspan="5">No Student</td></tr>
        <? endif;?>
    </tbody>
    </table>
	
   </div>
   <div class="row" align="center">
   <button type="button" class=" btn btn-primary" data-dismiss="modal" aria-hidden="true">
        Save
    </button>
	</div>
</div>    