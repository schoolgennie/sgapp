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
			$("#frmRole").validate();
			});
		</script>
<script>
			jQuery(document).ready(function() {
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
<script>
          function editRoleToggle(id)
			{
			 $("#roleShow"+id).toggle();
			 $("#roleEdit"+id).toggle();
			}
        </script>
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
          <div class="page-header">
            <h1>User Permissions on Modules</h1>
          </div>
        </div>
      </div>
      <!-- end: PAGE HEADER -->
      <!-- start: PAGE CONTENT -->
      <div class="row">
        <div class="panel-body">
          <div class="col-sm-12"> <a data-toggle="modal" class="btn btn-primary" role="button" href="#newTest"> New Faculty Type &nbsp;<i class="fa fa-plus-circle" ></i> </a> </div>
        </div>
      </div>
      <div id="newTest" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
          <h4 class="modal-title">Create Faculty Type </h4>
        </div>
        <form id="frmRole" action="<?=make_url('administration-role');?>" method="post" name="frmRole" >
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Faculty Type <span class="symbol required"></span> </label>
                  <input name="faculty_designation" id="faculty_designation"  class="form-control" type="text" placeholder="" required>
                </div>
              </div>
            </div>
            <div class="row">
              <? foreach($schoolModuleArray as $k=>$v):?>
              <div class="col-md-4">
                <label class="checkbox-inline">
                <input type="checkbox" class="flat-green" value="<?=(is_array($v))?implode(',',$v):$v;?>" name="faculty_designation_access_module[]" >
                <?=ucwords($k)?>
                </label>
              </div>
              <? endforeach;?>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-light-grey"> Cancel </button>
            <input type="submit" name="submit" class="btn btn-blue" value="Create">
          </div>
        </form>
      </div>
      <div class="row">
        <? if($designationList):?>
        <? foreach($designationList as $k=>$v):?>
        <div class="col-md-6" id="roleShow<?=$v->faculty_designation_id?>">
          <div class="panel panel-default">
            <div class="panel-heading"> <i class="clip-users-2"></i> User Type (<?=$v->faculty_designation_id?>) -
              <?=ucfirst($v->faculty_designation)?>
              <div class="panel-tools"> </div>
            </div>
            <div class="panel-body">
              <div class="row">
                <? $facultyDesignationAccessModule=explode(',',$v->faculty_designation_access_module);?>
                <? foreach((($v->faculty_designation=='students')?$studentModuleArray:$schoolModuleArray) as $kk=>$vv):?>
                <div class="col-md-4">
				
				
                  <label class="checkbox-inline">
                  <input type="checkbox" class="flat-green" name="faculty_designation_access_module[]" value="<?=is_array($vv)?implode(',',$vv):$vv;?>" <?=(count(array_intersect((is_array($vv))?$vv:explode(',',$vv),$facultyDesignationAccessModule))>0)?'checked disabled> <span class="label label-success">'.ucwords($kk).'</span>':'disabled>'.ucwords($kk);?> 
                  
                  </label>
				  
                </div>
                <? endforeach;?>
              </div>
              <div class="row">
                <div class="col-md-12" align="center">
                  <button class="btn btn-default" type="button" onClick="editRoleToggle('<?=$v->faculty_designation_id?>')"> Edit <i class="fa fa-edit"></i> </button>
                  <? if(!array_key_exists($v->faculty_designation,$defaultDesignationArray)):?>
                  <? if(get_object_by_query_count('faculty','faculty_designation="'.$v->faculty_designation_id.'"')>0):?>
                  <button class="btn btn-bricky" type="button" onClick="alert('this designation is assigned to a faculty');"> Delete <i class="fa fa-trash-o"></i> </button>
                  <? else:?>
                  <button class="btn btn-bricky" type="button" onClick="if(confirm('Are You sure? you want to delete this role'))window.location='<?=make_url('administration-role','sta=delete&faculty_designation_id='.$v->faculty_designation_id)?>';return false"> Delete <i class="fa fa-trash-o"></i> </button>
                  <? endif;?>
                  <? endif;?>
                </div>
              </div>
            </div>
          </div>
          <!-- end: TABLE WITH IMAGES PANEL -->
        </div>
        <div class="col-md-6" id="roleEdit<?=$v->faculty_designation_id?>" style="display:none">
          <form id="frmRole<?=$v->faculty_designation_id?>" action="<?=make_url('administration-role');?>" method="post" name="frmRole<?=$v->faculty_designation_id?>" >
            <div class="panel panel-default">
              <div class="panel-heading"> <i class="clip-users-2"></i> User Type -
                <?=$v->faculty_designation?>
                <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> <a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-resize-full"></i> </a> <a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a> </div>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <h2>User Type </h2>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <h2>
                        <? if(array_key_exists($v->faculty_designation,$defaultDesignationArray)):?>
                        <?=ucfirst($v->faculty_designation)?>
                        <? else:?>
                        <input name="faculty_designation" id="faculty_designation"  value="<?=$v->faculty_designation?>" class="form-control" type="text" placeholder="Role" required>
                        <? endif;?>
                      </h2>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <? $facultyDesignationAccessModule=explode(',',$v->faculty_designation_access_module);?>
                  <? foreach((($v->faculty_designation=='students')?$studentModuleArray:$schoolModuleArray) as $kk=>$vv):?>
                  <div class="col-md-4">
                    <label class="checkbox-inline">
                    <input type="checkbox" class="flat-green" name="faculty_designation_access_module[]" value="<?=is_array($vv)?implode(',',$vv):$vv;?>" <?=(count(array_intersect((is_array($vv))?$vv:explode(',',$vv),$facultyDesignationAccessModule))>0)?'checked':'';?> >
                    <?=ucwords($kk)?>
                    </label>
                  </div>
                  <? endforeach;?>
                </div>
                <div class="row">
                  <div class="col-md-12" align="center">
                    <input type="hidden" name="faculty_designation_id" value="<?=$v->faculty_designation_id?>">
                    <button type="button" data-dismiss="modal" class="btn btn-light-grey" onClick="editRoleToggle('<?=$v->faculty_designation_id?>')">Cancel</button>
                    <input class="btn btn-success" type="submit" name="submit" value="Apply">
                  </div>
                </div>
              </div>
            </div>
          </form>
          <!-- end: TABLE WITH IMAGES PANEL -->
        </div>
        <? endforeach;?>
        <? endif;?>
      </div>
      <!-- end: PAGE CONTENT-->
    </div>
  </div>
  <!-- Footer Start-->
  <? include_once(DIR_FS_SITE_INCLUDE.'footer.php'); ?>
  <!-- Footer End-->
</div>
<!-- Main End -->
</body>
</html>
