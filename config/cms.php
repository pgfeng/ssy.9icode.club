<?php

/**
 * CMS 另加的配置，后台不使用，只负责修改，供前台使用
 * PGF      15-08-25 14:23
 * 定义为$var,视图中可以使用
 * 在视图中需要的变量在这里添加
 */

return array(

    'cms_path'=> __ROOT__.'gouwanmei/',
    //模板静态缓存生存时间，如果为0则放弃缓存,不影响开发！,如果动源码请把这个调为0
    'cms_app_name' => 'gouwanmei',
    'view_cache_time'=>'-1',
    'view_cache'=>'1', //为0时是关闭，为1时是开启
    'view_dir' => 'view',

    //--模板名称
    'default_view_name' => 'default',

    //--模板名称
    'view_name'=>'default',
    //--模板标签配置
    'tpl_leftDelim' => '\{',

    'tpl_rightDelim' => '\}',

    'html_cache_time'     => 3600*24,

    //--CSS存放位置
    'css_path' => '/'.parseDir(Config::config('app_dir'),'/public/css/'),

    //--js存放位置
    'js_path' => '/'.parseDir(Config::config('app_dir'),'/public/js/'),

    //--img存放位置
    'img_path' => '/'.parseDir(Config::config('app_dir'),'/public/img/'),
    //--上传路径,相对于跟目录，前面不加‘/’
    'upload_path'=> 'upload/',
    //-- 带网址的上传路径，相对于网站根目录
    'upload_url'=> '/upload/',
    //-- 页面压缩开关 调试时最好打开，不然影响报错信息
    'debug'     => false,
);