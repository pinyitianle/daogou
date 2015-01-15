<?php
$tao=1;
$one=1;
include_once('../admin_config.php');
$proinfo=get_list_by_id('taocode','id','1');

?>
<?php include_once('../head.php');?>
<div class="pro_detail">
	<table class="data" width="100%">
		<tbody>
		<tr class="trtop">
			<td colspan='4' class="tdtop">淘点金管理</td>
		</tr>
		<tr>
			<td class="left">是否启用淘点金:</td>
			<td>
				<?php
				if($proinfo['isusing']=='1'){
					echo "已启用";
				}else if($proinfo['isusing']=='2'){
					echo "未启用";
				}



				?>

			</td>
		</tr>
		<tr>
			<td class="left">淘点金代码：</td>
			<td><?=$proinfo['taocode']?></td>
		</tr>

		<tr>
			<td class="left">&nbsp;</td>
			<td><a href="detail.php" style="padding: 5px;background: #887938;color: #FFF;border-radius: 5px;margin-left: 10px;">修改</a></td>
		</tr>
		</tbody>
	</table>
</div>
<?php include_once '../foot.php';?>
</div>

</body>
</html>