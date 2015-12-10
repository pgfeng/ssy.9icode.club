<?php

if (!defined('__ROOT__')) exit('Sorry,Please from entry!');

/**
 * 模板引擎
 * 创建时间：2014-08-11 10:16 PGF 把以前写好的搬了过来，使模板可以使用静态缓存
 * 修改时间：2014-10-02 10:25 PGF 根据修改的缓存做出修改
 * 修改时间：2015-05-18 14:34 PGF 增加编译功能
 */
class Template
{
    public $var = array();

    /**
     * 引用模板
     * @param $template  模板
     * @param $cacheTime 是否使用静态缓存，等于0时不使用，大于0时为缓存时间 如果为负值则永久缓存
     * @param $cacheKey  静态缓存KEY
     */

    public function display($template, $cacheTime = false, $cacheKey = false)
    {
        $this->var['view_vars']=Config::view_vars();
        $path['template_c'] = $this->get_path($template, 'view_c');
        $path['template'] = $this->get_path($template);
        //当缓存时间未设置时，将自动获取配置中的缓存时间
        $cache = $cacheTime ? intval($cacheTime) : Config::template('view_cache_time');
        $cache = isset($_POST)&&!empty($_POST) ? 0 : $cache;
        $kVar = empty($cacheKey) ? null : $cacheKey;
        if (file_exists($path['template'])) {
            //如果已编译模板的不存在或者模板修改时间大于已编译模板的时间将重新编译
            if (!file_exists($path['template_c']) || filemtime($path['template']) > filemtime($path['template_c']))
                $this->write($path['template_c'], $this->template_parse(file_get_contents($path['template'])));
            if (($cache > 0||$cache<0) && Config::template('view_cache')) {
                if (!Cache::is_cache($this->get_temp_name($template, $cacheKey), Config::template('view_cache_dir'))) {
                    
                    self::cache_compile($template, $cacheKey);

                        debug::add('Template:Write cache ' . $template . $kVar . '</strong>\' Cache time:' . $cache . 'second.');

                } elseif (($cache<0||Cache::time($this->get_temp_name($template, $cacheKey), Config::template('view_cache_dir')) + $cache > time()) && filemtime($path['template_c']) < Cache::time($this->get_temp_name($template, $cacheKey), Config::template('view_cache_dir'))) {
                    echo Cache::get($this->get_temp_name($template, $cacheKey), Config::template('view_cache_dir'));
                    if($cache>0)
                    debug::add('Template:Read cache ' . $template . '[' . $kVar . ']' . ' Cache time:' . $cache . 'second.');
                    else
                    debug::add('Template:Write cache ' . $template . $kVar . '</strong>\' Cache time:' . 'Aways.');
                } else {

                    self::cache_compile($template, $cacheKey);

                    debug::add('Template:Update cache ' . $template . '[' . $kVar . ']' . ' Cache time:' . $cache . 'second.');

                }
            } else {

                foreach ($this->var as $k => $v) {
                    $$k = $v;
                }
                include $path['template_c'];
                debug::add('Template:Use template ' . $template . ' Unused cache.');

            }

        } else {
            debug::add('Template:template' . $path['template'] . ' not found.');

        }

    }
    /**
     * 获取路径
     * @param $templateName         模板名称
     * @param string $type          类型
     * @param bool $key             KEY
     * @return string               返回模板路径
     */
    private function get_path($templateName, $type = 'template', $key = false)
    {
        switch ($type) {

            case 'template':
                $path=__ROOT__ . parseDir(Config::config('app_dir'), Config::template('view_dir'), Config::template('view_name')) . $templateName . Config::template('view_suffix');
                if(!file_exists($path) && Config::template('view_name') != Config::template('default_view_name'))     //如果不存在，则查看默认模板是否存在
                {
                    $dpath=__ROOT__ . parseDir(Config::config('app_dir'), Config::template('view_dir'), Config::template('default_view_name')) . $templateName . Config::template('view_suffix');
                    if(file_exists($dpath))
                        return $dpath;
                }
                return $path;
            case 'cache':

                return __ROOT__ . parseDir(Config::config('app_dir'), Config::cache('cache_dir') ,Config::template('cache_dir'), Config::template('cache_dir'), Config::template('view_cache_dir'), Config::template('view_name')) . '/' . $templateName . $key;

            case 'view_c':

                return __ROOT__ . parseDir(Config::config('app_dir'), Config::cache('cache_dir'), Config::template('view_c_dir'), Config::template('view_name')) . $templateName . '.php';

        }

    }

