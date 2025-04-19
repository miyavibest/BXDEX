<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:73:"/www/wwwroot/159.138.143.90/public/../app/sdkfjf/view/ucenter/index2.html";i:1550928626;s:60:"/www/wwwroot/159.138.143.90/app/sdkfjf/view/common/head.html";i:1546849872;s:60:"/www/wwwroot/159.138.143.90/app/sdkfjf/view/common/foot.html";i:1544153938;}*/ ?>
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
        <legend>用户附加管理列表</legend>
    </fieldset>

    <div class="demoTable">
        <div class="layui-inline">
            <input class="layui-input" name="key" id="key" style="width:200px;" placeholder="<?php echo lang('pleaseEnter'); ?>手机号码">
        </div>
        <button class="layui-btn" id="search" data-type="reload">
            <?php echo lang('search'); ?>
        </button>
        <a href="<?php echo url('index2'); ?>" class="layui-btn">显示全部</a>
        <!-- <a href="<?php echo url('add'); ?>" class="layui-btn" style="float:right;"><i class="fa fa-plus" aria-hidden="true"></i><?php echo lang('add'); ?></a> -->

        <!-- <a href="<?php echo url('index2'); ?>" class="layui-btn" style="float:right;margin-right:10px"><i class="fa fa-plus" aria-hidden="true"></i>刷新</a> -->
        <div style="clear: both;"></div>
    </div>
    <table class="layui-table" id="list" lay-filter="list"></table>
</div>

<script src="/static/common/layuiadmin/layui/layui.js"></script>  


<script type="text/html" id="action">
    <a href="<?php echo url('myteam'); ?>?id={{d.id}}" class="layui-btn layui-btn-info layui-btn-sm" >推荐网络图</a>
    <!-- <a href="<?php echo url('recordp'); ?>?phone={{d.phone}}" class="layui-btn layui-btn-info layui-btn-sm" >交易记录</a> -->
</script>
<script>
layui.use('table', function() {
    var table = layui.table, $ = layui.jquery;
    var tableIn = table.render({
        // id: 'ad',
        elem: '#list',
        url: '<?php echo url("index2"); ?>',
        method: 'post',
        page: true,
        cols: [
            [
                // { checkbox: true, fixed: true },
                // { field: 'id', title: '<?php echo lang("id"); ?>', width: 80,sort: true, fixed: true },
                { field: 'id', align: 'left',width:90, title: '编号',sort: true},
                { field: 'phone', align: 'left',width:120, title: '手机号码' },
				{ field: 'parent_phone', align: 'left',width:120, title: '上级账号' },
                { field: 'user_opencoincv', align: 'left', title: '开启量化的币种和数量'},

                { width: 200, align: 'center', title: '操作', toolbar: '#action'}
            ]
        ],
        limit: 20
    });
    //搜索
    $('#search').on('click', function() {
        var key = $('#key').val();
        if ($.trim(key) === '') {
            layer.msg('<?php echo lang("pleaseEnter"); ?>关键字！', { icon: 0 });
            return;
        }
        tableIn.reload({
            where: { key: key }
        });
    });
	
	<!-- $('#ceshi').on('click', function() { -->
	   <!-- tableIn.reload(); -->
	<!-- }); -->

    table.on('tool(list)', function(obj) {
        var data = obj.data;
        if (obj.event === 'open') {
            var loading = layer.load(1, { shade: [0.1, '#fff'] });
            $.post('<?php echo url("status"); ?>', { 'id': data.id }, function(res) {
                layer.close(loading);
                if (res.status === 1) {
                    tableIn.reload();
                } else {
                    layer.msg('操作失败！', { time: 1000, icon: 2 });
                    return false;
                }
            })
        } else if (obj.event === 'del') {
            layer.confirm('您确定要删除吗？', function(index2) {
                var loading = layer.load(1, { shade: [0.1, '#fff'] });
                $.post("<?php echo url('edit'); ?>", { id: data.id }, function(res) {
                    layer.close(loading);
                    if (res.code === 1) {
                        layer.msg(res.msg, { time: 1000, icon: 1 });
                        tableIn.reload();
                    } else {
                        layer.msg(res.msg, { time: 1000, icon: 2 });
                    }
                });
                layer.close(index2);
            });
        } 
    });
    $('body').on('blur', '.list_order', function() {
        var id   = $(this).attr('data-id');
        var sort = $(this).val();
        var loading = layer.load(1, { shade: [0.1, '#fff'] });
        $.post('<?php echo url("deptOrder"); ?>', { id: id, sort: sort }, function(res) {
            layer.close(loading);
            if (res.code === 1) {
                layer.msg(res.msg, { time: 1000, icon: 1 });
                tableIn.reload();
            } else {
                layer.msg(res.msg, { time: 1000, icon: 2 });
            }
        })
    });

    $('#delAll').click(function() {
        layer.confirm('确认要删除所有选中项吗？', { icon: 3 }, function(index2) {
            layer.close(index2);
            var checkStatus = table.checkStatus('ad'); //test即为参数id设定的值
            var ids = [];
            $(checkStatus.data).each(function(i, o) {
                ids.push(o.id);
            });
            var loading = layer.load(1, { shade: [0.1, '#fff'] });
            $.post("<?php echo url('delAll'); ?>", { ids: ids }, function(data) {
                layer.close(loading);
                if (data.code === 1) {
                    layer.msg(data.msg, { time: 1000, icon: 1 });
                    tableIn.reload();
                } else {
                    layer.msg(data.msg, { time: 1000, icon: 2 });
                }
            });
        });
    });
})
</script>