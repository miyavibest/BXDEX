<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"/www/wwwroot/frcw.52codes.cn/public/../app/index/view/openamount/index.html";i:1551113374;s:62:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
	<!DOCTYPE html>
<html class="size">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
		<title>Jade Token</title>
		<link href="/static/index/css/app.css" rel="stylesheet">
		<script src="/static/index/js/jquery-1.js"></script>
	</head>
	<style type="text/css">
	.openview_info p{text-transform: uppercase;}
	</style>
	<body class="wallet">
		<div id="app" class="smart">
			<div>
				<div class="header">
					<a href="<?php echo url('my/index'); ?>" class="icon-left">
						<img src="/static/index/images/left.png" alt="">
					</a>
					<h1><?php echo \think\Lang::get('Language_number_1208'); ?></h1> 
					<a href="<?php echo url('openamount/openlist'); ?>" class="icon-right">
						<img src="/static/index/images/jl.png" alt="">
					</a>
				</div>
				<div class="bit">
					<ul>
					<?php if(is_array($coinlist) || $coinlist instanceof \think\Collection || $coinlist instanceof \think\Paginator): $i = 0; $__LIST__ = $coinlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<li class="flex-box bit_list">
							<div class="flex-list bittype"><span><img src="/static/index/images/<?php echo $vo['logo']; ?>" alt=""></span>
							<span><?php echo $vo['name']; ?></span></div>
							<?php if($vo['open'] == 1): ?>
							<div class="flex-list"><span class="off bitok"><?php echo \think\Lang::get('Language_number_1209'); ?></span></div>
							<?php else: ?>
							<div class="flex-list"><span class="off bitok"><?php echo \think\Lang::get('Language_number_1210'); ?></span></div>
							<?php endif; ?>
							<div class="flex-list"><span class="btnokbtm" data='<?php echo json_encode($vo); ?>'><?php echo \think\Lang::get('Language_number_1211'); ?></span></div>
							<div class="flex-list"><span class="btnnoup"  data='<?php echo json_encode($vo); ?>'><?php echo \think\Lang::get('Language_number_1212'); ?></span></div>
						</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<div class="openview" style="display: none;">
					<div class="setview">
						<div>
							<div class="openview_info">
								<h4><?php echo \think\Lang::get('Language_number_1213'); ?></h4>
								<p id="open_money"><?php echo \think\Lang::get('Language_number_1214'); ?></p>
								<p id="able_money"><?php echo \think\Lang::get('Language_number_1215'); ?></p>
							</div>
						</div>
						<div><input name="number" placeholder="<?php echo \think\Lang::get('Language_number_1216'); ?>" type="number"></div>
						<div><input name="bypass" placeholder="<?php echo \think\Lang::get('Language_number_1217'); ?>" type="password"></div>
						<input type="hidden" value="0" name="coinid" id="coinid">
						<div><button type="button" onclick="openmoney()"><?php echo \think\Lang::get('Language_number_1218'); ?></button></div>
						<div class="hidebtn"><img src="/static/index/images/close.png" alt=""></div>
					</div>
				</div>
				<div class="openview" style="display: none;">
					<div class="setview locksetview">
						<div>
							<div class="openview_info">
								<h4><?php echo \think\Lang::get('Language_number_1219'); ?></h4>
								<p id="close_money"><?php echo \think\Lang::get('Language_number_1220'); ?></p>
							</div>
						</div>
						<div><input name="close_number" value="" placeholder="<?php echo \think\Lang::get('Language_number_1221'); ?>" type="number"></div>
						<div><input name="close_bypass" value="" placeholder="<?php echo \think\Lang::get('Language_number_1222'); ?>" type="password"></div>
						<input type="hidden" id="close_coinid" name="close_coinid">
						<div><button type="button" onclick="closemoney()"><?php echo \think\Lang::get('Language_number_1223'); ?></button></div>
						<div class="hidebtn"><img src="/static/index/images/close.png" alt=""></div>
					</div>
				</div>



				<!-- ff7575  -->
				<div class="openview" style="display: none;">
					<div class="setview locksetview" style="height: 10rem;top:55%;">
						<div style="background: #6376ff;">
							<div class="openview_info" style="background: #6376ff;">
								<h4 class="openview_infoptxt"></h4>
							</div>
						</div>
						<div><button type="button" onclick="closemoneyyes()" style="width:40%;"><?php echo \think\Lang::get('Language_number_1223'); ?></button>
						<button type="button" class="hidebtn2" style="background: #c5c5c5 !important;width:40%;"><?php echo \think\Lang::get('Language_number_1199'); ?></button></div>
						<div class="hidebtn"><img src="/static/index/images/close.png" alt=""></div>
					</div>
				</div>






				
			</div>
		</div>
		<script>
			$(".btnokbtm").click(function(){
				var data = $(this).attr('data');
				var data_arr = JSON.parse(data);
				$("#open_money").html('<?php echo \think\Lang::get('Language_number_1224'); ?>'+data_arr.name+' '+data_arr.openmoney);
				$("#able_money").html('<?php echo \think\Lang::get('Language_number_1225'); ?>'+data_arr.name+' '+data_arr.able_money);
				$("#coinid").val(data_arr.id);
				$(".openview").eq(0).show();
			})
			$(".btnnoup").click(function(){
				var data = $(this).attr('data');
				var data_arr = JSON.parse(data);
				$("#close_money").html('<?php echo \think\Lang::get('Language_number_1226'); ?>'+data_arr.name+' '+data_arr.openmoney);
				$("#close_coinid").val(data_arr.id);
				$(".openview").eq(1).show()
			});
			$(".hidebtn").click(function(){
				$(".openview").hide();
			})
			$(".hidebtn2").click(function(){
				$(".openview").hide();
			})
			//开启提交
			function openmoney(){
				var number = $("input[name='number']").val();
				var bypass = $("input[name='bypass']").val();
				var coinid = $("#coinid").val();
				$.post('<?php echo url("openamount/openmoney"); ?>', {'number':number,'bypass':bypass,'coinid':coinid}, function(res){
		        	if(res.code){
		        	  $(".openview").hide();
		        	  alert(res.msg);
		              window.location=res.url
		          }else{
		              if(res.msg=="psignnone"){
						alert("<?php echo \think\Lang::get('Language_number_1432'); ?>");
						setTimeout(function(){
							location.href="/index/index/pinfosign.html";
						}, 1500);
					  }else{
						alert(res.msg);
					  }
		          }
		        },'json');
			}
			//关闭提交
			function closemoney2222(){
				var number = $("input[name='close_number']").val();
				var bypass = $("input[name='close_bypass']").val();
				var coinid = $("#close_coinid").val();
				$.post('<?php echo url("openamount/closemoney"); ?>', {'number':number,'bypass':bypass,'coinid':coinid}, function(res){
		        	if(res.code){
		        	  $(".openview").hide();
		        	  alert(res.msg);
		              window.location=res.url
		          }else{
		              alert(res.msg);
		          }
		        },'json');
			}
			
			var numberccp = "";
			var bypassccp = "";
			var coinidccp = "";
			
			
			function closemoney(){
				numberccp = $("input[name='close_number']").val();
				bypassccp = $("input[name='close_bypass']").val();
				coinidccp = $("#close_coinid").val();
				
				$.post('<?php echo url("openamount/getopenview_infoptxt"); ?>', {'coinid':coinidccp}, function(res){
					$(".openview_infoptxt").html(res.msg);
					$(".openview").eq(2).show();
		        },'json');
			}
			
			function closemoneyyes(){
				closemoneyyorn(numberccp,bypassccp,coinidccp);
			}
			function closemoneyyorn(number,bypass,coinid){
				$.post('<?php echo url("openamount/closemoney"); ?>', {'number':number,'bypass':bypass,'coinid':coinid}, function(res){
		        	if(res.code){
		        	  $(".openview").hide();
		        	  alert(res.msg);
		              window.location=res.url
		          }else{
		              alert(res.msg);
		          }
		        },'json');
			}
			
			
			$(".size").css("font-size", $("body").width() * 0.0625 + "px")
		</script>
	</body>
</html>