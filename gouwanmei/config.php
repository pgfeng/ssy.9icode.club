<?php
/**
 * 项目基本配置
 * 创建项目需要首先配置此文件
 * 所有文件夹配置需要以'/'开头
 */
return array(

    //--框架位置，相对于根目录
    'core_dir' => 'GFPHP',

    //--项目所在文件夹，相对于根目录
    'app_dir' => 'gouwanmei',

    //--项目入口文件位置，相对于根目录
    'entry' => $_SERVER['SCRIPT_NAME'],
    
    //--视图(模板)所在文件夹，相对于项目所在目录
    'view_dir' => 'view',

    //--控制器所在文件夹，相对于项目所在目录
    'controller_dir' => 'controller',

    //--数据模型所在文件夹，相对于项目所在目录
    'model_dir' => 'model',

    //--模块所在文件夹，相对于项目所在目录

    'module_dir' => 'module',

    //--是否开启DEBUG,默认开启
    'debug' => false,

    //--配置所在文件夹，相对于项目所在目录
    'config_dir' => '../config',

    //--项目是否打开缓存,默认开启
    'cache' => true,

    //--时区设置
    'default_timezone' => 'PRC',

    //--页面缓存开关
    'gzip' => 0
);
