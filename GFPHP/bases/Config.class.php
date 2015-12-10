<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * 存放配置
 * 可以将配置全部放入此类，方便使用
 * 创建时间：2014-08-08 13:12 PGF
 * 修改时间：2015-06-18 18:10 PGF 修改set方法，可以将设置保存到文件
 */
class Config
{
    public static $config = array();

    /**
     * @param array  $config       设置配置的内容
     * @param string $type         设置配置的文件
     * @param int    $save         是否设置时保存到文件
     */
    public static function set($config, $type = 'config', $save=0)
    {
        if($save==1)            //判断是否要保存文件
        {
            $conf= self::get($type);

            if(empty($conf))            //判断配置是否为空
            {
                $configcon="<?php\nreturn array(\n";
                $num=count($config);$i=0;
                foreach($config as $k=>$v)
                {
                    $configcon.="\n'".$k."'=>'".$v."'";
                    if(++$i<$num)
                        $configcon.=',';
                }
                $configcon.="\n);";
            }else{
                $configcon=file_get_contents(__ROOT__.parseDir(APP_PATH,Config::config('config_dir')).$type.'.php');
                foreach($config as $k=>$v) {
                    if(isset($conf[$k])) {
                        $pnt="/['\"$]". $k ."['\"$][\s]{0,}=>[\s]{0,}['\"](.*)['\"]/";
                        $configcon=preg_replace($pnt, "'" . $k . "'=>'" . $v . "'",$configcon);
                    }else{
                        $pnt="/[\s]{0,}\);/";
                        $configcon=preg_replace($pnt,",\n'" . $k . "'=>'" . $v . "'\n);",$configcon);
                    }
                }
            }
            return file_put_contents(__ROOT__.parseDir(APP_PATH,Config::config('config_dir')).$type.'.php',$configcon);
        }
        if (is_array($config))
            foreach ($config as $k => $v) {
                self::$config[$type][$k] = $v;
            }
        return true;
    }

    //自动获取配置
    public static function __callStatic($a, $v)
    {
        if (!empty($v))
            return self::get($a, $v[0]);
        return self::get($a);
    }

    //获取配置
    public static function &get($type, $name = false)
    {
        if (!isset(self::$config[$type]))
            self::$config[$type] = Loader::config($type);
        if ($name)
            return self::$config[$type][$name];
        else
            return self::$config[$type];
    }
}
//====================    END Config.class.php      ========================//