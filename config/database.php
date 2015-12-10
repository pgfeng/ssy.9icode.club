<?php
/**
 * 数据库配置
 * 如果需要数据库则需要配置此文件
 */
return array(
    //--IP
    'host' => 'localhost',
    //-- 端口
    'port' => '3306',
    //--驱动
    'driver' => 'PdoDriver',     //参考drives/databases目录下文件
    //'driver' => 'MysqliDriver',
    //'driver' => 'mysql',
    //--DSN,使用PDO驱动时使用DSN链接
    'DSN' => 'mysql:dbname=ssy;host=127.0.0.1;port=3306;',
    //--库名
    'name' => 'ssy',
    //--用户名
    'user' => 'root',
    //--表名前缀
    'table_pre' => 'yb_',
    //--密码
    'pass' => '123456',
    //--编码
    'charset' => 'utf8',
    //--是否开启缓存
    'cache' => 0,
    //缓存存放位置
    'cache_dir' => 'database'
);
