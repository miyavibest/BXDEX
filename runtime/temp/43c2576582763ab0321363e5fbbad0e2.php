<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"/www/wwwroot/frcw.52codes.cn/public/../app/index/view/ucenter/feedback.html";i:1550766098;s:62:"/www/wwwroot/frcw.52codes.cn/app/index/view/public/header.html";i:1559554411;}*/ ?>
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
	<link rel="stylesheet" href="/static/common/layuiadmin/layui/css/layui.css">
	<body class="wallet setBox">

		<div id="app">
			<div class="feed">
				<div class="header headerw">
					<a href="<?php echo url('my/index'); ?>" class="icon-left">
						<img src="/static/index/images/left.png" alt="">
					</a>
					<h1><?php echo \think\Lang::get('Language_number_1243'); ?></h1> 
					<a href="<?php echo url('feedbackList'); ?>" class="icon-right">
						<?php echo \think\Lang::get('Language_number_1244'); ?>
					</a>
				</div>
				<div>
					<textarea type="text" name="content" id="content" placeholder="<?php echo \think\Lang::get('Language_number_1245'); ?>"></textarea>
				</div>

				<div class="layui-form-item">
		          <div class="layui-upload">
		              <input class="layui-upload-file" type="file">
		              <input type="hidden" name="thumb">
		              <!-- <input type="hidden" name="id"> -->
		              <div class="layui-upload-list">
		                <img class="layui-upload-img" src="/static/common/layuiadmin/layui/images/pic.png" id="upload1">
		                <p id="demoText"></p>
		              </div>
		          </div>
		      </div>




				<!-- <div class="feedback">
					<label for="img">
						<img src="/static/index/images/pic.png" alt="">
					</label> 
					<input id="img" type="file">
				</div> -->
				<div class="subbtn feedbackbtn">
					<button type="button" id="button1"><?php echo \think\Lang::get('Language_number_1246'); ?></button>
				</div>
			</div>
		</div>

		<script src="/static/common/layuiadmin/layui/layui.js" charset="utf-8"></script>
		<script src="/static/src/lib/zepto.min.js"></script>
	    <script src="/static/src/js/dialog.js"></script>
		<script>
			$(".size").css("font-size", $("body").width() * 0.0625 + "px");
			layui.use('upload', function(){
			  var $ = layui.jquery,upload = layui.upload;
			  
			  //普通图片上传
			  var uploadInst = upload.render({
			    elem: '#upload1'
			    ,url: '<?php echo url("common/upload"); ?>'
			    ,before: function(obj){
			      //预读本地文件示例，不支持ie8
			      obj.preview(function(index, file, result){
			        $('#upload1').attr('src', result).css("width","90%"); //图片链接（base64）
			      });
			    }
			    ,done: function(res){
			      //如果上传失败
			      if(res.code == 0){
			        return layer.msg('<?php echo \think\Lang::get('Language_number_1247'); ?>');
			      }
			      //上传成功
			      if(res.code ==1){
			          $('input[name=thumb]').val(res.url);
			        return layer.msg('<?php echo \think\Lang::get('Language_number_1248'); ?>');
			      }
			    }
			  });
			});

			function checkMsg(msg){
		      	$(document).dialog({
			        type : 'toast',
			        infoIcon: '/static/src/images/icon/loading.gif',
			        infoText: msg,
			        autoClose: 1500
			    });
		    }

			$('#button1').click(function(){
				var content = $("#content").val();
				var thumb   = $("input[name=thumb]").val();
		        if (content == "") {
		            checkMsg('<?php echo \think\Lang::get('Language_number_1249'); ?>');
		            return false;
		        }

		        $.post('<?php echo url("feedback"); ?>', {content:content,thumb:thumb}, function(res){
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
		        	}
		        });


			});







			/*$(function(){
				$("#img").change(function(){
					var objUrl = getObjectURL(this.files[0]);
					console.log("objUrl = "+objUrl);
					if(objUrl){
						$(".feedback img").attr("src", objUrl);									 
						 									 
					}
				});
			});
			
			//建立一個可存取到該file的url
			function getObjectURL(file) {
				var url = null ; 
				if (window.createObjectURL!=undefined){ // basic
					url = window.createObjectURL(file) ;
				}else if (window.URL!=undefined){ // mozilla(firefox)
					url = window.URL.createObjectURL(file) ;
				} else if (window.webkitURL!=undefined){ // webkit or chrome
					url = window.webkitURL.createObjectURL(file) ;
				}
				return url ;
			}*/
		</script>
	</body>
</html>