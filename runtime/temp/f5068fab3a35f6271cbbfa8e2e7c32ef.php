<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:74:"/www/wwwroot/frcw1.52codes.cn/public/../app/index/view/user/register1.html";i:1559555080;s:63:"/www/wwwroot/frcw1.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
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
	<body class="loginBg bgW">

		<div id="landing">
			<div id="agreement">
				<div class="header"><a href="<?php echo url('index/user/logins'); ?>" class="icon-left"><img src="/static/index/images/left.png"
						 alt=""></a>
					<h1><?php echo \think\Lang::get('Language_number_1322'); ?></h1>
				</div>
				<div class="title_logo"><img src="/static/index/images/logo.png" alt=""></div>
				<div class="agreement">
					<h4><?php echo \think\Lang::get('Language_number_1323'); ?></h4>
					<div>
						<?php echo \think\Lang::get('Language_number_1324'); ?>
					</div>
				</div>
				<div class="agreement_ipt">
					<input  name="" id="agreement_ok" type="checkbox"> 
					<label for="agreement_ok"><?php echo \think\Lang::get('Language_number_1325'); ?></label>
				</div>
				<div class="forget flex-box">
					<div class="flex-list" style="text-align: left;"><a onclick="lan()">Language</a></div>
				</div>
				<div class="landing_btn">
					<!-- <button type="button" onclick="window.open('reg1.html','_self')"><?php echo \think\Lang::get('Language_number_1326'); ?></button> -->
					<button type="button"><?php echo \think\Lang::get('Language_number_1326'); ?></button>
				</div>
			</div>
			
		</div>
		<div id="toast" style="display: none;"><p><img src="/static/index/images/index.svg" alt=""></p> <p><?php echo \think\Lang::get('Language_number_1327'); ?></p></div>
		<div class="lanbtn">
			<ul>
				<li class="lanlist" onclick="langcn()">中文</li>
				<li class="lanlist" onclick="langen()">English</li>
			</ul>
			<ul>
				<li onclick="hide()" class="lanlist"><?php echo \think\Lang::get('Language_number_1328'); ?></li>
			</ul>
		</div>
		<script src="/static/src/lib/zepto.min.js"></script>
	    <script src="/static/src/js/dialog.js"></script>
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px")
			function lan() {
				$(".lanbtn").show()
			}
			function hide() {
				$(".lanbtn").hide()
			}
			
			function langcn() {
				$.post('<?php echo url("/index/user/langcn"); ?>', {}, function(res){
					$(".lanbtn").hide();
					location.reload();
				});
				
			}
			function langen() {
				$.post('<?php echo url("/index/user/langen"); ?>', {}, function(res){
					$(".lanbtn").hide();
					location.reload();
				});
				
			}
			
			$('button').click(function(){
				var val = $('#agreement_ok').prop('checked');
				if (val == false) {
					$(document).dialog({
				        type : 'toast',
				        infoIcon: '/static/src/images/icon/loading.gif',
				        infoText: '<?php echo \think\Lang::get('Language_number_1329'); ?>',
				        autoClose: 2500
				    });
					
				} else {
					//var url = '<?php echo url("index/user/register2"); ?>';
					var url = "/index/user/register2?id=<?php echo $_GET['id']; ?>";
					
					location.href=url;
				}
			});
		</script>
	</body>
</html>
