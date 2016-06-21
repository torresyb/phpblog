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
<script type='text/javascript' src="/Public/js/kindeditor-all-min.js"></script>
<script type='text/javascript' src="/Public/lang/zh-CN.js"></script>
<script type='text/javascript'>
KindEditor.ready(function(K) {
	K.create('#editor_id', {
		themeType : 'default',
		items : [
			'source', '|', 'undo', 'redo', '|',  'justifyleft', 'justifycenter', 'justifyright',
			'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
			'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
			'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
			'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
			'anchor', 'link'
		],
		uploadJson: '/admin/image/kindupload',
		afterBlur: function(){this.sync();}
	});
});
</script>
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
						placeholder="请填写标题" value="<?php echo ($new["title"]); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputname" class="col-sm-2 control-label">短标题:</label>
				<div class="col-sm-5">
					<input type="text" name="small_title" class="form-control"
						id="inputname" placeholder="请填写短标题" value="<?php echo ($new["small_title"]); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputname" class="col-sm-2 control-label">缩图:</label>
				<div class="col-sm-5">
					<input id="file_upload" name="file_upload" type="file" multiple="true"> 
					<img <?php if(empty($new['thumb'])): ?>style="display: none"<?php endif; ?> id="upload_org_code_img" src="<?php echo ($new["thumb"]); ?>" width="150" height="150"> 
					<input id="file_upload_image" name="thumb" type="hidden" multiple="true" value="<?php echo ($new["thumb"]); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputname" class="col-sm-2 control-label">标题颜色:</label>
				<div class="col-sm-5">
					<select class="form-control" name="title_font_color">
						<option value="">==请选择颜色==</option>

						<?php if(is_array($titleColors)): $k = 0; $__LIST__ = $titleColors;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$titleColor): $mod = ($k % 2 );++$k;?><option value="<?php echo ($k); ?>" <?php if($k == intval($new['title_font_color'])): ?>selected<?php endif; ?> ><?php echo ($titleColor); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="inputname" class="col-sm-2 control-label">所属栏目:</label>
				<div class="col-sm-5">
					<select class="form-control" name="catid">
						<?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><option value="<?php echo ($menu["menu_id"]); ?>" <?php if($menu["menu_id"] == intval($new['catid'])): ?>selected<?php endif; ?> ><?php echo ($menu["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="inputname" class="col-sm-2 control-label">来源:</label>
				<div class="col-sm-5">
					<select class="form-control" name="copyfrom">
						<?php if(is_array($copyfroms)): $k = 0; $__LIST__ = $copyfroms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$copyfrom): $mod = ($k % 2 );++$k;?><option value="<?php echo ($k); ?>" <?php if($k == intval($new['copyfrom'])): ?>selected<?php endif; ?>><?php echo ($copyfrom); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">内容:</label>
				<div class="col-sm-10">
					<textarea class="input js-editor" id="editor_id" name="content" rows="10">
					<?php echo ($content["content"]); ?>
					</textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">描述:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="description"
						id="inputPassword3" placeholder="描述" value="<?php echo ($new["description"]); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">关键字:</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" name="keywords"
						id="inputPassword3" placeholder="请填写关键词" value="<?php echo ($new["keywords"]); ?>">
				</div>
			</div>


			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="hidden" name='news_id' value=<?php echo ($new["news_id"]); ?> />
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
			$.post("/admin/content/add",{'data':data},function(result){
				if(result.status==1){
					dialog.success(result.msg,"/admin/content/index");
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