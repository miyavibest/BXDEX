<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:78:"/www/wwwroot/frcw.52codes.cn/public/../app/index/view/wallet/usertibiinfo.html";i:1551333762;s:62:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
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
		.span1{
			width: 40%;
			display: inline-block;
			padding: .6rem 0;
			font-size: .6em;
			color: #c7c7c7;
		}
		.span2{
			width:55%;display: inline-block;
			padding: .6rem 0;
			font-size: .6em;
			color: #757575;
			/*font-weight: bold;*/
		}
		.span3{
			width:55%;display: inline-block;
			padding: .6rem 0;
			font-size: .9em;
			color: #757575;
			font-weight: bold;
		}
		.span22{
			word-wrap: break-word;
			vertical-align: top;
		}
		
		
	</style>
	<body class="Currency">

		<div id="app" style="background:#fff;">
			<div class="Currency1">
				<div class="header headerw">
					<a href="javascript:history.go(-1);" class="icon-left router-link-active">
						<img src="/static/index/images/left.png" alt="">
					</a>
					<h1>详情</h1>
				</div>
				<div class="usericoninfo" style="border-bottom: 2px #d8d8d8 dashed;width: 90%;margin-left: 5%;">
					<p><img src="/static/index/images/index10.png" style="width:10%;"></p>
					<p><?php echo $status_arr[$user_tibi['status']]; ?></p>
					<p></p>
				</div>
				
				<div style="width: 90%;margin-left: 5%;">
					<div>
						<span class="span1">金额：</span>
						<span class="span3"><?php echo $user_tibi['number']; ?></span>
					</div>
					
					
					
					<div>
						<span class="span1">矿工费用：</span>
						<span class="span2"><?php echo $user_tibi['number2']; ?></span>
					</div>
					<div>
						<span class="span1">发款方：</span>
						<span class="span2 span22"><?php echo $info['address']; ?></span>
					</div>
					
					
					<?php if(($user_tibi['coin'] == 'eos')): ?>
					<div>
						<span class="span1">EosMemo(发)：</span>
						<span class="span2"><?php echo $info['eosmemo']; ?></span>
					</div>
					<?php endif; ?>
					
					
					
					<div>
						<span class="span1">收款方：</span>
						<span class="span2 span22"><?php echo $user_tibi['address']; ?></span>
					</div>
					
					
					<?php if(($user_tibi['coin'] == 'eos')): ?>
					<div>
						<span class="span1">EosMemo(收)：</span>
						<span class="span2"><?php echo $user_tibi['eosmemo']; ?></span>
					</div>
					<?php endif; ?>
					
					
					<div>
						<span class="span1">币种：</span>
						<span class="span2"><?php echo strtoupper($user_tibi['coin']); ?></span>
					</div>
					
					<div>
						<span class="span1">交易时间：</span>
						<span class="span2"><?php echo date('Y-m-d H:i:s',$user_tibi['updatetime']); ?></span>
					</div>
					
					
				</div>
				
			</div>
		</div>
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px");
			
			
			
		</script>


	</body>
</html>
