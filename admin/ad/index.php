<?php
$ad=1;
$one=1;
include_once('../admin_config.php');
$where='';
if(request('cat')){$where.='where cat='.request('cat');}
$arts=get_list('fstk_ad','',$where.' order by rank asc');
if(request('cmd')=='del'){
	$delid=request('id');
	mysql_del('ad','where id='.$delid);
	header('Location:index.php');
}
?>
<?php include_once('../head.php');?>
<div class="link_tb">
	<table width="100%">
		<thead>
		<tr class="opop trtop">
			<th colspan="5">
				<a <?php if(request('cat')=='101'){echo "class='pittch'";}?> href="/admin/ad/index.php?cat=101">首页轮播</a>&nbsp;&nbsp;
				<a <?php if(request('cat')=='100'){echo "class='pittch'";}?> href="/admin/ad/index.php?cat=100">首页中部广告</a>&nbsp;&nbsp;&nbsp;&nbsp;
			</th>
		</tr>
		<tr>
			<th style="width:250px;">缩略图<br/><i>Thumbnail</i></th>
			<th>备注<br/><i>Remark</i></th>
			<th>点击量<br/><i>Click</i></th>
			<th>到期日期<br/><i>End Date</i></th>
			<th>操作<br/><i>Operate</i></th>
		</tr>
		</thead>
		<tbody>
		<?php
		$numd=1;
		if($arts){
			foreach($arts as $v){
				?>
				<tr>
					<td><a href="<?php echo $v['link']?>" target="_blank"><img style="width:200px;height:80px;" src="<?php echo $v['src']?>" /></a></td>
					<td><?php echo $v['remark']?></td>
					<td><?php echo (int)$v['click_num']?></td>
					<td><?php echo $v['et']?></td>
					<td>
						<a href="detail.php?cmd=mod&id=<?php echo $v['id']?>">修改</a>
						<a href="index.php?cmd=del&id=<?php echo $v['id']?>" onclick="return confirm('确认删除该条记录？删除后不可恢复！')">删除</a>
					</td>
				</tr>
				<?php
				$numd++;}}
		?>
		</tbody>
	</table>
</div>
<?php include_once '../foot.php';?>
</div>

</body>
</html>