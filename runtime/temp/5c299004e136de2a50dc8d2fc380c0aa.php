<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"/www/wwwroot/159.138.143.90/public/../app/index/view/wallet/current.html";i:1551414334;s:61:"/www/wwwroot/159.138.143.90/app/index/view/public/header.html";i:1559554411;}*/ ?>
	<!DOCTYPE html>
<html class="size">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
		<title>Jade Token</title>
		<link href="/static/index/css/app.css" rel="stylesheet">
		<script src="/static/index/js/jquery-1.js"></script>
	</head>
	<style>
		.listnavdiv{
			width:100%;
			margin: 0;
			padding: 0;
		}
		.listnavi{
			width:32.1%;display: inline-block;
			text-align: center;
			margin: 0;
			padding: .3rem 0;
			font-family: "微软雅黑";
			font-size: 15px;
		}
		.listnavibc1{
			border-bottom: 3px solid #fff;
		}
		.listnavibc2{
			border-bottom: 3px solid #777;
		}
		
		
	</style>
	<body class="Currency">

		<div id="app">
			<div class="Currency1">
				<div class="header headerw">
					<a href="<?php echo url('index/index/index'); ?>" class="icon-left router-link-active">
						<img src="/static/index/images/left.png" alt="">
					</a>
					<h1><?php echo strtoupper($name); ?></h1>
				</div>
				<div class="usericoninfo">
					<p><?php echo \think\Lang::get('Language_number_1403'); ?></p>
					<p><?php echo sprintf4($num); ?></p>
					<p>≈ $ <?php echo sprintf4($num * $price); ?></p>
				</div>
				<div class="info">
					<h4 style="background: #ececec;" class="title"><?php echo \think\Lang::get('Language_number_1404'); ?></h4>
					
					
					
					<div class="listnavdiv">
						<div class="listnavi listnavi1">全部</div>
						<div class="listnavi listnavi2">转出</div>
						<div class="listnavi listnavi3">转入</div>
					</div>
					
					
					<ul class="list1">
						<?php if(is_array($record) || $record instanceof \think\Collection || $record instanceof \think\Paginator): $i = 0; $__LIST__ = $record;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['inout'] == 'out'): ?>
						<li class="flex-box">
							<div class="flex-list flxe-img">
								<span><img src="/static/index/images/zc1.png" alt=""></span>
							</div>
							<div class="flex-list">
								<h4 class="from" style="font-size: 13px;">
								
								
								
								
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
								<p><?php echo date('Y-m-d H:i:s',$vo['add_time']); ?></p>
							</div>
							<div class="flex-list flex-num">
								<p class="ok" style="font-size: 13px;"><?php echo \think\Lang::get('Language_number_1405'); ?></p>
							</div>
							<div class="flex-list">
								<p class="outcolor">- <?php echo $vo['num']; ?><?php echo strtoupper($vo['coin']); ?></p>
							</div>
						</li>
						<?php else: ?>
						<li class="flex-box">
							<div class="flex-list flxe-img"><span><img src="/static/index/images/dh.png"
									 alt=""></span></div>
							<div class="flex-list">
								<h4 class="to" style="font-size: 13px;">
								
								
								
								
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
								<p><?php echo date('Y-m-d H:i:s',$vo['add_time']); ?></p>
							</div>
							<div class="flex-list flex-num">
								<p class="ok" style="font-size: 13px;"><?php echo \think\Lang::get('Language_number_1406'); ?></p>
							</div>
							<div class="flex-list">
								<p class="fromcolor">+ <?php echo $vo['num']; ?><?php echo $vo['coin']; ?></p>
							</div>
						</li>
						<?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					<ul class="list2" style="display:none;">
						<?php if(is_array($user_tibi) || $user_tibi instanceof \think\Collection || $user_tibi instanceof \think\Paginator): $i = 0; $__LIST__ = $user_tibi;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voc): $mod = ($i % 2 );++$i;?>
						<a href="<?php echo url('wallet/usertibiinfo',['id'=>$voc['id']]); ?>">
						<li class="flex-box">
							<div class="flex-list flxe-img">
								<span><img src="/static/index/images/zc1.png" alt=""></span>
							</div>
							<div class="flex-list">
								<h4 class="from" style="max-width: 40%;overflow: hidden;font-size: 12px;">&nbsp;</h4>
								<h4 class="from" style="max-width: 40%;overflow: hidden;font-size: 12px;display:none;">
									#ID:<?php echo $voc['id']; ?><!--<?php echo $voc['address']; ?>-->
								</h4>
								<p><?php echo date('Y-m-d H:i:s',$voc['updatetime']); ?></p>
							</div>
							<div class="flex-list flex-num">
								<p class="ok" style="font-size: 12px;"><?php echo $status_arr[$voc['status']]; ?></p>
							</div>
							<div class="flex-list">
								<p class="outcolor">- <?php echo $voc['number']; ?><?php echo strtoupper($voc['coin']); ?></p>
								<p class="outcolor" style="line-height: 1rem;font-size: .5rem;color: #9e9e9e;">(- <?php echo $voc['number2']; ?><?php echo strtoupper($voc['coin']); ?>)</p>
							</div>
						</li>
						</a>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					
					<ul class="list3" style="display:none;">
						<?php if(is_array($tijiao) || $tijiao instanceof \think\Collection || $tijiao instanceof \think\Paginator): $i = 0; $__LIST__ = $tijiao;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vor): $mod = ($i % 2 );++$i;?>
						<a href="<?php echo url('wallet/tijiaoinfo',['id'=>$vor['id']]); ?>">
						<li class="flex-box">
							<div class="flex-list flxe-img">
								<span><img src="/static/index/images/zc1.png" alt=""></span>
							</div>
							<div class="flex-list">
								<h4 class="from" style="max-width: 40%;overflow: hidden;font-size: 12px;">&nbsp;</h4>
								<h4 class="from" style="max-width: 40%;overflow: hidden;font-size: 12px;display:none;">
									#ID:<?php echo $vor['id']; ?><!--<?php echo $vor['dizhi']; ?>-->
								</h4>
								<p><?php echo date('Y-m-d H:i:s',$vor['time']); ?></p>
							</div>
							<div class="flex-list flex-num">
								<p class="ok" style="font-size: 12px;"><?php echo $status_arr[$vor['status']]; ?></p>
							</div>
							<div class="flex-list">
								<p class="outcolor">- <?php echo $vor['num']; ?><?php echo strtoupper($vor['type']); ?></p>
							</div>
						</li>
						</a>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
				</div>
				<div class="float_user">
					<h4></h4>
					<p></p>
				</div>
				<div class="footer-btn">
					<div><a href="<?php echo url('wallet/out',['id'=>$id]); ?>" class=""><?php echo \think\Lang::get('Language_number_1407'); ?></a></div>
					<div><a href="<?php echo url('wallet/exchangep',['id'=>$id]); ?>" class="" style="background: #5ccbd6;"><?php echo \think\Lang::get('Language_number_1408'); ?></a></div>
					
					<!---->
					<div><a href="<?php echo url('wallet/gathering',['id'=>$id]); ?>" class="" style="background: #e21ed2;"><?php echo \think\Lang::get('Language_number_1409'); ?></a></div>
				</div>
				
			</div>
		</div>
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px");
			
			
			$(".listnavi1").addClass("listnavibc2");
			
			$('.listnavi1').click(function(){
				$('.list2').fadeOut();
				$('.list3').fadeOut();
				$('.list1').fadeIn();
				
				$(".listnavi2").removeClass("listnavibc2");
				$(".listnavi3").removeClass("listnavibc2");
				
				$(".listnavi2").addClass("listnavibc1");
				$(".listnavi3").addClass("listnavibc1");
				$(".listnavi1").addClass("listnavibc2");
			});
			
			$('.listnavi2').click(function(){
				$('.list1').fadeOut();
				$('.list3').fadeOut();
				$('.list2').fadeIn();
				
				$(".listnavi1").removeClass("listnavibc2");
				$(".listnavi3").removeClass("listnavibc2");
				
				$(".listnavi1").addClass("listnavibc1");
				$(".listnavi3").addClass("listnavibc1");
				$(".listnavi2").addClass("listnavibc2");
			});
			
			$('.listnavi3').click(function(){
				$('.list2').fadeOut();
				$('.list1').fadeOut();
				$('.list3').fadeIn();
				
				$(".listnavi2").removeClass("listnavibc2");
				$(".listnavi1").removeClass("listnavibc2");
				
				$(".listnavi2").addClass("listnavibc1");
				$(".listnavi1").addClass("listnavibc1");
				$(".listnavi3").addClass("listnavibc2");
			});
		</script>


	</body>
</html>
