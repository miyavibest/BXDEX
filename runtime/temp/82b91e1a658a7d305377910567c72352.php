<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"/www/wwwroot/frcw1.52codes.cn/public/../app/index/view/user/logins.html";i:1561991808;s:63:"/www/wwwroot/frcw1.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
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
	<style>
	body, html {
		background: #000000;
		width: 100%;
	}
	</style>
	<body class="loginBg" >
		<div id="landing">
			<div class="header"></div>
			<div style="margin-top:-1rem;">
				<h4 class="title"><img src="/static/index/images/logo.png" alt="" style='height:185px;width:185px;'></h4>
                <br/>
				<div class="landing_box" style="margin-top: -3rem;">
					<div class="landing_ipt register_phone">
						<label onclick="lanp()"><em>+86</em> 
							<img src="/static/index/images/index.png" alt="" width="18">
						</label> 
						<input name="phone"   style="outline:none;cursor: pointer;" placeholder="<?php echo \think\Lang::get('Language_number_1293'); ?>" type="text">
					</div>

					<div class="landing_ipt">
						<span><img src="/static/index/images/yzm.png" alt=""></span> 
						<input style="width: 100px;outline:none;cursor: pointer;" name="code" placeholder="<?php echo \think\Lang::get('Language_number_1294'); ?>" type="text">
						<a class="imgcode">
							<img style="margin-top:12px;width: 90px" src="<?php echo url('createVerify'); ?>" id="captcha" onclick="this.src=this.src+'?'+'id='+Math.random()"/>
						</a>
					</div>
					<div class="landing_ipt">
						<span><img src="/static/index/images/yzm1.png" alt=""></span>
						<input style="width: 120px;outline:none;cursor: pointer;" name="verify" placeholder="<?php echo \think\Lang::get('Language_number_1295'); ?>" type="text">
						<button type="button" id="button2"><?php echo \think\Lang::get('Language_number_1296'); ?></button>
					</div>
				</div>

				<div class="landing_btn">
              		<button type="button" id="button1" style='width:40%;'><?php echo \think\Lang::get('Language_number_1297'); ?></button>
                  <button type="button"  style='width:40%;'><a href='/index/user/register1.html?id=0' style='color:white'>注册</a></button>
                </div>
				<div class="forget flex-box">
					<div class="flex-list"><a onclick="lan()"><?php echo \think\Lang::get('Language_number_1298'); ?></a></div>
				</div>

			</div>



		</div>
		<div class="more">
			<h4><?php echo \think\Lang::get('Language_number_1299'); ?></h4>
			<ul>
				<li rel="+852">香港 +852</li>
				<li rel="+853">macau +853</li>
				<li rel="+886">台灣 +886</li>
				<li rel="+82">South Korea +82</li>
				<li rel="+86">中国大陆 +86</li>
				<li rel="+81">Japan +81</li>
				<li rel="+1">The United States +1</li>
				<li rel="+1">Canada +1</li>
				<li rel="+44">Britain +44</li>
				<li rel="+65">Singapore +65</li>
				<li rel="+60">Malaysia +60</li>
				<li rel="+66">Thailand +66</li>
				<li rel="+85">Vietnam +84</li>
				<li rel="+63">The Philippines +63</li>
				<li rel="+62">Indonesia +62</li>
				<li rel="+39">Italy +39</li>
				<li rel="+7">Russia +7</li>
				<li rel="+64">New Zealand +64</li>
				<li rel="+31">In the Netherlands +31</li>
				<li rel="+46">The Swedish +46</li>
				<li rel="+61">Australia +61</li>
				<li rel="+380">Ukraine +380</li>
				<li rel="+33">The French +33</li>
				<li rel="+49">Germany +49</li>
				<li rel="+234">Nigeria +234</li>
				<li rel="+54">Argentina +54</li>
				<li rel="+91">India +91</li>
				<li rel="+971">Dubai +971</li>
				<li rel="+84">Vietnam +84</li>
			</ul>
		</div>
		<div class="lanbtn">
			<ul>
				<li class="lanlist" onclick="langcn()">简体中文</li>
				<li class="lanlist" onclick="langen()">English</li>
			</ul>
			<ul>
				<li onclick="hide()" class="lanlist"><?php echo \think\Lang::get('Language_number_1300'); ?></li>
			</ul>
		</div>
		<div style="display: none;" id="toast">
			<p><img src="/static/index/images/index.svg" alt=""></p> <p><?php echo \think\Lang::get('Language_number_1301'); ?></p>
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

		    function isMobile(str) {
		        var myreg = /^([0]?)(((13[0-9]{1})|(14[0-9]{1})|(15[0-9]{1})|(16[0-9]{1})|(17[0-9]{1})|(18[0-9]{1})|(19[0-9]{1}))+\d{8})$/;
		        return myreg.test(str);
		    }

			$('#button2').click(function(){
				var phone = $("input[name=phone]").val();
		        if (phone == "") {
		            checkMsg('<?php echo \think\Lang::get('Language_number_1302'); ?>');
		            return false;
		        }
		        if (!isMobile(phone)) {
		            checkMsg('<?php echo \think\Lang::get('Language_number_1303'); ?>');
		            return false;
		        }

		        var code = $("input[name=code]").val();
		        if (code == "") {
		            checkMsg('<?php echo \think\Lang::get('Language_number_1304'); ?>');
		            return false;
		        }
		        $.post('<?php echo url("checkVerify"); ?>', {code:code}, function(res){
		        	if (res.code == 0) {
		        		checkMsg(res.msg);
		            	return false;
		        	} else {
						buttonCountdown($('#button2'), 6000 * 10 * 1, "ss");
						$.post('<?php echo url("sendMobile"); ?>', {phone:phone,type:'login'}, function(res){
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
		            checkMsg('<?php echo \think\Lang::get('Language_number_1305'); ?>');
		            return false;
		        }
		        if (!isMobile(phone)) {
		            checkMsg('<?php echo \think\Lang::get('Language_number_1306'); ?>');
		            return false;
		        }

		        var verify = $("input[name=verify]").val();
		        if (verify == "") {
		            checkMsg('<?php echo \think\Lang::get('Language_number_1307'); ?>');
		            return false;
		        }

		        $.post('<?php echo url("logins"); ?>', {phone:phone,verify:verify}, function(res){
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
		        		$(document).dialog({
					        type : 'toast',
					        infoIcon: '/static/src/images/icon/loading.gif',
					        infoText: res.msg,
					        autoClose: 1000,
					    });

						$("input[name=code]").val('');
						$('#captcha').attr('src','<?php echo url("createVerify"); ?>?id='+Math.random());
		        	}
		        });


			});






			$(".size").css("font-size", $("body").width() * 0.0625 + "px")
			function lan() {
				$(".lanbtn").show()
			}
			function lanp(){
			   $(".more").show()
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
			
			
			
			
			
			
			$(".more li").click(function(){
				$(".register_phone").find("label em").text($(this).attr("rel"))
				$(".more").hide()
			})
			/*function diqu() {
				$(".more").show()
			}*/
			function hide() {
				$(".lanbtn").hide()
			}

			$('.lanbtn ul li').click(function(){
				
				
				
			});




			
			function buttonCountdown($el, msNum, timeFormat){
	        var text = $el.data("text") || $el.text(),
	            timer = 0;
	        $el.prop("disabled", true).addClass("disabled")
	                .on("bc.clear", function () {
	                    clearTime();
	                });
	        (function countdown() {
	            var time = showTime(msNum)[timeFormat];
	            $el.text(time + '<?php echo \think\Lang::get('Language_number_1308'); ?>');
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
	                d: d + "<?php echo \think\Lang::get('Language_number_1309'); ?>",
	                h: h + "<?php echo \think\Lang::get('Language_number_1310'); ?>",
	                m: m + "<?php echo \think\Lang::get('Language_number_1311'); ?>",
	                ss: ss + "<?php echo \think\Lang::get('Language_number_1312'); ?>",
	                "d:h:m:s": d + "<?php echo \think\Lang::get('Language_number_1313'); ?>" + h + "<?php echo \think\Lang::get('Language_number_1314'); ?>" + m + "<?php echo \think\Lang::get('Language_number_1315'); ?>" + s + "<?php echo \think\Lang::get('Language_number_1316'); ?>",
	                "h:m:s": h + "<?php echo \think\Lang::get('Language_number_1317'); ?>" + m + "<?php echo \think\Lang::get('Language_number_1318'); ?>" + s + "<?php echo \think\Lang::get('Language_number_1319'); ?>",
	                "m:s": m + "<?php echo \think\Lang::get('Language_number_1320'); ?>" + s + "<?php echo \think\Lang::get('Language_number_1321'); ?>"
	            };
	        }
	        return this;
	    }
		</script>
	</body>
</html>
