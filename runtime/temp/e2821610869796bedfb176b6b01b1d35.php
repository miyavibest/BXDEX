<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:73:"/www/wwwroot/frcw1.52codes.cn/public/../app/sdkfjf/view/config/index.html";i:1551880646;s:62:"/www/wwwroot/frcw1.52codes.cn/app/sdkfjf/view/common/head.html";i:1546849872;s:62:"/www/wwwroot/frcw1.52codes.cn/app/sdkfjf/view/common/foot.html";i:1544153938;}*/ ?>
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
        <legend>系统配置</legend>
    </fieldset>
	<div class="demoTable">
        <a href="<?php echo url('add'); ?>" class="layui-btn" style="float:right;"><i class="fa fa-plus" aria-hidden="true"></i><?php echo lang('add'); ?></a>

        <a href="<?php echo url('index'); ?>" class="layui-btn" style="float:right;margin-right:10px"><i class="fa fa-plus" aria-hidden="true"></i>刷新</a>
        <div style="clear: both;"></div>
    </div>
	
	
	
	<form class="layui-form layui-form-pane" method="post" action="" enctype="multipart/form-data">
	
		<fieldset class="layui-elem-field layui-field-title" style="max-width: 300px;font-size: 16px;display:;">
			<legend style="font-size: 16px;">其他</legend>
		</fieldset>
		<div class="layui-form-item">
            <label class="layui-form-label" style="min-width: 300px;">转币审核开关（1：需审核、2：不需审核）</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="set21" class="layui-input" value="<?php echo $cset21; ?>" lay-verify="required" style="width: 77%;">
            </div>
        </div>
		
		
		
        <div class="layui-form-item" style="display:none;">
            <label class="layui-form-label" style="min-width: 200px;">*%</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="set18" class="layui-input" value="<?php echo $cset18; ?>" lay-verify="required" style="width: 77%;">
            </div>
        </div>
	
		<fieldset class="layui-elem-field layui-field-title" style="max-width: 300px;font-size: 16px;">
			<legend style="font-size: 16px;">签到奖励</legend>
		</fieldset>
        <div class="layui-form-item">
            <label class="layui-form-label" style="min-width: 200px;">签到奖励总量（28天）</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="set1" class="layui-input" value="<?php echo $cset1; ?>" lay-verify="required" style="width: 77%;">
            </div>
        </div>

		<div class="layui-form-item">
            <label class="layui-form-label" style="min-width: 200px;">下级签到送币数量</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="set4" class="layui-input" value="<?php echo $cset4; ?>" lay-verify="required" style="width: 77%;">
            </div>
        </div>
		<fieldset class="layui-elem-field layui-field-title" style="max-width: 300px;font-size: 16px;">
			<legend style="font-size: 16px;">返利制度</legend>
		</fieldset>
		<div class="layui-form-item">
            <label class="layui-form-label" style="min-width: 200px;">vip1返利比例*%</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="set5" class="layui-input" value="<?php echo $cset5; ?>" lay-verify="required" style="width: 77%;">
            </div>
        </div>
		<div class="layui-form-item">
            <label class="layui-form-label" style="min-width: 200px;">vip2返利比例*%</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="set6" class="layui-input" value="<?php echo $cset6; ?>" lay-verify="required" style="width: 77%;">
            </div>
        </div>
		<div class="layui-form-item">
            <label class="layui-form-label" style="min-width: 200px;">vip3返利比例*%</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="set7" class="layui-input" value="<?php echo $cset7; ?>" lay-verify="required" style="width: 77%;">
            </div>
        </div>
		
		
		
		
		
		
		
		
		<fieldset class="layui-elem-field layui-field-title" style="max-width: 300px;font-size: 16px;">
			<legend style="font-size: 16px;">下线提成</legend>
		</fieldset>
		<div class="layui-form-item">
            <label class="layui-form-label" style="min-width: 200px;">1代</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="set11" class="layui-input" value="<?php echo $cset11; ?>" lay-verify="required" style="width: 77%;">
            </div>
        </div>
		<div class="layui-form-item">
            <label class="layui-form-label" style="min-width: 200px;">2代-10代</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="set12" class="layui-input" value="<?php echo $cset12; ?>" lay-verify="required" style="width: 77%;">
            </div>
        </div>
		<div class="layui-form-item">
            <label class="layui-form-label" style="min-width: 200px;">10-20代</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="set13" class="layui-input" value="<?php echo $cset13; ?>" lay-verify="required" style="width: 77%;">
            </div>
        </div>
		
		
		
		
		
		<fieldset class="layui-elem-field layui-field-title" style="max-width: 300px;font-size: 16px;">
			<legend style="font-size: 16px;">团队奖励</legend>
		</fieldset>
		<div class="layui-form-item">
            <label class="layui-form-label" style="min-width: 200px;">初级奖励</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="set14" class="layui-input" value="<?php echo $cset14; ?>" lay-verify="required" style="width: 77%;">
            </div>
        </div>
		<div class="layui-form-item">
            <label class="layui-form-label" style="min-width: 200px;">中级奖励</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="set15" class="layui-input" value="<?php echo $cset15; ?>" lay-verify="required" style="width: 77%;">
            </div>
        </div>
		<div class="layui-form-item">
            <label class="layui-form-label" style="min-width: 200px;">高级奖励</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="set16" class="layui-input" value="<?php echo $cset16; ?>" lay-verify="required" style="width: 77%;">
            </div>
        </div>
		<div class="layui-form-item">
            <label class="layui-form-label" style="min-width: 200px;">超级奖励</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="set17" class="layui-input" value="<?php echo $cset17; ?>" lay-verify="required" style="width: 77%;">
            </div>
        </div>
		
		
		
        <div class="layui-form-item">
            <div class="layui-input-inline" style="width:400px;">
                <button type="button" class="layui-btn" lay-submit="" lay-filter="submit"><?php echo lang('submit'); ?></button>
            </div>
        </div>
    </form>
	
	
	
	
	
	
	
	
	
	
	
    
    <table class="layui-table" id="list" lay-filter="list"></table>
</div>
<script src="/static/common/layuiadmin/layui/layui.js"></script>  
<script type="text/html" id="order">
    <input name="{{d.id}}" data-id="{{d.id}}" class="list_order layui-input" value=" {{d.sort}}" size="10" />
</script>
<script type="text/html" id="action">
    <a href="<?php echo url('edit'); ?>?id={{d.id}}" class="layui-btn layui-btn-sm">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
</script>
<script>
layui.use('table', function() {
    var table = layui.table, $ = layui.jquery;
    var tableIn = table.render({
        elem: '#list',
        url: '<?php echo url("config/index"); ?>',
        method: 'post',
        page: true,
        cols: [
            [
                { field: 'id', title: 'ID',sort: true, fixed: true },
                { field: 'title', align: 'left', title: '标题'},
                { field: 'value', title: '值',align: 'center'},
                { field: 'update_time', align: 'center', title: '更新时间'},
                { align: 'center', title: '操作', toolbar: '#action'}
            ]
        ],
        limit: 20
    });

     table.on('tool(list)', function(obj) {
        var data = obj.data;
        console.log(data);
        if (obj.event === 'del') {
            layer.confirm('您确定要删除吗？', function(index) {
                var loading = layer.load(1, { shade: [0.1, '#fff'] });
                $.post("<?php echo url('del'); ?>", { id: data.id }, function(res) {
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
        $.post("<?php echo url('cset1'); ?>", data.field, function(res) {
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