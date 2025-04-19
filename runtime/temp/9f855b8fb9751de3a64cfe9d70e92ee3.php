<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"/www/wwwroot/frcw.52codes.cn/public/../app/sdkfjf/view/system/usdth.html";i:1550645594;s:61:"/www/wwwroot/frcw.52codes.cn/app/sdkfjf/view/common/head.html";i:1546849872;s:61:"/www/wwwroot/frcw.52codes.cn/app/sdkfjf/view/common/foot.html";i:1544153938;}*/ ?>
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

<style type="text/css">
    .layui-timeline-item{
        padding-bottom: 5px;
        margin-left: 20px;
    }
</style>
<div class="layui-fluid"><div class="layui-card">
<div class="layui-card-body">
    <fieldset class="layui-elem-field layui-field-title">
        <legend>USDT价格</legend>
    </fieldset>
    <ul class="layui-timeline">
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li class="layui-timeline-item">
            <i class="layui-icon layui-timeline-axis"></i>
            <div class="layui-timeline-content layui-text">
                <h5 class="layui-timeline-title">
                日期: <?php echo date('Y-m-d',$vo['pub_time']); ?>
                &nbsp;&nbsp;&nbsp;&nbsp;价格: <?php echo sprintf4($vo['price']); ?>
                </h5>
            </div>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>  

    <form class="layui-form layui-form-pane" method="post" action="" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label class="layui-form-label">价格(单位$)</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="number" name="price" class="layui-input" value="" lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">日&nbsp;&nbsp;&nbsp;&nbsp;期</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="pub_time" lay-verify="required" class="layui-input" id="date1" placeholder="yyyy-MM-dd">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-inline" style="width:400px;">
                <button type="button" class="layui-btn" lay-submit="" lay-filter="submit"><?php echo lang('submit'); ?></button>
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

    //年选择器
    laydate.render({
        elem: '#date1'
        //,type: 'datetime'
        //,format: 'yyyy-MM-dd HH:mm'
    });

    //监听提交
    form.on('submit(submit)', function(data) {
        var loading = layer.load(1, { shade: [0.1, '#fff'] });
        $.post("<?php echo url('usdt'); ?>", data.field, function(res) {
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