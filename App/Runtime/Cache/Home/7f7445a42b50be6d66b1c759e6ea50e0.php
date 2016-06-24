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
<div id="container" class="container">
	<div class="row">
		<div id="main" class="col-sm-9 col-md-9">
			<h2 class="text-center"><?php echo ($result['new']['title']); ?></h2>
<p class="text-right news-info"><?php echo ($result["new"]["keywords"]); ?><span><?php echo (date("Y-m-d H:i:s",$result['new']['create_time'])); ?></span>阅读(<i><?php echo ($result["new"]["count"]); ?></i>)</p>
<p><?php echo (htmlspecialchars_decode($result['content']['content'])); ?></p>
		</div>
		<div id="rmain" class="col-sm-3 col-md-3">
			<div class="right-title">
        <h3>文章排行</h3>
        <span>TOP ARTICLES</span>
      </div>
      <div class="right-content">
        <ul>
        	<?php if(is_array($result["rankNews"])): $key = 0; $__LIST__ = $result["rankNews"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rankNew): $mod = ($key % 2 );++$key;?><li class="num<?php echo ($key); ?> curr">
            <a href="/admin/detail?id=<?php echo ($rankNew["news_id"]); ?>"><?php echo ($rankNew["title"]); ?></a>
            <?php if($key == 1): ?><div class="intro">
              <?php echo ($rankNew["description"]); ?>
            </div><?php endif; ?>
          </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div>
      <?php if(is_array($result['rightPicNews'])): foreach($result['rightPicNews'] as $key=>$rightPicNew): ?><div class="right-hot">
	<a href="<?php echo (getRightUrl($rightPicNew['news_id'],$rightPicNew['url'])); ?>"><img src="<?php echo ($rightPicNew['thumb']); ?>" alt="<?php echo ($rightPicNew['title']); ?>" title="<?php echo ($rightPicNew['title']); ?>"></a>
</div><?php endforeach; endif; ?>



        
		</div>
	</div>
</div>
<!-- 底部 -->

</body>
</html>