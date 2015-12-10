<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * router driver fakeHtml class
 * 网址解析类
 * 依赖Pathinfo 如果配置隐藏入口效果更好
 * 伪静态模式，格式如enrty.php/controller-method-var1-var2-var3.html?get=value
 * 注意：值不能用-符连接
 * 创建时间： 2015-02-11 22:59 PGF
 */
class fakeHtml extends Router
{
    protected function parse_url()
    {
        $_SERVER['PATH_INFO'] = isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:(isset($_SERVER['REDIRECT_PATH_INFO'])?$_SERVER['REDIRECT_PATH_INFO']:false);
        if ($_SERVER['PATH_INFO']){
            if(substr($_SERVER['PATH_INFO'], 0, 1)!='/')
                $s = $_SERVER['PATH_INFO'];
            else
                $s = substr($_SERVER['PATH_INFO'], 1);
        }
        else{
            $s = Config::router('default_controller') . '-' . Config::router('default_method');
        }
        $sps = strripos($s, '.html');
        if ($sps)
            $s = substr($s, 0, $sps);
        $r = explode('-', $s);
        $c = array(
            'controller' => isset($r[0]) && !empty($r[0]) ? $r[0] : Config::router('default_controller'),
            'method' => isset($r[1]) && !empty($r[1]) ? $r[1] : Config::router('default_method'),
            'var' => isset($r[2]) && !empty($r[2]) ? array_slice($r, 2) : false
        );
        return $c;
    }

    protected function _url($action, $get = false)
    {
        if (!is_array($action))
            $action = explode('/', $action);
        $action = implode('-', $action) . '.html';
        $g = null;
        if (is_array($get)) {
            $i = 0;
            foreach ($get as $k => $v) {
                $g .= $i != 0 ? '&' : '?';
                $g .= $k . '=' . $v;
                $i++;
            }
        } else {
            $g .= !empty($get) ? '?' . $get : '';
        }
        return $action . $g;
    }
}
