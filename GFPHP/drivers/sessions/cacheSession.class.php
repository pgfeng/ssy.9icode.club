<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');

/**
 * Created by PhpStorm.
 * User: PGF
 * Date: 2015/7/15
 * Time: 17:25
 * 将SESSION存到缓存中 实现多种SESSION方式 具体实现方式参考配置
 * 选择memcache缓存时session将设置不上去，原因不明
 */

Loader::core('Session');

class cacheSession extends Session {

    protected $savePath;

    //====打开

    public function _open(){
        if(Config::session('savePath')=='')
        {
            $config=array('savePath'=>'session');
            Config::set($config,'session',1);
        }
        $this->savePath = Config::session('savePath');
        Cache::delete_timeout('session');
        return true;
    }
    //====关闭
    public function _close(){
        return true;
    }

    //====写入
    public function _write($id, $data){
        return Cache::set($id, $data, $this->savePath);
    }

    //====清除
    public function _destroy($id){
        if($id){
            return Cache::delete($id, $this->savePath);
        }else{
            return Cache::flush($this->savePath);
        }
    }

    //====更新
    public function _gc($maxlifetime){
        return Cache::delete_timeout($this->savePath,$maxlifetime);
    }

    //====读取
    public function _read($id){
        return Cache::get($id,$this->savePath);
    }
}