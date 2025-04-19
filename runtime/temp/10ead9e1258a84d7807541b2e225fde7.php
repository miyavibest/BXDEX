<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"/www/wwwroot/159.138.143.90/public/../app/index/view/market/cointimepe.html";i:1559636584;s:58:"/www/wwwroot/159.138.143.90/app/index/view/public/nav.html";i:1550762142;}*/ ?>
<!DOCTYPE html>
<html class="size">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
		<title>FRCW Wallet</title>
		<link href="/static/index/css/app.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="/static/index/chas1/css/index.css" />
		<script type="text/javascript" src="/static/index/chas1/js/jquery-1.7.2-min.js"></script>
		<script type="text/javascript" src="/static/index/chas1/js/echarts.min.js"></script>
	</head>

	
	<style>
	.adasdsadas{
		background: #f7f7f7;
	}
	
	.market .header-f h1 {
		font-size: 18px;
		line-height: 44px;
		background: #ffffff;
		color: #000;
	}
	
	.market .bit {
		background: #f7f7f7;
	}
	
	.market .tab {
		display: -ms-flexbox;
		display: flex;
		text-align: center;
		font-size: .68rem;
		background: #0b0a05;
		padding: .35rem 0;
		border-bottom: 1px solid #cccccc;
		color: #f9f9f9;
	}
	
	.market .tab {
		display: -ms-flexbox;
		display: flex;
		text-align: center;
		font-size: .68rem;
		background: #ffffff;
		padding: .35rem 0;
		border-bottom: 1px solid #cccccc;
		color: #676767;
	}
	
	.market .bit_list {
		display: -ms-flexbox;
		display: flex;
		font-size: .75rem;
		text-align: center;
		height: 3.6rem;
		color: #676767;
		border-bottom: 1px solid #d8d8d8;
	}
	
	.market .bit_list span {
		display: inline-block;
		height: 100%;
		line-height: 3.6rem;
		font-weight: 500;
		font-size: .75rem;
		color: #7b7b7b;
	}
	</style>
	<body class="market">
		<div id="app">
			<div>
				<div class="header-f" style="z-index: 99999;position: relative;    background: #d8d8d8;">
					<a href="javascript:history.go(-1);" class="icon-left"><img src="/static/index/images/left.png" alt=""></a>
					<h1><?php echo $coin; ?>最新价格走势</h1>
				</div>
				<div class="view-header" style="width:96%;margin-left:4%;height:220px;background: #fff;margin-top: -40px;">
					<div id="line" style="width:100%;height:220px;z-index: 999;"></div>
				</div>
				
				<div class="view-header" style="top: 216px;">
					<div class="flex-box tab">
						<div class="flex-list">
							<p>币种</p>
						</div>
						<div class="flex-list">价格</div>
						<div class="flex-list">时间</div>
					</div>
					<div class="bit">
						<ul>
						<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<a href="#/Market" class="router-link-exact-active router-link-active">
								<li class="flex-box bit_list" style="height: 2.6rem;">
									<div class="flex-list bittype" style="padding-top: 0.5rem;">
										<p style="text-transform: uppercase;font-size: 15px;"><?php echo $coin; ?></p>
										<p style="font-size: 11px;"><?php echo $coin; ?></p>
									</div>
									<div class="flex-list" style=""><span class="off" style="font-size: 14px;line-height: 2.6rem;">$<?php echo $vo['price']; ?></span></div>
									<div style="padding-top: 0.5rem;font-size: 13px;" class="flex-list range">
									
									<?php if(($coin != 'usdt' && $coin != 'JPD')): ?>
										<?php echo date('Y-m-d H:i:s',$vo['time']); else: ?>
										<?php echo date('Y-m-d H:i:s',$vo['pub_time']); endif; ?>
									
									</div>
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
			$(".size").css("font-size", $("body").width() * 0.0625 + "px");
			
			
var line = echarts.init(document.getElementById('line'));
line.setOption({
    color: ["#32d2c9"],
    title: {
        x: 'left',
        text: '',
        textStyle: {
            fontSize: '13',
            color: '#4c4c4c',
            fontWeight: 'bolder'
        }
    },
    tooltip: {
        trigger: 'axis'
    },
    toolbox: {
        show: true,
        feature: {
            dataZoom: {
                yAxisIndex: 'none'
            },
            dataView: {
                readOnly: false
            },
            magicType: {
                type: ['line', 'bar']
            }
        }
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
		<?php if(($coin != 'usdt' && $coin != 'JPD')): ?>
        data: ["<?php echo date('d H:i',$list[4]['time']); ?>","<?php echo date('d H:i',$list[3]['time']); ?>","<?php echo date('d H:i',$list[2]['time']); ?>","<?php echo date('d H:i',$list[1]['time']); ?>","<?php echo date('d H:i',$list[0]['time']); ?>"],
        <?php else: ?>
		data: ["<?php echo date('d H:i',$list[4]['pub_time']); ?>","<?php echo date('d H:i',$list[3]['pub_time']); ?>","<?php echo date('d H:i',$list[2]['pub_time']); ?>","<?php echo date('d H:i',$list[1]['pub_time']); ?>","<?php echo date('d H:i',$list[0]['pub_time']); ?>"],
		<?php endif; ?>
		axisLabel: {
            interval: 0
        }
    },
    yAxis: {
        type: 'value',min:<?php echo $list2[0]; ?>,max:<?php echo $list2[4]; ?>
    },
    series: [{
        name: '成绩',
        type: 'line',
        data: ["<?php echo $list[4]['price']; ?>","<?php echo $list[3]['price']; ?>","<?php echo $list[2]['price']; ?>","<?php echo $list[1]['price']; ?>","<?php echo $list[0]['price']; ?>",],
        markLine: {
            data: [{
                type: 'average',
                name: '平均值'
            }]
        }
    }]
});
			
			
		</script>
	</body>
</html>