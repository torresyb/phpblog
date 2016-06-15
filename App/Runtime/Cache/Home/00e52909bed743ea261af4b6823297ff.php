<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>thinkphp learn</title>
</head>
<body>
	<form action="/index.php/Home/Index/update" method="post">
		标题：<INPUT type="text" name="title" value=<?php echo ($result["title"]); ?>><br/>
		内容：<TEXTAREA name="content" rows="5" cols="45"><?php echo ($result["content"]); ?></TEXTAREA><br/>
		<input type="hidden" name='id' value=<?php echo ($result["id"]); ?> />
		<INPUT type="submit" value="提交">
	</form>
</body>
</html>