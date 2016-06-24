<?php if (!defined('THINK_PATH')) exit(); $basic = new \Admin\Model\BasicModel(); $config = $basic->show(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo ($config["title"]); ?></title>
<meta name="keywords" content="<?php echo ($config["keyword"]); ?>"/>
<meta name="description" content="<?php echo ($config["description"]); ?>"/>
<link rel="stylesheet" href="/Public/css/bootstrap.min.css">
<link rel="stylesheet" href="/Public/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="/Public/css/home/main.css">
<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/js/layer.js"></script>
<script type="text/javascript" src="/Public/js/dialog.js"></script>
</head>
<body>
<!-- 导航栏 -->
<?php
 $menu = new \Admin\Model\MenuModel(); $navs = $menu->getBarMenus(); ?>
<header id="header">
  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <a href="/">
          <img src="/Public/images/logo.png" alt="">
        </a>
      </div>
      <ul class="nav navbar-nav navbar-left">
        <li><a href="/" <?php if($_GET['id'] == null): ?>class="curr"<?php endif; ?> >首页</a></li>
        <?php if(is_array($navs)): foreach($navs as $key=>$nav): ?><li><a href="/home/cat?id=<?php echo ($nav['menu_id']); ?>" <?php if($nav['menu_id'] == $_GET['id']): ?>class="curr"<?php endif; ?> ><?php echo ($nav['name']); ?></a></li><?php endforeach; endif; ?>
      </ul>
    </div>
  </div>
</header>
<!-- 内容主体 -->
<div id="container">
	<div class="container">
	<h1 class="text-center bg-danger" style="padding:20px 0"><?php echo ($message); ?></h1>
	<div id="error" class="text-center"><span>3</span>s后调整</div>
</div>
<script>
$(function(){
	var time = 3;
	var Timer = setInterval(function(){
		--time;
		if(time==0){
			location.href="/";
			clearInterval(Timer);
		}
		$("#error span").html(time);
	},1000);
});
</script>
</div>
<!-- 底部 -->

</body>
</html>