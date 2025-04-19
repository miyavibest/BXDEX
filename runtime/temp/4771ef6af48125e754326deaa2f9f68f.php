<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"/www/wwwroot/159.138.143.90/public/../app/sdkfjf/view/index/index.html";i:1550417270;s:60:"/www/wwwroot/159.138.143.90/app/sdkfjf/view/common/head.html";i:1546849872;}*/ ?>
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

<script>
  var ADMIN = '/static/admin';
  //var navs = ;
</script>

<body class="layui-layout-body">
  <div id="LAY_app">
    <div class="layui-layout layui-layout-admin">
      <div class="layui-header">
        <!-- 头部区域 -->
        <ul class="layui-nav layui-layout-left">
          <li class="layui-nav-item layadmin-flexible" lay-unselect>
            <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
              <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
            </a>
          </li>
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" target="_blank" title="前台">
              <i class="layui-icon layui-icon-website"></i>
            </a>
          </li>
          <li class="layui-nav-item" lay-unselect>
            <a href="javascript:;" layadmin-event="refresh" title="刷新">
              <i class="layui-icon layui-icon-refresh-3"></i>
            </a>
          </li>
        </ul>
        <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">
          
        <!--   <li class="layui-nav-item" lay-unselect>
            <a lay-href="app/message/index.html" layadmin-event="message" lay-text="消息中心">
              <i class="layui-icon layui-icon-notice"></i>  
              
              <span class="layui-badge-dot"></span>
            </a>
          </li> -->
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="theme">
              <i class="layui-icon layui-icon-theme"></i>
            </a>
          </li>
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="note">
              <i class="layui-icon layui-icon-note"></i>
            </a>
          </li>
          <li class="layui-nav-item" id="cache">
              <a href="javascript:;"><?php echo lang('clearCache'); ?></a>
          </li>          
          <li class="layui-nav-item" lay-unselect>
            <a href="javascript:;">
              <cite><?php echo session('username'); ?></cite>
            </a>
            <dl class="layui-nav-child">
           <!--    <dd><a lay-href="set/user/info.html">基本资料</a></dd>
              <dd><a lay-href="set/user/password.html">修改密码</a></dd> -->
              <!-- <hr> 
              <dd layadmin-event="logout" style="text-align: center;">-->
              <dd>
                <a href="<?php echo url('index/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i><?php echo lang('logout'); ?></a></dd>
            </dl>
          </li>
          
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="about">
              <!-- <i class="layui-icon layui-icon-more-vertical"></i> -->
            </a>
          </li>
          <li class="layui-nav-item layui-show-xs-inline-block layui-hide-sm" lay-unselect>
            <a href="javascript:;" layadmin-event="more"><i class="layui-icon layui-icon-more-vertical"></i></a>
          </li>
        </ul>
      </div>
      
      <!-- 侧边菜单 -->
      <div class="layui-side layui-side-menu">
        <div class="layui-side-scroll">
          <div class="layui-logo" lay-href="<?php echo url('admin/index/index'); ?>">
            <span><?php echo lang('sys_name'); ?>后台管理</span>
          </div>
          
          <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">


            <!-- <li data-name="home" class="layui-nav-item">
              <a href="javascript:;" lay-tips="后台主页" lay-direction="2">
                <i class="layui-icon layui-icon-home"></i>
                <cite>后台主页</cite>
              </a>
              <dl class="layui-nav-child">
                <dd data-name="console" class="layui-this">
                  <a lay-href="<?php echo url('main'); ?>">控制台</a>
                </dd>
              </dl>
            </li> -->


            <?php if(is_array($menus) || $menus instanceof \think\Collection || $menus instanceof \think\Paginator): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
           
            <li data-name="home" class="layui-nav-item">
                <a href="javascript:;" lay-tips=" <?php echo $vo['title']; ?>" lay-direction="2">
                  <i class="layui-icon layui-<?php echo $vo['icon']; ?>"></i>
                  <cite> <?php echo $vo['title']; ?></cite>
                </a>
                <dl class="layui-nav-child">
                    <?php if(is_array($vo['children']) || $vo['children'] instanceof \think\Collection || $vo['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$children): $mod = ($i % 2 );++$i;?>
                     <dd><a lay-href="<?php echo $children['href']; ?>"> <?php echo $children['title']; ?></a></dd>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </dl>
            </li>            

            <?php endforeach; endif; else: echo "" ;endif; ?>            
           
          </ul>
        </div>
      </div>

      <!-- 页面标签 -->
      <div class="layadmin-pagetabs" id="LAY_app_tabs">
        <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
        <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
        <div class="layui-icon layadmin-tabs-control layui-icon-down">
          <ul class="layui-nav layadmin-tabs-select" lay-filter="layadmin-pagetabs-nav">
            <li class="layui-nav-item" lay-unselect>
              <a href="javascript:;"></a>
              <dl class="layui-nav-child layui-anim-fadein">
                <dd layadmin-event="closeThisTabs"><a href="javascript:;">关闭当前标签页</a></dd>
                <dd layadmin-event="closeOtherTabs"><a href="javascript:;">关闭其它标签页</a></dd>
                <dd layadmin-event="closeAllTabs"><a href="javascript:;">关闭全部标签页</a></dd>
              </dl>
            </li>
          </ul>
        </div>
        <div class="layui-tab" lay-unauto lay-allowClose="true" lay-filter="layadmin-layout-tabs">
          <ul class="layui-tab-title" id="LAY_app_tabsheader">
            <li lay-id="<?php echo url('main'); ?>" class="layui-this">
              <i class="layui-icon layui-icon-home"></i>
            </li>
          </ul>
        </div>
      </div>
      
      
      <!-- 主体内容 -->
      <div class="layui-body" id="LAY_app_body">
        <div class="layadmin-tabsbody-item layui-show">
          <iframe src="<?php echo url('main'); ?>" frameborder="0" class="layadmin-iframe"></iframe>
        </div>
      </div>
      
      <!-- 辅助元素，一般用于移动设备下遮罩 -->
      <div class="layadmin-body-shade" layadmin-event="shade"></div>
    </div>
  </div>

  <script src="/static/common/layuiadmin/layui/layui.js"></script>
  <script>
  layui.config({
    base: '/static/common/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use('index');
  </script>


 <script>
        localStorage.skin='';
        layui.use('layer',function(){
            var $ = layui.jquery, layer = layui.layer;
            $('#cache').click(function () {
                layer.confirm('确认要清除缓存？', {icon: 3}, function (data) {

                    $.post('<?php echo url("clear"); ?>', {}, function (res) {
                      if (res.code == 1) {
                        layer.msg(res.info, {icon: 6}, function (index) {
                            layer.close(index);
                            window.location.href = res.url;
                        });
                      } else {
                        layer.msg(res.info, {icon: 7}, function (index) {
                            layer.close(index);
                            window.location.href = res.url;
                        });
                      }

                    });

                });
            });
        })
    </script>  
</body>
</html>


