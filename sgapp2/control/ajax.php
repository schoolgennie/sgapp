<?php 
require_once("../include/config/config.php");
	$function=array('url', 'database','input');
if(isset($_GET['mode'])):


	switch($_GET['mode']) 
	{

	
	   case 'mycoutry':

	     if($_GET['query'] != 'g'):

	   		echo '<select name="state" id="state">

						<option value="">Any</option>';

			echo dropdown_ser_state('states',"country_code='".$_GET['query']."'",$_GET['sid'],'state_name');

			echo '</select>';

		else:

			echo '<select name="state" id="state">

					<option value="">Choose State</option>';

			echo '</select>';

		endif;

	   break;

	 
	  

	  case 'region':

		
			$query=new query('region');
			$query->Where="where countryId=".$_GET['query'];
			$query->displayall();
			if($query->GetNumRows()>0):
			     echo "<option value=''>--Select value--</option>";
			  while($region=$query->GetObjectFromRecord()):
				  echo "<option value=".$region->id.">".$region->regionName."</option>";
			  endwhile;
			else:
			   echo "<option value=''>--Select value--</option>";  
			endif;
	 break;		
	  case 'state':

		
			$query=new query('state');
			$query->Where="where regionId=".$_GET['query'];
			$query->displayall();
			if($query->GetNumRows()>0):
			     echo "<option value=''>--Select value--</option>";
			  while($state=$query->GetObjectFromRecord()):
				  echo "<option value=".$state->id.">".$state->stateName."</option>";
			  endwhile;
			else:
			   echo "<option value=''>--Select value--</option>";  
			endif;		
	  
	    case 'accouNo':

			$query=new query('user');
             
			if(isset($_GET['id']) && $_GET['id']!=''):
			$query->Where="where $_GET[query]='".$_GET['query1']."' and id!='".$_GET['id']."'";
			else:  
			$query->Where="where $_GET[query]='".$_GET['query1']."'";
			endif;
             print_r($query);
			$numrows = $query->count();

			if($numrows > 1) {

				$var = "1";

				echo rtrim($var);

			} else {

				$var = "";

				echo rtrim($var);

			}

	  break;
	  
	      case 'positionCheck':

			$query=new query('user');
             
			if(isset($_GET['id']) && $_GET['id']!=''):
			$query->Where="where $_GET[query]='".$_GET['query1']."' and id!='".$_GET['id']."' and parentId='".$_GET['idd']."'";
			else:  
			$query->Where="where $_GET[query]='".$_GET['query1']."' and parentId='".$_GET['idd']."'";
			endif;
             
			$numrows = $query->count();
            echo $numrows;
			

	  break;
	  
	
	case 'coutry_reg':
			echo '<select name="state">';
			echo dropdown_ser_state('states',"country_code='".$_GET['query']."'",'','state_name');
			echo '</select>';
			
	break;
	
	case 'admin_coutry_reg':
			echo '<select name="StateID">';
			echo dropdown_state('states',"country_code='".$_GET['query']."'",'','state_name');
			echo '</select>';
	break;
	  

	}				

endif;			

?>				