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
            <div class="panel-heading"> <i class="fa fa-reorder"></i> Descriptive Indicators
              <div class="panel-tools"> </div>
            </div>
            <div class="panel-body">
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
							<select id="form-field-select-1" class="form-control">
								<option value="">&nbsp;</option>
								<option value="">Skill 1</option>
								
							</select>
						</div>
					</div>
				</div>
				<div class="row">
        			<div class="col-sm-12">
					  <table class="table" id="feeCategory">
						<thead>
						<form name="newFeeCategory" id="newFeeCategory" action="<?=make_long_url('fees-fees','insertFeeCategory')?>" method="post">
						  <tr>
							<th>
								Category
							</th>
							<th>
								Primary Skill
							</th>
							<th >
								Secondary Skill
							</th>
							<th >
								Descriptive Indicator
							</th>
							<th></th>
							
						  </tr>
						</form>
						</thead>
						
						<tbody>
						 
						  <tr id="feeCategoryList<?=$feeCategoryValue->fee_category_id?>">
							<td>Category 1</td>
							<td>Primary Skill 1</td>
							 <td>Secondary Skill 1</td>
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
