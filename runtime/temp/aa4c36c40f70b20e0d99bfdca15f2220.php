<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:78:"/www/wwwroot/frcw.52codes.cn/public/../app/sdkfjf/view/ucenter/pinfosign3.html";i:1549981444;s:61:"/www/wwwroot/frcw.52codes.cn/app/sdkfjf/view/common/head.html";i:1546849872;s:61:"/www/wwwroot/frcw.52codes.cn/app/sdkfjf/view/common/foot.html";i:1544153938;}*/ ?>
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
.layui-table-cell {
    height: inherit;
    line-height: inherit;
}
</style>

<div class="layui-fluid"><div class="layui-card">

<div class="layui-card-body">
    <fieldset class="layui-elem-field layui-field-title">
        <legend>身份认证（已通过）</legend>
    </fieldset>

    <div class="demoTable">
        <div class="layui-inline">
            <input class="layui-input" name="key" id="key" style="width:200px;" placeholder="<?php echo lang('pleaseEnter'); ?>手机号码">
        </div>
        <button class="layui-btn" id="search" data-type="reload">
            <?php echo lang('search'); ?>
        </button>
        <a href="<?php echo url('pinfosign3'); ?>" class="layui-btn">显示全部</a>
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
    <a href="javascript:void();" class="layui-btn layui-btn-danger layui-btn-sm" lay-event="pinfosign1_2">重置为驳回</a>
</script>
<script>
layui.use('table', function() {
    var table = layui.table, $ = layui.jquery;
    var tableIn = table.render({
        // id: 'ad',
        elem: '#list',
        url: '<?php echo url("pinfosign3"); ?>',
        method: 'post',
        page: true,
        cols: [
            [
			//id  username  name  idcard  img1  img2  img3  state 	time  

                // { checkbox: true, fixed: true },
                // { field: 'id', title: '<?php echo lang("id"); ?>', width: 80,sort: true, fixed: true },
                { field: 'id', align: 'left', title: '编号',sort: true},
                { field: 'username', align: 'left',width:120, title: '手机号码' },
                { field: 'name', align: 'center', title: '真实姓名'},
                { field: 'idcard', align: 'center', title: '身份证号'},
                { field: 'img1', align: 'center', title: '身份证正面照片' },
                { field: 'img2', align: 'center', title: '身份证背面照片'},
                { field: 'img3', align: 'center', title: '手持身份证照片'},
                { field: 'state', align: 'center', title: '状态' },
                { field: 'time', title: '日期', align: 'center'},
                // { field: 'sort', align: 'center', title: '<?php echo lang("order"); ?>', width: 80, templet: '#order' },
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

    table.on('tool(list)', function(obj) {
        var data = obj.data;
        if (obj.event === 'pinfosign1_2') {
            layer.confirm('您确定要驳回吗？', function(index) {
                var loading = layer.load(1, { shade: [0.1, '#fff'] });
                $.post("<?php echo url('pinfosign1_2'); ?>", { id: data.id }, function(res) {
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
        } else if (obj.event === 'pinfosign1_3') {
            layer.confirm('您确定要通过吗？', function(index) {
                var loading = layer.load(1, { shade: [0.1, '#fff'] });
                $.post("<?php echo url('pinfosign1_3'); ?>", { id: data.id }, function(res) {
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