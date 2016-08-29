<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>School Gennie</title>
<? include_once(DIR_FS_SITE_INCLUDE.'cssJavascript.php'); ?>
 <script>
		jQ172(document).ready(function(){
		
			// binds form submission and fields to the validation engine
			jQ172("#feedbackFrm").validationEngine();
		});

	</script>
<!-- color box js and css css-->
<link href="jqueryScripts/colorbox/css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE]>
<link type="text/css" media="screen" rel="stylesheet" href="colorbox-ie.css" title="example" />
<![endif]-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="jqueryScripts/colorbox/js/jquery.colorbox.js"></script>
    <!--to show faculty profile-->
    <script type="text/javascript">
         jQuery(document).ready(function(){ $("a[rel='day_view']").colorbox({width:"820px", height:"400px", iframe:true,previous:false,next:false}); });
    </script>
    <!--to show faculty profile-->
<!-- color box js and css css-->    
<script>

<!-- post feed back  start-->
function postFeedBack(faculty_id)
{

   var faculty_feedback_comment=$("#facultyList"+faculty_id+" div.slidingDiv1 div.slidiv  #faculty_feedback_comment").val();
   var faculty_feedback_anonymous=$("#facultyList"+faculty_id+" div.slidingDiv1 div.slidiv  #faculty_feedback_anonymous").attr('checked')?0:1;
   var faculty_feedback_rating=$("#facultyList"+faculty_id+" div.slidingDiv1 div.slidiv  #faculty_feedback_rating").val();
  if(faculty_feedback_comment)
  {
  	$.ajax({
	
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=profile-facultylistforstudentajax",
		data:"mode=addFeedback&faculty_id="+faculty_id+"&faculty_feedback_comment="+faculty_feedback_comment+"&faculty_feedback_anonymous="+faculty_feedback_anonymous+"&faculty_feedback_rating="+faculty_feedback_rating,
		
		success: function(output)
		 {
		        result=output.split("~!");
				 if(result[0]!=0)
				{ 
				    //$("#facultyList"+faculty_id+" div.slidingDiv1 div.slidiv  #faculty_feedback_comment").removeAttr('value');
					$("#facultyList"+faculty_id+" div.slidingDiv1 div.slidiv").html(ratingHtml(faculty_id));
					$("#facultyList"+faculty_id+" div.slidingDiv1 #feedBackList").html(result[0]);
					$("#facultyList"+faculty_id+" div.middle-list-toggle span.hstar").css('width',(90/5)*result[1]);
					//var ratingHtml='';
				    // for(i=0;i<5;i++)
					// {
					 //  ratingHtml=ratingHtml+'<span  class="star" style="width:20px;" onclick="selectRating('+i+','+faculty_id+')"> </span>';
					 //}
					 //$("#facultyList"+faculty_id+" div.slidingDiv1 #faculty_feedback_rating").attr("value", 0);
					 
					 //$("#facultyList"+faculty_id+" div.slidingDiv1 #selectRating").html(ratingHtml);
					$("#showMessage").html('You feedback has been submited succesfully');
					
					
				}
				else
				{
				     $("#showMessage").html(result[1]);
				}
				
			
		}   
	});
	}
}
<!-- post feed back   end-->


<!-- delete feed back   start-->

function deleteFacultyFeedBack(faculty_id,faculty_feedback_id)
{
if(confirm("Are you sure? You want to  delete this feed back...!"))
	{
  	$.ajax({
	
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=profile-facultylistforstudentajax",
		data:"mode=deleteFacultyFeedBack&faculty_id="+faculty_id+"&faculty_feedback_id="+faculty_feedback_id,
		
		success: function(output)
		 {
		       
					$("#facultyList"+faculty_id+" div.slidingDiv1 #feedBackList").html(output);
					$("#showMessage").html('You feedback has been deleteed succesfully');
					
			
		}   
	});
	}
}

<!-- delete feed back   end-->

function selectRating(rating,faculty_id)
{

 var result="";
 var hstar='hstar';
 var star='star';
 for(i=1;i<=5;i++)
 {
   result=result+'<span  class="'+(i<=rating?hstar:star)+'" style="width:18px;" onclick="selectRating('+i+','+faculty_id+')"> </span>';
 }
 $("#facultyList"+faculty_id+" div.slidingDiv1 #faculty_feedback_rating").attr("value", rating);
 
 $("#facultyList"+faculty_id+" div.slidingDiv1 #selectRating").html(result);
}

