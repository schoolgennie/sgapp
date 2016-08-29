<? 
$latest_topic=new query('forum_response');
$latest_topic->Where="where response_status='Yes' order by date_added desc Limit 5";
$latest_topic->Displayall();

?>

<td  align="left" width="169" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top" class="leftmaintitle">Category</td>
          </tr>
          <tr>
            <td align="left" valign="top" class="leftlatesttopitcs"><div class="catleftlist">
                <? 
	
	foreach(forum_category() as $k=>$v):
	?>
                <a href="<?=make_url('forumCat','cat_id='.$k)?>">
                <?=$v?>
                </a>
                <? endforeach;?>
              </div></td>
          </tr>
          </table>
          </td>
          </tr>
           <tr>
            <td height="10" align="left" valign="top"></td>
          </tr>
          <tr>
          <td align="left" valign="top">
          <table border="0" align="left" cellpadding="0" cellspacing="0" width="100%" style="text-align:left;">
		  <? if($login_session->get_user_id()!=''):?>
		   <tr>
            <td align="left" valign="top"><? if($login_session->get_user_id()!=''):?><a href="<?=make_url('suggestCategory');?>"><img src="images/suggest_category.jpg" border="0" /></a><? else:?><a href="<?=make_url('login');?>">Sign Up</a><? endif;?></td>
          </tr>
		   <tr>
            <td height="10" align="left" valign="top"></td>
          </tr>
		   <tr>
            <td align="left" valign="top"><? if($login_session->get_user_id()!=''):?><a href="<?=make_url('suggestSubCategory');?>"><img src="images/suggest-sub-category.jpg" border="0" /></a><? else:?><a href="<?=make_url('login');?>">Sign Up</a><? endif;?></td>
          </tr>
		   <tr>
            <td height="10" align="left" valign="top"></td>
          </tr>
		  <? endif;?>
          <tr>
            <td align="left" valign="top"><? if($login_session->get_user_id()!=''):?><a href="<?=make_url('forumtopicadd');?>"><img src="images/addtopicbtn.jpg" border="0" /></a><? else:?><a href="<?=make_url('login');?>">Sign Up</a><? endif;?></td>
          </tr>
          </table>
          </td>
          </tr>
        
  </table></td>
