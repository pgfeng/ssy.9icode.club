<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * Class adminModule
 * User: pgf
 * Date: 15-5-27
 * Time: 下午2:23
 * UpdateTime:  2015/11/11 修改菜单输出
 */
class adminModule
{
    private $menuid = array();
    public function admin_nav($roleid = 1,$menuarr=array()){
        $adminmenu = 'admin_menu' . '_' . $roleid;
        if (is_cache($adminmenu, 'admin/admin_menu')) {     //判断是否已经缓存
            return cache::get($adminmenu, 'admin/admin_menu');
        } else {
            $html = '';
            if(empty($menuarr))
            {
                if($roleid == 1)
                {
                    $menuRes = model('admin_menu')->select()->where('disabled','0')->orderby('admin_menu.menuid asc')->query();
                }else{
                    $menuRes = model('admin_role_priv')->select()->where(Config::database('table_pre').'admin_role_priv.roleid', $roleid)->leftjoin('admin_menu', 'admin_role_priv.menuid', 'admin_menu.menuid')->where(Config::database('table_pre').'admin_menu.disabled','0')->orderby('admin_menu.menuid asc')->query();
                }
                $menuarr = array();
                $menuid = array();
                foreach ($menuRes as $menu) {
                    $menuarr[$menu['menuid']] = $menu;
                    $menuid[] = $menu['menuid'];
                }
                //unset($menuRes);
            }else{
                $menuid = array();
                foreach ($menuarr as $menu) {
                    $menuarr[$menu['menuid']] = $menu;
                    $menuid[] = $menu['menuid'];
                }
            }
            foreach ($menuarr as $key => $menu) {
                if($menu['parentmenuid']==0)
                {
                    if(in_array($menu['menuid'], $this->menuid)){
                        continue;
                    }
                    $html.='<li'.($menu['is_index'] == 1?' class="active"':'').'>';
                    $url = 'javascript:;';
                    if(empty($menu['getArray'])){
                        //$url = Router::$router->url($menu['action']);
                        $html.='<a href="'.$url.'"';
                    }
                    else{
                        //$url = Router::$router->url($menu['action'],unserialize($menu['getArray']));
                        $html.='<a href="'.$url.'"';
                    }
                    $html.=($menu['is_index'] == 1?' data-index="0"':'').'>';
                    if($menu['parentmenuid']==0){
                        if($menu['icoClass']!=''){
                            $html .= '<i class="'.$menu['icoClass'].'"></i>';
                        }
                        $html .='<span class="nav-label">'.$menu['menuname'].'</span>';
                    }else{
                        $html .=$menu['menuname'];
                    }
                    unset($menuarr[$menu['menuid']]);
                    $html .= $this->get_nav_child($menu['menuid'],$menuarr);
                    $html .= '</li>';
                    if(!in_array($menu['menuid'], $this->menuid)){
                        $this->menuid[] = $menu['menuid'];
                    }
                }else{
                    //var_dump($menuarr[1]);exit;
                    //var_dump($menuid);exit;
                    if(!in_array($menu['parentmenuid'],$menuid)){
                        $menuarr[$menu['parentmenuid']] = model('admin_menu')->where('menuid',$menu['parentmenuid'])->where('disabled','0')->getOne();
                        $menuid[]=$menu['parentmenuid'];
                        $html.='<li'.($menu['is_index'] == 1?' class="active"':'').'>';
                        $url = 'javascript:;';
                        if(empty($menu['getArray'])){
                            //$url = Router::$router->url($menu['action']);
                            $html.='<a href="'.$url.'"';
                        }
                        else{
                            //$url = Router::$router->url($menu['action'],unserialize($menu['getArray']));
                            $html.='<a href="'.$url.'"';
                        }
                        $html.=($menuarr[$menu['parentmenuid']]['is_index'] == 1?' data-index="0"':'').'>';
                        if($menuarr[$menu['parentmenuid']]['parentmenuid']==0){
                            if($menuarr[$menu['parentmenuid']]['icoClass']!=''){
                                $html .= '<i class="'.$menuarr[$menu['parentmenuid']]['icoClass'].'"></i>';
                            }
                            $html .='<span class="nav-label">'.$menuarr[$menu['parentmenuid']]['menuname'].'</span>';
                        }else{
                            $html .=$menuarr[$menu['parentmenuid']]['menuname'];
                        }
                        unset($menuarr[$menu['parentmenuid']]);
                        $html .= $this->get_nav_child($menu['parentmenuid'],$menuarr);
                        $html .= '</li>';
                    }
                }
            }
            cache::set($adminmenu, $html, 'admin/admin_menu');
            return $html;
        }
    }
    public function get_nav_child($id,$menuarr){
        $html = '';
        $hav_child = false;
        foreach ($menuarr as $menu) {
            if(in_array($menu['menuid'], $this->menuid)){
                continue;
            }
            if($menu['parentmenuid']==$id){
                if($html==''){
                    $html .= '<span class="fa arrow"></span></a>';
                    $html .= '<ul class="nav nav-'.$menu['level'].'-level">';
                    $hav_child = true;
                }
                if(empty($menu['getArray'])){
                    $url = Router::$router->url($menu['action']);
                    $html .= '<li><a href="'.$url.'" class="J_menuItem">';
                    if($menu['icoClass']!=''){
                        $html .= '<i class="'.$menu['icoClass'].'"></i>';
                    }
                    $html .=$menu['menuname'].'</a></li>';
                }
                else{
                    $url = Router::$router->url($menu['action'],unserialize($menu['getArray']));
                    $html .= '<li><a href="'.$url.'" class="J_menuItem">';
                    if($menu['icoClass']!=''){
                        $html .= '<i class="'.$menu['icoClass'].'"></i>';
                    }
                    $html .=$menu['menuname'].'</a></li>';
                }
            
            if(!in_array($menu['menuid'], $this->menuid)){
                $this->menuid[] = $menu['menuid'];
            }
            }
        }
        if($hav_child==true)
            $html.= '</ul>';
        else
            $html = '</a>';
        return $html;
    }
    //老输出菜单 废弃了
    public function adminmenu($roleid = 1)
    {
        $allmenu = array();
        $adminmenu = 'admin_menu' . '_' . $roleid;
        if (is_cache($adminmenu, 'admin/admin_menu')) {     //判断是否已经缓存e
            echo cache::get($adminmenu, 'admin/admin_menu');
        } else {
            if ($roleid == 1) {
                $menuarr = model('admin_menu')->select()->orderby('admin_menu.menuid asc')->query();
            } else {
                $menuarr = model('admin_role_priv')->select()->where('roleid', $roleid)->leftjoin('admin_menu', 'admin_role_priv.menuid', 'admin_menu.menuid')->where(Config::database('table_pre').'admin_menu.parentmenuid!=0')->orderby('admin_menu.parentmenuid asc')->query();
            }
            foreach ($menuarr as $menu) {
                if ($menu['parentmenuid'] == 0) {
                    $allmenu[$menu['markname']]['id'] = 'menu_' . $menu['markname'];
                    if (!isset($allmenu[$menu['markname']]['homePage']) || empty($allmenu[$menu['markname']]['homePage']))
                        $allmenu[$menu['markname']]['homePage'] = !empty($menu['homepageid']) ? 'menu_' . $menu['homepageid'] : '';
                    $allmenu[$menu['markname']]['menu'][$menu['menuid']] = array('text' => $menu['menuname']);
                } else {
                    if($menu['getArray']==null) {
                        $url = Router::url($menu['action']);
                    }else {
                        $url = Router::url($menu['action'], unserialize($menu['getArray']));
                    }
                    //echo $url;exit;
                    $items = array(
                        'id' => 'menu_' . $menu['menuid'],
                        'text' => $menu['menuname'],
                        'href' => $url
                    );
                    if (!isset($allmenu[$menu['markname']]))
                        $allmenu[$menu['markname']] = array();
                    if(!isset($allmenu[$menu['markname']]['menu'][$menu['parentmenuid']]) && $roleid != 1){
                        $parent = model('admin_menu')->where('menuid',$menu['parentmenuid'])->getOne();
                        $allmenu[$parent['markname']]['id'] = 'menu_' . $parent['markname'];
                        if (!isset($allmenu[$parent['markname']]['homePage']) || empty($allmenu[$parent['markname']]['homePage']))
                            $allmenu[$parent['markname']]['homePage'] = !empty($parent['homepageid']) ? 'menu_' . $parent['homepageid'] : '';
                        $allmenu[$parent['markname']]['menu'][$menu['parentmenuid']] = array('text' => $parent['menuname']);

                    }
                    $allmenu[$menu['markname']]['menu'][$menu['parentmenuid']]['items'][] = $items;
                }
            }
            //echo 123;
            //print_r($allmenu);exit;
            $menu = array();
            $menu = array(
                isset($allmenu['index']) ? $allmenu['index'] : array(),
                isset($allmenu['content']) ? $allmenu['content'] : array(),
             //   isset($allmenu['module']) ? $allmenu['module'] : array(),     //没有用的隐藏掉
                isset($allmenu['package']) ? $allmenu['package'] : array(),
                isset($allmenu['member']) ? $allmenu['member'] : array()
            );
            $menu = json_encode($menu);
            cache::set($adminmenu, $menu, 'admin/admin_menu');
            echo $menu;
        }
    }


