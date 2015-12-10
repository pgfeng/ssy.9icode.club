<?php


class CategoryModule{

    //--添加栏目
    public function add($category){
        if(!isset($category['mid']) || !isset($category['cmid']))
            exit('参数不完整');
        //--转存栏目模型ID和内容模型ID
        $cmid = intval($category['cmid']);$mid = intval($category['mid']);
        unset($category['cmid']);unset($category['mid']);
        //获取栏目表名
        $catetable = model('model')->where('modelid',$mid)->getOne('tablename,is_page');
        //判断是否是单网页
        $is_page=$catetable['is_page'];
        $type=$is_page==0?'栏目':'网页';
        //获取内容模型表名
        $contable  = model('model')->where('modelid',$cmid)->getOne('tablename');
        //--判断栏目模型是否存在
        if(empty($catetable)){
            $var = array(
                'error',
                $type.'模型不存在',
                '页面正在返回中，请稍后。。。',
                array('Content/category/add' => '重新添加栏目'),
                'Content/category/add'
            );
            redirect(Router::url('Content/category/add'), 2);
            controller('Admin', 'show_message', $var);
            exit;
        }
        $parent=isset($_REQUEST['parent'])?intval($_REQUEST['parent']):0;
        if($is_page==1)
        {
            $category['category_view'] = '';
            $category['list_view'] = '';
            $category['show_view'] = $category['page_view'];unset($category['page_view']);
        }
        //--正确的栏目表名
        $catetable = 'module_'.$catetable['tablename'];
        //--正确的内容表名
        if(!empty($contable))
            $contable  = 'module_'.$contable['tablename'];
        else
            $contable='';
        //--转存模板,并unset掉$_POST模板数据
        $category_view = $category['category_view'];unset($category['category_view']);
        $list_view = $category['list_view'];unset($category['list_view']);
        $show_view = $category['show_view'];unset($category['show_view']);
        if($parent>0){
            $parentRes = model('category')->where('cid',$parent)->getOne('children,cid,cat_modelid');
            $parentIsPage = model('model')->where('modelid',$parentRes['cat_modelid'])->getOne('is_page');
            if(empty($parentRes)){
                $var = array(
                    'error',
                    '你选择的父级栏目并不存在',
                    '页面正在返回中，请稍后。。。',
                    array('Content/category/add' => '重新添加栏目'),
                    'Content/category/add'
                );
                redirect(Router::url('Content/category/add'), 2);
                controller('Admin', 'show_message', $var);
                exit;
            }
            if($parentIsPage['is_page']==1){
                $var = array(
                    'error',
                    '对不起，单网页不可以添加子栏目哟！',
                    '页面正在返回中，请稍后。。。',
                    array('Content/category/add' => '重新添加栏目'),
                    'Content/category/add'
                );
                redirect(Router::url('Content/category/add'), 3);
                controller('Admin', 'show_message', $var);
                exit;
            }
        }
        //--判断内容模型是否存在,如果是网页则不判断
        if(empty($contable) && $is_page==0){
            $var = array(
                'error',
                '内容模型不存在',
                '页面正在返回中，请稍后。。。',
                array('Content/category/add' => '重新添加栏目'),
                'Content/category/add'
            );
            redirect(Router::url('Content/category/add'), 2);
            controller('Admin', 'show_message', $var);
            exit;
        }
        //--检查字段是否合法
        $category = model('model_field')->field_check($mid,$category);
        $category = model()->addslashes($category);
        $category['updatetime']=$category['inputtime']=time();
        unset($category['parent']);
        if(model($catetable)->insert($category)){
            $catid = model($catetable)->getOne('max(id)');
            $catid = $catid[0];
            $insert = array(
                'catetable' => $catetable,
                'contable'  => $contable,
                'catid'    => $catid,
                'catname'  => $category['catname'],
                'category_view' => $category_view,
                'list_view'     =>$list_view,
                'show_view'     =>$show_view,
                'parent'        => $parent,
                'cat_modelid'   => $mid,
                'con_modelid'   => $cmid
            );
            if(model('category')->insert($insert)){
                model('category')->where('catid',$catid)->where('catetable',$catetable)->update('listorder=cid');
                if($parent>0) {
                    $newCategory = model('category')->select('catetable,catid,cid,chi')->orderby('category.cid desc')->getOne();
                    $children=$parentRes['children']!=null?unserialize($parentRes['children']):array();
                    $children[]=$newCategory['cid'];
                    $children=serialize($children);
                    $update=array(
                        'children'=>$children
                    );
                    if(!model('category')->where('cid',$parentRes['cid'])->update($update)){
                        $var = array(
                            'error',
                            $type.'添加成功,但是父级其子栏目未成功修改！',
                            '页面正在跳转中，请稍后。。。',
                            array('Content/category/manage' => '栏目管理'),
                            'Content/category/manage'
                        );
                        redirect(Router::url('Content/category/manage'), 2);
                        controller('Admin', 'show_message', $var);
                        exit;
                    }
                }
                $var = array(
                    'ok',
                    $type.'添加成功',
                    '页面正在跳转中，请稍后。。。',
                    array('Content/category/manage' => '栏目管理'),
                    'Content/category/manage'
                );
                redirect(Router::url('Content/category/manage'), 2);
                controller('Admin', 'show_message', $var);
                exit;
            }
        }else{
            $var = array(
                'error',
                $type.'添加失败',
                '页面正在返回中，请稍后。。。',
                array('Content/category/add' => '重新添加栏目'),
                'Content/category/add'
            );
            redirect(Router::url('Content/category/add'), 2);
            controller('Admin', 'show_message', $var);
            exit;
        }
        //var_dump($category);
        //print_r($contable);
    }

