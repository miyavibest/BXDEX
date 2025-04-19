<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:77:"/www/wwwroot/frcw1.52codes.cn/public/../app/sdkfjf/view/auth/admin_group.html";i:1548059130;s:62:"/www/wwwroot/frcw1.52codes.cn/app/sdkfjf/view/common/head.html";i:1546849872;s:62:"/www/wwwroot/frcw1.52codes.cn/app/sdkfjf/view/common/foot.html";i:1544153938;}*/ ?>
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

<div class="layui-fluid"><div class="layui-card"><div class="layui-card-body">
    <fieldset class="layui-elem-field layui-field-title">
        <legend>角色<?php echo lang('list'); ?></legend>
    </fieldset>
    <blockquote class="layui-elem-quote">
        <a href="<?php echo url('groupAdd'); ?>" class="layui-btn layui-btn-small"><?php echo lang('add'); ?><?php echo lang('userGroup'); ?></a>
    </blockquote>
    <table class="layui-table" id="list" lay-filter="list"></table>
</div>
</div>
</div>
<script src="/static/common/layuiadmin/layui/layui.js"></script>  

<script type="text/html" id="action">
    {{# if(d.group_id==1){ }}
    <a href="javascript:;" class="layui-btn layui-btn-sm layui-btn-normal  layui-btn-disabled">配置规则</a>
    {{# }else{  }}
    <a href="<?php echo url('groupAccess'); ?>?id={{d.group_id}}" class="layui-btn layui-btn-sm layui-btn-normal">配置规则</a>
    {{# } }}

    <a href="<?php echo url('groupEdit'); ?>?id={{d.group_id}}" class="layui-btn layui-btn-warm layui-btn-sm"><?php echo lang('edit'); ?></a>

    {{# if(d.group_id==1){ }}
    <a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-sm layui-btn-disabled"><?php echo lang('del'); ?></a>
    {{# }else{  }}
    <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del"><?php echo lang('del'); ?></a>
    {{# } }}
    
</script>
<script>
    layui.use('table', function() {
        var table = layui.table,$ = layui.jquery;
        table.render({
            elem: '#list'
            ,url: '<?php echo url("adminGroup"); ?>',
            method:'post',
            cols: [[
                {field:'group_id', title: '<?php echo lang("id"); ?>', width:80,fixed: true,sort: true},
                {field:'title', title: '<?php echo lang("userGroup"); ?>名', width:180},
                {field:'addtime', title: '添加时间', width:200,sort: true},
                {width:260, align:'center',toolbar:'#action'}
            ]]
        });
        table.on('tool(list)', function(obj){
            var data = obj.data;
            if(obj.event === 'del'){
                layer.confirm('你确定要删除该分组吗？', function(index){
                    loading =layer.load(1, {shade: [0.1,'#fff']});
                    $.post("<?php echo url('groupDel'); ?>",{id:data.group_id},function(res){
                        layer.close(loading);
                        layer.close(index);
                        if(res.code==1){
                            layer.msg(res.msg,{time:1000,icon:1});
                            obj.del();
                        }else{
                            layer.msg(res.msg,{time:1000,icon:2});
                        }
                    });
                });
            }
        });
    });
</script>
</body>
</html>