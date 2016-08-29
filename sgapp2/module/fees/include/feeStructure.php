<script>
var count = 1;
function addFeesStructure(id){
    count++;
    $('#'+id).append(
        '<tr>'+
		  '<td>'+
		     '<select  class="form-control input-sm" name="fee_category_id['+count+']" required>'+
			  '<option value="">--Fee Category--</option>'+
			  '<? foreach($feeCategoryList as $feeCategoryListKey=>$feeCategoryListValue):?>'+
			  '<option value="<?=$feeCategoryListValue->fee_category_id?>"><?=$feeCategoryListValue->fee_category?></option>'+
			  '<? endforeach;?>'+
			'</select>'+
		  '</td>'+
		  '<td><input  class="form-control input-sm" type="number" name="fee_structure_amount['+count+']"  required></td>'+
		  '<td><input id="" class="form-control input-sm" type="text" name="fee_structure_notes['+count+']" placeholder=""></td>'+
		  '<td>'+
		     '<a href="#studentList'+count+'" data-toggle="modal" class="btn btn-xs btn-teal" data-original-title="Edit">Selected <i class="fa fa-user fa fa-white"></i></a>'+
			  '<div id="studentList'+count+'" class="modal fade" tabindex="-1" data-width="760" style="display: none;">'+    
			   '<div class="modal-header">'+ 
				'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+ 
				'<h4 class="modal-title">Student List</h4>'+ 
			   '</div>'+ 
			   '<div class="modal-body">'+ 
			   '<div class="row">'+         
                 '<table class="table table-striped table-condensed table-hover">'+
					'<thead>'+
						'<tr>'+
							'<th class="center"></th>'+
							'<th class="center">Photo</th>'+
							'<th>Full Name</th>'+
							'<th class="hidden-xs">Roll Number</th>'+
							'<th class="hidden-xs">Prefered Email</th>'+
						'</tr>'+
					'</thead>'+
					'<tbody>'+
					  '<? if($studentList):?>'+
						'<?  foreach($studentList as $studentListKey=>$studentListValue):?>'+
						'<tr>'+
							'<td class="center">'+
							'<div class="checkbox-table">'+
							 '<input type="checkbox" checked="checked" class="flat-green" name="student_id['+count+'][]" value="<?=$studentListValue->student_id?>">'+
							'</div>'+
							'</td>'+
							'<td class="center">'+
							'<img src="<?=($studentListValue->student_image)?createImazeSize(get_small('student'),$studentListValue->student_image,30,30):'design/images/avatar-1-small.jpg'?>" alt="image"/>'+
							'</td>'+
							'<td><?=$studentListValue->student_first_name.' '.$studentListValue->student_last_name?></td>'+
							'<td class="hidden-xs"><?=$studentListValue->student_roll_number?></td>'+
							'<td class="hidden-xs"><?=$studentListValue->student_email_id?></td>'+
						'</tr>'+
						'<? endforeach;?>'+
					   '<? else:?>'+
						'<tr><td colspan="5">No Student</td></tr>'+
					   '<? endif;?>'+
					  '</tbody>'+  
					'</table>'+
					'</div>'+
                 '</div>'+
			  '</div>'+
		   '</td>'+
		   '<td>'+	   
			 '<span class="btn btn-xs btn-bricky"><i class="fa fa-trash-o"></i></span>'+
		   '</td>'+
		'</tr>');
         
        $(".fa-trash-o").bind("click", Delete);
};

function Delete(){
    var par = $(this).parent().parent().parent(); //tr
    par.remove();
};

