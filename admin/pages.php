<?php
class SubPages{

    private  $each_disNums;//每页显示的条目数
    private  $nums;//总条目数
    private  $current_page;//当前被选中的页
    private  $sub_pages;//每次显示的页数
    private  $pageNums;//总页数
    private  $page_array = array();//用来构造分页的数组
    private  $subPage_link;//每个分页的链接
    private  $subPage_type;//显示分页的类型
    private  $page_str;
    private  $split_str;

    function __construct($each_disNums,$nums,$current_page,$sub_pages,$subPage_link,$subPage_type,$split_str){
        $this->split_str=$split_str;
        $this->each_disNums=intval($each_disNums);
        $this->nums=intval($nums);
        if(!$current_page){
            $this->current_page=1;
        }else{
            $this->current_page=intval($current_page);
        }
        $this->sub_pages=intval($sub_pages);
        $this->pageNums=ceil($nums/$each_disNums);
        $this->subPage_link=$subPage_link;
        $this->page_str=$this->show_SubPages($subPage_type);
    }

    function getstr(){
        return $this->page_str;
    }
    function __destruct(){
        unset($each_disNums);
        unset($nums);
        unset($current_page);
        unset($sub_pages);
        unset($pageNums);
        unset($page_array);
        unset($subPage_link);
        unset($subPage_type);
    }

    function show_SubPages($subPage_type){
        if($subPage_type == 1){
            return $this->subPageCss1();
        }elseif ($subPage_type == 2){
            return $this->subPageCss2();
        }elseif($subPage_type == 3){
            return $this->subPageCss3();
        }
        elseif($subPage_type == 4){
            return $this->subPageCss4();
        }
        elseif($subPage_type == 5){
            return $this->subPageCss5();
        }
        elseif($subPage_type == 6){
            return $this->subPageCss6();
        }
        elseif($subPage_type == 7){
            return $this->subPageCss7();
        }
    }


    function initArray(){
        for($i=0;$i<$this->sub_pages;$i++){
            $this->page_array[$i]=$i;
        }
        return $this->page_array;
    }

    function construct_num_Page(){
        if($this->pageNums < $this->sub_pages){
            $current_array=array();
            for($i=0;$i<$this->pageNums;$i++){
                $current_array[$i]=$i+1;
            }
        }else{
            $current_array=$this->initArray();
            if($this->current_page <= 3){
                for($i=0;$i<count($current_array);$i++){
                    $current_array[$i]=$i+1;
                }
            }elseif ($this->current_page <= $this->pageNums && $this->current_page > $this->pageNums - $this->sub_pages + 1 ){
                for($i=0;$i<count($current_array);$i++){
                    $current_array[$i]=($this->pageNums)-($this->sub_pages)+1+$i;
                }
            }else{
                for($i=0;$i<count($current_array);$i++){
                    $current_array[$i]=$this->current_page-2+$i;
                }
            }
        }

        return $current_array;
    }

    function subPageCss1(){
        $subPageCss1Str="";
//   $subPageCss1Str.="共".$this->nums."条记录，";   
//   $subPageCss1Str.="每页显示".$this->each_disNums."条，";   
        $subPageCss1Str.="当前第".$this->current_page."页 / 共".$this->pageNums."页 ";
        if($this->current_page > 1){
            $firstPageUrl=$this->subPage_link."1".$this->split_str;
            $prewPageUrl=$this->subPage_link.($this->current_page-1).$this->split_str;
//    $subPageCss1Str.="<a href='$firstPageUrl'>首页</a> ";   
            $subPageCss1Str.="<a href='/view/admin/pro.php$prewPageUrl' class='previous-page'>上一页</a> ";
        }else {
//    $subPageCss1Str.="首页 ";   
            $subPageCss1Str.="<a class='no-previous'>上一页</a> ";
        }

        if($this->current_page < $this->pageNums){
            $lastPageUrl=$this->subPage_link.$this->pageNums.$this->split_str;
            $nextPageUrl=$this->subPage_link.($this->current_page+1).$this->split_str;

            $subPageCss1Str.=" <a href='/view/admin/pro.php$nextPageUrl' class='next-page'>下一页</a> ";
//    $subPageCss1Str.="<a href='$lastPageUrl'>尾页</a> ";   
        }else {
            $subPageCss1Str.="<a class='no-next'>下一页</a> ";
//    $subPageCss1Str.="尾页 ";   
        }

        return $subPageCss1Str;

    }


