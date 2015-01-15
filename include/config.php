<?php
header('Content-type:text/html;charset=utf-8');
include "conn.php";
$table='fstk_siteinfoone';
if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$table."'"))!=1){
	header('Location:/admin/sql.php');
}


date_default_timezone_set('Asia/Shanghai');
define('PAGE_SIZE','148');
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];  //$_SERVER['DOCUMENT_ROOT']
//活动类型
$cats=array( //活动类型
	'27'=>'女装',
	'28'=>'男装',
	'21'=>'数码',
	'22'=>'美妆',
	'23'=>'鞋包',
	'24'=>'美食',
	'25'=>'母婴',
	'26'=>'居家',
	'29'=>'配饰',
	'42'=>'其他',
);


$siteinfos=get_list('fstk_siteinfoone','','');
foreach($siteinfos as $v){
	switch ($v['type']){
		case 1:
			$site_tit = $v['content'];
			break;
		case 2:
			$site_ww = $v['content'];
			break;
		case 3:
			$site_uzurl = $v['content'];
			break;
		case 4:
			$site_zh = $v['content'];
			break;
		case 5:
			$site_pwd = $v['content'];
			break;
		case 6:
			$site_pic = $v['content'];
			break;
		case 8:
			$site_lgtit = $v['content'];
			break;
		case 9:
			$site_autotrans = $v['content'];
			break;
	}
}
$taoinfo = get_list_by_id('taocode','id','1');
$tao_isusing = $taoinfo['isusing'];

?>