</script>   
                 <div class="">
                     <? if($feeCollectionTypetList):?>  
                     <? foreach($feeCollectionTypetList as $feeCollectionTypetListKey=>$feeCollectionTypetListValue):?>                  
                      <div class="panel panel-default">
					  <div class="panel-body">
					  <h3><?=$feeCollectionTypetListValue->fee_collection_type?></h3>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="">
                            <table class="table table-condensed table-hover">
                              <thead>
                                <tr>
                                  <th>Fees Category</th>
                                  <th>Amount</th>
                                  <th>Notes</th>
                                  <th>Students</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <? 
							  #fetch fee collection type list
                              $feeStructuretList=get_all_record_by_query('fee_structure as a,fee_category as b,fee_collection_type as c,class as d','a.fee_collection_type_id="'.$feeCollectionTypetListValue->fee_collection_type_id.'" and a.class_id="'.$class.'" and b.fee_category_id=a.fee_category_id and c.fee_collection_type_id=a.fee_collection_type_id and d.class_id=a.class_id');
							 
							  ?>
                              <? if($feeStructuretList):?>
                              <tbody>
                                <? foreach($feeStructuretList as $k=>$v):?>
                                <tr id="feeStructureList<?=$v->fee_structure_id?>">
                                  <td><?=ucfirst($v->fee_category);?></td>
                                  <td><?=$v->fee_structure_amount;?></td>
                                  <td><?=$v->fee_structure_notes;?></td>
                                  <td>
                                  <a href="#feeStructureId<?=$v->fee_structure_id;?>" data-toggle="modal" class="btn btn-xs btn-teal" data-original-title="Edit">
								   <?=array_diff(studentList($class),feeCollectionManagementtList($v->fee_structure_id))?'Selected':'All';?>
                                   <i class="fa fa-user fa fa-white"></i>
                                  </a> 
                                       <div id="feeStructureId<?=$v->fee_structure_id;?>" class="modal fade" tabindex="-1" data-width="760" style="display: none;">             
                                         <? include('module/fees/include/updateStudentList.php');?>                    
                                       </div>
                                  </td>
                                  <td><a onClick="editFeeStructure(<?=$v->fee_structure_id?>);" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr id="feeStructureEdit<?=$v->fee_structure_id?>" style="display:none">
                                
                                  <td colspan="5">  
                                     <form  action="<?=make_long_url('fees-fees','updateFeeStructure','list','fee_structure_id='.$v->fee_structure_id.'&class='.$class)?>" method="post"  >
					  <div class="alert alert-info">
                      <div class="row">
                        <div class="col-md-12">
                          
                            <table class="table table-condensed">
                              
                              <tbody>
                                <tr>
                                <td>  
                                    <select  class="form-control input-sm" name="fee_category_id" required>
                                      <option value="">--Fee Category--</option>
                                      <? foreach($feeCategoryList as $feeCategoryListKey=>$feeCategoryListValue):?>
                                      <option value="<?=$feeCategoryListValue->fee_category_id?>" <?=($feeCategoryListValue->fee_category_id==$v->fee_category_id)?'selected="selected" ':'';?> ><?=$feeCategoryListValue->fee_category?></option>
                                      <? endforeach;?>
                                    </select>
                                  </td>
                                  <td><input  class="form-control input-sm" type="number" name="fee_structure_amount" value="<?=$v->fee_structure_amount;?>" required></td>
                                  <td><input  class="form-control input-sm" type="text" name="fee_structure_notes" value="<?=$v->fee_structure_notes;?>"></td>
                                  <td>
                                  <a href="#feeStructureIdUpdate<?=$v->fee_structure_id;?>" data-toggle="modal" class="btn btn-xs btn-teal" data-original-title="Edit">
								   <?=array_diff(studentList($class),feeCollectionManagementtList($v->fee_structure_id))?'Selected':'All';?>
                                   <i class="fa fa-user fa fa-white"></i>
                                  </a> 
                                       <div id="feeStructureIdUpdate<?=$v->fee_structure_id;?>" class="modal fade" tabindex="-1" data-width="760" style="display: none;">             
                                         <? include('module/fees/include/updateStudentList.php');?>                    
                                       </div>
                                  </td>
                                  <td><button class="btn btn-sm " type="submit" value="Update" name="submit"><i class="fa fa-pencil edit-user-info"></i></button></td>
                                </tr>
                              </tbody>
                            </table>
                          
                            
                            
                        </div>
                      </div>
                      
					  </div>
                      </form>
                                  </td>
                                
                                  
                                </tr>
                                <? endforeach;?>
                              </tbody>
                              <? endif;?>
                            </table>
                            <a class="btn btn-xs btn-primary" onclick="toggle('feeStructureForm<?=$feeCollectionTypetListValue->fee_collection_type_id?>')"> <i class="fa fa-plus"></i> Add Fees Structure  </a> </div>
                          </div>
                        </div>
                      </div>
					  
                      <form id="feeStructureForm<?=$feeCollectionTypetListValue->fee_collection_type_id?>" name="" action="<?=make_long_url('fees-fees','insertFeeStructure','','class='.$class)?>" method="post" style="display:none" >
					  <div class="alert alert-info">
                      <div class="row">
                        <div class="col-md-12">
                          
                            <table class="table table-condensed" id="feeStructureTable<?=$feeCollectionTypetListValue->fee_collection_type_id?>">
                              <thead>
                                <tr>
                                  <th >Fees Category</th>
                                  <th >Amount</th>
                                  <th >Remarks</th>
                                  <th >Students</th>
								  <th></th>
                                </tr>
                              </thead>
                              <tbody id="feeStructureTableTbody<?=$feeCollectionTypetListValue->fee_collection_type_id?>">
                                <tr>
                                  <td>
                                     <select  class="form-control input-sm" name="fee_category_id[1]" required>
                                      <option value="">--Fee Category--</option>
                                      <? foreach($feeCategoryList as $feeCategoryListKey=>$feeCategoryListValue):?>
                                      <option value="<?=$feeCategoryListValue->fee_category_id?>"><?=$feeCategoryListValue->fee_category?></option>
                                      <? endforeach;?>
                                    </select>
                                  </td>
                                  <td><input  class="form-control input-sm" type="number" name="fee_structure_amount[1]" placeholder="" required></td>
                                  
                                  <td><input id="" class="form-control input-sm" type="text" name="fee_structure_notes[1]" placeholder=""></td>
                                  <td>
                                     <a href="#studentLists<?=$feeCollectionTypetListValue->fee_collection_type_id?>" data-toggle="modal" class="btn btn-xs btn-teal" >Selected <i class="fa fa-user fa fa-white"></i></a> 
                                        <div id="studentLists<?=$feeCollectionTypetListValue->fee_collection_type_id?>" class="modal fade" tabindex="-1" data-width="760" style="display: none;">             
                                         <? include('module/fees/include/studentList.php');?>                    
                                       </div>
								   </td>
								   <td>	   
                                     <a href="#" class="btn btn-xs btn-bricky"> <i class="fa fa-trash-o"></i></a>
                                   </td>
                                </tr>
                              </tbody>
                            </table>
                          
                            <a class="btn btn-xs btn-primary" onclick="addFeesStructure('feeStructureTableTbody<?=$feeCollectionTypetListValue->fee_collection_type_id?>');"> <i class="fa fa-plus"></i> Add More </a> 
                            
                            
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12" align="center">
                          <input type="hidden" name="class_id" value="<?=$class?>" />
                          <input type="hidden" name="fee_collection_type_id" value="<?=$feeCollectionTypetListValue->fee_collection_type_id?>" />
                          
						  <button type="submit" name="submit" value="Save" class="btn btn-purple"> Save </button>
						  <a class="btn btn-med-grey" onclick="toggle('feeStructureForm<?=$feeCollectionTypetListValue->fee_collection_type_id?>')"> Cancel</a>
                        </div>
                      </div>
					  </div>
                      </form>
					  </div>
					  
                      <? endforeach;?>
                      <? endif;?>
                    </div>
            