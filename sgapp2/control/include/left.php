<div id="left-column">
<?php 
switch ($Page):
case 'place':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/place.php');
break; 
case 'udetail':
case 'user':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/user.php');
break; 
 
case 'learningCenter':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/learningCenter.php');
break;
case 'video':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/video.php');
break;
case 'permissions':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/permissions.php');
break;
case 'contactus':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/contactus.php');
break; 
case 'registrationType':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/registrationType.php');
break;
case 'roadmap':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/roadmap.php');
break; 
case 'survey':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/survey.php');
break; 
case 'roadmapQuestion':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/roadmapQuestion.php');
break;
case 'roadmapAnswer':
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/roadmapAnswer.php');
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
case 'forum': 
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/forum.php');
break; 
case 'forum_response': 
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/forum_response.php');
break; 
case 'forum_category': 
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/forum_category.php');
break;
case 'forum_Subcategory': 
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/forum_Subcategory.php');
break;
case 'bestpractices': 
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/bestpractices.php');
break;
case 'practiceTask': 
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/practiceTask.php');
break;
case 'taskContent': 
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/taskContent.php');
break;

default:
	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/home.php');
endswitch;
?>	
</div>
<div id="center-column">
