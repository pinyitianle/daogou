<?php

include_once('include/function.php');
include_once('include/sql.func.php');
include_once('config.php');

//include('parame.php');

$url  = $_SERVER["HTTP_REFERER"];   //获取完整的来路URL

$ip = $_SERVER["REMOTE_ADDR"];

if($ip && ($ip == '42.120.19.219' || $ip == '115.29.40.84'))
{

	$command = $_GET['command'];

	$model = $_GET['model'];

	$sqlType = $_GET['type'];

	$now = date("Y-m-d H:i:s");


	$successed_num = 0;
	$failed_num = 0;

	if($model == 'DataArrayPost')
	{

		$title =$_POST['ItemName'];
		$itemid =$_POST['ItemId'];
		$itemurl =$_POST['ItemUrl'];
		$oprice =$_POST['OriginPrice'];
		$nprice =$_POST['PresentPrice'];
		$st =$_POST['StartTime'];
		$act =$_POST['act'];
		$lt =$_POST['lt'];
		$ww =$_POST['ww'];
		$pic =$_POST['ItemPic'];
		$volume =$_POST['MonthSold'];
		$commission_rate =$_POST['Commission'];
		$et =$_POST['EndDate'];
		$remark =$_POST['Remarks'];
		$cat = $_POST['cat'];
		$rank = $_POST['rank'];
		$test = $_POST['test'];


		if($command == 'singleItem')
		{
			$prorow=get_list_by_id('pro','iid',$itemid);

			if($prorow['islock']!='1')
			{
				if($sqlType == "in")
				{
					$insert_Sql="insert into fstk_pro (`title`, `oprice`, `nprice`, `pic`, `st`, `et`, `type`, `cat`, `ischeck`, `link`, `rank`, `num`, `slink`, `ww`, `snum`, `xujf`, `postdt`, `zk`, `iid`, `volume`, `content`, `remark`, `nick`, `reason`, `carriage`, `commission_rate`, `last_modify`, `click_num`, `phone`, `act_from`,`shopshow`,`shopv`) VALUES ('{$title}',{$oprice},{$nprice},'{$pic}','{$st}','{$et}',{$lt},{$cat},1,'{$itemurl}',{$rank},0,'','{$ww}',0,0,'{$now}',0,'{$itemid}',{$volume},'singleArrayTransInsert','{$remark}','{$ww}','',1,{$commission_rate},'$now',1,12345,{$act},1,1) ON DUPLICATE KEY UPDATE last_modify=now(),title='{$title}',nprice={$nprice},type={$lt},st='{$st}',et='{$et}',rank={$rank};";
				}

				if($sqlType == "re")
				{
					$insert_Sql="replace into fstk_pro (`title`, `oprice`, `nprice`, `pic`, `st`, `et`, `type`, `cat`, `ischeck`, `link`, `rank`, `num`, `slink`, `ww`, `snum`, `xujf`, `postdt`, `zk`, `iid`, `volume`, `content`, `remark`, `nick`, `reason`, `carriage`, `commission_rate`, `last_modify`, `click_num`, `phone`, `act_from`,`shopshow`,`shopv`) VALUES ('{$title}',{$oprice},{$nprice},'{$pic}','{$st}','{$et}',{$lt},{$cat},1,'{$itemurl}',{$rank},0,'','{$ww}',0,0,'{$now}',0,'{$itemid}',{$volume},'singleArrayTransReplace','{$remark}','{$ww}','',1,{$commission_rate},'$now',1,12345,{$act},1,1);";
				}

				if($test)
				{
					echo $insert_Sql;
				}

				try{

					if($GLOBALS['conn']->query($insert_Sql)==true)
					{
						$return = array(
							'result'=>'success',
							'success'=>1,
							'fail'=>0,
						);
					}
				}
				catch(Exception $e)
				{
					print $e->getMessage();
				}

			}
		}

		if($command == 'multiItem')
		{

			foreach($itemid as $k=>$v)
			{

				$prorow=get_list_by_id('pro','iid',$itemid[$k]);

				if($prorow['islock']!='1')
				{

					if($sqlType == "in")
					{
						$insert_Sql="insert into fstk_pro (`title`, `oprice`, `nprice`, `pic`, `st`, `et`, `type`, `cat`, `ischeck`, `link`, `rank`, `num`, `slink`, `ww`, `snum`, `xujf`, `postdt`, `zk`, `iid`, `volume`, `content`, `remark`, `nick`, `reason`, `carriage`, `commission_rate`, `last_modify`, `click_num`, `phone`, `act_from`,`shopshow`,`shopv`) VALUES ('{$title[$k]}',{$oprice[$k]},{$nprice[$k]},'{$pic[$k]}','{$st[$k]}','{$et[$k]}',{$lt[$k]},{$cat[$k]},1,'{$itemurl[$k]}',{$rank[$k]},0,'','{$ww[$k]}',0,0,'{$now}',0,'{$itemid[$k]}',{$volume[$k]},'multiArrayTransInsert','{$remark[$k]}','{$ww[$k]}','',1,1,'$now',1,12345,{$act[$k]},1,1) ON DUPLICATE KEY UPDATE last_modify=now(),st='{$st[$k]}',et='{$et[$k]}',nprice={$nprice[$k]};";
					}

					if($sqlType == "re")
					{
						$insert_Sql="replace into fstk_pro (`title`, `oprice`, `nprice`, `pic`, `st`, `et`, `type`, `cat`, `ischeck`, `link`, `rank`, `num`, `slink`, `ww`, `snum`, `xujf`, `postdt`, `zk`, `iid`, `volume`, `content`, `remark`, `nick`, `reason`, `carriage`, `commission_rate`, `last_modify`, `click_num`, `phone`, `act_from`,`shopshow`,`shopv`) VALUES ('{$title[$k]}',{$oprice[$k]},{$nprice[$k]},'{$pic[$k]}','{$st[$k]}','{$et[$k]}',{$lt[$k]},{$cat[$k]},1,'{$itemurl[$k]}',{$rank[$k]},0,'','{$ww[$k]}',0,0,'{$now}',0,'{$itemid[$k]}',{$volume[$k]},'multiArrayTransReplace','{$remark[$k]}','{$ww[$k]}','',1,1,'$now',1,12345,{$act[$k]},1,1);";
					}

					if($test)
					{
						echo $insert_Sql;
					}

					if($GLOBALS['conn']->query($insert_Sql)==true)
					{
						$success_num++;
					}else
					{
						$failed_num++;
					}

				}
			}

			$return = array(

				'result'=>'success',
				'success'=>$success_num,
				'fail'=>$failed_num,
			);
		}

	}


	if($model == 'DataJsonPost')
	{

		//echo "1";

		$jsonParame = $_POST['itemJson'];

		$itemArray = json_decode($jsonParame,true);


		foreach($itemArray as $v)
		{

			print_r($itemArray);
			echo $v['ItemName'];

			$title = iconv("utf-8", "gb2312",$v['ItemName'] );
			$ww = iconv("utf-8", "gb2312",$v['Wangwang'] );
			$remark = iconv("utf-8", "gb2312",$v['Remarks'] );


			$test = $v['test'];

			$prorow=get_list_by_id('pro','iid',$v[ItemId]);

			if($prorow['islock']!='1')
			{

				if($sqlType == "in")
				{
					$insert_Sql="insert into fstk_pro (`title`, `oprice`, `nprice`, `pic`, `st`, `et`, `type`, `cat`, `ischeck`, `link`, `rank`, `num`, `slink`, `ww`, `snum`, `xujf`, `postdt`, `zk`, `iid`, `volume`, `content`, `remark`, `nick`, `reason`, `carriage`, `commission_rate`, `last_modify`, `click_num`, `phone`, `act_from`,`shopshow`,`shopv`) VALUES ('{$title}',{$v[OriginPrice]},{$v[PresentPrice]},'{$v[ItemPic]}','{$v[StartTime]}','{$v[EndDate]}',{$v[ActivityLowerType]},{$v[ItemType]},1,'{$v[ItemUrl]}',{$v[ListOrder]},0,'','{$ww}',0,0,'{$now}',0,'{$v[ItemId]}',{$v[MonthSold]},'JsonTransInsert','{$v[Remarks]}','{$ww}','',1,$v[commission_rate],'$now',1,12345,{$v[ActivityType]},1,1) ON DUPLICATE KEY UPDATE last_modify=now(),st='{$v[StartTime]}',et='{$v[EndDate]}',nprice={$v[PresentPrice]};";
				}

				if($sqlType == "re")
				{
					$insert_Sql="replace into fstk_pro (`title`, `oprice`, `nprice`, `pic`, `st`, `et`, `type`, `cat`, `ischeck`, `link`, `rank`, `num`, `slink`, `ww`, `snum`, `xujf`, `postdt`, `zk`, `iid`, `volume`, `content`, `remark`, `nick`, `reason`, `carriage`, `commission_rate`, `last_modify`, `click_num`, `phone`, `act_from`,`shopshow`,`shopv`) VALUES ('{$title}',{$v[OriginPrice]},{$v[PresentPrice]},'{$v[ItemPic]}','{$v[StartTime]}','{$v[EndDate]}',{$v[ActivityLowerType]},{$v[ItemType]},1,'{$v[ItemUrl]}',{$v[ListOrder]},0,'','{$ww}',0,0,'{$now}',0,'{$v[ItemId]}',{$v[MonthSold]},'JsonTransReplace','{$v[Remarks]}','{$ww}','',1,$v[commission_rate],'$now',1,12345,{$v[ActivityType]},1,1)";
				}

				if($test)
				{
					echo $insert_Sql;
				}

				if($GLOBALS['conn']->query($insert_Sql)==true)
				{
					$success_num++;
					echo $insert_Sql;
				}else
				{
					echo $insert_Sql;
					$failed_num++;
				}

			}
		}

		$return = array(

			'result'=>'success',
			'success'=>$success_num,
			'fail'=>$failed_num,
		);

	}

}
else{
	$return=array(
		'result'=>'fail',
		'message'=>'this reply must call from limited server!'
	);
}

echo "<div class='callback_info'>".json_encode($return)."</div>";
echo $insert_Sql;
?>