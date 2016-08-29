<?php
function forum_category($val='')
{
$query=new query('forum_category');
if($val=='sub'):
$query->Where="where parentId!=0";
else:
$query->Where="where parentId=0";
endif;
$query->DisplayAll();
$category=array();
if($query->GetNumRows()):
while ($cat=$query->GetObjectFromRecord()) 
{
$category[$cat->id]=$cat->name;
}
endif;
return $category;
}
function forumsbread($forum_val)
  {
	$forums=new query('forums');
	$forums->Where="where forum_id='".$forum_val."'";  
	$forum=$forums->Displayone();
	return $forum->forum_title;
  }
function makeLinkToUrl($text) 
  { 
  //$text =ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]","<a href=\"\\0\">\\0</a>",$text);
  $text = eregi_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)','<a href="\\1" target="_blank">\\1</a>', $text); 
  //$text = eregi_replace('()(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)','\\1<a href="http://\\2" target="_blank">\\2</a>', $text); 
  // $text = eregi_replace('([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})','<a href="mailto:\\1">\\1</a>', $text); 
  return $text; 
  }  
  function discussionCategory($id,$parentId='') 
  { 
    $category=new query('forum_category');
	$category->Where="where id='".$id."'";  
	$categorys=$category->Displayone();
	if($parentId==''):
	return ucfirst($categorys->name);
	
	else:
	return discussionCategory($categorys->parentId);
	endif;
  }   
function if_forum_response($cat_id)
{
	#check for sub categories.
	$query= new query('forum_response');
	$query->Where="where categoryId='$cat_id'";
	$query->DisplayAll();
	if($query->GetNumRows()):
		return true;
	endif;

}
?>
