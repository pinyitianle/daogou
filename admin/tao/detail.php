<?php
$tao=1;
$two=1;
include_once('../admin_config.php');
$proinfo=get_list_by_id('taocode','id','1');
$cmd=$_GET['cmd'];
if($cmd=='update'){
	$art=array(
		'isusing'=>getpost('isusing'),
		'taocode'=>getpost('taocode'),
	);
	if($cmd == "update"){
		if(autoExecute(PREFIX.'taocode', $art, 'update','where id=1')){
			header('Location:index.php');
		}else{
			echo '修改失败';
		}
	}
}


?>
<?php include_once('../head.php');?>
<div class="pro_detail">
	<form action="?cmd=update" method="post" name="linkform" enctype="multipart/form-data">
		<table class="data" width="100%">
			<tbody>
			<tr class="trtop">
				<td colspan='4' class="tdtop">淘点金管理</td>
			</tr>
			<tr>
				<td class="left">是否启用淘点金:</td>
				<td>
					<input type="radio" value="1" name="isusing" <?php if($proinfo['isusing']=='1'){echo "checked=checked";}?>/>是
					<input type="radio" value="2" name="isusing" <?php if($proinfo['isusing']=='2'){echo "checked=checked";}?>/>否
				</td>

			</tr>
			<tr>
				<td class="left">淘点金代码：</td>
				<td>
					<textarea name="taocode" style="width: 800px;height: 240px;"><?=$proinfo['taocode'] ?>
					</textarea>
				</td>
			</tr>
			<tr>
				<td class="left">&nbsp;</td>
				<td ><input type="submit" name="submit" value=" 提 交 " class="btn" /></td>
			</tr>
			</tbody>
		</table>
	</form>
</div>
<div class="clear"></div>
<?php include_once '../foot.php';?>
</div>

</body>
</html>