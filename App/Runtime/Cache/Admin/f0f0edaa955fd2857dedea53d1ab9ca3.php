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
<style>
html,body{background-color:#fff;}
</style>
</head>
<body>

<!-- 内容主体 -->
<div id="content_login">
	<form action="" method = "post">
	<h2 class="form-signin-heading text-center">请登录</h2>
	<div class="form-group">
		<label for="username">用户名</label> <input
			type="text" class="form-control" id="username"
			placeholder="填写用户名" name="username">
	</div>
	<div class="form-group">
		<label for="password">密码</label> <input
			type="password" name="password" class="form-control" id="password"
			placeholder="填写密码">
	</div>
	<button type="button" class="btn btn-primary" id="submit">登 陆</button>
</form>

<script type="text/javascript" src="/Public/js/login.js"></script>
<script type="text/javascript">
(function($){
	$(function(){
		$("#submit").on('click',{type:'1'},login.check)
	});
})(jQuery);
</script>
</div>
<!-- 底部 -->

</body>
</html>