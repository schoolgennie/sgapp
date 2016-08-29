<!DOCTYPE html >
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>School Gennie</title>
<? include_once(DIR_FS_SITE_INCLUDE.'cssJavascript.php'); ?>
<script>
jQ172(document).ready(function(){
  jQ172("#frmNotice").validationEngine();
});
</script>
<script>

function addNoticeToggle()
{
$(".add-notice").toggle();

}

function noticeContainer(id,val)
{
$("#noticeContainer"+id+" "+val).toggle();
}

function noticeContainerEdit(id)
{
$("#noticeContainer"+id).toggle();
$("#noticeContainerEdit"+id).toggle();
}

function editNotice(id)
{
var sendEmail=$("#noticeContainerEdit"+id+" #sendEmail").is(':checked') ? 1 : 0;
var sendSms=$("#noticeContainerEdit"+id+" #sendSms").is(':checked') ? 1 : 0;
var notice=$("#noticeContainerEdit"+id+" #notice").val();
 if(sendSms==1)
  {
   if(confirm("Are you sure? You have selected 'Send SMS' option. This will consume your balance SMS quota"))
	{
	$.ajax({
	
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=noticeboard-noticeboardajax",
		data:"mode=editNotice&noticeboard_id="+id+"&notice="+notice+"&sendEmail="+sendEmail+"&sendSms="+sendSms,
		
		success: function(output)
		 { 
		 
			   $( "#noticeContainer"+id+" div.notice-details").html(notice);
			   noticeContainerEdit(id);
			   //$( "#noticeContainerEdit"+id).remove();
			
		}   
	});
	}
  }	
  else
  {
  $.ajax({
	
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=noticeboard-noticeboardajax",
		data:"mode=editNotice&noticeboard_id="+id+"&notice="+notice+"&sendEmail="+sendEmail+"&sendSms="+sendSms,
		
		success: function(output)
		 { 
		  $( "#noticeContainer"+id+" div.notice-details").html(notice);
		  noticeContainerEdit(id);
			
		}   
	});
  }
}

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
		 
			   $( "#noticeContainer"+id).remove();
			   $( "#noticeContainerEdit"+id).remove();
			
		}   
	});
	}
 
}



function noticeToggle(id){

	var currentstatus=$('#slidingDiv'+id).css('display');
	jQuery(".slidingDiv").hide();
	$(".detail").html('<img src="images/plus.png"  />'); 
	$(".middle-list-toggle").removeClass("active");
    $("#slidingDiv"+id).toggle();
	$("#noticeDetails"+id+" span.detail").html('<img src="images/minus.png"  />');  
	$("#noticeDetails"+id).addClass("active");
	if(currentstatus=='block')
	{
	   $("#slidingDiv"+id).hide();
	   $("#noticeDetails"+id+" span.detail").html('<img src="images/plus.png"  />'); 
	  $("#noticeDetails"+id).removeClass("active");
	}
	
  
};


function downloadFile(name)
{

		
	      window.location.href='<?=DIR_WS_SITE?>upload/photo/noticeBoard/'+name;


}
</script>
<link rel="stylesheet" type="text/css" href="jqueryScripts/tabs/css/tabs_container.css" />
<!-- autoload js -->
<script type="text/javascript" src="jqueryScripts/autoload/js/jquery-1.9.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	var track_load = 1; //total loaded record group(s)
	var loading  = false; //to prevents multipal ajax loads
	var total_groups = <?=isset($noticeList->TotalPages)?$noticeList->TotalPages:1; ?>; //total record group(s)
	//alert(total_groups);
	$('#middle-list').load("<?=DIR_WS_SITE?>?page=noticeboard-noticeboardajax", {'p':track_load,'mode':'noticeList'}, function() {track_load++;}); //load first group
	
	$(window).scroll(function() { //detect page scroll
		
		if($(window).scrollTop() + $(window).height() == $(document).height())   //user scrolled to bottom of the page?
		{
				
			if(track_load <= total_groups && loading==false) //there's more data to load
			{
				loading = true; //prevent further ajax loading
				$('.animation_image').show(); //show loading image
				
				//load data from the server using a HTTP POST request
				$.post("<?=DIR_WS_SITE?>?page=noticeboard-noticeboardajax",{'p':track_load,'mode':'noticeList'}, function(data){
								
					$("#middle-list").append(data); //append received data into the element

					//hide loading image
					$('.animation_image').hide(); //hide loading image once data is received
					
					track_load++; //loaded group increment
					loading = false; 
				
				}).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
					
					alert(thrownError); //alert with HTTP error
					$('.animation_image').hide(); //hide loading image
					loading = false;
				
				});
				
			}
		}
	});
});
</script>
<!-- autoload js  -->
<script>

