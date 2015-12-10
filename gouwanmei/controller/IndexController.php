<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * User: pgf
 * Date: 15-8-25
 * Time: 上午11:12
 */
class IndexController extends Controller{
    public $cacheKey;
    public $setting = array();
    public function initialize(){
        Config::database();                           //加载数据库配置
        Loader::func('gouwanmei');                  //引入全局函数
        Config::set(array('cache'=>1),'database');
        if(!isset($_SERVER['REQUEST_URI']))
            $_SERVER['REQUEST_URI'] = '';
		//var_dump($_SERVER);
		$this->cacheKey=$_SERVER['REQUEST_URI'];
        //获取站点配置
        $setting = model('website')->where('siteid',1)->getOne();
        $this->setting = $setting;
        $data['SEO'] = array();
        $data['SEO']['title']       = $setting['title'];
        $data['SEO']['keywords']    = $setting['keywords'];
        $data['SEO']['description'] = $setting['description'];
        $template = $setting['template'];           //站点配置中的前台模板
        $data['website'] = $setting;
        $data['page'] = isset($_GET['page'])?$_GET['page']:1;
        $data['user'] = Module('member')->isLogin($data['website']['membertokentype']);       //用户登录状态
        $this->assign($data);
        unset($setting);
        Config::template();                                 //载入模板配置，防止将所有的配置替换
        //==配置模板风格和静态缓存生存时间

        //==配置模板风格和静态缓存生存时间
        Config::set(array(
                        'view_name'      => $template,
                        'template_parse' => 'template_parse',
                        'view_cache'     => Config::cms('view_cache'),
                        'leftDelim'      => Config::cms('tpl_leftDelim'),
                        'rightDelim'     => Config::cms('tpl_rightDelim'),
                        'img_path'       => Config::cms('img_path'),
                        'js_path'        => Config::cms('js_path'),
                        'css_path'       => Config::cms('css_path')
                    ),'template');
        
        //如果使用手机进入则会用mobile模板
        if(isset($_SERVER['HTTP_USER_AGENT'])){
            if(preg_match('/mobile/i', $_SERVER['HTTP_USER_AGENT'])){
                Config::set(
                        array(
                            'view_name' => 'mobile'
                        ),
                    'template');
            }

        }
        Config::set(array(
                    'debug'=> Config::cms('debug')
            ),'config');
    }
    //==给予页面缓存
    //缓存层级太多了，要大改
    public function Cache($key){
        $last_modified_time  = Cache::time($key, Config::template('view_cache_dir'));
        $etag = md5($key);
        header("Last-Modified: ".gmdate("D, d M Y H:i:s", $last_modified_time)." GMT");
        //==设置默认缓存时间
        header('Cache-Control: max-age='.Config::cms('html_cache_time'));
        header("Etag: $etag");
        if ((isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])&&strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $last_modified_time) || (isset($_SERVER['HTTP_IF_NONE_MATCH'])&&trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag)) {
            header("HTTP/1.1 304 Not Modified");
            exit;
        }
    }
    public function index(){
        //$this->Cache('index',$_SERVER['QUERY_STRING']);
        if($this->cacheKey)
	        view('index',array(),Config::cms('view_cache_time'),$this->cacheKey);
		else{
			view('index');
		}
    }
    public function content($method='category', $cid=false, $id=false){
        $data['SEO'] = $this->load->template()->var['SEO'];
        if($method=='category'||$method=='page'){
            if($cid==false){
                header('HTTP/1.1 404 Not Found');
                header("status: 404 Not Found");
                echo '<script type="text/javascript" src="http://www.qq.com/404/search_children.js" charset="utf-8" homePageUrl="/index.php" homePageName="回到'.$this->setting['title'].'"></script>';
                exit;
            }else{
                $category=module('content')->category($cid);
                if(!$category){
                    header('HTTP/1.1 404 Not Found');
                    header("status: 404 Not Found");
                    echo '<script type="text/javascript" src="http://www.qq.com/404/search_children.js" charset="utf-8" homePageUrl="/index.php" homePageName="回到'.$this->setting['title'].'"></script>';
                    exit;
                }
                $data['SEO']['title'] = $category['catname'].'_'.$this->load->template()->var['SEO']['title'];
                if(isset($category['keywords']))
                    $data['SEO']['keywords'] = $category['keywords'].','.$this->load->template()->var['SEO']['keywords'];
                $data['category']=$category;
                $data['cid']     =$category['cid'];
                foreach($category as $key=>$value){
                    $data[$key]=$value;
                }
                //----开始编译并且设置缓存
                //echo $this->cacheKey?$cid.$this->cacheKey:$this->cacheKey;
                if($this->cacheKey)
                {
                    view($category['view'],$data,Config::cms('view_cache_time'),$cid.$this->cacheKey);
                }else{
                    view($category['view'],$data);
                }
            }
        }elseif($method=='show'){
            if($cid==false||$id==false){
                header('HTTP/1.1 404 Not Found');
                header("status: 404 Not Found");
                exit;
            }else{
                $category=module('content')->category($cid);
                $content = module('content')->content($cid,$id);
                if(!$category || !$content)
                {
                    header('HTTP/1.1 404 Not Found');
                    header("status: 404 Not Found");
                    echo '<script type="text/javascript" src="http://www.qq.com/404/search_children.js" charset="utf-8" homePageUrl="/index.php" homePageName="回到'.$this->setting['title'].'"></script>';
                    exit;
                }
                $data['SEO']['title'] = $content['title'].'-'.$category['catname'].'_'.$this->load->template()->var['SEO']['title'];
                if(isset($content['keywords']))
                    $data['SEO']['keywords'] = $content['keywords'].','.$this->load->template()->var['SEO']['keywords'];
                $data['category']=$category;
                foreach($content as $key=>$value){
                    $data[$key]=$value;
                }
                $data['id']      =$content['id'];
                $data['cid']     =$category['cid'];
                $data['previous']=Module('content')->previousContent($cid,$id);
                $data['next']=Module('content')->nextContent($cid,$id);
                //----开始编译并且设置缓存
                if($this->cacheKey){
                    view($content['template'],$data,Config::cms('view_cache_time'),$cid.'-'.$id.$this->cacheKey);
                }else{
                    view($content['template'],$data);
                }
            }
        }else{
            header('HTTP/1.1 404 Not Found');
            header("status: 404 Not Found");
            echo '<script type="text/javascript" src="http://www.qq.com/404/search_children.js" charset="utf-8" homePageUrl="/index.php" homePageName="回到我的主页"></script>';
            exit;
        }
    }
    public function test(){
        ///set_time_limit(0);
        if(send_mail('892892525@qq.com','测试的邮件','<H1>test</H1>',true)){
            echo '发送成功';
        }else{
            echo '发送失败';
        }
    }
 //   public function
}