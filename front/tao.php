<?php
include_once('../include/function.php');
include_once('../include/sql.func.php');
include_once('../include/config.php');
$id=$_GET['id'];
//$tao = get_list_by_id('taocode','id','1');
//$code = $tao['taocode'];

?>
<title>亲，我正在坐火箭去爱淘宝！</title>
<script type="text/javascript" src="../assets/javascripts/jquery-1.7.1.min.js"></script>
<a data-type="0" biz-itemid="<?=$id?>" data-tmpl="192x40" data-tmplid="625" data-rd="1" data-style="2" data-border="0" href="http://item.taobao.com/item.htm?id=<?=$id?>">

</a>

<script type="text/javascript"> (function(win,doc){ var s = doc.createElement("script"), h = doc.getElementsByTagName("head")[0]; if (!win.alimamatk_show) { s.charset = "gbk"; s.async = true; s.src = "http://a.alimama.cn/tkapi.js"; h.insertBefore(s, h.firstChild); }; var o = { pid: "mm_26050333_4160233_28096414",/*推广单元ID，用于区分不同的推广渠道*/ appkey: "",/*通过TOP平台申请的appkey，设置后引导成交会关联appkey*/ unid: ""/*自定义统计字段*/ }; win.alimamatk_onload = win.alimamatk_onload || []; win.alimamatk_onload.push(o); })(window,document);</script>
<script type="text/javascript">
	var timer = setInterval(hidetk,10);
	function hidetk(){
		if(window.alimamatk_show){
			var obj = $("tkbox iframe").contents().find("a");
			//alert(obj.size());
			if(obj.size()>0){
				$("tkbox").hide();
				var url = obj.attr("href");
				clearInterval(timer);
				if(url != '')
				{
					location.href = url;
				}
			}
		}
	}

</script>