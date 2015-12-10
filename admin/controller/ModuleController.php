<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * User: PGF
 * Date: 15-6-6
 * Time: 下午1:03
 */
class ModuleController extends Controller
{
    private $user;

    //=====自动判断是否已经登录

    public function initialize()
    {
        //调用IndexController中的初始化方法
        controller('Index');
    }

    //====管理数据模型
    public function manage($action = false,$method=false)
    {
        if($action=='field'&&isset($_GET['mid'])&&!empty($_GET['mid'])){
            $module=model('model')->where('modelid',intval($_GET['mid']))->select()->query();
            if(empty($module))
                exit;
            $data['module']=$module[0];
            if($method=='add'||$method=='edit'){
                if(isset($_POST['name']))
                {
                    if($method=='add')
                        module('admin')->addField(intval($_GET['mid']), $_POST);
                    if($method=='edit')
                        module('admin')->editField(intval($_GET['fid']), $_POST);
                }else {
                    $regexp = model('regexp')->select()->query();
                    $data['regexp'] = $regexp;
                    if(isset($_GET['fid']))             //判断字段ID是否存在
                    {
                        $field=model('model_field')->where('fieldid',intval($_GET['fid']))->getOne();
                        $data['field']=model('model_field')->parseSetting($field);
                        $data['field']=model()->addslashes($data['field']);
                        //print_r($data);
                    }
                    $data['method']=$method;
                    view('Module/field_add', $data);
                }
            }elseif($method == 'del') {
                //echo 'aaa';
                if(isset($_POST['id']))
                    Module('admin')->delField($_POST['id']);
            }else{
                    //$field=model('model_field')->where('modelid',intval($_GET['mid']))->select()->query();
                    //$data['field']=$field;
                    //print_r($data);
                    view('Module/field_manage',$data);

            }
            return;
        }
        if (isset($_POST) && !empty($_POST)) {
            if ($action == 'add') {
                if (isset($_POST['tablename'])&&isset($_POST['name'])) {
                    module('admin')->addModule($_POST);
                }
            }
            elseif($action == 'del') {
                if(isset($_POST['id']))
                    module('admin')->delModule($_POST['id']);
            }
            elseif($action == 'edit'){
                if(isset($_POST['id']))
                    module('admin')->editModule($_POST);
            }
        } else {
            $module = model('model')->select()->query();
            $data['module'] = $module;
            view('Module/manage', $data);
        }
    }
}