<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"/www/wwwroot/frcw.52codes.cn/public/../app/index/view/ucenter/about.html";i:1550976626;s:62:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
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
		<div class="about">
			<div class="header headerw">
				<a href="<?php echo url('my/index'); ?>" class="icon-left">
					<img src="/static/index/images/left.png" alt="">
				</a>
				<h1><?php echo \think\Lang::get('Language_number_1234'); ?></h1>
			</div>
			<div class="aboutlogo"><img src="/static/index/images/landlogo.png" alt=""></div>
			<div>
				<ul class="about_list">
					<a href="<?php echo url('agreement'); ?>" class="">
						<li class="flex-box">
							<div class="flex-list left"><?php echo \think\Lang::get('Language_number_1235'); ?></div>
							<div class="flex-list"><i class="icon"></i></div>
						</li>
					</a>
					<a href="<?php echo url('server'); ?>" class="">
						<li class="flex-box">
							<div class="flex-list left"><?php echo \think\Lang::get('Language_number_1236'); ?></div>
							<div class="flex-list"><i class="icon"></i></div>
						</li>
					</a>
					<li class="flex-box">
						<div class="flex-list left"><?php echo \think\Lang::get('Language_number_1237'); ?></div>
						<div class="flex-list right" style="color: rgb(201, 200, 205);">1.0.1</div>
					</li>
				</ul>
			</div>
		</div>

		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px")
		</script>
	</body>
</html>