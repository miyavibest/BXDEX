<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:73:"/www/wwwroot/frcw.52codes.cn/public/../app/index/view/ucenter/server.html";i:1550771606;s:62:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
	<!DOCTYPE html>
<html class="size">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
		<title>Jade Token</title>
		<link href="/static/index/css/app.css" rel="stylesheet">
		<script src="/static/index/js/jquery-1.js"></script>
	</head>
	<body class="wallet">
		<div>
			<div class="header headerw">
				<a href="<?php echo url('about'); ?>" class="icon-left">
					<img src="/static/index/images/left.png" alt="">
				</a>
				<h1><?php echo \think\Lang::get('Language_number_1272'); ?></h1>
			</div>
			<div class="Useagreement">
				<h2><?php echo \think\Lang::get('Language_number_1273'); ?></h2>
				<ul>
					<?php echo \think\Lang::get('Language_number_1274'); ?>
				</ul>
			</div>
		</div>
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px")
		</script>
	</body>
</html>