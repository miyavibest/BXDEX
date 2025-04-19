<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"/www/wwwroot/frcw.52codes.cn/public/../app/index/view/my/partnerp.html";i:1550982402;s:62:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
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
		<div id="app">
			<div class="partner">
				<div class="header">
					<a href="<?php echo url('partner'); ?>" class="icon-left">
						<img src="/static/index/images/left1.png" alt="">
					</a>
					<h1><?php echo \think\Lang::get('Language_number_1179'); ?></h1>
				</div>
				<div>
					<ul id="phone"></ul>
					<ul style="display: none;"></ul>
					<ul id="phone">
					</ul>
				</div>
				
			</div>
			
		</div>
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px")
			$(function(){
				$.get('<?php echo url("partnerp"); ?>', {'id':'id'}, function(res){
						html = '';
						$.each(res.data, function(k, v){
							html += '<li class="userparlist">';
							html +=	'<p>'+v.phone+'</p>';
							html +=	'<p class="openno">'+v.open+'</p>';
							html += '</li>';
						});
						$('#phone').html(html);
					});
			})
		</script>
	</body>
</html>