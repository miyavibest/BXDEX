<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"/www/wwwroot/frcw1.52codes.cn/public/../app/sdkfjf/view/index/main.html";i:1544684006;s:62:"/www/wwwroot/frcw1.52codes.cn/app/sdkfjf/view/common/head.html";i:1546849872;s:62:"/www/wwwroot/frcw1.52codes.cn/app/sdkfjf/view/common/foot.html";i:1544153938;}*/ ?>
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

<div class="layui-fluid"><div class="layui-card">

<div class="layui-card-body">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>系统配置</legend>
</fieldset> 
 
<table class="layui-table" >
    <colgroup>
        <col width="100">
        <col width="240">
        <col>
    </colgroup>
<thead>
    <tr>
        <th>服务器信息</th>
        <th style="border-left-width: 0px;"></th>
    </tr> 
</thead>
<tbody>
    <tr>
        <td>服务器域名</td>
        <td><?php echo $config['http_host']; ?></td>
    </tr>
    <tr>
        <td>服务器端口号</td>
        <td><?php echo $config['server_port']; ?></td>
    </tr>
    <tr>
        <td>服务器IP地址</td>
        <td><?php echo $config['server_ip']; ?></td>
    </tr>
    <tr>
        <td>服务器运行环境</td>
        <td><?php echo $config['server_soft']; ?></td>
    </tr>
    <tr>
        <td>服务器操作系统</td>
        <td><?php echo $config['server_os']; ?></td>
    </tr>
    <tr>
        <td>服务器当前时间</td>
        <td id="server_time"><?php echo date('Y-m-d H:i:s', $config['server_time']); ?></td>
    </tr>
    <tr>
        <td>PHP版本信息</td>
        <td><?php echo $config['php_version']; ?></td>
    </tr>
    <tr>
        <td>PHP运行方式</td>
        <td><?php echo $config['php_sapi_name']; ?></td>
    </tr>
    <tr>
        <td>MySQL版本信息</td>
        <td><?php echo $config['mysql_version']; ?></td>
    </tr>
    <tr>
        <td>最大上传文件大小</td>
        <td><?php echo $config['max_upload_size']; ?></td>
    </tr>
    <tr>
        <td>服务器脚本超时时间</td>
        <td><?php echo $config['max_execution_time']; ?>s</td>
    </tr>
    <tr>
        <td>用户代理</td>
        <td><?php echo $config['http_user_agent']; ?></td>
    </tr>
    <tr>
        <td>文件所在位置</td>
        <td><?php echo $config['document_root']; ?></td>
    </tr>
</tbody>
</table>

</div>
<script src="/static/common/layuiadmin/layui/layui.js"></script>  
<script src="/static/home/jsCss/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        var server_time = parseInt('<?php echo $config['server_time']; ?>');
        function dateFormat(cellValue) {
            if(cellValue == 0){
                return ''
            }
            var date = new Date(cellValue * 1000);
            var Y = date.getFullYear();
            var M = date.getMonth() + 1;
            M = M < 10 ? '0' + M : M;
            var D = date.getDate();
            D = D < 10 ? '0' + D : D;
            var H = date.getHours();
            H = H < 10 ? '0' + H : H;
            var m = date.getMinutes();
            m = m < 10 ? '0' + m : m;
            var s = date.getSeconds();
            s = s < 10 ? '0' + s : s;
            return Y + '-' + M + '-' + D + ' ' + H + ':' + m + ':' + s;
        }
        var t = setInterval(function(){
            server_time++;
            $('#server_time').html(dateFormat(server_time));
        },1000);
    });
</script>
