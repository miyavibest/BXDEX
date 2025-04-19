<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"/www/wwwroot/159.138.143.90/public/../app/index/view/ucenter/setup.html";i:1550766680;s:61:"/www/wwwroot/159.138.143.90/app/index/view/public/header.html";i:1559554411;}*/ ?>
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
				<div class="earnings">
					<div class="header headerw">
						<a href="<?php echo url('my/index'); ?>" class="icon-left">
							<img src="/static/index/images/left.png" alt="">
						</a>
						<h1><?php echo \think\Lang::get('Language_number_1284'); ?></h1>
					</div>
				</div>
				<div class="set_box"></div>
				<div class="set_box">
					<div class="set_box">
						<div class="set_list list_x username"><span><?php echo \think\Lang::get('Language_number_1285'); ?></span> <span>86<?php echo $phone; ?></span></div>
						<div class="set_list list_x"><a href="<?php echo url('lang'); ?>" class=""><span><?php echo \think\Lang::get('Language_number_1286'); ?></span>
								<span class="lan">
								
								<?php if(($_SESSION['langtemsetv'] == 'zh-cn')): ?>
								
								简体中文
								
								<?php endif; if(($_SESSION['langtemsetv'] == 'en-us')): ?>
								
								English
								
								<?php endif; ?>
								</span> <i class="icon"></i></a></div>
					</div>
				</div>


			</div>
			<div class="exit"><button type="button"><?php echo \think\Lang::get('Language_number_1287'); ?></button></div>
		</div>

		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px")
			$('button').click(function(){
				$.get('<?php echo url("logout"); ?>', {type:'logout'}, function(res){
					if (res.code == 1) {
						location.href = res.url;
					}
				});
			});
		</script>


	</body>
</html>
