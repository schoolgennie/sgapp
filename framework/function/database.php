<?
function get_object($tablename, $id, $type='object')
{
		$query= new query($tablename);
		$query->Where="where id='$id'";
		return $query->DisplayOne($type);
}
function get_object_by_col($tablename, $col, $col_value, $type='object')
{
		$query= new query($tablename);
		$query->Where="where $col='$col_value'";
		return $query->DisplayOne($type);
}
function get_object_by_query($tablename, $where='',$field='', $type='object')
{       $where=($where)?'where '.$where:'';
        $field=($field)?$field:'*';
		$query= new query($tablename);
		$query->Field=$field;
		$query->Where=$where;
		return $query->DisplayOne($type);
}
function get_all_object_by_query($tablename, $where='', $AllowPaging=false, $PageNo=1, $PageSize=DEFAULT_PAGE_SIZE, $type='object')
{
		$where=($where)?'where '.$where:'';
		$query= new query($tablename);
		$query->AllowPaging=$AllowPaging;
		$query->PageNo=$PageNo;
		$query->PageSize=$PageSize;
		$query->Where=$where;
		$query->Displayall();
        return $query;
}
function get_all_record_by_query($tablename, $where='',$field='*',$type='object')
{
		$query= new query($tablename);
		$query->Field=$field;
		if($where):
		$query->Where="where $where";
		endif;
		$query->Displayall();
                $result=array();
                if($query->GetNumRows()>0):
                  while($queryObj=$query->GetObjectFromRecord()):
                   $result[]=$queryObj;
                 endwhile;
                endif;
                return $result;
}

function get_object_by_query_count($tablename, $where='', $type='object')
{
		$query= new query($tablename);
		$query->Where="where $where";
		return $query->count($type);
}
function get_all_record_by_query_with_paging($tablename, $where='',$page=1,$pagesize=10,$type='object')
{
		$query= new query($tablename);
		$query->Where="where $where";
        $query->AllowPaging=true;
		$query->PageNo=$page;
		$query->PageSize=$pagesize;
		$query->Displayall();
                $result=array();
                if($query->GetNumRows()>0):
                  while($queryObj=$query->GetObjectFromRecord()):
                   $result[]=$queryObj;
                 endwhile;
                endif;
                return $result;
}
function get_object_by_field_query($tablename,$field='*', $where='', $type='object')
{
		$query= new query($tablename);
        $query->Field=$field;
		$query->Where="where $where";
		return $query->DisplayOne($type);
}

function update_record_in_table($tablename,$where,$data,$not='')
{
		
		$QueryObj =new query($tablename);
		$QueryObj->Data=MakeDataArray($data, $not);
		$QueryObj->Where="where ".$where;
		if($QueryObj->UpdateCustom()):
		return true;
		endif;
		

}

function insert_record_in_table($tablename,$data,$not='')
{
		
		$QueryObj =new query($tablename);
		$QueryObj->Data=MakeDataArray($data, $not);
		if($QueryObj->Insert()):
		  return true;
		endif;

}
function checkTableExist($tablename)
{
       if(is_array($tablename)):
	     foreach($tablename as $k=>$v):
		   $query= new query($v);
	       $query->checkTable();
	       if(!$query->GetNumRows()):
		    global $$v;
			if($$v):
		    runSqlFile($$v);
			endif;
		   endif;
		 endforeach;
	   else:
	     $query= new query($tablename);
	     $query->checkTable();
	     if(!$query->GetNumRows()):
		   global $$tablename;
		   if($$tablename):
		   runSqlFile($$tablename);
		   endif;
		 else:
			return 1;  
		 endif;
	   endif;
}
function createTaleIfNotExist($script)
{
$query= new query($script);
$query->createTable();
}
function checkDatabaseeIsExist($database)
{
$query= new query();
$query->DataBaseName=$database;
$query->checkDatabase();
if($query->GetNumRows()):
  return true;
else:
  return false;
endif;
}
function createDatabaseIfNotExist($database)
{
$query= new query();
$query->DataBaseName=$database;
$query->createDatabase();
}
function createDatabaseExist($script)
{
$query= new query($script);
$query->createTable();
}
function runSqlFile($sql)
	{
	if(is_file($sql)):
	$query=file_get_contents($sql);
	else:
	$query =$sql;
	endif;
	$query = explode(';',$query);
	foreach ($query as $stmt) 
	{ 
	  if($stmt){
	   createTaleIfNotExist($stmt);
	   }
	}
	}
function delete_record_from_table($tablename,$where)
{
       
		$query= new query($tablename);
		$query->Where="where ".$where;
		if($query->Delete_where()):
		  return true;
		endif;
		
}
function validate_user($table, $details=array())
{
	$query= new query($table);
	$query->Where="where username='$details[username]' and password='$details[password]' and is_active=1";
	if($user=$query->DisplayOne()):
		return $user;
	else:
		return false;
	endif;	
}
?>
