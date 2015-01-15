<div class="xf-layout xf-mb">
  <div class="uzhan-lnk">
    <div class="bd">
      <div class="uzhan-crop">
        <strong>友情链接合作...</strong>
        <ul class="uzhan-list">
          <?php
          $links=get_list(PREFIX.'link','','order by rank');
          if($links){
            foreach($links as $v){
              ?>
              <li><a target="_blank" href="<?php echo $v['link']?>"><?php echo $v['src']?></a></li>
            <?php
            }
          }
          ?>
        </ul>
      </div>
    </div>
  </div>
</div>