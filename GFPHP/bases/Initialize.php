<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');

/**
 * init 入口引入文件
 * 项目自动初始化文件
 * 创建时间：2014-08-08 14:56 PGF
 * 修改时间：2015-07-17 10:45 PGF    添加SESSION操作
 */

//======================  START Initialize  ======================//

Loader::core('Debug');                              //加载DEBUG类


Debug::start();                                     //程序开始


//--向日志中添加已经加载的Loader

Debug::add(__ROOT__ . Config::config('core_dir') . '/bases/' . 'Loader.class.php', 1);


Loader::func('Base');                               //加载基础全局函数


Loader::core('Cache');                              //加载缓存处理类


Cache::init();                                      //初始化缓存类


$SESSION = Config::session('driver');               //获取SESSION驱动


Loader::driver('sessions', $SESSION);               //加载SESSION驱动


NEW $SESSION;                                       //实例SESSION


Loader::core('Router');                             //加载Router


Router::run();                                      //Router运行


Debug::stop();                                      //程序结束


//====================    END Initialize.php      ========================//