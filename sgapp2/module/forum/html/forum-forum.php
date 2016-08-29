<!DOCTYPE html >
<html >
<head>
<? include_once(DIR_FS_SITE_INCLUDE.'meta.php'); ?>
<title>School Gennie</title>
<? include_once(DIR_FS_SITE_INCLUDE.'css.php'); ?>
<? include_once(DIR_FS_SITE_INCLUDE.'javascript.php'); ?>


<!-- color box js and css css-->
<link href="jqueryScripts/colorbox/css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="jqueryScripts/colorbox/js/jquery.colorbox.js"></script>
<!-- color box js and css css-->
<script>
function classToggle(id)
{

	
    $("#viewLess"+id).toggle();
	$("#viewAll"+id).toggle();
  
};

</script>
<!-- autoload js -->

<script type="text/javascript">
$(document).ready(function() {

	var track_load = 1; //total loaded record group(s)
	var loading  = false; //to prevents multipal ajax loads
	var total_groups = <?=isset($topicList->TotalPages)?$topicList->TotalPages:1; ?>; //total record group(s)
	//alert(total_groups);
	$('#results').load("<?=DIR_WS_SITE?>?page=forum-forumajax&mod=forum", {'p':track_load,'mode':'getForumToplicList','forum_category_id':'<?=$forum_category_id?>'}, function() {track_load++;}); //load first group
	
	$(window).scroll(function() { //detect page scroll
		
		if($(window).scrollTop() + $(window).height() == $(document).height())   //user scrolled to bottom of the page?
		{
				
			if(track_load <= total_groups && loading==false) //there's more data to load
			{
				loading = true; //prevent further ajax loading
				$('.animation_image').show(); //show loading image
				
				//load data from the server using a HTTP POST request
				$.post("<?=DIR_WS_SITE?>?page=forum-forumajax&mod=forum",{'p':track_load,'mode':'getForumToplicList','forum_category_id':'<?=$forum_category_id?>'}, function(data){
								
					$("#results").append(data); //append received data into the element

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
function deleteTopic(topicId)
{
//forumTopicDiv
  var forum_topic_id=topicId;
 
 if(confirm("Are you sure? You want to  delete this Topic...!"))
	{
	$.ajax({
	
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=forum-forumajax",
		data:"mode=deleteForumTopic&forum_topic_id="+forum_topic_id,
		
		success: function(output)
		 { 
		    result=output.split("~!");
		    if(result[0]==1)
			{
			   $( "#forumTopicDiv"+forum_topic_id).remove();
			   alert(result[1]);
			}
			else
			{ 
			 alert(result[1]);
			}
		}   
	});
	}
 
}
function addTopicComment(topicId)
{
  var forum_comment=$("#forum_comment"+topicId).val();
  
  var topic_id=topicId;
 
	$.ajax({
	
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=forum-forumajax",
		data:"mode=addTopicComment&forum_comment="+forum_comment+"&topic_id="+topic_id,
		
		success: function(output)
		 { 
		    result=output.split("~!");
		    if(result[0]==1)
			{
			   $( "#viewLess"+topic_id).append( result[1] );
			   $( "#viewALL"+topic_id).append( result[1] );
			   $("#forum_comment"+topicId).val('');
			}
			else
			{ 
			 alert('Enter value in Replay');
			}
		}   
	});
 
}


function deleteTopicComment(commentId)
{
//forumTopicDiv
  var forum_comment_id=commentId;
  if(confirm("Are you sure? You want to  delete this Comment...!"))
	{
	$.ajax({
	
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=forum-forumajax",
		data:"mode=deleteTopicComment&forum_comment_id="+forum_comment_id,
		
		success: function(output)
		 { 
		    result=output.split("~!");
		    if(result[0]==1)
			{
			   $( "#forumCommentDiv"+forum_comment_id).remove(  );
			   $( "#forumCommentDiv"+forum_comment_id).remove(  );
			   alert(result[1]);
			}
			else
			{ 
			 alert(result[1]);
			}
		}   
	});
	}
 
}



</script>
</head>
<body>

<!-- Header Start-->
<? include_once(DIR_FS_SITE_INCLUDE.'header.php'); ?>
<!-- Header End-->
<!-- start: MAIN CONTAINER -->
<div class="main-container">

      <? include_once(DIR_FS_SITE_INCLUDE.$login_session->get_usertype().'Nav.php'); ?>

	<div class="main-content">
			      <?php display_form_error();?>
		
			
				<div class="container">
					<!-- start: PAGE HEADER -->
					<div class="row">
						<div class="col-sm-12">
							<!-- start: STYLE SELECTOR BOX -->
							
							<!-- end: STYLE SELECTOR BOX -->
							<!-- start: PAGE TITLE & BREADCRUMB -->
							
							<!-- end: PAGE TITLE & BREADCRUMB -->
							<div class="page-header">
								<h1>Dashboard<small> Faculty</small></h1>
							</div>
						</div>
					</div>
					<!-- end: PAGE HEADER -->
					
										<!-- start: PAGE CONTENT -->
					<div class="row">
						<div class="col-sm-12"></div>
					</div>

 <!-- Main Start-->
 <div id="main-wrapper">
 
<!--App Controls Start-->
	<div id="app-controler">
              <ul id="app-tabs">
              <li class="active"><a><?=$categoryDetails->forum_category?></a></li>
            </ul>
          </div>
           
<!--App Controls End-->	

<!--Start App Container	-->   
     <div class="app-container" >
          <div><?php display_form_error();?></div>
            <div class="forum-content box-blue">
            <? if($forumCategoryList):?>
                <script>
				jQ172(document).ready(function(){
				jQ172("#forumPostFrm").validationEngine();
				});
				</script>
              <form id="forumPostFrm" action="<?=make_long_url('forum-forum', 'insert', 'list','forum_category_id='.$forum_category_id);?>" method="post" name="forumPostFrm" >
                <div class="row">
					<div class="11u">
                  <textarea name="forum_topic" rows="2" style="width:100%" class="validate[required] txtarea" aria-expanded="false" autocomplete="off" aria-autocomplete="list" role="textbox" placeholder="Ask in Open Forum"></textarea>
                </div>
				
                <div class="1u">
                  <input name="submit" align="right" class="small-button" type="submit" value="Post" />
                </div>
              </div>
              </form>
            <? else:?>
            
                 No Forum Category  
                
            <? endif;?>  
			
              <div id="results" class="main-forum" ></div>
              
              
            </div>
         
			  <div class="forum-category box-container">
				<div class="box-header">Category </div>
				<div class="box-container" >
				  <ul>
					<? foreach($forumCategoryList as $k=>$v):?>
					<li><a href="<?=make_url('forum-forum','forum_category_id='.$v->forum_category_id)?>"><?=$v->forum_category?></a>
					<? if($login_session->get_usertype()=='school' && $v->forum_category!='General Discussion'):?>
					<a href="<?=make_long_url('forum-forum','deleteCategory','list','forum_category_id='.$forum_category_id.'&categoryId='.$v->forum_category_id)?>" onClick="return confirm('Are you sure? You want to  delete this Category...!')"><img title="Delete"  src="images/cross.png"></a>
					<? endif;?>
					</li>
					<? endforeach;?>
				  </ul>
				</div>
				<? if($login_session->get_usertype()=='school'):?>
				<script>
				jQ172(document).ready(function(){
				jQ172("#forumCategoryFrm").validationEngine();
				});
				</script>
				<form name="forumCategoryFrm" action="<?=make_long_url('forum-forum', 'insertCategory', 'list','forum_category_id='.$forum_category_id);?>" id="forumCategoryFrm" method="post">
				<div class=""> 
				
				  <input name="forum_category" type="text" class="validate[required] " style="width:60%" />
				 
				  <input name="submit" align="right" class="small-button" type="submit" value="Create" />
				  
				</div>   
				  </form>
					<? endif;?>
			  </div>
	</div>	  
<!--End App Container	--> 	
 

</div>
  <!-- Main End -->
  
  
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
