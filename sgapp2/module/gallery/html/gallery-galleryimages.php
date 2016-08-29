<!DOCTYPE html>
<html>
<head>
<? include_once(DIR_FS_SITE_INCLUDE.'meta.php'); ?>
<title>School Gennie</title>
<? include_once(DIR_FS_SITE_INCLUDE.'css.php'); ?>
<? include_once(DIR_FS_SITE_INCLUDE.'javascript.php'); ?>
<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
<link rel="stylesheet" href="design/plugins/colorbox/example2/colorbox.css">
<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="design/plugins/colorbox/jquery.colorbox-min.js"></script>
<script src="design/js/pages-gallery.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script>
	jQuery(document).ready(function() {
		PagesGallery.init();
	});
</script>
<script>
<!--start: TO ADD OR EDIT CAPTION VALUE-->
function editCaptionValue(album_image_caption,album_image_id)
{
$.ajax({
		type: "GET",
		url: "<?=DIR_WS_SITE?>?page=gallery-galleryajax",
		data:"mode=editCaptionValue&album_image_id="+album_image_id+"&album_image_caption="+album_image_caption,
		success: function(output)
		 { 
		 location.reload();
		 }   
	});
}
<!--END: TO ADD OR EDIT CAPTION VALUE-->
<!--start: CAPTION TOGGLE-->
function editCaptionToggle(album_image_id)
{
	$("#imageBox"+album_image_id+" #imageCaptionVal").toggle();
	$("#imageBox"+album_image_id+" #album_image_caption").toggle();
}
<!--END: CAPTION TOGGLE-->
<!--start: TO DELETE IMAGE-->
function deleteImage(id)
{
  if(confirm("Are you sure? You want to  delete this image...!"))
	{
		$.ajax({
			type: "GET",
			url: "<?=DIR_WS_SITE?>?page=gallery-galleryajax",
			data:"mode=deleteImage&album_image_id="+id,
			success: function(output)
			 { 
			   if(output==1)
			   {
				   location.reload();
				}
			}   
		});
	}
}
<!--end: TO DELETE IMAGE-->
</script>
<!-- image upload jquery-->
<script type="text/javascript" src="design/js/imageUploadJquery/ajaxupload.3.5.js"></script>
<script type="text/javascript" >
$(function(){
	var btnUpload=$('#me');
	new AjaxUpload(btnUpload, {
		action:"<?=DIR_WS_SITE?>?page=gallery-galleryajax&mode=uploadNewImage&album_id=<?=$album_id?>",
		name: 'album_image',
		onComplete: function(file, response){
		location.reload();
		}
	});
});
</script>
<!-- image upload jquery-->
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
            <h2>Gallery</h2>
          </div>
        </div>
      </div>
      <!-- end: PAGE HEADER -->
      <!-- start: PAGE CONTENT -->
      <div class="panel-body"> <a class="btn btn-default" onClick="window.location.href='<?=make_long_url('gallery-gallery')?>'"> <i class="fa fa-arrow-left "></i> Back </a> </div>
      <? if(albumImages):?>
      <? if($login_session->get_usertype()==$userTypeArray[0]):?>
      <form name="editAlbumForm" action="<?=make_url('gallery-galleryimages','id='.$album_id)?>" method="post" id="editAlbumForm" enctype="multipart/form-data">
        <div class="alert alert-info">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Album Name<span class="symbol required"></span></label>
                <input id="album_name" name="album_name"  class="form-control" type="text" placeholder="Album Name" value="<?=$albumDetails->album_name?>" required>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Album Description</label>
                <textarea name="album_description" id="album_description"  class="form-control" placeholder="Album Description"><?=$albumDetails->album_description?>
</textarea>
              </div>
            </div>
            <div class="col-md-2"> <br>
              <button type="submit" name="submit" value="Update" class="btn btn-blue"> Save </button>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="alert alert-warning">
              <div class="form-group" id="userList"> <strong>Upload Image </strong>
                <input type="file"  id="me">
              </div>
            </div>
          </div>
        </div>
      </form>
      <? endif;?>
      <? foreach($albumImages as $k=>$v):?>
      <div class="col-md-3 col-sm-4 gallery-img" id="imageBox<?=$v->album_image_id?>">
        <div class="wrap-image"> <a class="group1" href="<?=get_path('school_album').$v->album_image?>" title="">
          <? $createImageSize=getimagesize(createImazeSize(get_path('school_album'),$v->album_image,251,188));?>
          <img src="<?=createImazeSize(get_path('school_album'),$v->album_image,251,188)?>" alt=""  style="margin-left:<?=(251-$createImageSize[0])/2?>px"> </a>
          <? if($login_session->get_usertype()==$userTypeArray[0]):?>
          <div class="tools tools-bottom"> <a onClick="deleteImage('<?=$v->album_image_id?>')" class="tooltips" data-placement="top" data-original-title="Delete Image"> <i class="clip-close-2"></i> </a> </div>
          <? endif;?>
        </div>
        <? if($login_session->get_usertype()==$userTypeArray[0]):?>
        <? if($v->album_image_caption):?>
        <button class="btn btn-block" id="imageCaptionVal" onClick="editCaptionToggle('<?=$v->album_image_id?>')">
        <?=$v->album_image_caption?>
        </button>
        <input style="display:none" id="album_image_caption" name="album_image_caption"   type="text" class="input-sm" value="<?=$v->album_image_caption?>" onBlur="editCaptionValue(this.value,'<?=$v->album_image_id?>')">
        <? else:?>
        <button style="display:none"  class="btn btn-block" id="imageCaptionVal" onClick="editCaptionToggle('<?=$v->album_image_id?>')">
        <?=$v->album_image_caption?>
        </button>
        <input id="album_image_caption" name="album_image_caption"  type="text"  class="input-sm" value="<?=$v->album_image_caption?>" onBlur="editCaptionValue(this.value,'<?=$v->album_image_id?>')">
        <? endif;?>
        <? else:?>
        <button class="btn btn-block">
        <?=($v->album_image_caption)?$v->album_image_caption:'No Caption';?>
        </button>
        <? endif;?>
      </div>
      <? endforeach;?>
      <? endif;?>
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
