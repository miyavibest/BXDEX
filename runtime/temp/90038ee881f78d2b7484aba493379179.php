<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:74:"/www/wwwroot/159.138.143.90/public/../app/index/view/wallet/gathering.html";i:1559113548;s:61:"/www/wwwroot/159.138.143.90/app/index/view/public/header.html";i:1559554411;}*/ ?>
	<!DOCTYPE html>
<html class="size">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
		<title>Jade Token</title>
		<link href="/static/index/css/app.css" rel="stylesheet">
		<script src="/static/index/js/jquery-1.js"></script>
	</head>
	
	<?php if($id != 1): ?>
		
		<style>
		.eosmemocla{display:none;}
		</style>
		
	<?php endif; ?>
	
	
	<body class="out">
		<div id="app">
			<div id="gathering" style="background: #fff;">
				<div class="header">
					<a href="<?php echo url('wallet/current', ['id'=>input('param.id')]); ?>" class="icon-left">
						<img src="/static/index/images/left1.png" alt="">
					</a>
					<h1 style="text-transform: uppercase;"><?php echo $name; ?><?php echo \think\Lang::get('Language_number_1377'); ?></h1>
				</div>
				
				
				
				
				<div class="code_box">
					<div class="qrcode">
						<div id="qrcode" style="height: 12rem;" title="14NSNiN3CPcaAnX1rk45fKsVqNCEuKCowf">
							<p style="text-transform: uppercase;text-align: center;font-weight: bolder;padding-bottom: 10px;"><?php echo $name; ?><?php echo \think\Lang::get('Language_number_1378'); ?></p> 
				
							<img alt="Scan me!" style="display: block;" src="http://qr.liantu.com/api.php?text=<?php echo $info['address']; ?>">
						</div>
					</div>
					<div class="useradd">
						<textarea readonly="readonly" id="article" style="border: 1px solid #e6e6e6;resize: none;background: #fff;text-align: center;margin-bottom: 0;line-height: inherit;padding: .7rem .5rem 0 .5rem;"><?php echo $info['address']; ?></textarea>
					</div>
				</div>
				<div class="copybtn">
					<button class="copytxt" data-clipboard-action="copy" data-clipboard-target="#article" type="button" onclick="copyArticle()" style="background: none;border:0;color: #f72525;border-radius: 3px;margin-top: 0px;background: #302f35;color: #fff;"><?php echo \think\Lang::get('Language_number_1379'); ?></button>
				</div>
				
				
				<?php if($id ==1): ?>
				
				<div class="code_box">
					<div class="qrcode" style="height: 1.2rem;">
						<div id="qrcode" title="14NSNiN3CPcaAnX1rk45fKsVqNCEuKCowf">
							<p style="text-transform: uppercase;text-align: center;font-weight: bolder;padding-bottom: 10px;    font-size: 16px;"><?php echo \think\Lang::get('Language_number_1447'); ?></p> 
						</div>
					</div>
					<div class="useradd">
						<textarea readonly="readonly" id="article2" style="border: 1px solid #e6e6e6;resize: none;background: #fff;text-align: center;margin-bottom: 0;line-height: inherit;padding: .7rem .5rem 0 .5rem;"><?php echo $info['eosmemo']; ?></textarea>
					</div>
				</div>
				<div class="copybtn">
					<button class="copytxt" data-clipboard-action="copy" data-clipboard-target="#article2" type="button" onclick="copyArticle2()" style="background: none;border:0;color: #f72525;border-radius: 3px;margin-top: 0px;background: #302f35;color: #fff;"><?php echo \think\Lang::get('Language_number_1379'); ?></button>
				</div>
				
				<?php endif; ?>
				
				
				<form action="<?php echo url('wallet/formpost'); ?>"  id="goto" method="post">
				<div class="code_box" style="border-top: 20px solid #e8e8e8;border-radius: 0px;width:100%;">
				     <input type="hidden" value="<?php echo $name; ?>" name="type"> 
					<div class="useradd" style="width: 90%;margin-left: 5%;    margin-top: 10px;margin-bottom: 10px;">
						<p style="text-transform: uppercase;width: 28%;display: inline-block;    color: #565656;font-size: 16px;"><?php echo \think\Lang::get('Language_number_1380'); ?></p> 
						<input type="text"  placeholder="<?php echo \think\Lang::get('Language_number_1449'); ?>" name="num" style="outline:none;cursor: pointer;margin-left:1%;width: 60%;display: inline-block;    border: none;border-bottom: 1px solid #848484;">
					</div>
					<div class="useradd"style="width: 90%;margin-left: 5%;   margin-top: 10px;margin-bottom: 10px;">
						<p style="text-transform: uppercase;width: 28%;display: inline-block;    color: #565656;font-size: 16px;"><?php echo \think\Lang::get('Language_number_1381'); ?></p> 
						<input type="text" name="remark" placeholder="<?php echo \think\Lang::get('Language_number_1450'); ?>" style="outline:none;cursor: pointer;margin-left:1%;width: 60%;display: inline-block;    border: none;border-bottom: 1px solid #848484;">
					</div>
					<div class="useradd" style="width: 90%;margin-left: 5%;   margin-top: 10px;margin-bottom: 10px;">
						<p style="text-transform: uppercase;color: #565656;font-size: 16px;"><?php echo \think\Lang::get('Language_number_1382'); ?></p> 
					    <textarea name="dizhi" placeholder="<?php echo \think\Lang::get('Language_number_1451'); ?>" style="outline:none;cursor: pointer;resize: none;border-bottom: 1px solid #848484;background: #fff;padding:0;line-height: inherit;"></textarea>
					</div>
					
					<div class="useradd eosmemocla" style="width: 90%;margin-left: 5%;   margin-top: 10px;margin-bottom: 10px;">
						<p style="text-transform: uppercase;color: #565656;font-size: 16px;"><?php echo \think\Lang::get('Language_number_1448'); ?></p> 
					    <textarea name="eosmemo" placeholder="<?php echo \think\Lang::get('Language_number_1452'); ?>" style="outline:none;cursor: pointer;resize: none;border-bottom: 1px solid #848484;background: #fff;padding:0;line-height: inherit;"></textarea>
					</div>
					
				</div>
				<div class="copybtn">
					<button type="button" onclick="tijiao()" style="background: #302f35;color: #fff;border: #fff;margin-top: 1rem;"><?php echo \think\Lang::get('Language_number_1383'); ?></button>
				</div>
				</form>
				
				
				
				
				
				<div class="useradd" style="width: 90%;margin-left: 5%;   margin-top: 20px;margin-bottom: 10px;padding-top:10px;background: ;font-weight:bolder;border:none;border-radius: 0px;">
					<p style="color: #f00;font-size: 14px;"><?php echo \think\Lang::get('Language_number_1384'); ?></p> 
					<p style="color: #f00;font-size: 12px;"><?php echo \think\Lang::get('Language_number_1385'); ?></p> 
					<p style="color: #f00;font-size: 12px;"><?php echo \think\Lang::get('Language_number_1386'); ?></p> 
					<p style="color: #f00;font-size: 12px;"><?php echo \think\Lang::get('Language_number_1387'); ?></p> 
				</div>
			
				
			</div>
			
		</div>

		<script src="/static/index/js/clipboard.min.js"></script>
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px");
			
			
			
			
				var clipboard = new Clipboard('.copytxt');

				clipboard.on('success', function(e) {
					alert("<?php echo \think\Lang::get('Language_number_1388'); ?>");
					console.log(e);
				});

				clipboard.on('error', function(e) {
					alert("Error");
					console.log(e);
				});

			
				
				function copyArticle(){
					return;
					/*
			        const range = document.createRange();
			        range.selectNode(document.getElementById('article'));//复制内容id
			        const selection = window.getSelection();
			        if(selection.rangeCount > 0) selection.removeAllRanges();
			        selection.addRange(range);
			        
			        document.execCommand('copy');
					alert("<?php echo \think\Lang::get('Language_number_1388'); ?>");
					*/
			    }
				
				
				
				
				<?php if($id ==1): ?>
				
				function copyArticle2(){
					return;
					/*
			        const range = document.createRange();
			        range.selectNode(document.getElementById('article2'));//复制内容id
			        const selection = window.getSelection();
			        if(selection.rangeCount > 0) selection.removeAllRanges();
			        selection.addRange(range);
			        
			        document.execCommand('copy');
					alert("<?php echo \think\Lang::get('Language_number_1388'); ?>");
					*/
			    }

				<?php endif; ?>
				
				
				
			function tijiao()
			{
			  $("#goto").submit();
 			}	
		</script>
	</body>
</html>
