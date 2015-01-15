<?php
$siteif=1;
$one=1;
include_once('../admin_config.php');
$where='';
if(request('type')){$where.='where type='.request('type');}
$arts=get_list('fstk_siteinfoone','',$where);
include_once('../head.php');?>
<div class="link_tb">
	<table width="100%">
		<thead>
		<tr class="opop trtop">
			<th colspan="5">
				<?php
				foreach($sitetypeshow as $k=>$v){
					?>
					<a <?php if(request('type')==$k){echo "class='pittch'";}?> href="<?=SiteUrl?>/admin/siteinfo/index.php?type=<?=$k?>"><?=$v?></a>&nbsp;&nbsp;
				<?php
				}
				?>
			</th>
		</tr>
		<tr>
			<th style="width:250px;">类型<br/><i>type</i></th>
			<th>内容<br/><i>content</i></th>
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
					<td><?php showtype($v['type'])?></td>
					<td><?php if($v['type']=='9'){ showcon($v['content']);}else{echo $v['content'];}?></td>
					<td>
						<a href="/admin/siteinfo/detail.php?id=<?=$v['id']?>">修改</a>
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
