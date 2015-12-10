<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * User: pgf
 * Date: 15-9-7
 * Time: 下午2:12
 */
class FormController extends Controller{
    //初始化，判断权限
    public function initialize(){
        controller('Index');
    }
    //自定义表单管理
    public function setting($action='manage'){
        if($action=='add'){
            if(isset($_POST['add_form'])){
                if(isset($_POST['formsetting'])&&isset($_POST['formname'])){
                    $formsetting = explode(',',$_POST['formsetting']); //去除描述并转成数组
                    $formsetting = array_filter($formsetting);             //去除空数组
                    $checkcode = isset($_POST['checkcode'])?intval($_POST['checkcode']):0;
                    if(model('form')->add($_POST['formname'], $formsetting, $checkcode)!==false){
                        $var = array(
                            'ok',
                            '自定义表单添加成功',
                            '页面正在返回中，请稍后。。。',
                            array('Content/form/add' => '正在返回'),
                            'Content/content/manage'
                        );
                        redirect(Router::url('Content/form/add'), 2);
                        controller('Admin', 'show_message', $var);
                        exit;
                    }else{
                        $var = array(
                            'error',
                            '添加自定义表单失败',
                            '正在返回重新添加，请稍后。。。',
                            array('Content/form/add' => '返回重新添加'),
                            'Content/form/add'
                        );
                        redirect(Router::url('Content/form/add'), 2);
                        controller('Admin', 'show_message', $var);
                        exit;
                    }
                }else{
                    exit('参数不完整');
                }
            }else{
                view('Content/form_add');
            }
        }elseif($action=='manage'){
            $form = model('form')->get();
            $data['form'] = $form;
            view('Content/form_manage',$data);
        }elseif($action=='edit'){
            if(!isset($_POST['formid']) || !isset($_POST['formsetting'])){
                $status = array(
                    'status'=>'error',
                    'msg'   =>'有错误，参数不完整！'
                );
                echo $status = json_encode($status);
                exit;
            }else{
                $_POST = model()->addslashes($_POST);
                $_POST['formsetting'] = explode(',',$_POST['formsetting']); //去除描述并转成数组
                $_POST['formsetting'] = array_filter($_POST['formsetting']);//去除空数组
                $formid = $_POST['formid'];unset($_POST['formid']);
                if(model('form')->edit($formid,$_POST)){
                    $status = array(
                        'status' => 'true',
                        'msg'    => '表单修改成功！'
                    );
                    echo $status = json_encode($status);
                    exit;
                }else{
                    $status = array(
                        'status' => 'error',
                        'msg'    => '表单修改失败！'
                    );
                    echo $status = json_encode($status);
                    exit;
                }
            }
        }elseif($action == 'del'){
            if(!isset($_POST['formid'])){
                $status = array(
                    'status' => 'error',
                    'msg'    => '有错误，请求参数不完整！'
                );
                echo $status = json_encode($status);
                exit;
            }else{
                $formid = explode(',',$_POST['formid']);
                $formid = array_filter($formid);
                foreach($formid as $id){
                    model('form')->del($id);
                }
                $status = array(
                    'status' => 'true',
                    'msg'    => '删除成功！'
                );
                echo $status = json_encode($status);
                exit;
            }
        }
    }
    public function show($id){
        $content  = model('form_content')->where('formid',intval($id))->getOne();
        if(empty($content)){
            $var = array(
                'error',
                '内容不存在！',
                '你选择的表单内容并不存在！',
            );
            controller('Admin', 'show_message', $var);
            exit;
        }else{
            $form = model('form')->where('formid',$content['fid'])->getOne();
            //var_dump($form);
            if(empty($form)){
                $var = array(
                    'error',
                    '内容不存在！',
                    '你选择的表单内容并不存在！',
                );
                controller('Admin', 'show_message', $var);
                exit;
            }
            $content = model()->stripslashes($content);
            $form    = model()->stripslashes($form);
            $form['name']  = $form['formname'];
            $form['field'] = unserialize($form['formsetting']);
            $form['content'] = unserialize($content['value']);
            $data = array();
            $data['form'] = $form;
            $data['name'] = $form['name'];
            $data['fid']  = $content['fid'];
            $data['id']   = $id;
            view('Form/show',$data);
        }
    }
    public function manage($act='manage',$id=0){
    	if($act=='manage'){
	        $fid = isset($_GET['formid'])?intval($_GET['formid']):false;
	        if(!$fid){
	            $var = array(
	                'error',
	                '参数不完整，禁止非法进入！',
	                '禁止非法进入。。。',
	            );
	            controller('Admin', 'show_message', $var);
	            exit;
	        }
	        $form = model('form')->where('formid',$fid)->getOne();
	        $count = model('form_content')->where('fid',$fid)->count();
	        //echo $count;
	        $num = 10;           //页面显示的结果数量
	        $page = isset($_GET['page'])?$_GET['page']:1;
	        if($page<1)
	            $page = 1;
	        $pageO = Loader::plugin('page');
	        $pageO->init($count, Router::$router->url('Form/manage',array('page'=>'%page%','formid'=>$fid)),$page,$num);
	        $pages = $pageO->p();
	        $content=model('form_content')->where('fid',$fid)->orderby('form_content.formid desc')->limit($pages['min'],$num)->query();
	        //var_dump($content);
	        $data['fid'] = $fid;
	        $fcontent=array();
	        foreach($content as $value){
	            $formcon         = unserialize($value['value']);
	            $formcon['ip']   = $value['ip'];
	            $formcon['id']   = $value['formid'];
	            $formcon['time'] = date("Y-m-d H:i:s",$value['time']);
	            $fcontent[]      = $formcon;
	        }
	        $data['fcontent'] = $fcontent;
	        $data['pages']    = $pages['html'];
	        $data['pageNum']  = $pages['pageNum'];
	        $formField        = unserialize($form['formsetting']);
	        $data['name']     = $form['formname'];
	        $data['formField']= $formField;
	        view('Form/manage',$data);
        }elseif($act == 'show'){
        	$this->show($id);
        }elseif($act == 'del'){
        	$this->del();
        }
    }
    public function del(){
        $status = array(
                'status' => 'false',
                'msg'    => '传入的参数不正确！'
            );
        //var_dump($_REQUEST);
        if(isset($_REQUEST['id'])){
            $id = intval($_REQUEST['id']);
            $form = model('form_content')->where('formid',$id)->getOne('fid');
            if(!empty($form)){
                $fid = $form['fid'];
                if(model('form_content')->where('formid',intval($_REQUEST['id']))->delete()){
                    $status = array(
                            'status' => 'true',
                            'msg'    => '删除成功了！'
                        );
                }else{
                    $status = array(
                            'status' => 'false',
                            'msg'    => '删除失败，出现未知错误！'
                        );
                }
                if (isset($_REQUEST['is_ajax'])) {
                    echo json_encode($status);exit;
                }else{
                    if($status['status']=='false')
                        $var = array(
                            'error',
                            $status['msg'],
                            '请认真查看后再次重试！',
                        );
                    else
                        $var = array(
                            'ok',
                            $status['msg'],
                            '删除成功，正在跳转！',
                        );
                    controller('Admin', 'show_message', $var);
                    redirect(Router::$router->url('Form/manage',array('formid'=>$fid)), 2);
                    exit;
                }
                echo json_encode($status);exit;
            }
        }
    }
}