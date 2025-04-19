<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"/www/wwwroot/frcw.52codes.cn/public/../app/sdkfjf/view/suggest/edit.html";i:1548139416;s:61:"/www/wwwroot/frcw.52codes.cn/app/sdkfjf/view/common/head.html";i:1546849872;s:61:"/www/wwwroot/frcw.52codes.cn/app/sdkfjf/view/common/foot.html";i:1544153938;}*/ ?>
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
        <legend>编辑回复</legend>
    </fieldset>
    <form class="layui-form layui-form-pane" method="post" action="" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label class="layui-form-label">反馈人</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" value="<?php echo $data['phone']; ?>" class="layui-input" disabled lay-verify="required">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">发布时间</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" value="<?php echo date('Y-m-d H:i',$data['pub_time']); ?>" disabled lay-verify="required" class="layui-input" id="date1" placeholder="yyyy-MM-dd HH:mm">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label" style="height: 100px;line-height: 80px;">反馈内容</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" class="layui-textarea" disabled style="width:1024px;"><?php echo htmlspecialchars_decode($data['content']); ?></textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label" style="height: 100px;line-height: 80px;">反馈内容</label>
            <div class="layui-input-block">
                <?php if(!(empty($data['thumb']) || (($data['thumb'] instanceof \think\Collection || $data['thumb'] instanceof \think\Paginator ) && $data['thumb']->isEmpty()))): ?>
                <img class="layui-upload-img" style="width: 350px;height: 200px;margin-left:10px;" src="<?php echo $data['thumb']; ?>">
                <?php else: ?>
                <img class="layui-upload-img" style="width: 100px;height: 80px;margin-left:10px;" src="/static/common/layuiadmin/layui/images/pic.png">
                <?php endif; ?>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label" style="height: 92px;padding: 25px">反馈回复</label>
            <div class="layui-inline">
                <div class="layui-input-inline">
                <script id="editor1" type="text/plain" style="width:1024px;height:300px;" name="suggest"><?php echo htmlspecialchars_decode($data['suggest']); ?></script>
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

<script charset="utf-8" src="/static/ueditor/ueditor.config.js"></script>
<script charset="utf-8" src="/static/ueditor/ueditor.all.min.js"></script>

<script>
var ue = UE.getEditor('editor1');
layui.use(['form','laydate','upload'], function() {
    var form  = layui.form,
        $     = layui.$,
        laydate = layui.laydate,
        layer = layui.layer,
        upload = layui.upload;

    //年选择器
    laydate.render({
        elem: '#date1'
        ,type: 'datetime'
        ,format: 'yyyy-MM-dd HH:mm'

    });

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