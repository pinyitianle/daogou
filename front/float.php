<div class="jianyi">
	<div class="tit"><a href="<?=SiteUrl?>" style="color:#FFF;text-decoration:none;">全部商品</a></div>
	<ul class="pl_fl">
		<?php
		foreach($cats as $k=>$v){
			?>
			<li><a href="<?=SiteUrl?>/front/list.php?cat=<?=$k?>"><?=$v?></a></li>
		<?php
		}
		?>
		<span class="clear"></span>
	</ul>
	<div class="pl_dh"> <a href="<?=SiteUrl?>/front/tomorrow.php">明日预告</a>
		<a href="<?=SiteUrl?>/front/list.php?act_from=1">优品特惠</a>
		<a href="<?=SiteUrl?>/front/list.php?act_from=2">限量抢购</a>
		<a href="<?=SiteUrl?>/front/list.php?act_from=3">实惠推荐</a>
		<a href="<?=SiteUrl?>/front/baoming.php" class="ssssyl" target="_blank">商家报名</a>
	</div>
	<div style="border-bottom:4px solid rgb(37,137,167);clear:both;"></div>
</div>