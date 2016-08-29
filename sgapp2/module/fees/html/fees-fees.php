<!DOCTYPE html >
<html >
<head>
<? include_once(DIR_FS_SITE_INCLUDE.'meta.php'); ?>
<title>School Gennie</title>
<? include_once(DIR_FS_SITE_INCLUDE.'css.php'); ?>
<? include_once(DIR_FS_SITE_INCLUDE.'javascript.php'); ?>
<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
<link href="design/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
<link href="design/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="design/plugins/flot/jquery.flot.js"></script>
<script src="design/plugins/flot/jquery.flot.pie.js"></script>
<script src="design/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="design/plugins/jquery.sparkline/jquery.sparkline.js"></script>
<script src="design/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="design/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
<script src="design/plugins/fullcalendar/fullcalendar/fullcalendar.js"></script>
<script src="design/js/index.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script>
			jQuery(document).ready(function() {
			    $("#newClassForm").validate();
				Index.init();
			});
		</script>
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="design/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
<script src="design/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
<script src="design/js/ui-modals.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script>
			jQuery(document).ready(function() {
				UIModals.init();
			});
		</script>
<link href="css/style1.css" media="screen, projection" rel="stylesheet" type="text/css">
<script>
			jQ172(document).ready(function(){
			
				// binds form submission and fields to the validation engine
				jQ172("#frmClass").validationEngine();
			});
	
		</script>
<script>
function toggle(id)
{
 $('#'+id).toggle();
}
</script>   
<script>
function editFeeCategory(id)
{
 $('#feeCategoryList'+id).toggle();
 $('#feeCategoryEdit'+id).toggle();
}
function editFeeWaiverCategory(id)
{
 $('#feeWaiverCategoryList'+id).toggle();
 $('#feeWaiverCategoryEdit'+id).toggle();
}
function editFeeCollectionType(id)
{

 $('#feeCollectionTypeList'+id).toggle();
 $('#feeCollectionTypeEdit'+id).toggle();
}
function editFeeStructure(id)
{
 $('#feeStructureList'+id).toggle();
 $('#feeStructureEdit'+id).toggle();
}
</script>       
<!--smoth menu start-->
<link href="css/front.css" media="screen, projection" rel="stylesheet" type="text/css">