    /**
     * 写入文件
     * 模板静态缓存不使用此方法
     */
    private function write($path, $content)
    {
        $dir = dirname($path);
        //echo $dir;exit;
        if (!is_dir($dir))
            mkdir($dir, 0777, true);
        return file_put_contents($path, $content);
    }

    public function get_var($key){
        return isset($this->var[$key])?$this->var[$key]:'';
    }
    /**
     * 编译模板
     * @param $str    模板内容
     * @return string 编译后的模板内容
     */
    private function template_parse($str)
    {
        $leftDelim = Config::template('leftDelim');
        $rightDelim = Config::template('rightDelim');

        //----是否允许自定义编译
        if(Config::template('template_parse')!=false){
            $str = call_user_func(Config::template('template_parse'),$str);
        }

        //====打印标签,P标签内的将不会编译
        $str = preg_replace_callback("/" . $leftDelim . "p" . $rightDelim . "(.*)" . $leftDelim . "\/p" . $rightDelim ."/iUs",function($matches){
            return htmlspecialchars($matches[1]);
        }, $str);

        //====引入模板
        $str = preg_replace("/" . $leftDelim . "template\s+(.+?)" . $rightDelim . "/iU", "<?php view(\\1); ?>", $str);

        //====引入php文件
        $str = preg_replace("/" . $leftDelim . "include\s+(.+?)" . $rightDelim . "/i", "<?php include \\1; ?>", $str);

        //====php标记
        $str = preg_replace("/" . $leftDelim . "php\s+(.+?)" . $rightDelim . "/i", "<?php \\1?>", $str);

        //====if判断
        $str = preg_replace("/" . $leftDelim . "if\s+(.+?)" . $rightDelim . "/i", "<?php if(\\1) { ?>", $str);
        $str = preg_replace("/" . $leftDelim . "else" . $rightDelim . "/i", "<?php } else { ?>", $str);
        $str = preg_replace("/" . $leftDelim . "elseif\s+(.+?)" . $rightDelim . "/", "<?php } elseif (\\1) { ?>", $str);
        $str = preg_replace("/" . $leftDelim . "\/if" . $rightDelim . "/i", "<?php } ?>", $str);

        //for 循环
        $str = preg_replace("/" . $leftDelim . "for\s+(\\$[a-zA-Z_\x7f-\xff][a-zA-Z_\x7f-\xff]*)\s+in+\s+(\d+)\.\.\.(\d+)" . $rightDelim . "/i", "<?php for(\\1=\\2;\\1<=\\3;\\1++) { ?>", $str);

        $str = preg_replace("/" . $leftDelim . "for\s+(.+?)" . $rightDelim . "/i", "<?php for(\\1) { ?>", $str);
        $str = preg_replace("/" . $leftDelim . "\/for" . $rightDelim . "/i", "<?php } ?>", $str);

        //++ --
        $str = preg_replace("/" . $leftDelim . "\+\+(.+?)" . $rightDelim . "/", "<?php ++\\1; ?>", $str);
        $str = preg_replace("/" . $leftDelim . "\-\-(.+?)" . $rightDelim . "/", "<?php ++\\1; ?>", $str);
        $str = preg_replace("/" . $leftDelim . "(.+?)\+\+" . $rightDelim . "/", "<?php \\1++; ?>", $str);
        $str = preg_replace("/" . $leftDelim . "(.+?)\-\-" . $rightDelim . "/", "<?php \\1--; ?>", $str);
        $str = preg_replace("/" . $leftDelim . "loop\s+(\S+)\s+(\S+)" . $rightDelim . "/i", "<?php if(is_array(\\1)) foreach(\\1 AS \\2) { ?>", $str);
        $str = preg_replace("/" . $leftDelim . "loop\s+(\S+)\s+(\S+)\s+(\S+)" . $rightDelim . "/i", "<?php if(is_array(\\1)) foreach(\\1 AS \\2 => \\3) { ?>", $str);
        $str = preg_replace("/" . $leftDelim . "\/loop" . $rightDelim . "/i", "<?php } ?>", $str);

        $str = preg_replace("/" . $leftDelim . "([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff:]*\(([^{}]*)\))" . $rightDelim . "/", "<?php echo \\1;?>", $str);

        $str = preg_replace("/" . $leftDelim . "\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff:]*\(([^{}]*)\))" . $rightDelim . "/", "<?php \\1;?>", $str);

        $str = preg_replace("/" . $leftDelim . "\\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)" . $rightDelim . "/", "<?php echo isset(\$\\1)?\$\\1:\$this->var['\\1'];?>", $str);
        $str = preg_replace_callback("/" . $leftDelim . "(\\$[a-zA-Z0-9_\[\]\'\"\$\x7f-\xff]+)" . $rightDelim . "/s", function ($matches) {
            $match = '<?php echo ' . $matches[1] . ';?>';
            return str_replace("\\\"", "\"", preg_replace("/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s", "['\\1']", $match));
        }, $str);
        $str = preg_replace("/" . $leftDelim . "(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\.([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)" . $rightDelim . "/","<?php echo \\1['\\2']; ?>",$str);
        if(Config::template('css_path'))                    //判断是否定义CSS存放位置
            $str = preg_replace_callback("/" . $leftDelim . "includeStyle\s+['|\"](.+?)['|\"]" . $rightDelim . "/i", function ($matches){
                $css=trim($matches[1]);
                $cssarray=explode(',',$css);
                $css='';
                foreach($cssarray as $c)
                {
                    $css.= '<link href="'.Config::template('css_path').$c.'" type="text/css" rel="stylesheet">';
                }
                return $css;
            }, $str);
        if(Config::template('js_path'))                     //判断是否定义JS存放位置
            $str = preg_replace_callback("/" . $leftDelim . "includeScript\s+['|\"](.+?)['|\"]" . $rightDelim . "/i", function ($matches){
                $js=trim($matches[1]);
                $jsarray=explode(',',$js);
                $js='';
                foreach($jsarray as $j)
                {
                    $js.= '<script type="text/javascript" src="'.Config::template('js_path').$j.'"></script>';
                }
                return $js;
            }, $str);
        if(Config::view_vars('img_path'))
        $str = preg_replace('/' . $leftDelim . 'IMG_PATH' . $rightDelim . '/i', '<?php echo $this->var[\'view_vars\'][\'img_path\'];?>', $str);
        $str = preg_replace("/" . $leftDelim . "([A-Z_\x7f-\xff][A-Z0-9_\x7f-\xff]*)" . $rightDelim . "/s", "<?php echo \\1;?>", $str);
        $str = preg_replace("/<php>(.*)<\/php>/isU", "<?php \\1?>", $str);
        //清理注释
        $str = preg_replace('/[\s+?]<!--(.*?)-->[\s+?]/s',"", $str);
        $str = "<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>\n" . $str;
        return $str;
    }


