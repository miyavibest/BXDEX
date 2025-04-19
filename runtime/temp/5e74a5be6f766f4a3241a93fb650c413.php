<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"/www/wwwroot/frcw.52codes.cn/public/../app/index/view/information/news_info.html";i:1550811482;s:62:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
	<!DOCTYPE html>
<html class="size">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
		<title>Jade Token</title>
		<link href="/static/index/css/app.css" rel="stylesheet">
		<script src="/static/index/js/jquery-1.js"></script>
	</head>
	<body class="bgW">
		<div id="app">
			<div class="header">
				<a href="<?php echo url('information/index'); ?>" class="icon-left">
					<img src="/static/index/images/left.png" alt="">
				</a>
				<h1><?php echo \think\Lang::get('Language_number_1155'); ?></h1>
			</div>
			<div>
				<div class="news">
					<h4><?php echo $list['title_ch']; if(($_SESSION['langtemsetv'] == 'zh-cn')): ?>
							
						<?php echo $list['title_ch']; else: ?>
					
						<?php echo $list['title_en']; endif; ?>
					
					
					</h4>
					<p class="time"><?php echo $list['pub_time']; ?></p>
					<p>
					
					
					<?php if(($_SESSION['langtemsetv'] == 'zh-cn')): ?>
							
						<?php echo htmlspecialchars_decode($list['content_ch']); else: ?>
					
						<?php echo htmlspecialchars_decode($list['content_en']); endif; ?>
					
					
					
					</p>
				</div>
				<div></div>
			</div>
		</div>
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px")
		</script>
	</body>
</html>