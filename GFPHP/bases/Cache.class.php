<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');

/**
 * 缓存类
 * 缓存对象&&数组
 * 创建时间：2014-08-08 23:29  PGF
 */
class Cache
{
    public static $cache;

    public static function init()
    {
        if (Config::config('cache') == true) {
            $config = Config::cache();
            Loader::core('CacheCarry');
            Loader::driver('caches', $config['driver']);
            self::$cache = new $config['driver']($config);
        }
    }

    public static function get($name, $space = false)
    {
        Debug::add('Cache:' . $space . '/' . $name . ' Read success.', 0);
        return self::$cache->get($name, $space);
    }

    public static function time($name, $space = false)
    {
//        echo $name;
        return self::$cache->time($name, $space);
    }

    public static function set($name, $con, $space = false)
    {

        Debug::add('Cache:' . $space . '/' . $name . ' update success.', 0);
        return self::$cache->set($name, $con, $space);
    }

    public static function is_cache($name, $space = false)
    {
        return self::$cache->is_cache($name, $space);
    }

    public static function delete($name, $space = false)
    {
        $res = self::$cache->delete($name, $space);
        if ($res) {
            Debug::add('Cache:' . $space . '/' . $name . ' delete success.', 0);
        } else {
            Debug::add('Cache:' . $space . '/' . $name . ' delete failed.', 0);
        }
        return $res;
    }

    public static function flush($space = false)
    {
        if ($space == false)
            $space = self::$cache->config['default_space'];
        $res = self::$cache->flush($space);
        if ($res) {
            Debug::add('Cache:Space' . $space . ' delete success.', 0);
        } else {
            Debug::add('Cache:Space' . $space . ' delete failed.', 0);
        }
        return $res;
    }

    public static function delete_timeout($space = false, $lifetime=false){
        if ($space == false)
            $space = self::$cache->config['default_space'];
        if($lifetime == false)
            $lifetime = Config::cache('lifetime');
        return self::$cache->delete_timeout($space,$lifetime);
    }
}

//====================    END Cache.class.php      ========================//