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
				href="/admin/menu">菜单管理</a></li>
			<li class="active"><i class="glyphicon glyphicon-calendar"></i><?php echo ($navname); ?></li>
		</ol>
	</div>
</div>

<!-- 收縮 -->
<div class="row">
	<div class="col-lg-12 gb20">
		<form action="/admin/menu/index" method="get">
	
			<div class="input-group">
				<span class="input-group-addon">类型</span>
				 <select class="form-control" name="type">
					<option value=''>请选择类型</option>
	
					<option value="1" <?php if($type === 1): ?>selected<?php endif; ?> >后台菜单</option>
					<option value="0" <?php if($type === 0): ?>selected<?php endif; ?> >前端导航</option>
				</select>
				<span class="input-group-btn">
					<button id="sub_data" type="submit" class="btn btn-primary">
						<i class="glyphicon glyphicon-search"></i>
					</button>
				</span>
			</div>
	
		</form>
	</div>
	<!-- End 收縮 -->
	
	<div class="col-lg-12 gb20 text-right">
		<button id="button-add" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
			aria-haspopup="true" aria-expanded="false">
			<span class="glyphicon glyphicon-plus"></span>添加
		</button>
	</div>
	
	<!-- 菜單列表 -->
	<div class="col-lg-12">
			<div class="table-responsive">
				<form id="listorderform">
					<table class="table table-bordered table-hover singcms-table">
						<thead>
							<tr>
								<th width="20px">排序</th>
								<th>id</th>
								<th>菜单名</th>
								<th>模块名</th>
								<th>类型</th>
								<th>状态</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><tr>
									<td><input type="text" style="width:30px" name="listorder[<?php echo ($menu["menu_id"]); ?>]" value='<?php echo ($menu["listorder"]); ?>' /></td>
									<td><?php echo ($menu["menu_id"]); ?></td>
									<td><?php echo ($menu["name"]); ?></td>
									<td><?php echo ($menu["m"]); ?></td>
									<td><?php echo (getMenuType($menu["type"])); ?></td>
									<td><?php echo (getMenuStatus($menu["status"])); ?></td>
									<td>
										<a href="/admin/menu/add/id/<?php echo ($menu["menu_id"]); ?>">
											<span class="glyphicon glyphicon-edit" id="edit"></span> 
										</a>
										<a href="javascript:;" data-id="<?php echo ($menu["menu_id"]); ?>" class="deleted">
											<span class="glyphicon glyphicon-remove-circle"></span>
										</a>
									</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
							
						</tbody>
					</table>
					<button id="button-orderlist" type="button" class="btn btn-primary dropdown-toggle">
						<span class="glyphicon glyphicon-plus"></span>添加排序
					</button>
				</form>
				<div class='text-right'>
					<ul class="pagination">
						<?php echo ($pagination); ?>
					</ul>
				</div>
	
			</div>
	</div>
	<!-- End 菜單列表 -->
</div>
<script>
(function($){
	// 添加菜单
	$("#button-add").on('click',function(e){
		e.preventDefault();
		location.href="/admin/menu/add";
	});
	
	// 删除回调函数
	function todeleted(url,data){
		$.post(url,data,function(result){
			if(result.status==1){
				dialog.success(result.msg,'/admin/menu/index');
			}else{
				dialog.error(result.msg,'/admin/menu/index');
			}
		},'json');
	}
	
	// 删除操作
	$('a.deleted').on('click', function(e){
		e.preventDefault();
		var $this = $(this);
		var id = $this.data('id');
		var url = '/admin/menu/deleted';
		var data = {'id':id}
		
		dialog.confirmBack('是否确定删除菜单',todeleted,[url,data]);
		
	});
	
	// 添加排序
	$('#button-orderlist').on('click', function(e){
		e.preventDefault();
		var str = $("form#listorderform").serialize();
		
		$.post('/admin/menu/orderlist',{'data':str},function(result){
			if(result.status==1){
				dialog.success(result.msg,'/admin/menu/index');
			}else{
				dialog.error(result.msg,'/admin/menu/index');
			}
		},'json');
	});

})(jQuery);
</script></div>
	</div>
</div>
<!-- 底部 -->

</body>
</html>