function ratingHtml(faculty_id)
{
 var result='';
              result=result+'<textarea name="faculty_feedback_comment" id="faculty_feedback_comment" cols="" class="txtarea" rows=""></textarea>';
              result=result+'<br />';
              result=result+'<span style=" float:left; padding-left:5%; padding-top:1%;">';
              result=result+'<input name="faculty_feedback_anonymous" id="faculty_feedback_anonymous" type="checkbox"/>anonymous</span>';
              result=result+'<input type="hidden" name="faculty_feedback_rating" id="faculty_feedback_rating" value="0" />';
              result=result+'<span style="float:left;padding-top:1%;padding-left:30%;" id="selectRating">';
              for(i=0;i<5;i++)
			  {
              result=result+'<span  class="star" style="width:18px;" onclick="selectRating('+i+','+faculty_id+')"> </span>';
              }
              result=result+'</span>';
              result=result+'<span  style="float:right; padding-right:5%;">';
              result=result+'<input name="" align="right" class="crtbtn_gr1" type="button" value="Post Feedback" onclick="postFeedBack('+faculty_id+')"/>';
              result=result+'</span><br /><br /><br />';
  return result;			  
}


function facultyFeedBackListToggle(id)
{
   // jQuery(".slidingDiv1").hide();
    //$("#facultyList"+faculty_id+" div.slidingDiv1").toggle();
	
	var currentstatus=$("#facultyList"+id+" div.slidingDiv1").css('display');
	
	jQuery(".slidingDiv1").hide();
	$(".detail").html('<img src="images/plus.png"  />'); 
    $("#facultyList"+id+" div.slidingDiv1").toggle();
	$("#facultyList"+id+" span.detail").html('<img src="images/minus.png"  />');  
	if(currentstatus=='block')
	{
	   $("#facultyList"+id+" div.slidingDiv1").hide();
	   $("#facultyList"+id+" span.detail").html('<img src="images/plus.png"  />'); 
	}
	
	
	
}	

</script>
</head>
<body>
 <!-- Header Start-->
<? include_once(DIR_FS_SITE_INCLUDE.'header.php'); ?>
<!-- Header End-->
<!--Navigation Start -->
<? include_once(DIR_FS_SITE_INCLUDE.'studentNav.php'); ?>
<!--Navigation End -->
<!-- Main Start-->
<div id="main-wrapper">
  <!--App Controls Start-->
  <!--App Controls End-->
  <div class="app-container" >
          <div>
            <?php display_form_error();?>
          </div>
		  
		  <? foreach($facultyList as $k=>$v):?>
		  <div class="list list-box-feature">
                  <div class="1u">
                    
                    <a class="image" href="<?=make_url('profile-facultylistforstudent','id='.$v->faculty_id)?>" >
                    <img src="<?=($v->faculty_image)?get_small('faculty',$v->faculty_image):'images/noimage.png'?>" />
                    </a>
                    
				  </div>
				  
				  <div class="3u list-content">  
					  <span class="name"><?=$v->faculty_first_name.' '.$v->faculty_last_name?></span> <br />
                      <span >Designation :</span> <?=$fcultyDesignationArray[$v->faculty_designation]?>
                      
                    </div>
				  
				  <div class="4u list-content">
                      
                      <span >Incharge :</span> <?=$inchargeClass->class_name?> 
                  </div>
				  
                  <div class="4u">
                   
                    <input type="button"  class="" value="Feedback" onClick="facultyFeedBackListToggle(<?=$v->faculty_id?>)"/>
 
                  </div>
		</div>
		<div class="list-box-dropdown">
			<form name="" id=""  >
				<textarea name="" id="" cols="" class="validate[required] " rows="3" style="width:100%"></textarea>
				<span>Anonymous <input type="checkbox" />   </span>
				
				<span>
				<? for($i=1;$i<=5;$i++):?>
                  <span  class="star" onClick="selectRating('<?=$i?>','<?=$v->faculty_id?>')"> </span>
                  <? endfor;?>
				<span>  
				<input name="feedback"  class="" type="button" value="Post Feedback" onClick="postFeedBack(<?=$v->faculty_id?>)"/>
			</form>
			
			<div class="box-container">
			      <? $feedBackList=get_all_record_by_query('faculty_feedback','faculty_id="'.$v->faculty_id.'" and student_id="'.$student_id.'" order by faculty_feedback_ondate desc,faculty_feedback_id desc');?>
                <div id="feedBackList">
                  <? if($feedBackList):?>
                  <? foreach($feedBackList as $k=>$v):?>
                  <div class=""> On Date :
                    <?=date('d-m-Y',strtotime($v->faculty_feedback_ondate))?>
                    <img src="images/cross.png" title="Delete" onClick="deleteFacultyFeedBack('<?=$v->faculty_id?>','<?=$v->faculty_feedback_id?>')"/> 
                    <p>
                      <?=$v->faculty_feedback_comment?>
                    </p>
                  </div>
                  <? endforeach;?>
                  <? endif;?>
			    </div>
			</div>
		</div>
		
		
		 <? endforeach;?> 
		  
		  
		  
		  
		  

  </div>
  <!-- Footer Start-->
  <? include_once(DIR_FS_SITE_INCLUDE.'footer.php'); ?>
  <!-- Footer End-->
</div>
<!-- Main End -->
</body>
</html>
