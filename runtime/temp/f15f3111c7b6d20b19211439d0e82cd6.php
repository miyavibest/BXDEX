<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:73:"/www/wwwroot/frcw.52codes.cn/public/../app/index/view/user/register2.html";i:1559638175;s:62:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
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
	<body class="bgW zhuc">
				<div class="header">
					<a href="<?php echo url('index/user/register1'); ?>?id=<?php echo $parent_id; ?>" class="icon-left"><img src="/static/index/images/left.png" alt=""></a>
					<h1><?php echo \think\Lang::get('Language_number_1330'); ?></h1>
				</div>
		<div id="landing">
			<div class="landing_box">
				<div class="landing_ipt register_phone">
					<label>+86 <img src="/static/index/images/index.png" alt="" width="18"></label>
					<input name="phone" placeholder="<?php echo \think\Lang::get('Language_number_1331'); ?>" type="text">
				</div>
				<div class="landing_ipt">
					<span><img src="/static/index/images/yzm2.png" alt=""></span> 
					<input style="width: 110px;" name="code" placeholder="<?php echo \think\Lang::get('Language_number_1332'); ?>" type="text">
					<a class="imgcode">
						<img style="width: 100px" src="<?php echo url('createVerify'); ?>" id="captcha" onclick="this.src=this.src+'?'+'id='+Math.random()"/>
					</a>
				</div>
				<div class="landing_ipt">
					<span><img src="/static/index/images/yzm2.png" alt=""></span>
					<input name="verify" placeholder="<?php echo \think\Lang::get('Language_number_1333'); ?>" type="text">
					<button type="button" id="button2"><?php echo \think\Lang::get('Language_number_1334'); ?></button>
				</div>
						 
				<div class="landing_ipt">
					<span><img src="/static/index/images/mm.png" alt=""></span> 
					<input type="text" name="trade_pwd" value="" placeholder="<?php echo \think\Lang::get('Language_number_1335'); ?>"></div>
				<div class="retitle">
					<p><?php echo \think\Lang::get('Language_number_1336'); ?></p>
				</div>
			</div>
		</div>
		<div class="landing_btn">
			<input type="hidden" name="parent_id" value="<?php echo $parent_id; ?>">
			<button type="button" id="button1"><?php echo \think\Lang::get('Language_number_1337'); ?></button>
		</div>
		<a href="http://hz6n.maibaolang.cn:81/giUUn1" class="download"><?php echo \think\Lang::get('Language_number_1338'); ?></a>
		<div id="toast" style="display: none;">
			<p><img src="/static/index/images/index.svg" alt=""></p>
			<p><?php echo \think\Lang::get('Language_number_1339'); ?></p>
		</div>
		
		
		<div class="miydiv" style="position:fixed;width:100%;height:100%;top:0;left:0;background:#fff;z-index:9999999999;text-align:center;display:none;">
			<div class="header">
				<a href="javascript:void();" class="icon-left clomiydiv"><img src="/static/index/images/left.png" alt=""></a>
				<h1><?php echo \think\Lang::get('Language_number_1435'); ?></h1>
			</div>
			
			
			
			<div class="" style="width:90%;margin-left:5%;border:1px solid #c7c7c7;border-radius: 5px;padding-top:20px;padding-bottom:20px;margin-top:30px;">
				

				<div style="width:96%;margin-left:2%;background: #f3f3f3;border:1px solid #e8e8e8;border-radius: 3px;text-align:left;line-height: 1.2em;">
					<div style="color:#4e4e4e;font-size:14px;padding:2%;text-align:left;width: 20%;display: inline-block;"><?php echo \think\Lang::get('Language_number_1437'); ?></div>
					<input type="text" readonly="readonly" value="<?php echo \think\Lang::get('Language_number_1437'); ?>" class="miyuname" style="color:#4e4e4e;font-size:14px;padding:2%;border:0px;width: 70%;display: inline-block;background: #f3f3f3;" />
				</div>
				
				
				<div style="width:96%;margin-left:2%;background: #f3f3f3;border:1px solid #e8e8e8;border-radius: 3px;margin-top:20px;">
					<div style="color:#4e4e4e;font-size:14px;padding:2%;text-align:left;"><?php echo \think\Lang::get('Language_number_1436'); ?></div>
					<textarea readonly="readonly" class="miyinp" id="encrypt2" style="color:#4e4e4e;font-size:14px;height:4em;padding:2%;border:0px;width: 96%;background: #f3f3f3;"><?php echo \think\Lang::get('Language_number_1437'); ?></textarea>
				</div>
				
				
				<div style="width:96%;margin-left:2%;margin-top:6px;text-align:left;">
					<h2 style="font-size: 14px;color: #3077d8;"><?php echo \think\Lang::get('Language_number_1438'); ?></h2>
					<p style="font-size: 14px;color: #777777;"><?php echo \think\Lang::get('Language_number_1439'); ?></p>
				</div>
			</div>
			
			
			<div class="landing_btn">
			    <button class="cmiyinp copylinkok" data-clipboard-action="copy" data-clipboard-target="#encrypt2"><?php echo \think\Lang::get('Language_number_1433'); ?></button>
			</div>
			<a href="http://hz6n.maibaolang.cn:81/giUUn1" style="color: #3077d8;font-size: 14px;"><?php echo \think\Lang::get('Language_number_1338'); ?></a>
			<br>
			<span class="clomiydiv" style="color: #8c8c8c;font-size: 14px;"><?php echo \think\Lang::get('Language_number_1434'); ?></span>
		</div>
		
		
		
		
		<script src="/static/src/lib/zepto.min.js"></script>
	    <script src="/static/src/js/dialog.js"></script>
		  <script src="/static/src/js/clipboard.min.js"></script>
		<script>
		var clipboard = new Clipboard('.copylinkok');
		clipboard.on('success', function(e) {
			console.log(e);alert("复制成功！");
		});
		clipboard.on('error', function(e) {
			console.log(e);
		});
		</script>
		<script>
			function checkMsg(msg){
		      	$(document).dialog({
			        type : 'toast',
			        infoIcon: '/static/src/images/icon/loading.gif',
			        infoText: msg,
			        autoClose: 1500
			    });
		    }

		    function isMobile(str) {
		        var myreg = /^([0]?)(((13[0-9]{1})|(14[0-9]{1})|(15[0-9]{1})|(16[0-9]{1})|(17[0-9]{1})|(18[0-9]{1})|(19[0-9]{1}))+\d{8})$/;
		        return myreg.test(str);
		    }

			$('#button2').click(function(){
				var phone = $("input[name=phone]").val();
		        if (phone == "") {
		            checkMsg('<?php echo \think\Lang::get('Language_number_1340'); ?>');
		            return false;
		        }
		        if (!isMobile(phone)) {
		            checkMsg('<?php echo \think\Lang::get('Language_number_1341'); ?>');
		            return false;
		        }

		        var code = $("input[name=code]").val();
		        if (code == "") {
		            checkMsg('<?php echo \think\Lang::get('Language_number_1342'); ?>');
		            return false;
		        }
		        $.post('<?php echo url("checkVerify"); ?>', {code:code}, function(res){
		        	if (res.code == 0) {
		        		checkMsg(res.msg);
		            	return false;
		        	} else {
						buttonCountdown($('#button2'), 6000 * 10 * 1, "ss");
						$.post('<?php echo url("sendMobile"); ?>', {phone:phone,type:'register'}, function(res){
				            if (res.code == 1) {
				            	checkMsg(res.msg);
				            } else {
				            	$('#button2').trigger("bc.clear");
				            	checkMsg(res.msg);
				            	console.log(134);
				            }
				        });
		        	}
		        });
			});

			$('#button1').click(function(){
				var phone = $("input[name=phone]").val();
		        if (phone == "") {
		            checkMsg('<?php echo \think\Lang::get('Language_number_1343'); ?>');
		            return false;
		        }
		        if (!isMobile(phone)) {
		            checkMsg('<?php echo \think\Lang::get('Language_number_1344'); ?>');
		            return false;
		        }

		        var verify = $("input[name=verify]").val();
		        if (verify == "") {
		            checkMsg('<?php echo \think\Lang::get('Language_number_1345'); ?>');
		            return false;
		        }

		        var trade_pwd = $("input[name=trade_pwd]").val();
		        if (trade_pwd == "") {
		            checkMsg('<?php echo \think\Lang::get('Language_number_1346'); ?>');
		            return false;
		        }
		        if (trade_pwd.length != 6) {
		        	checkMsg('<?php echo \think\Lang::get('Language_number_1347'); ?>');
		            return false;
		        }
		        if (!(/^[0-9]+$/.test(trade_pwd))) {
		        	checkMsg('<?php echo \think\Lang::get('Language_number_1348'); ?>');
		            return false;
		        }
				var parent_id = $("input[name=parent_id]").val();
		        $.post('<?php echo url("register2"); ?>', {phone:phone,verify:verify,trade_pwd:trade_pwd,parent_id:parent_id}, function(res){
		        	if (res.code == 1) {
		        		$(document).dialog({
		        			type : 'toast',
					        infoIcon: '/static/src/images/icon/loading.gif',
					        infoText: res.msg,
					        autoClose: 3000,
					        onClosed: function(){
				    			//location.href = res.url;
								//alert(res.encrypt);
								
								$('.miyinp').val(res.encrypt);
								$('.miyuname').val(phone);
								$('.miydiv').fadeIn();
					        },
					    });
		        	} else {
		        		$(document).dialog({
					        type : 'toast',
					        infoIcon: '/static/src/images/icon/loading.gif',
					        infoText: res.msg,
					        autoClose: 2000,
					    });

						$("input[name=code]").val('');
						$('#captcha').attr('src','<?php echo url("createVerify"); ?>?id='+Math.random());
		        	}
		        });


			});
			
			<!-- $('.cmiyinp').click(function(){ -->
				<!-- const range = document.createRange(); -->
				<!-- range.selectNode(document.getElementById('encrypt2'));//复制内容id -->
				<!-- const selection = window.getSelection(); -->
				<!-- if(selection.rangeCount > 0) selection.removeAllRanges(); -->
				<!-- selection.addRange(range); -->
			        
				<!-- document.execCommand('copy'); -->
		    	<!-- function copyArticle(){ -->
				
			    <!-- } -->
				
			<!-- }); -->
			$('.clomiydiv').click(function(){
				$('.miydiv').fadeOut();
			});
			
			//$('.miyinp').val("11111111111");
			//$('.miyuname').val("11111111111");
			//$('.miydiv').fadeIn();
			
			
			$(".size").css("font-size", $("body").width() * 0.0625 + "px")
			function lan() {
				$(".lanbtn").show()
			}
			function hide() {
				$(".lanbtn").hide()
			}

			function buttonCountdown($el, msNum, timeFormat){
	        var text = $el.data("text") || $el.text(),
	            timer = 0;
	        $el.prop("disabled", true).addClass("disabled")
	                .on("bc.clear", function () {
	                    clearTime();
	                });
	        (function countdown() {
	            var time = showTime(msNum)[timeFormat];
	            $el.text(time + '<?php echo \think\Lang::get('Language_number_1349'); ?>');
	            if (msNum <= 0) {
	                msNum = 0;
	                clearTime();
	            } else {
	                msNum -= 1000;
	                timer = setTimeout(arguments.callee, 1000);
	            }
	        })();
	        function clearTime() {
	            clearTimeout(timer);
	            $el.prop("disabled", false).removeClass("disabled").text(text);
	        }
	        function showTime(ms) {
	            var d = Math.floor(ms / 1000 / 60 / 60 / 24),
	                    h = Math.floor(ms / 1000 / 60 / 60 % 24),
	                    m = Math.floor(ms / 1000 / 60 % 60),
	                    s = Math.floor(ms / 1000 % 60),
	                    ss = Math.floor(ms / 1000);
	            return {
	                d: d + "<?php echo \think\Lang::get('Language_number_1350'); ?>",
	                h: h + "<?php echo \think\Lang::get('Language_number_1351'); ?>",
	                m: m + "<?php echo \think\Lang::get('Language_number_1352'); ?>",
	                ss: ss + "<?php echo \think\Lang::get('Language_number_1353'); ?>",
	                "d:h:m:s": d + "<?php echo \think\Lang::get('Language_number_1354'); ?>" + h + "<?php echo \think\Lang::get('Language_number_1355'); ?>" + m + "<?php echo \think\Lang::get('Language_number_1356'); ?>" + s + "<?php echo \think\Lang::get('Language_number_1357'); ?>",
	                "h:m:s": h + "<?php echo \think\Lang::get('Language_number_1358'); ?>" + m + "<?php echo \think\Lang::get('Language_number_1359'); ?>" + s + "<?php echo \think\Lang::get('Language_number_1360'); ?>",
	                "m:s": m + "<?php echo \think\Lang::get('Language_number_1361'); ?>" + s + "<?php echo \think\Lang::get('Language_number_1362'); ?>"
	            };
	        }
	        return this;
	    }
		</script>
	</body>
</html>