    //输出头部菜单 old
    public function headnav($roleid)
    {
        $adminheav = 'admin_heav' . '_' . $roleid;
        if (is_cache($adminheav, 'admin/admin_heav')) {
            echo cache::get($adminheav, 'admin/admin_heav');
        } else {
            $markarr = model('admin_menu')->where('roleid',$roleid)->leftjoin('admin_role_priv','admin_menu.menuid','admin_role_priv.menuid')->select('markname')->group('markname')->query();
            if ($roleid == 1)
                $markarr = model('admin_menu')->leftjoin('admin_role_priv', 'admin_menu.menuid', 'admin_role_priv.menuid')->select('markname')->group('markname')->query();
            else
                $markarr = model('admin_menu')->where('roleid', $roleid)->leftjoin('admin_role_priv', 'admin_menu.menuid', 'admin_role_priv.menuid')->select('markname')->group('markname')->query();
            $nav = array();
            foreach ($markarr as $mark) {
                //print_r($mark);
                if ($mark['markname'] == 'index') {
                    $nav[$mark['markname']] = '<li class="nav-item dl-selected"><div class="nav-item-inner nav-home">我的面板</div></li>';
                }
                if ($mark['markname'] == 'content')
                    $nav[$mark['markname']] = '<li class="nav-item"><div class="nav-item-inner nav-order">内容管理</div></li>';
//                if ($mark['markname'] == 'module')
//                    $nav[$mark['markname']] = '<li class="nav-item"><div class="nav-item-inner nav-package">模块管理</div></li>';
                if ($mark['markname'] == 'package')
                    $nav[$mark['markname']] = '<li class="nav-item"><div class="nav-item-inner nav-inventory">拓展管理</div></li>';
                if ($mark['markname'] == 'member')
                    $nav[$mark['markname']] = '<li class="nav-item"><div class="nav-item-inner nav-user">用户管理</div></li>';
            }
            //print_r($nav);
            $headnav = '';
            $headnav .= isset($nav['index']) ? $nav['index'] : '';
            $headnav .= isset($nav['content']) ? $nav['content'] : '';
       //     $headnav .= isset($nav['module']) ? $nav['module'] : '';  //隐藏掉
         //   $headnav .= isset($nav['member']) ? $nav['member'] : '';
            $headnav .= isset($nav['package']) ? $nav['package'] : '';
            echo $headnav;
            cache::set($adminheav, $headnav, 'admin/admin_heav');
        }
    }

