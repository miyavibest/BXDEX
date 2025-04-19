<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:68:"/www/wwwroot/frcw1.52codes.cn/public/../app/index/view/my/index.html";i:1559636787;s:63:"/www/wwwroot/frcw1.52codes.cn/app/index/view/public/header.html";i:1559554411;s:60:"/www/wwwroot/frcw1.52codes.cn/app/index/view/public/nav.html";i:1550762142;}*/ ?>
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
				<div class="view">
					<div class="userinfo">
						<div>
							<div class="userearnings">
								<p><?php echo \think\Lang::get('Language_number_1160'); ?>(JPD $<?php echo sprintf4($price_now); ?>)</p>
								<h2><?php echo sprintf4($total_price); ?></h2>
							</div>
							<div  class="userearnings">
								<p ><?php echo \think\Lang::get('Language_number_1162'); ?></p>
								<p ><?php echo sprintf4($personComain); ?></p>
							</div>
							<div class="userearnings">
								<p><?php echo \think\Lang::get('Language_number_1163'); ?></p>
								<p><?php echo sprintf4($total_num); ?></p>
							</div>
							<div><img src="" alt=""></div>
							<div class="vip" style="top: 2.2rem;">
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
							<div class="gotoEarnings">
								<a  href="<?php echo url('wallet/earnings'); ?>" class="">
								<img src="/static/index/images/index3.png" alt=""></a>
							</div>
							
							
							<?php if($level3>0): ?>
							
							<div style="position: absolute;top: 55%;right: 10%;width:3rem;top: 6rem;right: 1.7rem;">
								<img src="/static/index/images/l3<?php echo $level3; ?>.png?t=1" alt="" style="width:100%;">
								<span style="width: 100%;text-align: center;display:block;font-size: 13px;color: #fff;margin-top:0.1rem;"><?php echo $arrrlevel3[$level3]; ?></span>
							</div>
							<?php endif; ?>
							
						</div>
					</div>
					<div class="flex-box zone_1">
						<div  class="flex-list">
							<a href="<?php echo url('partner'); ?>" class="">
								<p class="icon" style="width: 1.6rem;height: 1.6rem;">
									<img  src="/static/index/images/index2.png" alt="" width="auto" height="100%" style="height: 1.6rem;">
								</p>
								<p><?php echo \think\Lang::get('Language_number_1166'); ?></p>
							</a>
						</div>
						<div class="flex-list">
							<a href="<?php echo url('openamount/index'); ?>" class="">
								<p class="icon" style="width: 1.6rem;height: 1.6rem;">
									<img src="/static/index/images/index4.png" alt="" width="auto" height="100%" style="height: 1.6rem;">
								</p>
								<p ><?php echo \think\Lang::get('Language_number_1167'); ?></p>
							</a>
						</div>
						<div class="flex-list">
							<a href="<?php echo url('generalize'); ?>" class="">
								<p class="icon" style="width: 1.6rem;height: 1.6rem;">
									<img  src="/static/index/images/index5.png" alt="" width="auto" height="100%" style="height: 1.6rem;">
								</p>
								<p ><?php echo \think\Lang::get('Language_number_1168'); ?></p>
							</a>
						</div>
					</div>
					<div class="my-list-box">
						<ul >
							<a href="<?php echo url('index/fuli28'); ?>" class="">
								<li  class="flex-box my_list">
									<div class="flex-size">
										<i class="icon">
											<img  src="/static/index/images/index6.png" alt="" width="100%" height="auto">
										</i>
									</div>
									<div class="flex-list">
										<p ><?php echo \think\Lang::get('Language_number_1169'); ?></p>
									</div>
								</li>
							</a> 
						
							
					<!-- 		<a href="<?php echo url('change/index'); ?>" class="">
								<li  class="flex-box my_list">
									<div class="flex-size">
										<i class="icon">
											<img  src="/static/index/images/qianbao.png" alt="" width="100%" height="auto">
										</i>
									</div>
									<div class="flex-list">
										<p ><?php echo \think\Lang::get('Language_number_1170'); ?></p>
									</div>
								</li>
							</a>  -->
							<a href="javascript:alert('暂未开启');" class="router-link-exact-active router-link-active">
								<li class="flex-box my_list">
									<div class="flex-size">
										<i class="icon">
											<img src="/static/index/images/index7.png" alt="" width="100%" height="auto">
										</i>
									</div>
									<div class="flex-list">
										<p><?php echo \think\Lang::get('Language_number_1171'); ?></p>
									</div>
								</li>
							</a> 
							<a href="javascript:alert('暂未开启');" class="router-link-exact-active router-link-active">
								<li class="flex-box my_list">
									<div class="flex-size">
										<i class="icon">
											<img  src="/static/index/images/index8.png" alt="" width="100%" height="auto">
										</i>
									</div>
									<div class="flex-list">
										<p><?php echo \think\Lang::get('Language_number_1172'); ?></p>
									</div>
								</li>
							</a> 
							<a href="javascript:alert('暂未开启');" class="router-link-exact-active router-link-active">
								<li class="flex-box my_list">
									<div class="flex-size">
										<i class="icon">
											<img  src="/static/index/images/index9.png" alt="" width="100%" height="auto">
										</i>
									</div>
									<div  class="flex-list">
										<p><?php echo \think\Lang::get('Language_number_1173'); ?></p>
									</div>
								</li>
							</a> 
							<a href="<?php echo url('ucenter/security'); ?>" class="">
								<li class="flex-box my_list">
									<div class="flex-size">
										<i class="icon">
											<img  src="/static/index/images/index10.png" alt="" width="auto" height="100%">
										</i>
									</div>
									<div class="flex-list">
										<p><?php echo \think\Lang::get('Language_number_1174'); ?></p>
									</div>
								</li>
							</a>
							<a href="<?php echo url('ucenter/setup'); ?>" class="">
								<li class="flex-box my_list">
									<div class="flex-size">
										<i class="icon">
											<img  src="/static/index/images/index11.png" alt="" width="auto" height="100%">
										</i>
									</div>
									<div class="flex-list">
										<p ><?php echo \think\Lang::get('Language_number_1175'); ?></p>
									</div>
								</li>
							</a>
							<a href="<?php echo url('ucenter/feedback'); ?>" class="">
								<li class="flex-box my_list">
									<div class="flex-size">
										<i class="icon">
											<img src="/static/index/images/index12.png" alt="" width="auto" height="100%">
										</i>
									</div>
									<div class="flex-list">
										<p ><?php echo \think\Lang::get('Language_number_1176'); ?></p>
									</div>
								</li>
							</a> 
							<a href="<?php echo url('ucenter/announcement'); ?>" class="">
								<li class="flex-box my_list">
									<div class="flex-size">
										<i class="icon">
											<img  src="/static/index/images/index13.png" alt="" width="100%" height="auto">
										</i>
									</div>
									<div class="flex-list">
										<p><?php echo \think\Lang::get('Language_number_1177'); ?></p>
									</div>
								</li>
							</a> 
							<a href="<?php echo url('ucenter/about'); ?>" class="">
								<li class="flex-box my_list">
									<div class="flex-size">
										<i class="icon">
											<img  src="/static/index/images/index14.png" alt="" width="auto" height="100%">
										</i>
									</div>
									<div  class="flex-list">
										<p><?php echo \think\Lang::get('Language_number_1178'); ?></p>
									</div>
								</li>
							</a>
							
							
							<a href="javascript:void();" class="">
								<li class="flex-box my_list">
									<div class="flex-size">
										<i class="icon">
										</i>
									</div>
									<div  class="flex-list">
										<p>&nbsp;&nbsp;&nbsp;&nbsp;</p>
									</div>
								</li>
							</a>
							
							<a href="javascript:void();" class="">
								<li class="flex-box my_list">
									<div class="flex-size">
										<i class="icon">
										</i>
									</div>
									<div  class="flex-list">
										<p>&nbsp;&nbsp;&nbsp;&nbsp;</p>
									</div>
								</li>
							</a>
								<a  class="">
								<li  class="flex-box my_list">
									<div class="flex-size">
										<i class="icon">
											
										</i>
									</div>
									<div class="flex-list">
										<p >&nbsp;&nbsp;&nbsp;&nbsp;</p>
									</div>
								</li>
							</a> 
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
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px")
		</script>
	</body>
</html>