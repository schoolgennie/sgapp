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
<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
<link href="design/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
<link href="design/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
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
            <h1>Gallery</h1>
          </div>
        </div>
      </div>
      <!-- end: PAGE HEADER -->
      <!-- start: PAGE CONTENT -->
      <? if($login_session->get_usertype()==$userTypeArray[0]):?>
      <div class="row">
        <div class="panel-body">
          <div class="col-sm-6"> <a href="#createGallery" data-toggle="modal" class="btn btn-primary"><i class="fa  fa-edit "></i> &nbsp;New Gallery </a> </div>
        </div>
      </div>
      <div id="createGallery" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
          <h4 class="modal-title">Create New Class </h4>
        </div>
        <form name="createNewAlbumForm" action="<?=make_url('gallery-galleryimages')?>" method="post" id="createNewAlbumForm" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Album Name <span class="symbol required"></span></label>
                  <input id="album_name" name="album_name"  class="form-control" type="text" placeholder="Album Name" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group" id="userList">
                  <label>Upload Image </label>
                  <input type="file" value="Upload Photo" name="album_image" id="album_image" class="form-control" >
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Album Description</label>
                  <textarea name="album_description" id="album_description"  class="form-control" placeholder="Album Description"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-light-grey"> Cancel </button>
            <button type="submit" name="submit" value="Submit" class="btn btn-blue"> Create </button>
          </div>
        </form>
      </div>
      <? endif;?>
      <div class="row">
        <? if(albumList):?>
        <? foreach($albumList as $k=>$v):?>
        <? $imageslist=get_object_by_query('album_images','album_id="'.$v->album_id.'" and school_id="'.$school_id.'" order by album_id desc limit 1');?>
        <div class="col-md-3 col-sm-4 gallery-img">
          <div class="wrap-image"> <a class="group1" href="<?=get_path('school_album').$imageslist->album_image?>" title="">
            <? $createImageSize=getimagesize(createImazeSize(get_path('school_album'),$imageslist->album_image,251,188));?>
            <img src="<?=createImazeSize(get_path('school_album'),$imageslist->album_image,251,188)?>" alt=""  style="margin-left:<?=(251-$createImageSize[0])/2?>px"> </a>
            <? if($login_session->get_usertype()==$userTypeArray[0]):?>
            <div class="tools tools-bottom"> <a href="<?=make_url('gallery-galleryimages','id='.$v->album_id)?>" class="tooltips" data-placement="top" data-original-title="Edit Album"> <i class="clip-pencil-3 "></i> </a> <a href="<?=make_url('gallery-galleryimages','id='.$v->album_id.'&status=delete')?>" class="tooltips" data-placement="top" data-original-title="Delete Album"> <i class="clip-close-2"></i> </a> </div>
            <? endif;?>
          </div>
          <button class="btn btn-block" onClick="window.location.href='<?=make_url('gallery-galleryimages','id='.$v->album_id)?>'">
          <?=$v->album_name?>
          </button>
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