    //输出菜单，树形，在选择权限中使用
    public function treemenu()
    {
        $allmenu = array();
        $adminmenu = 'admin_tree_menu';
        if (is_cache($adminmenu, 'admin')) {
            echo cache::get($adminmenu, 'admin');
        } else {
            $menuarr = model('admin_menu')->select()->query();
            foreach ($menuarr as $menu) {
                if ($menu['parentmenuid'] == 0) {
                    $allmenu[$menu['menuid']]['text'] = $menu['menuname'];
                    $allmenu[$menu['menuid']]['id'] = $menu['menuid'];
                    $allmenu[$menu['menuid']]['checked'] = false;
                    $allmenu[$menu['menuid']]['children'] = array();
                    $allmenu[$menu['menuid']]['leaf'] = false;
                } else {
                    $allmenu[$menu['parentmenuid']]['children'][] = array(
                        'text' => $menu['menuname'],
                        'id' => $menu['menuid']
                    );
                }
            }
            $menu = array();
            foreach ($allmenu as $m) {
                $menu[] = $m;
            }
            //print_r($menu);
            echo $menu = json_encode($menu);
        }
    }

    public function field_list($modelid){

        $field=model('model_field')->field_list($modelid);
        $field_list=array();
        foreach($field as $f){
            $f=model()->stripslashes($f);
            $field_list[]=array(
                'id'       => $f['fieldid'],
                'name'    => $f['name'],
                'tname'    => $f['tname'],
                'formtype' => $f['formtype'],
                'is_null'  => $f['is_null'],
                'is_index'  => $f['is_index']
            );
        }
        unset($field);
        echo json_encode($field_list);
    }

