<?php
include_once('../include/function.php');
include_once('../include/sql.func.php');
include_once('../include/config.php');
$tomo=1;
$today =  date('Y-m-d');
$prolist=get_list('fstk_pro','','where st>"'.$today.'" and type=9 order by rank asc, st desc');
?>
<?php
include_once 'head.php';
?>
<div class="xf-layout xf-mt">
    <div class="main_in">
        <div class="pro_list">
            <ul>
                <?php
                if($prolist){
                    foreach($prolist as $k=>$v){
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
    </div>
</div>
</div>
</body>
</html>