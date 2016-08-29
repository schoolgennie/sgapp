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
function activateDeactivateSubject(id,status)
{
  	$.ajax({
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=administration-subjectajax",
		data:"mode=activeDeativeSubject&subject_id="+id+"&subject_is_active="+status,
		success: function(output)
		 {
		       location.reload();
		}   
	});
}

function editsubject(id)
{

   var subject_name=$("#editSubject"+id+" #subject_name").val();
   if(subject_name=="")
   {
   $("#editSubjectForm"+id+" div.alert").toggle();
   $("#editSubjectForm"+id+" div.alert").delay(2500).fadeOut();
   return false;
   }
  	$.ajax({
	
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=administration-subjectajax",
		data:"mode=editsubject&subject_id="+id+"&subject_name="+subject_name,
		
		success: function(output)
		 {
		         location.reload();
		}   
	});
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
          </div>
        </div>
      </div>
      <!-- end: PAGE HEADER -->
      <!-- start: PAGE CONTENT -->
      <div class="row">
        <div class="panel-body">
          <div class="col-sm-6"> <a href="#compose" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus-circle  "></i> &nbsp;New Subject </a> </div>
        </div>
      </div>
      <div id="compose" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
          <h4 class="modal-title">Create New Subject </h4>
        </div>
        <form id="newSubjectForm" action="<?=make_long_url('administration-subject', 'insert', 'list');?>" method="post" name="commentForm" >
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Subject <span class="symbol required"></span></label>
                  <input name="subject_name" id="subject_name"  class="form-control" type="text" placeholder="Subject" required>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-light-grey"> Cancel </button>
            <input type="submit" name="submit" class="btn btn-blue" value="Create">
          </div>
        </form>
      </div>
      <div class="row">
        <div class="col-md-12">
          <!-- start: TABLE WITH IMAGES PANEL -->
          <div class="panel panel-default">
            <div class="panel-heading"> <i class=""></i> Subject List
              <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> <a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-resize-full"></i> </a> <a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a> </div>
            </div>
            <div class="panel-body">
              <table class="table table-striped  table-hover" >
                <thead>
                  <tr>
                    <th>Subject</th>
                    <th> Status</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <? if($subjectList->GetNumRows()>0):?>
                  <?  while($subjectListing=$subjectList->GetObjectFromRecord()):?>
                  <tr>
                    <td><h4>
                        <?=html_entity_decode($subjectListing->subject_name);?>
                      </h4></td>
                    <td><? if($subjectListing->subject_is_active==1):?>
                      <span class="label label-success ">Active</span>
                      <? else:?>
                      <span class="label label-inverse ">Inactive</span>
                      <? endif;?>
                    </td>
                    <td class="center"><div class=""> <a href="#editSubject<?=$subjectListing->subject_id?>" data-toggle="modal" class="btn btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                        <? if($subjectListing->subject_is_active==1):?>
                        <a onClick="activateDeactivateSubject('<?=$subjectListing->subject_id?>',0)" class="btn btn-bricky tooltips" data-placement="top" data-original-title="Deactivate"><i class="fa fa-ban fa fa-white"></i></a>
                        <? else:?>
                        <a onClick="activateDeactivateSubject('<?=$subjectListing->subject_id?>',1)" class="btn btn-green tooltips" data-placement="top" data-original-title="activate"><i class="fa fa-check fa fa-white"></i></a>
                        <? endif;?>
                      </div>
                      <div id="editSubject<?=$subjectListing->subject_id?>" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                          <h4 class="modal-title">Update Subject </h4>
                        </div>
                      
                        <form id="editSubjectForm<?=$subjectListing->subject_id?>">
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Subject </label>
                                  <span class="symbol required"></span>
                                  <input name="subject_name" value="<?=$subjectListing->subject_name?>" id="subject_name"  class="form-control" type="text" placeholder="Subject" required>
                                </div>
                                <div class="alert alert-danger" style="display:none">Please enter subject name</div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-light-grey"> Cancel </button>
                            <input type="button" name="submit" class="btn btn-blue" value="Save" onClick="editsubject(<?=$subjectListing->subject_id?>)">
                          </div>
                        </form>
                      </div></td>
                  </tr>
                  <? endwhile;?>
                  <? else:?>
                  <tr>
                    <td colspan="3">No Subject.</td>
                  </tr>
                  <? endif;?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- end: TABLE WITH IMAGES PANEL -->
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
</body>
</html>