    function subPageCss2(){
        $subPageCss2Str="";
        //$subPageCss2Str.="当前第".$this->current_page."页 / 共".$this->pageNums."页";


        if($this->current_page > 1){
            $firstPageUrl=$this->subPage_link."1".$this->split_str;
            $prewPageUrl=$this->subPage_link.($this->current_page-1).$this->split_str;
            $subPageCss2Str.="<a href='/view/admin/pro.php$firstPageUrl'>首页</a>";
            $subPageCss2Str.="<a href='/view/admin/pro.php$prewPageUrl' title='转到上一页'>上一页</a>";
        }else {
            $subPageCss2Str.="";
            $subPageCss2Str.="";
        }

        $a=$this->construct_num_Page();
        for($i=0;$i<count($a);$i++){
            $s=$a[$i];
            if($s == $this->current_page ){
                $subPageCss2Str.="<span>".$s."</span>";
            }else{
                $url=$this->subPage_link.$s.$this->split_str;
                $subPageCss2Str.="<a href='/view/admin/pro.php$url'>".$s."</a>";
            }
        }

        $a=$s%10;
        $s=$a?$s-$a+10:$s;
        for($i=1;$i<=4;$i++){
            if($s+10*$i < $this->pageNums){
                $url=$this->subPage_link.($s+10*$i).$this->split_str;
                $subPageCss2Str.="<a href='/view/admin/pro.php$url'>".($s+10*$i)."</a>";
            }
        }

        if($this->current_page < $this->pageNums){
            $lastPageUrl=$this->subPage_link.$this->pageNums.$this->split_str;
            $nextPageUrl=$this->subPage_link.($this->current_page+1).$this->split_str;
            $subPageCss2Str.="<a href='/view/admin/pro.php$nextPageUrl' title='转到下一页'>下一页</a>";
            //$subPageCss2Str.="<a href='$lastPageUrl'>尾页</a> ";
        }else {
            $subPageCss2Str.="";
            $subPageCss2Str.="";
        }
        return $subPageCss2Str;
    }


    function subPageCss3(){
        $subPageCss2Str="";
        //$subPageCss2Str.="当前第".$this->current_page."页 / 共".$this->pageNums."页";


        if($this->current_page > 1){
            $firstPageUrl=$this->subPage_link."1".$this->split_str;
            $prewPageUrl=$this->subPage_link.($this->current_page-1).$this->split_str;
            $subPageCss2Str.="<a href='/view/admin/ad.php$firstPageUrl'>首页</a>";
            $subPageCss2Str.="<a href='/view/admin/ad.php$prewPageUrl' title='转到上一页'>上一页</a>";
        }else {
            $subPageCss2Str.="";
            $subPageCss2Str.="";
        }

        $a=$this->construct_num_Page();
        for($i=0;$i<count($a);$i++){
            $s=$a[$i];
            if($s == $this->current_page ){
                $subPageCss2Str.="<span>".$s."</span>";
            }else{
                $url=$this->subPage_link.$s.$this->split_str;
                $subPageCss2Str.="<a href='/view/admin/ad.php$url'>".$s."</a>";
            }
        }

        $a=$s%10;
        $s=$a?$s-$a+10:$s;
        for($i=1;$i<=4;$i++){
            if($s+10*$i < $this->pageNums){
                $url=$this->subPage_link.($s+10*$i).$this->split_str;
                $subPageCss2Str.="<a href='/view/admin/ad.php$url'>".($s+10*$i)."</a>";
            }
        }

        if($this->current_page < $this->pageNums){
            $lastPageUrl=$this->subPage_link.$this->pageNums.$this->split_str;
            $nextPageUrl=$this->subPage_link.($this->current_page+1).$this->split_str;
            $subPageCss2Str.="<a href='/view/admin/ad.php$nextPageUrl' title='转到下一页'>下一页</a>";
            //$subPageCss2Str.="<a href='$lastPageUrl'>尾页</a> ";
        }else {
            $subPageCss2Str.="";
            $subPageCss2Str.="";
        }
        return $subPageCss2Str;
    }

