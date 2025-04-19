<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:77:"/www/wwwroot/159.138.143.90/public/../app/index/view/openamount/openlist.html";i:1551957902;s:61:"/www/wwwroot/159.138.143.90/app/index/view/public/header.html";i:1559554411;}*/ ?>
	<!DOCTYPE html>
<html class="size">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
		<title>Jade Token</title>
		<link href="/static/index/css/app.css" rel="stylesheet">
		<script src="/static/index/js/jquery-1.js"></script>
	</head>
	<body class="wallet bitinfo">
		<div id="app">
			<div>
				<div class="header">
					<a href="<?php echo url('openamount/index'); ?>" class="icon-left">
						<img src="/static/index/images/left.png" alt="">
					</a>
					<h1><?php echo \think\Lang::get('Language_number_1227'); ?></h1>
				</div>
				<div class="bit">
					<ul>
					<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<li class="flex-box bit_list">
							<div class="flex-list bittype"><span><img src="/static/index/images/<?php echo $vo['logo']; ?>" alt=""></span> <span>
									<p style="text-transform: uppercase;"><?php echo $vo['coin']; ?></p>
								</span></div>
							<div class="flex-list bittime">
								<p style="text-transform: uppercase;"><?php if($vo['inout'] == 'in'): ?><?php echo \think\Lang::get('Language_number_1228'); else: ?> <?php echo \think\Lang::get('Language_number_1229'); endif; ?><?php echo $vo['num']; ?><?php echo $vo['coin']; ?></p>
								<p><?php echo date("Y-m-d H:i:s",$vo['add_time']); ?></p>
							</div>
						</li>
					<?php endforeach; endif; else: echo "" ;endif; if(is_array($listp) || $listp instanceof \think\Collection || $listp instanceof \think\Paginator): $i = 0; $__LIST__ = $listp;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<li class="flex-box bit_list">
							<div class="flex-list bittype"><span><img src="/static/index/images/<?php echo $vo['logo']; ?>" alt=""></span> <span>
									<p style="text-transform: uppercase;"><?php echo $vo['coin']; ?></p>
								</span></div>
							<div class="flex-list bittime">
								<p style="text-transform: uppercase;"><?php if($vo['type'] == '1'): ?>量化转入<?php else: ?>量化转出<?php endif; ?>审核中<?php echo $vo['sjnum']; ?><?php echo $vo['coin']; ?></p>
								<p><?php echo date("Y-m-d H:i:s",$vo['time']); ?></p>
							</div>
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