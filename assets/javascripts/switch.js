$(function(){
	$(".jm").click(function(){
		$(".titlemenu li").removeClass("m_on");
		$(".jm").addClass("m_on");
		$(".msgoods li").removeClass("m_on will");
		$(".msgoods li").eq(0).addClass("m_on will");
	});
	$(".mm").click(function(){
		$(".titlemenu li").removeClass("m_on");
		$(".mm").addClass("m_on");
		$(".msgoods li").removeClass("m_on will");
		$(".msgoods li").eq(1).addClass("m_on will");
	})
})


$(function(){
	$('#getProInfo').click(function(){

		$.get('proInfo.php?id='+$('#proid').val(),function(data){

			if(data==2){alert('未参加淘客推广');return false;}

			var item = data.sp_item_info_list_get_response.item_list

			var nik = item.sp_item[0].nick;
			$("#title").val(item.sp_item[0].title);
			$('#pic').val("http://img1.tbcdn.cn/tfscom/"+item.sp_item[0].pic_url+'_310x310.jpg');
			$('#oprice').val(item.sp_item[0].price);
			$('#go_link').attr("href",item.sp_item[0].item_url);
			//$('#link').val('http://item.taobao.com/item.htm?id='+$('#proid').val());
			$('#link').val(item.sp_item[0].item_url);
			$('#look').attr("href",item.sp_item[0].item_url);
			var t = item.sp_item[0].tmall;
			(t=='1')?$('#tot option').eq(1).attr("selected" , "selected"):$('#tot option').eq(0).attr("selected" , "selected");
			//图片列表
			var nodeImg ="";
			var fiveImg ="";
			$(".pro-pic-list").show();

			var imgArray = new Array();

			imgArray = item.sp_item[0].item_imgs.split(",");

			$.each(imgArray, function(i, n){
				nodeImg+= '<img src="'+n+"_310x310.jpg"+'" width="80px;" height="80px" onclick="changeImg($(this));">';
				fiveImg+= n+"_310x310.jpg,"
			});
			$('#fiveImg').val(fiveImg);
			$(".pro-pic-list").html(nodeImg);

		},"json");
		$.get('getData.php?id='+$('#proid').val(),function(data){
			$('#nprice').val(data.price);
			$('#volume').val(data.volume);
		},"json");
	})
	$(".getvolueag").click(function(){
		$.get('getData.php?id='+$('#proid').val(),function(data){
			$('#nprice').val(data.price);
			$('#volume').val(data.volume);
		},"json");
	})

	$(".set499").click(function(){
		$(".rank").val(499);
	});
	$(".set500").click(function(){
		$(".rank").val(500);
	});

})
function changeImg(obj){
	$('#pic').val(obj.attr("src"));
}
$(function(){

	$(".biaotou").click(function(){
		var site_lgtit = $(".site_lgtit").val();
		var t = $("#title").val();
		$("#title").html(site_lgtit+t);
	})

});
$(function(){
	$(".banner_list").luara({width:"600",height:"195",interval:4000,selected:"seleted"});
});

