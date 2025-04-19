<?php
header("Content-Type: text/html;charset=utf-8");
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

// 定义应用目录
define('APP_PATH', __DIR__ . '/../app/');
define('DATA_PATH',  __DIR__.'/runtime/Data/');
define('PLUGIN_PATH', __DIR__ . '/plugins/');

// define('UPLOAD_PATH', './Uploads/');
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
