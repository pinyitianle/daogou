<?php
$pro=1;
$two=2;
include_once('../admin_config.php');
$cmd=request('cmd');
if(!$cmd){$cmd=getpost('cmd');}
$id=request('id');
$page=request('page');
if(getpost('submit',1)){
	$pic=getpost('pic');
	$bigpic=str_replace('_310x310.jpg','',$pic);
	$bigpic=str_replace('_b.jpg','',$bigpic);
	$num = getpost('num');
	if(!$num){$num=1;}
	$art=array(
		'pic'=>$pic,
		'cat'=>getpost('cat'),
		'iid'=>getpost('proid'),
		'oprice'=>getpost('oprice'),
		'nprice'=>getpost('nprice'),
		'st'=>getpost('st'),
		'et'=>getpost('et'),
		'act_from' => getpost('act_from'),
		'rank'=>(int)getpost('rank'),
		'title'=>getpost('title'),
		'link'=>getpost('link'),
		'slink'=>getpost('slink'),
		'volume'=>getpost('volume'),
		'last_modify'=>date('Y-m-d H:i:s'),
		'xujf'=>(int)getpost('xujf'),
		'remark'=>getpost('remark'),
		'type'=>getpost('type'),
		'content'=>addslashes(getpost('content')),
		'zk'=>10*getpost('nprice')/getpost('oprice'),
		'carriage'=>(int)getpost('carriage'),
		'commission_rate'=>(float)getpost('commission_rate'),
		'ischeck'=>getpost('ischeck'),
	);
	if($cmd == "mod" && getpost("update-rank")){
		$art['postdt'] =  date('Y-m-d H:i:s');
		$art['st']=date('Y-m-d');
		$art['et']=date('Y-m-d',86400*7+time());
	}
	if($cmd == "add"){
		$art['postdt'] =  date('Y-m-d H:i:s');
		$art['st']=getpost('st');
		$art['et']=getpost('et');
	}
	if($cmd == "mod"){
		if(!$id)
		{
			$id=getpost('id');
		}
		if(autoExecute(PREFIX.'pro', $art, 'update','where id='.$id)){
			header('Location:index.php');
		}else{
			echo '修改失败';
		}
	}else{
		$tempinfo = get_list_by_id("pro", "iid", $art['iid']);
		if($tempinfo){
			echo "<script>alert('添加失败，商品已经存在了哦，亲！！！')</script>";
		}else{
			if(autoExecute(PREFIX.'pro', $art, 'insert')){
				header('Location:index.php');
			}else{
				echo '添加失败.';
			}
		}
	}
}
if($cmd == "mod"){$proinfo=get_list_by_id('pro','id',$id);}

