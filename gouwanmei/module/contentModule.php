<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * User: pgf
 * Date: 15-8-25
 * Time: 上午11:13
 * UpdateTime: 2015-12-03 使后台设置允许搜索之后搜索会自动搜索此字段
 */
class ContentModule{
    //将栏目存放到内存，减少系统功耗
    private $category=array();
    private $ContentOrder = 'desc';

    //改变内容排序方式
    public function changeContentOrder(){
        if($this->ContentOrder=='desc')
            $this->ContentOrder = 'asc';
        else
            $this->ContentOrder = 'desc';
    }

    /**
     * @param int $mid               模型ID
     * @return bool OR array         如果存在模型ID返回array否则返回bool
     */
    private function &getSearch($mid = 0,$model=false,$keywords=''){
        if($mid == 0 || $model == false){
            return false;
        }
        $mid=intval($mid);
        $searchField = model('model_field')->where('modelid',$mid)->where('is_index',1)->select('name')->query();     //获取到允许搜索的字段

        $n=0;
        foreach($searchField as $field){
            $where=$n==0?'where':'orwhere';
            $model->$where("{$field['name']} like '%{$keywords}%'");
            $n++;
        }
        return $model;
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
    public function SearchByModel($mid=0, $keywords='', $num=10, $page=1, $reutrnpage=false, $where=array()){
        if($mid == 0){
            return array();
        }
        $mid = intval($mid);
        $keywords = model()->addslashes($keywords);
        $contable = model('category')->where('con_modelid',intval($mid))->getOne('contable');
        if(empty($contable))
            return array();
        else
            $contable = $contable['contable'];

        $model = model($contable);
        $model = $this->getSearch($mid,$model,$keywords); //获取到搜索后的模型
        if(!empty($where)) {
            foreach ($where as $whereset)
            {
                $model->where($whereset);
            }
        }
        $model1 = clone $model;
        $count = $model->count();
        Loader::$load->template()->assign(array('resnum'=>$count));
        $pageclass = Loader::plugin('cmspage');
        if(!isset($_GET)) {
            $_GET = array();
        }
        $_GET['page'] = '%page%';
        $action = Router::$router->routers['controller'].'/'.Router::$router->routers['method'];
        if(Router::$router->routers['var']!=false){
            $action .= '/'.implode('/',Router::$router->routers['var']);
        }
        $url = Router::$router->url($action,$_GET);
        $pageclass->init($count, $url, $page,$num);
        if($reutrnpage!=false)
        {
            if(method_exists($pageclass, $reutrnpage))
                $pageclass->$reutrnpage();
        }
        $rpage = $pageclass->output();
        $min = $rpage['min'];
        Loader::$load->template()->assign(array('pages'=>$rpage['html'],'allpages'=>$rpage['allpages']));
        $ncontent = array();
        $num = intval($num);
        $content = $model1->orderBy($contable.'.listorder '.$this->ContentOrder)->limit("$min,$num")->query();
        foreach($content as $con){
            $inputtime = $con['inputtime'];
            $updatetime = $con['updatetime'];
            $ncon = model('model_field')->parse($mid,$con);
            $ncon['cid'] = $con['cid'];$ncon['id'] = $con['id'];
            $ncon['url'] = $this->getContentUrl($con['cid'],$con['id']);
            $ncon['inputtime'] = $inputtime;
            $ncon['updatetime'] = $updatetime;
            unset($con);
            $ncontent[] = $ncon;
        }
        unset($model);
        unset($model1);
        return $ncontent;
    }

    /**
     * 按栏目搜索内容
     * @param int $cid
     * @param string $keywords  要搜索的关键字
     * @param int $num          每页展示的条数
     * @param int $page         当前页面的页数
     * @param bool $reutrnpage  展示的分页结构类型
     * @return array            返回获取到的内容数据
     */
    public function SearchByCategory($cid=0, $keywords='', $num=10, $page=1, $reutrnpage=false, $where=array()){
        if($cid == 0){
            return array();
        }
        $cid = intval($cid);
        $keywords = model()->addslashes($keywords);
        $contable = model('category')->where('cid',intval($cid))->getOne('contable,con_modelid');
        if(empty($contable))
            return array();
        else
            $table = $contable['contable'];
        $mid = $contable['con_modelid'];
        $model = model($table);
        $model = $this->getSearch($mid,$model,$keywords);
        if(!empty($where)) {
            foreach ($where as $whereset)
            {
                $model = $model->where($whereset);
            }
        }
        $model1 = clone $model;
        $count = $model->where('cid',$cid)->count();
        Loader::$load->template()->assign(array('resnum'=>$count));
        $pageclass = Loader::plugin('cmspage');
        if(!isset($_GET)) {
            $_GET = array();
        }
        $_GET['page'] = '%page%';
        $action = Router::$router->routers['controller'].'/'.Router::$router->routers['method'];
        if(Router::$router->routers['var']!=false){
            $action .= '/'.implode('/',Router::$router->routers['var']);
        }
        $url = Router::$router->url($action,$_GET);
        $pageclass->init($count, $url, $page,$num);
        if($reutrnpage!=false)
        {
            if(method_exists($pageclass, $reutrnpage))
                $pageclass->$reutrnpage();
        }
        $rpage = $pageclass->output();
        $min = $rpage['min'];
        Loader::$load->template()->assign(array('pages'=>$rpage['html'],'allpages'=>$rpage['allpages']));
        $ncontent = array();
        $num = intval($num);
        $content = $model1->orderBy($table.'.listorder '.$this->ContentOrder)->where('cid',$cid)->limit("$min,$num")->query();
        foreach($content as $con){
            $inputtime = $con['inputtime'];
            $updatetime = $con['updatetime'];
            $ncon = model('model_field')->parse($mid,$con);
            $ncon['cid'] = $con['cid'];$ncon['id'] = $con['id'];
            $ncon['url'] = $this->getContentUrl($con['cid'],$con['id']);
            $ncon['inputtime'] = $inputtime;
            $ncon['updatetime'] = $updatetime;
            unset($con);
            $ncontent[] = $ncon;
        }
        unset($model);
        unset($model1);
        return $ncontent;
    }
    /**
     * 获取栏目的子栏目
     * @param int $parent
     * @return array            返回获取到的栏目数据
     */
    public function CategoryChild($parent=0,$num=false){
        if($num==false)
            $category = model('category')->where('parent',intval($parent))->select('catetable,cat_modelid,catid,cid')->orderBy('category.listorder asc')->query();
        else {
            $num = intval($num);
            $category = model('category')->where('parent', intval($parent))->select('catetable,cat_modelid,catid,cid')->limit("0,{$num}")->orderBy('category.listorder asc')->query();
        }
        $cateArr = array();
        foreach($category as $cate) {
            $mid = $cate['cat_modelid'];
            $catetable = $cate['catetable'];
            $cid = $cate['cid'];
            $ccategory = model($catetable)->leftJoin('category',$catetable.'.id','category.catid')->where(Config::database('table_pre').'category.cid',$cid)->getOne();
            ////var_dump($ccategory);
            $view = $this->getCatView($ccategory,$mid);
            $pcate = model('model_field')->parse($mid, $ccategory);
            $pcate['cid'] = $cid;
            $pcate['pid'] = $parent;
            $pcate['view'] = $view;unset($view);
            $pcate['url'] = $this->getCategoryUrl($cid, $mid);
            $cateArr[$cid] = $pcate;
            unset($ccategory);
        }
        return $cateArr;
    }

    /**
     * 获取模型下的栏目
     * @param bool $mid
     * @return array|void
     */
    public function CategoryByModel($mid=false,$num=false){
        if($mid==false)
            return array();
        else{
            if($num==false) {
                $category = model('category')->where('con_modelid', intval($mid))->select('catetable,cat_modelid,catid,cid,parent')->orderBy('category.listorder asc')->query();
            }else{
                $num = intval($num);
                $category = model('category')->where('con_modelid', intval($mid))->select('catetable,cat_modelid,catid,cid,parent')->limit("0,{$num}")->orderBy('category.listorder asc')->query();
            }
            $cateArr = array();
            foreach($category as $cate) {
                $mid = $cate['cat_modelid'];
                $catetable = $cate['catetable'];
                $catid = $cate['catid'];
                $cid = $cate['cid'];
                $ccategory = model($catetable)->leftJoin('category',$catetable.'.id','category.catid')->where(Config::database('table_pre').'category.cid',$cid)->getOne();
                $view = $this->getCatView($ccategory,$mid);
                $pcate = model('model_field')->parse($mid, $ccategory);
                $pcate['cid']  = $cid;
                $pcate['pid']  = $ccategory['parent'];
                $pcate['view'] = $view;unset($view);
                $pcate['url']  = $this->getCategoryUrl($cid, $mid);
                $cateArr[$cid] = $pcate;
                unset($ccategory);
            }
            return $cateArr;
        }
    }
    /**
     * 获取一个栏目
     * @param $cid
     * @return mixed
     */
    public function category($cid){
        //===判断是否已经放入内存
        if(isset($this->category[$cid]))
            return $this->category[$cid];
        $category  = model('category')->where('cid',intval($cid))->getOne('catetable,cat_modelid');
        $catetable = $category['catetable'];$mid = $category['cat_modelid'];
        if(empty($catetable))
            return array();
        $category = model($catetable)->leftJoin('category',$catetable.'.id','category.catid')->where(Config::database('table_pre').'category.cid',intval($cid))->getOne();
        if(empty($category)){
            return array();
        }
        $parent = $category['parent'];
        $view = $this->getCatView($category,$mid);
        $category = model('model_field')->parse($mid,$category);
        $category['pid'] = $parent;unset($parent);
        $category['cid'] = $cid;
        $category['view'] = $view;unset($view);
        $category['url'] = $this->getCategoryUrl($cid,$mid);
        $this->category[$category['cid']]=$category;
        return $category;
    }

    /**
     * 获取一个栏目的父级栏目
     * @param $cid
     */
    public function categoryParent($cid){
        //===判断是否已经放入内存
        if(isset($this->category[$cid]))
        {
            $cid = $this->category[$cid]['pid'];
        }else {
            $category = model('category')->where('cid', intval($cid))->getOne('parent');
            $cid = $category['parent'];//获取到父级栏目真正ID
        }
        return $this->category($cid);
    }

    //获取栏目内容
    public function ContentCount($cid){
        $category = model('category')->where('cid',intval($cid))->getOne('contable');
        $contable = $category['contable'];
        if($contable!=''){
            $count = model($contable)->where('cid',intval($cid))->getOne('count(*)');
            return $count[0];
        }
    }

    /**
     * 获取栏目内容列表
     * @param $cid      栏目ID
     * @param int $num  获取数量
     * @param int $page 当前page值
     * @param char $reutrnpage 当为false时将不会获取分页信息
     */
    public function ContentList($cid,$num=10,$page=1,$reutrnpage=false){
        $category = model('category')->where('cid',intval($cid))->getOne('contable,con_modelid');
        if(empty($category))
            return array();
        $contable = $category['contable'];$mid=$category['con_modelid'];
        if($contable!=''){
            $count = model($contable)->where('cid',intval($cid))->count();
            Loader::$load->template()->assign(array('resnum'=>$count));
            $pageclass = Loader::plugin('cmspage');
            $is_page = $this->is_page($cid);
            if(!isset($_GET))
                $_GET = array();
            $_GET['page'] = '%page%';
            $action = Router::$router->routers['controller'].'/'.Router::$router->routers['method'];
            if(Router::$router->routers['var']!=false){
                $action .= '/'.implode('/',Router::$router->routers['var']);
            }
            $url = Router::$router->url($action,$_GET);
            $pageclass->init($count, $url, $page,$num);
            if($reutrnpage!=false)
            {
                if(method_exists($pageclass, $reutrnpage))
                    $pageclass->$reutrnpage();
            }
            $rpage = $pageclass->output();
            $min = $rpage['min'];
            Loader::$load->template()->assign(array('pages'=>$rpage['html'],'allpages'=>$rpage['allpages']));
            $content = model($contable)->where('cid',intval($cid))->orderby($contable.'.listorder desc')->limit("$min,$num")->query();
            $ncontent = array();
            foreach($content as $con){
                $inputtime = $con['inputtime'];
                $updatetime = $con['updatetime'];
                $ncon = model('model_field')->parse($mid,$con);
                $ncon['cid'] = $con['cid'];$ncon['id'] = $con['id'];
                $ncon['url'] = $this->getContentUrl($con['cid'],$con['id']);
                $ncon['inputtime'] = $inputtime;
                $ncon['updatetime'] = $updatetime;
                unset($con);
                $ncontent[] = $ncon;
            }
            return $ncontent;
        }
    }

    /**
     * 兰君姐提议
     * 获取一个栏目和子栏目下的内容
     * 不可行，因为一个栏目下可能会有各种模型的内容
     * @param $cid
     * @param int $num
     * @param int $page
     * @param bool $return
     */
  //  public function ContentListByBigCategory($cid,$num=10,$page=1,$return = false){

  //  }
    /**
     * 获取模型表下的内容
     * @param $mid
     * @param $num
     * @param int $page
     */
    public function ContentListByModel($mid,$num=10,$page=1,$reutrnpage=false){
        //
        $table = model('category')->where('con_modelid',intval($mid))->getOne('contable');
        if(empty($table)||is_null($table['contable']))
            return array();
        $table = $table['contable'];
        $count = model($table)->count();    //获取内容总数量
        Loader::$load->template()->assign(array('resnum'=>$count));
        $pageclass = Loader::plugin('cmspage');
        if(!isset($_GET))
            $_GET = array();
        $_GET['page'] = '%page%';
        $action = Router::$router->routers['controller'].'/'.Router::$router->routers['method'];
        if(Router::$router->routers['var']!=false){
            $action .= '/'.implode('/',Router::$router->routers['var']);
        }
        $url = Router::$router->url($action,$_GET);
        $pageclass->init($count, $url, $page,$num);
        if($reutrnpage!=false)
        {
            if(method_exists($pageclass, $reutrnpage))
                $pageclass->$reutrnpage();
        }
        $rpage = $pageclass->output();
        $min = $rpage['min'];
        
        Loader::$load->template()->assign(array('pages'=>$rpage['html'],'allpages'=>$rpage['allpages']));
        $ncontent = array();
        $num = intval($num);

        $content = model($table)->orderBy($table.'.listorder '.$this->ContentOrder)->limit("$min,$num")->query();
        foreach($content as $con){
            $inputtime = $con['inputtime'];
            $updatetime = $con['updatetime'];
            $ncon = model('model_field')->parse($mid,$con);
            $ncon['cid'] = $con['cid'];$ncon['id'] = $con['id'];
            $ncon['url'] = $this->getContentUrl($con['cid'],$con['id']);
            $ncon['inputtime'] = $inputtime;
            $ncon['updatetime'] = $updatetime;
            unset($con);
            $ncontent[] = $ncon;
        }
        return $ncontent;
    }
    /**
     * 获取内容
     * @param $cid
     * @param $id
     * @return mixed
     */
    public function content($cid,$id){
        $category = model('category')->where('cid',intval($cid))->getOne('contable,con_modelid');
        $contable = $category['contable'];$mid = $category['con_modelid'];
        $content = model($contable)->where('id',intval($id))->getOne();
        if(empty($content))
            return false;
        $template = $content['template'];
        $inputtime = $content['inputtime'];
        $updatetime = $content['updatetime'];
        $content = model('model_field')->parse($mid,$content);
        $content['id']  = $id;
        $content['cid'] = $cid;
        $content['template'] = $template;
        $content['url'] = $this->getContentUrl($cid, $id);
        $content['inputtime'] = $inputtime;
        $content['updatetime'] = $updatetime;
        return $content;
    }

    public function previousContent($cid,$id){
        $category = model('category')->where('cid',intval($cid))->getOne('contable,con_modelid');
        $contable = $category['contable'];$mid = $category['con_modelid'];
        $content = model($contable)->where('cid',intval($cid))->where('id>'.intval($id))->orderBy($contable.'.id asc')->getOne();
        if(empty($content))
            return false;
        $id = $content['id']; $cid = $content['cid'];
        $template = $content['template'];
        $content = model('model_field')->parse($mid,$content);
        $content['id']  = $id;
        $content['cid'] = $cid;
        $content['url'] = $this->getContentUrl($cid, $id);
        $content['template'] = $template;
        return $content;
    }

    public function nextContent($cid,$id){
        $category = model('category')->where('cid',intval($cid))->getOne('contable,con_modelid');
        $contable = $category['contable'];$mid = $category['con_modelid'];
        $content = model($contable)->where('cid',intval($cid))->where('id<'.intval($id))->orderBy($contable.'.id desc')->getOne();
        if(empty($content))
            return false;
        $id = $content['id']; $cid = $content['cid'];
        $template = $content['template'];
        $content = model('model_field')->parse($mid,$content);
        $content['id']  = $id;
        $content['cid'] = $cid;
        $content['url'] = $this->getContentUrl($cid, $id);
        $content['template'] = $template;
        return $content;
    }

    private function getCategoryUrl($cid,$mid){
        $cid = intval($cid);
        $is_page = model('model')->where('modelid',$mid)->getOne('is_page');
        if($is_page['is_page']==0)
            return Router::$router->url('Index/content/category/'.$cid);
        return Router::$router->url('Index/content/page/'.$cid);
    }

    private function is_page($cid){
        $cid=intval($cid);
        $mid = model('category')->where('cid',$cid)->getOne('cat_modelid');
        if(!empty($mid)){
            $is_page = model('model')->where('modelid',$mid[0])->getOne('is_page');
            if($is_page['is_page'] == 0)
                return false;
            else
                return true;
        }
    }
    /**
     * 获取正确的模板路径
     * @param $category
     * @param $mid
     * @return mixed
     */
    private function getCatView($category,$mid){
        $is_page = model('model')->where('modelid',$mid)->getOne('is_page');
        if($is_page['is_page']==1){
            return model()->addslashes($category['show_view']);
        }
        $child = unserialize($category['children']);
        if(!empty($child)){
            return model()->addslashes($category['category_view']);
        }else{
            return model()->addslashes($category['list_view']);
        }
    }

    /**
     * 获取内容链接
     * @param $cid
     * @param $id
     */
    private function getContentUrl($cid,$id){
        return Router::$router->url('Index/content/show/'.$cid.'/'.$id);
    }
}