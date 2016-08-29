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

<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="design/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
<script src="design/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
<script src="design/js/ui-modals.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script>
			jQuery(document).ready(function() {
			    $("#createNewNotice").validate();
			    Index.init();
				UIModals.init();
			});
</script>
		
<!--delete notice start-->
<script>	
function deleteNotice(id)
{
 if(confirm("Are you sure? You want to  delete this Notice...!"))
	{
		$.ajax({
			type: "POST",
			url: "<?=DIR_WS_SITE?>?page=noticeboard-noticeboardajax",
			data:"mode=deleteNotice&noticeboard_id="+id,
			success: function(output)
			 { 
				 location.reload();
			 }   
		});
	}
}

function composeNoticeToggle()
{
   $("#composeNotice").toggle();
}
</script>
<!--delete notice end-->
</head>
<body>
<!-- Header Start-->
<? include_once(DIR_FS_SITE_INCLUDE.'header.php'); ?>
<!-- Header End-->
<!-- start: MAIN CONTAINER -->
<div class="main-container">
  <!--Navigation Start -->
  <? include_once(DIR_FS_SITE_INCLUDE.$login_session->get_usertype().'Nav.php'); ?>
  <!--Navigation End -->
  <div class="main-content">
    <?php display_form_error();?>
    <div class="container">
      <!-- start: PAGE HEADER -->
      <div class="row">
        <div class="col-sm-12">
          <div class="page-header">
            <h1>Notice Board<small> </small></h1>
          </div>
        </div>
      </div>
      <!-- end: PAGE HEADER -->
      <!-- start: PAGE CONTENT -->
      <?  #handle sections here.
		 switch ($section):
		 case 'list':
					
	  ?>
      <? if($login_session->get_usertype()==$userTypeArray[0]): ?>
      <div class="row">
        <div class="panel-body">
          <div class="col-sm-6"> <a  data-toggle="modal" class="btn btn-primary" onClick="composeNoticeToggle();"><i class="fa  fa-plus-circle "></i> &nbsp;New Notice </a> </div>
        </div>
      </div>
	  <div class="row" style="display: none;" id="composeNotice">
	  	<div class="col-sm-12">
			 <div class="panel panel-default">
            	<div class="panel-body">
					 <h4 >Create Notice </h4>
					  <form id="createNewNotice" action="<?=make_long_url('noticeboard-noticeboard', 'insert', 'list');?>" method="post" name="createNewNotice" enctype="multipart/form-data">
						 
							<div class="row">
							  <div class="col-md-3">
							  	<div class="form-group">
								  <label>Recipient <span class="symbol required"></span> </label>
								  	<select id="senderType" class="form-control" name="senderType">
										<option value="">All School Users</option>
										<option value="faculty">All Faculty</option>
										<option value="parents">All Parents</option>
                                        <? foreach($classList as $k=>$v):?>
										<option value="<?=$v->class_id?>"><?='Class '.$v->class_name?></option>
										<? endforeach;?>
									</select>		
								</div>
							  </div>
							  <div class="col-md-9">
								<div class="form-group">
								  <label>Subject <span class="symbol required"></span> <i>(Only subject will be sent as SMS)</i></label>
								  <input name="notice_title" id="notice_title"  class="form-control" type="text" placeholder="Subject limit 150 characters"  required>
								</div>
							  </div>
							</div>
							<div class="row">
							  <div class="col-md-12">
								<div class="form-group">
								  <label>Detailed Notice <span class="symbol required"></span></label>
								  <textarea  class="autosize form-control" placeholder="" name="notice" id="notice" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 200px;" required></textarea>
								  
								</div>
							  </div>
							</div>
							<div class="row">
							  <div class="col-md-12">
								<div class="form-group">
								  <label>Attachment</span></label>
								  <input type="file" value="Browse" class="" name="notice_attachment">
								</div>
							  </div>
							</div>
						
						  <div class="row" align="center">
						   <div class="col-sm-12">
							<label class="checkbox-inline">
							<input type="checkbox" class="flat-teal" id="sendSms" name="sendSms" value="1" <?=($smsCount==0)?'disabled':'';?>>
							<?=($smsCount==0)?'SMS Not Available':'Send SMS';?> </label>
							<label class="checkbox-inline">
							<input type="checkbox" class="flat-teal" name="sendEmail" id="sendEmail" value="1"  checked="checked">
							Send Email </label>
							<button type="submit"  class="btn btn-blue" name="submit" value="Submit"> Submit </button>
							<button type="button" data-dismiss="modal" class="btn btn-light-grey"> Cancel </button>
							
						   </div>
						  </div>
						</form>
				</div>
	  		</div>		
	  	</div>
	  </div>
      <div id="composeNotice1" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
          <h4 class="modal-title">Create Notice </h4>
        </div>
        <form id="createNewNotice" action="<?=make_long_url('noticeboard-noticeboard', 'insert', 'list');?>" method="post" name="createNewNotice" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Subject <span class="symbol required"></span> <i>(Only subject will be sent as SMS)</i></label>
                  <input name="notice_title" id="notice_title"  class="form-control" type="text" placeholder="Subject limit 160 characters" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Detailed Notice <span class="symbol required"></span></label>
                  <textarea class="form-control" placeholder="Notice Details" name="notice" id="notice" required></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Attachment</span></label>
                  <input type="file" value="Browse" class="" name="notice_attachment">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <label class="checkbox-inline">
            <input type="checkbox" class="flat-teal" id="sendSms" name="sendSms" value="1">
            Send SMS </label>
            <label class="checkbox-inline">
            <input type="checkbox" class="flat-teal" name="sendEmail" id="sendEmail" value="1"  checked="checked">
            Send Email </label>
            <button type="button" data-dismiss="modal" class="btn btn-light-grey"> Cancel </button>
            <button type="submit"  class="btn btn-blue" name="submit" value="Submit"> Submit </button>
          </div>
        </form>
      </div>
      <? endif;?>
      <div class="row">
        <div class="col-sm-12">
          <!-- start: ACCORDION PANEL -->
          <div class="">
            <div class="">
              <div class="panel-group accordion-custom notice-board" id="accordion">
                <div class="row">
                  <? if($noticeList):?>
                  <? foreach($noticeList as $k=>$v):?>
                  <div class="col-sm-6" style="margin-top:5px; height:220px;">
                    <div class="panel panel-default">
                      
                      <div id="collapse<?=$v->noticeboard_id?>" class="panel-collapse collapse in">
                        <div class="panel-body">
							 <div class="row">
							 	 <div class="col-sm-6">
									<i class="text-muted"><?=ToIndianDate($v->notice_date) ?></i>
								 </div>	
								
								<div class="col-sm-6" align="right">
								 <? if($v->notice_attachment):?>
									<a class="btn btn-sm btn-default" href="<?=make_long_url('noticeboard-noticeboard','download','download','file='.$v->notice_attachment)?>"> <i class="clip-attachment"> Download </i> </a>
								  <? endif;?>
								   <? if($login_session->get_usertype()==$userTypeArray[0]): ?>
								  <button class="btn btn-sm btn-bricky"  type="button" onClick="deleteNotice(<?=$v->noticeboard_id?>)">  <i class="fa fa-trash-o"></i> </button>
								  <? endif;?>
								</div>
							</div>	
							<p class="lead"><?=limitText($v->notice_title,40); ?></p>
                          <p>
                            <?=limitText(html_entity_decode($v->notice),200); ?>
                          </p>
                          <a class="btn btn-link" href="<?=make_long_url('noticeboard-noticeboard','detail','detail','noticeboard_id='.$v->noticeboard_id)?>"> More Details </a>
                         
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <? endforeach;?>
                  <? else:?>
                  <div class="col-sm-4" style="margin-top:5px;">No Notice.</div>
                  <? endif;?>
                </div>
              </div>
            </div>
          </div>
          <!-- end: ACCORDION PANEL -->
        </div>
      </div>
      <?
	   break;
	   case 'detail':
	   #html code here.
	   ?>
      
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            
            <div class="panel-body">
			<p class="text-muted">  <?=ToIndianDate($noticeDetail->notice_date) ?> 
				  <? if($noticeDetail->notice_attachment):?>
				<a class="btn btn-sm btn-default" href="<?=make_long_url('noticeboard-noticeboard','download','download','file='.$noticeDetail->notice_attachment)?>"> <i class="clip-attachment"> Download </i> </a>
				 <? endif;?>
			</p>
			<p class="lead"><?=$noticeDetail->notice_title; ?></p>
              <div class="">
                <p class="text-info big">
                  <?=html_entity_decode($noticeDetail->notice); ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <? 
	   break;
	   default:break;
	   endswitch;
	   ?>
    </div>
  </div>
  <!-- Footer Start-->
  <? include_once(DIR_FS_SITE_INCLUDE.'footer.php'); ?>
  <!-- Footer End-->
</div>
<!-- Main End -->
</body>
</html>
