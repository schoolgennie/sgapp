<?
function link_image($name)
{
	return '<img src="'.DIR_WS_SITE_GRAPHIC.$name.'" border="0">';
}

function source_image($source_image)
{
    // detect source image type from extension
    $source_file_name = basename($source_image);
    $source_image_type = substr($source_file_name, -3, 3);
	
   // create an image resource from the source image  	
  switch(strtolower($source_image_type))
    {
        
		case 'jpg':
		
            $original_image = imagecreatefromjpeg($source_image);
            break;
            
        case 'gif':
            $original_image = imagecreatefromgif($source_image);
            break;

        case 'png':
            $original_image = imagecreatefrompng($source_image);
            break;    
        
        default:
            $original_image = imagecreatefromjpeg($source_image);
            break; 
    }
   return $original_image; 
}


function target_image($cropped_image, $target_image)
{

	// detect target image type from extension
    $target_file_name = basename($target_image);
    $target_image_type = substr($target_file_name, -3, 3);
    
    // save the cropped image to disk
	
	   switch(strtolower($target_image_type))
    {
        case 'jpg':
            imagejpeg($cropped_image, $target_image, 90);
            break;
            
        case 'gif':
            imagegif($cropped_image, $target_image);
            break;

        case 'png':
            imagepng($cropped_image, $target_image, 0);
            break;    
        
        default:
            imagejpeg($cropped_image, $target_image, 100);
            break;
    }
	
	
}


function cropImage($image,$h,$w,$x,$y,$nh,$nw,$size,$type)
{
    $source_image=DIR_FS_SITE.'upload/photo/'.$type.'/large/'.$image;
	$target_image=DIR_FS_SITE.'upload/photo/'.$type.'/'.$size.'/'.$image;
	
	
	    $ratio = ($nw/$w); 
		$nw = ceil($w * $ratio);
		$nh = ceil($h * $ratio);
		$nimg = imagecreatetruecolor($nw,$nh);
		$im_src = source_image($source_image);
		imagecopyresampled($nimg,$im_src,0,0,$x,$y,$nw,$nh,$w,$h);
		target_image($nimg,$target_image);
        return true;
}

function create_small($type, $image){
    
	// Get the original geometry and calculate scales
	$source_path=DIR_FS_SITE.'upload/photo/'.$type.'/large/'.$image;
	$destination_path=DIR_FS_SITE.'upload/photo/'.$type.'/small/'.$image;
	list($width, $height) = getimagesize($source_path);
    $xscale=$width/200;
    $yscale=$height/200;
    
    // Recalculate new size with default ratio
    if ($yscale>$xscale){
        $new_width = round($width * (1/$yscale));
        $new_height = round($height * (1/$yscale));
    }
    else {
        $new_width = round($width * (1/$xscale));
        $new_height = round($height * (1/$xscale));
    }

    // Resize the original image & output
	    $nimg = imagecreatetruecolor($new_width, $new_height);
		$im_src = source_image($source_path);
		imagecopyresampled($nimg,$im_src,0,0, 0, 0, $new_width, $new_height, $width, $height);
		target_image($nimg,$destination_path);
        return true;
   
}







function delete_if_image_exists($type, $size, $image)
{
	if(file_exists(DIR_FS_SITE.'upload/photo/'.$type.'/'.$size.'/'.$image)):
		unlink(DIR_FS_SITE.'upload/photo/'.$type.'/'.$size.'/'.$image);
	endif;
}
function delete_if_file_exists($type, $image)
{
	if(file_exists(DIR_FS_SITE.'upload/photo/'.$type.'/'.$image)):
		unlink(DIR_FS_SITE.'upload/photo/'.$type.'/'.$image);
	endif;
}


function upload_photo($type, $file_name,$code)
{
	global $conf_allowed_photo_mime_type;
	if($file_name['error']):
		return false;
	endif;
	if(in_array($file_name['type'], $conf_allowed_photo_mime_type)):
		delete_if_image_exists($type, 'large', $code.$file_name['name']);
		delete_if_image_exists($type, 'thumb', $code.$file_name['name']);
		delete_if_image_exists($type, 'medium', $code.$file_name['name']);
		delete_if_image_exists($type, 'small', $code.$file_name['name']);
		if(move_uploaded_file($file_name['tmp_name'], DIR_FS_SITE.'upload/photo/'.$type.'/large/'.$code.$file_name['name'])):
		create_small($type, $code.$file_name['name']);
			return true;
		else:
			return false;
		endif;
	endif;
	return false;
}
function upload_photo_in_folder($type, $file_name,$code)
{
	global $conf_allowed_photo_mime_type;
	if($file_name['error']):
		return false;
	endif;
	if(in_array($file_name['type'], $conf_allowed_photo_mime_type)):
		if(move_uploaded_file($file_name['tmp_name'], DIR_FS_SITE.'upload/photo/'.$type.'/'.$code.$file_name['name'])):
			return true;
		else:
			return false;
		endif;
	endif;
	return false;
}

function upload_file($type, $file_name,$code)
{
	
	if($file_name['error']):
		return false;
	endif;
	
	if(move_uploaded_file($file_name['tmp_name'], DIR_FS_SITE.'upload/photo/'.$type.'/'.$code.$file_name['name'])):
		return true;
	else:
		return false;
	endif;

}


function get_thumb($type, $image)
{
	echo DIR_WS_SITE.'upload/photo/'.$type.'/thumb/'.$image;
}
function get_medium($type, $image)
{
	echo DIR_WS_SITE.'upload/photo/'.$type.'/medium/'.$image;
}
function get_small($type, $image)
{
	return DIR_WS_SITE.'upload/photo/'.$type.'/small/'.$image;
}

function get_large($type, $image)
{
	echo DIR_WS_SITE.'upload/photo/'.$type.'/large/'.$image;
}
function get_image_folder($type, $image)
{
	echo DIR_WS_SITE.'upload/photo/'.$type.'/'.$image;
}

function get_control_icon($name)
{
	return '<img src="'.DIR_WS_SITE.ADMIN_FOLDER.'/image/'.$name.'.png" border="none" align="absmiddle">';
}
function get_path($type, $image)
{
	 return DIR_WS_SITE.'upload/photo/'.$type.'/large/'.$image;
}

function createImazeSize($source,$image,$width='',$height='')
{
return make_url('common-imagesize','width='.$width.'&height='.$height.'&path='.$source.$image);
}
?>
