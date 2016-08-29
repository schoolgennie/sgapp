// validation for register page start here//

var xmlhttp1 = false;
	if (window.XMLHttpRequest)
	{
		xmlhttp1 = new XMLHttpRequest();
	}
	else if (window.ActiveXObject)
	{
		xmlhttp1 = new ActiveXObject("Microsoft.XMLHTTP");
	}	

	


var xmlhttp = false;
	if (window.XMLHttpRequest) 
	{
		xmlhttp = new XMLHttpRequest();
	}
	else if (window.ActiveXObject)
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	
function ajaxRegion(val)
{
	if(val!='')
	{
       var url="ajax.php?mode=region&query="+val;
             xmlhttp.open('GET', url, true);
			 xmlhttp.onreadystatechange = function() 
			 {	
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
				document.getElementById('region').innerHTML = xmlhttp.responseText;		
				}
			};
			xmlhttp.send(null); 
	}
	else
	{
	        document.getElementById('region').innerHTML	="<option value=''>--Select value--</option>";
			document.getElementById('state').innerHTML ="<option value=''>--Select value--</option>";
	}
}

function ajaxState(val)
{
	if(val!='')
	{
       var url="ajax.php?mode=state&query="+val;
             xmlhttp.open('GET', url, true);
			 xmlhttp.onreadystatechange = function() 
			 {	
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
				document.getElementById('state').innerHTML = xmlhttp.responseText;		
				}
			};
			xmlhttp.send(null); 
	}
	else
	{
		   document.getElementById('state').innerHTML ="<option value=''>--Select value--</option>";
	}
}








	function select_country(val) {

	var url="ajax.php?mode=coutry_reg&query="+val;
				 xmlhttp.open('GET', url, true);
				xmlhttp.onreadystatechange = function() {
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById('coutry').innerHTML = xmlhttp.responseText;		
					}
				};
				xmlhttp.send(null); 
}



function selectstate(val) {
	var url="ajax.php?mode=mycoutry&query="+val;

		 xmlhttp.open('GET', url, true);

		xmlhttp.onreadystatechange = function() {

			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {

				document.getElementById('coutry').innerHTML = xmlhttp.responseText;						

			}

		};

		xmlhttp.send(null); 

}





function chkselectstate(val,sid) {

	var url="ajax.php?mode=mycoutry&query="+val+"&sid="+sid;

		 xmlhttp.open('GET', url, true);

		xmlhttp.onreadystatechange = function() {

			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {

				document.getElementById('coutry').innerHTML = xmlhttp.responseText;						

			}

		};

		xmlhttp.send(null); 

}


