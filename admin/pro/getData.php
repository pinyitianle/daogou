<?php
$getItemId = $_GET['id'];

$url = "http://mdskip.taobao.com/core/initItemDetail.htm?itemId=$getItemId";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_REFERER,"http://kaichi.uz.taobao.com");
//curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.0; zh-CN; rv:1.8.1.3)");
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//curl_setopt($ch,CURLOPT_POST,1);
//curl_setopt($ch,CURLOPT_COOKIEJAR,'cookie.txt');
//curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
$result = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);
//var_dump($result);
//print_r($info) ;
$result=str_replace(array("\r\n","\n","\r","\t",chr(9),chr(13)),'',$result);
$mode="#([0-9]+)\:#m";
preg_match_all($mode,$result,$s);
$s=$s[1];
if(count($s)>0){
	foreach($s as $v){
		$result=str_replace($v.':','"'.$v.'":',$result);
	}
}
//var_dump($result);
//echo "<br/><br/><br/>";

$result=iconv('gb2312','utf-8',$result);
//var_dump($result);
//echo "<br/><br/><br/>";
$str=array();
$mode='/([\x80-\xff]*)/i';
if(preg_match_all($mode,$result,$s)){
	foreach($s[0] as $v){
		if(!empty($v)){
			$str[base64_encode($v)]=$v;
			$result=str_replace('"'.$v.'"','"'.base64_encode($v).'"',$result);
		}
	}
}
$result=json_decode($result,true);
$price_array = array();
//echo "<br/><br/><br/>";
//print_r($price_array);
$price_array = current($result['defaultModel']['itemPriceResultDO']['priceInfo']);

$price = current($price_array['promotionList']);
$p =$price['price'];
$volume = $result['defaultModel']['sellCountDO']['sellCount'];

$return = array(
	'price'=>$p,
	'volume'=>$volume
);

echo json_encode($return);

//echo "<br/><br/><br/>";
//$result=arr_foreach($result,$str);
//print_r($result);exit;
/*function arr_foreach ($arr,$str)
{
    if (!is_array ($arr))
    {
        return false;
    }

    foreach ($arr as $key => $val )
    {
        if (is_array ($val))
        {
            $arr[$key]=arr_foreach($val,$str);
        }
        else
        {
            if(!empty($val)){
                if($str[$val]){
                    $arr[$key]=$str[$val];
                }
            }
        }
    }
    return $arr;
}*/


?>