<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');

/**
 * 加载类 核心
 * 加载项目对象和框架文件
 * 用最少的代码做最不可能的事    @PGF
 * 创建时间: 2014-08-08 11:47  PGF  添加各个地方加载类和文件的方法
 * 修改时间：2014-08-10 18:29  PGF  修改了Model方法，返回加上clone
 * 修改时间：2015-02-28 18:32  PGF  发现了func每次调用都会重新引入，修改了错误
 */
class Loader
{

    /**
     * 存放实例之后的Loader对象
     */
    public static $load = false;
    private $core = array();
    private $model = array();
    private $module = array();
    private $database = false;
    private $template = false;
    private $controller = array();
    private $plugin = array();
    private $config = array();
    private $drive = array();
    private $function = array();
    private $var = array();

    /**
     * 加载框架核心类
     * @return empty
     */
    public static function core($name)
    {
        $load = self::init();
        if (isset($load->core[$name]))
            return;
        if ($file = $load->getPath($name, 'core')) {
            if ($load->load($file))
                $load->core[$name] = true;
        }
        return;
    }

    /**
     * 初始化Loader
     * @return Object
     */
    public static function init()
    {
        if (!is_object(self::$load)) {
            self::$load = new Loader;
        }
        return self::$load;
    }

    /**
     * 加载控制器
     * @return Boolean
     */
    public static function controller($controller, $method, $var = false)
    {
        $load = self::init();
        $controllerName=$controller;
        $controller .= 'Controller';
        $file = $load->getPath($controller, 'controller');
        if (isset($load->controller[$controller]) && is_object($load->controller[$controller])) {
            call_user_func_array(array($load->controller[$controller], $method), is_array($var) ? $var : array());
            return true;
        }
        if ($load->load($file)) {

            if (class_exists($controller)) {
                $control = new $controller;
                $load->controller[$controller] = $control;
                if(method_exists($control, $method))
                    call_user_func_array(array($control, $method), is_array($var) ? $var : array());
                else{
                    Debug::add('Loader:Method ' . $method . ' not found,Will be directly introduced the template file!');
                    self::view($controllerName.'/'.$method);
                    return false;
                }
                return true;
            }
        }else{
            Debug::add('Loader:Controller ' . $file . ' not found,Will be directly introduced the template file!');

            self::view($controllerName.'/'.$method);
            return false;
        }
        return false;
    }

    /**
     * 加载数据模型
     * @return Object
     */
    public static function model($model = null)
    {
        $load = self::init();
        $table = $model;
        $load->core('Model');
        if ($model != null) {
            $model .= 'Model';
            //--如果load过此modal，直接返回
            if (isset($load->model[$model]) && is_object($load->model[$model]))
                return $load->model[$model];
            $file = $load->getPath($model, 'model');
            $load->load($file);
            if (class_exists($model))    //--判断modal是否存在
                return $load->model[$model] = new $model;
            else {                       //--不存在，运行modal基类
                Debug::add('Loader:Model ' . $model . ' not found,Running model base.');
                $load->model[$model] = new Model($model);
                return $load->model[$model];
            }
            return false;
        } else {
            return new Model();
        }
    }

