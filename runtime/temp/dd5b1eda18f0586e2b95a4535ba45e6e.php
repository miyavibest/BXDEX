<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"/www/wwwroot/frcw.52codes.cn/public/../app/index/view/my/partner.html";i:1550982312;s:62:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
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
					<a href="<?php echo url('index'); ?>" class="icon-left">
						<img src="/static/index/images/left1.png" alt="">
					</a>
					<h1><?php echo \think\Lang::get('Language_number_1179'); ?></h1>
				</div>
				<div>
					<ul id="phone"></ul>
					<ul style="display: none;"></ul>
					<ul id="phone">
					<a href="<?php echo url('partnerp'); ?>"><li class="userparlist"  style=" display:flex;"><img src="/static/index/images/logopp.jpg" style="height:36px"><label style="display: block;height: 36px;line-height: 36px;">我的伙伴</label><span style="display: block;height: 36px;line-height: 36px;">></span></li></a>
					<li class="userparlist"  style=" display:flex;"><img src="/static/index/images/logopp.jpg" style="height:36px"><label style="display: block;height: 36px;line-height: 36px;">团队实名人数</label><span style="display: block;height: 36px;line-height: 36px;"><?php echo $datap['smnum']; ?></span></li>
					<li class="userparlist"  style=" display:flex;"><img src="/static/index/images/logopp.jpg" style="height:36px"><label style="display: block;height: 36px;line-height: 36px;">分享量化总额</label><span style="display: block;height: 36px;line-height: 36px;"><?php echo $datap['lianghuazonge1']; ?> $</span></li>
					<li class="userparlist"  style=" display:flex;"><img src="/static/index/images/logopp.jpg" style="height:36px"><label style="display: block;height: 36px;line-height: 36px;">团队量化总额</label><span style="display: block;height: 36px;line-height: 36px;"><?php echo $datap['zonge']; ?> $</span></li>
					</ul>
				</div>
				
			</div>
			
		</div>
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px")
			$(function(){
				$.get('<?php echo url("partner"); ?>', {'id':'id'}, function(res){
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