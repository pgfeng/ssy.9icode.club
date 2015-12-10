<?php

/**
 * Created by PhpStorm.
 * User: PGF
 * Date: 2015/8/20
 * Time: 11:02
 */
class contentModule{
    /**
     * 内容列表，内容管理
     * @param $cid
     */
    public function showManage($cid){
        $cid=intval($cid);
        $category=model('category')->where('cid',$cid)->getOne();
        $category['is_page'] = model('model')->where('modelid',$category['cat_modelid'])->getOne('is_page');
        $category['is_page'] = $category['is_page'][0];
        if($category['is_page']==1){
            header('Location:'.Router::$router->url('Content/page/edit',array('cid'=>$cid)));
        }else{
            $page = isset($_GET['page'])?$_GET['page']:1;
            if($page<1)
                $page = 1;
            $num = 10;           //页面显示的结果数量
            $categoryDet=model($category['catetable'])->where('id',$category['catid'])->getOne('catname');
            $data['catname'] = $categoryDet['catname'];
            $count = model($category['contable'])->where('cid',$cid)->count();
            $pageO = Loader::plugin('page');
            $pageO->init($count, Router::$router->url('content/content/manage',array('page'=>'%page%','cid'=>$cid)),$page,$num);
            $pages = $pageO->p();
            $content=model($category['contable'])->where('cid',$cid)->orderby($category['contable'].'.listorder desc')->limit($pages['min'],$num)->query();
            $data['cid'] = $cid;
            $data['content'] = model()->stripslashes($content);
            $data['pages'] = $pages['html'];
            $data['pageNum'] = $pages['pageNum'];
            view('Content/content_manage',$data);
        }
        //var_dump($category);
    }

    /**
     * 修改内容
     * @param $mid      模型ID
     * @param $id       内容ID
     */
    public function edit($cid,$id,$mid){
        $contable=model('category')->where('cid',intval($cid))->getOne('contable');
        $contable=$contable['contable'];
        $id=intval($id);$cid=intval($cid);$mid=intval($mid);
        unset($_POST['edit_content']);unset($_POST['mid']);unset($_POST['id']);unset($_POST['cid']);
        $content=$_POST;unset($_POST);
        $content=model()->addslashes($content);
        $template = $content['show_view'];
        $content = model('model_field')->field_check($mid,$content);
        $content['updatetime'] = time();    //更改修改时间
        $content['template'] = $template;unset($template);
        if(model($contable)->where('id',$id)->update($content)!==false){
            $var = array(
                'ok',
                '修改成功',
                '页面正在进入列表，请稍后。。。',
            );
            redirect(Router::url('Content/content/manage',array('cid'=>$cid)), 2);
            controller('Admin', 'show_message', $var);
            exit;
        }else{
            $var = array(
                'error',
                '修改失败，出现未知错误！',
                '可能你没有修改任何内容，请稍后。。。',
                'Content/category/manage'
            );
            redirect(Router::url('Content/content/manage',array('cid'=>$cid)), 2);
            controller('Admin', 'show_message', $var);
            exit;
        }
        //if(model($contable)->)
        //var_dump($_POST);
    }

    public function add($cid,$mid){
        //echo $cid.$mid;
        $contable=model('category')->where('cid',intval($cid))->getOne('contable');
        $contable=$contable['contable'];
        unset($_POST['cid']);unset($_POST['mid']);unset($_POST['add_content']);
        $_POST['template'] = $_POST['show_view']; unset($_POST['show_view']);
        $content=$_POST;unset($_POST);
        //var_dump($content);exit;
        $content=model()->addslashes($content);
        $template = $content['template'];
        $content = model('model_field')->field_check(intval($mid),$content);
        $content['template'] = $template;unset($template);
        $content['cid'] = intval($cid);
        //--添加时间和修改时间
        $content['inputtime'] = $content['updatetime'] = time();
        if(model($contable)->insert($content)){
            $maxid = model($contable)->getOne('max(id)');
            $maxid = $maxid[0];
            model($contable)->where('id',$maxid)->update('listorder=id');
            $var = array(
                'ok',
                '添加成功',
                '页面正在进入列表，请稍后。。。',
            );
            redirect(Router::url('Content/content/manage',array('cid'=>$cid)), 2);
            controller('Admin', 'show_message', $var);
            exit;
        }else{
            $var = array(
                'error',
                '添加失败，出现未知错误！',
                '页面正在返回中，请稍后。。。',
                array('Content/category/manage' => '返回栏目管理'),
                'Content/category/manage'
            );
            redirect(Router::url('Content/category/manage'), 2);
            controller('Admin', 'show_message', $var);
            exit;
        }
    }
}