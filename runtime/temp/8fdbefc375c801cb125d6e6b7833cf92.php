<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:74:"/www/wwwroot/frcw1.52codes.cn/public/../app/sdkfjf/view/ucenter/index.html";i:1551088590;s:62:"/www/wwwroot/frcw1.52codes.cn/app/sdkfjf/view/common/head.html";i:1546849872;s:62:"/www/wwwroot/frcw1.52codes.cn/app/sdkfjf/view/common/foot.html";i:1544153938;}*/ ?>
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
        <legend>用户列表</legend>
    </fieldset>

    <div class="demoTable">
        <div class="layui-inline">
            <input class="layui-input" name="key" id="key" style="width:200px;" placeholder="<?php echo lang('pleaseEnter'); ?>手机号码">
        </div>
        <button class="layui-btn" id="search" data-type="reload">
            <?php echo lang('search'); ?>
        </button>
        <a href="<?php echo url('index'); ?>" class="layui-btn">显示全部</a>
        <!-- <a href="<?php echo url('add'); ?>" class="layui-btn" style="float:right;"><i class="fa fa-plus" aria-hidden="true"></i><?php echo lang('add'); ?></a> -->

        <!-- <a href="<?php echo url('index'); ?>" class="layui-btn" style="float:right;margin-right:10px"><i class="fa fa-plus" aria-hidden="true"></i>刷新</a> -->
        <div style="clear: both;"></div>
    </div>
    <table class="layui-table" id="list" lay-filter="list"></table>
</div>

<script src="/static/common/layuiadmin/layui/layui.js"></script>  

<script type="text/html" id="order">
    <input name="{{d.id}}" data-id="{{d.id}}" class="list_order layui-input" value=" {{d.sort}}" size="10" />
</script>
<script type="text/html" id="open">
    {{# if(d.open==1){ }}
    <a class="layui-btn layui-btn-sm layui-btn-warm" lay-event="open">开启</a>
    {{# }else{ }}
    <a class="layui-btn layui-btn-sm layui-btn-danger" lay-event="open">锁定</a>
    {{# } }}
</script>
<script type="text/html" id="action">
    <a href="<?php echo url('edit'); ?>?id={{d.id}}" class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">修改</a>
	<!-- <div id="ceshi" class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">修改</div> -->
    <a href="<?php echo url('mingxi'); ?>?id={{d.id}}" class="layui-btn layui-btn-info layui-btn-sm" >查看明细</a>
    <a href="<?php echo url('chongzhi'); ?>?id={{d.id}}" class="layui-btn layui-btn-warm layui-btn-sm" >充值</a>
</script>
<script>
layui.use('table', function() {
    var table = layui.table, $ = layui.jquery;
    var tableIn = table.render({
        // id: 'ad',
        elem: '#list',
        url: '<?php echo url("index"); ?>',
        method: 'post',
        page: true,
        cols: [
            [
                // { checkbox: true, fixed: true },
                // { field: 'id', title: '<?php echo lang("id"); ?>', width: 80,sort: true, fixed: true },
                { field: 'id', align: 'left', title: '编号',sort: true},
                { field: 'phone', align: 'left',width:120, title: '手机号码' },
				{ field: 'parent_phone', align: 'left',width:120, title: '上级账号' },
                { field: 'frcw', align: 'center', title: 'frcw'},
                { field: 'usdt', align: 'center', title: 'usdt'},
                { field: 'doge', align: 'center', title: 'doge' },
                { field: 'ltc', align: 'center', title: 'ltc'},
                { field: 'btc', align: 'center', title: 'btc'},
                { field: 'eth', align: 'center', title: 'eth' },
                { field: 'eos', align: 'center', title: 'eos'},
                { field: 'bchsv', align: 'center', title: 'bchsv'},
				{ field: 'level22', align: 'center', title: '用户级别'},
                { field: 'level33', align: 'center', title: '团队奖励'},
                { field: 'reg_time', title: '注册日期', align: 'center'},
                // { field: 'sort', align: 'center', title: '<?php echo lang("order"); ?>', width: 80, templet: '#order' },
                { field: 'open', align: 'center', title: '<?php echo lang("status"); ?>', toolbar: '#open' },
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
            layer.confirm('您确定要删除吗？', function(index) {
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
                layer.close(index);
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
        layer.confirm('确认要删除所有选中项吗？', { icon: 3 }, function(index) {
            layer.close(index);
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