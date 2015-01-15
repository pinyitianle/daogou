<?php
include_once('../include/function.php');
include_once('../include/sql.func.php');
include_once('../include/config.php');


$url  = $_SERVER["HTTP_REFERER"];   //获取完整的来路URL

if($url)
{
	$str   = str_replace("http://","",$url);  //去掉http://
	$strdomain = explode("/",$str);        // 以“/”分开成数组
	$domain    = $strdomain[0];
	//echo $domain;
	if($domain == "12345r.com")
	{
		$password = $_POST['password'];

		if($password[0]==md5("daoru6886"))
		{
			//获取postid
			$clear = $_POST['clear'];
			if($clear[0])
			{
				$clear500 ="update fstk_pro set rank=500";
				$GLOBALS['conn']->query($clear500);
			}

			$now = date("Y-m-d H:i:s");
			$title =$_POST['ItemName'];
			$itemid =$_POST['ItemId'];
			$itemurl =$_POST['ItemUrl'];
			$oprice =$_POST['OriginPrice'];
			$nprice =$_POST['PresentPrice'];
			$st =$_POST['StartTime'];
			$act =$_POST['act'];
			$lt =$_POST['lt'];
			$ww =$_POST['ww'];
			$act =$_POST['act'];
			$pic =$_POST['ItemPic'];
			$volume =$_POST['MonthSold'];
			$et =$_POST['EndDate'];
			$remark =$_POST['Remarks'];
			$cat = $_POST['cat'];
			$rank = $_POST['rank'];
			$test = $_POST['test'];

			$success_num=0;
			$fail_num=0;
			foreach($itemid as $k=>$v)
			{
				$insert_Sql="insert into fstk_pro (`title`, `oprice`, `nprice`, `pic`, `st`, `et`, `type`, `cat`, `ischeck`, `link`, `rank`, `num`, `slink`, `ww`, `snum`, `xujf`, `postdt`, `zk`, `iid`, `volume`, `content`, `remark`, `nick`, `reason`, `carriage`, `commission_rate`, `last_modify`, `click_num`, `phone`, `act_from`,`shopshow`,`shopv`) VALUES ('{$title[$k]}',{$oprice[$k]},{$nprice[$k]},'{$pic[$k]}','{$st[$k]}','{$et[$k]}',{$lt[$k]},{$cat[$k]},1,'{$itemurl[$k]}',{$rank[$k]},0,'','{$ww[$k]}',0,0,'{$now}',0,'{$itemid[$k]}',200,'','{$remark[$k]}','{$ww[$k]}','',1,1,'$now',1,12345,{$act[$k]},1,1) ON DUPLICATE KEY UPDATE last_modify=now(),nprice={$nprice[$k]};";
				if($test)
				{
					echo $insert_Sql;
				}
				if(mysql_query($insert_Sql)==true)
				{
					$success_num++;
				}else
				{
					$fail_num++;
				}
			}

			$return = array(
				'success'=>$success_num,
				'fail'=>$fail_num
			);

			echo "<div class='callback_info'>".json_encode($return)."</div>";		//echo $insert_Sql;
			//autoExecute(PREFIX.'big_link', array('src'=>getpost('src'),'link'=>getpost('link'),'type'=>getpost('type'),'rank'=>(int)getpost('rank')), 'insert');

		}else
		{
			echo "<div class='callback_info'>wrongpassword</div>";
		}
	}
	else
	{
		echo "<div class='callback_info'>requestillegal</div>";
	}
}else
{
	echo "no";
}








?>