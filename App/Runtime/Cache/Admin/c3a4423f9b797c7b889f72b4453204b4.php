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
		            <li><a href="/admin/admin/add?id=<?php echo ($_SESSION['adminInfo']['admin_id']); ?>">个人中心</a></li>
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
			<?php  $navs = D('Menu')->getAdminMenus(); $username = getLoginUserName(); foreach($navs as $k=>$v){ if($v['c']=='admin' && $username !='admin'){ unset($navs[$k]); } } ?>

<ul class="nav nav-pills nav-stacked">
  <li <?php if($Think.CONTROLLER_NAME=='Index'): ?>class="active"<?php endif; ?> ><a href="/admin/index/index">首页</a></li>
  <?php if(is_array($navs)): $i = 0; $__LIST__ = $navs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li <?php echo (getActive($nav["c"])); ?>><a href="/<?php echo ($nav["m"]); ?>/<?php echo ($nav["c"]); ?>/<?php echo ($nav["f"]); ?>"><?php echo ($nav["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
		</div>
		<div id="main" class="col-sm-10"><div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li><i class="glyphicon glyphicon-cog"></i> <a
				href="/admin/menu">推荐位管理</a></li>
			<li class="active"><i class="glyphicon glyphicon-calendar"></i><?php echo ($navname); ?></li>
		</ol>
	</div>
</div>

	
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
								<th>id</th>
								<th>菜单名</th>
								<th>描述</th>
								<th>状态</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($positions)): $i = 0; $__LIST__ = $positions;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$position): $mod = ($i % 2 );++$i;?><tr>
									<td><?php echo ($position["id"]); ?></td>
									<td><?php echo ($position["name"]); ?></td>
									<td><?php echo ($position["description"]); ?></td>
									<td><?php echo (getMenuStatus($position["status"])); ?></td>
									<td>
										<a href="/admin/position/add/id/<?php echo ($position["id"]); ?>">
											<span class="glyphicon glyphicon-edit" id="edit"></span> 
										</a>
										<a href="javascript:;" data-id="<?php echo ($position["id"]); ?>" class="deleted">
											<span class="glyphicon glyphicon-remove-circle"></span>
										</a>
									</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
							
						</tbody>
					</table>
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
		location.href="/admin/position/add";
	});
	
	// 删除回调函数
	function todeleted(url,data){
		$.post(url,data,function(result){
			if(result.status==1){
				dialog.success(result.msg,'/admin/position/index');
			}else{
				dialog.error(result.msg,'/admin/position/index');
			}
		},'json');
	}
	
	// 删除操作
	$('a.deleted').on('click', function(e){
		e.preventDefault();
		var $this = $(this);
		var id = $this.data('id');
		var url = '/admin/position/deleted';
		var data = {'id':id}
		
		dialog.confirmBack('是否确定删除推荐位',todeleted,[url,data]);
		
	});
	

})(jQuery);
</script></div>
	</div>
</div>
<!-- 底部 -->

</body>
</html>