    //修改栏目
    public function edit($category,$type='category'){
        $typename=$type=='category'?'栏目':'单网页';
        if(!isset($category['mid']) || !isset($category['cmid']) || !isset($category['cid']))
            exit('参数不完整');
        $cmid = intval($category['cmid']);$mid = intval($category['mid']);
        unset($category['cmid']);unset($category['mid']);
        //获取栏目表名
        $catetable = model('model')->where('modelid',$mid)->select('tablename,is_page')->getOne();
        //获取到栏目真实ID和父级栏目的ID
        $cid = $category['cid'];
        $oldcategory = model('category')->where('cid',intval($category['cid']))->getOne('catid,parent');
        $id=$oldcategory['catid'];
        $oldParent=$oldcategory['parent'];
        unset($category['cid']);
        //获取内容模型表名
        $contable  = model('model')->where('modelid',$cmid)->select('tablename,is_page')->getOne();
        //--判断栏目模型是否存在
        if(empty($catetable)){
            $var = array(
                'error',
                $typename.'模型不存在',
                '页面正在返回中，请稍后。。。',
                array('Content/category/manage' => '栏目管理'),
                'Content/category/manage'
            );
            redirect(Router::url('Content/category/manage'), 2);
            controller('Admin', 'show_message', $var);
            exit;
        }
        //--判断内容模型是否存在
        if(empty($contable) && $type=='category'){
            $var = array(
                'error',
                '内容模型不存在',
                '页面正在返回中，请稍后。。。',
                array('Content/category/manage' => '栏目管理'),
                'Content/category/manage'
            );
            redirect(Router::url('Content/category/add'), 2);
            controller('Admin', 'show_message', $var);
            exit;
        }
        $parent=isset($category['parent'])?intval($category['parent']):0;
        unset($category['parent']);
        $is_page=$catetable['is_page'];
        if($is_page==1)
        {
            $category['category_view'] = '';
            $category['list_view'] = '';
            $category['show_view'] = $category['page_view'];unset($category['page_view']);
        }
        //--正确的栏目表名
        $catetable = 'module_'.$catetable['tablename'];
        //--正确的内容表名
        if($is_page==0)
        $contable  = 'module_'.$contable['tablename'];
        else
            $contable  = '';
        //--转存模板,并unset掉$_POST模板数据
        $category_view = $category['category_view'];unset($category['category_view']);
        $list_view = $category['list_view'];unset($category['list_view']);
        $show_view = $category['show_view'];unset($category['show_view']);
        if($parent>0){
            $parentRes=model('category')->where('cid',$parent)->query();
            if(empty($parentRes)){
                $var = array(
                    'error',
                    '你选择的父级栏目并不存在',
                    '页面正在返回中，请稍后。。。',
                    array('Content/category/manage' => '重新添加栏目'),
                    'Content/category/manage'
                );
                redirect(Router::url('Content/category/manage'), 2);
                controller('Admin', 'show_message', $var);
                exit;
            }
        }
        //--检查字段是否合法
        $category = model('model_field')->field_check($mid,$category);
        $category = model()->addslashes($category);
        if($cid==$parent)
        {
            $var = array(
                'error',
                '不可以把当前栏目设为父级栏目！',
                '页面正在返回中，请稍后。。。',
                array('Content/category/manage' => '返回管理栏目'),
                'Content/category/manage'
            );
            redirect(Router::url('Content/category/manage'), 2);
            controller('Admin', 'show_message', $var);
            exit;
        }
        $category['updatetime']=$category['inputtime']=time();
        if(model($catetable)->where('id',$id)->update($category)){
            $catid = model($catetable)->getOne('max(id)');
            $catid = $catid[0];
            $edit = array(
                'catetable' => $catetable,
                'contable'  => $contable,
                'catname'  => $category['catname'],
                'catid'    => $catid,
                'category_view' => $category_view,
                'list_view'     =>$list_view,
                'show_view'     =>$show_view,
                'parent'        => $parent,
                'cat_modelid'   => $mid,
                'con_modelid'   => $cmid
            );
            //先从父级给移除了
            model('category')->push_category_child($oldParent,$cid);                            //从本来的父级移除
            unset($edit['catid']);
            if(model('category')->where('cid',$cid)->update($edit)!==false){                            //更新栏目情况
                if($parent!=$cid && $parent>0) {                                                             //如果栏目不属于自己
                    $children = model('category')->where('cid',$parent)->getOne('children');
                    $children = $children[0];
                    $children = !empty($children)?unserialize($children):array();
                    $children[]=$cid;
                    $children=array_unique($children);                                          //删除重复的
                    $children=serialize($children);
                    $update=array(
                        'children'=>$children
                    );
                    if(model('category')->where('cid',$parentRes[0]['cid'])->update($update)===false){
                        $var = array(
                            'error',
                            $typename.'添加成功,但是父级其子栏目未成功修改！',
                            '页面正在跳转中，请稍后。。。',
                            array('Content/category/manage' => '栏目管理'),
                            'Content/category/manage'
                        );
                        redirect(Router::url('Content/category/manage'), 2);
                        controller('Admin', 'show_message', $var);
                        exit;
                    }
                }
                $var = array(
                    'ok',
                    $typename.'修改成功了',
                    '页面正在跳转中，请稍后。。。',
                    array('Content/category/manage' => '栏目管理'),
                    'Content/category/manage'
                );
                redirect(Router::url('Content/category/manage'), 2);
                controller('Admin', 'show_message', $var);
                exit;
            }
        }else{
            $var = array(
                'error',
                $typename.'添加失败',
                '页面正在返回中，请稍后。。。',
                array('Content/category/add' => '重新添加栏目'),
                'Content/category/add'
            );
            redirect(Router::url('Content/category/add'), 2);
            controller('Admin', 'show_message', $var);
            exit;
        }
        //
//        $cid=
    }

