<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:76:"/www/wwwroot/159.138.143.90/public/../app/sdkfjf/view/information/lunbo.html";i:1551964588;s:60:"/www/wwwroot/159.138.143.90/app/sdkfjf/view/common/head.html";i:1546849872;s:60:"/www/wwwroot/159.138.143.90/app/sdkfjf/view/common/foot.html";i:1544153938;}*/ ?>
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
        <legend>轮播图列表</legend>
    </fieldset>

    <div class="demoTable">
        <!-- <div class="layui-inline">
            <input class="layui-input" name="key" id="key" placeholder="<?php echo lang('pleaseEnter'); ?>关键字">
        </div>
        <button class="layui-btn" id="search" data-type="reload">
            <?php echo lang('search'); ?>
        </button>
        <a href="<?php echo url('index'); ?>" class="layui-btn">显示全部</a> -->


        <!-- <button type="button" class="layui-btn layui-btn-danger" id="delAll">批量删除</button> -->

        <a href="<?php echo url('lunbo_add'); ?>" class="layui-btn" style="float:right;"><i class="fa fa-plus" aria-hidden="true"></i><?php echo lang('add'); ?></a>

        <a href="<?php echo url('lunbo'); ?>" class="layui-btn" style="float:right;margin-right:10px"><i class="fa fa-plus" aria-hidden="true"></i>刷新</a>
        <div style="clear: both;"></div>
    </div>
    <table class="layui-table" id="list" lay-filter="list"></table>
</div>
<script src="/static/common/layuiadmin/layui/layui.js"></script>  


<script type="text/html" id="order">
        <a target=_blank href="{{d.img}}"><img src="{{d.img}}" ></a>
    <!-- <input name="{{d.id}}" data-id="{{d.id}}" class="list_order layui-input" value=" {{d.sort}}" size="10" /> -->
</script>

<script type="text/html" id="y">
    {{# if(d.type==1){ }}
    中文
    {{# }else{ }}
    英文
    {{# } }}
</script>

<script type="text/html" id="action">

    <a href="<?php echo url('lunbo_edit'); ?>?id={{d.id}}" class="layui-btn layui-btn-sm">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
	
</script>
<script>
layui.use('table', function() {
    var table = layui.table, $ = layui.jquery;
    var tableIn = table.render({
        // id: 'ad',
        elem: '#list',
        url: '<?php echo url("lunbo"); ?>',
        method: 'post',
        page: true,
        cols: [
            [
                // { checkbox: true, fixed: true },
                { field: 'id', title: '<?php echo lang("id"); ?>', width: 80,sort: true, fixed: true },
                { field: 'url', align: 'left', title: '超链接', width: 400 },
                { field: 'img', align: 'center', title: '图片', width: 300 ,height:300,templet:'#order' },
				  { field: 'type', align: 'center', title: '所属语言', width: 300,templet:'#y' },
                { field: 'timea', title: '日期', width: 180, align: 'center'},
                // { field: 'sort', align: 'center', title: '<?php echo lang("order"); ?>', width: 80, templet: '#order' },
                // { field: 'open', align: 'center', title: '<?php echo lang("status"); ?>', width: 80, toolbar: '#open' },
                { width: 150, align: 'center', title: '操作', width: 300 ,toolbar: '#action'}
            ]
        ],
        limit: 20
    });


    table.on('tool(list)', function(obj) {
        var data = obj.data;
        if (obj.event === 'open') {
            var loading = layer.load(1, { shade: [0.1, '#fff'] });
            $.post('<?php echo url("lunbo_status"); ?>', { 'id': data.id }, function(res) {
                layer.close(loading);
                if (res.status === 1) {
                    tableIn.reload();
                } else {
                    layer.msg('操作失败！', { time: 1000, icon: 2 });
                    return false;
                }
            })
        } else if (obj.event === 'del') {
            layer.confirm('您确定要删除吗？', function(index) {
                var loading = layer.load(1, { shade: [0.1, '#fff'] });
                $.post("<?php echo url('lunbo_del'); ?>", { id: data.id }, function(res) {
                    layer.close(loading);
                    if (res.code === 1) {
                        layer.msg(res.msg, { time: 1000, icon: 1 });
                        tableIn.reload();
                    } else {
                        layer.msg(res.msg, { time: 1000, icon: 2 });
                    }
                });
                layer.close(index);
            });
        } 
    });
  

})
</script>