    ///=================获取文件位置======================///

    private function get_temp_name($template, $cacheKey)
    {
        if ($cacheKey)
            return $template . '-' . $cacheKey;
        else
            return $template;
    }

    private function runtemp($thisistemplatename){
        ob_start();
        foreach ($this->var as $k => $v) {
            $$k = $v;
        }
        @include $this->get_path($thisistemplatename,'view_c');

        $content = ob_get_contents();

        ob_end_clean();

        return $content;
    }

    /**
     * 编译保存静态缓存
     * @param string $template 模板(已经编译好的)
     * @param string $cacheKey 缓存密钥
     */
    private function cache_compile($template, $cacheKey)
    {
        $content=$this->runtemp($template);
        echo $content;
        $t = date("Y-m-d H:i:s");
        return Cache::set($this->get_temp_name($template, $cacheKey), $content, Config::template('view_cache_dir'));
    }

    /**
     * 设置变量
     * 一个参数时必须为数组
     * 两个参数是第一个是定义的变量名，第二个是值
     */
    public function assign($data)
    {
        $nums = func_num_args();
        if ($nums == 1) {
            if (is_array($data)) {
                foreach ($data as $k => $v) {
                    $this->var[$k] = $v;
                }
            }
        } else {
            $this->var[func_get_arg(0)] = func_get_arg(1);
        }
        return;
    }
}

//====================    END template.class.php      ========================//