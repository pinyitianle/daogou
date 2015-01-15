<?php
$siteif=1;
$two=1;
include_once('../admin_config.php');
$id=$_GET['id'];
$siteinfo=get_list_by_id('siteinfoone','id',$id);
if(getpost('submit',1)){
	$art=array(
		'content'=>getpost('content'),
	);
	if(autoExecute(PREFIX.'siteinfoone', $art, 'update','where id='.$id)){
		header('Location:index.php');
	}else{
		echo '修改失败';
	}
}
?>
<?php include_once('../head.php');?>
<div class="pro_detail">
	<form action="" method="post" name="proform" enctype="multipart/form-data">
		<table class="data">
			<tr class="trtop" style="height:46px;">
				<td colspan='4' class="tdtop"><?=showtype($siteinfo[type])?></td>
			</tr>
			<tr>
				<td class="left">
					内容：</td>
				<td>
					<?php
					if($siteinfo['type']=='9'){
						?>
						<select name="content">
							<option value="1" <?php if($siteinfo['content']=='1'){echo 'selected = "selected"';}?>>优品特惠</option>
							<option value="2" <?php if($siteinfo['content']=='2'){echo 'selected = "selected"';}?>>限量抢购</option>
							<option value="3" <?php if($siteinfo['content']=='3'){echo 'selected = "selected"';}?>>实惠推荐</option>
						</select>
					<?php
					}else{
						?>
						<textarea style="width:570px;height:90px;" id="content" class="content" name="content"><?php echo $siteinfo['content']?></textarea>
					<?php
					}
					?>
				</td>
			</tr>
			<?php
			if($siteinfo['type']=='9'){
				?>
				<tr>
					<td class="left">注释：</td>
					<td>(每天自动将推哈网自助招商的商品推送到所选择的区域)</td>
				</tr>
			<?php
			}
			?>
			<tr>
				<td class="left">&nbsp;</td>
				<td  colspan="3"><input style="float:right;margin-right:50px;" type="submit" name="submit" value=" 提 交 " class="btn" /></td>
			</tr>
		</table>
	</form>
</div>
<?php include_once '../foot.php';?>
</div>
</body>
</html>