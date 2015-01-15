<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/include/sql.func.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/function.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/config.php');
$id=$_GET['id'];
if($id){
    $url = $site_uzurl.'/view/front/getProInfo.php?id='.$id;
    $result = file_get_contents($url);
    preg_match_all("(<div.*callback_proinfo.*>\s*.*>)", $result,$matches,PREG_PATTERN_ORDER);
    $p = preg_replace("(</?[^>]*>)","" , $matches[0][0]);
    //$p=iconv("gb2312","utf-8//IGNORE",$p);
    print_r($p);
}