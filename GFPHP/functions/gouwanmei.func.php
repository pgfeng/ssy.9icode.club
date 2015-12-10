<?php

/**
 * Created by PhpStorm.
 * User: pgf
 * Date: 15-8-25
 * Time: 下午3:54
 */

/**
 * 图片等比缩放，优先宽度
 * @param $imgUrl           图片地址
 * @param bool $width       宽度
 * @param bool $height      高度
 */

function thumb($imgUrl,$width='auto',$height='auto'){

    if($width==false&&$height==false){
        echo $imgUrl;
        return;
    }else {
        if($width=='auto'&&$height=='auto'){
            echo $imgUrl;return;
        }
        $img = Loader::plugin('image');
        $info = pathinfo($imgUrl);
        $dir = explode('/',$info['dirname']);
        $dir = $dir[3];
        $picPath = __ROOT__ . 'runtime/thumb/'.$dir.'/'.$info['filename'].'/'.$width.'X'.$height.'.png';
        $urlpath = '/runtime/thumb/'.$dir.'/'.$info['filename'].'/'.$width.'X'.$height.'.png';
        $info = pathinfo($picPath);
        if(!is_dir($info['dirname'])){
            mkdir($info['dirname'],0777,1);
        }
        //var_dump($info);exit;
        if(file_exists($picPath)){
            echo $urlpath;
            return;
        }
        $image = $img->CreateThumbnail(__ROOT__.$imgUrl,$width=='auto'?false:$width,$height=='auto'?false:$height,$picPath);
        echo $urlpath;
    }
}

/**
 * CMS 标签编译
 * @param $str
 * @return mixed
 */
function template_parse($str){
    $leftDelim = Config::template('leftDelim');
    $rightDelim = Config::template('rightDelim');

    //获取父级栏目信息
    $str = preg_replace_callback('/'.$leftDelim.'\$\_CAT\[(.*)\]\[parent\]\[(.*)\]'.$rightDelim.'/U',function($match){
        if(preg_match('/\$([a-zA-Z0-9_]*)\.([a-zA-Z0-9_]*)/',$match[1],$res)){
            return "<?php \$cat = Module('content')->categoryParent(\$$res[1]['$res[2]']); if(!empty(\$cat)){ ?>{\$cat[$match[2]]}<?php } unset(\$cat); ?>";
            // exit;
        }else{
            return "<?php \$cat = Module('content')->categoryParent($match[1]); if(!empty(\$cat)){ ?>{\$cat[$match[2]]}<?php } unset(\$cat); ?>";
        }
    },$str);

    //获取栏目信息
    $str = preg_replace_callback('/'.$leftDelim.'\$\_CAT\[(.*)\]\[(.*)\]'.$rightDelim.'/U',function($match){
        if(preg_match('/\$([a-zA-Z0-9_]*)\.([a-zA-Z0-9_]*)/',$match[1],$res)){
            return "<?php \$cat = Module('content')->category(\$$res[1]['$res[2]']); if(!empty(\$cat)){ ?>{\$cat[$match[2]]}<?php } unset(\$cat); ?>";
           // exit;
        }else{
            return "<?php \$cat = Module('content')->category($match[1]); if(!empty(\$cat)){ ?>{\$cat[$match[2]]}<?php } unset(\$cat); ?>";
        }
    },$str);



    return $str;
}

//----获取当前栏目信息
function CAT($cid){
    return Module('content')->category($cid);
}

/**
 * 字符截取 支持UTF8/GBK
 * @param $string
 * @param $length
 * @param $dot
 */
function str_cut($string, $length, $dot = '...') {
    $length = intval($length);
    $strlen = mb_strlen($string,'utf8');
    if($strlen <= $length) return $string;
    $string = str_replace(array(' ',' ', '&amp;', '"', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '<', '>', '&middot;', '&hellip;'), array('∵',' ', 
    '&', '"', "'", '&ldquo;', '&rdquo;', '&mdash;', '<', '>', '&middot;', '&hellip;'), $string);
    $strcut = '';
    $strcut = mb_substr($string,0,$length,'utf-8');
    return $strcut.$dot;
}
/**
 * 获取当前页面完整URL地址
 */
function get_url() {
    //var_dump($_SERVER);
    $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
    $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
    $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
    if(substr($path_info, 0,1)!='/'){
        $path_info = '/'.$path_info;
    }
    $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
    return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
}

/**
 * 根据ID获取省份
 */
function province($id){
    return Module('area')->getProvince($id);
}

/**
 * 根据ID获取城市
 */
function city($id){
    return Module('area')->getCity($id);
}

/**
 * 根据ID获取县区
 */
