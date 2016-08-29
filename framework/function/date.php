<?
function ToUKDate($date)
{
	return date("d-m-Y", strtotime($date));
}

function ToUSDate($date)
{
	$Parts=array();
	$Parts=explode('-',$date);
	$Result=$Parts['2'].'-'.$Parts['1'].'-'.$Parts['0'];
	return $Result;
}

function date_format_inserted($date)
{
    return date("d-m-Y",strtotime($date));
}

function ToIndianDate($date)
{
    return date("d-m-Y",strtotime($date));
}
function defaultDatabaseDateFormat($date)
{
    return date("Y-m-d",strtotime($date));
}
?>