<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"/www/wwwroot/frcw.52codes.cn/public/../app/index/view/ucenter/announcement.html";i:1550809044;s:62:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
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
					<a href="<?php echo url('my/index'); ?>" class="icon-left">
						<img src="/static/index/images/left.png" alt="">
					</a>
					<h1><?php echo \think\Lang::get('Language_number_1241'); ?></h1>
				</div>
				<div class="shell">
					<ul>
						<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<li uid="40" class="ann-list">
							<a href="<?php echo url('announcementInfo', ['id'=>$vo['id']]); ?>" class="">
								<div class="title">
									<h4>
									
									
									
									<?php if(($_SESSION['langtemsetv'] == 'zh-cn')): ?>
								
										<?php echo $vo['title_ch']; else: ?>
									
										<?php echo $vo['title_en']; endif; ?>
									
									
									</h4>
									<p><?php echo $vo['pub_time']; ?></p> 
									<i class="icon"><img src="/static/index/images/right.png" alt=""></i>
								</div>
							</a>
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			</div>
		</div>
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px")
		</script>
	</body>
</html>