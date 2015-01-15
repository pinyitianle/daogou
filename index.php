<?php
include_once('include/sql.func.php');
include_once('include/function.php');
include_once('include/config.php');
include "front/TuihaPush.php";
$today =  date('Y-m-d');
$tomorrow = date('Y-m-d',86400*1+time());
$switchad=get_list(PREFIX.'ad','','WHERE date(et) > CURDATE() and cat=101 order by rank asc,st desc limit 2');
$idx=1;

//秒杀区
$jr8= get_list('fstk_pro','','where ischeck=1 and et>="'.$today.'" and act_from=4 and type!=9 and st="'.$today.'" order by rank asc, st desc ,postdt desc limit 4');
$mr8= get_list('fstk_pro','','where ischeck=1 and et>="'.$today.'" and act_from=4 and type!=9 and st="'.$tomorrow.'" order by rank asc, st desc ,postdt desc limit 4');

//优品特惠
$ypth=get_list('fstk_pro','','where ischeck=1 and st<="'.$today.'" and et>="'.$today.'" and act_from=1 and type!=9 order by rank asc, st desc ,postdt desc limit 32');
//限量抢购
$xlqg=get_list('fstk_pro','','where ischeck=1 and st<="'.$today.'" and et>="'.$today.'" and act_from=2 and type!=9 order by rank asc, st desc ,postdt desc limit 20');
//实惠推荐
$shtj=get_list('fstk_pro','','where ischeck=1 and st<="'.$today.'" and et>="'.$today.'" and act_from=3 and type!=9 order by rank asc, st desc ,postdt desc limit 100');
//分页商品总数
$totalnum=get_list_count('pro','where ischeck=1 and st<="'.$today.'" and et>="'.$today.'" and act_from=3 and type!=9');
//分页
$mutipage_html=multi($totalnum,PAGE_SIZE,'1',"front/list.php?");

?>
<?php
include_once 'front/head.php';
?>
<div style="width:100%; height:30px; background:#fff;">
    <div class="dh_nav">
        <ul>
            <li><a href="front/list.php">全部</a></li>
            <?php
            foreach($cats as $k=>$v){
                ?>
                <li><a href="/front/list.php?cat=<?=$k?>"><?=$v?></a></li>
            <?php
            }
            ?>
        </ul>
    </div>
