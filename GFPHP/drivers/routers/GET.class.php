<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * router driver GET class
 * 网址解析类
 * GET.router 方式传递
 * 网址类似 entry.php?router=/index/index/var1/var2
 * 创建时间： 2015-02-08 22:59 PGF
 */
class GET extends Router
{
    protected function parse_url()
    {
        if (isset($_GET['router'])) {
            $p = explode('/', $_GET['router']);
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
            foreach ($get as $k => $v) {
                if (empty($g))
                    $g .= '?' . $k . '=' . $v;
                else
                    $g .= '&' . $k . '=' . $v;
            }
        } else
            $g .= !empty($get) ? '&' . $get : '';
        return '?router=/' . $action . '/' . $g;
    }
}