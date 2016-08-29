<?php
class ResizeImage {

   var $image;
   var $image_type;

   function load($filename) {
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image);
      }
   }
   function getWidth() {
      return imagesx($this->image);
   }
   function getHeight() {
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }
}
list($imazeWidth, $imazeHeight)=getimagesize($_REQUEST['path']);

if(isset($_REQUEST['width']) && $_REQUEST['width'] != ''){
		$width = $_REQUEST['width'];
	}else {
		$width = '150';
	}

	if(isset($_REQUEST['height']) && $_REQUEST['height'] != ''){
		$height = $_REQUEST['height'];
	}else {
		$height = '';
	}
    if($imazeWidth<=$width && $imazeHeight<=$height )
			if($imazeWidth<=$imazeHeight){
				if(isset($_REQUEST['path']) && $_REQUEST['path'] != ''){
					header('Content-Type: image/jpeg');
					//include('resizeimageclass.php');
					$image = new ResizeImage ();
					$image->load($_REQUEST['path']);
					$image->resizeToHeight($height);
					$image->output();
				}
			}
			else if($imazeWidth>$imazeHeight){
				if(isset($_REQUEST['path']) && $_REQUEST['path'] != ''){
					header('Content-Type: image/jpeg');
					//include('resizeimageclass.php');
					$image = new ResizeImage ();
					$image->load($_REQUEST['path']);
					$image->resizeToWidth($width);
					$image->output();
				}
			}
	else {
	
			if($imazeWidth<=$imazeHeight){
				if(isset($_REQUEST['path']) && $_REQUEST['path'] != ''){
					header('Content-Type: image/jpeg');
					//include('resizeimageclass.php');
					$image = new ResizeImage ();
					$image->load($_REQUEST['path']);
					$image->resizeToWidth($width);
					$image->output();
				}
			}
			else if($imazeWidth>$imazeHeight){
				if(isset($_REQUEST['path']) && $_REQUEST['path'] != ''){
					header('Content-Type: image/jpeg');
					//include('resizeimageclass.php');
					$image = new ResizeImage ();
					$image->load($_REQUEST['path']);
					$image->resizeToHeight($height);
					$image->output();
				}
			}		
	     }
	else {
		if(isset($_REQUEST['path']) && $_REQUEST['path'] != ''){
			header('Content-Type: image/jpeg');
			//include('resizeimageclass.php');
			$image = new ResizeImage ();
			$image->load($_REQUEST['path']);
			$image->resize($width, $height);
			$image->output();
		}
	}

exit;
?>