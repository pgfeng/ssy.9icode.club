<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');

/**
 * 路由类
 * 解析网址,实例化控制器
 * 创建时间：2014-08-08 21:39 PGF
 */
class Router
{
    public static $router;
    public $routers = array();

    //======运行方法

    public static function run()
    {
        $class = Config::router('driver');
        Loader::driver('routers', $class);
        self::$router = new $class;
        self::$router->controller();
    }

    //开始实例化controller

    public static function get()
    {
        return self::$router->routers;
    }

    public static function url($action='', $get = false)
    {
        $url = self::$router->_url($action, $get);
        //====是否要隐藏入口
        if (Config::router('hidden_entry') !== true) {
            return Config::config('entry') . '/' . $url;
        } else {
            $path = dirname(Config::config('entry'));
            //转义掉windows的反斜杠
            $path = str_replace('\\', '/', $path);
            return $path.$url;
        }
    }

    //==解析正确的网址
    protected function _url($action, $get = false)
    {
    }

    //==根据路由配置实时获取正确网址

    protected function parse_url()
    {
    }

    //==解析网址

    private function controller()
    {
        Loader::core('Controller');
        self::$router->routers = $c = self::$router->parse_url();
        //var_dump(self::$router->routers);
        Loader::controller(ucfirst(strtolower($c['controller'])), $c['method'], $c['var']);
    }

    //==获取PathInfo 
    
}

//====================    END Router.class.php      ========================//