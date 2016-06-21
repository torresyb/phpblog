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
		<div id="main" class="col-sm-10"><link rel="stylesheet" href="/Public/css/uploadify.css" />

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li><i class="glyphicon glyphicon-cog"></i> <a
				href="/admin/admin"><?php echo ($title); ?></a></li>
			<li class="active"><i class="glyphicon glyphicon-calendar"></i> <?php echo ($navname); ?> </li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">

		<form class="form-horizontal" id="myform">
			<div class="form-group">
				<label for="inputname" class="col-sm-2 control-label">标题:</label>
				<div class="col-sm-5">
					<input type="text" name="title" class="form-control" id="inputname"
						placeholder="请填写标题" value="<?php echo ($positioncontent["title"]); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputname" class="col-sm-2 control-label">选择推荐位:</label>
				<div class="col-sm-5">
					<select class="form-control" name="positionId">
						<option value="">==请选择推荐位==</option>

						<?php if(is_array($positions)): $i = 0; $__LIST__ = $positions;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$position): $mod = ($i % 2 );++$i;?><option value="<?php echo ($position["id"]); ?>" <?php if($positioncontent['position_id'] == $position['id']): ?>selected<?php endif; ?> ><?php echo ($position["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputname" class="col-sm-2 control-label">缩图:</label>
				<div class="col-sm-5">
					<input id="file_upload" name="file_upload" type="file" multiple="true"> 
					<img <?php if(empty($positioncontent['thumb'])): ?>style="display: none"<?php endif; ?> id="upload_org_code_img" src="<?php echo ($positioncontent["thumb"]); ?>" width="150" height="150"> 
					<input id="file_upload_image" name="thumb" type="hidden" multiple="true" value="<?php echo ($positioncontent["thumb"]); ?>">
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputname" class="col-sm-2 control-label">URL:</label>
				<div class="col-sm-5">
					<input type="text" name="url" class="form-control"
						id="url" placeholder="请填写url" value="<?php echo ($positioncontent["url"]); ?>">
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputname" class="col-sm-2 control-label">文章ID:</label>
				<div class="col-sm-5">
					<input type="text" name="news_id" <?php if($_GET['id']): ?>disabled<?php endif; ?> class="form-control"
						id="news_id" placeholder="请填写文章ID" value="<?php echo ($positioncontent["news_id"]); ?>">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label">状态:</label>
				<div class="col-sm-5">
					<input type="radio" name="status" value="1" <?php if(($positioncontent["status"] == 1) OR ($positioncontent["status"] == null)): ?>checked<?php endif; ?> > 开启
					<input type="radio" name="status" value="0" <?php if($positioncontent["status"] === '0'): ?>checked<?php endif; ?> > 关闭
				</div>

			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="hidden" name='id' value=<?php echo ($positioncontent['id']); ?> />
					<button type="button" class="btn btn-default" id="button-submit">提交</button>
				</div>
			</div>
		</form>


	</div>

</div>

<script type='text/javascript'>
	var SCOPE = {'upload_url':'/admin/image/ajaxuploadimage'}
</script>
<script type='text/javascript' src="/Public/js/jquery.uploadify.min.js"></script>
<script type='text/javascript' src="/Public/js/image.js"></script>
<script type='text/javascript'>
	(function($){
		$("#button-submit").on('click',function(e){
			e.preventDefault();
			var data = $("form#myform").serialize();
			$.post("/admin/positioncontent/add",{'data':data},function(result){
				if(result.status==1){
					dialog.success(result.msg,"/admin/positioncontent/index");
				}else{
					dialog.error(result.msg);
				}
			},'json');
		});
	})(jQuery);
</script>
</div>
	</div>
</div>
<!-- 底部 -->

</body>
</html>