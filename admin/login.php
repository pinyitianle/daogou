<?php
include 'admin_config.php';
if(getpost('adminname')==$site_zh && getpost('adminpsw')==$site_pwd){
	setcookie("un",base64_encode(getpost('adminname')),time()+36000,"/","");
	header('Location:index.php');
}

if(request('cmd')=='out'){
	setcookie("un","",time()-36000,"/","");
	header('Location:login.php');
}
if($_COOKIE['un']){
	header('Location:index.php');
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>管理首页 - 万人网联盟</title>
	<meta name="description" content="淘宝网购物首选优站,为淘宝会员提供当日淘宝网特价商品,每天更新3次,女装,男装,家居,母婴,鞋包,美妆应有尽有"/>
	<meta name="keywords" content="淘宝优站、优站、特价、U站、淘宝网、9.9、包邮、特惠、淘宝网购物、女装、男装、鞋包、vip专享U站"/>
	<link type="text/css" rel="stylesheet" href="<?=SiteUrl?>/assets/stylesheets/default.css" />
</head>
<body background="<?=SiteUrl?>/assets/images/admin/login_bg.png" style="background-position: center top;">
<div class="login_bg">
	<div class="loginDiv">
		<h2>欢迎您登录<?=$site_name?>：</h2>
		<form name="adminlogin" method="post" action="">
			<div class="loginTips">
				<input type="text" name="adminname" class="adminname"/>
				<input type="password" name="adminpsw" class="adminpsw" />
				<input type="submit" name="submit" value=" " class="adminbtn" />
			</div>
		</form>
		<h3></h3>
	</div>
</div>
</body>
</html>