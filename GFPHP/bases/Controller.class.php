<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');

/**
 * Controller基类
 * 处理模型和视图操作
 * 创建日期：2014-08-09 00:20
 */
class Controller
{
    protected $load;

    //----可以在子类中不可覆盖此方法

    final public function __construct()
    {
        //-----将Loader放进来
        $this->load = Loader::$load;
        $this->initialize();
    }

    //----如果控制器中每个方法都需要调用一个方法，请覆盖此方法
    public function initialize(){

    }

    //-----给模板
    final function assign(){
        if(func_num_args()==1){
            Loader::template()->assign(func_get_arg(0));
        }
        elseif(func_num_args()==2){
            Loader::template()->assign(func_get_arg(0),func_get_arg(1));
        }
    }

    final function display($template, $cacheTime = false, $cacheKey = false){
        Loader::template()->display($template, $cacheTime, $cacheKey);
    }

}

//====================    END Controller.class.php      ========================//