    /**
     * 获取可以添加子栏目的栏目
     * @param int $catid
     * @param int $n
     * @return string
     */
    public function select_category_option1($catid=0,$n=-1){
        $category=model('category')->leftjoin('model','model.modelid','category.cat_modelid')->where(Config::database('table_pre').'category.parent',$catid)->where(Config::database('table_pre').'model.is_page',0)->orderby('category.listorder asc')->query();       //首先获取到栏目
        $ii=0;
        $options='';
        $n++;
        foreach($category as $cate){
            $ii++;
            $options.='<option value="'.$cate['cid'].'">';
            for($i=0;$i<$n;$i++){
                if($i>0)
                    $options.='┃';
                else{
                    $options.='&nbsp;';
                }
            }
            $cate['catname'] = model($cate['catetable'])->where('id',$cate['catid'])->getOne('catname');
            $cate['catname'] = $cate['catname'][0];
            if($n!=0)
                $options.=count($category)==$ii?'┗':'┣';
            $options.=' '.$cate['catname'].'</option>';
            $cate['children']=!is_null($cate['children'])?unserialize($cate['children']):array();
            if(!empty($cate['children'])){
                $options.=$this->select_category_option1(intval($cate['cid']),$n);
            }
        }
        return $options;
    }

    /**
     * 栏目下拉框的选项
     * 树形，使栏目清晰、
     */
    public function select_category_option($catid=0,$n=-1){
        $category=model('category')->where('parent',$catid)->orderby('category.listorder asc')->query();       //首先获取到栏目
        $ii=0;
        $options='';
        $n++;
        foreach($category as $cate){
            $ii++;
            $options.='<option value="'.$cate['cid'].'">';
            for($i=0;$i<$n;$i++){
                if($i>0)
                    $options.='┃';
                else{
                    $options.='&nbsp;';
                }
            }
            $cate['catname'] = model($cate['catetable'])->where('id',$cate['catid'])->getOne('catname');
            $cate['catname'] = $cate['catname'][0];
            if($n!=0)
                $options.=count($category)==$ii?'┗':'┣';
            $options.=' '.$cate['catname'].'</option>';
            $cate['children']=!is_null($cate['children'])?unserialize($cate['children']):array();
            if(!empty($cate['children'])){
                $options.=$this->select_category_option(intval($cate['cid']),$n);
            }
        }
        return $options;
    }

    /**
     * 栏目管理下的树形结构
     */
    public function manage_categogry_list($catid=0,$n=-1){
        $category=model('category')->where('parent',$catid)->orderby('category.listorder asc')->query();
        $ii=0;$catearr=array();$n++;
        foreach($category as $cate){
            $ii++;
            $cate['realcatname'] = '';
            for($i=0;$i<$n;$i++){
                if($i>0)
                    $cate['realcatname'].='&nbsp;┃&nbsp;';
                else{
                    $cate['realcatname'].='&nbsp;';
                }
            }
            if($n!=0)
                $cate['realcatname'].= count($category)==$ii?'&nbsp;┗&nbsp;':'&nbsp;┣&nbsp;';
            $model = model('model')->where('modelid',$cate['cat_modelid'])->getOne('is_page,name');
            $cate['is_page'] = $model['is_page'];
            //$cate['modelname'] = $model['name'];
            unset($model);
            $cate['catname'] = model($cate['catetable'])->where('id',$cate['catid'])->getOne('catname');
            $cate['catname'] = $cate['catname'][0];
            $cate['realcatname'].= $cate['catname'];
            $cate['children'] = !is_null($cate['children'])?unserialize($cate['children']):array();
            $cate=array($cate);
            if(!empty($cate[0]['children'])){
                $cate = array_merge($cate,$this->manage_categogry_list($cate[0]['cid'],$n));
            }
            $catearr = array_merge($catearr,$cate);
        }
        return $catearr;
    }
}