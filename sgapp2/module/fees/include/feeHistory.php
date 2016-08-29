<script>
function feeHistoryToggle(id)
{
 $('#'+id).toggle();
 $('#'+id+' #waverButton').show();
 $('#'+id+' #waverForm').hide();
}

function waverToggle(id)
{
 $('#payButton'+id+' #waverButton').toggle();
 $('#payButton'+id+' #waverForm').toggle();
}
</script>
 
<div class="panel-body">					
	<div class="row">
	  <div class="col-md-4 ">
		<table class="table table-condensed table-hover">
		  <thead>
			<tr>
			  <h4 align="center">
			  <?=$studentDetails->student_first_name.' '.$studentDetails->student_last_name?>
			</h4>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  <td>Roll Number</td>
			  <td><?=$studentDetails->student_roll_number?>
			  </td>
			  <td></td>
			</tr>
			<tr>
			  <td>Class</td>
			  <td><?=get_object_by_query('class','class_id='.$studentDetails->class_id)->class_name;?></td>
			  <td></td>
			</tr>
			<tr>
			  <td>Father Name</td>
			  <td><?=$studentDetails->student_father_first_name.' '.$studentDetails->student_father_last_name?></td>
			  <td></td>
			</tr>
			
			<tr>
			  <td>Primary Contact Number </td>
			  <td><?=$studentDetails->student_contact?>
			  </td>
			  <td></td>
			</tr>
		   
		  </tbody>
		</table>
	  </div>
	   <div class="col-sm-4 ">
	   <form action="<?=make_long_url('fees-collection','feeHistory','feeHistory','student_id='.$student_id);?>" name="filter" id="filter" method="post">

		<div class="panel-body" >
		  <div class="form-group">
			<label>Other Fee Collection</label>
			<select name="feeCollectionType" id="feeCollectionType" class="form-control" onChange="searchResult();">
			  <option value=""> All Fee Collections </option>
			  <? foreach($feeCollectionTypetArray as $k=>$v):?>
			  <option value="<?=$v->fee_collection_type_id?>" <?=($feeCollectionType==$v->fee_collection_type_id)?'selected':'';?>>
			  <?=$v->fee_collection_type?>
			  </option>
			  <? endforeach;?>
			</select>
		  </div>
		</div>
	  </form>
	   </div>
	</div>



	<div class="row">
	  <div class="col-md-12">
		<div class="panel-body">
		  
		  <? if($feeCollectionTypetList):?>
		  <? foreach($feeCollectionTypetList as $feeCollectionTypetListKey=>$feeCollectionTypetListValue):?>
		  <? $studentFeeStatus=get_all_record_by_query('student_fee_history','fee_collection_type_id="'.$feeCollectionTypetListValue->fee_collection_type_id.'" and student_id="'.$student_id.'"','*');?>
		  <? $paymentHistory=get_object_by_query('student_fee_history','fee_collection_type_id="'.$feeCollectionTypetListValue->fee_collection_type_id.'" and student_id="'.$student_id.'"','SUM(student_fee_history_paid_amount) as totalPaidAmount,SUM(student_fee_history_waver) as totalWaver');?>
		  <? $totalPaidAmount=$paymentHistory->totalPaidAmount;?>
		  <? $totalWaver=get_object_by_query('student_fee_history','fee_collection_type_id="'.$feeCollectionTypetListValue->fee_collection_type_id.'" and student_id="'.$student_id.'" and student_fee_history_waver_status=1','SUM(student_fee_history_waver) as totalWaver')->totalWaver;?>
		  
		  <div class="panel panel-default">
			  
				<div class="panel-body">
					<div class="row">
						<div class="col-md-5"> 
					  		<h4    <?=(date('Y-m-d')>=$feeCollectionTypetListValue->fee_collection_type_start_date && date('Y-m-d')<=$feeCollectionTypetListValue->fee_collection_type_due_date && !$studentFeeStatus)?'style="color:#3333FF"':((date('Y-m-d')>$feeCollectionTypetListValue->fee_collection_type_due_date && !$studentFeeStatus)?'style="color:#A51501"':'');?>  >
						<?=$feeCollectionTypetListValue->fee_collection_type?>
						<small>	(Due Date <?=ToIndianDate($feeCollectionTypetListValue->fee_collection_type_due_date);?>) </small>
					  		</h4>
						</div>
						<?php /*?>
						<div class="col-md-3">	
							<h4><small><strong>Due Amount </strong></small>
							<?=$payableAmount=$feeStructuretTotalAmount+countStudentPendingFee($student_id,$feeCollectionTypetListValue->fee_collection_type_start_date)+countFine($feeStructuretTotalAmount,$feeCollectionTypetListValue->fee_collection_type_due_date,date('Y-m-d'))?>
							</h4>
						</div>
						<div class="col-md-4">	
						  <a class="btn btn-md btn-green" > Pay Now </a>
						  <a class="btn btn-sm btn-info" href="#waiver" data-toggle="modal"> 
						  	<i class="fa fa-plus"></i>  Waiver Request </a>
						</div><?php */?>
					  </div>
					  
					  
					  <div id="waiver" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title">Waiver Request</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-3">
						<h4>Waiver Category</h4>
						<p>
							 <select class="form-control" >
                          <option value="">  </option>
                         
                          <option value=""> Late Fees </option>
                      		 <option value=""> Special Discount </option>
                        </select>
						</p>
					</div>
					<div class="col-md-3">
						<h4>Amount</h4>
						<p>
							<input class="form-control" type="text">
						</p>
					</div>
					<div class="col-md-6">
						<h4>Comments</h4>
						<p>
							<input class="form-control" type="text">
						</p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-light-grey">
					Cancel
				</button>
				<button type="button" class="btn btn-blue">
					Send Request
				</button>
			</div>
		</div>
					  
					  		
					  <div class="row">
						<div class="col-md-12">
						  <div class="">
							<table class="table table-condensed table-hover">
							  <thead>
								<tr>
								  <th>Fees Category</th>
								  <th>Notes</th>
								  <th>Amount</th>
								  <th></th>
								</tr>
							  </thead>
							  <? 
											  #fetch fee collection type list
											  $feeStructuretList=get_all_record_by_query('fee_collection_management as a,fee_structure as b,fee_category as c','a.student_id="'.$student_id.'" and b.fee_structure_id=a.fee_structure_id  and b.fee_collection_type_id="'.$feeCollectionTypetListValue->fee_collection_type_id.'" and c.fee_category_id=b.fee_category_id');
											   $feeStructuretTotalAmount=get_object_by_query('fee_collection_management as a,fee_structure as b,fee_category as c','a.student_id="'.$student_id.'" and b.fee_structure_id=a.fee_structure_id  and b.fee_collection_type_id="'.$feeCollectionTypetListValue->fee_collection_type_id.'" and c.fee_category_id=b.fee_category_id','SUM(b.fee_structure_amount) as totalAmount')->totalAmount;
										
											  ?>
							  <? if($feeStructuretList):?>
							  <tbody>
								<? foreach($feeStructuretList as $k=>$v):?>
								<tr>
								  <td><?=ucfirst($v->fee_category);?></td>
								  <td><?=$v->fee_structure_notes;?></td>
								  <td><?=$v->fee_structure_amount;?></td>
								  <td></td>
								</tr>
								<? endforeach;?>
								<? if($studentFeeStatus):?>
								<tr>
								  <th></th>
								  <th>Total Fee</th>
								  <th><?=$feeStructuretTotalAmount?></th>
								  <th></th>
								</tr>
								 <tr>
								  <th></th>
								  <th>Late Fee Fine</th>
								  <th><?=countFine($feeStructuretTotalAmount,$feeCollectionTypetListValue->fee_collection_type_due_date,$studentFeeStatus[0]->student_fee_history_cheque_date)?></th>
								  <th></th>
								</tr>
								<tr>
								  <th></th>
								  <th>Total Due Fees</th>
								  <th><?=$payableAmount=$feeStructuretTotalAmount-$totalPaidAmount-$totalWaver+countFine($feeStructuretTotalAmount,$feeCollectionTypetListValue->fee_collection_type_due_date,$studentFeeStatus[0]->student_fee_history_cheque_date)?></th>
								  <th> <input class="btn btn-primary btn-sm" type="button" name="submit" value="Pay Now" onclick="feeHistoryToggle('<?='payButton'.$feeCollectionTypetListValue->fee_collection_type_id?>');"/>
								  </th>
								</tr>
								<? else:?>
								<tr>
								  <th></th>
								  <th>Total Fee</th>
								  <th><?=$feeStructuretTotalAmount?></th>
								  <th></th>
								</tr>
								<tr>
								  <th></th>
								  <th>Previous Pending Dues</th>
								  <th><?=countStudentPendingFee($student_id,$feeCollectionTypetListValue->fee_collection_type_start_date)?></th>
								  <th></th>
								</tr>
								 <tr>
								  <th></th>
								  <th>Late Fee Fine</th>
								  <th><?=countFine($feeStructuretTotalAmount,$feeCollectionTypetListValue->fee_collection_type_due_date,date('Y-m-d'))?></th>
								  <th></th>
								</tr>
								<tr>
								  <th></th>
								  <th>Total Due Fees</th>
								  <th><?=$payableAmount=$feeStructuretTotalAmount+countStudentPendingFee($student_id,$feeCollectionTypetListValue->fee_collection_type_start_date)+countFine($feeStructuretTotalAmount,$feeCollectionTypetListValue->fee_collection_type_due_date,date('Y-m-d'))?></th>
								  <th> <input class="btn btn-primary btn-sm" type="button" name="submit" value="Pay Now" onclick="feeHistoryToggle('<?='payButton'.$feeCollectionTypetListValue->fee_collection_type_id?>');"/>
								  </th>
								</tr>
								<? endif;?>
							  </tbody>
							  <? endif;?>
							</table>
							<? if($studentFeeStatus):?>
							<table class="table table-condensed">
							  <h4>Payment Status</h4>
							  <thead>
								<tr>
								  <th >Receipt Number</th>
								  <th >Date</th>
								  <th >Mode of Payment</th>
								  <th >Bank Name</th>
								  <th >Cheque/DD Number</th>
								  <th >Amount</th>
								  <th >Waiver Category</th>
								  <th >Waiver Status</th>
								  <th >Waiver</th>
								  <th >Waiver Comment</th>
								  <th></th>
								</tr>
							  </thead>
							  <tbody id="">
								<? foreach($studentFeeStatus as $k=>$v):?>
								<tr id="feeHistoryList<?=$v->student_fee_history_id?>">
								  <td><?=$v->student_fee_history_id?></td>
								  <td><?=ToIndianDate($v->student_fee_history_cheque_date)?></td>
								  <td><?=$paymentModeArray[$v->student_fee_history_payment_mode]?></td>
								  <td><?=$v->student_fee_history_bank_name?></td>
								  <td><?=$v->student_fee_history_cheque_number?></td>
								  <td><?=$v->student_fee_history_paid_amount?></td>
								  <td><?=get_object_by_query('fee_waiver_category','fee_waiver_category_id='.$v->fee_waiver_category_id)->fee_waiver_category?></td>
								  <td><?=$waiverStatusArray[$v->student_fee_history_waver_status]?></td>
								  <td><?=$v->student_fee_history_waver?></td>
								  <td><?=$v->student_fee_history_waver_comment?></td>
								  <td><a onClick="editFeeHistory(<?=$v->student_fee_history_id?>);" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
								</tr>
								<tr id="feeHistoryEdit<?=$v->student_fee_history_id?>" style="display:none">
								  <td colspan="11">
									  <div class="alert alert-info" >
										<div class="row">
										  <div class="col-md-12">
										  <form name="studentFee" id="studentFee" action="<?=make_long_url('fees-collection','updateStudentFee','updateStudentFee','student_fee_history_id='.$v->student_fee_history_id.'&student_id='.$student_id)?>" method="post">
											<table class="table table-condensed" >
											  <thead>
												<tr>
												  <th >Date</th>
												  <th >Mode of Payment</th>
												  <th >Bank Name</th>
												  <th >Cheque/DD Number</th>
												  <th >Amount</th>
												  <th ></th>
												  <th ></th>
												</tr>
											  </thead>
											  <tbody >
												<tr>
												 <td><input   class="form-control input-sm date-picker" data-date-format="dd-mm-yyyy" type="text" name="student_fee_history_cheque_date" id="student_fee_history_cheque_date" value="<?=ToIndianDate($v->student_fee_history_cheque_date)?>"></td>
												  <td><select  class="form-control input-sm" id="student_fee_history_payment_mode" name="student_fee_history_payment_mode" >
													  <? foreach($paymentModeArray as $kk=>$vv):?>
													  <option value="<?=$kk?>" <?=($v->student_fee_history_payment_mode==$kk)?' selected="selected"':'';?>>
													  <?=$vv?>
													  </option>
													  <? endforeach;?>
													</select>
												  </td>
												  <td><input id="student_fee_history_bank_name" class="form-control input-sm" type="text" name="student_fee_history_bank_name" value="<?=$v->student_fee_history_bank_name?>"></td>
												  <td><input id="student_fee_history_cheque_number" class="form-control input-sm" type="text" name="student_fee_history_cheque_number" value="<?=$v->student_fee_history_cheque_number?>"></td>
												  <td><input id="student_fee_history_paid_amount" class="form-control input-sm" type="text" name="student_fee_history_paid_amount" value="<?=$v->student_fee_history_paid_amount?>"></td>
												  <td>
													<button type="submit" name="submit" value="Update" class="btn btn-primary btn-sm">Update</button></td>
												  <td><a class="btn btn-med-grey btn-sm" onClick="editFeeHistory(<?=$v->student_fee_history_id?>);"> Cancel</a> </td>
												</tr>
												<tr>
												
											  </tbody>
										   </table>
										   <table class="table table-condensed" id="waverForm" >
							  <thead>
								<th>Waiver Category</th>
								<th>Waiver Amount</th>
								<th >Waiver Comment</th>
											 </thead> 
							  <tbody > 
								<tr>
								<td>
								   <select class="form-control" id="fee_waiver_category_id" name="fee_waiver_category_id">
									<? foreach($feeWaiverCategoryList as $key=>$value):?>
									<option value="<?=$value->fee_waiver_category_id?>" <?=($value->fee_waiver_category_id==$v->fee_waiver_category_id)?'selected':'';?>><?=$value->fee_waiver_category?></option>
									<? endforeach;?>
								   </select>
								</td>
								<td><input id="student_fee_history_waver" class="form-control input-sm" type="text" name="student_fee_history_waver" value="<?=$v->student_fee_history_waver?>"></td>
								<td ><input id="student_fee_history_waver_comment" class="form-control input-sm" type="text" name="student_fee_history_waver_comment" value="<?=$v->student_fee_history_waver_comment?>"></td>
							   
								</tr>
							  </tbody>
							</table>
										   
										   </form>
										   
										  </div>
										</div>
									  </div>
								  </td>
								</tr>
								<? endforeach;?>
							  </tbody>
							</table>
							<? endif;?>
							
							<table class="table table-condensed">
							  <h4>Waiver Status</h4>
							  <thead>
								<tr>
								  <th >Request Date</th>
								  <th >Waiver Category</th>
								  <th >Amount</th>
								  <th >Status</th>
								 
								  <th >Comments</th>
								  <th></th>
								</tr>
							  </thead>
							  <tbody id="">
								
							  </tbody>
							</table>
							
						  </div>
						</div>
					  </div>
					
					  <div class="alert alert-info" id="<?='payButton'.$feeCollectionTypetListValue->fee_collection_type_id?>" style="display:none">
						<div class="row">
						  <div class="col-md-12">
						  <form name="studentFee" id="studentFee" action="<?=make_long_url('fees-collection','payStudentFee','payStudentFee','student_id='.$student_id)?>" method="post">
							<table class="table table-condensed" >
							  <thead>
							
								 
								  <th >Date</th>
								  <th >Mode of Payment</th>
								  <th >Bank Name</th>
								  <th >Cheque/DD Number</th>
								  <th >Amount</th>
								  <th ></th>
								  <th ></th>
								</tr>
							  </thead>
							  <tbody >
								<tr>
								  
								  <td><input   class="form-control input-sm date-picker" data-date-format="dd-mm-yyyy" type="text" name="student_fee_history_cheque_date" id="student_fee_history_cheque_date" value="<?=date('d-m-Y');?>"></td>
								  <td><select  class="form-control input-sm" id="student_fee_history_payment_mode" name="student_fee_history_payment_mode" >
									  <? foreach($paymentModeArray as $k=>$v):?>
									  <option value="<?=$k?>">
									  <?=$v?>
									  </option>
									  <? endforeach;?>
									</select>
								  </td>
								  <td><input id="student_fee_history_bank_name" class="form-control input-sm" type="text" name="student_fee_history_bank_name" placeholder=""></td>
								  <td><input id="student_fee_history_cheque_number" class="form-control input-sm" type="text" name="student_fee_history_cheque_number" placeholder=""></td>
								  <td><input id="student_fee_history_paid_amount" class="form-control input-sm" type="text" name="student_fee_history_paid_amount" required></td>
								  <td><input type="hidden" name="fee_collection_type_id" id="fee_collection_type_id" value="<?=$feeCollectionTypetListValue->fee_collection_type_id?>" />
									<button type="submit" name="submit" value="Pay Now" class="btn btn-primary btn-sm"> Submit </button></td>
								  <td><a class="btn btn-med-grey btn-sm" onclick="feeHistoryToggle('<?='payButton'.$feeCollectionTypetListValue->fee_collection_type_id?>');"> Cancel</a> </td>
								</tr>
							
								
							  </tbody>
						   </table>
						   <table class="table table-condensed" id="waverButton">
							<tr>
							  <td>
								 <a class="btn btn-xs btn-primary" onclick="waverToggle('<?=$feeCollectionTypetListValue->fee_collection_type_id?>')"> <i class="fa fa-plus"></i> Add Waiver  </a>
							  </td>
						   </tr>
						   </table>
						   <table class="table table-condensed" id="waverForm" style="display:none">
							  <thead>
								<th>Waiver Category</th>
								<th>Waiver Amount</th>
								<th >Waiver Comment</th>
							  </thead> 
							  <tbody > 
								<tr>
								<td>
								   <select class="form-control" id="fee_waiver_category_id" name="fee_waiver_category_id">
									<? foreach($feeWaiverCategoryList as $k=>$v):?>
									<option value="<?=$v->fee_waiver_category_id?>"><?=$v->fee_waiver_category?></option>
									<? endforeach;?>
								   </select>
								</td>
								<td><input id="student_fee_history_waver" class="form-control input-sm" type="text" name="student_fee_history_waver" ></td>
								<td ><input id="student_fee_history_waver_comment" class="form-control input-sm" type="text" name="student_fee_history_waver_comment" ></td>
							   
								</tr>
							  </tbody>
							</table>
						   </form>
						   
						  </div>
						</div>
					  </div>
					 
				</div>
		  </div>
		  
		  <? endforeach;?>
		  <? endif;?>
		</div>
	  </div>
	</div>

</div> 