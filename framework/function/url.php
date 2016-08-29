<?
	function Redirect($URL)
	{
		header("Location:$URL");
		exit;
	}
	function Redirect1($filename) 
	{
    	if (!headers_sent())
       		 header('Location: '.$filename);
   	else {
		        echo '<script type="text/javascript">';
		        echo 'window.location.href="'.$filename.'";';
		        echo '</script>';
		        echo '<noscript>';
		        echo '<meta  tp-equiv="refresh" content="0;url='.$filename.'" />';
		        echo '</noscript>';
    	}
	}
	function re_direct($URL)
	{
		header("location:$URL");
		exit;
	}
	function make_url1($page, $query=null)
	{  
	   if($query!=null):
	   
	     if(substr($query,-1)=='&'):
	      $query=substr($query, 0, strlen($query)-1);
	     endif;
	   
       $convert = array("&", "=");
       $to   = array("-", "-");
       $queryReturn = '-'.str_replace($convert, $to, $query);
	   
	    
		 //print_r($queryReturn);
	   else:
	   $queryReturn=null;
	   endif;
		return DIR_WS_SITE.$page.$queryReturn.'.html';
	}
	function make_url($page, $query=null)
	{
		return DIR_WS_SITE.'?page='.$page.'&'.$query;
	}
	function make_long_url($page, $action='list', $section='list', $query=Null)
	{
	   
		return DIR_WS_SITE.'?page='.$page.'&action='.$action.'&section='.$section.'&'.$query;
		
		
	}
	function make_long_url_backup($page, $action='list', $section='list', $query=Null)
	{
	    if($query!=null):
	       if(substr($query,-1)=='&'):
	          $query=substr($query, 0, strlen($query)-1);
	       endif;
		   $convert = array("&", "=");
		   $to   = array("-", "-");
		   $queryReturn = '-'.str_replace($convert, $to, $query);
	    else:
	       $queryReturn=null;
	    endif;
		return DIR_WS_SITE.$page.'-action-'.$action.'-section-'.$section.$queryReturn.'.html';
		
		
	}
	function display_urlL($title, $page, $query='', $class='')
	{
		//return '<a href="'.make_url($page, $query).'" class="'.$class.'">'.$title.'</a>';
		return $title;
	}
	function display_url($title, $page, $query='', $class='')
	{
		return '<a href="'.make_url($page, $query).'" class="'.$class.'">'.$title.'</a>';
		
	}
	
	function make_admin_url($page, $action='list', $section='list', $query='')
	{
		return DIR_WS_SITE_CONTROL.'control.php?Page='.$page.'&action='.$action.'&section='.$section.'&'.$query;
		
	}
	
	function make_admin_url2($page, $action='list', $section='list', $query='')
	{
		if($page=='home'):
			return DIR_WS_SITE.'index.php';
		else:
			return DIR_WS_SITE_CONTROL.'control.php?Page='.$page.'&action2='.$action.'&section2='.$section.'&'.$query;
		endif;
	}

function category_img_url($name)
{
	if($name==''):
		return DIR_WS_SITE_UPLOAD_PHOTO_CATEGORY.'no_image.jpg';
	else:	
		return DIR_WS_SITE_UPLOAD_PHOTO_CATEGORY.$name;
	endif;
}

	function category_img_url_fs($name)
{
	if($name==''):
		return DIR_FS_SITE_UPLOAD_PHOTO_CATEGORY.'no_image.jpg';
	else:	
		return DIR_FS_SITE_UPLOAD_PHOTO_CATEGORY.$name;
	endif;
}

	function product_img_url_fs($name)
{
	if($name==''):
		return DIR_FS_SITE_UPLOAD_PHOTO_PRODUCT_THUMB.'no_image.jpg';
	else:	
		return DIR_FS_SITE_UPLOAD_PHOTO_PRODUCT_THUMB.$name;
	endif;
}
function banner_img_url_fs($name)
{
	if($name==''):
		return DIR_FS_SITE_UPLOAD_PHOTO_BANNER.'no_image.jpg';
	else:	
		return DIR_FS_SITE_UPLOAD_PHOTO_BANNER.$name;
	endif;
}

/**
 * Make admin anchor tag
 *
 * @param url $url
 * @param text $text
 * @param  Title $title
 * @param css class $class
 * @param alt tag $alt
 */
function make_admin_link($url, $text, $title='', $class='', $alt='')
{
	return  '<a href="'.$url.'" class="'.$class.'" title="'.$title.'" alt="'.$alt.'" >'.$text.'</a>';
}
function make_link($url, $text, $confirm='', $title='', $class='', $alt='')
{
    $onclick=($confirm)?'onclick="return confirm('."'".$confirm."'".')"':'';
	return  '<a href="'.$url.'" class="'.$class.'" title="'.$title.'" alt="'.$alt.'" '.$onclick.'>'.$text.'</a>';
}
?>
