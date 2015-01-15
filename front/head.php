<!DOCTYPE HTML>
<html>
<head>
    <title><?=$site_lgtit?></title>
    <meta name="description" content="淘宝网购物首选优站,为淘宝会员提供当日淘宝网特价商品,每天更新3次,女装,男装,家居,母婴,鞋包,美妆应有尽有"/>
    <meta name="keywords" content="淘宝优站、优站、特价、U站、淘宝网、9.9、包邮、特惠、淘宝网购物、女装、男装、鞋包、vip专享U站"/>
    <script type="text/javascript" src="<?=SiteUrl?>/assets/javascripts/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?=SiteUrl?>/assets/javascripts/jquery.luara.0.0.1.min.js"></script>
    <script src="<?=SiteUrl?>/assets/javascripts/switch.js"></script>
    <link type="text/css" rel="stylesheet" href="<?=SiteUrl?>/assets/stylesheets/default.css" />
    <meta charset="utf-8">
</head>
<body>
<div class="xf-page">
    <div class="xf-header">
        <div class="top_nav">
            <div class="xf-layout" style="width:auto;">
                <div class="xf-logo">
                    <div class="logo_top">
                        <img src="<?=$site_pic?>">
                        <div class="search">
                            <form method="post" accept-charset="gb2312" action="<?=SiteUrl?>/front/list.php">
                                <input type="text" value="" name="q" class="search_text" >
                                <input type="submit" value="搜索" class="search_btn">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="xf-nav">
                <div class="nav" style="width:990px;">
                    <ul class="xf-navmenus">
                        <li <?php if($idx){echo ' class="current"';}?>> <a href="<?=SiteUrl?>" ><span>首页</span></a></li>
                        <li <?php if(request('type')=='2'){echo ' class="current"';}?>> <a href="<?=SiteUrl?>/front/list.php?type=2"><span>9.9专区</span></a></li>
                        <li <?php if(request('type')=='3'){echo ' class="current"';}?>> <a href="<?=SiteUrl?>/front/list.php?type=3"><span>19.9专区</span></a></li>
                        <li <?php if(request('type')=='5'){echo ' class="current"';}?>> <a href="<?=SiteUrl?>/front/list.php?type=5"><span>29.9专区</span></a></li>
                        <li <?php if(request('type')=='7'){echo ' class="current"';}?>> <a href="<?=SiteUrl?>/front/list.php?type=7"><span>39.9专区</span></a></li>
                        <li <?php if(request('type')=='4'){echo ' class="current"';}?>> <a href="<?=SiteUrl?>/front/list.php?type=4"><span>热销专区</span></a></li>
                        <li <?php if(request('act_from')=='1'){echo ' class="current"';}?>> <a href="<?=SiteUrl?>/front/list.php?act_from=1"><span>优品特惠</span></a></li>
                        <li <?php if(request('act_from')=='2'){echo ' class="current"';}?>> <a href="<?=SiteUrl?>/front/list.php?act_from=2"><span>限量抢购</span></a></li>
                        <li <?php if(request('act_from')=='3'){echo ' class="current"';}?>> <a href="<?=SiteUrl?>/front/list.php?act_from=3"><span>实惠推荐</span></a></li>
                        <li <?php if($tomo){echo ' class="current"';}?>> <a href="<?=SiteUrl?>/front/tomorrow.php" ><span>明日预告</span></a></li>
                        <li style=" float:right;"> <a href="<?=SiteUrl?>/front/baoming.php" target="_blank"><span>商家报名</span></a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>