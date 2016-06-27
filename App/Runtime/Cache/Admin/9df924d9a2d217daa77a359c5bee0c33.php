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
		<div id="main" class="col-sm-10"> <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
           	 您好!欢迎使用yangb博客管理平台
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="glyphicon glyphicon-cog"></i> 平台整理指标
            </li>
        </ol>
    </div>
</div>
<div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="glyphicon glyphicon-user"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                            	<div class="number"><?php echo ($logincount); ?></div>
                                <div>今日登录用户数</div>
                            </div>
                        </div>
                    </div>
                    
                        <div class="panel-footer">
                            <span class="pull-left"></span>
                            <span class="pull-right"><i class="">&nbsp;</i></span>
                            <div class="clearfix"></div>
                        </div>
                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                            	<div class="number"><?php echo ($newscount); ?></div>
                                <div>文章数量</div>
                            </div>
                        </div>
                    </div>
                    <a href="/admin/content/index">
                        <div class="panel-footer">
                            <span class="pull-right"><i class="glyphicon glyphicon-hand-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="glyphicon glyphicon-fire"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                            	<div class="number"><?php echo ($new[0]['count']); ?></div>
                                <div>文章最大阅读数</div>
                            </div>
                        </div>
                    </div>
                    <a target="_blank" href="/home/detail/index?id=<?php echo ($new[0]['news_id']); ?>">
                        <div class="panel-footer">
                            <span class="pull-left"></span>
                            <span class="pull-right"><i class="glyphicon glyphicon-hand-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="glyphicon glyphicon-send"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                            	<div class="number"><?php echo ($positioncount); ?></div>
                                <div>推荐位数</div>
                            </div>
                        </div>
                    </div>
                    <a href="/admin/position">
                        <div class="panel-footer">
                            <span class="pull-right"><i class="glyphicon glyphicon-hand-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div></div>
	</div>
</div>
<!-- 底部 -->

</body>
</html>