<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo ($title); ?></title>
<link rel="stylesheet" href="/Public/css/bootstrap.min.css">
<link rel="stylesheet" href="/Public/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="/Public/css/main.css">
<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/js/layer.js"></script>
<script type="text/javascript" src="/Public/js/dialog.js"></script>
</head>
<body>

<!-- 导航栏 -->
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<a class="navbar-brand" href="/admin/index/index">后台</a>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
		        <li><a href="#"><span class="glyphicon glyphicon-bell"></span>通知</a></li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo ($_SESSION['adminInfo']['username']); ?><span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="#">个人中心</a></li>
		            <li><a href="/admin/login/loginout">退出</a></li>
		          </ul>
		        </li>
		      </ul>
		</div>
	</div>
</nav>
<!-- 内容主体 -->
<div id="content" class="container-fluid">
	<div class="row">
		<div id="menu" class="col-sm-2">
			<?php  $navs = D('Menu')->getAdminMenus(); ?>

<ul class="nav nav-pills nav-stacked">
  <?php if(is_array($navs)): $i = 0; $__LIST__ = $navs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li <?php echo (getActive($nav["c"])); ?>><a href="/<?php echo ($nav["m"]); ?>/<?php echo ($nav["c"]); ?>/<?php echo ($nav["f"]); ?>"><?php echo ($nav["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
		</div>
		<div id="main" class="col-sm-10"><div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li><i class="glyphicon glyphicon-cog"></i> <a
				href="/admin/admin"><?php echo ($title); ?></a></li>
			<li class="active"><i class="glyphicon glyphicon-calendar"></i> <?php echo ($navname); ?> </li>
		</ol>
	</div>
</div>

<div class="gb20">
	<button id="button-add" type="button"
		class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
		aria-haspopup="true" aria-expanded="false">
		<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加
	</button>
</div>
<div class="row gb20">
	<form action="/admin/content/index" method="get">
		<div class="col-md-3">
			<div class="input-group">
				<span class="input-group-addon">栏目</span> 
				<select class="form-control" name="catid">
					<option value=''>全部分类</option>
					<?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><option value="<?php echo ($menu["menu_id"]); ?>" <?php if($_GET[catid]): ?>selected<?php endif; ?> ><?php echo ($menu["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>
		</div>
		
		<div class="col-md-3">
			<div class="input-group">
				<input class="form-control" name="title" type="text" value="<?php echo ($_GET['title']); ?>" placeholder="文章标题" /> 
				<span class="input-group-btn">
					<button id="sub_data" type="submit" class="btn btn-primary">
						<i class="glyphicon glyphicon-search"></i>
					</button>
				</span>
			</div>
		</div>
	</form>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<form id="listorder" class="gb20">
				<table class="table table-bordered table-hover table">
					<thead>
						<tr>
							<th><input type="checkbox" name="check_all" id="check_all" /></th>
							<th width="14">排序</th>
							<th>id</th>
							<th>标题</th>
							<th>栏目</th>
							<th>来源</th>
							<th>封面图</th>
							<th>时间</th>
							<th>状态</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						<?php if(is_array($news)): foreach($news as $key=>$new): ?><tr>
							<td><input type="checkbox" name='check_item' value="<?php echo ($new["news_id"]); ?>" /></td>
							<td><input size=4 type='text' name='listorder[<?php echo ($new["news_id"]); ?>]' value="<?php echo ($new["listorder"]); ?>" /></td>
							<td><?php echo ($new["news_id"]); ?></td>
							<td><?php echo ($new["title"]); ?></td>
							<td><?php echo (getCat($menus,$new["catid"])); ?></td>
							<td><?php echo (getCopyFrom($new["copyfrom"])); ?></td>
							<td><img src="<?php echo ($new["thumb"]); ?>" width="48px" alt="" /></td>
							<td><?php echo (date('Y-m-d H:i:s',$new["create_time"])); ?></td>
							<td class="status status_<?php echo ($new["news_id"]); ?>" data-id="<?php echo ($new["news_id"]); ?>" data-status=<?php if($new["status"] == 0): ?>"1"<?php else: ?>"0"<?php endif; ?> ><?php echo (getStatus($new["status"])); ?></td>
							<td>
								<a href="/admin/content/add?id=<?php echo ($new["news_id"]); ?>" title="编辑" class="glyphicon glyphicon-edit tp-edit"></a> 
								<a href="javascript:void(0)" class="tp-delete" data-id="<?php echo ($new["news_id"]); ?>" title="删除"> 
									<span class="glyphicon glyphicon-remove-circle" ></span>
								</a>
							</td>
						</tr><?php endforeach; endif; ?>
					</tbody>
				</table>
				
				<button id="button-orderlist" type="button" class="btn btn-primary dropdown-toggle">
					<span class="glyphicon glyphicon-plus"></span>添加排序
				</button>
			</form>
			<!-- 推荐位 -->
			<div class="col-md-3 form-inline">
				<select class="form-control" name="pushselect">
					<option value=''>请选择推荐位</option>
					<?php if(is_array($positions)): $i = 0; $__LIST__ = $positions;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$position): $mod = ($i % 2 );++$i;?><option value="<?php echo ($position["id"]); ?>"><?php echo ($position["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<button type='button' id="push-button" class="btn btn-primary">推送</button>
			</div>
			<!--End推荐位 -->
			<div class='text-right'>
				<ul class="pagination">
					<?php echo ($pagination); ?>
				</ul>
			</div>
		</div>
	</div>

</div>
<script>
(function($){
	$(function(){
		// 添加文章
		$("#button-add").on('click',function(e){
			e.preventDefault();
			location.href="/admin/content/add";
		});
		
		// 删除文章
		$('.tp-delete').on('click',function(e){
			e.preventDefault();
			var id = $(this).data('id');
			var url = '/admin/content/delete';
			var data = {}; 
			data['id'] = id;
			data['status'] = -1;
			dialog.confirmBack('是否确定删除',changeStatus,[url,data]);
			
		});
		// 文章列表更改状态
		$('.status').on('click',function(){
			var $this=$(this);
			var id = $this.data('id');
			var status = $this.data('status');
			var data = {};
			data['id'] = id;
			data['status'] = status;
			var url = '/admin/content/delete';
			
			dialog.confirmBack('是否确定更新状态',changeStatus,[url,data]);
		});
		
		// 状态改变
		function changeStatus(url,data){
			$.post(url,data,function(result){
				if(result.status==1){
					if(result.data==1){
						dialog.toconfirm(result.msg);
						var str = data['status']==1?'正常':'关闭';
						var status = data['status']==1?0:1;
						$('.status_'+data['id']).text(str).data('status',status);
						console.log($('.status_'+data['id']).data('status'));
					}else{
						dialog.success(result.msg,'/admin/content/index');
					}
				}else{
					if(result.data==1){
						dialog.error(result.msg);
					}else{
						dialog.error(result.msg,'/admin/content/index');
					}
				}
			},'json');
		}
		
		// 添加排序
		$('#button-orderlist').on('click', function(e){
			e.preventDefault();
			var str = $("form#listorder").serialize();
			$.post('/admin/content/listorder',{'data':str},function(result){
				if(result.status==1){
					dialog.success(result.msg,'/admin/content/index');
				}else{
					dialog.error(result.msg,'/admin/content/index');
				}
			},'json');
		});
		
		// 推荐位checkbox全选
		$("#check_all").on('click',function(){
			var $item = $('input[name="check_item"]');
			$item.prop('checked',$(this).prop('checked'));
		});
		
		// 推荐位checkbox item全选
		$('input[name="check_item"]').on('click',function(){
			$('input[name="check_item"]').each(function(key,item){
				var $all = $("#check_all");
				if(!$(item).is(':checked')){
					$all.prop("checked",false);
					return false;
				}
				$all.prop("checked",true);
			});
		});
		
		// 单击推送按钮
		$("#push-button").on('click',function(){
			var check_v = $('input[name="check_item"]').map(function(key,item){
				if($(item).is(":checked")){
					return $(this).val();	
				}
			}).get();
			var push_id = $('select[name="pushselect"]').val();
			// 条件判断
			if(check_v.length==0){
				dialog.error('请选择文章');
				return false;
			}
			if(!$.isNumeric(push_id)){
				dialog.error('请选择推荐位');
				return false;
			}
			// ajax 调用
			var data = {'check_v':check_v,'position_id':push_id};
			var url = '/admin/content/push';
			$.post(url,data,function(result){
				if(result.status==1){
					dialog.success(result.msg,result['data']['jump_url']);
				}else{
					dialog.success(result.msg);
				}
			},'json');
		});
	});
})(jQuery);
</script></div>
	</div>
</div>
<!-- 底部 -->

</body>
</html>