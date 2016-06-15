$(function() {
	$('#file_upload').uploadify({
		'swf'      : '/public/uploadify.swf',
		'uploader' : SCOPE.upload_url,
		'buttonText': '上传图片',
		'fileTypeDesc': 'Image Files',
		'fileObjName' : 'file',
		'fileTypeExts': '*.gif;*.jpg;*.png',
		'onUploadSuccess': function(file,data,response){
			var obj = JSON.parse(data);
			$("#upload_org_code_img").attr('src',obj.data).show();
			$("#file_upload_image").val(obj.data);
			return false;
		}
	});
});