</head>
<body>
<!-- Header Start-->
<? include_once(DIR_FS_SITE_INCLUDE.'header.php'); ?>
<!-- Header End-->
<!-- start: MAIN CONTAINER -->
<div class="main-container">
  <!--Navigation Start -->
  <? include_once(DIR_FS_SITE_INCLUDE.'schoolNav.php'); ?>
  <!--Navigation End -->
  <div class="main-content">
    <?php display_form_error();?>
    <div class="container">
      <!-- start: PAGE HEADER -->
      <div class="row">
        <div class="col-sm-12">
          <!-- start: STYLE SELECTOR BOX -->
          <!-- end: STYLE SELECTOR BOX -->
          <!-- start: PAGE TITLE & BREADCRUMB -->
          <!-- end: PAGE TITLE & BREADCRUMB -->
          <div class="page-header">
            <h1>Fees</h1>
          </div>
        </div>
      </div>
      <!-- end: PAGE HEADER -->
      <!-- start: PAGE CONTENT -->
      <div class="row">
        <div class="col-sm-9">
          
          <!-- start: ACCORDION PANEL -->
          <div class="panel panel-default">
            <div class="panel-heading"> <i class="fa fa-reorder"></i> Fees Collection
              <div class="panel-tools"> </div>
            </div>
            <div class="panel-body">
              <table class="table table-condensed table-hover">
                <thead>
                  <tr>
                    <th >Collection Name</th>
                    <th >Start Date</th>
                    <th >End Date</th>
                    <th >Due Date</th>
                    <th ></th>
                  </tr>
                </thead>
                <tbody>
                  <? if($feeCollectionTypetList):?>
					  <? foreach($feeCollectionTypetList as $feeCollectionTypetKey=>$feeCollectionTypetValue):?>
                          
                          <? if($feeCollectionTypetValue->fee_collection_type=='One Time Fee'):?>
                          <tr>
                            <td><?=$feeCollectionTypetValue->fee_collection_type?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <? else:?>
                           <tr id="feeCollectionTypeList<?=$feeCollectionTypetValue->fee_collection_type_id?>">
                            <td><?=$feeCollectionTypetValue->fee_collection_type?></td>
                            <td><?=ToIndianDate($feeCollectionTypetValue->fee_collection_type_start_date)?></td>
                            <td><?=ToIndianDate($feeCollectionTypetValue->fee_collection_type_end_date)?></td>
                            <td><?=ToIndianDate($feeCollectionTypetValue->fee_collection_type_due_date)?></td>
                            <td><a onClick="editFeeCollectionType(<?=$feeCollectionTypetValue->fee_collection_type_id?>);" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                          </tr>
                           <tr id="feeCollectionTypeEdit<?=$feeCollectionTypetValue->fee_collection_type_id?>" style="display:none">
                            <form name="newFeeCollection" id="newFeeCollection" action="<?=make_long_url('fees-fees','updateFeeCollection','list','fee_collection_type_id='.$feeCollectionTypetValue->fee_collection_type_id)?>" method="post">
                              <td><input id="fee_collection_type" class="form-control input-sm" type="text" name="fee_collection_type" value="<?=$feeCollectionTypetValue->fee_collection_type?>" required></td>
                              <td><input id="fee_collection_type_start_date" class="form-control input-sm input-mask-date date-picker" type="text" name="fee_collection_type_start_date" value="<?=ToIndianDate($feeCollectionTypetValue->fee_collection_type_start_date)?>" date-format="dd-mm-yyyy" required></td>
                              <td><input id="fee_collection_type_end_date" class="form-control input-sm input-mask-date" type="text" name="fee_collection_type_end_date" value="<?=ToIndianDate($feeCollectionTypetValue->fee_collection_type_end_date)?>" required></td>
                              <td><input id="fee_collection_type_due_date" class="form-control input-sm input-mask-date" type="text" name="fee_collection_type_due_date" value="<?=ToIndianDate($feeCollectionTypetValue->fee_collection_type_due_date)?>" required></td>
                              <td><button class="btn btn-primary btn-sm " type="submit" value="Update" name="submit"><i class="fa fa-save "></i></button>
                            </form>
                          </tr>
                         <? endif;?>
                      <? endforeach;?>
                  <? endif;?>
                  <tr>
                    <form name="newFeeCollection" id="newFeeCollection" action="<?=make_long_url('fees-fees','insertFeeCollection')?>" method="post">
                      <td><input id="fee_collection_type" class="form-control input-sm" type="text" name="fee_collection_type" placeholder="Collection Name" required></td>
                      <td><input id="fee_collection_type_start_date" class="form-control input-sm input-mask-date date-picker" type="text" name="fee_collection_type_start_date" placeholder="Start Date" date-format="dd-mm-yyyy" required></td>
                      <td><input id="fee_collection_type_end_date" class="form-control input-sm input-mask-date" type="text" name="fee_collection_type_end_date" placeholder="End Date" required></td>
                      <td><input id="fee_collection_type_due_date" class="form-control input-sm input-mask-date" type="text" name="fee_collection_type_due_date" placeholder="Due Date" required></td>
                      <td><button class="btn btn-sm btn-green" type="submit" value="Create" name="submit"><i class="fa fa-plus"></i></button>
                    </form>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading"> <i class="fa fa-reorder"></i> Classwise Fees Structure
              <div class="panel-tools"></div>
            </div>
            <div class="panel-body">
				<div class="row alert">
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<label>Configure Class Fees</label>
						<select  class="form-control input-sm" onChange="if(this.value){ window.location.href='<?=make_url('fees-fees','class=')?>'+this.value}else{window.location.href='<?=make_url('fees-fees')?>'}">
											 <option value="">--Select Class--</option>
											 <? foreach($classList as $classListKey=>$classListValue):?>
											  <option value="<?=$classListValue->class_id?>" <?=(isset($class) && $class==$classListValue->class_id)?'selected':'';?> ><?=$classListValue->class_name?></option>
											 <? endforeach;?>
											</select>
					</div>						
				</div>
				<div class="row">					
              		<div class="col-md-12">
					   <? if($class):?>
						
						  <!--edit class start-->
						  <? include('module/fees/include/feeStructure.php');?>
						  <!--edit class end-->
						
					   <? endif;?>
             		</div>
			  </div>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <!-- start: ACCORDION PANEL -->
          <div class="panel panel-default">
            <div class="panel-heading"> <i class="fa fa-reorder"></i> Fees Category
              <div class="panel-tools"> </div>
            </div>
            <div class="panel-body">
              <table class="table table-condensed table-hover" id="feeCategory">
                <thead>
                <form name="newFeeCategory" id="newFeeCategory" action="<?=make_long_url('fees-fees','insertFeeCategory')?>" method="post">
                  <tr>
                    <th ><input id="fee_category" class="form-control input-sm" type="text" name="fee_category" placeholder="New Category" required></th>
                    <th ><button class="btn btn-sm btn-green" type="submit" value="Create" name="submit"><i class="fa fa-plus"></i></button></th>
                  </tr>
                </form>
                </thead>
                
                <tbody>
                  <? if($feeCategoryList):?>
                  <? foreach($feeCategoryList as $feeCategoryKey=>$feeCategoryValue):?>
                  <tr id="feeCategoryList<?=$feeCategoryValue->fee_category_id?>">
                    <td><?=$feeCategoryValue->fee_category?></td>
                    <td><a onClick="editFeeCategory(<?=$feeCategoryValue->fee_category_id?>);" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                  </tr>
                  <tr id="feeCategoryEdit<?=$feeCategoryValue->fee_category_id?>" style="display:none;">
                   <form name="newFeeCategory" id="newFeeCategory" action="<?=make_long_url('fees-fees','updateFeeCategory','list','fee_category_id='.$feeCategoryValue->fee_category_id)?>" method="post">
                    <td ><input id="fee_category" class="form-control input-sm" type="text" name="fee_category" value="<?=$feeCategoryValue->fee_category?>" required></td>
                    <td ><button class="btn btn-primary btn-sm " type="submit" value="Update" name="submit"><i class="fa fa-save"></i></button></td>
                   </form>
                  </tr>
               
                  <? endforeach;?>
                  <? else:?>
                  <tr>
                    <td colspan="2">No Category</td>
                  </tr>
                  <? endif;?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading"> <i class="fa fa-reorder"></i> Fees Waiver Category
              <div class="panel-tools"> </div>
            </div>
            <div class="panel-body">
              <table class="table table-condensed table-hover" id="feeWaiverCategory">
                <thead>
                <form name="newFeeWaiverCategory" id="newFeeWaiverCategory" action="<?=make_long_url('fees-fees','insertFeeWaiverCategory')?>" method="post">
                  <tr>
                    <th ><input id="fee_waiver_category" class="form-control input-sm" type="text" name="fee_waiver_category" placeholder="New Category" required></th>
                    <th ><button class="btn btn-sm btn-green" type="submit" value="Create" name="submit"><i class="fa fa-plus"></i></button></th>
                  </tr>
                </form>
                </thead>
                
                <tbody>
                  <? if($feeWaiverCategoryList):?>
                  <? foreach($feeWaiverCategoryList as $feeWaiverCategoryKey=>$feeWaiverCategoryValue):?>
                  <tr id="feeWaiverCategoryList<?=$feeWaiverCategoryValue->fee_waiver_category_id?>">
                    <td><?=$feeWaiverCategoryValue->fee_waiver_category?></td>
                    <td><a onClick="editFeeWaiverCategory(<?=$feeWaiverCategoryValue->fee_waiver_category_id?>);" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                  </tr>
                  <tr id="feeWaiverCategoryEdit<?=$feeWaiverCategoryValue->fee_waiver_category_id?>" style="display:none;">
                   <form name="updateFeeWaiverCategory" id="updateFeeWaiverCategory" action="<?=make_long_url('fees-fees','updateFeeWaiverCategory','list','fee_waiver_category_id='.$feeWaiverCategoryValue->fee_waiver_category_id)?>" method="post">
                    <td ><input id="fee_waiver_category" class="form-control input-sm" type="text" name="fee_waiver_category" value="<?=$feeWaiverCategoryValue->fee_waiver_category?>" required></td>
                    <td ><button class="btn btn-sm " type="submit" value="Update" name="submit"><i class="fa fa-pencil edit-user-info"></i></button></td>
                   </form>
                  </tr>
               
                  <? endforeach;?>
                  <? else:?>
                  <tr>
                    <td colspan="2">No Category</td>
                  </tr>
                  <? endif;?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading"> <i class="fa fa-reorder"></i> Fine Settings
              <div class="panel-tools"> </div>
            </div>
            <div class="panel-body">
              <table class="table table-condensed ">
                <tbody>
                <? if($feeFineDetails):?>
                  <form name="newFeeCategory" id="newFeeCategory" action="<?=make_long_url('fees-fees','updateFeeFine')?>" method="post">
                  <tr>
				  	<td>Amount</td>
                    <td ><input id="fee_fine_amount" class="form-control input-sm" type="number" name="fee_fine_amount" placeholder="Amount" value="<?=$feeFineDetails->fee_fine_amount?>" required></td>
                  </tr>
                   <tr>
				   <td>Frequency</td>
                    <td >
                    <select  class="form-control input-sm" name="fee_fine_duration" id="fee_fine_duration">
					 <? foreach($feeFineDurationArray as $feeFineDurationKey=>$feeFineDurationValue):?>
                      <option value="<?=$feeFineDurationKey?>" <?=($feeFineDetails && $feeFineDetails->fee_fine_duration==$feeFineDurationKey)?'selected':'';?> ><?=$feeFineDurationValue?></option>
                     <? endforeach;?>
                    </select>
                    </td>
                    
                  </tr>
                   <tr>
				   <td>Max Limit</td>
                    <td ><input id="fee_fine_max" class="form-control input-sm" type="number" name="fee_fine_max" placeholder="Maximum Fine" value="<?=$feeFineDetails->fee_fine_max?>" ></td>
                  </tr>
                  <tr>
                    <td >
                    <input type="hidden" name="fee_fine_id" value="<?=$feeFineDetails->fee_fine_id?>">
                    <button class="btn btn-green" type="submit" value="Update" name="submit">Update</button>
                    </td>
                  </tr>
                </form>
                <? else:?>
                <form name="newFeeCategory" id="newFeeCategory" action="<?=make_long_url('fees-fees','insertFeeFine')?>" method="post">
                  <tr>
                    <td ><input id="fee_fine_amount" class="form-control input-sm" type="number" name="fee_fine_amount" placeholder="Amount" required></td>
                  </tr>
                   <tr>
                    <td >
                    <select  class="form-control input-sm" name="fee_fine_duration" id="fee_fine_duration">
					 <? foreach($feeFineDurationArray as $feeFineDurationKey=>$feeFineDurationValue):?>
                      <option value="<?=$feeFineDurationKey?>" <?=($feeFineDetails && $feeFineDetails->fee_fine_duration==$feeFineDurationKey)?'selected':'';?> ><?=$feeFineDurationValue?></option>
                     <? endforeach;?>
                    </select>
                    </td>
                    
                  </tr>
                  <tr>
                    <td ><button class="btn btn-green" type="submit" value="Save" name="submit">Save</button>
                    </td>
                  </tr>
                </form>
                <? endif;?>
                </tbody>
                
                
              </table>
            </div>
          </div>
        </div>
      </div>
      
      <!-- end: PAGE CONTENT-->
    </div>
  </div>
  <!--End App Container	-->
  <!-- Footer Start-->
  <? include_once(DIR_FS_SITE_INCLUDE.'footer.php'); ?>
  <!-- Footer End-->
</div>
<!-- Main End -->
</body>
</html>
