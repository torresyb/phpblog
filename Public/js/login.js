/**
 *  登陆页面异步提交
 */
var login = {
	check : function(event){
		var e = event || window.event;
		e.preventDefault();
		var username = $.trim($("#username").val());
		var password = $.trim($("#password").val());
		if(username==''){
			dialog.error('用户名不能为空');
			return false;
		}
		if(password==''){
			dialog.error('密码不能为空'); 
			return false;
		}
		
		var _url = e.data.type=='0'? "/admin/login/add" : "/admin/login/check";

		$.ajax({
			url: _url,
			type:'post',
			dataType: 'json',
			data: {'username': username,'password': password},
			async: false,
			success: function(data){
				if(data.status == 1){
					dialog.success(data.msg,'/admin/index/index');
				}else{
					dialog.error(data.msg);
				}
			}
		});
		
		return false;
	},
};
