<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * router driver PathInfo class
 * 网址解析类
 * 创建时间： 2014-08-08 22:59 PGF
 */
class PathInfo extends Router
{
    protected function parse_url()
    {
        $_SERVER['PATH_INFO'] = isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:(isset($_SERVER['REDIRECT_PATH_INFO'])?$_SERVER['REDIRECT_PATH_INFO']:false);
        if (isset($_SERVER['PATH_INFO'])) {
            $p = explode('/', $_SERVER['PATH_INFO']);
            $c = array(
                'controller' => isset($p[1]) && !empty($p[1]) ? $p[1] : Config::router('default_controller'),
                'method' => isset($p[2]) && !empty($p[2]) ? $p[2] : Config::router('default_method'),
                'var' => isset($p[3]) && !empty($p[3]) ? array_slice($p, 3) : false
            );
        } else {
            $c = array(
                'controller' => Config::router('default_controller'),
                'method' => Config::router('default_method'),
                'var' => false
            );
        }
        return $c;
    }

    protected function _url($action, $get = false)
    {
        if (is_array($action))
            $action = implode('/', $action);
        $g = null;
        if (is_array($get)) {
            $i = 0;
            foreach ($get as $k => $v) {
                $g .= $i != 0 ? '&' : '?';
                $g .= $k . '=' . $v;
                $i++;
            }
        } else
            $g .= !empty($get) ? '?' . $get : '';
        return $action . '/' . $g;
    }
}
