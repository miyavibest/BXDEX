<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"/www/wwwroot/frcw1.52codes.cn/public/../app/index/view/wallet/earnings.html";i:1551414744;s:63:"/www/wwwroot/frcw1.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
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
			<div>
				<div class="earnings">
					<div class="header-f">
					<!--  <?php echo url('index/index/index'); ?>  -->
						<a href="javascript:history.go(-1);" class="icon-left">
							<img src="/static/index/images/left1.png" alt="">
						</a>
						<h1><?php echo \think\Lang::get('Language_number_1410'); ?></h1>
					</div>
				</div>
				<div class="view view1">
					<div class="userinfo">
						<div class="userearnings">
							<p><?php echo \think\Lang::get('Language_number_1411'); ?>(<?php echo \think\Lang::get('Language_number_1412'); ?>$<?php echo sprintf4($price_now); ?>)</p>
							<h2><?php echo sprintf4($total_price); ?></h2>
						</div>
						<div class="userearnings">
							<p><?php echo \think\Lang::get('Language_number_1413'); ?></p>
							<p><?php echo sprintf4($personComain); ?></p>
						</div>
						<div class="userearnings">
							<p><?php echo \think\Lang::get('Language_number_1414'); ?></p>
							<p><?php echo sprintf4($total_num); ?></p>
						</div>
						<div><img src="" alt=""></div>
						<div class="vip">
							<!--
								<span class="viptype vipbg_2" style="background: url(/static/index/images/indexv<?php echo $level2; ?>.png);	width: 3rem;height: 1rem;line-height: 1rem;color:#fff;     padding-left:0.5rem;    background-size: 100% 100%;">
								
									<?php if($level==1): ?>
										<?php echo \think\Lang::get('Language_number_1164'); elseif($level==2): ?>
										VIP1
									<?php elseif($level==3): ?>
										VIP2
                                  	<?php else: ?>
										<?php echo \think\Lang::get('Language_number_1165'); endif; ?>
								
									
								</span> 
								-->
								
								<?php if($level2==2): ?>
									<span class="viptype vipbg_2" style="background: url(/static/index/images/indexv<?php echo $level2; ?>.png);	    width: 3rem;height: 2.5rem;margin-top: -0.75rem;    background-size: 100% 100%;">
									</span> 
								<?php elseif($level2==3): ?>
									<span class="viptype vipbg_2" style="background: url(/static/index/images/indexv<?php echo $level2; ?>.png);	    width: 3rem;height: 2.5rem;margin-top: -0.75rem;    background-size: 100% 100%;">
									</span> 
								<?php elseif($level2==4): ?>
									<span class="viptype vipbg_2" style="background: url(/static/index/images/indexv<?php echo $level2; ?>.png);	    width: 3rem;height: 2.5rem;margin-top: -0.75rem;    background-size: 100% 100%;">
									</span> 
								<?php else: ?>
									<span class="viptype vipbg_2" style="background: url(/static/index/images/<?php echo \think\Lang::get('Language_number_1431'); ?>.png);	width: 3rem;height: 2.5rem;margin-top: -0.75rem;    background-size: 100% 100%;">
									</span> 
								<?php endif; ?>
							<span class="vipicon">
								<img src="/static/index/images/viptype<?php echo $level2; ?>.png" alt="">
							</span>
						</div>
					</div>
					<div class="ctitle">
						<div><?php echo \think\Lang::get('Language_number_1417'); ?></div>
					</div>
					<div>
						<ul>
							<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['inout'] == 'out'): ?>
							<li class="flex-box earningsinfo_list">
								<div class="flex-list left">
									<h4>
									<?php if(($_SESSION['langtemsetv'] == 'zh-cn')): ?>
										<?php echo $vo['type']; else: if(($vo['type'] == '签到福利')): ?>
											Sign-in Welfare
										<?php elseif(($vo['type'] == '转出')): ?>
										
										Transfer
										<?php elseif(($vo['type'] == '转入')): ?>
										
										into
										<?php elseif(($vo['type'] == '开启量化')): ?>
										
										Open Quantity
										<?php elseif(($vo['type'] == '关闭量化-')): ?>
										
										Close Quantity -
										<?php elseif(($vo['type'] == '每日收益')): ?>
										
										
										Daily Revenue 
										<?php elseif(($vo['type'] == '系统充值')): ?>
										System Refill
										
										<?php elseif(($vo['type'] == '兑换')): ?>
										Exchange 
										
										<?php elseif(($vo['type'] == '提币')): ?>
										
										Tenancy
										<?php elseif(($vo['type'] == '充币通过')): ?>
										
										Refund through 
										<?php else: ?>
											<?php echo $vo['type']; endif; endif; ?>
									
									
									
									
									
									
									
									</h4>
									<p><?php echo date('Y-m-d H:i:s', $vo['add_time']); ?></p>
								</div>
								<div class="flex-list right"><b class="subtract">-<?php echo sprintf4($vo['num']); ?></b></div>
							</li>
							<?php else: ?>
							<li class="flex-box earningsinfo_list">
								<div class="flex-list left">
									<h4>
									
									
									
									
									<?php if(($_SESSION['langtemsetv'] == 'zh-cn')): ?>
										<?php echo $vo['type']; else: if(($vo['type'] == '签到福利')): ?>
											Sign-in Welfare
										<?php elseif(($vo['type'] == '转出')): ?>
										
										Transfer
										<?php elseif(($vo['type'] == '转入')): ?>
										
										into
										<?php elseif(($vo['type'] == '开启量化')): ?>
										
										Open Quantity
										<?php elseif(($vo['type'] == '关闭量化-')): ?>
										
										Close Quantity -
										<?php elseif(($vo['type'] == '每日收益')): ?>
										
										
										Daily Revenue 
										<?php elseif(($vo['type'] == '系统充值')): ?>
										System Refill
										
										<?php elseif(($vo['type'] == '兑换')): ?>
										Exchange 
										
										<?php elseif(($vo['type'] == '提币')): ?>
										
										Tenancy
										<?php elseif(($vo['type'] == '充币通过')): ?>
										
										Refund through 
										<?php else: ?>
											<?php echo $vo['type']; endif; endif; ?>
									
									
									
									
									
									
									</h4>
									<p><?php echo date('Y-m-d H:i:s', $vo['add_time']); ?></p>
								</div>
								<div class="flex-list right"><b class="up">+<?php echo sprintf4($vo['num']); ?></b></div>
							</li>
							<?php endif; endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
				<div class="footer">
					<div class="subbtn">
						<a href="<?php echo url('wallet/exchange'); ?>" class="">
							<button type="button"><?php echo \think\Lang::get('Language_number_1418'); ?></button>
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
