<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:76:"/www/wwwroot/frcw1.52codes.cn/public/../app/sdkfjf/view/system/edit_fee.html";i:1551281840;s:62:"/www/wwwroot/frcw1.52codes.cn/app/sdkfjf/view/common/head.html";i:1546849872;s:62:"/www/wwwroot/frcw1.52codes.cn/app/sdkfjf/view/common/foot.html";i:1544153938;}*/ ?>
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
	<?php if($list['id'] !=1): ?>
	.eosmemocla{display:none;}
	<?php endif; ?>
</style>

<div class="layui-fluid"><div class="layui-card">

<div class="layui-card-body">
    <fieldset class="layui-elem-field layui-field-title">
        <legend>修改矿工费</legend>
    </fieldset>
    <form class="layui-form layui-form-pane" method="post" action="" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label class="layui-form-label">币种</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" value="<?php echo strtoupper($list['name']); ?>" class="layui-input" disabled>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">矿工费</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="fee" value="<?php echo $list['fee']; ?>" class="layui-input" lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="display:none;">
            <label class="layui-form-label">充币地址</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="address" value="<?php echo $list['address']; ?>" class="layui-input" lay-verify="required">
            </div>
        </div>


		<div class="layui-form-item">
            <label class="layui-form-label">充币地址1</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="address1" value="<?php echo $list['address1']; ?>" class="layui-input" lay-verify="required">
            </div>
			
			<label class="layui-form-label eosmemocla">Eos_Memo_1</label>
            <div class="layui-input-inline eosmemocla" style="width:400px;">
                <input type="text" name="eosmemo1" value="<?php echo $list['eosmemo1']; ?>" class="layui-input" lay-verify="">
            </div>
        </div>
		<div class="layui-form-item">
            <label class="layui-form-label">充币地址2</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="address2" value="<?php echo $list['address2']; ?>" class="layui-input" lay-verify="required">
            </div>
			
			<label class="layui-form-label eosmemocla">Eos_Memo_2</label>
            <div class="layui-input-inline eosmemocla" style="width:400px;">
                <input type="text" name="eosmemo2" value="<?php echo $list['eosmemo2']; ?>" class="layui-input" lay-verify="">
            </div>
        </div>
		<div class="layui-form-item">
            <label class="layui-form-label">充币地址3</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="address3" value="<?php echo $list['address3']; ?>" class="layui-input" lay-verify="required">
            </div>
			
			<label class="layui-form-label eosmemocla">Eos_Memo_3</label>
            <div class="layui-input-inline eosmemocla" style="width:400px;">
                <input type="text" name="eosmemo3" value="<?php echo $list['eosmemo3']; ?>" class="layui-input" lay-verify="">
            </div>
        </div>
		
		<div class="layui-form-item">
            <label class="layui-form-label">充币地址4</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="address4" value="<?php echo $list['address4']; ?>" class="layui-input" lay-verify="required">
            </div>
			
			<label class="layui-form-label eosmemocla">Eos_Memo_4</label>
            <div class="layui-input-inline eosmemocla" style="width:400px;">
                <input type="text" name="eosmemo4" value="<?php echo $list['eosmemo4']; ?>" class="layui-input" lay-verify="">
            </div>
        </div>
		<div class="layui-form-item">
            <label class="layui-form-label">充币地址5</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="address5" value="<?php echo $list['address5']; ?>" class="layui-input" lay-verify="required">
            </div>
			
			<label class="layui-form-label eosmemocla">Eos_Memo_5</label>
            <div class="layui-input-inline eosmemocla" style="width:400px;">
                <input type="text" name="eosmemo5" value="<?php echo $list['eosmemo5']; ?>" class="layui-input" lay-verify="">
            </div>
        </div>
		<div class="layui-form-item">
            <label class="layui-form-label">充币地址6</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="address6" value="<?php echo $list['address6']; ?>" class="layui-input" lay-verify="required">
            </div>
			
			<label class="layui-form-label eosmemocla">Eos_Memo_6</label>
            <div class="layui-input-inline eosmemocla" style="width:400px;">
                <input type="text" name="eosmemo6" value="<?php echo $list['eosmemo6']; ?>" class="layui-input" lay-verify="">
            </div>
        </div>
		<div class="layui-form-item">
            <label class="layui-form-label">充币地址7</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="address7" value="<?php echo $list['address7']; ?>" class="layui-input" lay-verify="required">
            </div>
			
			<label class="layui-form-label eosmemocla">Eos_Memo_7</label>
            <div class="layui-input-inline eosmemocla" style="width:400px;">
                <input type="text" name="eosmemo7" value="<?php echo $list['eosmemo7']; ?>" class="layui-input" lay-verify="">
            </div>
        </div>
		<div class="layui-form-item">
            <label class="layui-form-label">充币地址8</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="address8" value="<?php echo $list['address8']; ?>" class="layui-input" lay-verify="required">
            </div>
			
			<label class="layui-form-label eosmemocla">Eos_Memo_8</label>
            <div class="layui-input-inline eosmemocla" style="width:400px;">
                <input type="text" name="eosmemo8" value="<?php echo $list['eosmemo8']; ?>" class="layui-input" lay-verify="">
            </div>
        </div>
		<div class="layui-form-item">
            <label class="layui-form-label">充币地址9</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="address9" value="<?php echo $list['address9']; ?>" class="layui-input" lay-verify="required">
            </div>
			
			<label class="layui-form-label eosmemocla">Eos_Memo_9</label>
            <div class="layui-input-inline eosmemocla" style="width:400px;">
                <input type="text" name="eosmemo9" value="<?php echo $list['eosmemo9']; ?>" class="layui-input" lay-verify="">
            </div>
        </div>
		<div class="layui-form-item">
            <label class="layui-form-label">充币地址10</label>
            <div class="layui-input-inline" style="width:400px;">
                <input type="text" name="address10" value="<?php echo $list['address10']; ?>" class="layui-input" lay-verify="required">
            </div>
			
			<label class="layui-form-label eosmemocla">Eos_Memo_10</label>
            <div class="layui-input-inline eosmemocla" style="width:400px;">
                <input type="text" name="eosmemo10" value="<?php echo $list['eosmemo10']; ?>" class="layui-input" lay-verify="">
            </div>
        </div>
		
		
		
		
		
        <div class="layui-form-item">
            <div class="layui-input-inline" style="width:400px;">
                <input type="hidden" name="id" value="<?php echo $list['id']; ?>">
                <button type="button" class="layui-btn" lay-submit="" lay-filter="submit"><?php echo lang('submit'); ?></button>
                <a href="<?php echo url('fee'); ?>" class="layui-btn layui-btn-primary"><?php echo lang('back'); ?></a>
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
        ,type: 'datetime'
        ,format: 'yyyy-MM-dd HH:mm'

    });

    //监听提交
    form.on('submit(submit)', function(data) {
        var loading = layer.load(1, { shade: [0.1, '#fff'] });
        $.post("<?php echo url('editFee'); ?>", data.field, function(res) {
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