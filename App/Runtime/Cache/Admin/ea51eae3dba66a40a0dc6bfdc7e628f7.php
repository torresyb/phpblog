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

<div class="row">
	<div class="col-lg-6">

		<form class="form-horizontal" id="myForm">
			<div class="form-group">
				<label for="inputname" class="col-sm-2 control-label">推荐位名:</label>
				<div class="col-sm-5">
					<input type="text" name="name" class="form-control" id="inputname"
						placeholder="请填写菜单名" value="<?php echo ($position["name"]); ?>">
				</div>
			</div>

			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">状态:</label>
				<div class="col-sm-5">
					<input type="radio" name="status" id="optionsRadiosInline1" value="1" <?php if(($position["status"] == 1) OR ($position["status"] == null)): ?>checked<?php endif; ?> > 开启
					<input type="radio" name="status" id="optionsRadiosInline2" value="0" <?php if($position["status"] === '0'): ?>checked<?php endif; ?> > 关闭
				</div>

			</div>
			
			<div class="form-group">
				<label for="inputname" class="col-sm-2 control-label">推荐位描述:</label>
				<div class="col-sm-5">
					<textarea name="description" id="" cols="50" rows="4"><?php echo ($position["description"]); ?></textarea>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="hidden" name="id" value='<?php echo ($position["id"]); ?>' />
					<button type="button" class="btn btn-default"
						id="button-submit">提交</button>
				</div>
			</div>
		</form>


	</div>

</div>
<script>
(function($){
	$(function(){
		$("#button-submit").on('click',formSubmit);
		
		function formSubmit(){
			var _data = $("form#myForm").serialize();
			
			$.ajax({
				url:'/admin/position/add',
				type:'post',
				dataType: 'json',
				async: false,
				data: {'data':_data},
				success: function(result){
					if(result.status==1){
						dialog.success(result.msg,'/admin/position/index');
					}else{
						dialog.error(result.msg);
					}
				},
				errer: function(){
					dialog.error('提交數據失敗');
				}
			});
		}
	});
})(jQuery);
</script></div>
	</div>
</div>
<!-- 底部 -->

</body>
</html>