    public static function module($module)
    {
        $load = self::init();
        $module .= 'Module';
        if ($module != null) {
            if (isset($load->module[$module]) && is_object($load->module[$module])) {
                return $load->module[$module];
            }
            $file = $load->getPath($module, 'module');
            $load->load($file);
            if (class_exists($module)) {
                return $load->module[$module] = new $module;
            } else {
                echo $module;
                Debug::add('Loader:Module ' . $module . ' not found.');
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 加载配置文件
     * @return Array
     */
    public static function config($config)
    {
        $load = self::init();
        if (isset($load->config[$config]))
            return $load->$config[$config];
        $file = $load->getPath($config, 'config');
        return $load->config[$config] = $load->load($file);

    }

    /**
     * 加载插件类
     * @return Object
     */
    public static function plugin($className, $config = false)
    {
        $load = self::init();
        if (isset($load->plugin[$className])) {
            return new $className($config);
        } else {
            $file = $load->getPath($className, 'plugin');
            if ($load->load($file)) {
                if (class_exists($className)) {
                    return $load->plugin[$className] = new $className($config);
                } else
                    Debug::add('Loader:' . $className . ' not found.');
                return false;
            }
        }
    }

    /**
     * 加载全局函数
     * @return Boolean
     */
    public static function func($function)
    {
        $load = self::init();
        if (isset($load->function[$function]))
            return true;
        $file = $load->getPath($function, 'function');
        if ($load->load($file)) {
            $load->function[$function] = true;
            return true;
        } else {
            return false;
        }
    }

    /**
     * 加载框架驱动
     * @return Object
     */
    public static function driver($type, $drive)
    {

        $load = self::init();
        if (!isset($load->drive[$type . $drive])) {
            $path = __ROOT__ . Config::config('core_dir') . '/drivers' . Config::config('drive_dir') . '/' . $type . '/' . $drive . '.class.php';
            if (file_exists($path)) {
                require($path);
                Debug::add($path, 1);
                return $load->drive[$type . $drive] = true;
            }
            Debug::add('Loader:Driver ' . $path . ' not found.');

            return false;

        }

        return true;
    }

    /**
     * 加载视图
     * @return Boolean
     */
    public static function view($view, $data = false, $cacheTime = 0, $cacheKey = '')
    {
        $load = self::init();
        //-------向视图中添加变量
        $load->core('template');
        if (!$load->template) {
            $template = new template;
            $vars = Config::view_vars();
            $template->assign($vars);   //添加配置中的模板变量
            $load->template = $template;
        } else {
            $template = $load->template;
        }
        $template->assign($data);
        $template->display($view, $cacheTime, $cacheKey);
    }

    public static function template(){
        $load = self::init();
        //-------向视图中添加变量
        $load->core('template');
        if(!$load->template){
            $template = new template;
        }else{
            $template = $load->template;
        }
        $load->template = $template;
        return $template;
    }
    /**
     * 链接数据库
     * @return Object
     */
    public static function database()
    {
        $load = self::init();
        //判断是否连接过数据库
        if (!is_object($load->database)) {
            if (!class_exists('Db'))
                $load->core('Db');
            $drive = Config::database('driver');
            if ($load->driver('databases', $drive)) {
                $database = new $drive;
                if ($database->connect()) {
                    Debug::add('Loader:Database connection success.');
                    return $load->database = $database;
                } else {
                    Debug::add('Loader:Database connection failure.');
                    exit;
                    return false;
                }

            } else {
                return false;
            }
        } else {
            return clone $load->database;
        }
    }

    //=====获取加载文件路径

    public static function load($file)
    {
        if (file_exists($file)) {
            $re = require($file);
            Debug::add($file, '1');
            return $re;
        }

        Debug::add('Loader:' . $file . ' not found.');

        return false;
    }

    //=====引用加载的文件

    private function getPath($name, $type)
    {
        if ($type == 'core')
            $d = $this->parseDir(Config::config('core_dir'), 'bases/') . $name . '.class.php';
        elseif ($type == 'controller')
            $d = $this->parseDir(Config::config('app_dir'), Config::config('controller_dir')) . $name . '.php';
        elseif ($type == 'model')
            $d = $this->parseDir(Config::config('app_dir'), Config::config('model_dir')) . $name . '.php';
        elseif ($type == 'plugin')
            $d = $this->parseDir(Config::config('core_dir')) . 'plugins/' . $name . '.class.php';
        elseif ($type == 'config')
            $d = $this->parseDir(Config::config('app_dir'), Config::config('config_dir')) . $name . '.php';
        elseif ($type == 'function')
            $d = $this->parseDir(Config::config('core_dir')) . 'functions/' . $name . '.func.php';
        elseif ($type == 'view')
            $d = $this->parseDir(Config::config('app_dir'), Config::config('view_dir')) . $name . '.php';
        elseif ($type == 'module')
            $d = $this->parseDir(Config::config('app_dir'), Config::config('module_dir')) . $name . '.php';
        return __ROOT__ . $d;
    }

    /**
     * 解析正确路径
     * @return String
     */
    private function parseDir()
    {
        $dirs = func_get_args();
        $dir = '';
        foreach ($dirs as $d) {
            $d = trim($d);
            if ($d[0] == '/')
                $d = substr($d, 1, strlen($d) - 1);
            if ($d[strlen($d) - 1] != '/')
                $d .= '/';
            $dir .= $d;
        }
        return $dir;
    }
}

//====================    END Loader.class.php      ========================//