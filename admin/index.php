<?php
$main=1;
$nonav=1;
include 'admin_config.php';
$un = $_COOKIE['un'];
if(!$un){
	header('Location:login.php');
}
$siteinfo['pronum']=get_list_count('pro','where date(et) >= curdate()');
$tdnew=get_list_count('pro','where date(postdt) = curdate()');

?>
<?php
include_once('head.php');
?>
<div class="body container_24">
	<div class="admin">
		<div class="newbie" >
			<h3>网站基本信息</h3>
			<div class="body_line"></div>
			<ul class="account">
				<li>当前商品总数：<span><a style="color:#f600ff;"><?php echo $siteinfo['pronum'];?></a></span> (未过期)</li>
				<li>今日更新：<span><a style="color:#f600ff;"><?php echo $tdnew;?></a></span> (未过期)</li>
			</ul>
			<div class="blank15"></div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?php include_once 'foot.php';?>
</body>
</html>