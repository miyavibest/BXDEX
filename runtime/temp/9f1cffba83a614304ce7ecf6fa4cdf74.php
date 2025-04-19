<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"/www/wwwroot/frcw.52codes.cn/public/../app/index/view/ucenter/lang.html";i:1550766206;s:62:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
	<!DOCTYPE html>
<html class="size">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
		<title>Jade Token</title>
		<link href="/static/index/css/app.css" rel="stylesheet">
		<script src="/static/index/js/jquery-1.js"></script>
	</head>
	<body class="wallet setBox">
		<div id="app">
			<div>
				<div class="header headerw"><a href="Setup.html" class="icon-left"><img src="/static/index/images/left.png"
						 alt=""></a>
					<h1><?php echo \think\Lang::get('Language_number_1256'); ?></h1>
				</div>
				<div>
					<ul class="lan">
						<li class="flex-box">
							<div class="flex-list left" onclick="langen()">English</div>
							<div class="flex-list right">
							<?php if(($_SESSION['langtemsetv'] == 'en-us')): ?>
							<img src="/static/index/images/dui.png" alt="">
							<?php endif; ?>
							
							</div>
						</li>
						<li class="flex-box">
							<div class="flex-list left" onclick="langcn()">简体中文</div>
							<div class="flex-list right">
							<?php if(($_SESSION['langtemsetv'] == 'zh-cn')): ?>
							<img src="/static/index/images/dui.png" alt="">
							<?php endif; ?>
							
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px");
			
			
			
			function langcn() {
				$.post('<?php echo url("/index/index/langcn"); ?>', {}, function(res){
					location.reload();
				});
			}
			function langen() {
				$.post('<?php echo url("/index/index/langen"); ?>', {}, function(res){
					location.reload();
				});
			}
		</script>
	</body>
</html>