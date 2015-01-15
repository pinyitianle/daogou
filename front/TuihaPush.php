<?php
include_once('include/function.php');
include_once('include/sql.func.php');
include_once('include/config.php');
$today = date("Y-m-d");
$rows=get_list('fstk_pro','','where type=9 and st<="'.$today.'" and et>="'.$today.'"');
if($rows){
	foreach($rows as $row){
		if($row['nprice']<10){
			$type='2';
		}else if($row['nprice']<20 && $row['nprice']>=10){
			$type='3';
		}else if($row['nprice']<30 && $row['nprice']>=20){
			$type='5';
		}else if($row['nprice']<40 && $row['nprice']>=30){
			$type='7';
		}else if($row['nprice']>=40){
			$type='4';
		}
		autoExecute(PREFIX.'pro', array(et=>date('Y-m-d',86400*7+time()),type=>$type,rank=>'498',act_from=>$site_autotrans), 'update','where id='.$row['id']);
	}
}