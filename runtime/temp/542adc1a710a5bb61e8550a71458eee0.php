<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"/www/wwwroot/frcw.52codes.cn/public/../app/index/view/index/index.html";i:1559635737;s:62:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/header.html";i:1559554411;s:59:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/nav.html";i:1550762142;}*/ ?>
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
			<div id="home" class="view">
	          <div class="banner" id="slider" style="margin: 0;height: 10rem;">
						<ul class="swiper-wrapper">
						 <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<a href="<?php echo $vo['url']; ?>"><li class="swiper-slide"><img src="<?php echo $vo['img']; ?>"
								 alt="" ></li>
								 </a>
						 <?php endforeach; endif; else: echo "" ;endif; ?>		 
						</ul>
					<div class="swiper-pagination"></div>
				</div>
				<div class="flex-box userall">
					<div class="flex-list">
						<p><?php echo \think\Lang::get('total_assets'); ?>($) </p>
						<h2><?php echo sprintf4($total_price); ?></h2>
					</div>
					<div class="flex-list homevip">
						<!--
						<span class="viptype vipbg_2" style="background: url(/static/index/images/indexv<?php echo $level2; ?>.png);min-width: 3em;        width: 3rem;height: 1rem;line-height: 1rem;color:#fff;     padding-left:0.5rem;    background-size: 100% 100%;">
						
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
							<span class="viptype vipbg_2" style="background: url(/static/index/images/indexv<?php echo $level2; ?>.png);	    width: 2rem;height: 1.7rem;margin-top: -0.3rem;    background-size: 100% 100%;">
							</span> 
						<?php elseif($level2==3): ?>
							<span class="viptype vipbg_2" style="background: url(/static/index/images/indexv<?php echo $level2; ?>.png);	    width: 2rem;height: 1.7rem;margin-top: -0.3rem;    background-size: 100% 100%;">
							</span> 
						<?php elseif($level2==4): ?>
							<span class="viptype vipbg_2" style="background: url(/static/index/images/indexv<?php echo $level2; ?>.png);	    width: 2rem;height: 1.7rem;margin-top: -0.3rem;    background-size: 100% 100%;">
							</span> 
						<?php else: ?>
							<span class="viptype vipbg_2" style="background: url(/static/index/images/<?php echo \think\Lang::get('Language_number_1431'); ?>.png);	width: 2rem;height: 1.7rem;margin-top: -0.3rem;    background-size: 100% 100%;">
							</span> 
						<?php endif; ?>
						
						
						
						
						<span class="vipicon"><img src="/static/index/images/viptype<?php echo $level2; ?>.png" alt=""></span></div>
				</div>
				<div>
					<ul class="theicon">
						<li class="theiconlist">
							<a href="<?php echo url('wallet/earnings'); ?>" class="">
								<div><img src="/static/index/images/icon1.png" alt=""></div>
								<div>
									<p>JPD</p>
									<p>JPD <?php echo sprintf4($frcw_num); ?> = $ <?php echo sprintf4($cur_price); ?></p>
								</div>
								<div><img src="/static/index/images/right.png" alt=""></div>
							</a>
						</li>
						<?php if(is_array($data_coin) || $data_coin instanceof \think\Collection || $data_coin instanceof \think\Paginator): $i = 0; $__LIST__ = $data_coin;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<li class="theiconlist">
							<a href="<?php echo url('wallet/current', ['id'=>$vo['id']]); ?>" class="">
								<div><img src="/static/index/images/<?php echo $vo['logo']; ?>" alt=""></div>
								<div>
									<p><?php echo strtoupper($vo['name']); ?></p>
									<p><?php echo $vo['name']; ?> <?php echo sprintf4($vo['num']); ?> = $ <?php echo sprintf4($vo['num'] * $vo['price']); ?></p>
								</div>
								<div><img src="/static/index/images/right.png" alt=""></div>
							</a>
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						
					</ul>
					<ul class="theicon">
						<a href="<?php echo url('wallet/select'); ?>" class="">
							<li class="theiconlist addicon">
								<p><img src="/static/index/images/jia.png" alt=""></p>
								<p><?php echo \think\Lang::get('Click_Add_Other_Currencies'); ?></p>
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

		<script src="/static/index/js/echarts.min.js"></script>
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px")
			var myChart = echarts.init(document.getElementById('myChart'));
			var src = <?php echo $date_str; ?>,
				src1 = <?php echo $price; ?>,
				// num = 1;
			option = {
				color: ["#FDC775", "#FDC775"],
				tooltip: {
					trigger: 'axis'
				},

				textStyle: { //图例文字的样式
					color: '#fff',
				},
				grid: {
					left: "-5%",
					right: "5%",
					top: "3%",
					bottom: "5%",
					containLabel: !0
				},
				toolbox: {
					feature: {
						saveAsImage: {}
					}
				},
				xAxis: [{
					type: "category",
					data: src,
					boundaryGap: !1,
					splitLine: {
						show: !1
					},
					axisLabel: {
						show: !0,
						textStyle: {
							color: "#fff",
							fontSize: "10"
						}
					},
					axisLine: {
						lineStyle: {
							color: "transparent"
						}
					}
				}],
				yAxis: [{
					type: "value",
					splitLine: {
						show: !1
					},
					axisLabel: {
						show: !0,
						textStyle: {
							color: "transparent",
							fontSize: "16"
						}
					},
					axisLine: {
						lineStyle: {
							color: "transparent"
						}
					}
				}],
				series: [{
					data: src1,
					type: "line",
					smooth: !0,
					symbol: "circle",
					symbolSize: 3,
					itemStyle: {
						normal: {
							color: "#FDC775",
							lineStyle: {
								color: "#FDC775",
								width: "2"
							}
						}
					}
				}]
			};
			myChart.setOption(option);
		</script>


	</body>
</html>
