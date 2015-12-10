<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');

/**
 * DEBUG类
 * 存放程序运行信息
 * 方便调试项目使用
 * 创建日期 2014-08-08 15:20 PGF 一年前写的挪过来基本没动
 */
class Debug
{
    static $startTime;
    static $stopTime;
    static $msg = array();
    static $sqls = array();
    static $include = array();
    static $length;
    static $GzipLength;

    //-------添加程序执行信息--------
    static function add($msg, $type = 0)
    {
        if(!Config::config('debug'))
            return;
        switch ($type) {
            case 0:
                self::$msg[] = $msg;                            //把运行信息添加进去
                break;
            case '1':
                self::$include[] = $msg;                        //把包含文件添加进去
                break;
            case '2':
                self::$sqls[] = $msg;                            //把sql语句添加进去
        }
    }



    //-------获取开始微秒值-----------
    static function start()
    {

		if(Config::config('gzip'))
		{
            header('X-Powered-By:GFPHP');
			ob_start('ob_gzhandler');
        }

        //将获取的时间赋给成员属性$startTime
        self::$startTime = microtime(true);

    }

    //在脚本结束处调用获取脚本结束时间的微秒值

    static function stop()
    {
        self::$stopTime = microtime(true);   //将获取的时间赋给成员属性$stopTime
        if (Config::config('debug'))                                                        //显示DEBUG信息
            debug::message();
        if(Extension_Loaded('zlib')&&Config::config('gzip'))@Ob_End_Flush();
    }
    static function getRuntime(){
        return round((microtime(true) - self::$startTime), 4);  //计算后以4舍5入保留4位返回
    }
    //返回同一脚本中两次获取时间的差值

    static function message()
    {
        echo '<div style="clear:both;text-align:left;font-size:11px;#009933;width:95%;margin:10px;padding:10px;background:#ffffff;background:#e7e7e7;border-radius:10px;border:5px solid #eee;z-index:100">';
        echo '<div style="width:100%;background:#e7e7e7;">';
        echo '<b style="border-bottom:1px solid #c5c5c5;">Running info</b>';
        echo '( Time:<font color="red">' . self::spent() . ' </font>Seconds.';
        echo ' Memory:' . round((memory_get_usage() / 1024), 4) . 'kb.';
        echo ')<span onclick="this.parentNode.parentNode.style.display=\'none\'" style="cursor:pointer;position:relative;float:right;bottom:0px;width:35px;background:#aaa;border:2px solid #c5c5c5;color:white;text-align:center">关闭</span>';
        echo '<ul style="margin-top:10px;padding:0 10px 0 10px;list-style:none">';
        if (count(self::$msg) > 0) {
            echo '［System information］';
            foreach (self::$msg as $msg) {
                echo '<li>&nbsp;&nbsp;&nbsp;&nbsp;' . $msg . '</li>';
            }
        }
        if (count(self::$include) > 0) {
            echo '［Include files］';
            foreach (self::$include as $include) {
                echo '<li>&nbsp;&nbsp;&nbsp;&nbsp;' . $include . '</li>';
            }
        }
        if (count(self::$sqls) > 0) {
            echo '［Query SQL '.count(self::$sqls).'］';
            foreach (self::$sqls as $sqls) {
                echo '<li>&nbsp;&nbsp;&nbsp;&nbsp;' . $sqls . '</li>';
            }
        }
        echo '</ul>';
        echo '</div></div>';
    }

    static function spent()
    {

        return round((self::$stopTime - self::$startTime), 4);  //计算后以4舍5入保留4位返回

    }
}

//====================    END Debug.class.php      ========================//