</div>
<div class="xf-layout" style="width:990px; margin-top:10px;">
    <div style="width:990px; height:220px; ">
        <div class="bannerbg">
            <div class="banner">
                <div class="banner_bg"></div>
                <!--标题背景-->
                <a href="#" class="banner_info"></a> <!--标题-->
                <div class="banner_list">
                    <ul>
                        <?php for($i=0;$i<2;$i++){?>
                            <li style="padding:0;margin:0;"><a href="<?php echo $switchad[$i]['link']; ?>" target="_blank"><img src="<?php echo $switchad[$i]['src']; ?>"/></a></li>
                        <?php }?>
                    </ul>
                    <ol>
                        <li></li>
                        <li></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content_top_nav">
            <div class="nav">
                <ul>
                    <li><a href="/front/list.php?cat=28"  style="display:block; width: 47px;height: 71px;"></a></li>
                    <li><a href="/front/list.php?cat=27"  style="display:block; width: 47px;height: 71px;"></a></li>
                    <li><a href="/front/list.php?cat=23"  style="display:block; width: 47px;height: 71px;"></a></li>
                    <li><a href="/front/list.php?cat=26"  style="display:block; width: 47px;height: 71px;"></a></li>
                    <li><a href="/front/list.php?cat=25"  style="display:block; width: 47px;height: 71px;"></a></li>
                    <li><a href="/front/list.php?cat=29"  style="display:block; width: 47px;height: 71px;"></a></li>
                    <li><a href="/front/list.php?cat=21"  style="display:block; width: 47px;height: 71px;"></a></li>
                    <li><a href="/front/list.php?cat=24"  style="display:block; width: 47px;height: 71px;"></a></li>
                    <li><a href="/front/list.php?cat=22"  style="display:block; width: 47px;height: 71px;"></a></li>
                    <li><a href="/front/list.php?cat=42"  style="display:block; width: 47px;height: 71px;"></a></li>
                </ul>
            </div>
            <div class="nav_bottom">
                <ul>
                    <li><a href="front/baoming.php" target="_blank">商家报名</a></li>
                    <li><a href="front/baoming.php" target="_blank">报名查询</a></li>
                    <li><a target="_blank" href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo urlencode($site_ww)?>&siteid=cntaobao&status=1&charset=utf-8">联系旺旺</a></li>
                    <li><a href="javascript:void(0)" onclick="alert('请按ctrl+d添加')" class="bcsq">保存书签</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="shanxuan">
        <div class="type_show" style="float:left;"> <span>&nbsp;筛选： </span> </div>
        <div class="type_detail">
            <ul>
                <li><a class="current" href="/front/list.php"><span>全部<b></b></span><i></i></a></li>
                <li><a class="current" href="/front/list.php"><span>默认</span><i></i></a></li>
                <li><a class="" href="/front/list.php?xl=1"><span>销量</span><i></i></a></li>
                <li><a class="" href="/front/list.php?price=1"><span>价格</span><i></i></a></li>
            </ul>
        </div>
        <div class="advance_tom" style="margin-top:0px;"> <a href="/front/tomorrow.php" target="_blank"><span><em></em>明日精彩预告</span><i></i></a>
            <div style="width:650px;float:left;height:24px;line-height:24px;overflow:hidden;">
                <p style="text-align:center;"><?=$site_tit?> </p>
            </div>
        </div>
        <div class="type_page"> </div>
    </div>
    <div style="width:990px; margin:0 auto;border:1px solid #fff;margin-top: 10px;margin-bottom: 5px;"></div>
    <div class="zdms" style="background-color:#FFFFFF;">
        <ul class="titlemenu">
            <li class="jm m_on">今日秒杀<span></span></li>
            <li class="mm">明日秒杀<span></span></li>
        </ul>
        <div style="height:20px;overflow:hidden;">

        </div>
        <ul class="msgoods">
            <li class="m_on will">
                <div style="width:980px;">
                    <?php
                    if($jr8){
                        foreach($jr8 as $k=>$v){
                            if($tao_isusing=='1'){
                                $newlink = '/front/tao.php?id='.$v[iid];
                            }else{
                                $newlink = $v['link'];
                            }


                            ?>
                            <div class="goods_item">
                                <?php
                                $s='<div class="admin_edit"><a class="del" href="/admin/pro/index.php?cmd=delAsk&id='.$v['id'].'" target="_blank"></a><a class="edit" href="/admin/pro/detail.php?cmd=mod&id='.$v['id'].'" target="_blank"></a></div>';
                                if($_COOKIE['un']){
                                    echo $s;
                                }
                                ?>
                                <p class="goods_img"><a href="<?=$newlink?>" title="<?php echo $v['title']?>" target="_blank"><img src="<?php echo $v['pic']?>" alt="<?php echo $v['title']?>"></a></p>
                                <p class="goods_name"><i class="tmall"></i><a href="<?=$newlink?>" title="<?php echo $v['title']?>" target="_blank"><?php echo $v['title']?></a></p>
                                <div class="price_sales"> <span class="promo_price fl"><em class="icon">￥</em><em class="integer"><?php echo $v['nprice']?></em></span> <em class="ems">包邮</em> <span class="sales fr gblock">售出<em><?php echo $v['volume']?></em>件</span> <a class="qgbtn fr" href="<?=$newlink?>" target="_blank"></a> </div>
                                <div class="pro_fx"><div class="prt_sttime">开始时间:<?php echo $v['st']?></div><div class="fx"><div style="float:left" class="sns-widget sns-sharebtn sns-widget-ui sns-sharebtn-default" data-sharebtn="{skinType:1,type:&quot;item&quot;,key:&quot;<?php echo $v['iid']?>&quot;,comment:&quot;发现一个U站里面的宝贝超好啊！你也来看看吧！&quot;,pic:&quot;<?php echo $v['pic']?>&quot;,client_id:68,isShowFriend:false}"></div></div></div>
                            </div>
                        <?php }}else{ ?>
                        <div class="no_item">当前时段还没有安排限量抢购，请稍后再来~</div>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            </li>
            <li class="">
                <div style="width:980px;">
                    <?php
                    if($mr8){
                        foreach($mr8 as $k=>$v){
                            if($tao_isusing=='1'){
                                $newlink = '/front/tao.php?id='.$v[iid];
                            }else{
                                $newlink = $v['link'];
                            }

                            ?>
                            <div class="goods_item">
                                <?php
                                $s='<div class="admin_edit"><a class="del" href="/admin/pro/index.php?cmd=delAsk&id='.$v['id'].'" target="_blank"></a><a class="edit" href="/admin/pro/detail.php?cmd=mod&id='.$v['id'].'" target="_blank"></a></div>';
                                if($_COOKIE['un']){
                                    echo $s;
                                }
                                ?>
                                <p class="goods_img"><a href="<?=$newlink?>" title="<?php echo $v['title']?>" target="_blank"><img src="<?php echo $v['pic']?>" alt="<?php echo $v['title']?>" width="" height=""></a></p>
                                <p class="goods_name"><i class="tmall"></i><a href="<?=$newlink?>" title="<?php echo $v['title']?>" target="_blank"><?php echo $v['title']?></a></p>
                                <div class="price_sales"> <span class="promo_price fl"><em class="icon">￥</em><em class="integer"><?php echo $v['nprice']?></em></span> <em class="ems">包邮</em> <span class="sales fr gblock">售出<em><?php echo $v['volume']?></em>件</span> <a class="qgbtn fr" href="<?=$newlink?>" target="_blank"></a> </div>
                                <div class="pro_fx"><div class="prt_sttime">开始时间:<?php echo $v['st']?></div><div class="fx"><div style="float:left" class="sns-widget sns-sharebtn sns-widget-ui sns-sharebtn-default" data-sharebtn="{skinType:1,type:&quot;item&quot;,key:&quot;<?php echo $v['iid']?>&quot;,comment:&quot;发现一个U站里面的宝贝超好啊！你也来看看吧！&quot;,pic:&quot;<?php echo $v['pic']?>&quot;,client_id:68,isShowFriend:false}"></div></div></div>
                            </div>
                        <?php }}else{ ?>
                        <div class="no_item">当前时段还没有安排限量抢购，请稍后再来~</div>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            </li>
        </ul>
    </div>
    <!-- 优品特惠开始 -->
    <div class="nav_img"> <a href="<?=SiteUrl?>/front/list.php?act_from=1"><img src="<?=SiteUrl?>/assets/images/ypth.png" width="990px" height="40px" style="display:block; float:left;"></a> </div>
    <div class="pro_list">
        <ul>
            <?php
            if($ypth){
                foreach($ypth as $k=>$v){
                    if($tao_isusing=='1'){
                        $newlink = '/front/tao.php?id='.$v[iid];
                    }else{
                        $newlink = $v['link'];
                    }
                    ?>
                    <li>
                        <div class="goods_item">
                            <?php
                            $s='<div class="admin_edit"><a class="del" href="/admin/pro/index.php?cmd=delAsk&id='.$v['id'].'" target="_blank"></a><a class="edit" href="/admin/pro/detail.php?cmd=mod&id='.$v['id'].'" target="_blank"></a></div>';
                            if($_COOKIE['un']){
                                echo $s;
                            }
                            ?>
                            <p class="goods_img"><a href="<?=$newlink?>" title="<?php echo $v['title']?>" target="_blank"><img src="<?php echo $v['pic']?>" alt="<?php echo $v['title']?>" width="" height=""></a></p>
                            <p class="goods_name"><i class="tmall"></i><a href="<?=$newlink?>" title="<?php echo $v['title']?>" target="_blank"><?php echo $v['title']?></a></p>
                            <div class="price_sales"> <span class="promo_price fl"><em class="icon">￥</em><em class="integer"><?php echo $v['nprice']?></em></span> <em class="ems">包邮</em> <span class="sales fr gblock">售出<em><?php echo $v['volume']?></em>件</span> <a class="qgbtn fr" href="<?=$newlink?>" target="_blank"></a> </div>
                            <div class="pro_fx"><div class="prt_sttime">开始时间:<?php echo $v['st']?></div><div class="fx"><div style="float:left" class="sns-widget sns-sharebtn sns-widget-ui sns-sharebtn-default" data-sharebtn="{skinType:1,type:&quot;item&quot;,key:&quot;<?php echo $v['iid']?>&quot;,comment:&quot;发现一个U站里面的宝贝超好啊！你也来看看吧！&quot;,pic:&quot;<?php echo $v['pic']?>&quot;,client_id:68,isShowFriend:false}"></div></div></div>
                        </div>
                    </li>
                <?php
                }}
            ?>
        </ul>
        <div class="clear30"></div>
    </div>
    <!-- 优品特惠结束 -->



    <!-- 限量抢购开始 -->
    <div class="nav_img"> <a href="<?=SiteUrl?>/front/list.php?act_from=2"><img src="<?=SiteUrl?>/assets/images/xlqg.png" width="990px" height="40px" style="display:block; float:left;"></a> </div>
    <div class="pro_list">
        <ul>
            <?php
            if($xlqg){
                foreach($xlqg as $k=>$v){
                    if($tao_isusing=='1'){
                        $newlink = '/front/tao.php?id='.$v[iid];
                    }else{
                        $newlink = $v['link'];
                    }
                    ?>
                    <li>
                        <div class="goods_item">
                            <?php
                            $s='<div class="admin_edit"><a class="del" href="/admin/pro/index.php?cmd=delAsk&id='.$v['id'].'" target="_blank"></a><a class="edit" href="/admin/pro/detail.php?cmd=mod&id='.$v['id'].'" target="_blank"></a></div>';
                            if($_COOKIE['un']){
                                echo $s;
                            }
                            ?>
                            <p class="goods_img"><a href="<?=$newlink?>" title="<?php echo $v['title']?>" target="_blank"><img src="<?php echo $v['pic']?>" alt="<?php echo $v['title']?>" width="" height=""></a></p>
                            <p class="goods_name"><i class="tmall"></i><a href="<?=$newlink?>" title="<?php echo $v['title']?>" target="_blank"><?php echo $v['title']?></a></p>
                            <div class="price_sales"> <span class="promo_price fl"><em class="icon">￥</em><em class="integer"><?php echo $v['nprice']?></em></span> <em class="ems">包邮</em> <span class="sales fr gblock">售出<em><?php echo $v['volume']?></em>件</span> <a class="qgbtn fr" href="<?=$newlink?>" target="_blank"></a> </div>
                            <div class="pro_fx"><div class="prt_sttime">开始时间:<?php echo $v['st']?></div><div class="fx"><div style="float:left" class="sns-widget sns-sharebtn sns-widget-ui sns-sharebtn-default" data-sharebtn="{skinType:1,type:&quot;item&quot;,key:&quot;<?php echo $v['iid']?>&quot;,comment:&quot;发现一个U站里面的宝贝超好啊！你也来看看吧！&quot;,pic:&quot;<?php echo $v['pic']?>&quot;,client_id:68,isShowFriend:false}"></div></div></div>
                        </div>
                    </li>
                <?php
                }}
            ?>
        </ul>
        <div class="clear30"></div>
    </div>
    <!-- 限量抢购结束 -->
    <!-- 实惠推荐开始 -->
    <div class="nav_img"> <a href="<?=SiteUrl?>/front/list.php?act_from=3"><img src="<?=SiteUrl?>/assets/images/shtj.png" width="990px" height="40px" style="display:block; float:left;"></a> </div>
    <div class="pro_list">
        <ul>
            <?php
            if($shtj){
                foreach($shtj as $k=>$v){
                    if($tao_isusing=='1'){
                        $newlink = '/front/tao.php?id='.$v[iid];
                    }else{
                        $newlink = $v['link'];
                    }
                    ?>
                    <li>
                        <div class="goods_item">
                            <?php
                            $s='<div class="admin_edit"><a class="del" href="/admin/pro/index.php?cmd=delAsk&id='.$v['id'].'" target="_blank"></a><a class="edit" href="/admin/pro/detail.php?cmd=mod&id='.$v['id'].'" target="_blank"></a></div>';
                            if($_COOKIE['un']){
                                echo $s;
                            }
                            ?>
                            <p class="goods_img"><a href="<?=$newlink?>" title="<?php echo $v['title']?>" target="_blank"><img src="<?php echo $v['pic']?>" alt="<?php echo $v['title']?>" width="" height=""></a></p>
                            <p class="goods_name"><i class="tmall"></i><a href="<?=$newlink?>" title="<?php echo $v['title']?>" target="_blank"><?php echo $v['title']?></a></p>
                            <div class="price_sales"> <span class="promo_price fl"><em class="icon">￥</em><em class="integer"><?php echo $v['nprice']?></em></span> <em class="ems">包邮</em> <span class="sales fr gblock">售出<em><?php echo $v['volume']?></em>件</span> <a class="qgbtn fr" href="<?=$newlink?>" target="_blank"></a> </div>
                            <div class="pro_fx"><div class="prt_sttime">开始时间:<?php echo $v['st']?></div><div class="fx"><div style="float:left" class="sns-widget sns-sharebtn sns-widget-ui sns-sharebtn-default" data-sharebtn="{skinType:1,type:&quot;item&quot;,key:&quot;<?php echo $v['iid']?>&quot;,comment:&quot;发现一个U站里面的宝贝超好啊！你也来看看吧！&quot;,pic:&quot;<?php echo $v['pic']?>&quot;,client_id:68,isShowFriend:false}"></div></div></div>
                        </div>
                    </li>
                <?php
                }}
            ?>
        </ul>
        <div class="clear30"></div>
    </div>
    <!-- 实惠推荐结束 -->



</div>
<div class="pagination"> <?php echo $mutipage_html?> </div>
<?php
include_once 'front/float.php';
?>


<?php
include_once 'front/foot.php';
?>
</div>
</body>
</html>