<?php
header('Content-type:text/html;charset=utf-8');

include_once($_SERVER['DOCUMENT_ROOT'].'/include/sql.func.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/function.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/config.php');
$nav=array(
	array('link'=>'/admin/index.php','name'=>'管理首页','active'=>$main),
	array('link'=>'/admin/pro/index.php','name'=>'商品管理','active'=>$pro),
	array('link'=>'/admin/friendlink/index.php','name'=>'友链管理','active'=>$lik),
	array('link'=>'/admin/ad/index.php','name'=>'广告管理','active'=>$ad),
	array('link'=>'/admin/siteinfo/index.php','name'=>'信息管理','active'=>$siteif),
	array('link'=>'/admin/tao/index.php','name'=>'淘点金管理','active'=>$tao),
);
$nav_xl=array(
	array('link'=>'/admin/pro/index.php','name'=>'商品列表','active'=>$pro,'xl_active'=>$one),
	array('link'=>'/admin/pro/detail.php','name'=>'添加商品','active'=>$pro,'xl_active'=>$two),
	array('link'=>'/admin/friendlink/index.php','name'=>'友链管理','active'=>$lik,'xl_active'=>$one),
	array('link'=>'/admin/friendlink/detail.php','name'=>'添加友链','active'=>$lik,'xl_active'=>$two),
	array('link'=>'/admin/ad/index.php','name'=>'广告管理','active'=>$ad,'xl_active'=>$one),
	array('link'=>'/admin/ad/detail.php','name'=>'广告发布','active'=>$ad,'xl_active'=>$two),
	array('link'=>'/admin/siteinfo/index.php','name'=>'信息管理','active'=>$siteif,'xl_active'=>$one),
	array('link'=>'/admin/tao/index.php','name'=>'淘点金管理','active'=>$tao,'xl_active'=>$one),
	array('link'=>'/admin/tao/detail.php','name'=>'淘点金修改','active'=>$tao,'xl_active'=>$two),
);
$hd_actfroms=array(
	'1'=>'优品特惠',
	'2'=>'限量抢购',
	'3'=>'实惠推荐',
	'4'=>'秒杀专区',
);
$hd_catalogs=array(
	'2'=>'9.9专区',
	'3'=>'19.9专区',
	'5'=>'29.9专区',
	'7'=>'39.9专区',
	'4'=>'39.9以上',
	'9'=>'明日预告',
);
$sitetypeshow=array(
	'1'=>'首中标语',
	'2'=>'旺旺名称',
	'3'=>'优站域名',
	'6'=>'顶部标图',
	'8'=>'站点名称',
	'4'=>'后台账号',
	'5'=>'后台密码',
	'9'=>'推哈网自助招商对应分区移动',

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
?>