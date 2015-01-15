<?php
include_once('../include/function.php');
include_once('../include/sql.func.php');
include_once('../include/config.php');

$today =  date('Y-m-d');
$page=(int)request('page')?request('page'):1;
$orderby="";
if(request('xl')){
	$orderby=" volume desc,";
}
if(request('price')){
	$orderby=" nprice asc,";
}
$prolist=get_list('fstk_pro','','where ischeck=1 and st<="'.$today.'" and et>="'.$today.'" and type!=9 and act_from!=4 order by '.$orderby.' rank asc, st desc ,postdt desc limit '.PAGE_SIZE*($page-1).','.PAGE_SIZE);
$totalnum=get_list_count('pro','where ischeck=1 and st<="'.$today.'" and et>="'.$today.'" and type!=9 and act_from!=4');
if (request('type')){
	$prolist=get_list('fstk_pro','','where ischeck=1 and st<="'.$today.'" and et>="'.$today.'" and type='.request('type').' and act_from!=4 order by '.$orderby.' rank asc, st desc ,postdt desc limit '.PAGE_SIZE*($page-1).','.PAGE_SIZE);
	$totalnum=get_list_count('pro','where ischeck=1 and st<="'.$today.'" and et>="'.$today.'" and type='.request('type').' and act_from!=4');
}
if (request('act_from')){
	$prolist=get_list('fstk_pro','','where ischeck=1 and st<="'.$today.'" and et>="'.$today.'" and act_from='.request('act_from').' and type!=9 order by '.$orderby.' rank asc, st desc ,postdt desc limit '.PAGE_SIZE*($page-1).','.PAGE_SIZE);
	$totalnum=get_list_count('pro','where ischeck=1 and st<="'.$today.'" and et>="'.$today.'" and act_from='.request('act_from').' and type!=9');
}
$q=getpost('q');
if(!$q){
	$q=request('q');
}
if($q){
	$prolist=get_list('fstk_pro','','where ischeck=1 and st<="'.$today.'" and et>="'.$today.'" and title like "%'.$q.'%" and type!=9 order by '.$orderby.' rank asc, st desc ,postdt desc limit '.PAGE_SIZE*($page-1).','.PAGE_SIZE);
	$totalnum=get_list_count('pro','where ischeck=1 and st<="'.$today.'" and et>="'.$today.'" and title like "%'.$q.'%" and type!=9');
}
if (request('cat')){
	$prolist=get_list('fstk_pro','','where ischeck=1 and st<="'.$today.'" and et>="'.$today.'" and cat='.request('cat').' and type!=9 and act_from!=4 order by '.$orderby.' rank asc, st desc ,postdt desc limit '.PAGE_SIZE*($page-1).','.PAGE_SIZE);
	$totalnum=get_list_count('pro','where ischeck=1 and st<="'.$today.'" and et>="'.$today.'" and cat='.request('cat').' and type!=9 and act_from!=4');
}

if(!request('cat') && !request('type') && !$q && !request('act_from')){
	$begin=PAGE_SIZE*($page-1)-48;
	if($begin<0){
		$begin=0;
	}
	$prolist=get_list('fstk_pro','','where ischeck=1 and st<="'.$today.'" and et>="'.$today.'" and act_from=3 and type!=9 order by '.$orderby.' rank asc, st desc ,postdt desc limit '.$begin.','.PAGE_SIZE);
	$totalnum=get_list_count('pro','where ischeck=1 and st<="'.$today.'" and et>="'.$today.'" and act_from=3 and type!=9');
}
$mutipage_html=multi($totalnum,PAGE_SIZE,$page,SiteUrl."/front/list.php?"."q=".urlencode($q)."&".getPageStr('page,q'), "");
?>
<?php
include_once 'head.php';
?>
<div class="xf-layout xf-mt">
	<div class="main_in">
		<div class="pro_list">
			<ul>
				<?php
				if($prolist){
					foreach($prolist as $k=>$v){
						if($tao_isusing=='1'){
							$newlink = '/front/tao.php?id='.$v[iid];
						}else{
							$newlink = $v['link'];
						}
						?>
						<li>
							<div class="goods_item">
								<?php
								$s='<div class="admin_edit"><a class="del" href="/admin/pro/index.php?cmd=delAsk&id='.$v['id'].'" target="_blank"></a><a class="edit" href="/admin/pro/detail.php?cmd=mod&id='.$v['id'].'" target="_blank"></a></div>';
								if($_COOKIE['un']){
									echo $s;
								}
								?>
								<p class="goods_img"><a href="<?=$newlink?>" title="<?php echo $v['title']?>" target="_blank"><img src="<?php echo $v['pic']?>" alt="<?php echo $v['title']?>" width="" height=""></a></p>
								<p class="goods_name"><i class="tmall"></i><a href="<?=$newlink?>" title="<?php echo $v['title']?>" target="_blank"><?php echo $v['title']?></a></p>
								<div class="price_sales"> <span class="promo_price fl"><em class="icon">￥</em><em class="integer"><?php echo $v['nprice']?></em></span> <em class="ems">包邮</em> <span class="sales fr gblock">售出<em><?php echo $v['volume']?></em>件</span> <a class="qgbtn fr" href="<?=$newlink?>" target="_blank"></a> </div>
								<div class="pro_fx"><div class="prt_sttime">开始时间:<?php echo $v['st']?></div><div class="fx"><div style="float:left" class="sns-widget sns-sharebtn sns-widget-ui sns-sharebtn-default" data-sharebtn="{skinType:1,type:&quot;item&quot;,key:&quot;<?php echo $v['iid']?>&quot;,comment:&quot;发现一个U站里面的宝贝超好啊！你也来看看吧！&quot;,pic:&quot;<?php echo $v['pic']?>&quot;,client_id:68,isShowFriend:false}"></div></div></div>
							</div>
						</li>
					<?php
					}}
				?>
			</ul>
			<div class="clear30"></div>
		</div>
	</div>
</div>

<div class="pagination">
	<?php echo $mutipage_html?>
</div>




<?php
include_once 'float.php';
?>
<?php
include_once 'foot.php';
?>

</div>
</body>
</html>