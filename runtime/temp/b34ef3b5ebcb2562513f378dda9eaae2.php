<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"/www/wwwroot/frcw.52codes.cn/public/../app/index/view/wallet/select.html";i:1559113327;s:62:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
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
	<body class="wallet setBox">
		<div id="app">
			<div>
				<div class="header headerw"><a href="<?php echo url('index/index/index'); ?>" class="icon-left"><img src="/static/index/images/left.png" alt=""></a>
					<h1><?php echo \think\Lang::get('Language_number_1399'); ?></h1>
				</div>
				<div>
					<ul>
						<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<li class="selectlist selectlist1" attr-id="<?php echo $vo['id']; ?>">
							<span class="imgbox">
								<img src="/static/index/images/<?php echo $vo['logo']; ?>" alt="">
							</span> 
							<span class="type"><?php echo strtoupper($vo['name']); ?></span> 

							<?php if(in_array($vo['id'], $ids_arr)): ?>
							<span class="coin green">
								<input type="hidden" name="type" value="1">
								<img src="/static/index/images/hs.png" alt="">
							</span>
							<?php else: ?>
							<span class="coin green">
								<input type="hidden" name="type" value="2">
								<img src="/static/index/images/hse.png" alt="">
							</span>
							<?php endif; ?>
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>

						<li class="selectlist"><span class="imgbox"><img src="/static/index/images/935597e93058d845.jpg"
								 alt=""></span> <span class="type">XRP</span> <span class="coin ccc"><img
								 src="" alt="">
								<?php echo \think\Lang::get('Language_number_1400'); ?>
							</span></li>
						<li class="selectlist"><span class="imgbox"><img src="/static/index/images/d51674ad9e6f9470.png"
								 alt=""></span> <span class="type">BCH</span> <span class="coin ccc"><img
								 src="" alt="">
								<?php echo \think\Lang::get('Language_number_1401'); ?>
							</span></li>
						<li class="selectlist"><span class="imgbox"><img src="/static/index/images/5c2f1f7f080dabbc.png"
								 alt=""></span> <span class="type">ETC</span> <span class="coin ccc"><img
								 src="" alt="">
								<?php echo \think\Lang::get('Language_number_1402'); ?>
							</span></li>
					</ul>
				</div>
			</div>
		</div>

		<script src="/static/src/lib/zepto.min.js"></script>
    	<script src="/static/src/js/dialog.js"></script>
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px")
			$('.selectlist1').click(function(){
				var id = $(this).attr('attr-id');
				var type = $(this).find('input').val();

				$.get('<?php echo url("selectCoin"); ?>', {id:id,type:type}, function(res){
					//alert(res);
					if (res.code == 1) {
						$(document).dialog({
		        			type : 'toast',
					        infoIcon: '/static/src/images/icon/loading.gif',
					        infoText: res.msg,
					        autoClose: 1000,
					        onClosed: function(){
								
								location.reload();
								
					        },
					    });
					}
				});


			});
		</script>


	</body>
</html>