    //========= 判断管理员是否有权限进入次页面，没有权限则显示警告
    public function checkrole($roleid)
    {
        if ($roleid != 1) {
            $router = Router::get();
            $action = $router['controller'] . '/' . $router['method'];
            $menu = model('admin_menu')->select()->where("action like '" . $action . "%'")->rightjoin('admin_role_priv', 'admin_menu.menuid', 'admin_role_priv.menuid')->query();
            if (empty($menu)) {
            	$ss=model('admin_role_priv')->where('roleid', $roleid)->select()->query() ;
                //--默认允许的路径
                $allowAction = array(
                    'Content/upload',   //此为上传路径
                );
                if ((!empty($ss)&& $action == 'Index/index')||in_array($action,$allowAction)) return;
                $var = array(
                    'error',
                    '对不起，你没权限进入这里！',
                    '请你联系超级管理员给予权限。'
                );
                controller('Admin', 'show_message', $var);
                exit;
            }
        }
        
    }

    /**
     * @param $module['tablename']      表名      必须
     * @param $module['is_category']    是否为栏目 必须
     * @param $module['name']           模型名称  必须
     * @param $module['description']    模型解释  可选
     */
    function addModule($module){
        //var_dump($module);exit;
        if(!empty($module['name'])&&!empty($module['tablename']))
        {
            $module=model()->addslashes($module);
            if(preg_match('/^[_a-zA-Z][_a-zA-Z0-9]*$/',$module['tablename'])==0){
                $status = array(
                    'status' => false,
                    'msg' => '表名不合法'
                );
                echo json_encode($status);
                exit;
            }
            $ss=model('model')->where('tablename',$module['tablename'])->select()->query();

            if(!empty($ss)){
                $status = array(
                    'status' => false,
                    'msg' => '表已存在请更换表名'
                );
                echo json_encode($status);
                exit;
            }

            if($module['is_category']==0){
                $insert=array(
                    'name'=>$module['name'],
                    'tablename'=>$module['tablename'],
                    'description'=>$module['description'],
                    'addtime'    => time(),
                    'is_category' => 0,
                    'is_page'     => 0
                );

                if(model('model')->insert($insert)!==false)
                {
                    if (model()->exec('CREATE TABLE ' . Config::database('table_pre') . 'module_' . $module['tablename'] . ' (`id` int(10) NOT NULL AUTO_INCREMENT,`inputtime` int(10) NOT NULL,`updatetime` int(10) NOT NULL,`template` varchar(125) DEFAULT NULL,`hits` int(10) DEFAULT 0, `cid` CHAR( 50 ) NULL DEFAULT NULL,`listorder` int(10) DEFAULT 0, PRIMARY KEY (`id`),KEY `catid` (`cid`)) ENGINE=MyISAM DEFAULT CHARSET=utf8')!==false) {
                        $maxid=model('model')->getOne('max(modelid)');       //获取添加后的modelID
                        $maxid=$maxid[0];
                        $field=array(
                            'modelid'    => $maxid,
                            'name'      => 'title',
                            'formtype'  => 'title',
                            'tname'     => '标题',
                            'is_null'   => 0,
                            'is_system' => '1',
                            'regexp'   => '',
                            'errortip' => '',
                            'is_index'  => 1,
                            'min_length' => 0,
                            'max_length' => 0,
                            'input_value'=>'',
                            'input_width'=>'',
                            'input_height'=>'',
                            'placeholder'=>''
                        );
                        $return=model('model_field')->add($maxid,$field);
                        if($return['status']=='true') {
                            $status = array(
                                'status' => true,
                                'msg' => '添加成功'
                            );
                            echo json_encode($status);
                            exit;
                        }else{
                            model('model')->where('modelid',$maxid)->delete();
                            $status = array(
                                'status' => true,
                                'msg' => '添加失败！'
                            );
                            echo json_encode($status);
                            exit;
                        }
                    }
                }
            }elseif($module['is_category']==1){
                $insert=array(
                    'name'=>$module['name'],
                    'is_category'=> 1 ,
                    'tablename'=>$module['tablename'],
                    'description'=>$module['description'],
                    'addtime'    => time(),
                    'is_category' => 1,
                    'is_page'     => 0
                );
                if(model('model')->insert($insert)!==false)
                {
                    if (model()->exec('CREATE TABLE ' . Config::database('table_pre') . 'module_' . $module['tablename'] . ' (`id` int(10) NOT NULL AUTO_INCREMENT,`inputtime` int(10) NOT NULL,`updatetime` int(10) NOT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8')!==false) {
                        $maxid=model('model')->getOne('max(modelid)');       //获取添加后的modelID
                        $maxid=$maxid[0];
                        $field=array(
                            'modelid'    => $maxid,
                            'name'      => 'catname',
                            'formtype'  => 'text',
                            'tname'     => '栏目名称',
                            'is_null'   => 0,
                            'is_system' => '1',
                            'regexp'   => '',
                            'errortip' => '',
                            'is_index'  => 1,
                            'min_length' => 0,
                            'max_length' => 0,
                            'input_value'=>'',
                            'input_height'=>'',
                            'input_width'=>'',
                            'placeholder'=>''
                        );
                        $return = model('model_field')->add($maxid,$field);
                        if($return['status']=='true') {
                            $status = array(
                                'status' => true,
                                'msg' => '添加成功'
                            );
                            echo json_encode($status);
                            exit;
                        }else{
                            model('model')->where('modelid',$maxid)->delete();
                            $status = array(
                                'status' => true,
                                'msg' => '添加失败,系统错误！'
                            );
                            echo json_encode($status);
                            exit;
                        }
                    }
                }
            }elseif($module['is_category']==2){
                //echo '是模型'
                $insert=array(
                    'name'=>$module['name'],
                    'is_category'=> 1 ,
                    'tablename'=>$module['tablename'],
                    'description'=>$module['description'],
                    'addtime'    => time(),
                    'is_category' => 1,
                    'is_page'     => 1
                );
                if(model('model')->insert($insert)!==false)
                {
                    if (model()->exec('CREATE TABLE ' . Config::database('table_pre') . 'module_' . $module['tablename'] . ' (`id` int(10) NOT NULL AUTO_INCREMENT,`inputtime` int(10) NOT NULL,`updatetime` int(10) NOT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8')!==false) {
                        $maxid=model('model')->getOne('max(modelid)');       //获取添加后的modelID
                        $maxid=$maxid[0];
                        $field=array(
                            'modelid'    => $maxid,
                            'name'      => 'catname',
                            'formtype'  => 'text',
                            'tname'     => '栏目名称',
                            'is_null'   => 0,
                            'is_system' => '1',
                            'regexp'   => '',
                            'errortip' => '',
                            'is_index'  => 1,
                            'min_length' => 0,
                            'max_length' => 0,
                            'input_value'=>'',
                            'input_height'=>'',
                            'input_width'=>'',
                            'placeholder'=>''
                        );
                        $return = model('model_field')->add($maxid,$field);
                        if($return['status']=='true') {
                            $status = array(
                                'status' => true,
                                'msg' => '添加成功'
                            );
                            echo json_encode($status);
                            exit;
                        }else{
                            model('model')->where('modelid',$maxid)->delete();
                            $status = array(
                                'status' => true,
                                'msg' => '添加失败,系统错误！'
                            );
                            echo json_encode($status);
                            exit;
                        }
                    }
                }
            }
        }
    }
    public function delModule($moduleid)
    {
        $moduleid=explode(',',$moduleid);
        //print_r($moduleid);
        foreach($moduleid as $id){
            if(!empty($id))
            {
                $model=model('model')->where('modelid',$id)->select('tablename')->query();
                //print_r($model);
                //exit;
                if(!isset($model[0]['tablename'])){
                    $status = array(
                        'status' => false,
                        'msg' => '模型不存在!'
                    );
                    echo json_encode($status);
                    exit;

                }
                if(model()->exec('DROP TABLE '.Config::database('table_pre').'module_'.$model[0]['tablename'])!==false)
                {
                    if(!model('model')->where('modelid',$id)->delete())
                    {

                        $status = array(
                            'status' => false,
                            'msg' => '模型删除失败!'
                        );
                        echo json_encode($status);
                        exit;
                    }else{
                        model('category')->where('catetable','module_'.$model[0]['tablename'])->orwhere('contable','module_'.$model[0]['tablename'])->delete();
                        model('model_field')->where('modelid',$id)->delete();
                    }
                }else{
                    $status = array(
                        'status' => false,
                        'msg' => '模型删除失败!'
                    );
                    echo json_encode($status);
                    exit;
                }
                $status = array(
                    'status' => true,
                    'msg' => '模型删除成功!'
                );
            }
        }
        echo json_encode($status);
        exit;
        //exit;
    }
    /**
     * @param $module[moduleid] 模型id  没做呢
     * @param $module['is_category']    是否为栏目 必须
     * @param $module['name']           模型名称  必须
     * @param $module['description']    模型解释  可选
     */
    public function editModule($module){

    }

