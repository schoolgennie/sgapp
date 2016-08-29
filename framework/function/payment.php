<?
function packageListing()
{
	$selectPackege=new query('package');
    $selectPackege->Where="order by pakPosition";
    $selectPackege->Displayall();
    $list=array();
	if($selectPackege->GetNumRows()>0):
    while($packegeList=$selectPackege->GetObjectFromRecord()):
      $list[]=$packegeList;
    endwhile;
	endif;
	return $list;
}

?>