?>
<?php include_once('../head.php');?>
<div class="pro_detail">
	<form action="" method="post" name="proform" enctype="multipart/form-data" >
		<table class="data" width="100%">
			<tbody>
			<tr class="trtop">
				<td colspan='4' class="tdtop"><?php if($cmd == "mod"){echo "商品修改";}else{echo "商品添加";}?></td>
			</tr>

			<tr>
				<td class="left">宝贝ID：
					<input type="hidden" name="cmd" value="<?php if($cmd){echo $cmd;}else{echo "add";}?>" />
					<input type="hidden" name="id" value="<?php echo $proinfo['id']?>" />
				</td>
				<td><input type="text" id="proid" class="proid" name="proid"  value="<?php echo $proinfo['iid']?>" /><input type="button" class="getProInfo" id='getProInfo' value="获取" /></td>
				<td class="left">店铺链接：</td>
				<td><input type="text" name="slink" class="slink" id="slink" value="<?php echo $proinfo['slink']?>" /></td>
			</tr>
			<tr>
				<td class="left">商品名称：</td>
				<td><input type="text" id="title" name="title" class="n title" value="<?php echo $proinfo['title']?>" /><b class="biaotou">加标头<input type="hidden" value="<?=$site_lgtit?>" class="site_lgtit" /></b></td>
				<td class="left">月销量：</td>
				<td><input type="text" id="volume" class="volume" name="volume" value="<?php echo $proinfo['volume']?>" /><b class="getvolueag">重新获取销量</b></td>
			</tr>
			<tr>
				<td class="left">活动类型：</td>
				<td>
					<select name="act_from">
						<?php
						foreach($hd_actfroms as $k=>$v){
							$c=$k==$proinfo['act_from']?' selected':'';
							echo "<option value=$k".$c.">$v</option>";
						}
						?>

					</select>
					<select name="type">
						<?php
						foreach($hd_catalogs as $k=>$v){
							$c=$k==$proinfo['type']?' selected':'';
							echo "<option value=$k".$c.">$v</option>";
						}
						?>
					</select>
					<select name="cat">
						<?php
						foreach($cats as $k=>$v){
							if($k==$proinfo['cat']){$c=' selected';}else{$c='';}
							echo "<option value=$k".$c.">$v</option>";
						}
						?>
					</select>
				</td>
				<td class="left">参加活动数量：</td>
				<td><input type="text" name="num" class="num" id="num" onkeyup="value=value.replace(/[^\d]/gi,'');" value="<?php echo $proinfo['num']?>" /></td>
			</tr>
			<tr class="duihuan"<?php if($proinfo['type']==100){echo 'style="display:table-row"';}?>>
				<td class="left">所需积分：</td>
				<td><input type="text" name="xujf" id="xujf" value="<?php echo $proinfo['xujf']?>" /></td>
				<td class="left">店铺ID：</td>
				<td><input type="text" name="sid" class="sid" id="sid" value="<?php echo $proinfo['sid']?>" /></td>
			</tr>
			<tr>
				<td class="left">商品链接：</td>
				<td>
					<input type="text" name="link" class="link" id="link" class="n" value="<?php echo $proinfo['link']?>" />
					<span class="kanyixialj">
					<?php if($proinfo['link']) echo	'<a class="kanyixia n" href="'.$proinfo['link'].'" target="_blank">看一下</a>';?>
					</span>
				</td>
				<td class="left">排序：</td>
				<td><input type="text" class="rank" name="rank" value="<?php echo $proinfo['rank']?$proinfo['rank']:500?>" /> <a class="set499">499</a> <a class="set500">500</a></td>
			</tr>
			<tr>
				<td class="left">原价：</td>
				<td><input type="text" name="oprice" class="price" id="oprice" value="<?php echo $proinfo['oprice']?>" /> 元</td>
				<td class="left">当前价：</td>
				<td><input type="text" name="nprice" class="nprice" id="nprice" value="<?php echo $proinfo['nprice']?>" /> 元</td>
			</tr>
			<tr>
				<td class="left">开始日期：</td>
				<td><input type="text" name="st" id="st"  class="Wdate" value="<?php if($proinfo['st']){echo $proinfo['st'];}else{echo date('Y-m-d');}?>" /></td>
				<td class="left">结束日期：</td>
				<td><input type="text" name="et" id="et"  class="Wdate" value="<?php if($proinfo['et']){echo $proinfo['et'];}else{echo date('Y-m-d',86400*3+time());}?>" /></td>
			</tr>
			<tr>
				<td class="left">商品图片：</td>
				<td><input type="text" name="pic" id="pic" class="n pic" value="<?php echo $proinfo['pic']?>" /><a class="jia310" href="#">加310</a></td>
				<td class="left">是否包邮：</td>
				<td><input type="radio" name="carriage" class="postage" id='carriage1' value="1" checked='checked' />包邮 <input class="nopostage" type="radio" name="carriage" id='carriage0' value="0" />不包邮</td>
			</tr>
			<tr>
				<td></td>
				<td><div class="pro-pic-list">
						<input type="hidden" id="fiveImg" name="fiveImg" />
					</div></td>
			</tr>
			<tr>
				<td class="left">备注：</td>
				<td <?php if($cmd=="add")echo "colspan='3'";?>><input type="text" name="remark" id="remark" class="n" value="<?php echo $proinfo['remark']?>" /></td>
				<?php
				if($cmd=="mod"){
					?>
					<td class="left">更新排前</td>
					<td>
						<input type="radio" name="update-rank" id="update-rank" value="1"/>排前   <input type="radio" name="update-rank" id="update-rank" checked="checked" value="0"/>不排前
					</td>
				<?php
				}?>
			</tr>
			<tr class="shiyong"<?php if($proinfo['type']==99){echo 'style="display:table-row"';}?>>
				<td class="left">商品描述：</td>
				<td colspan="3">

				</td>
			</tr>
			<tr>
				<td class="left">佣金比：</td>
				<td colspan="1">
					<input style="width: 60px;"  value="<?php echo $proinfo['commission_rate']?>"  type="text"  name="commission_rate" id="commission_rate" class="n" />%
					<a href="/view/admin/pro.php?cmd=del&id=<?php echo $proinfo['id']?>" onclick="return confirm('确认删除该条记录？删除后不可恢复！')">删除</a>
				</td>
				<td class="left">
					是否通过
				</td>
				<td>
					<input type='radio' name='ischeck' value='1' checked="checked" />通过 <input type='radio' name='ischeck' value='4'/>不通过
				</td>
			</tr>
			<tr>
				<td class="left">&nbsp;</td>
				<td class="grey"><input type="submit" name="submit" value=" 提 交 " class="btn" /> <input type="reset" value=" 重 置 " name="reset" class="btn" /></td>
				<td class="left">联系：</td>
				<td class="grey"><a target="_blank" href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo urlencode($proinfo['ww'])?>&siteid=cntaobao&status=2&charset=utf-8"><img border="0" src="http://amos.alicdn.com/realonline.aw?v=2&uid=<?php echo urlencode($proinfo['ww'])?>&site=cntaobao&s=2&charset=utf-8" alt="联系人" /><?php echo $proinfo['ww'];?></a></td>
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