/**
 * 静态缓存 阅读数更新
 */
$(function(){
	var newsids= {};
	var $tag = $(".news-list i.news_count");
	$tag.each(function(key,item){
		var id = $(item).data('id');
		newsids[key]=id;
	});
	$.post('/home/index/getCount',newsids,function(result){
		if(result.status==1){
			$.each(result.data,function(key,value){
				$('i.news_count .view_'+key).html(value);
			});
		}else{
			console.log("失败");
		}
	},'json');
});