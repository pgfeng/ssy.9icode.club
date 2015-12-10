<?php
/**
 * Router 配置文件
 * 如果服务器不支持pathinfo在此设置
 * 创建时间：2014-08-08 21:55
 */

return array(
    //-----默认网址解析类,参见drivers下的router
    'driver' => 'PathInfo',
    'driver' => 'fakeHtml',
    //'class'              => 'GET',
    //-----默认控制器
    'default_controller' => 'Index',
    //-----默认行为
    'default_method' => 'index',
    //-----默认404
    'default_404' => '',
    //-----是否开启过滤
    //-----是否开启隐藏入口
    'hidden_entry' => true,
);