<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * MemberController Class  用户操作控制器
 * User: PGF
 * Date: 2015/12/3
 * Time: 10:40
 */

class MemberController extends Controller{
    public $cacheKey;
    private $data;
    public $setting = array();

    /**
     * 初始化Member 获取正确配置并获取到模板信息
     */
    public function Initialize(){
        Controller('Index');
        $this->data = $this->load->template()->var;
        $database = array(
            'cache' => 0
        );
        Config::set($database,'database');
        if($this->data['user']==false)
            header('Location:'.Router::$router->url('Member/login'));
    }

    /**
     * 登陆动作
     * 如果包括了username和password则判断是否登陆成功
     * 登陆状态会给参数 $loginstatus=number;
     * 没有提交时为   -1      用户还没有提交登陆
     * 登陆成功为     0
     * 验证码错误    2       验证码不存在或者验证码错误
     * 登陆失败      1      包括账号密码不匹配或者账户不存在
     * 否则将调用 Member/login 模板
     */
    public function login(){
        if($this->data['user']==false) {
            $this->data['loginstatus'] = -1;    //默认为没有点击登陆
            $this->data['SEO']['title'] = '用户登陆_' . $this->data['SEO']['title'];
            if (isset($_POST['username']) && isset($_POST['password'])) {
                if ($this->data['website']['logincheckcode'] == 1) {       //是否需要登陆验证码
                    $_SESSION['code'] = isset($_SESSION['code']) ? $_SESSION['code'] : '';
                    if (isset($_POST['checkcode']) && strtolower($_POST['checkcode']) == $_SESSION['code']) {
                        if ($user = model('member')->login($_POST['username'], $_POST['password'])) {
                            $this->data['loginstatus'] = 0;         //登陆成功
                            $this->data['user'] = $user;     //给模板赋值用户信息
                        } else {
                            $this->data['loginstatus'] = 1;         //登陆失败
                        }
                    } else {
                        $this->data['loginstatus'] = 2;             //用户验证码不正确
                    }
                } else {
                    if ($user = model('member')->login($_POST['username'], $_POST['password'])) {
                        $this->data['loginstatus'] = 0;
                        $this->data['user'] = $user;
                    } else {
                        $this->data['loginstatus'] = 1;
                    }
                }
            }

            if ($this->data['loginstatus'] == 0) {
                Module('member')->saveToken($user, $this->data['website']['membertokentype']);
                $message = array(
                    'title'   => '登陆成功',
                    'content' => ($this->data['user']['nickername']==''?$this->data['user']['username']:$this->data['user']['nickername']).
                        '你好，欢迎回来！'
                );
                show_message($message,'success');
            }else{
                view('Member/login',$this->data);
            }
        }else{
            header('Location:'.Router::$router->url('Member/wellcome'));
        }
    }

