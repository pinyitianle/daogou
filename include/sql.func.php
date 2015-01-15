<?php
function mysql_del($table,$where){
	$sql="delete from ".PREFIX.$table." ".$where;
	//echo $sql;
	return mysql_query($sql);
}
function get_list($table,$field='*',$where=''){
	$field=$field?$field:'*';
	$sql="SELECT ".$field." FROM ".$table." ".$where;

	//echo $sql."<br/>";
	$result=mysql_query($sql);
	if(mysql_error()){//echo mysql_error().$sql;
		exit;}
	while($arr=mysql_fetch_array($result)){
		$a[] = $arr;
	}
	return $a;
}

function get_list_by_id($table,$t_id,$id,$t=false){
	$sql="SELECT * FROM ".PREFIX.$table." WHERE ".$t_id."='".$id."'";
	$result=mysql_query($sql);

	//echo $sql."<br/>";
	if($t){
		while($arr=mysql_fetch_array($result)){
			$a[] = $arr;
		}
		return $a;
	}else{
		if($arr=mysql_fetch_array($result)){
			return $arr;
		}
	}
}

function get_field_by_id($table,$field,$t_id,$id){
	$sql="SELECT ".$field." FROM ".PREFIX.$table." WHERE ".$t_id."='".$id."'";
	$result=mysql_query($sql);
	if($arr=mysql_fetch_array($result)){
		return $arr;
	}
}

function get_list_count($table,$sqladd=''){
	$sql="SELECT count(*) as c FROM ".PREFIX.$table." ".$sqladd;
	$result=mysql_query($sql);
	//echo $sql;
	if(mysql_error()){//echo $sql.'<br />'.mysql_error();
		exit;}
	if($arr=mysql_fetch_array($result)){
		return $arr['c'];
	}
}
function autoExecute($table, $arrFields, $mode, $where=false){
	if(strtolower($mode)=='update'){
		$value="";
		foreach($arrFields as $k => $v){
			$value.=$k."='".$v."',";
		}
		$value=substr($value,0,strlen($value)-1);
		$sql="update ".$table." set ".$value." ".$where;
	}else if(strtolower($mode)=='insert'){
		$fields="";
		$value="'";
		foreach($arrFields as $k => $v){
			$fields.=$k.",";
			$value.=$v."','";
		}
		$fields=substr($fields,0,strlen($fields)-1);
		$value=substr($value,0,strlen($value)-2);
		$sql="insert into ".$table." (".$fields.") values(".$value.")";
	}
	//echo $sql;
	return mysql_query($sql);
}
?>