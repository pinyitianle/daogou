<?php
$lik=1;
$one=1;
include_once('../admin_config.php');
$page=request('page')?request('page'):1;
$page_size=20;
$where='';
if(request('cat')){$where.='where cat='.request('cat');}
$links=get_list('fstk_link','',$where.' order by rank asc limit '.($page-1)*$page_size.','.$page_size);
$num=get_list_count('link',$where);
if(request('cmd')=='del'){
	$delid=request('id');
	mysql_del('link','where id='.$delid);
	header('Location:index.php');
}
$mutipage_html=multi($num,$page_size,$page,SiteUrl."/admin/friendlink/index.php?"."q=".urlencode(request('q'))."&".getPageStr('page,q'), "");
?>
<?php include_once('../head.php');?>
<div class="link_tb">
	<table width="100%">
		<thead>
		<tr class="opop trtop" >
			<th colspan="6">
				友链管理
			</th>
		</tr>
		<tr>
			<th width="15%">站点</th>
			<th width="30%">备注</th>
			<th width="40%">链接</th>
			<th width="5%">排序</th>
			<th width="10%">操作</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$numd=1;
		if($links){
			foreach($links as $link){
				?>
				<tr style="<?php if($numd%2==1){ echo "background: #ededed;";}?>">
					<td><a href="<?php echo $link['link']?>"><?php echo $link['src']?></a></td>
					<td ><?php echo $link['remark']?></td>
					<td ><?php echo $link['link']?></td>
					<td><?php echo $link['rank']?></td>
					<td>
						<a href="detail.php?cmd=mod&id=<?php echo $link['id']?>">修改</a>
						<a href="index.php?cmd=del&id=<?php echo $link['id']?>">删除</a>
					</td>
				</tr>
				<?php
				$numd++;}}
		?>
		<tr style="height:50px;"><td colspan="6" class="page"><div class="pagination">
					<?php echo $mutipage_html?>
				</div></td></tr>
		</tbody>
	</table>
</div>
<?php include_once '../foot.php';?>
</div>

</body>
</html>