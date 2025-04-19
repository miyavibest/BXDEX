<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"/www/wwwroot/frcw1.52codes.cn/public/../app/sdkfjf/view/infolist/index.html";i:1548326978;s:62:"/www/wwwroot/frcw1.52codes.cn/app/sdkfjf/view/common/head.html";i:1546849872;s:62:"/www/wwwroot/frcw1.52codes.cn/app/sdkfjf/view/common/foot.html";i:1544153938;}*/ ?>
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

<style>
.wqs-qrcode {
    padding: 15px;
}

.wqs-qrcode a {
    display: block;
    margin-top: 10px;
    width: 200px;
    height: 40px;
    font-size: 16px;
    /*font-weight: bold;*/
    text-align: center;
    line-height: 40px;
    border: 1px solid #C9C9C9;
    background-color: #fff;
}

.wqs-qrcode a:hover {
    opacity: .8;
    border-color: #009688;
    color: #333;
}
</style>

<div class="layui-fluid"><div class="layui-card">

<div class="layui-card-body">
    <fieldset class="layui-elem-field layui-field-title">
        <legend>转入转出</legend>
    </fieldset>

    <div class="demoTable">
        <a href="<?php echo url('index'); ?>" class="layui-btn" style="float:right;margin-right:10px"><i class="fa fa-plus" aria-hidden="true"></i>刷新</a>
        <div style="clear: both;"></div>
    </div>
    <table class="layui-table" id="list" lay-filter="list"></table>
</div>
<script src="/static/common/layuiadmin/layui/layui.js"></script>  
<script type="text/html" id="order">
    <input name="{{d.id}}" data-id="{{d.id}}" class="list_order layui-input" value=" {{d.sort}}" size="10" />
</script>
<script>
layui.use('table', function() {
    var table = layui.table, $ = layui.jquery;
    var tableIn = table.render({
        elem: '#list',
        url: '<?php echo url("infolist/index"); ?>',
        method: 'post',
        page: true,
        cols: [
            [
                { field: 'id', title: 'ID',sort: true, fixed: true },
                { field: 'phone', align: 'center', title: '用户手机号'},
                { field: 'coin', align: 'left', title: '币名'},
                { field: 'num', title: '数量',align: 'center'},
                { field: 'type', align: 'center', title: '类型'},
                { field: 'add_time', align: 'center', title: '添加时间'},
            ]
        ],
        limit: 20
    });

})
</script>