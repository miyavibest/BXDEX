<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"/www/wwwroot/frcw.52codes.cn/public/../app/index/view/ucenter/security.html";i:1551109616;s:62:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
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
		<div id="app">
			<div>
				<div class="earnings">
					<div class="header headerw"><a href="<?php echo url('my/index'); ?>" class="icon-left"><img src="/static/index/images/left.png" alt=""></a>
						<h1><?php echo \think\Lang::get('Language_number_1257'); ?></h1>
					</div>
				</div>
				<div class="topimg"><img src="/static/index/images/topimg.png" alt=""> <span><?php echo \think\Lang::get('Language_number_1258'); ?></span></div>
				<div class="set_box">
					<a href="<?php echo url('/index/index/pinfosign'); ?>" class="">
						<div class="set_list list_x">
							<span><?php echo \think\Lang::get('Language_number_1259'); ?></span><span style="float: right;margin-right: 1.6rem;;color: #8a8a8a;"><?php echo $psigninfostr; ?></span> <i class="icon"></i>
						</div>
					</a>
					<!--
					<a href="<?php echo url('setpassword'); ?>" class="">
						<div class="set_list list_x">
							<span><?php echo \think\Lang::get('Language_number_1260'); ?></span> <i class="icon"></i>
						</div>
					</a>
					-->
					<a href="javascript:jymm()" class="router-link-exact-active router-link-active">
					<div class="set_list list_x">
						<span><?php echo \think\Lang::get('Language_number_1261'); ?></span><i class="icon"></i>
					</div>
					</a>
				</div>
				<div class="set_box keywarp">
					<a href="javascript:dcsy()" class="router-link-exact-active router-link-active">
					<div class="set_list list_x">
						<span><?php echo \think\Lang::get('Language_number_1262'); ?></span><i class="icon"></i>
					</div>
					</a>
				</div>
			</div>
		</div>

		<div class="keytest" style="display: none;">
			<div class="password_box">
				<p><?php echo \think\Lang::get('Language_number_1263'); ?></p>
				<div class="hidebtn"><img src="/static/index/images/close1.png" alt=""></div>
				<div><input placeholder="<?php echo \think\Lang::get('Language_number_1264'); ?>" type="password" name="trade_pwd"></div>
				<div><button type="button" id="trade"><?php echo \think\Lang::get('Language_number_1265'); ?></button></div>
			</div>

		</div>
		<div class="keytest" style="display: none;">
			<div class="key_box">
				<h4><?php echo \think\Lang::get('Language_number_1266'); ?></h4>
				<div>
					<textarea type="text" name="encrypt" id="encrypt" placeholder="<?php echo \think\Lang::get('Language_number_1267'); ?>"></textarea>
				</div>
				<div class="btn_box flex-box">
					<button type="button" class="flex-list"><?php echo \think\Lang::get('Language_number_1268'); ?></button>
					<button type="button" class="flex-list" id="btn1"><?php echo \think\Lang::get('Language_number_1269'); ?></button>
				</div>
			</div>

		</div>
		<div class="fzsyy" style="display: none;">
			<div class="export_key">
				<div class="export_keybox">
					<p class="title"><?php echo \think\Lang::get('Language_number_1270'); ?></p>
					<div class="hidebtn"><img src="/static/index/images/close1.png"
						 alt=""></div>
					<div><textarea readonly="readonly" id="encrypt2"></textarea></div>
					<div class="subbtn"><button type="button" class="tag-read"><?php echo \think\Lang::get('Language_number_1271'); ?></button></div>
				</div>
			 
			</div>
		</div>
		<script src="/static/src/lib/zepto.min.js"></script>
	    <script src="/static/src/js/dialog.js"></script>
		<script>
			function checkMsg(msg) {
		      	$(document).dialog({
			        type : 'toast',
			        infoIcon: '/static/src/images/icon/loading.gif',
			        infoText: msg,
			        autoClose: 1500
			    });
		    }

		    $('#trade').click(function(){
		    	var trade = $("input[name='trade_pwd']").val();
		    	if (!trade) {
		    		return false;
		    	}

		    	$.post('<?php echo url("checkTradepwd"); ?>', {trade_pwd:trade}, function(res){
		    		if (res.code == 1) {
		    			$(".keytest").hide();
						$(".fzsyy").show();
						$('#encrypt2').val(res.encrypt);
		    		} else {
		    			$(document).dialog({
		        			type : 'toast',
					        infoIcon: '/static/src/images/icon/loading.gif',
					        infoText: res.msg,
					        autoClose: 1000,
					        onClosed: function(){
				    			location.href = res.url;
					        },
					    });
		    		}
		    	});
		    });

		    $('.tag-read').click(function(){
			        const range = document.createRange();
			        range.selectNode(document.getElementById('encrypt2'));//复制内容id
			        const selection = window.getSelection();
			        if(selection.rangeCount > 0) selection.removeAllRanges();
			        selection.addRange(range);
			        
			        document.execCommand('copy');
		    	function copyArticle(){
			    }
		    });
			/*$(".keytest").eq(0).find("button").click(function(){
				$(".keytest").hide();
				$(".fzsyy").show();
			});*/




			$('#btn1').click(function(){
				var encrypt = $('#encrypt').val();
				if (!encrypt) {
					return false;
				}
				$.get('<?php echo url("checkEncrypt"); ?>', {encrypt:encrypt}, function(res){
					if (res.code == 1) {
						location.href = res.url;
					} else {
						checkMsg(res.msg)
					}
				});
			});

			$(".hidebtn").click(function(){
				$(".keytest").hide();
				$(".fzsyy").hide();
			});

			$(".size").css("font-size", $("body").width() * 0.0625 + "px")
			
			function jymm(){
				$(".keytest").eq(1).show();
			}


			function dcsy(){
				$(".keytest").eq(0).show();
			}

			$(".keytest .btn_box button").eq(0).click(function(){
				$(".keytest").eq(1).hide();
			});
		</script>
	</body>
</html>