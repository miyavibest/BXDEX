<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"/www/wwwroot/159.138.143.90/public/../app/index/view/information/index.html";i:1551966520;s:61:"/www/wwwroot/159.138.143.90/app/index/view/public/header.html";i:1559554411;s:58:"/www/wwwroot/159.138.143.90/app/index/view/public/nav.html";i:1550762142;}*/ ?>
	<!DOCTYPE html>
<html class="size">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
		<title>Jade Token</title>
		<link href="/static/index/css/app.css" rel="stylesheet">
		<script src="/static/index/js/jquery-1.js"></script>
	</head>
	<link href="/static/index/css/swiper.min.css" rel="stylesheet">
	<body class="infomar bgW">
		<div id="app">
			<div>
				<div class="header-f">
					<h1><?php echo \think\Lang::get('Language_number_1154'); ?></h1>
				</div>
				<div class="banner" id="slider">
						<ul class="swiper-wrapper">
							<li class="swiper-slide"><img src="/static/index/images/ban1.png"
								 alt="" ></li>
							<li class="swiper-slide"><img src="/static/index/images/ban2.png"
								 alt="" ></li>
							<li class="swiper-slide"><img src="/static/index/images/ban3.png"
								 alt="" ></li>
						</ul>
					<div class="swiper-pagination"></div>
				</div>
				<div>
					<ul class="news-box">
						<?php if(is_array($info) || $info instanceof \think\Collection || $info instanceof \think\Paginator): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<li uid="54" class="news-list">
							<div>
								<a href="<?php echo url('newsInfo', ['id'=>$vo['id']]); ?>" class="">
									<p>
									
									
									<?php if(($_SESSION['langtemsetv'] == 'zh-cn')): ?>
											
										<?php echo $vo['title_ch']; else: ?>
									
										<?php echo $vo['title_en']; endif; ?>
									
									
									
									</p>
									<p><?php echo $vo['pub_time']; ?></p>
								</a>
							</div>
							<div><img src="<?php echo $vo['thumb']; ?>" alt=""></div>
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<style>
.footr div img {
    height: 1.2rem;
}
</style>
<div class="footr">
	<div>
		<a href="<?php echo url('index/index/index',['nav'=>1]); ?>" class="<?php if($nav == '1'): ?>ace<?php endif; ?>"><img src="/static/index/images/<?php if($nav == '1'): ?>n11.png<?php else: ?>n1.png<?php endif; ?>"><br><?php echo \think\Lang::get('Language_number_1230'); ?>
		</a>
	</div>

	<div>
		<a href="<?php echo url('index/market/index',['nav'=>2]); ?>" class="<?php if($nav == '2'): ?>ace<?php endif; ?>"><img src="/static/index/images/<?php if($nav == '2'): ?>n22.png<?php else: ?>n2.png<?php endif; ?>"><br><?php echo \think\Lang::get('Language_number_1231'); ?>
		</a>
	</div>

	<div>
		<a href="<?php echo url('index/information/index',['nav'=>3]); ?>" class="<?php if($nav == '3'): ?>ace<?php endif; ?>"><img src="/static/index/images/<?php if($nav == '3'): ?>n33.png<?php else: ?>n3.png<?php endif; ?>"><br><?php echo \think\Lang::get('Language_number_1232'); ?></a>
	</div>

	<div>
		<a href="<?php echo url('index/my/index',['nav'=>4]); ?>" class="<?php if($nav == '4'): ?>ace<?php endif; ?>"><img src="/static/index/images/<?php if($nav == '4'): ?>n44.png<?php else: ?>n4.png<?php endif; ?>"> <br><?php echo \think\Lang::get('Language_number_1233'); ?>
		</a>
	</div>

</div>
			</div>
		</div>
		<script src="/static/index/js/swiper.min.js"></script>
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px")
			var swiper = new Swiper('#slider', {
				pagination: '.swiper-pagination',
				paginationClickable: true,
				autoplay: 10000,
				loop:true,
				autoplayDisableOnInteraction: false
			});
		</script>
	</body>
</html>
