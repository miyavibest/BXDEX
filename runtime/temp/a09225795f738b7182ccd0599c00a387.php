<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"/www/wwwroot/frcw.52codes.cn/public/../app/index/view/wallet/exchangep.html";i:1550768774;s:62:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
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
	<body class="wallet">

		<div class="exchange">
			<div>
				<div class="header"><a href="<?php echo url("current",["id"=>$info['id']]); ?>" class="icon-left"><img src="/static/index/images/left.png"
						 alt=""></a>
					<h1><?php echo \think\Lang::get('Language_number_1363'); ?></h1>
				</div>
				<div class="user">
					<div>
						<p><?php echo strtoupper($info['name']); ?><?php echo \think\Lang::get('Language_number_1364'); ?></p>
						<p><?php echo sprintf4($listp); ?></p>
					</div>
					<div>
						<p><?php echo \think\Lang::get('Language_number_1365'); ?></p>
						<p><?php echo sprintf4($list['frcw']); ?></p>
					</div>
				</div>
				<div class="exchange_info">
					<div class="flex-box">
						<div class="flex-list">
							<p class="free"><?php echo \think\Lang::get('Language_number_1366'); ?></p>
							<!---->
							<!---->
						</div>
						<div class="flex-list"><span><?php echo strtoupper($info['name']); ?></span> <span>$<?php echo sprintf4($price_eth); ?></span></div>
					</div>
					<div class="flex-box">
						<!-- <div class="flex-list"><span><?php echo \think\Lang::get('Language_number_1367'); ?></span> <span>100</span></div> -->
						<div class="flex-list"><span>FRCW</span> <span>$<?php echo sprintf4($price_frcw); ?></span></div>
					</div>
				</div>
				<div class="exchange_from">
					<form>
						<div class="ipt_num">
							<input name="frcw_num" value="" placeholder="<?php echo \think\Lang::get('Language_number_1368'); ?><?php echo $info['name']; ?><?php echo \think\Lang::get('Language_number_1369'); ?>" type="text">
							<input type="hidden" id="type" value="<?php echo $info['name']; ?>">
						</div>
						<div class="flex-box">
							<span class="flex-list left" style="color: rgb(198, 197, 203);"><?php echo \think\Lang::get('Language_number_1370'); ?></span>
							<span class="flex-list right" style="color: rgb(255, 207, 61);"> <span id="sp1">0.0000</span> FRCW</span>
						</div>
						<div>
							<input name="trade_pwd" value="" placeholder="<?php echo \think\Lang::get('Language_number_1371'); ?>" type="password">
						</div>
						<div class="subbtn">
							<button type="button" style="width: 15rem;"><?php echo \think\Lang::get('Language_number_1372'); ?></button>
						</div>

					</form>
				</div>
				
			</div>
		</div>
		<script src="/static/src/lib/zepto.min.js"></script>
	    <script src="/static/src/js/dialog.js"></script>
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px");
			$("input[name=frcw_num]").keyup(function(){
				var frcw_num = $(this).val();
				var type = $('#type').val();
				$.post('<?php echo url("transEthp"); ?>', {frcw_num:frcw_num,type:type}, function(res){
					if (res.code == 1) {
						$('#sp1').html(res.eth_num);
					}
				});
			});

			$('button').click(function(){
				var frcw_num = $("input[name=frcw_num]").val();
				var type = $('#type').val();
				if (!frcw_num) {
					checkMsg('<?php echo \think\Lang::get('Language_number_1373'); ?>'+type+'<?php echo \think\Lang::get('Language_number_1374'); ?>');
					return false;
				}

				<!-- if (frcw_num < 100) { -->
					<!-- checkMsg('<?php echo \think\Lang::get('Language_number_1375'); ?>'); -->
					<!-- return false; -->
				<!-- } -->


				var trade_pwd = $("input[name=trade_pwd]").val();
				if (!trade_pwd) {
					checkMsg('<?php echo \think\Lang::get('Language_number_1376'); ?>');
					return false;
				}
				var eth_num = $('#sp1').html();
				$.post('<?php echo url("frcwTransEthp"); ?>', {frcw_num:frcw_num,eth_num:eth_num,trade_pwd:trade_pwd,type:type}, function(res){
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
		</script>


	</body>
</html>
