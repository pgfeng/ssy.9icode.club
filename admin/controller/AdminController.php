<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * User: PGF
 * Date: 2015/5/23
 * Time: 10:41
 */
class AdminController extends Controller
{
    
    function initialize(){
        $config = array(
            'hidden_entry' => false
        );
        Config::set($config,'router');
    }

    //登录系统
    function login()
    {
        if (isset($_POST) && !empty($_POST)) {
            if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['checkcode'])) {
                $msg = model('admin')->login($_POST['username'], $_POST['password'], $_POST['checkcode']);
                if ($msg['status'] == true) {
                    $var = array(
                        'OK',
                        '登录成功',
                        '页面正在跳转，请稍后。。。',
                        array('Index/index' => '进入管理')
                    );
                    redirect(Router::url('Index/index'), 1);
                    controller('Admin', 'show_message', $var);
                    exit;
                } else {
                    $var = array(
                        'error',
                        '登录失败',
                        $msg['msg'],
                        array('Admin/login' => '重新登录'),
                        'Admin/login'
                    );
                    redirect(Router::url('Admin/login'), 1);
                    controller('Admin', 'show_message', $var);
                    exit;
                }
            }
        } else {
            view('Index/login');
        }
    }

    //退出系统
    function loginout()
    {
        if (model('admin')->loginout()) {
            header('Location:' . Router::url('Admin/login'));
        }
    }

    function show_message($type, $title, $tips, $link = array())
    {
        $data['type'] = $type;
        $data['title'] = $title;
        $data['tips'] = $tips;
        $data['link'] = $link;
        view('Index/show_message', $data);
    }
}