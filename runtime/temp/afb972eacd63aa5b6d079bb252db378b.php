<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"/www/wwwroot/frcw.52codes.cn/public/../app/index/view/change/tibi.html";i:1551968150;s:62:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
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
	<link rel="stylesheet" href="/static/common/layui/css/layui.css"  media="all">
	<style>
		.addressdivlist p{
			text-align: left;color: #8c8c8c;border-bottom: 1px solid #e0e0e0;font-size: .71rem;padding: .76rem .26rem;background: #f9f9f9;
		}

		.out .ipt_box input {
			height: 2.2rem;
		}
		.out .balance {
			text-align: left;
			color: #b1b1b1;
			font-size: .64rem;
			padding: .5rem .64rem;
			background: #f1f1f1;
		}
		.hk-item{
			font-size: .64rem;
			color:    #b1b1b1;
		}
	</style>
	
	<?php if($coinid != 1): ?>
		
		<style>
		.eosmemocla{display:none;}
		</style>
		
	<?php endif; ?>
	<body class="out">
		<div id="app">
			<div>
				<div class="header headerw">
					<!--
					<a href="<?php echo url('change/index'); ?>" class="icon-left">
						<img src="/static/index/images/left.png" alt="">
					</a>
					-->
					<a href="javascript:history.go(-1);" class="icon-left">
						<img src="/static/index/images/left.png" alt="">
					</a>
					<h1><?php echo strtoupper($coinname); ?><?php echo \think\Lang::get('Language_number_1146'); ?></h1> 
					<a href="javascript:;" class="icon-right"><img src="/static/index/images/sys.png" alt=""></a>
				</div>
				<div>
					<div class="ipt_box ipt_1" style="position: relative;">
						<input value="" name="skaddress" placeholder="<?php echo \think\Lang::get('Language_number_1147'); ?>" type="text" style="width: 82%;">
						
						<span onclick="showaddressdiv()" style="height: 1.6rem;position:absolute;right:0;width:18%;right:.64rem;    text-align: right;    border-bottom: 1px solid #dbdbdb;;background: ;top:0;display: inline-block;padding-top: 0.6rem;">
							<img src="/static/index/images/dh.png" style="height: 1rem;">
						</span>
					</div>
					<div class="ipt_box ipt_2 eosmemocla">
						<input name="eosmemo" placeholder="<?php echo \think\Lang::get('Language_number_1448'); ?>" type="text">
					</div>

					<div class="ipt_box ipt_2">
						<input name="num" placeholder="<?php echo \think\Lang::get('Language_number_1148'); ?>" type="number">
					</div>
					
					<p class="balance" style="padding: .77rem .64rem;background-color: #f1f1f1;text-align: left;color: #b1b1b1;background-color:#ffffff;"><?php echo \think\Lang::get('Language_number_1446'); ?><span class="numberccccccc"><?php echo $cset18; ?></span></p>

					<!--<legend>设置步长</legend>-->

					<div class="ipt_box ipt_2">
						<div id="slideTest5" class="demo-slider"></div>
						<div style="display: flex;justify-content: space-between;margin-top: .5rem;">
							<div class="hk-item">3</div>
							<div class="hk-item" style="flex: 0">5</div>
							<div class="hk-item">20</div>
						</div>
					</div>
					
					<p class="balance" style="padding: .77rem .64rem;margin-top: 1rem;background-color:#ffffff;"><?php echo \think\Lang::get('Language_number_1149'); ?><?php echo strtoupper($coinname); ?> <?php echo $money; ?> <span style="float: right;display:none;"><?php echo \think\Lang::get('Language_number_1444'); ?><?php echo $cset18; ?> </spsn></p>
					<div class="ipt_box ipt_box_la">
						<input name="bypass" placeholder="<?php echo \think\Lang::get('Language_number_1150'); ?>" type="password">
					</div>
					<div class="subbtn outbtn">
					    <input type="hidden" value="<?php echo $coinid; ?>" name="coinid">
						<button class="sbtn" type="button"><?php echo \think\Lang::get('Language_number_1151'); ?></button>
					</div>
					
						
					<!--
					<div class="subbtn outbtn">
						<a href="/index/change/addwetall/coinid/<?php echo $coinid; ?>.html">
							<button style="position: fixed;left: 5%;bottom: 30px;background: #8eb0de;color: #fff;" type="button"><?php echo \think\Lang::get('Language_number_1440'); ?></button>
						</a>
					</div>
					-->
					
				</div>
				
			</div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			<div class="addressdiv" style="position: fixed;width: 100%;height: 100%;top: 0;z-index: 99999;background: #fff;display:none;">
				<div class="header headerw">
					<a href="javascript:cloaddressdiv();" class="icon-left">
						<img src="/static/index/images/left.png" alt="">
					</a>
					<h1><?php echo strtoupper($coinname); ?><?php echo \think\Lang::get('Language_number_1442'); ?></h1> 
					
				</div>
				<div class="addressdivlist">
					<?php if(is_array($skaddresslist) || $skaddresslist instanceof \think\Collection || $skaddresslist instanceof \think\Paginator): $i = 0; $__LIST__ = $skaddresslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voskaddresslist): $mod = ($i % 2 );++$i;?>
					<p onclick="setaddressv('<?php echo $voskaddresslist['address']; ?>')">
						<?php echo $voskaddresslist['address']; ?>
					</p>
					<?php endforeach; endif; else: echo "" ;endif; ?>
					<p style="background:#fff;border-bottom:none;text-align:center;">
						<?php echo \think\Lang::get('Language_number_1443'); ?>
					</p>
				</div>
				
			</div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		</div>
		<script src="/static/src/lib/zepto.min.js"></script>
	    <script src="/static/src/js/dialog.js"></script>
		<script src="/static/common/layui/layui.js" charset="utf-8"></script>
		<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
		<script>
			var kgVal = 3;
            layui.use('slider', function(){
                var $ = layui.$
                    ,slider = layui.slider;
                //默认滑块
                slider.render({
                    elem: '#slideTest1'
                });

                //定义初始值
                slider.render({
                    elem: '#slideTest2'
                    ,value: 20 //初始值
                });

                //设置最大最小值
                slider.render({
                    elem: '#slideTest5'
                    ,min: 3 //最小值
                    ,max: 20 //最大值
                });

                //设置步长
                slider.render({
                    elem: '#slideTest4'
                    ,step: 10 //步长
                });

                slider.render({
                    elem: '#slideTest5'
                    ,step: 50 //步长
                    ,showstep: true //开启间隔点
                    ,change: function(value){
                        // $('#test-slider-tips1').html('当前数值：'+ value);
                        if(value == 0){
                            kgVal = 3;
                        }else if(value == 50){
                            kgVal = 5;
                        }else if(value == 100){
                            kgVal = 20;
                        }
                    }
                });

                //设置提示文本
                slider.render({
                    elem: '#slideTest6'
                    ,min: 20
                    ,max: 1000
                    ,setTips: function(value){ //自定义提示文本
                        return value + 'GB';
                    }
                });
                slider.render({
                    elem: '#slideTest7'
                    ,tips: false //关闭默认提示层
                    ,change: function(value){
                        $('#test-slider-tips1').html('当前数值：'+ value);
                    }
                });

                //开启输入框
                slider.render({
                    elem: '#slideTest8'
                    ,input: true //输入框
                });

                //开启范围选择
                slider.render({
                    elem: '#slideTest9'
                    ,value: 40 //初始值
                    ,range: true //范围选择
                    ,change: function(vals){
                        $('#test-slider-tips2').html('开始值：'+ vals[0] + '、结尾值：'+ vals[1]);
                    }
                });
                slider.render({
                    elem: '#slideTest10'
                    ,value: [30, 60] //初始值
                    ,range: true //范围选择
                });

                //垂直滑块
                slider.render({
                    elem: '#slideTest11'
                    ,type: 'vertical' //垂直滑块
                });
                slider.render({
                    elem: '#slideTest12'
                    ,value: 30
                    ,type: 'vertical' //垂直滑块
                });
                slider.render({
                    elem: '#slideTest13'
                    ,value: 50
                    ,range: true //范围选择
                    ,type: 'vertical' //垂直滑块
                });
                slider.render({
                    elem: '#slideTest14'
                    ,value: 80
                    ,input: true //输入框
                    ,type: 'vertical' //垂直滑块
                });

                //自定义颜色
                slider.render({
                    elem: '#slideTest15'
                    ,theme: '#1E9FFF' //主题色
                });
                slider.render({
                    elem: '#slideTest16'
                    ,value: 50
                    ,theme: '#5FB878' //主题色
                });
                slider.render({
                    elem: '#slideTest17'
                    ,value: [30, 70]
                    ,range: true
                    ,theme: '#FF5722' //主题色
                });

                //禁用滑块
                slider.render({
                    elem: '#slideTest18'
                    ,value: 35
                    ,disabled: true //禁用滑块
                });

            });
		</script>

		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px");
			
			
			
			function cloaddressdiv(){
				$('.addressdiv').fadeOut();
			}
			
			function showaddressdiv(){
				$('.addressdiv').fadeIn();
			}
			
			function setaddressv(addressv){
				$("input[name=skaddress]").val(addressv);
				cloaddressdiv();
			}
			
			
			
			
			
			
			
			
			
			
			
			
			$('.sbtn').click(function(){
				var skaddress = $("input[name=skaddress]").val();
				var eosmemo = $("input[name=eosmemo]").val();
				var num = $("input[name=num]").val();
				if (!num) {
					checkMsg('<?php echo \think\Lang::get('Language_number_1152'); ?>');
					return false;
				}
				var bypass = $("input[name=bypass]").val();
				if (!bypass) {
					checkMsg('<?php echo \think\Lang::get('Language_number_1153'); ?>');
					return false;
				}
				var coinid = $("input[name=coinid]").val();
				$.post('<?php echo url("tibi"); ?>', {'skaddress':skaddress,'eosmemo':eosmemo,'coinid':coinid,'num':num,'bypass':bypass}, function(res){
					if (res.code == 1) {
						$(document).dialog({
		        			type : 'toast',
					        infoIcon: '/static/src/images/icon/loading.gif',
					        infoText: res.msg,
					        autoClose: 1000,
					        onClosed: function(){
				    			location.href = res.url;
					        },
					    });
					} else {
						checkMsg(res.msg);
					}
				});


			});

			function checkMsg(msg) {
		      	$(document).dialog({
			        type : 'toast',
			        infoIcon: '/static/src/images/icon/loading.gif',
			        infoText: msg,
			        autoClose: 1500
			    });
		    }
			
			
			
			<?php if($addressn == 1): ?>
				/*		
				checkMsg("<?php echo \think\Lang::get('Language_number_1441'); ?>");
				setTimeout(function(){
					location.href = '/index/change/addwetall/coinid/<?php echo $coinid; ?>.html';
				},3000);
				*/
			<?php endif; ?>
			/*
			setInterval(function(){
				var num = $("input[name=num]").val();
				//alert(num);
				if (!num || num<0) {
					$(".numberccccccc").html("0");
				}else{
					
					if (num>0) {
						
						num=parseFloat(num)
					
						$(".numberccccccc").html(num+<?php echo $cset18; ?>);
					}else{
						$(".numberccccccc").html("0");
					}
					
				}
			},500);
			*/
			
			
		</script>


	</body>
</html>
