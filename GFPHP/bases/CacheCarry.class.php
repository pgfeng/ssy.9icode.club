<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');

/**
 * 缓存处理类
 * 缓存对象&&对象&&字符串
 * 创建时间：2014-09-28 12:13   PGF
 */
abstract class CacheCarry
{

    public function get($name, $space = false)
    {
        return $this->_get($name, $space);
    }

    /**
     * 编写缓存驱动必须重写下列方法
     */

    abstract function _get($name, $space);  //

    public function set($name, $con, $space = false)
    {
        return $this->_set($name, $con, $space);
    }

    abstract function _set($name, $con, $space);

    public function is_cache($name, $space = false)
    {
        return $this->_is_cache($name, $space);
    }

    abstract function _is_cache($name, $space);

    public function time($name, $space = false)
    {
        return $this->_time($name, $space);
    }       //获取缓存

    abstract function _time($name, $space);  //设置缓存

    public function delete($name, $space = false)
    {
        return $this->_delete($name, $space);
    }  //是否缓存

    abstract function _delete($name, $space);      //缓存修改时间

    public function flush($space = false)
    {
        return $this->_flush($space);
    }    //删除缓存

    abstract function _flush($space);           //清空指定空间

    public function delete_timeout($space, $lifetime){
        return $this->_delete_timeout($space, $lifetime);
    }
    abstract function _delete_timeout($space, $lifetime);
}

//====================    END CacheCarry.class.php      ========================//