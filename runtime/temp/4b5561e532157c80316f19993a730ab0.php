<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"/www/wwwroot/frcw.52codes.cn/public/../app/sdkfjf/view/system/email.html";i:1546912328;s:61:"/www/wwwroot/frcw.52codes.cn/app/sdkfjf/view/common/head.html";i:1546849872;s:61:"/www/wwwroot/frcw.52codes.cn/app/sdkfjf/view/common/foot.html";i:1544153938;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo config('sys_name'); ?>后台管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/common/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/common/layuiadmin/style/admin.css" media="all">

    <script>
    /^http(s*):\/\//.test(location.href) || alert('请先部署到 localhost 下再访问');
    </script>
</head>

<div class="layui-fluid"><div class="layui-card"><div class="layui-card-body">
    <fieldset class="layui-elem-field layui-field-title">
        <legend>邮箱配置</legend>
    </fieldset>
    <form class="layui-form layui-form-pane">
        <div class="layui-form-item">
            <label class="layui-form-label">收件人邮箱</label>
            <div class="layui-input-block">
                <input type="text" lay-verify="required" name="receive_email" placeholder="SMTP服务器" value="<?php echo $info['receive_email']; ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">收件人姓名</label>
            <div class="layui-input-block">
                <input type="text" lay-verify="required" name="receive_name" placeholder="SMTP端口" value="<?php echo $info['receive_name']; ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">邮件标题</label>
            <div class="layui-input-block">
                <input type="text" name="receive_title" lay-verify="required" placeholder="发信人邮件地址" value="<?php echo $info['receive_title']; ?>" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">邮件内容</label>
            <div class="layui-input-block">
                <input type="text" name="receive_content" id="receive_content" placeholder="测试接收邮件地址" value="<?php echo $info['receive_content']; ?>" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">身份验证码</label>
            <div class="layui-input-block">
                <input type="text" name="id_card" lay-verify="required" placeholder="SMTP身份验证码" value="<?php echo $info['id_card']; ?>" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="button" class="layui-btn" lay-submit="" lay-filter="submit"><?php echo lang('submit'); ?></button>
                <button type="reset" class="layui-btn layui-btn-primary"><?php echo lang('reset'); ?></button>
                <button type="button" class="layui-btn layui-btn-normal" id="trySend">测试发送</button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
<script src="/static/common/layuiadmin/layui/layui.js"></script>  
<script>
    layui.use(['form', 'layer'], function () {
        var form = layui.form,layer = layui.layer,$= layui.jquery;
        //发送测试邮件
        $('#trySend').click(function(){
            loading =layer.load(1, {shade: [0.1,'#fff']});
            var email = $('#receive_content').val();
            $.post("<?php echo url('trySend'); ?>",{email:email},function(res){
                layer.close(loading);
                if(res.code > 0){
                    layer.msg(res.msg,{time:1800});
                }else{
                    layer.msg(res.msg,{time:1800});
                }
            });
        });

        //提交监听
        form.on('submit(submit)', function (data) {
            loading =layer.load(1, {shade: [0.1,'#fff']});
            $.post("<?php echo url('system/email'); ?>",data.field,function(res){
                layer.close(loading);
                if(res.code > 0){
                    layer.msg(res.msg,{icon: 1, time: 1000},function(){
                        location.href = res.url;
                    });
                }else{
                    layer.msg(res.msg,{icon: 2, time: 1000});
                }
            });
        })
    })
</script>
</body>
</html>