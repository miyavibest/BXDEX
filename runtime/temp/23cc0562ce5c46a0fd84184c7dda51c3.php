<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"/www/wwwroot/frcw.52codes.cn/public/../app/sdkfjf/view/config/edit.html";i:1548297922;s:61:"/www/wwwroot/frcw.52codes.cn/app/sdkfjf/view/common/head.html";i:1546849872;s:61:"/www/wwwroot/frcw.52codes.cn/app/sdkfjf/view/common/foot.html";i:1544153938;}*/ ?>
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

<div class="layui-fluid"><div class="layui-card">
<div class="layui-card-body">
    <fieldset class="layui-elem-field layui-field-title">
        <legend>消息编辑</legend>
    </fieldset>
    <form class="layui-form layui-form-pane" method="post" action="" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label class="layui-form-label">配置名称</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="name" value="<?php echo $data['name']; ?>" class="layui-input" lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">配置标题</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="title" value="<?php echo $data['title']; ?>" class="layui-input" lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">配置值</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="value" value="<?php echo $data['value']; ?>" class="layui-input" lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否启用</label>
            <div class="layui-inline">
                <div class="layui-input-inline">
                    <input type="radio" name="status" value="1" title="是" <?php if($data['status'] == '1'): ?>checked<?php endif; ?>>
                    <input type="radio" name="status" value="0" title="否" <?php if($data['status'] == '0'): ?>checked<?php endif; ?>>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-inline" style="width:400px;">
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                <button type="button" class="layui-btn" lay-submit="" lay-filter="submit"><?php echo lang('submit'); ?></button>
                <a href="<?php echo url('index'); ?>" class="layui-btn layui-btn-primary"><?php echo lang('back'); ?></a>
            </div>
        </div>
    </form>
</div>
<script src="/static/common/layuiadmin/layui/layui.js"></script>  
<script>
layui.use(['form','laydate','upload'], function() {
    var form  = layui.form,
        $     = layui.$,
        laydate = layui.laydate,
        layer = layui.layer,
        upload = layui.upload;

    //监听提交
    form.on('submit(submit)', function(data) {
        var loading = layer.load(1, { shade: [0.1, '#fff'] });
        $.post("<?php echo url('edit'); ?>", data.field, function(res) {
            layer.close(loading);
            if (res.code > 0) {
                layer.msg(res.msg, { time: 1800, icon: 1 }, function() {
                    location.href = res.url;
                });
            } else {
                layer.msg(res.msg, { time: 1800, icon: 2 });
            }
        });
    });



});
</script>
</body>
</html>