    /**
     * 注册动作
     * 如果包含username password password_again 则会判断是否注册成功
     * $registerstatus 为注册状态
     * 没有提交         -1
     * 注册成功          0
     * 注册失败          1
     * 验证码错误        2
     * 账号已存在        3
     * 两次密码不匹配    4
     * 账号不合法        5   只允许 [A-Za-z_0-9] 5到15位
     * 密码不合法        6   不能包含空格 6到15位
     * 昵称不合法        7   如果存在nickername将会验证  只能包含字母下划线和汉字 1-16
     * 邮箱不合法        8   如果存在email将会验证
     *
     */
    public function register(){
        $this->settitle('注册新用户');
        $registerstatus = -1;
        if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['password_again'])){
            if($_POST['password']==$_POST['password_again']) {
                if ($this->data['website']['registercheckcode'] == 1) {        //注册是否需要验证码
                    $_SESSION['code'] = isset($_SESSION['code'])?$_SESSION['code']:'';
                    if (!(isset($_POST['checkcode']) && strtolower($_POST['checkcode']) == $_SESSION['code'])) {
                        $registerstatus = 2;
                    } else {
                        $registerstatus = model('member')->register($_POST);
                    }
                }else{
                    $registerstatus = model('member')->register($_POST);
                }
            }else{
                $registerstatus = 4;
            }
            $message=array(
                'title'=>'注册失败',
                'content'=>'注册时出现意外错误！'
            );
            switch($registerstatus){
                case 0:
                    $message = array(
                        'title'   => '注册成功',
                        'content' => '恭喜您，注册成功了！'
                    );
                    show_message($message,'success');
                    break;
                case 1:
                    show_message($message,'error');
                    break;
                case 2:
                    $message['content'] = '验证码错误，注册失败！';
                    show_message($message,'warning');
                    break;
                case 3:
                    $message['content'] = '此用户名已存在，请更换用户名！';
                    show_message($message,'info');
                    break;
                case 4:
                    $message['content'] = '对不起，您两次输入的密码不一致，请重新输入。';
                    show_message($message,'info');
                    break;
                case 5:
                    $message['content'] = '账号不合法，允许包含字母数字和下划线，4-16个字符！';
                    show_message($message,'info');
                    break;
                case 6:
                    $message['content'] = '密码不合法，不允许存在空格，并且在4-16个字符之间！';
                    show_message($message,'info');
                    break;
                case 7:
                    $message['content'] = '昵称不合法，可以包含汉字、字母、数字和下划线,并且最多不可以超过16个字符！';
                    show_message($message,'info');
                    break;
                case 8:
                    $message['content'] = '请您填写正确的邮箱！';
                    show_message($message,'info');
            }
        }else {
            $this->data['registerstatus'] = $registerstatus;
            view('Member/register', $this->data);
        }
    }

    /**
     * 用户中心
     */
    public function wellcome(){
        if($this->data['user']==false)
            header('Location:'.Router::$router->url('Member/login'));

        $this->settitle('用户中心');
        view('Member/wellcome', $this->data);
    }

    /**
     * 用户中心
     * 跳到center行为
     */
    public function index(){
        $this->wellcome();
    }

    /**
     * 修改信息
     */
    public function edit_profile(){
        if(isset($_POST)&&isset($_POST['edit_profile'])){
            $status = Model('member')->edit_profile($_POST,$this->data['user']['userid']);
            if($status==0){
                $message = array(
                    'title' => '用户信息修改成功',
                    'content' => '用户信息修改成功了，页面正在跳转。。。'
                );
                show_message($message,'success',Router::$router->url('Member/profile'));
            }else if($status==1){
                $message = array(
                    'title' => '用户信息修改失败',
                    'content' => '请输入合法的昵称，页面正在返回。。。'
                );
                show_message($message,'info',Router::$router->url('Member/edit_profile'));
            }else if($status==2){
                $message = array(
                    'title' => '用户信息修改失败',
                    'content' => '请输入合法的邮箱，页面正在返回。。。'
                );
                show_message($message,'info',Router::$router->url('Member/edit_profile'));
            }else if($status==3){
                $message = array(
                    'title' => '用户信息修改失败',
                    'content' => '请输入合法的QQ，页面正在返回。。。'
                );
                show_message($message,'info',Router::$router->url('Member/edit_profile'));
            }else if($status==4){
                $message = array(
                    'title' => '用户信息修改失败',
                    'content' => '请输入合法的手机号码，页面正在返回。。。'
                );
                show_message($message,'info',Router::$router->url('Member/edit_profile'));
            }else{
                $message = array(
                    'title' => '用户信息修改失败',
                    'content' => '出现意外错误，请联系管理员。。。'
                );
                show_message($message,'success',Router::$router->url('Member/profile'));
            }
        }else{
            $this->settitle('修改用户资料');

            view('Member/edit_profile',$this->data);
        }
    }

    /**
     * 用户资料
     */
    public function profile(){
        $this->settitle('用户资料');
        view('Member/profile',$this->data);
    }


    /**
     * 用户资产
     */
    public function blance(){

    }

    /**
     * 退出登录
     * 会调用模板 Member/logout
     */
    public function logout(){
        if($this->data['user']!=false)
        {
            Module('member')->logout();
        }
        $message = array(
            'title' => '退出成功',
            'content' => '退出成功了，正在跳回首页，请稍等。。。'
        );
        show_message($message,'success',$_SERVER['SCRIPT_NAME']);
    }

    /**
     * 设置标题
     */
    private function settitle($title){
        $this->data['SEO']['title'] = $title.'_'.$this->data['website']['title'];
    }
}