<?php
$lik=1;
$two=1;
include_once('../admin_config.php');
$cmd=request('cmd');
if(!$cmd){$cmd=getpost('cmd');}
$id=request('id');
if(getpost('submit',1)){
	$art=array(
		'src'=>getpost('pic'),
		'remark'=>getpost('remark'),
		'link'=>getpost('link'),
		'rank'=>getpost('rank'),
	);
	if($cmd == "mod"){
		if(!$id){$id=getpost('id');}
		if(autoExecute(PREFIX.'link', $art, 'update','where id='.$id)){
			header('Location:index.php');
		}else{
			echo '修改失败';
		}
	}else{
		if(autoExecute(PREFIX.'link', $art, 'insert')){
			header('Location:index.php');
		}else{
			echo '添加失败.';
		}
	}
}
if($cmd == "mod"){$proinfo=get_list_by_id('link','id',$id);}
?>
<?php include_once('../head.php');?>
<div class="pro_detail">
	<form action="" method="post" name="linkform" enctype="multipart/form-data">
		<table class="data" width="100%">
			<tbody>
			<tr class="trtop">
				<td colspan='4' class="tdtop"><?php if($cmd == "mod"){echo "友链修改";}else{echo "友链添加";}?></td>
			</tr>
			<tr>
				<td class="left">
					站点：
					<input type="hidden" value="<?php echo $proinfo['id'];?> " name="id" class="id"/>
					<input type="hidden" value="<?php echo $cmd;?> " name="cmd" class="cmd"/>
				</td>

				<td><input type="text" id="pic" name="pic" class="pic" value="<?php echo $proinfo['src']?>" /></td>
				<td class="left">链接：</td>
				<td><input type="text" id="link" class="link" name="link" value="<?php echo $proinfo['link']?>" /></td>
			</tr>
			<tr >
				<td class="left">备注：</td>
				<td><input type="text" name="remark" class="remark" id="remark" value="<?php echo $proinfo['remark']?>" /></td>
				<td class="left">排序：</td>
				<td><input type="text" name="rank" class="rank" id="rank" value="<?php echo $proinfo['rank']?>" /></td>
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