    function subPageCss4(){
        $subPageCss2Str="";
        //$subPageCss2Str.="当前第".$this->current_page."页 / 共".$this->pageNums."页";


        if($this->current_page > 1){
            $firstPageUrl=$this->subPage_link."1".$this->split_str;
            $prewPageUrl=$this->subPage_link.($this->current_page-1).$this->split_str;
            $subPageCss2Str.="<a href='/view/admin/address.php$firstPageUrl'>首页</a>";
            $subPageCss2Str.="<a href='/view/admin/address.php$prewPageUrl' title='转到上一页'>上一页</a>";
        }else {
            $subPageCss2Str.="";
            $subPageCss2Str.="";
        }

        $a=$this->construct_num_Page();
        for($i=0;$i<count($a);$i++){
            $s=$a[$i];
            if($s == $this->current_page ){
                $subPageCss2Str.="<span>".$s."</span>";
            }else{
                $url=$this->subPage_link.$s.$this->split_str;
                $subPageCss2Str.="<a href='/view/admin/address.php$url'>".$s."</a>";
            }
        }

        $a=$s%10;
        $s=$a?$s-$a+10:$s;
        for($i=1;$i<=4;$i++){
            if($s+10*$i < $this->pageNums){
                $url=$this->subPage_link.($s+10*$i).$this->split_str;
                $subPageCss2Str.="<a href='/view/admin/address.php$url'>".($s+10*$i)."</a>";
            }
        }

        if($this->current_page < $this->pageNums){
            $lastPageUrl=$this->subPage_link.$this->pageNums.$this->split_str;
            $nextPageUrl=$this->subPage_link.($this->current_page+1).$this->split_str;
            $subPageCss2Str.="<a href='/view/admin/address.php$nextPageUrl' title='转到下一页'>下一页</a>";
            //$subPageCss2Str.="<a href='$lastPageUrl'>尾页</a> ";
        }else {
            $subPageCss2Str.="";
            $subPageCss2Str.="";
        }
        return $subPageCss2Str;
    }



    function subPageCss5(){
        $subPageCss2Str="";
        //$subPageCss2Str.="当前第".$this->current_page."页 / 共".$this->pageNums."页";


        if($this->current_page > 1){
            $firstPageUrl=$this->subPage_link."1".$this->split_str;
            $prewPageUrl=$this->subPage_link.($this->current_page-1).$this->split_str;
            $subPageCss2Str.="<a href='/view/admin/LeaveMessage.php$firstPageUrl'>首页</a>";
            $subPageCss2Str.="<a href='/view/admin/LeaveMessage.php$prewPageUrl' title='转到上一页'>上一页</a>";
        }else {
            $subPageCss2Str.="";
            $subPageCss2Str.="";
        }

        $a=$this->construct_num_Page();
        for($i=0;$i<count($a);$i++){
            $s=$a[$i];
            if($s == $this->current_page ){
                $subPageCss2Str.="<span>".$s."</span>";
            }else{
                $url=$this->subPage_link.$s.$this->split_str;
                $subPageCss2Str.="<a href='/view/admin/LeaveMessage.php$url'>".$s."</a>";
            }
        }

        $a=$s%10;
        $s=$a?$s-$a+10:$s;
        for($i=1;$i<=4;$i++){
            if($s+10*$i < $this->pageNums){
                $url=$this->subPage_link.($s+10*$i).$this->split_str;
                $subPageCss2Str.="<a href='/view/admin/LeaveMessage.php$url'>".($s+10*$i)."</a>";
            }
        }

        if($this->current_page < $this->pageNums){
            $lastPageUrl=$this->subPage_link.$this->pageNums.$this->split_str;
            $nextPageUrl=$this->subPage_link.($this->current_page+1).$this->split_str;
            $subPageCss2Str.="<a href='/view/admin/LeaveMessage.php$nextPageUrl' title='转到下一页'>下一页</a>";
            //$subPageCss2Str.="<a href='$lastPageUrl'>尾页</a> ";
        }else {
            $subPageCss2Str.="";
            $subPageCss2Str.="";
        }
        return $subPageCss2Str;
    }

