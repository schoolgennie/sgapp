<div id="left-column">
<?php 
switch ($Page):
case 'place':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/place.php');
break; 
case 'answer':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/answer.php');
break;
case 'question':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/question.php');
break; 
case 'factor':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/factor.php');
break;
case 'user':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/user.php');
break; 
case 'udetail':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/user.php');
break;
case 'banner': 
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/banner.php');
break; 
case 'level':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/level.php');
break;
case 'home_banner': 
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/home_banner.php');
break; 
case 'product':  
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/product.php');
break; 
case 'gallery':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/gallery.php');
break; 
case 'content':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/content.php');
break; 
case 'subcontent':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/subcontent.php');
break;
case 'setting':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/setting.php');
break; 
case 'news':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/news.php');
break; 
default:
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/home.php');
endswitch;
?>	
</div>
<div id="center-column">
