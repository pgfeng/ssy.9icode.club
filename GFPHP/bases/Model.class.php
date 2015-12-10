<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');

/**
 * Model基类
 * 所有模型必须继承此类
 * 你也可以不使用模型，仅使用此Model
 * 创建时间：2014-08-10 07:52 PGF
 * 修改时间：2015-06-18 10:31 PGF            function __Clone(){}
 */
class Model
{
    public $db;
    public $model;

    //-----初始化模型
    public function __construct($table = false)
    {
        $this->model = $table;
        $this->database();
    }

    /**
     * database 加载数据库
     * @return null
     */
    private function database()
    {
        $db = Loader::database();
        if (!$db) {
            exit('<h1>Database Config Error!!!</h1>');
        }
        $num = strpos(get_class($this), 'Model');
        if ($num != 0) {
            $db->table = Config::database('table_pre') . substr(get_class($this), 0, $num);
        } else {
            $db->table = Config::database('table_pre') . substr($this->model, 0, strpos($this->model, 'Model'));
        }
        $db->_reset();
        $this->db = $db;
    }

    //设置模型操作的表
    public function table($table = '')
    {
        $this->db->table = Config::database('table_pre') . Config::database($table);
        return $this;
    }

    //=====不存在的方法将执行DB类中的方法=====//
    public function __call($func, $val)
    {
        switch (count($val)) {
            case 0:
                return $this->_autoreturn($this->db->$func());
                break;
            case 1:
                return $this->_autoreturn($this->db->$func($val[0]));
                break;
            case 2:
                return $this->_autoreturn($this->db->$func($val[0], $val[1]));
                break;
            case 3:
                return $this->_autoreturn($this->db->$func($val[0], $val[1], $val[2]));
                break;
            case 4:
                return $this->_autoreturn($this->db->$func($val[0], $val[1], $val[2], $val[3]));
                break;
            case 5:
                return $this->_autoreturn($this->db->$func($val[0], $val[1], $val[2], $val[3], $val[4]));
                break;
            default:
                exit('不好意思了，只支持最多五个参数了，可以使用模型->db->方法执行操作！');
                break;
        }
    }
    //------自动更改调用方法
    private function _autoreturn($res)
    {
        if (is_object($res)) {
            $this->db = $res;
            return $this;
        } else
            return $res;
    }

    //防止克隆时出现DB对象还原的情况
    public function __clone(){
        return $this->db = clone $this->db;
    }
}

//====================    END Model.class.php      ========================//