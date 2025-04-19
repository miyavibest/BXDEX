<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"/www/wwwroot/frcw.52codes.cn/public/../app/index/view/index/fuli28.html";i:1550817454;s:62:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
	<!DOCTYPE html>
<html class="size">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
		<title>Jade Token</title>
		<link href="/static/index/css/app.css" rel="stylesheet">
		<script src="/static/index/js/jquery-1.js"></script>
	</head>
	<link rel="stylesheet" href="/static/src/css/dialog.css" />
	<body class="Currency">

		<div id="app">
			<div class="Currency1">
				<div class="header headerw">
					<a href="javascript:history.go(-1);" class="icon-left router-link-active">
						<img src="/static/index/images/left.png" alt="">
					</a>
					<h1><?php echo \think\Lang::get('Attendance_benefits'); ?></h1>
				</div>
				<div class="usericoninfo">
					<p><?php echo \think\Lang::get('Attendance_benefits_msg'); ?></p>
					<p><?php echo $cset1; ?></p>
					<p><?php echo $days_remaining; ?></p>
					
					<div class="footer-btn" style="position: initial;">
						<?php if($signtdayed == 'none'): ?>
						<div><a href="javascript:void();" class="signbtn" style="background: #6376ff;"><!--<?php echo \think\Lang::get('Sign_in'); ?>--><?php echo $signtdayedstr2; ?></a></div>
						<?php else: ?>
						<div><a href="javascript:checkMsg('<?php echo $signtdayedstr; ?>');" class="" style="background: #ffcf3d;"><?php echo $signtdayedstr; ?></a></div>
						<?php endif; ?>
					</div>
				</div>
				<div class="info">
					<h4 class="title"><?php echo \think\Lang::get('Capital_record'); ?></h4>
					<ul>
						<?php if(is_array($record) || $record instanceof \think\Collection || $record instanceof \think\Paginator): $i = 0; $__LIST__ = $record;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['inout'] == 'out'): ?>
						<li class="flex-box">
							<div class="flex-list flxe-img">
								<span><img src="/static/index/images/zc1.png" alt=""></span>
							</div>
							<div class="flex-list">
								<h4 class="from">
								<?php if(($_SESSION['langtemsetv'] == 'zh-cn')): ?>
									<?php echo $vo['type']; else: if(($vo['type'] == '签到福利')): ?>
										Sign-in Welfare
									<?php else: ?>
										<?php echo $vo['type']; endif; endif; ?>
								
								</h4>
								<p><?php echo date('Y-m-d H:i:s',$vo['add_time']); ?></p>
							</div>
							<div class="flex-list flex-num">
								<p class="ok"><?php echo \think\Lang::get('Success'); ?></p>
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
								<h4 class="to">
								
								<?php if(($_SESSION['langtemsetv'] == 'zh-cn')): ?>
									<?php echo $vo['type']; else: if(($vo['type'] == '签到福利')): ?>
										Sign-in Welfare
									<?php else: ?>
										<?php echo $vo['type']; endif; endif; ?>
								
								</h4>
								<p><?php echo date('Y-m-d H:i:s',$vo['add_time']); ?></p>
							</div>
							<div class="flex-list flex-num">
								<p class="ok"><?php echo \think\Lang::get('Success'); ?></p>
							</div>
							<div class="flex-list">
								<p class="fromcolor">+ <?php echo $vo['num']; ?><?php echo $vo['coin']; ?></p>
							</div>
						</li>
						<?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<div class="float_user">
					<h4></h4>
					<p></p>
				</div>
				
				
			</div>
		</div>
		
		<script src="/static/src/lib/zepto.min.js"></script>
	    <script src="/static/src/js/dialog.js"></script>
		
		
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px");
			
			
			function checkMsg(msg) {
		      	$(document).dialog({
			        type : 'toast',
			        infoIcon: '/static/src/images/icon/loading.gif',
			        infoText: msg,
			        autoClose: 1500
			    });
		    }
			
			
			$(".signbtn").click(function(){
				$.post("fulido28.html",function(data,status){
					if(data == "ed"){
						checkMsg('<?php echo \think\Lang::get('Signed_in_today'); ?>');
						
						setTimeout(function(){
							location.reload();
						}, 1500);
					}
					if(data == "ss"){
						checkMsg('<?php echo \think\Lang::get('Check_in_successfully'); ?>');
						setTimeout(function(){
							location.reload();
						}, 1500);
					}
					if(data == "28g"){
						checkMsg('<?php echo \think\Lang::get('Only_28_days'); ?>');
						setTimeout(function(){
							location.reload();
						}, 1500);
					}
					
					if(data == "psignnone"){
						checkMsg('<?php echo \think\Lang::get('Real_name_certification_e'); ?>');
						setTimeout(function(){
							location.href="pinfosign.html";
						}, 1500);
					}
					//location.reload();
				});
			});
		</script>


	</body>
</html>
