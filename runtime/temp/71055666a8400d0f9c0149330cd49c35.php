<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"/www/wwwroot/159.138.143.90/public/../app/index/view/market/index.html";i:1559099194;s:61:"/www/wwwroot/159.138.143.90/app/index/view/public/header.html";i:1559554411;s:58:"/www/wwwroot/159.138.143.90/app/index/view/public/nav.html";i:1550762142;}*/ ?>
	<!DOCTYPE html>
<html class="size">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
		<title>Jade Token</title>
		<link href="/static/index/css/app.css" rel="stylesheet">
		<script src="/static/index/js/jquery-1.js"></script>
	</head>
	<body class="market">
		<div id="app">
			<div>
				<div class="header-f">
					<h1><?php echo \think\Lang::get('Language_number_1156'); ?></h1>
				</div>
				<div class="view-header">
					<div class="flex-box tab">
						<div class="flex-list">
							<p><?php echo \think\Lang::get('Language_number_1157'); ?></p>
						</div>
						<div class="flex-list"><?php echo \think\Lang::get('Language_number_1158'); ?></div>
						<div class="flex-list"><?php echo \think\Lang::get('Language_number_1159'); ?></div>
					</div>
					<div class="bit">
						<ul>
						<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<a href="/index/market/cointimepe/coin/<?php echo $vo['name']; ?>.html?#/Market" class="router-link-exact-active router-link-active">
								<li class="flex-box bit_list">
									<div class="flex-list bittype">
										<p style="text-transform: uppercase;"><?php echo $vo['name']; ?></p>
										<p><?php echo $vo['name']; ?></p>
									</div>
									<div class="flex-list"><span class="off">$<?php echo $vo['last']; ?></span></div>
									<div class="flex-list range"><?php echo $vo['rate']; ?></div>
								</li>
						</a>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					    </ul>
					</div>
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
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px")
		</script>
	</body>
</html>