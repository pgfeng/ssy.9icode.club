<?php
/**
 * 入口文件
 * 在项目入口引用此文件,框架会自动初始化程序
 * 创建时间： 2014-08-08 13:17 PGF 初始化基本内容
 */

//==设置系统输出编码为UTF-8
header("Content-Type:text/html;charset=utf-8");

if (!defined('APP_PATH')) exit('APP_PATH项目路径未配置！');

//==默认网站主目录

if (!defined('__ROOT__')) {
    if ($_SERVER['DOCUMENT_ROOT'][strlen($_SERVER['DOCUMENT_ROOT']) - 1] != '/')
        $_SERVER['DOCUMENT_ROOT'] .= '/';
    define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
}
//==引入配置文件

$config = __ROOT__ . APP_PATH . '/config.php';

if (!file_exists($config))   //判断是否有配置文件
{
    echo '配置文件' . $config . ' 不存在';
} else {
    $config = include($config);

    require(__ROOT__ . $config['core_dir'] . '/bases/Config.class.php');

    Config::set($config, 'config');
    //==设置时区

    date_default_timezone_set(Config::config('default_timezone'));

    require(__ROOT__ . $config['core_dir'] . '/bases/Loader.class.php');

    include(__ROOT__ . $config['core_dir'] . '/bases/Initialize.php');

}
