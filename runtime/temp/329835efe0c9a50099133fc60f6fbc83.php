<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"/www/wwwroot/frcw.52codes.cn/public/../app/index/view/my/generalize.html";i:1551547068;s:62:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
	<!DOCTYPE html>
<html class="size">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
		<title>Jade Token</title>
		<link href="/static/index/css/app.css" rel="stylesheet">
		<script src="/static/index/js/jquery-1.js"></script>
	</head>
	<body class="wallet bgW">
		<div id="app" style="background:url('/static/index/images/qcodebg.jpg');background-size: 100% 100%;">
			<div style="top: 50%;width: 50%;left: 27%;position: absolute;margin-left:5%">
			     <img alt="Scan me!" style="display: block;width: 75%;" src="<?php echo $url; ?>">
				<!-- <img alt="Scan me!" style="display: block;width: 75%;" src="http://qr.liantu.com/api.php?text=<?php echo $url; ?>"> -->
			 </div>
		</div>
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px")
		</script>
	</body>
</html>