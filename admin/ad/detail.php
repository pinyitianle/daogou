<?php
$ad=1;
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
		'cat'=>getpost('cat'),
		'title'=>getpost('title'),
		'st'=>getpost('st'),
		'et'=>getpost('et'),
	);
	if($cmd == "mod"){
		if(!$id){$id=getpost('id');}
		if(autoExecute(PREFIX.'ad', $art, 'update','where id='.$id)){
			header('Location:index.php');
		}else{
			echo '修改失败';
		}
	}else{
		if(autoExecute(PREFIX.'ad', $art, 'insert')){
			header('Location:index.php');
		}else{
			echo '添加失败.';
		}
	}
}
if($cmd == "mod"){$proinfo=get_list_by_id('ad','id',$id);}
?>
<?php include_once('../head.php');?>
<div class="pro_detail">
	<form action="" method="post" name="linkform" enctype="multipart/form-data">
		<table class="data" width="100%">
			<tbody>
			<tr class="trtop">
				<td colspan='4' class="tdtop"><?php if($cmd == "mod"){echo "广告修改";}else{echo "广告添加";}?></td>
			</tr>
			<tr>
				<td class="left">
					图片：
					<input type="hidden" value="<?php echo $proinfo['id'];?> " name="id" class="id"/>
					<input type="hidden" value="<?php echo $cmd;?> " name="cmd" class="cmd"/>
				</td>

				<td><input type="text" id="pic" name="pic" class="pic" value="<?php echo $proinfo['src']?>" /></td>
				<td class="left">链接：</td>
				<td><input type="text" id="link" class="link" name="link" value="<?php echo $proinfo['link']?>" /></td>
			</tr>
			<tr >
				<td class="left">类型：</td>
				<td>
					<select name="cat">
						<option value="101" <?php if($proinfo['cat']=='101'){echo "selected='selected'";}?>>首页轮播</option>
						<option value="100" <?php if($proinfo['cat']=='100'){echo "selected='selected'";}?>>首页中部广告</option>
					</select>
				</td>
				<td class="left">排序：</td>
				<td><input type="text" name="rank" class="rank" id="rank" value="<?php echo $proinfo['rank']?>" /></td>
			</tr>
			<tr>
				<td class="left">开始日期：</td>
				<td><input type="text" name="st" id="st" class="Wdate" value="<?php if($proinfo['st']){echo $proinfo['st'];}else{echo date('Y-m-d');}?>" /></td>
				<td class="left">结束日期：</td>
				<td><input type="text" name="et" id="et" class="Wdate" value="<?php if($proinfo['et']){echo $proinfo['et'];}else{echo date('Y-m-d',86400*7+time());}?>" /></td>

			</tr>
			<tr>
				<td class="left">备注：</td>
				<td><input type="text" id="remark" name="remark" class="remark" value="<?php echo $proinfo['remark']?>" /></td>
				<td class="left">标题：</td>
				<td><input type="text" id="title" class="title" name="title" value="<?php echo $proinfo['title']?>" /></td>
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