    function subPageCss6(){
        $subPageCss2Str="";
        //$subPageCss2Str.="当前第".$this->current_page."页 / 共".$this->pageNums."页";


        if($this->current_page > 1){
            $firstPageUrl=$this->subPage_link."1".$this->split_str;
            $prewPageUrl=$this->subPage_link.($this->current_page-1).$this->split_str;
            $subPageCss2Str.="<a href='/view/admin/activity.php$firstPageUrl'>首页</a>";
            $subPageCss2Str.="<a href='/view/admin/activity.php$prewPageUrl' title='转到上一页'>上一页</a>";
        }else {
            $subPageCss2Str.="";
            $subPageCss2Str.="";
        }

        $a=$this->construct_num_Page();
        for($i=0;$i<count($a);$i++){
            $s=$a[$i];
            if($s == $this->current_page ){
                $subPageCss2Str.="<span>".$s."</span>";
            }else{
                $url=$this->subPage_link.$s.$this->split_str;
                $subPageCss2Str.="<a href='/view/admin/activity.php$url'>".$s."</a>";
            }
        }

        $a=$s%10;
        $s=$a?$s-$a+10:$s;
        for($i=1;$i<=4;$i++){
            if($s+10*$i < $this->pageNums){
                $url=$this->subPage_link.($s+10*$i).$this->split_str;
                $subPageCss2Str.="<a href='/view/admin/activity.php$url'>".($s+10*$i)."</a>";
            }
        }

        if($this->current_page < $this->pageNums){
            $lastPageUrl=$this->subPage_link.$this->pageNums.$this->split_str;
            $nextPageUrl=$this->subPage_link.($this->current_page+1).$this->split_str;
            $subPageCss2Str.="<a href='/view/admin/activity.php$nextPageUrl' title='转到下一页'>下一页</a>";
            //$subPageCss2Str.="<a href='$lastPageUrl'>尾页</a> ";
        }else {
            $subPageCss2Str.="";
            $subPageCss2Str.="";
        }
        return $subPageCss2Str;
    }




    function subPageCss7(){
        $subPageCss2Str="";
        //$subPageCss2Str.="当前第".$this->current_page."页 / 共".$this->pageNums."页";


        if($this->current_page > 1){
            $firstPageUrl=$this->subPage_link."1".$this->split_str;
            $prewPageUrl=$this->subPage_link.($this->current_page-1).$this->split_str;
            $subPageCss2Str.="<a href='/view/admin/answer.php$firstPageUrl'>首页</a>";
            $subPageCss2Str.="<a href='/view/admin/answer.php$prewPageUrl' title='转到上一页'>上一页</a>";
        }else {
            $subPageCss2Str.="";
            $subPageCss2Str.="";
        }

        $a=$this->construct_num_Page();
        for($i=0;$i<count($a);$i++){
            $s=$a[$i];
            if($s == $this->current_page ){
                $subPageCss2Str.="<span>".$s."</span>";
            }else{
                $url=$this->subPage_link.$s.$this->split_str;
                $subPageCss2Str.="<a href='/view/admin/answer.php$url'>".$s."</a>";
            }
        }

        $a=$s%10;
        $s=$a?$s-$a+10:$s;
        for($i=1;$i<=4;$i++){
            if($s+10*$i < $this->pageNums){
                $url=$this->subPage_link.($s+10*$i).$this->split_str;
                $subPageCss2Str.="<a href='/view/admin/answer.php$url'>".($s+10*$i)."</a>";
            }
        }

        if($this->current_page < $this->pageNums){
            $lastPageUrl=$this->subPage_link.$this->pageNums.$this->split_str;
            $nextPageUrl=$this->subPage_link.($this->current_page+1).$this->split_str;
            $subPageCss2Str.="<a href='/view/admin/answer.php$nextPageUrl' title='转到下一页'>下一页</a>";
            //$subPageCss2Str.="<a href='$lastPageUrl'>尾页</a> ";
        }else {
            $subPageCss2Str.="";
            $subPageCss2Str.="";
        }
        return $subPageCss2Str;
    }

}
?>
