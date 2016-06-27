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

<div class="row">
	<div class="col-lg-12 gb20 text-right">
		<button id="button-add" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
			aria-haspopup="true" aria-expanded="false">
			<span class="glyphicon glyphicon-plus"></span>添加
		</button>
	</div>
	
	<!-- 菜單列表 -->
	<div class="col-lg-12">
		<div class="table-responsive">
	        <form id="singcms-listorder">
		        <table class="table table-bordered table-hover singcms-table">
		            <thead>
		            <tr>
		                <th>id</th>
		                <th>用户名</th>
		                <th>真实姓名</th>
		                <th>最后登录时间</th>
		                <th>状态</th>
		                <th>操作</th>
		            </tr>
		            </thead>
		            <tbody>
		            	<?php if(is_array($admins)): foreach($admins as $key=>$admin): ?><tr>
		                    <td><?php echo ($admin["admin_id"]); ?></td>
		                    <td><?php echo ($admin["username"]); ?></td>
		                    <td><?php echo ($admin["realname"]); ?></td>
		                    <td><?php echo (date('Y-m-d H:i:s',(isset($admin["lastlogintime"]) && ($admin["lastlogintime"] !== ""))?($admin["lastlogintime"]):"")); ?></td>
		                    <td class="status status_<?php echo ($admin["admin_id"]); ?>" data-id="<?php echo ($admin["admin_id"]); ?>" data-status=<?php if($admin["status"] == 0): ?>"1"<?php else: ?>"0"<?php endif; ?> ><?php echo (getStatus($admin["status"])); ?></td>
							<td>
								<a href="/admin/admin/add?id=<?php echo ($admin["admin_id"]); ?>" title="编辑" class="glyphicon glyphicon-edit tp-edit"></a> 
								<a href="javascript:void(0)" class="tp-delete" data-id="<?php echo ($admin["admin_id"]); ?>" title="删除"> 
									<span class="glyphicon glyphicon-remove-circle" ></span>
								</a>
							</td>
		                </tr><?php endforeach; endif; ?>
		            </volist>
		
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
	$(function(){
		// 添加文章
		$("#button-add").on('click',function(e){
			e.preventDefault();
			location.href="/admin/admin/add";
		});
		
		// 删除文章
		$('.tp-delete').on('click',function(e){
			e.preventDefault();
			var id = $(this).data('id');
			var url = '/admin/admin/delete';
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
			var url = '/admin/admin/delete';
			
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
						/* console.log($('.status_'+data['id']).data('status')); */
					}else{
						dialog.success(result.msg,'/admin/admin/index');
					}
				}else{
					if(result.data==1){
						dialog.error(result.msg);
					}else{
						dialog.error(result.msg,'/admin/admin/index');
					}
				}
			},'json');
		}
		
		// 添加排序
		$('#button-orderlist').on('click', function(e){
			e.preventDefault();
			var str = $("form#listorder").serialize();
			$.post('/admin/positioncontent/listorder',{'data':str},function(result){
				if(result.status==1){
					dialog.success(result.msg,'/admin/admin/index');
				}else{
					dialog.error(result.msg,'/admin/admin/index');
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