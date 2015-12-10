<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * memcache缓存驱动
 * 实现更方便的memcache操作
 * 创建时间：2014-09-01 09:23 PGF 可以按键值添加删除缓存
 * 修改时间：2014-09-17 08:56 PGF 使用设置键值空间实现可以批量删除功能
 */
class memcacheDriver extends CacheCarry
{
    /**
     * 默认设置
     * 和config文件夹下memcache.php内容相同
     */
    public $config = array(
        'host' => '127.0.0.1',
        'port' => '11211',
        'default_space' => 'default_space'
    );               //存放实例过的memcache语柄
    protected $mem = false;

    /**
     * 实例化memcache
     * 如果设置$config则按照$config设置，否则按照config下cache.php设置
     * @
     */
    public function __construct($config = false)
    {
        if ($config) {
            foreach ($config as $k => $v) {
                $this->config[$k] = $v;
            }
        } else {
            $this->config = Config::cache();
        }
        $this->connect();
    }

    /**
     * 链接memcache,保存实例化的memcache
     */

    private function connect()
    {
        if ($this->mem)
            return $this;
        else {
            return $this->mem = memcache_connect($this->config['memcached_host'], $this->config['memcached_port']) or Debug::add('memcached连接失败');
        }
    }

    public function _is_cache($key, $space = false)
    {
        return $this->_get($key, $space);
    }

    /**
     * 获取内容
     **/
    public function _get($key, $space = false)
    {
        $space = $space ? $space : $this->config['default_space'];
        $key = $this->toKey($key, $space);
        return $this->mem->get($key);
    }

    protected function toKey($key, $space)
    {

        $space = $space ? $space : $this->config['default_space'];
        return md5($key . $space);

    }

    /**
     * 获取修改或添加时间
     **/
    public function _time($key, $space = false)
    {
        $space = $space ? $space : $this->config['default_space'];
        $spaceCon = $this->showSpace($space);
        if ($spaceCon[$key])
            return $spaceCon[$key];
        else
            return false;
    }

    public function showSpace($space)
    {
        return $this->mem->get($space);
    }

    /**
     *
     * 设置内容
     *
     * 不存在添加，存在则修改
     *
     **/
    public function _set($key, $value, $space = false)
    {
        $space = $space ? $space : $this->config['default_space'];
        $this->toSpace($key, $space);
        $key = $this->toKey($key, $space);
        return $this->mem->set($key, $value);
    }

    public function toSpace($key, $space = false)
    {
        $space = $space ? $space : $this->config['default_space'];
        $spaceCon = $this->showSpace($space);
        if (!is_array($spaceCon)) {
            $spaceCon = array($key => time());
        } else {
            $spaceCon[$key] = time();
        }
        $this->mem->set($space, $spaceCon);
    }
    public function outSpace($key,$space){
        $spaceCon = $this->showSpace($space);
        if($spaceCon[$key])
            unset($spaceCon[$key]);
        return $this->mem->set($space, $spaceCon);
    }
    /**
     * 删除一个指定键缓存
     */
    public function _delete($key, $space = false)
    {
        if($this->outSpace($key,$space)) {
            $key = $this->toKey($key, $space);

            return $this->mem->delete($key);
        }
        else{

            return false;
        }
    }

    /**
     * 清空指定空间缓存
     */

    public function _flush($space = false)
    {
        $space = $space ? $space : $this->config['default_space'];
        $spaceCon = $this->showSpace($space);
        if(empty($spaceCon))
            return true;
        foreach ($spaceCon as $k => $v) {
            $key = $this->toKey($k, $space);
            $this->mem->delete($key);
        }
        $spaceCon = array();
        return $this->mem->set($space, $spaceCon);
    }
    public function _delete_timeout($space, $lifetime){
        $spaceCon=$this->showSpace($space);
        foreach($spaceCon as $key=>$time){
            if($time + $lifetime < time()){
                if($this->outSpace($key,$space)){
                    $this->delete($key,$space);
                }
            }
        }
        return true;
    }
    public function __destruct()
    {
        $this->mem->close();
    }
}
