<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"/www/wwwroot/frcw.52codes.cn/public/../app/index/view/ucenter/announcement_info.html";i:1550809014;s:62:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
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
				<div class="header headerw">
					<a href="<?php echo url('announcement'); ?>" class="icon-left">
						<img src="/static/index/images/left.png" alt="">
					</a>
					<h1><?php echo \think\Lang::get('Language_number_1242'); ?></h1>
				</div>
				<div class="shellInfo">
					<div class="title">
						<h2>
						
						<?php if(($_SESSION['langtemsetv'] == 'zh-cn')): ?>
								
							<?php echo $data['title_ch']; else: ?>
						
							<?php echo $data['title_en']; endif; ?>
						
						</h2>
						<p class="time"><?php echo $data['pub_time']; ?></p>
						<p>
						
						
						<?php if(($_SESSION['langtemsetv'] == 'zh-cn')): ?>
								
							<?php echo htmlspecialchars_decode($data['content_ch']); else: ?>
						
							<?php echo htmlspecialchars_decode($data['content_en']); endif; ?>
						
						
						</p>
					</div>
				</div>
			</div>
		</div>
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px")
		</script>
	</body>
</html>