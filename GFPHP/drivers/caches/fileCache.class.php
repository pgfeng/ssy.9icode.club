<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * fileSystem缓存操作
 * 实现文件方式缓存
 * 创建时间：2014-09-19 07:40 PGF
 */
class fileCache extends CacheCarry
{

    public $config = array(
        'default_space' => 'default_space'
    );

    public function __construct($config = false)
    {
        if ($config) {
            foreach ($config as $k => $v) {
                $this->config[$k] = $v;
            }
        }
    }

    /**
     * 获取内容
     */
    public function _get($key, $space = '')
    {
        $path = $this->toPath($key, $space);
        return $this->read($path);
    }

    /**
     * 获取保存位置
     */
    private function toPath($key, $dir = false)
    {
        if (!$dir) $dir = $this->config['default_space'];
        return __ROOT__ . parseDir(Config::config('app_dir'), Config::cache('cache_dir'), $dir) . $key . '.php';
    }

    /**
     * 读取文件
     */
    private function read($path)
    {
        if (file_exists($path))
            return file_get_contents($path);
        else
            return false;
    }

    public function _is_cache($key, $space = '')
    {
        $path = $this->toPath($key, $space);
        return file_exists($path);
    }

    /**
     * 获取修改或添加的时间
     */
    public function _time($key, $space = '')
    {
        //echo $space;exit;
        $path = $this->toPath($key, $space);
        if (file_exists($path))
            return filemtime($path);
        else
            return false;
    }

    /**
     * 设置内容
     * 不存在就添加，存在就修改
     */
    public function _set($key, $content, $space = '')
    {
        $path = $this->toPath($key, $space);
        if($this->write($path, $content))
            return true;
        else
            return false;
    }

    /**
     * 写入文件
     */
    private function write($path, $content)
    {
        $dir = dirname($path);
        if (!is_dir($dir))
            @mkdir($dir, 0777, true);
        return file_put_contents($path, $content);
    }

    /**
     * 删除指定缓存
     */
    public function _delete($key, $space)
    {
        echo $path = $this->toPath($key, $space);
        return @unlink($path);
    }

    /**
     * 清空指定文件夹的缓存
     */
    public function _flush($space)
    {
        $dir = __ROOT__ . parseDir(Config::config('app_dir'), Config::cache('cache_dir'), $space);
        if (!file_exists($dir))
            return true;
        $dh = opendir($dir);
        while ($file = readdir($dh)) {
            if ($file != "." && $file != "..") {
                $fullpath = $dir . "/" . $file;
                if (!is_dir($fullpath)) {
                    @unlink($fullpath);
                } else {
                    $this->flush($space . '/' . $file);
                }
            }
        }

        closedir($dh);
        //删除当前文件夹：
        if (rmdir($dir)) {
            return true;
        } else {
            return false;
        }
    }
    public function _delete_timeout($space,$lifetime){

        $dir = __ROOT__ . parseDir(Config::config('app_dir'), Config::cache('cache_dir'), $space);
        if(!file_exists($dir))
            return true;

        foreach(glob($dir.'*') as $v){
            $time = $lifetime+filemtime($v);
            if($time<time())
                @unlink($v);
        }
        return true;
    }
}