</script>
</head>
<body>
<!-- Header Start-->
<? include_once(DIR_FS_SITE_INCLUDE.'header.php'); ?>
<!-- Header End-->
<!--Navigation Start -->
<? include_once(DIR_FS_SITE_INCLUDE.$login_session->get_usertype().'Nav.php'); ?>
<!--Navigation End -->
<!-- Main Start-->
<div id="main-wrapper">
	<!--App Controls Start-->
	<!--App Controls End-->
	<!--Start App Container	-->
	<div class="app-container" >
		<? if($login_session->get_usertype()==$userTypeArray[0]): ?>
		<form id="frmNotice" action="<?=make_long_url('noticeboard-noticeboard', 'insert', 'list');?>" method="post" name="frmNotice" enctype="multipart/form-data">
			<div class="add-notice-container">
				<input class="medium-button" type="button" value="New Notice" onClick="addNoticeToggle()">
				<div class="add-notice" style="display:none">
					<div class="row">
						<div class="12u">
							<label for="" >Title </label>
							<input style="width:90%; float:right" type="text" class="validate[required,maxSize[145]] textbox" name="notice_title" maxlength="145">
						</div>
					</div>
					<div class="row">
						<div class="12u">
							<label for="" >Description</label>
							<textarea style="width:90%; float:right" class="validate[required] " rows="6" cols="30" name="notice" ></textarea>
						</div>
					</div>
					<div class="row">
						<div class="1u"></div>
						<div class="4u">
							<ul style="display:inline-block">
								<li style="float:left; margin:0 15px 0 10px;">
									<label for="" >Send Sms</label>
									<input type="checkbox" value="1" name="sendSms">
								</li>
								<li style="float:right">
									<label for="" >Send Email</label>
									<input type="checkbox" value="1"  name="sendEmail">
								</li>
							</ul>
						</div>
						<div class="2u">
							<input class="medium-button" type="submit" name="submit"  value="Submit" >
						</div>
						<div class="5u">
							<label for="" >Attachment</label>
							<input type="file" value="Browse" class="" name="notice_attachment">
						</div>
					</div>
				</div>
			</div>
		</form>
		<? endif;?>
		<? if($noticeList->GetNumRows()>0):
			 while($noticeListing=$noticeList->GetObjectFromRecord()): 
			 ?>
		<!--show notice detail start-->
		<div class="notice-container" id="noticeContainer<?=$noticeListing->noticeboard_id?>">
			<div class="notice-header">
				<div class="row">
					<div class="1u date">
						<?=ToIndianDate($noticeListing->notice_date) ?>
					</div>
					<div class="9u" onClick="noticeContainer('<?=$noticeListing->noticeboard_id?>','div.notice-details')">
						<?=$noticeListing->notice_title ?>
					</div>
					<div class="2u notice-controls">
						<ul >
							<? if($login_session->get_usertype()==$userTypeArray[0]): ?>
							<li>
								<div class="delete-button" onClick="deleteNotice('<?=$noticeListing->noticeboard_id?>')"></div>
							</li>
							<li>
								<div class="light-button" onClick="noticeContainerEdit('<?=$noticeListing->noticeboard_id?>')">Edit</div>
							</li>
							<? endif;?>
							<? if($noticeListing->notice_attachment):?>
							<li>
								<div class="attachment" onClick="downloadFile('<?=$noticeListing->notice_attachment?>')"></div>
							</li>
							<? endif;?>
						</ul>
					</div>
				</div>
			</div>
			<div class="notice-details" style="display:none;">
				<p>
					<?=html_entity_decode($noticeListing->notice) ?>
				</p>
			</div>
		</div>
		<!--show notice detail end-->
		<? if($login_session->get_usertype()==$userTypeArray[0]): ?>
		<!--edit notice detail start-->
		<div class="notice-container" id="noticeContainerEdit<?=$noticeListing->noticeboard_id?>" style="display:none">
			<div class="notice-header">
				<div class="row">
					<div class="1u date">
						<?=ToIndianDate($noticeListing->notice_date)  ?>
					</div>
					<div class="7u">
						<?=$noticeListing->notice_title ?>
					</div>
					<div class="4u notice-controls">
						<ul >
							<li>
								<div class="light-button" onClick="noticeContainerEdit('<?=$noticeListing->noticeboard_id?>')">Cancel</div>
							</li>
							<li>
								<div class="light-button" onClick="editNotice('<?=$noticeListing->noticeboard_id?>')">Save</div>
							</li>
							<li>
								<div class="attachment">
									<input type="file" name="notice_attachment" style="display:none">
								</div>
							</li>
							<li> Email
								<input type="checkbox" value="1" name="sendEmail" id="sendEmail">
							</li>
							<li> Sms
								<input type="checkbox" value="1" name="sendSms" id="sendSms">
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="notice-details">
				<textarea style="width:100%;" class="validate[required] " rows="6" cols="30" id="notice" name="notice"><?=html_entity_decode($noticeListing->notice) ?>
</textarea>
			</div>
		</div>
		<!--edit notice detail end-->
		<? endif;?>
		<? endwhile;?>
		<? endif;?>
	</div>
	<!-- Header End-->
	<!-- Footer Start-->
	<? include_once(DIR_FS_SITE_INCLUDE.'footer.php'); ?>
	<!-- Footer End-->
</div>
</body>
</html>
