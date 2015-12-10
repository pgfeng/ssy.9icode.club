<?php
/**
 * 全局函数
 * 此处函数可在任何地方使用
 * 创建时间：2014-08-08 13:38 PGF
 * 修改时间：2015-05-02 10:25 PGF
 */

/**
 * 根据行为获取网址
 * @param String $action 行为 例如 'index/index/a/b/c'
 * @param Array or String get 数据
 */
function url($action='', $get = '')
{
    echo Router::$router->url($action, $get);
}

/**
 * 判断缓存是否存在
 * @param String $name 缓存名
 * @param String $space 缓存空间
 */
function is_cache($name, $space = '')
{
    return Cache::is_cache($name, $space);
}

/**
 * 获取模型
 * 返回实例后的模型类
 */
function model($mname = '')
{
    return Loader::model($mname);
}

/**
 * 编译视图
 */
function view($vname, $data = false, $cacheTime = 0, $cacheKey = '')
{
    return Loader::view($vname, $data, $cacheTime, $cacheKey);
}

/**
 * 运行控制器指定方法
 */
function controller($cname, $method='', $var = false)
{
    return Loader::controller($cname, $method, $var);
}

/**
 * 引入模块
 * @param $module   模块名称
 * @return Obj
 */
function module($module)
{
    return Loader::module($module);
}

/**
 * 解析正确路径
 * @return string
 */
function parseDir()
{
    $dirs = func_get_args();
    $dir = '';
    foreach ($dirs as $d) {
        $d = trim($d);
        if(strlen($d)>0) {
            if ($d[0] == '/')
                $d = substr($d, 1, strlen($d) - 1);
            if ($d[strlen($d) - 1] != '/')
                $d .= '/';
            $dir .= $d;
        }
    }
    return $dir;
}

/**
 * 获取ip地址
 *
 * @return ip地址
 */
function ip()
{
    $IPaddress='';

    if (isset($_SERVER)){

        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){

            $IPaddress = $_SERVER["HTTP_X_FORWARDED_FOR"];

        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {

            $IPaddress = $_SERVER["HTTP_CLIENT_IP"];

        } else {

            $IPaddress = $_SERVER["REMOTE_ADDR"];

        }

    } else {

        if (getenv("HTTP_X_FORWARDED_FOR")){

            $IPaddress = getenv("HTTP_X_FORWARDED_FOR");

        } else if (getenv("HTTP_CLIENT_IP")) {

            $IPaddress = getenv("HTTP_CLIENT_IP");

        } else {

            $IPaddress = getenv("REMOTE_ADDR");

        }

    }
    return preg_match('/[\d\.]{7,15}/', $IPaddress, $matches) ? $matches [0] : '';
}

/**
 * 人性化的时间显示
 * @param  String $time Unix时间戳，默认为当前时间
 * @param  string $date_format 默认时间显示格式
 * @return String
 */
function toTime($time = null, $date_format = 'Y/m/d H:i:s')
{
    $time = is_null($time) ? time() : $time;
    $now = time();
    $diff = $now - $time;
    if ($diff < 10)
        return '刚刚';
    if ($diff < 60)
        return $diff . '秒前';
    if ($diff < (60 * 60))
        return floor($diff / 60) . '分钟前';
    if (date('Ymd', $time) == date('Ymd', $now))
        return '今天' . date('H:i:s', $time);
    return date($date_format, $time);
}

/**
 * 文件大小单位换算
 * @param  int $byte 文件Byte值
 * @return String
 */
function toSize($byte)
{
    if ($byte >= pow(2, 40)) {
        $return = round($byte / pow(1024, 4), 2);
        $suffix = "TB";
    } elseif ($byte >= pow(2, 30)) {
        $return = round($byte / pow(1024, 3), 2);
        $suffix = "GB";
    } elseif ($byte >= pow(2, 20)) {
        $return = round($byte / pow(1024, 2), 2);
        $suffix = "MB";
    } elseif ($byte >= pow(2, 10)) {
        $return = round($byte / pow(1024, 1), 2);
        $suffix = "KB";
    } else {
        $return = $byte;
        $suffix = "Byte";
    }
    return $return . " " . $suffix;
}

/**
 * xss过滤函数 --来自PHPCMS
 *
 * @param $string
 * @return string
 */
function remove_xss($string)
{
    $string = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S', '', $string);

    $parm1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');

    $parm2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');

    $parm = array_merge($parm1, $parm2);

    for ($i = 0; $i < sizeof($parm); $i++) {
        $pattern = '/';
        for ($j = 0; $j < strlen($parm[$i]); $j++) {
            if ($j > 0) {
                $pattern .= '(';
                $pattern .= '(&#[x|X]0([9][a][b]);?)?';
                $pattern .= '|(&#0([9][10][13]);?)?';
                $pattern .= ')?';
            }
            $pattern .= $parm[$i][$j];
        }
        $pattern .= '/i';
        $string = preg_replace($pattern, '', $string);
    }
    return $string;
}

/**
 * @param $url  要跳转的链接
 * @param $time 指定跳转的时间
 */
function redirect($url, $time = 0)
{
    header('Refresh:' . $time . ';url=' . $url);
}

/**
 * 将string转换成可以在正则中使用的正则
 * @param $str
 */
function srtToRE($str){
    $res='';
    $regs=array(
        '.','+','-','$','[',']','{','}','(',')','\\','^','|','?','*','/','_'
    );
    $str = str_split($str,1);
    foreach($str as $s){
        if(in_array($s,$regs))
            $res.='\\'.$s;
        else
            $res.=$s;
    }
    return $res;
}
/**
 * 判断请求是否为ajax请求
 */
function isajax(){
    if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){ 
        return true;
    }else{ 
        return false;
    }
}

/**
 * 发送邮件
 * @param $address      邮件地址 如果为数组，则为多个
 * @param $Subject      邮件主题
 * @param $body         内容
 * @param $is_html      是否为HTML
 */
function send_mail($address,$Subject,$body,$is_html=false){
    $Mailer = Loader::plugin('Mailer');
    $Mailer = $Mailer->init();
    if(is_array($address)){
        foreach($address as $adr){
            $Mailer->addAddress($adr);
        }
    }else{
        $Mailer->addAddress($address);
    }
    $Mailer->isHTML($is_html);
    $Mailer->Subject = $Subject;
    $Mailer->Body    = $body;
    return $Mailer->send();
}
