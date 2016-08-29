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
            <h1>CCE Examination Settings</h1>
          </div>
        </div>
      </div>
      <!-- end: PAGE HEADER -->
	  <div class="row">
        <div class="col-sm-12">
			<div class="panel panel-default">
            <div class="panel-heading"> <i class="fa fa-reorder"></i> Skills Mapping
              <div class="panel-tools"> </div>
            </div>
            <div class="panel-body">
				<h4> Add New Skill Mapping </h4>
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							<label for="form-field-select-1">
								Category
							</label>
							<select id="form-field-select-1" class="form-control">
								<option value="">&nbsp;</option>
								<option value="">Category 1</option>
								
							</select>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label for="form-field-select-1">
								Primary Skill
							</label>
							<select id="form-field-select-1" class="form-control">
								<option value="">&nbsp;</option>
								<option value="">Skill 1</option>
								
							</select>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label for="form-field-select-1">
								Secondary Skill
							</label>
							<input id="fee_category" class="form-control input-sm" type="text" name="fee_category" placeholder="Skill Name" required>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<br>
							<button class="btn btn-sm btn-green" type="submit" value="Create" name="submit"><i class="fa fa-plus"></i> Add Mapping </button>
						</div>
						
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
					  <table class="table" id="feeCategory">
						<thead>
						<form name="newFeeCategory" id="newFeeCategory" action="<?=make_long_url('fees-fees','insertFeeCategory')?>" method="post">
						  <tr>
							<th>#</th>
							<th>
								Category
							</th>
							<th >
								Primary Skill
							</th>
							
							<th >Secondary Skill</th>
							<th></th>
						  </tr>
						</form>
						</thead>
						
						<tbody>
						 
						  <tr id="feeCategoryList<?=$feeCategoryValue->fee_category_id?>">
							<td>Skill-1</td>
							<td>Category 1</td>
							<td>Primary Skill 1</td>
							 <td>Secondary Skill 1</td>
							<td>
							 <a class="btn btn-sm btn-primary"   >Indicators</a>
							 <a class="btn btn-sm btn-primary"   ><i class="fa fa-pencil"></i></a>
							 <a class="btn btn-sm btn-bricky"  ><i class="fa fa-trash-o"></i></a>
							</td>
						  </tr>
						  <tr id="feeCategoryEdit<?=$feeCategoryValue->fee_category_id?>" style="display:none;">
						   <form name="newFeeCategory" id="newFeeCategory" action="<?=make_long_url('fees-fees','updateFeeCategory','list','fee_category_id='.$feeCategoryValue->fee_category_id)?>" method="post">
							<td ><input id="fee_category" class="form-control input-sm" type="text" name="fee_category" value="<?=$feeCategoryValue->fee_category?>" required></td>
							<td ><button class="btn btn-sm " type="submit" value="Update" name="submit"><i class="fa fa-save"></i></button></td>
						   </form>
						  </tr>
					   
						
						</tbody>
					  </table>
					</div>
				</div>	  
            </div>
          </div>
		</div>
      </div>
    
	<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
				
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-10">
						 <h3>	Category - Primary Skill - Secondary Skill
						
						<a class="btn btn-sm btn-primary"   > <i class="fa fa-plus"></i> Add More Indicator</a>
						</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
						  <table class="table" id="feeCategory">
							<thead>
							<form name="newFeeCategory" id="newFeeCategory" action="<?=make_long_url('fees-fees','insertFeeCategory')?>" method="post">
							  <tr>
								
								<th >
									Descriptive Indicator
								</th>
								<th></th>
								
							  </tr>
							</form>
							</thead>
							
							<tbody>
							 
							  <tr id="feeCategoryList<?=$feeCategoryValue->fee_category_id?>">
							
								 <td>Description</td>
								<td>
								
								 <a class="btn btn-sm btn-primary"   ><i class="fa fa-pencil"></i></a>
								 <a class="btn btn-sm btn-bricky"  ><i class="fa fa-trash-o"></i></a>
								</td>
							  </tr>
							  
						   
							
							</tbody>
						  </table>
						</div>
					</div>	  
				</div>
			  </div>
			</div>
		  </div>
	
      <div class="row">
        <div class="col-sm-4">
			<div class="panel panel-default">
            <div class="panel-heading"> <i class="fa fa-reorder"></i> Category
              <div class="panel-tools"> </div>
            </div>
            <div class="panel-body">
              <table class="table" id="feeCategory">
                <thead>
                <form name="newFeeCategory" id="newFeeCategory" action="<?=make_long_url('fees-fees','insertFeeCategory')?>" method="post">
                  <tr>
                    <th ><input id="fee_category" class="form-control input-sm" type="text" name="fee_category" placeholder="New Category" required></th>
					
                    <th ><button class="btn btn-sm btn-green" type="submit" value="Create" name="submit"><i class="fa fa-plus"></i></button></th>
                  </tr>
                </form>
                </thead>
                
                <tbody>
                 
                  <tr >
                    <td>Co-Scholastic Area</td>
                    <td><a class="btn btn-sm btn-primary"   ><i class="fa fa-pencil"></i></a>
					 <a class="btn btn-sm btn-bricky"  ><i class="fa fa-trash-o"></i></a></td>
                  </tr>
				  <tr >
                    <td>Co-Scholastic Activities</td>
                    <td><a class="btn btn-sm btn-primary"   ><i class="fa fa-pencil"></i></a>
					 <a class="btn btn-sm btn-bricky"  ><i class="fa fa-trash-o"></i></a></td>
                  </tr>
                
                
                </tbody>
              </table>
            </div>
          </div>
		</div>
        <div class="col-sm-8">
			<div class="panel panel-default">
            <div class="panel-heading"> <i class="fa fa-reorder"></i> Primary Skill
              <div class="panel-tools"> </div>
            </div>
            <div class="panel-body">
              <table class="table" id="feeCategory">
                <thead>
                <form name="newFeeCategory" id="newFeeCategory" action="<?=make_long_url('fees-fees','insertFeeCategory')?>" method="post">
                  <tr>
                    <th ><input id="fee_category" class="form-control input-sm" type="text" name="fee_category" placeholder="Skill Name" required></th>
					<th>
						<div class="form-group">
							<label for="form-field-select-1">
								Range From
							</label>
							<select id="form-field-select-1" class="form-control">
								<option value="">&nbsp;</option>
								<option value="">1</option>
								<option value="">2</option>
								<option value="">3</option>
								<option value="">90</option>
								<option value="">100</option>
							</select>
						</div>
					</th>
					<th>
						<div class="form-group">
							<label for="form-field-select-1">
								Range To
							</label>
							<select id="form-field-select-1" class="form-control">
								<option value="">&nbsp;</option>
								<option value="">1</option>
								<option value="">2</option>
								<option value="">3</option>
								<option value="">90</option>
								<option value="">100</option>
							</select>
						</div>
					</th>
					
					<th>
						<div class="form-group">
							<label for="form-field-select-1">
								Grade
							</label>
							<select id="form-field-select-1" class="form-control">
								<option value="">&nbsp;</option>
								<option value="">A</option>
								<option value="">B</option>
								<option value="">C</option>
								<option value="">D</option>
								<option value="">A1</option>
								<option value="">B1</option>
								<option value="">C1</option>
								<option value="">D1</option>
								<option value="">A+</option>
								<option value="">B+</option>
								<option value="">C+</option>
								<option value="">D+</option>
							</select>
						</div>
					</th>
					<th>
						<div class="form-group">
							<label for="form-field-select-1">
								Grade Point
							</label>
							<select id="form-field-select-1" class="form-control">
								<option value="">&nbsp;</option>
								<option value="">1</option>
								<option value="">2</option>
								<option value="">3</option>
								<option value="">9</option>
								<option value="">10</option>
							</select>
						</div>
					</th>
                    <th ><button class="btn btn-sm btn-green" type="submit" value="Create" name="submit"><i class="fa fa-plus"></i></button></th>
                  </tr>
                </form>
                </thead>
                
                <tbody>
                 
                  <tr id="feeCategoryList<?=$feeCategoryValue->fee_category_id?>">
                    <td>Skill 1</td>
					<td>90</td>
					<td>100</td>
					<td>10</td>
					<td>A+</td>
					
                   <td><a class="btn btn-sm btn-primary"   ><i class="fa fa-pencil"></i></a>
					 <a class="btn btn-sm btn-bricky"  ><i class="fa fa-trash-o"></i></a></td>
                  </tr>
                  <tr id="feeCategoryEdit<?=$feeCategoryValue->fee_category_id?>" style="display:none;">
                   <form name="newFeeCategory" id="newFeeCategory" action="<?=make_long_url('fees-fees','updateFeeCategory','list','fee_category_id='.$feeCategoryValue->fee_category_id)?>" method="post">
                    <td ><input id="fee_category" class="form-control input-sm" type="text" name="fee_category" value="<?=$feeCategoryValue->fee_category?>" required></td>
                    <td ><button class="btn btn-sm " type="submit" value="Update" name="submit"><i class="fa fa-save"></i></button></td>
                   </form>
                  </tr>
               
                
                </tbody>
              </table>
            </div>
          </div>
		</div>
		
      </div>
      
	  
  
  
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