    /**
     * 获取栏目模型
     * @param bool $mid 模型ID
     */
    public function getCategoryModel($mid=false){       //存在模型ID时将返回此模型栏目，否则返回所有栏目模型
        if($mid==false) {
            return model('model')->where('is_category', 1)->where('is_page',0)->query();
        }else{
            return model('model')->where('is_category', 1)->where('is_page',0)->where('modelid',$mid)->getOne();
        }
    }

    /**
     * 获取内容模型
     * @param bool $mid 模型id
     */
    public function getContentModel($mid=false){
        if($mid==false) {
            return model('model')->where('is_category', 0)->query();
        }else{
            return model('model')->where('is_category', 0)->where('modelid',$mid)->getOne();
        }
    }

    public function getViewList($type,$filter=''){
        $dirArr=array();
        $dir=Config::cms('cms_path').parseDir(Config::template('view_dir'),Config::template('view_name'),$type);
        //var_dump($dir);exit;
        if(file_exists($dir)) {
            //echo $dir;exit;
            if ($filter == '')
                $filter = '*';
            if ($filter != '*')
                $filter = $filter . '*';
            $d = glob($dir . $filter);
            $filter = substr($filter, 0, strlen($filter) - 1);
            foreach ($d as $value) {
                if (preg_match('/' . srtToRE($dir) . srtToRE($filter) . '(.*)' . srtToRE(Config::template('view_suffix')) . '$/', $value))
                    $dirArr[] = preg_replace('/' . srtToRE($dir) . srtToRE($filter) . '(.*)' . srtToRE(Config::template('view_suffix')) . '$/', $type.'/'.$filter . "$1", $value);
            }
        }
        return $dirArr;
    }
    /**
     * @param $filed 添加字段
     */
    public function addField($model_id, $field)
    {
        $res=model('model_field')->add($model_id, $field);
        if($res['status']==false){
            $var=array(
                'error',
                '字段添加状态',
                $res['msg'].'正在返回....'
            );
        }else{
            $var=array(
                'ok',
                '字段添加状态',
                $res['msg'].'正在返回....'
            );
        }
        redirect(Router::url('Module/manage/field',array('mid'=>$model_id)), 2);
        controller('Admin', 'show_message', $var);
        //exit;
    }

