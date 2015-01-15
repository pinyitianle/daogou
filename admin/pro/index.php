<?php
$pro=1;
$one=1;
include_once('../admin_config.php');

$page=request('page')?request('page'):1;
$type=request('type');
$id=request('id');
$act_from=request('act_from');
$page_size=20;
$where="";
if($type || $act_from || request('q')){
	if($type){
		if($type=='12'){
			$where=$where." and remark='tuiha'";
		}else{
			$where=$where." and type=".$type."";
		}
	}
	if($act_from){
		$where=$where." and act_from=".$act_from." and type!=9 ";
	}
	if(request('q')){
		$where=$where." and (iid = '".request('q')."' or title like '%".request('q')."%')";
	}
	include_once('../pages.php');
	$pros=get_list(PREFIX.'pro','','where 1=1 '.$where.'  order by rank asc ,st desc, postdt desc limit '.($page-1)*$page_size.','.$page_size);
	$num=get_list_count('pro','where 1=1 '.$where);
}else{
	$pros=get_list(PREFIX.'pro','','order by last_modify desc limit 20');
	$num='0';
}

$mutipage_html=multi($num,$page_size,$page,SiteUrl."/admin/pro/index.php?"."q=".urlencode(request('q'))."&".getPageStr('page,q'), "");

if(request('cmd')=='del'){
	$delid=request('id');
	mysql_del('pro','where id='.$delid);
	header('Location:'.SiteUrl.'/admin/pro/index.php');
}
if(request('cmd')=='delAsk'){
	$delid=request('id');
	mysql_del('pro','where id='.$delid);
}
if(request('cmd')=='updaterank'){
	$updaterank_sql = "update fstk_pro set rank='500'";
	$updaterank = mysql_query($updaterank_sql);
	header('Location:index.php');

}

?>
<?php
include_once('../head.php');
?>
<div class="admin_center">
	<div class="admin_body">
		<div class="prolm">
			<div class="prolm_b">
				<ul>
					<?php
					foreach($hd_catalogs as $k=>$v){
						if($k == $type){
							echo "<li><a href='".SiteUrl."/admin/pro/index.php?type=$k' class='cur'>$v</a></li>";
						}else{
							if($k==1 || $k==2 || $k==9)
								echo "<li><a href='".SiteUrl."/admin/pro/index.php?type=$k' style='color:red;'>$v</a></li>";
							else
								echo "<li><a href='".SiteUrl."/admin/pro/index.php?type=$k'>$v</a></li>";
						}
					}

					?>
					<li><a href="/admin/pro/index.php?type=12" <?php if($type=='12'){echo 'class="cur"';}?>>推哈网招商</a></li>
					<li><a href="/admin/pro/index.php?act_from=1" <?php if($act_from=='1'){echo 'class="cur"';}?>>优品特惠</a></li>
					<li><a href="/admin/pro/index.php?act_from=2" <?php if($act_from=='2'){echo 'class="cur"';}?>>限量抢购</a></li>
					<li><a href="/admin/pro/index.php?act_from=3" <?php if($act_from=='3'){echo 'class="cur"';}?>>实惠推荐</a></li>
					<li><a href="/admin/pro/index.php?act_from=4" <?php if($act_from=='4'){echo 'class="cur"';}?>>秒杀专区</a></li>
				</ul>
			</div>
		</div>

		<div class="prolist">
			<table class="report">
				<thead><tr>
					<th><input type="checkbox" class="selall" /></th>
					<th width="30">排序</th>
					<th width="50">图片</th>
					<th width="500">商品名称</th>
					<th width="50">原价</th>
					<th width="50">当前价</th>
					<th width="50">销量</th>
					<th width="100">时间</th>
					<th width="50">佣金比</th>
					<th width="60">类型</th>
					<th width="100">联系人</th>
					<th width="50">备注</th>
					<th width="50">状态</th>
					<th width="150">操作</th></tr>
				</thead>
				<tbody>
				<?php
				$numd=1;
				if($pros){
					foreach($pros as $v){
						?>
						<tr style="border: 1px solid #DDD; <?php if($numd%2==1){ echo "background: #F8F8F8;";}?>">
							<td><input type="checkbox" name="sel[]" value="<?php echo $v['id']?>" /></td>
							<td><?php echo $v['rank']?></td>
							<td><img class="propic" src="<?php echo $v['pic']?>" style="width:50px;height:50px;"/></td>
							<td style="text-align:left;"><a href="<?php echo $v['link']?>" target="_blank"><?php echo $v['title']?></a></td>
							<td><?php echo $v['oprice']?></td>
							<td id="nprice<?php echo $v['iid'];?>"><em><?php echo $v['nprice']?></em><br/><i style="color:red"></i></td>
							<td id="volume<?php echo $v['iid'];?>"><em><?php echo $v['volume']?></em><br/><i style="color:red"></i></td>
							<td><?php if($v['ischeck'] == 0){echo $v['postdt'];}else{echo date("m-d",strtotime($v['st']))."~".date("m-d",strtotime($v['et']));}?>
								<br/>
								<?php
								if(strtotime(date('Y-m-d H:i:s')) - strtotime($v['last_modify']) <= 86400){
									echo "<p style='color:red'>今日更新</p>";
								}
								?>
							</td>
							<td><?php echo $v['commission_rate']==-1?"未知":$v['commission_rate']."%"?></td>
							<td><?php echo $hd_catalogs[$v['type']]?></td>
							<td><a href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo urlencode(iconv('gb2312','utf-8',$v['ww']))?>&siteid=cntaobao&status=1&charset=utf-8" target="_blank"><?php echo $v['ww']?></a></td>
							<td><?php echo $v['remark']?></td>
							<td><?php if(date('Y-m-d') > $v['et']){echo '已结束';} ?></td>
							<td>
								<a href="detail.php?cmd=mod&id=<?php echo $v['id']?>">修改</a>
								<a href="index.php?cmd=del&id=<?php echo $v['id']?>" onclick="return confirm('确认删除该条记录？删除后不可恢复！')">删除</a>
							</td>
						</tr>
						<?php
						$numd++;}}
				?>
				<tr>
					<td colspan="14" style="text-align:left">
						<a style="padding: 5px 10px;border-radius: 5px;background: #F9EBAE;color: #750D0D;" href="index.php?cmd=updaterank">改排序500</a>
					</td>
				</tr>
				<tr style="height:50px;"><td colspan="14" class="page"><div class="pagination">
							<?php echo $mutipage_html?>
						</div></td></tr>
				</tbody>
			</table>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php include_once '../foot.php';?>
</div>
</body>
</html>