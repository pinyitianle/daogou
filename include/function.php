<?php
function halt_js($str){
	echo"<script language='javascript'>alert('".addslashes($str)."');</script>";
	exit();
}

function reload_js($str,$url){
	if($str){echo "<script language='javascript'>alert('".addslashes($str)."');</script>";}
	if(is_numeric($url)){
		echo "<script language='javascript'>window.history.go(".$url.");</script>";
	}else if($url){
		echo "<script language='javascripmultit'>window.location='".addslashes($url)."';</script>";
	}
	//exit();
}
// 获取请求参数
function request($str,$iss=false){
	$a = htmlspecialchars($_GET[$str]);
	if($iss){
		//$a = $_GET[$str];
		if($a ){
			return true;
		}else{
			return false;
		}
	}
	return trim($a);
}
// 获取Post参数
function getpost($str,$iss=false){
// 	$a = htmlspecialchars($_POST[$str]);
// 	if($iss){
// 		if($a){
// 			return true;
// 		}else{
// 			return false;
// 		}
// 	}
	return trim($_POST[$str]);
}


function mysubstr($str, $len, $append) {
	if(strlen($str)<$len){
		return $str;
	}
	$tmpstr = "";
	$strlen = $len;
	for($i = 0; $i < $strlen; $i++) {
		if(ord(substr($str, $i, 1)) > 0xa0) {
			$tmpstr .= substr($str, $i, 2);
			$i++;
		} else
			$tmpstr .= substr($str, $i, 1);
	}
	if($append){$tmpstr.=$append;}
	return $tmpstr;
}
//分页
function multi($num,$perpage,$curpage,$mpurl) {
	$multipage = '';
	if($num > $perpage) {
		$page = 9;
		$offset = 4;
		$pages = @ceil($num / $perpage);
		if($page >$pages) {
			$from = 1;
			$to = $pages;
		}else {
			$from = $curpage -$offset;
			$to = $curpage +$page -$offset -1;
			if($from <1) {
				$to = $curpage +1 -$from;
				$from = 1;
				if(($to -$from) <$page &&($to -$from) <$pages) {
					$to = $page;
				}
			}elseif($to >$pages) {
				$from = $curpage -$pages +$to;
				$to = $pages;
				if(($to -$from) <$page &&($to -$from) <$pages) {
					$from = $pages -$page +1;
				}
			}
		}
		$multipage = ($curpage -$offset >1 &&$pages >$page ?'<a href="'.$mpurl.'">第一页</a> ': '').($curpage >1 ?'<a class="page-prev" href="'.$mpurl.'&page='.($curpage -1).'"><b class="icon"></b>上一页</a>': '<span class="page-start"><span><b class="icon"></b>上一页</span></span>');
		for($i = $from;$i <= $to;$i++) {
			$multipage .= $i == $curpage ?'<span class="page-cur">'.$i.'</span> ': (($i==1)?'<a href="'.$mpurl.'">'.$i.'</a> ':'<a href="'.$mpurl.'&page='.$i.'">'.$i.'</a> ');
		}
		$multipage .= ($curpage <$pages ?'<a class="page-next"  href="'.$mpurl.'&page='.($curpage +1).'">下一页<b class="icon"></b></a>': '<span class="page-end"><b class="icon"></b>下一页</span>');



		return $multipage;
	}
	return $multipage;
}
function get_word($html,$star,$end){
	$pattern3 = '/'.$star.'(.*?)'.$end.'/s';
	preg_match_all($pattern3, $html, $match2);
	$word= $match2[1][0];
	return $word;
}

function get_url_content($url) {
// 	$contents=file_get_contents($url);
// 	if($contents){
// 		return $contents;
// 	}elseif(function_exists("curl_init")){
// 		$ch = curl_init();
// 		curl_setopt($ch, CURLOPT_URL, $url);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
// 		$contents = curl_exec($ch);
// 		curl_close($ch);
// 		return $contents;
// 	}

	$parameter=array("para2"=>"Cat");
	//echo $url;
	$contents = $fetchService->post($url, $parameter);
	return $contents;
}
function getT($t){
	$t=(time()-strtotime($t))/60;
	if($t>60*24){
		$t=ceil($t/(60*24)).'天';
	}elseif($t>60){
		$t=ceil($t/60).'小时';
	}else{
		$t=ceil($t).'分钟';
	}
	return $t;
}
function getNprice($iid){
	$con=get_url_content('http://marketing.taobao.com/home/promotion/item_promotion_list.do?itemId='.$iid);
	$p=get_word($con,'promPrice":"','"');
	if(!$p){
		$con1=get_url_content('http://item.taobao.com/item.htm?id='.$iid);
		$p=get_word($con1,'discount.*?: ',','); //限时折扣
		$p=$p?$p/1000:get_word($con1,'valVipRate":',',')/100;; //vip价格
	}
	if(!$p&&strstr($con,'"isSuccess":"T"')){
		$p=1; //为折扣商品，但获取不到折扣
	}
	return $p;
}
function getPageStr($strip){
	parse_str($_SERVER['QUERY_STRING'],$arr);
	$strip=explode(',',$strip);
	foreach($strip as $v){
		unset($arr[$v]);
	}
	foreach($arr as $k=>$v){
		$str.=$k.'='.$v.'&';
	}
	return $str;
}
function showcat($cat){
	switch ($cat){
		case 21:
			echo '数码';
			break;
		case 22:
			echo '美妆';
			break;
		case 23:
			echo '鞋包';
			break;
		case 24:
			echo '食品';
			break;
		case 25:
			echo '母婴';
			break;
		case 26:
			echo '居家';
			break;
		case 27:
			echo '女装';
			break;
		case 28:
			echo '男装';
			break;
		case 29:
			echo '美妆';
			break;
		case 42:
			echo '其它';
			break;
	};
}
function getPoint($price){
	$price = number_format($price,2);
	$point = $price*100%100;
	if($point == 0){
		return "00";
	}else{
		return (string)$point;
	}
}
function showtype($type){
	switch ($type){
		case 1:
			echo '首中标语';
			break;
		case 2:
			echo '旺旺名称';
			break;
		case 3:
			echo '优站域名';
			break;
		case 4:
			echo '后台账号';
			break;
		case 5:
			echo '后台密码';
			break;
		case 6:
			echo '顶部标图';
			break;
		case 8:
			echo '站点名称';
			break;
		case 9:
			echo '推哈网自助招商对应分区移动';
			break;
	}
}
function showcon($content){
	switch ($content){
		case 1:
			echo '优品特惠';
			break;
		case 2:
			echo '限量抢购';
			break;
		case 3:
			echo '实惠推荐';
			break;

	}
}
?>