    public function delField($fieldid)
    {
        $fileldid=explode(',',$fieldid);
        if(model('model_field')->delete_field($fileldid)!==false){
            $msg = array(
                'status' => 'ok',
                'msg'    => '字段删除成功！'
            );
        }else{
            $msg = array(
                'status' => 'error',
                'msg'    => '系统字段不允许删除！'
            );
        }
        echo json_encode($msg);
        exit;
    }

    /**
     * 修改字段
     * @param $fieldid
     * @param $field
     */
    public function editField($fieldid,$field){
        //$field
        if($mid=model('model_field')->edit($fieldid,$field)){
            $var=array(
                'ok',
                '字段修改成功！',
                '字段修改成功，正在返回....'
            );
        }else{
            $var=array(
                'error',
                '字段修改失败',
                '请尝试换个字段名重试，正在返回....'
            );
        }
        redirect(Router::url('Module/manage/field',array('mid'=>$mid)), 2);
        controller('Admin', 'show_message', $var);
    }

    //========= 清理缓存
    /**
     * @param $type 要清理的缓存存放的空间
     */

    public function flush_cache($type)
    {
        //可以以后再加
        $cachetype = array(
            'db',
            'view_c',
            'admin',
            'cms',
        );
        if ($type == 'db') {
            echo '正在清理数据库缓存。。。。。。<br>';
            ob_flush();
            flush();
            echo (cache::flush(Config::database('cache_dir')) ? '后台数据库缓存清理完成。' : '后台数据库缓存清理失败！') . '<br>';
            ob_flush();
            flush();
        }else
        if ($type == 'view_c') {
            echo '正在清理后台模板缓存。。。。。。<br>';
            ob_flush();
            flush();
            echo (cache::flush(Config::template('view_c_dir')) ? '后台数据库缓存清理完成。' : '后台数据库缓存清理失败！') . '<br>';
            ob_flush();
            flush();
            echo '正在清理前台缓存。。。。。。<br/>';
            ob_flush();
            flush();
            echo (cache::flush(Config::cms('cms_app_name')) ? '前台缓存清理完成。' : '前台缓存清理失败！') . '<br>';
            ob_flush();
            flush();
        }else
        if ($type == 'admin') {
            echo '正在清理后台缓存。。。。。。<br>';
            ob_flush();
            flush();
            echo (cache::flush('admin') ? '后台缓存清理完成。' : '后台缓存清理失败！') . '<br>';
            ob_flush();
            flush();
        }else
        if ($type == 'all') {
            foreach ($cachetype as $type) {
                $this->flush_cache($type);
            }
            echo '缓存清理完毕！';
        }
    }
}