function district($id){
    return Module('area')->getDistrict($id);
}
/**
* 产生随机字符串
*
* @param    int        $length  输出长度
* @param    string     $chars   可选的 ，默认为 0123456789
* @return   string     字符串
*/
function random($length, $chars = '0123456789') {
    $hash = '';
    $max = strlen($chars) - 1;
    for($i = 0; $i < $length; $i++) {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return $hash;
}

/**
 * 栏目导航
 * 格式为：首页 > 一级栏目 > 二级栏目 > 三级栏目
 * @param $cid 栏目ID
 * @param $mark 中间的连接标识
 */
function cat_nav($cid, $mark = '>'){
    $nav = '';
    $mark='<span>'.$mark.'</span>';
    do{
            $cid = isset($category['pid'])?$category['pid']:$cid;
            $category = module('content')->category($cid);
            $nav = $mark . '<a href="' . $category['url'] . '">' . $category['catname'] . '</a>'.$nav;
    }while($category['pid']>0);
    $nav = '<a href="' . Config::config('entry') . '">首页</a>'.$nav;
    return $nav;
}

function content_list($cid,$min=0,$num=10){
    $list = module('content')->ContentList($cid,$min=0,$num=10);
    return $list;
}

/**
 * 从栏目下获取内容列表
 * @param $cid                  栏目ID
 * @param int $num              获取内容数量
 * @param int $page             当前页面page值
 * @param bool $reutrnpage      分页结构格式
 * @return array
 */
function CLBC($cid, $num=10, $page=1, $reutrnpage = false){
    return Module('content')->ContentList($cid,$num,$page,$reutrnpage);
}

/**
 * 从模型下获取内容列表
 * @param $mid                  模型ID，可以在后台去查看
 * @param int $num
 * @param int $page
 * @param bool $reutrnpage
 * @return array
 */
function CLBM($mid, $num=10, $page=1, $reutrnpage = false){
    return Module('content')->ContentListByModel($mid,$num,$page,$reutrnpage);
}

/**
 * 根据内容模型获取栏目
 * @param $mid          内容模型的ID
 * @return array        栏目数据
 */
function CATBM($mid, $num = false){
    return Module('content')->CategoryByModel($mid, $num);
}

/**
 * 根据上级栏目获取子栏目
 * @param $cid          上级栏目的ID
 * @return array
 */
function CATBC($cid,$num = false){
    return Module('content')->CategoryChild($cid, $num);
}

/**
 * 按模型搜索内容
 * @param int $mid          模型ID可以在后台模型管理查看
 * @param string $keywords  要搜索的关键字
 * @param int $num          每页展示的条数
 * @param int $page         当前页面的页数
 * @param bool $reutrnpage  展示的分页结构类型
 * @return array            返回获取到的内容数据
 */
function SCBM($mid, $keywords='', $num=10, $page=1, $reutrnpage=false, $field=array()){
    return Module('content')->SearchByModel($mid, $keywords, $num, $page, $reutrnpage, $field);
}

/**
 * 按栏目搜索内容
 * @param int $cid          栏目ID
 * @param string $keywords  要搜索的关键字
 * @param int $num          每页展示的条数
 * @param int $page         当前页面的页数
 * @param bool $reutrnpage  展示的分页结构类型
 * @return array            返回获取到的内容数据
 */
function SCBC($cid, $keywords='', $num=10, $page=1, $reutrnpage=false, $field=array()){
    return Module('content')->SearchByCategory($cid, $keywords, $num, $page, $reutrnpage, $field);
}


/**
 * 提示消息
 * @param $message          信息
 * @param string $status    状态
 * @param string $url       要跳转的链接
 * ##### 可以根据以下参数编写样式   #####
 * error        错误
 * info         提示
 * success      成功
 * warning      警告
 *#####################################
 * 默认为错误
 */
function show_message($message, $status='error',$locationhref=false){
    $title = '';
    $defaultTitle=array(
        'error'     =>   '错误',
        'info'      =>   '提示',
        'success'   =>   '成功',
        'warning'   =>   '警告'
    );
    if(is_array($message)){
        if(!(isset($message['title'])&&isset($message['content'])))
            return show_message($message[0],$status);
        else{
            $title = $message['title'];
            $content = $message['content'];
        }
    }else{
        $content = $message;
    }
    if($title=='')
        $title = $defaultTitle[$status];
    $data = array();
    $data['SEO'] = Loader::$load->template()->var['SEO'];
    $data['SEO']['title'] = $title.'_'.Loader::$load->template()->var['website']['title'];
    $message['title']     = $title;
    $message['content']   = $content;
    $data = array(
        'SEO'     => $data['SEO'],
        'message' => $message,
        'status'  => $status,
        'locationhref' => $locationhref
    );
    view('show_message',$data);
}