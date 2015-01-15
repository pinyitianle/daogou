<?php
if(!$_COOKIE['un']){
	echo "<script>window.location.href='/admin/login.php'</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>管理首页 - 万人网联盟</title>
	<meta name="description" content="淘宝网购物首选优站,为淘宝会员提供当日淘宝网特价商品,每天更新3次,女装,男装,家居,母婴,鞋包,美妆应有尽有"/>
	<meta name="keywords" content="淘宝优站、优站、特价、U站、淘宝网、9.9、包邮、特惠、淘宝网购物、女装、男装、鞋包、vip专享U站"/>
	<script type="text/javascript" src="/assets/javascripts/jquery-1.7.1.min.js" ></script>
	<script type="text/javascript" src="/assets/javascripts/switch.js" ></script>
	<link type="text/css" rel="stylesheet" href="/assets/stylesheets/default.css" />
</head>
<body>
<div class="admin">
	<div class="header">
		<div class="headPlacard">
			<div class="headPlacardIn">
				<div class="placardNavigation">
					welcome<input type="hidden" value="<?=SiteUrl?>/admin/pro/index.php" id="deurl"/>
					<span>|</span>
					<a href="/admin/help.php" target="_blank">功能介绍</a>
					<span>|</span>
					<a href="/admin/login.php?cmd=out">退出</a>
				</div>
			</div>
		</div>
		<div class="top">
			<div class="top_nav">
				<?php if($_SESSION['admin']){?><div id="profile"><b><?php echo $_SESSION['admin'];?></b> <a href="login.php?cmd=out">退出</a></div><?php }?>
				<ul class="navigation">
					<?php
					if(is_array($nav)){
						foreach($nav as $v){
							$active=$v['active']?' class="active"':'';
							?>
							<li <?php echo $active?>>
								<a href="<?php echo $v['link']?>"><?php echo $v['name'] ?></a>
							</li>
						<?php
						}
					}
					?>
				</ul>
				<div class="search"><input type="text" value="" name='q' class="search_text" id='q'/><input type="button" class="search_btn" onclick="doSearch()" /></div>
				<?php if(!$nonav){?>
					<div class="xl">
						<p>管 理</p>
						<ul>
							<?php 	foreach($nav_xl as $k){
								if($k['active']){
									$xl_active=$k['xl_active']?' class="xl_active"':'';
									echo '<li '.$xl_active.'><a href="'.$k['link'].'">'.$k['name'].'</a></li>';
								}
							}
							?>
						</ul>
					</div>
				<?php
				}
				?>

			</div>
		</div>
	</div>
	<script type="text/javascript">
		function doSearch(){
			window.location=document.getElementById('deurl').value+'?q='+document.getElementById('q').value;
		}
	</script>