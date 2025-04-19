<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:76:"/www/wwwroot/frcw1.52codes.cn/public/../app/sdkfjf/view/infolist/congbi.html";i:1551248616;s:62:"/www/wwwroot/frcw1.52codes.cn/app/sdkfjf/view/common/head.html";i:1546849872;s:62:"/www/wwwroot/frcw1.52codes.cn/app/sdkfjf/view/common/foot.html";i:1544153938;}*/ ?>
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
        <legend>充币列表</legend>
    </fieldset>

    <div class="demoTable">

		<a href="<?php echo url('congbi2'); ?>" class="layui-btn" style="float:right;margin-right:10px"><i class="fa fa-plus" aria-hidden="true"></i>已驳回</a>
		
		<a href="<?php echo url('congbi1'); ?>" class="layui-btn" style="float:right;margin-right:10px"><i class="fa fa-plus" aria-hidden="true"></i>已通过</a>

		
		<a href="<?php echo url('congbi0'); ?>" class="layui-btn" style="float:right;margin-right:10px"><i class="fa fa-plus" aria-hidden="true"></i>审核中</a>

		
		<a href="<?php echo url('congbi'); ?>" class="layui-btn" style="float:right;margin-right:10px"><i class="fa fa-plus" aria-hidden="true"></i>全部</a>
        <div style="clear: both;"></div>
    </div>
    <table class="layui-table" id="list" lay-filter="list"></table>
</div>
<script src="/static/common/layuiadmin/layui/layui.js"></script>  
<script type="text/html" id="order">
    <input name="{{d.id}}" data-id="{{d.id}}" class="list_order layui-input" value=" {{d.sort}}" size="10" />
</script>
<script type="text/html" id="action">
    <a class="layui-btn layui-btn-info layui-btn-sm"  lay-event="tongguo">通过</a>
    <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="jujue">拒绝</a>
</script>
<script>
layui.use('table', function() {
    var table = layui.table, $ = layui.jquery;
    var tableIn = table.render({
        elem: '#list',
        url: '<?php echo url("infolist/$actionname"); ?>',
        method: 'post',
        page: true,
        cols: [
            [
                { field: 'id', title: 'ID',sort: true, fixed: true },
                { field: 'order_sn', align: 'center',title:'订单号'},
                { field: 'member_phone', align: 'center', title: '用户手机号'},
                { field: 'coin', align: 'left', title: '币名'},
                { field: 'number', title: '数量',align: 'center'},
                { field: 'statusnamne', align: 'center', title: '状态', },
                { field: 'updatetime', align: 'center', title: '添加时间'},
                { width: 150, align: 'center', title: '操作', toolbar: '#action'}
            ]
        ],
        limit: 20
    });


    table.on('tool(list)', function(obj) {
        var data = obj.data;
        if (obj.event === 'tongguo') {
            var loading = layer.load(1, { shade: [0.1, '#fff'] });
            $.post('<?php echo url("tongyi"); ?>', { 'id': data.id }, function(res) {
                layer.close(loading);
                if (res.code === 1) {
                    layer.msg(res.msg, { time: 1000, icon: 1 });
                    tableIn.reload();
                } else {
                    layer.msg(res.msg, { time: 1000, icon: 2 });
                    return false;
                }
            })
        } else if (obj.event === 'jujue') {
            var loading = layer.load(1, { shade: [0.1, '#fff'] });
            $.post("<?php echo url('reject'); ?>", { id: data.id }, function(res) {
                layer.close(loading);
                if (res.code === 1) {
                    layer.msg(res.msg, { time: 1000, icon: 1 });
                    tableIn.reload();
                } else {
                    layer.msg(res.msg, { time: 1000, icon: 2 });
                    return false;
                }
            });
            layer.close(index);
        } 
    });
})
</script>